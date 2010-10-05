<?php

/*
 * 	Class created to validate the photo uploads on the listing form
 *
 */

class MinMaxValidatorSchema extends sfValidatorSchema {

    public function __construct($leftField, $rightField, $options = array(), $messages = array()) {
        $this->addOption('left_field', $leftField);
        $this->addOption('right_field', $rightField);

        $this->addOption('throw_global_error', false);

        parent::__construct(null, $options, $messages);
    }

    protected function configure($options = array(), $messages = array()) {
        $this->addMessage('left_field', 'The min is not set properly');
        $this->addMessage('right_field', 'The max is not set properly.');
    }

    protected function doClean($values) {

        $errorSchemaLocal = new sfValidatorErrorSchema($this);

        if (null === $values) {
            $values = array();
        }

        if (!is_array($values)) {
            throw new InvalidArgumentException('You must pass an array parameter to the clean() method');
        }

        $leftValue = isset($values[$this->getOption('left_field')]) ? $values[$this->getOption('left_field')] : null;
        $rightValue = isset($values[$this->getOption('right_field')]) ? $values[$this->getOption('right_field')] : null;


        if ($leftValue != null || ($rightValue != null)) {

            if ($rightValue != null && $leftValue > $rightValue) {

                $errorSchemaLocal->addError(new sfValidatorError($this, 'The min price cannot be smaller than the max price'), 'left_field');

            }

        } else {

            unset($values[$this->getOption('right_field')]);
            unset($values[$this->getOption('left_field')]);

        }

        // throws the error for the main form
        if (count($errorSchemaLocal)) {
            throw new sfValidatorErrorSchema($this, $errorSchemaLocal);
        }

        return $values;
    }

}