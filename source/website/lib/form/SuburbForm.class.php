<?php

/**
 * Suburb form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class SuburbForm extends BaseSuburbForm {

    public function configure() {

        // removed the updated and created fields by selecting only the fields to use
        $this->useFields(array(
            'name',
            'postcode',
            'state',
            'country'
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
