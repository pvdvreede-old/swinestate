<?php

/**
 * Listing form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class ListingAdminForm extends ListingForm {

    /**
     * ListingAdminForm::removeFields()
     * 
     * @param mixed $fields
     * @return
     */
    /**
     * ListingAdminForm::removeFields()
     * 
     * @param mixed $fields
     * @return
     */
    protected function removeFields($fields = null)
    {
        unset($this['created_at'], $this['updated_at'], $this['address_id'], $this['sale_details_id'], $this['rent_details_id'], $this['alert_activated']);
        
    }
}
