<?php

/**
 * ListingPhotos form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class ListingPhotosForm extends BaseListingPhotosForm
{
  public function configure()
  {
      $this->useFields(array(
          'caption',
          'path'
      ));

      // set the file upload type for the form
      $this->setWidget('path', new sfWidgetFormInputFile());

      // set the validator to be a file
      $this->setValidator('path', new sfValidatorFile(array(
          // only allow images as the files that can be uploaded
          'mime_types' => 'web_images',
          // the path where the files are uploaded
          'path' => sfConfig::get('sf_upload_dir').'/listings',
          'required' => false
      )));

  }
}
