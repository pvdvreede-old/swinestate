<?php

/**
 * Suburb form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class SuburbForm extends BaseSuburbForm {

    /**
     * SuburbForm::configure()
     * 
     * @return
     */
    public function configure() {

        // removed the updated and created fields by selecting only the fields to use
        $this->useFields(array(
            'name',
            'postcode',
            'state',
            'country_id'
        ));

        // Add *  to our required fields
        foreach ($this->getFormFieldSchema()->getWidget()->getFields() as $key => $object) {
            $label = $this->getFormFieldSchema()->offsetGet($key)->renderLabelName();
            if ($this->validatorSchema[$key]->getOption('required') == true) {
                $this->widgetSchema->setLabel($key, $label . " *");
            }
        }
    }

    /**
     * SuburbForm::doUpdateObject()
     * 
     * @param mixed $values
     * @return
     */
    protected function doUpdateObject($values) {
        parent::doUpdateObject($values);
        sfContext::getInstance()->getLogger()->log("Running custom save for address form.");



        //if ($this->getObject()->isNew()) {

            sfContext::getInstance()->getLogger()->log("Inside suburb check. ".$values['name'].$values['postcode']);

            $suburb = SuburbPeer::getSameSuburb($values['name'], $values['postcode']);
            //sfContext::getInstance()->getLogger()->log($suburb->getId());
            if ($suburb instanceof Suburb) {

                sfContext::getInstance()->getLogger()->log("Replacing suburb with old one.");

                $this->object = $suburb;
            }

            //print_r($this->getObject());
            //throw new Exception('poo');


    }

}
