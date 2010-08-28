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

      // meta data form
      $metaForm = new ListingMetadataColumnForm();

      // add meta data for the type
      $this->embedForm('meta', $metaForm);

      $this->getWidget('meta')->setOption('label', 'Sale details');
      

  }

 
}
