<?php

class sfWidgetFormSchemaFormatterDiv extends sfWidgetFormSchemaFormatter {

    protected
    $rowFormat = "<div class='form_row%row_class%'>
                                %label% \n  %field% %error%
                                %help% %hidden_fields%\n</div>\n",
    $errorListFormatInARow = "  <span class=\"error_list\">\n%errors%  </span>\n",
    $errorRowFormatInARow = "    %error%\n",
    $errorRowFormat = "<div>%errors%</div>",
    $helpFormat = '<div class="form_help">%help%</div>',
    $decoratorFormat = "<div class='form_part'>\n  %content%</div>",
    // template for adding a mark for all required fields
    $requiredTemplate= '&nbsp;<pow class="requiredFormItem">*</pow>';


    public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null) {
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

    /**
     * Generates the label name for the given field name.
     *
     * @param  string $name  The field name
     * @return string The label name
     */
    public function generateLabelName($name) {
        $label = parent::generateLabelName($name);

        $fields = $this->validatorSchema->getFields();
        if ($fields[$name] != null) {
            $field = $fields[$name];
            if ($field->hasOption('required') && $field->getOption('required')) {
                $label .= $this->requiredTemplate;
            }
        }
        return $label;
    }

}

?>
