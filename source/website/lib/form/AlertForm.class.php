<?php

/**
 * Alert form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class AlertForm extends BaseAlertForm
{
  public function configure()
  {
      // only show certain fields to the user
      $this->useFields(array(
          'bedrooms',
          'bathrooms',
          'car_spaces',
          'suburb',
          'postcode',
          'active'
      ));

  }
}
