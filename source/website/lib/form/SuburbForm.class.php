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

    // override the save function so that if the postcode and suburb name already exist, then just use that object
    public function save($con = null) {

        if (!$this->isValid()) {
            throw $this->getErrorSchema();
        }

        sfContext::getInstance()->getLogger()->log('in new save');

        $suburb = SuburbPeer::getSameSuburb($name, $postcode);
        sfContext::getInstance()->getLogger()->log('getting new suburb');
        if (!$suburb) {
            sfContext::getInstance()->getLogger()->log('change the suburb');
            $this->object = $suburb;
        }

        return parent::save($con);
    }

}
