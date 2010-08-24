<?php

/**
 * Address form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class AddressForm extends BaseAddressForm {

    public function configure() {

        // when there is an edit we need to get the address from the db
        if (!$this->getObject()->isNew()) {
            $suburb = $this->getObject()->getSuburb();
        } else {
            // create an address database object and link to the form
            $suburb = new Suburb();
        }

        // create the suburb object to put in the embedded form
        $suburb->addAddress($this->getObject());

        // create the form to embed
        $suburb_form = new SuburbForm($suburb);

        // embed the form
        $this->embedForm('suburb', $suburb_form);

        // only make certain fields editable
        $this->useFields(array(
            'unit_number',
            'street_number',
            'street_name',
            'suburb'
        ));
    }

}
