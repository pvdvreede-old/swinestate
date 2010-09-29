<?php

/**
 * Country form base class.
 *
 * @method Country getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseCountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'iso'          => new sfWidgetFormInputText(),
      'name'         => new sfWidgetFormInputText(),
      'display_name' => new sfWidgetFormInputText(),
      'iso3'         => new sfWidgetFormInputText(),
      'numcode'      => new sfWidgetFormInputText(),
      'id'           => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'iso'          => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'display_name' => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'iso3'         => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'numcode'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }


}
