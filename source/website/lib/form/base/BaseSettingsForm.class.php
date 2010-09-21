<?php

/**
 * Settings form base class.
 *
 * @method Settings getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseSettingsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'type'  => new sfWidgetFormInputText(),
      'name'  => new sfWidgetFormInputText(),
      'value' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'type'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'name'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'value' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('settings[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Settings';
  }


}
