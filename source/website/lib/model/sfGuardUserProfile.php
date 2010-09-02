<?php


/**
 * Skeleton subclass for representing a row from the 'user_profile' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Aug 23 12:32:41 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class sfGuardUserProfile extends BasesfGuardUserProfile {

    public function hasInterestIn($listing_id) {

        // check and see if the user has any interests in the listing
        $c = new Criteria();

        $c->add(InterestPeer::USER_ID, $this->getUserId());
        $c->add(InterestPeer::LISTING_ID, $listing_id);


        // if there is a row then the user has an interest for this listing
        if (InterestPeer::doCount($c) > 0) {
            return true;
        }

        return false;

    }

} // sfGuardUserProfile
