<?php

/**
 * SaleDetails form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class SaleDetailsForm extends BaseSaleDetailsForm {

    public function configure() {
        $this->widgetSchema['auction_date'] = new sfWidgetFormJQueryDate(array(
                    'config' => '{minDate: +1}'
                ));


        $this->useFields(array(
            'asking_price',
            'actual_price',
            'auction_date'
        ));

        // Add *  to our required fields
        foreach ($this->getFormFieldSchema()->getWidget()->getFields() as $key => $object) {
            $label = $this->getFormFieldSchema()->offsetGet($key)->renderLabelName();
            if ($this->validatorSchema[$key]->getOption('required') == true) {
                $this->widgetSchema->setLabel($key, $label . " *");
            }
        }
    }

}
