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

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', SF_ENVIRONMENT, true);
sfContext::createInstance($configuration); //->dispatch();

$instance = sfContext::getInstance();

// get all the listings that are available for view from today
$c = new Criteria();

$c->add(ListingPeer::LISTING_STATUS_ID, ListingStatusPeer::getIdFromName('Available'));
// set criteria that only gets listings that have paid
$c->addJoin(ListingPeer::ID, ListingTimePeer::LISTING_ID);
$c->add(ListingTimePeer::START_DATE, time(), Criteria::LESS_THAN);
$c->add(ListingTimePeer::PAYMENT_STATUS, 'Paid');
// only get listings that havent been alerted
$c->add(ListingPeer::ALERT_ACTIVATED, 0);

$listings = ListingPeer::doSelect($c);
//print_r($listings);
if (!empty($listings)) {

    //print_r($listings);
    // for each new listing do a query to see if any alerts match them
    foreach ($listings as $listing) {

        $price = ($listing->getSaleDetailsId() == null) ? $listing->getRentDetails->getAmountMontPrice() : $listing->getSaleDetails()->getAskingPrice();
        $type = $listing->getListingTypeId();

        $con = Propel::getConnection();
        $sql = "select *
                from alert, listing, address, suburb
                where listing.address_id = address.id
                and address.suburb_id = suburb.id

                and listing.bedrooms = coalesce(alert.bedrooms, listing.bedrooms)
                and listing.bathrooms = coalesce(alert.bathrooms, listing.bathrooms)
                and listing.car_spaces = coalesce(alert.car_spaces, listing.car_spaces)
                and suburb.postcode = coalesce(alert.postcode, suburb.postcode)

                and listing.id = {$listing->getId()}
				";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $alerts = AlertPeer::populateObjects($stmt);

        //print_r($stmt);
       // print_r($alerts);
        // if there is a match then loop through all the matching alerts
        if (!empty($alerts)) {
           // print_r($alerts);
            // for each alert get the user
            foreach ($alerts as $alert) {

                $user = sfGuardUserProfilePeer::retrieveByPK($alert->getUserId());
                try {
                    // send that user an email
                    // send an email to the user with the details of the property and a link to it
                    $email = Swift_Message::newInstance()->setContentType('text/html')
                                    ->setFrom(sfConfig::get('app_from_email'))
                                    ->setTo($user->getEmailAddress())
                                    ->setSubject(sfConfig::get('app_app_name') . ' - Listing Alert Activated')
                                    ->setBody(file_get_contents('alertEmail.php'));
                    echo $user->getEmailAddress();


                    $instance->getMailer()->send($email);
                } catch (Exception $ex) {

                    echo 'Error when sending email';
                }

                // mark that alert as having been activated
                $alert->setAmountAlerted($alert->getAmountAlerted() + 1);

                // re save the alert row in the db
                $alert->save();
            }
        }

        // set the listing as having been alerted so it isnt alerted the next time
        $listing->setAlertActivated(1);

        $listing->save();
    }
}
?>
