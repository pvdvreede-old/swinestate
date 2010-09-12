<?php


class sfWidgetFormSchemaFormatterDiv extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat              = "<div class='form_row%row_class%'>
                                %label% \n  %field% %error%
                                %help% %hidden_fields%\n</div>\n",
    $errorListFormatInARow     = "  <span class=\"error_list\">\n%errors%  </span>\n",
    $errorRowFormatInARow      = "    %error%\n",
    $errorRowFormat  = "<div>%errors%</div>",
    $helpFormat      = '<div class="form_help">%help%</div>',
    $decoratorFormat = "<div class='form_part'>\n  %content%</div>";

  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    $row = parent::formatRow(
      $label,
      $field,
      $errors,
      $help,
      $hiddenFields
    );

    return strtr($row, array(
        '%row_class%' => (count($errors) > 0) ? ' form_row_error' : '',

    ));
  }


}

?>
