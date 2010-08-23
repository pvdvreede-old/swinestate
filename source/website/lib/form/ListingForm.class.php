<?php

/**
 * Listing form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class ListingForm extends BaseListingForm
{
  public function configure()
  {



      // create an address database object and link to the form
      $address = new Address();
      $address->addListing($this->getObject());

      // create address form to embed in this form
      $address_form = new AddressForm($address);

      $this->embedForm('address', $address_form);

      // only use certain fields for the form
      $this->useFields(array(
          'name',
          'property_type_id',
          'description',
          'address',
          'bedrooms',
          'bathrooms',
          'car_spaces',
      ));

  }
}
