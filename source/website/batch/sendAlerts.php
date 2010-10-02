<?php

/*
 * This file is run from a cron job that checks all the alerts
 * and sends emails to users if there is new listing from today
 * that matches their alert criteria
 */

// call the symfony stuff to have access to the frame work
define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
define('SF_APP', 'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG', true);

require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
sfContext::createInstance($configuration);//->dispatch();

sfContext::getInstance();

// get all the listings that are available for view from today
$c = new Criteria();

$c->add(ListingPeer::LISTING_STATUS_ID, ListingStatusPeer::getIdFromName('Available'));
// set criteria that only gets listings that have paid
$c->addJoin(ListingPeer::ID, ListingTimePeer::LISTING_ID);
$c->add(ListingTimePeer::START_DATE, time(), Criteria::LESS_THAN);
$c->add(ListingTimePeer::PAYMENT_STATUS, 'Paid');

$listings = ListingPeer::doSelect($c);

if (!empty($listings)) {

// for each new listing do a query to see if any alerts match them
    foreach ($listings as $listing) {

        $c = new Criteria();

        $c->add(AlertPeer::BEDROOMS, $listing->getBedrooms());

        $c->add(AlertPeer::BATHROOMS, $listing->getBathrooms());

        $c->add(AlertPeer::CAR_SPACES, $listing->getCarSpaces());

        // make sure to only get the active alerts!!!
        $c->add(AlertPeer::ACTIVE, true);

        $alerts = AlertPeer::doSelect($c);

        // if there is a match then loop through all the matching alerts
        if (!$alerts) {

            // for each alert get the user
            foreach ($alerts as $alert) {

                $user = sfGuardUserProfilePeer::retrieveByPK($alert->getUserId());

                // send that user an email
                // send an email to the user with the details of the property and a link to it
                $email = Swift_Message::newInstance()->setContentType('text/html')
                                ->setFrom(sfConfig::get('app_from_email'))
                                ->setTo($user->getEmailAddress())
                                ->setSubject(sfConfig::get('app_app_name') . ' - Listing Alert Activated')
                                ->setBody(include('alertEmail.php'));

                $this->getMailer()->send($email);

                // mark that alert as having been activated
                $alert->setAmountAlerted($alert->getAmountAlerted() + 1);

                // re save the alert row in the db
                $alert->save();
            }
        }
    }
}
?>
