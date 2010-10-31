<?php

/**
 * Listing form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class ListingForm extends BaseListingForm {

    /**
     * ListingForm::configure()
     * 
     * @return
     */
    /**
     * ListingForm::configure()
     * 
     * @return
     */
    public function configure() {

        // set the widget for the description to the text editor
        $this->widgetSchema['description'] = new sfWidgetFormTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 300,
                    'config' => 'theme_advanced_disable: ""'
                ));

        // when there is an edit we need to get the address from the db
        if (!$this->getObject()->isNew()) {
            $address = $this->getObject()->getAddress();
            $videos = $this->getObject()->getListingVideoss();
            $video = $videos[0];
        } else {
            // create an address database object and link to the form
            $address = new Address();
            $video = new ListingVideos();
        }

        $address->addListing($this->getObject());
        $video->setListing($this->getObject());
        // create address form to embed in this form
        $address_form = new AddressForm($address);

        $this->embedForm('address', $address_form);

        $photos_form = new PhotosCollectionForm(null, array(
                    'listing' => $this->getObject(),
                    'size' => 5
                ));

        $this->embedForm('photos', $photos_form);

        // embed video form to put in listing, there is only one link to you tube
        $video_form = new ListingVideosForm($video);
        $this->embedForm('video', $video_form);

        $fields = array(
            'name',
            'property_type_id',
            'description',
            'address',
            'bedrooms',
            'bathrooms',
            'car_spaces',
            'photos',
            'video'
        );

        // if its an update then add in the listing status to be changed
        if (!$this->getObject()->isNew()) {

            $fields[] = 'listing_status_id';
        }

        // only use certain fields for the form
        $this->removeFields($fields);

        // Add *  to our required fields
        foreach ($this->getFormFieldSchema()->getWidget()->getFields() as $key => $object) {
            $label = $this->getFormFieldSchema()->offsetGet($key)->renderLabelName();
            if ($this->validatorSchema[$key]->getOption('required') == true && ($label != 'Photos' && $label != 'Video')) {
                $this->widgetSchema->setLabel($key, $label . " *");
            }
        }
    }

    /**
     * ListingForm::removeFields()
     * 
     * @param mixed $fields
     * @return
     */
    /**
     * ListingForm::removeFields()
     * 
     * @param mixed $fields
     * @return
     */
    protected function removeFields($fields = null)
    {
        $this->useFields($fields);
    }

    /**
     * ListingForm::doUpdateObject()
     * 
     * @param mixed $values
     * @return
     */
    /**
     * ListingForm::doUpdateObject()
     * 
     * @param mixed $values
     * @return
     */
    protected function doUpdateObject($values) {
        parent::doUpdateObject($values);
        sfContext::getInstance()->getLogger()->log("Running custom save for address form.");



        //if ($this->getObject()->isNew()) {

            sfContext::getInstance()->getLogger()->log("Inside suburb check. ".$values['address']['suburb']['name'].$values['address']['suburb']['postcode']);

            $suburb = SuburbPeer::getSameSuburb($values['address']['suburb']['name'], $values['address']['suburb']['postcode']);
            //sfContext::getInstance()->getLogger()->log($suburb->getId());
            if ($suburb instanceof Suburb) {

                sfContext::getInstance()->getLogger()->log("Replacing suburb with old one.");

                $this->getObject()->getAddress()->setSuburbId($suburb->getId());
                $this->getObject()->getAddress()->setSuburb($suburb);
            }

            //print_r($this->getObject());
            //throw new Exception('poo');


    }

    /**
     * ListingForm::saveEmbeddedForms()
     * 
     * @param mixed $con
     * @param mixed $forms
     * @return
     */
    /**
     * ListingForm::saveEmbeddedForms()
     * 
     * @param mixed $con
     * @param mixed $forms
     * @return
     */
    public function saveEmbeddedForms($con = null, $forms = null) {




        // if any of the photos arent filled in then dont insert them in the database
        if ($forms === NULL) {

            $photos = $this->getValue('photos');
            $forms = $this->embeddedForms;

            // loop through all the photo forms and if they are not filled in remove them from saving
            foreach ($this->embeddedForms['photos'] as $name => $form) {
                sfContext::getInstance()->getLogger()->info($name);
                if (!isset($photos[$name])) {

                    unset($forms['photos'][$name]);
                    sfContext::getInstance()->getLogger()->info('unset');
                }
            }
        }

        return parent::saveEmbeddedForms($con, $forms);
    }

}
