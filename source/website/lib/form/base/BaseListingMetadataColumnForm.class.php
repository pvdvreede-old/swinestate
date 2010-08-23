<?php

/**
 * ListingMetadataColumn form base class.
 *
 * @method ListingMetadataColumn getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseListingMetadataColumnForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'listing_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ListingType', 'add_empty' => false)),
      'code'            => new sfWidgetFormInputText(),
      'label'           => new sfWidgetFormInputText(),
      'value_type'      => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'listing_type_id' => new sfValidatorPropelChoice(array('model' => 'ListingType', 'column' => 'id')),
      'code'            => new sfValidatorString(array('max_length' => 25)),
      'label'           => new sfValidatorString(array('max_length' => 255)),
      'value_type'      => new sfValidatorString(array('max_length' => 255)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listing_metadata_column[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListingMetadataColumn';
  }


}
