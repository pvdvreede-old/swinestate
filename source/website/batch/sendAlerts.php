<?php
/* 
 * This file is run from a cron job that checks all the alerts
 * and sends emails to users if there is new listing from today
 * that matches their alert criteria
 */

// call the symfony stuff to have access to the frame work
require_once (realpath(dirname(__FILE__)).'/../config/ProjectConfiguration.class.php');

sfContext::getInstance();

// get all the listings that are available for view from today
$c = new Criteria();

$c->add(ListingPeer::LISTING_STATUS_ID, ListingStatusPeer::getIdFromName('Active'));
// set criteria that only gets listings that have paid
$c->addJoin(ListingPeer::ID, ListingTimePeer::LISTING_ID);
$c->add(ListingTimePeer::START_DATE, time(), Criteria::LESS_THAN);
$c->add(ListingTimePeer::PAYMENT_STATUS, 'Paid');

$listings = ListingPeer::doSelect($c);

// for each new listing do a query to see if any alerts match them
foreach ($listings as $listing) {

    $c = new Criteria();
    
    $c->add(AlertPeer::BEDROOMS, $listing->getBedrooms());
    
    $c->add(AlertPeer::BATHROOMS, $listing->getBathrooms());
    
    $c->add(AlertPeer::CAR_SPACES, $listing->getCarSpaces());
    
    $alerts = AlertPeer::doSelect($c);

    // if there is a match then loop through all the matching alerts
    if (!$alerts) {

        // for each alert get the user
        foreach ($alerts as $alert) {

            $user = sfGuardUserProfilePeer::retrieveByPK($alert->getUserId());

            // send that user an email


            // mark that alert as having been activated
            
            
        }
    }
}

?>
