<?php

/**
 * Suburb form base class.
 *
 * @method Suburb getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseSuburbForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'postcode'   => new sfWidgetFormInputText(),
      'state'      => new sfWidgetFormInputText(),
      'country_id' => new sfWidgetFormPropelChoice(array('model' => 'Country', 'add_empty' => false, 'key_method' => 'getIso')),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 100)),
      'postcode'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'state'      => new sfValidatorString(array('max_length' => 3)),
      'country_id' => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'iso')),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('suburb[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Suburb';
  }


}
