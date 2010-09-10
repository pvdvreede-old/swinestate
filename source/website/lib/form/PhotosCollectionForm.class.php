<?php

/**
 * ListingPhotos form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class PhotosCollectionForm extends sfForm
{
  public function configure()
  {
      // must provide a listing object with the form
      if (!$listing = $this->getOption('listing')) {

          throw new InvalidArgumentException('You must provide a listing to this form');

      }

      // loop through and embed a ListingPhotos form into this one so users can upload more than one photo
      for ($i = 1; $i < $this->getOption('size' + 1, 6); $i++) {

          // create a new photo object and add it to the listing
          $photo = new ListingPhotos();

          $photo->setListing($listing);

          // create a new listing form and add the photo object to it for saving later
          $form = new ListingPhotosForm($photo);

          // embed the single form into this
          $this->embedForm('photo_'.$i, $form);
      }

  }
}