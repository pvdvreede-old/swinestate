<?php

/**
 * Alert form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class AlertForm extends BaseAlertForm {

    /**
     * AlertForm::configure()
     * 
     * @return
     */
    /**
     * AlertForm::configure()
     * 
     * @return
     */
    public function configure() {
        // only show certain fields to the user
        $this->useFields(array(
            'name',
            'listing_type_id',
            'bedrooms',
            'bathrooms',
            'car_spaces',
            'suburb',
            'postcode',
            'min_price',
            'max_price',
            'active'
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
