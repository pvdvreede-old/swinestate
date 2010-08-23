<?php

/**
 * ListingMetadataValue form base class.
 *
 * @method ListingMetadataValue getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseListingMetadataValueForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'metadata_column_id' => new sfWidgetFormPropelChoice(array('model' => 'ListingMetadataColumn', 'add_empty' => false)),
      'listing_id'         => new sfWidgetFormPropelChoice(array('model' => 'Listing', 'add_empty' => false)),
      'value'              => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'metadata_column_id' => new sfValidatorPropelChoice(array('model' => 'ListingMetadataColumn', 'column' => 'id')),
      'listing_id'         => new sfValidatorPropelChoice(array('model' => 'Listing', 'column' => 'id')),
      'value'              => new sfValidatorString(array('max_length' => 2000)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listing_metadata_value[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListingMetadataValue';
  }


}
