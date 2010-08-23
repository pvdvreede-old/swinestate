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
  public function configure()
  {
      unset($this['updated_at']);
  }
}
