<?php


/**
 * Skeleton subclass for representing a row from the 'property_type' table.
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
class PropertyType extends BasePropertyType {

    public function  __toString() {
        return $this->getName();
    }

} // PropertyType