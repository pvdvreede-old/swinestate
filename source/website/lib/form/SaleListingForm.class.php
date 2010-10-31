<?php

/**
 * Listing form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class SaleListingForm extends ListingForm
{
  /**
   * SaleListingForm::configure()
   * 
   * @return
   */
  public function configure()
  {

      parent::configure();

      $this->widgetSchema['listing_type_id'] = new sfWidgetFormInputHidden(array(), array(
          'value' => '1'
      ));

      $this->validatorSchema['listing_type_id'] = new sfValidatorInteger();

      // add in the sale details form from scratch if new
      if ($this->getObject()->isNew()) {

          $details = new SaleDetails();

      } else {

          $details = $this->getObject()->getSaleDetails();

      }
 
      $details->addListing($this->getObject());

      // create the sale details form
      $details_form = new SaleDetailsForm($details);

      $this->embedForm('sale_details', $details_form);

  }

 
}
