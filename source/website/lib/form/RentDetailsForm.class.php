<?php

/**
 * RentDetails form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class RentDetailsForm extends BaseRentDetailsForm {

    public function configure() {
        unset(
                $this['created_at'],
                $this['updated_at']
        );

        $this->widgetSchema['lease_period_until'] = new sfWidgetFormJQueryDate(array(
                    'config' => '{minDate: +1}'
                ));

        $this->widgetSchema['renting_date'] = new sfWidgetFormJQueryDate(array(
                    'config' => '{minDate: +1}'
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
