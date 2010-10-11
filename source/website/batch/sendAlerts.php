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

if (!empty($listings)) {

    print_r($listings);

    // for each new listing do a query to see if any alerts match them
    foreach ($listings as $listing) {
		
		$price = ($listing->getSaleDetailsId() == null) ? $listing->getRentDetails->getAmountMontPrice() : $listing->getSaleDetails->getAskingPrice();
		$type = $listing->getListingTypeId(); 
		
		$con = Propel::getConnection(DATABASE_NAME);
		$sql = "select alert.* 
				from alert, listing, address, suburb 
				where listing.address_id = ad.id 
				and address.suburb_id = suburb.id 
				and alert.listing_type_id = {$listing->getListingTypeId()}
				and listing.bedrooms = coalesce(alert.bedrooms, listing.bedrooms) 
				and listing.bathrooms = coalesce(alert.bathrooms, listing.bathrooms) 
				and listing.car_spaces = coalesce(alert.car_spaces, listing.car_spaces) 
				and suburb.postcode = coalesce(alert.postcode, suburb.postcode) 
				and suburb.name = coalesce(alert.suburb, suburb.name) 
				and {$price} >= coalesce(alert.min_price, {$price})
				and {$price} <= coalesce(alert.max_price, {$price})
				and listing.id = {$listing->getId()} 				
				and alert.active = 1";
		$stmt = $con->createStatement();
		$rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);
		$alerts = AlertPeer::populateObjects($rs);

        // if there is a match then loop through all the matching alerts
        if (!empty($alerts)) {
            print_r($alerts);
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

                try {

                    $instance->getMailer()->send($email);
                    
                } catch (Swift_TransportException $ex) {

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
