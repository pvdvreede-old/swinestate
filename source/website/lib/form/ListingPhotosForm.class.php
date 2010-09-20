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

        //$this->getWidget('caption')->setOption('required', true);

        // set the validator to be a file
        $this->setWidget('path', new sfWidgetFormInputFileEditable(array(
                    'file_src' => sfContext::getInstance()->getRequest()->getUriPrefix().sfContext::getInstance()->getRequest()->getRelativeUrlRoot().'/uploads/listings/'. $this->getObject()->getPath(),
                    'edit_mode' => !$this->isNew(),
                    'is_image' => true,
                    'with_delete' => true,
                    'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>'
                ), array(
                    'class' => 'listing_img'
                )));


        $this->setValidator('path', new sfValidatorFile(array(
                    'mime_types' => 'web_images',
                    'path' => sfConfig::get('sf_upload_dir').'/listings/',
                    'required' => false,
                )));

        $this->setValidator('path_delete', new sfValidatorBoolean());
    }


}
