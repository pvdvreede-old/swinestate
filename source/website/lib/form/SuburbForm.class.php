<?php

/**
 * Suburb form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class SuburbForm extends BaseSuburbForm
{
  public function configure()
  {

      // removed the updated and created fields by selecting only the fields to use
      $this->useFields(array(
          'name',
          'postcode',
          'state',
          'country'
      ));
  }
}
