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
  protected function removeFields()
  {   
    unset($this['created_at'], $this['updated_at']);
  }
}
