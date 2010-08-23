<?php

/**
 * Address form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class AddressForm extends BaseAddressForm
{
  public function configure()
  {

      // create the suburb object to put in the embedded form
      $suburb = new Suburb();
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
