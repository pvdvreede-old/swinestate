<?php

/**
 * Listing form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class ListingForm extends BaseListingForm
{
  public function configure()
  {

      // set the widget for the description to the text editor
      $this->widgetSchema['description'] = new sfWidgetFormTextareaTinyMCE(array(
          'width' => 550,
          'height' => 300,
          'config' =>'theme_advanced_disable: ""'
      ));

      // when there is an edit we need to get the address from the db
      if (!$this->getObject()->isNew()) {
          $address = $this->getObject()->getAddress();
		  $videos = $this->getObject()->getListingVideos();
		  $video = $videos[0];
      } else {
         // create an address database object and link to the form
          $address = new Address();
		  $video = new ListingVideo();
      }
      
      $address->addListing($this->getObject());

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
      $this->useFields($fields);

  }

  public function saveEmbeddedForms($con = null, $forms = null) {
        throw new Exception('prin');
      // if any of the photos arent filled in then dont insert them in the database
      if ($forms === NULL) {

          $photos = $this->getValue('photos');
          $forms = $this->embeddedForms;
          
          // loop through all the photo forms and if they are not filled in remove them from saving
          foreach ($this->embeddedForms['photos'] as $name => $form) {

              if (!isset($photos[$name]) || $photos[$name]['path'] == '') {

                  unset($forms['photos'][$name]);

              }

          }

      }

      return parent::saveEmbeddedForms($con, $forms);
  }

 
}
