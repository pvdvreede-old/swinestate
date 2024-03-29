<?php

/**
 * Alert form base class.
 *
 * @method Alert getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseAlertForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'name'                   => new sfWidgetFormInputText(),
      'listing_type_id'        => new sfWidgetFormPropelChoice(array('model' => 'ListingType', 'add_empty' => false)),
      'bedrooms'               => new sfWidgetFormInputText(),
      'bathrooms'              => new sfWidgetFormInputText(),
      'car_spaces'             => new sfWidgetFormInputText(),
      'suburb'                 => new sfWidgetFormInputText(),
      'postcode'               => new sfWidgetFormInputText(),
      'min_price'              => new sfWidgetFormInputText(),
      'max_price'              => new sfWidgetFormInputText(),
      'alert_property_type_id' => new sfWidgetFormPropelChoice(array('model' => 'AlertPropertyType', 'add_empty' => true)),
      'amount_alerted'         => new sfWidgetFormInputText(),
      'active'                 => new sfWidgetFormInputCheckbox(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'                => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'name'                   => new sfValidatorString(array('max_length' => 100)),
      'listing_type_id'        => new sfValidatorPropelChoice(array('model' => 'ListingType', 'column' => 'id')),
      'bedrooms'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'bathrooms'              => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'car_spaces'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'suburb'                 => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'postcode'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'min_price'              => new sfValidatorNumber(array('required' => false)),
      'max_price'              => new sfValidatorNumber(array('required' => false)),
      'alert_property_type_id' => new sfValidatorPropelChoice(array('model' => 'AlertPropertyType', 'column' => 'id', 'required' => false)),
      'amount_alerted'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'active'                 => new sfValidatorBoolean(array('required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('alert[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Alert';
  }


}
