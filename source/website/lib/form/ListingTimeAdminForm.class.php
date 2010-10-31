<?php

/**
 * ListingTime form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class ListingTimeAdminForm extends ListingTimeForm
{
  /**
   * ListingTimeAdminForm::removeFields()
   * 
   * @return
   */
  protected function removeFields()
  {   
    unset($this['created_at'], $this['updated_at']);
  }
}
