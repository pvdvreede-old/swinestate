<?php


/**
 * Skeleton subclass for representing a row from the 'country' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Sep 29 12:52:06 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Country extends BaseCountry {

    /**
     * Country::__toString()
     * 
     * @return
     */
    public function  __toString() {
        return $this->getDisplayName();
    }

} // Country
