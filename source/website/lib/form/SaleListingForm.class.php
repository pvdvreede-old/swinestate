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
  public function configure()
  {

      parent::configure();

      // add in the sale details form from scratch if new
      if ($this->getObject()->isNew()) {

          $details = new SaleDetails();

      } else {

          $c = new Criteria();

          $c->add(SaleDetailsPeer::LISTING_ID, $this->getObject()->getId());

          $details = SaleDetailsPeer::doSelectOne($c);

      }

      $this->getObject()->addSaleDetails($details);

      // create the sale details form
      $details_form = new SaleDetailsForm();

      $this->embedForm('sale_details', $details_form);

  }

 
}
