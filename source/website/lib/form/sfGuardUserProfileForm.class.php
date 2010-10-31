<?php

/**
 * sfGuardUserProfile form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class sfGuardUserProfileForm extends BasesfGuardUserProfileForm
{
  /**
   * sfGuardUserProfileForm::configure()
   * 
   * @return
   */
  public function configure()
  {
      unset($this['updated_at']);

      // make sure this is an email address for the user, and do a check that it is an email address
      $this->validatorSchema['email_address'] = new sfValidatorEmail(array(
          'required' => true,
          'max_length' => 255
      ));
  }
}
