<?php

/**
 * ListingPhotos form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class ListingPhotosForm extends BaseListingPhotosForm {

    public function configure() {

        $this->useFields(array(
            'caption',
            'path'
        ));

        // set the validator to be a file
        $this->setWidget('path', new sfWidgetFormInputFileEditable(array(
                    'file_src' => 'http://localhost/swinestate2/web/uploads/listings/' . $this->getObject()->getPath(),
                    'edit_mode' => !$this->isNew(),
                    'is_image' => true,
                    'with_delete' => true,
                )));


        $this->setValidator('path', new sfValidatorFile(array(
                    'mime_types' => 'web_images',
                    'path' => '/uploads/listings/',
                    'required' => false,
                )));
    }

}
