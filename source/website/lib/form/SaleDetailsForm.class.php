<?php

/**
 * SaleDetails form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class SaleDetailsForm extends BaseSaleDetailsForm
{
  public function configure()
  {
      $this->useFields(array(
          'asking_price',
          'actual_price',
          'auction_date'
      ));

  }
}
