<?php

/**
 * Listing form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class RentListingForm extends ListingForm
{
  public function configure()
  {

      parent::configure();

      $this->widgetSchema['listing_type_id'] = new sfWidgetFormInputHidden(array(), array(
          'value' => '2'
      ));
      
      // add in the sale details form from scratch if new
      if ($this->getObject()->isNew()) {

          $details = new RentDetails();

      } else {

          $details = $this->getObject()->getRentDetails();

      }

      $details->addListing($this->getObject());

      // create the sale details form
      $details_form = new RentDetailsForm($details);

      $this->embedForm('rent_details', $details_form);

  }

 
}
