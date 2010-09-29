<?php

/*
 * 	Class created to validate the photo uploads on the listing form
 *
 */

class MultiFileValidatorSchema extends sfValidatedFile {

    public function save($file = null, $fileMode = 0776, $create = true, $dirMode = 0777) {

        $full_dir = sfConfig::get('sf_upload_dir') . '/listings/';
        $thumb_dir = sfConfig::get('sf_upload_dir') . '/listings/thumb/';
        $med_dir = sfConfig::get('sf_upload_dir') . '/listings/med/';

        if (!is_writable($med_dir)) {
            // the directory isn't writable
            throw new Exception(sprintf('File upload path "%s" is not writable.', $med_dir));
        }

        if (!is_writable($thumb_dir)) {
            // the directory isn't writable
            throw new Exception(sprintf('File upload path "%s" is not writable.', $thumb_dir));
        }


        $return_value = parent::save($file, $fileMode, $create, $dirMode);
        sfContext::getInstance()->getLogger()->info($full_dir . $return_value);

        // create thumbnail size
        $thumb = new sfThumbnail(120);

        $thumb->loadFile($full_dir . $return_value);

        $thumb->save($thumb_dir . $return_value);

        // create medium size
        $thumb = new sfThumbnail(600);

        $thumb->loadFile($full_dir . $return_value);

        $thumb->save($med_dir . $return_value);

        return $return_value;
    }

}