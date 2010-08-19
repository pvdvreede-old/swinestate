<?php


/**
 * Skeleton subclass for representing a row from the 'address' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Aug 19 09:43:51 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Address extends BaseAddress {

    public function  __toString() {
        return $this->getStreetNumber().' '.$this->getStreetName().', '.$this->getSuburb()->getName().' '.$this->getSuburb()->getPostcode();
    }

} // Address
