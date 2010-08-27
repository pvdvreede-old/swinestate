<?php

/**
 * ListingTime form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class ListingTimeForm extends BaseListingTimeForm
{
  public function configure()
  {

      //$this->widgetSchema['start_date'] =

      $this->useFields(array(
              'listing_id',
              'start_date',
              'end_date'
              ));
  }
}
