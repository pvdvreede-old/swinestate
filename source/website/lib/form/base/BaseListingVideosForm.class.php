<?php

/**
 * ListingVideos form base class.
 *
 * @method ListingVideos getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseListingVideosForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'listing_id' => new sfWidgetFormPropelChoice(array('model' => 'Listing', 'add_empty' => false)),
      'url'        => new sfWidgetFormInputText(),
      'caption'    => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'listing_id' => new sfValidatorPropelChoice(array('model' => 'Listing', 'column' => 'id')),
      'url'        => new sfValidatorString(array('max_length' => 1000)),
      'caption'    => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listing_videos[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListingVideos';
  }


}
