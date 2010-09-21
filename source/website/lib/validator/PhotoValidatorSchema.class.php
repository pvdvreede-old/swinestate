<?php

/*
 * 	Class created to validate the photo uploads on the listing form
 *
 */

class PhotoValidatorSchema extends sfValidatorSchema {

    protected function configure($options = array(), $messages = array()) {
        $this->addMessage('caption', 'The caption is required.');
        $this->addMessage('path', 'The filename is required.');
    }

    protected function doClean($values) {
        $errorSchema = new sfValidatorErrorSchema($this);

        foreach ($values as $key => $value) {
            $errorSchemaLocal = new sfValidatorErrorSchema($this);

            // filename is filled but no caption
            if ($value['path'] && !$value['caption']) {
                $errorSchemaLocal->addError(new sfValidatorError($this, 'required'), 'caption');
            }

            // caption is filled but no filename
//            if ($value['caption'] && !$value['path'] && $this->) {
//                $errorSchemaLocal->addError(new sfValidatorError($this, 'required'), 'filename');
//            }

            sfContext::getInstance()->getLogger()->info($value['path']);
            sfContext::getInstance()->getLogger()->info($value['caption']);

            // no caption and no filename, remove the empty values
            if (!$value['path'] && !$value['caption']) {
                unset($values[$key]);
            }

            // some error for this embedded-form
            if (count($errorSchemaLocal)) {
                $errorSchema->addError($errorSchemaLocal, (string) $key);
            }
        }

        $values['photos_3']['caption'] = 'testing shit';
        sfContext::getInstance()->getLogger()->info($values['photos_3']['caption']);
        
        // throws the error for the main form
        if (count($errorSchema)) {
            throw new sfValidatorErrorSchema($this, $errorSchema);
        }

        return $values;
    }

}