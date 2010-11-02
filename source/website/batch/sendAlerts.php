<?php

/*
 * This file is run from a cron job that checks all the alerts
 * and sends emails to users if there is new listing from today
 * that matches their alert criteria
 */

// call the symfony stuff to have access to the frame work
define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
define('SF_APP', 'frontend');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG', true);

require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration(SF_APP, SF_ENVIRONMENT, SF_DEBUG);
sfContext::createInstance($configuration); //->dispatch();

$instance = sfContext::getInstance();
sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url', 'Tag'));
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
        echo 'Listings being checked: ' . $listing->getName();
        if ($listing->getSaleDetailsId() != null) {
            $price = $listing->getSaleDetails()->getAskingPrice();
        } elseif ($listing->getRentDetailsId() != null) {
            $price = $listing->getRentDetails()->getAmountMonthPrice();
        }

        $type = $listing->getListingTypeId();
        // get the module link that will be used in the email template for the notification
        $module = strtolower($listing->getListingType()->getName());
        $con = Propel::getConnection();
        $sql = "select *
                from alert, listing, address, suburb
                where listing.address_id = address.id
                and address.suburb_id = suburb.id
                and listing.listing_type_id = alert.listing_type_id
                and listing.bedrooms = coalesce(alert.bedrooms, listing.bedrooms)
                and listing.bathrooms = coalesce(alert.bathrooms, listing.bathrooms)
                and listing.car_spaces = coalesce(alert.car_spaces, listing.car_spaces)
                and suburb.postcode = coalesce(alert.postcode, suburb.postcode)
                and suburb.name = coalesce(IF(LENGTH(TRIM(alert.suburb))=0,NULL,alert.suburb), suburb.name)
                and listing.id = {$listing->getId()}
                and alert.active = 1
				";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $alerts = AlertPeer::populateObjects($stmt);

        // if there is a match then loop through all the matching alerts
        if (!empty($alerts)) {

            // for each alert get the user
            foreach ($alerts as $alert) {

                echo '  Alert being actioned: ' . $alert->getName();

                $c = new Criteria();

                $c->add(sfGuardUserProfilePeer::USER_ID, $alert->getUserId());

                $user = sfGuardUserProfilePeer::doSelectOne($c);
                try {

                    // the text for the body of the email
                    $emailContent = "<p>The alert " . $alert->getName() . " that you created has found a listing that matches its criteria. Click on the link below to be taken to the listing:</p> <p>" . link_to(url_for($module . '/show?id=' . $listing->getId()), $module . '/show?id=' . $listing->getId()) . "</p>";

                    echo 'Email contents: ' . $emailContent;
                    // send that user an email
                    // send an email to the user with the details of the property and a link to it
                    $email = Swift_Message::newInstance()->setContentType('text/html')
                                    ->setFrom(sfConfig::get('app_from_email'))
                                    ->setTo($user->getEmailAddress())
                                    ->setSubject(sfConfig::get('app_app_name') . ' - Listing Alert Activated')
                                    ->setBody($emailContent);
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
