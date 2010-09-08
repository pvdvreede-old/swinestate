<?php


/**
 * Skeleton subclass for representing a row from the 'listing_time' table.
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
class ListingTime extends BaseListingTime {

    public function save(PropelPDO $con = null) {

        // make sure that there is not another entry in the table which include part or all
        // the same date
        $c = new Criteria();
        
        $c->add(ListingTimePeer::START_DATE, $this->getStartDate(), Criteria::LESS_EQUAL);
        $c->add(ListingTimePeer::END_DATE, $this->getEndDate(), Criteria::GREATER_EQUAL);
        $c->add(ListingTimePeer::LISTING_ID, $this->getListingId());
        $c->add(ListingTimePeer::PAYMENT_STATUS, 'Paid');

        if (ListingTimePeer::doCount($c) > 0) {
            //return null;
            throw new sfException('There is already a payment entry with those dates for this listing.', 500);
        }

        // if this is the first save attach the user id, and the listing status
        if ($this->isNew()) {
            try {

                $this->setUserId(sfContext::getInstance()->getUser()->getGuardUser()->getId());

                // make the listing unpaid by default so the user has to pay to get it shown
                $this->setPaymentStatus('Pending');

            } catch (Exception $ex) {
                // if there is an exception a user isnt logged in, so throw a 401 unauthorised exception.
                throw new sfException('You are not authorised to save a Listing', 401);
            }
        }

        // put in the amount of payment in here so that no one can try and alter it
        $this->setTotalPaid($this->getPaidTotalFromDays());

        // call the parent to save
        $object = parent::save($con);

        return $object;
    }

    public function getTotalDays() {

        // get the difference between the first date and last date
        $difference = strtotime($this->getEndDate()) - strtotime($this->getStartDate());

        return (($difference / 60) / 60) / 24;

    }



    public function getPaidTotalFromDays() {

        // get the total amount due from the difference in days
        return $this->getTotalDays() * sfConfig::get('app_daily_ad_cost');

    }

} // ListingTime
