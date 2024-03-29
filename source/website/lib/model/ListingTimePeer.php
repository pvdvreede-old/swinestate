<?php

/**
 * Skeleton subclass for performing query and update operations on the 'listing_time' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Aug 27 01:50:36 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ListingTimePeer extends BaseListingTimePeer {

    /**
     * ListingTimePeer::getPendingPaymentCount()
     * 
     * @return
     */
    public static function getPendingPaymentCount() {

        // get a count of any payments that are still 'pending'
        $c = new Criteria();

        $c->add(ListingTimePeer::USER_ID, sfContext::getInstance()->getUser()->getGuardUser()->getId());
        $c->add(ListingTimePeer::PAYMENT_STATUS, 'Pending');

        return self::doCount($c);
    }

    // function to determine if there is a current view
    /**
     * ListingTimePeer::isCurrentListing()
     * 
     * @param mixed $listing_id
     * @return
     */
    public static function isCurrentListing($listing_id) {

        $c = new Criteria();

        $c->add(ListingTimePeer::LISTING_ID, $listing_id);
        $c->add(ListingTimePeer::START_DATE, time(), Criteria::LESS_THAN);
        $c->add(ListingTimePeer::END_DATE, time(), Criteria::GREATER_THAN);
        $c->add(ListingTimePeer::PAYMENT_STATUS, 'Paid');

        $count = ListingTimePeer::doCount($c);

        // if there is a record then there is a payment
        if ($count > 0) {

            return true;
        }

        return false;
    }
    
    // function to see if the user has any payments
    /**
     * ListingTimePeer::hasPayments()
     * 
     * @return
     */
    public static function hasPayments() {
        
        $c = new Criteria();
        
        $c->add(ListingTimePeer::USER_ID, sfContext::getInstance()->getUser()->getGuardUser()->getId());
        $c->add(ListingTimePeer::PAYMENT_STATUS, 'Paid');
        
        $count = ListingTimePeer::doCount($c);
        
        if ($count > 0) {
            
            return true;
            
        }
        
        return false;
    }

}

// ListingTimePeer
