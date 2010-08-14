<?php

/**
 * Listing form base class.
 *
 * @method Listing getObject() Returns the current form's model object
 *
 * @package    swinestate-pt
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseListingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'listing_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ListingType', 'add_empty' => false)),
      'action_type_id'  => new sfWidgetFormPropelChoice(array('model' => 'ActionType', 'add_empty' => false)),
      'address_id'      => new sfWidgetFormPropelChoice(array('model' => 'Address', 'add_empty' => false)),
      'name'            => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormInputText(),
      'bedrooms'        => new sfWidgetFormInputText(),
      'bathrooms'       => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'listing_type_id' => new sfValidatorPropelChoice(array('model' => 'ListingType', 'column' => 'id')),
      'action_type_id'  => new sfValidatorPropelChoice(array('model' => 'ActionType', 'column' => 'id')),
      'address_id'      => new sfValidatorPropelChoice(array('model' => 'Address', 'column' => 'id')),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'description'     => new sfValidatorString(array('max_length' => 2000)),
      'bedrooms'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'bathrooms'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listing[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Listing';
  }


}
