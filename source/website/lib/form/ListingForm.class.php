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

      // set the widget for the description to the text editor
      $this->widgetSchema['description'] = new sfWidgetFormTextareaTinyMCE(array(
          'width' => 550,
          'height' => 300,
          'config' =>'theme_advanced_disable: ""'
      ));

      $this->widgetSchema['listing_type_id'] = new sfWidgetFormInputHidden(array(), array(
          'value' => '1'
      ));

      // when there is an edit we need to get the address from the db
      if (!$this->getObject()->isNew()) {
          $address = $this->getObject()->getAddress();
      } else {
         // create an address database object and link to the form
          $address = new Address();
      }
      
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
