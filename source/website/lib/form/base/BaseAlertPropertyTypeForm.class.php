<?php

/**
 * AlertPropertyType form base class.
 *
 * @method AlertPropertyType getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseAlertPropertyTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'alert_id'         => new sfWidgetFormPropelChoice(array('model' => 'Alert', 'add_empty' => false)),
      'property_type_id' => new sfWidgetFormPropelChoice(array('model' => 'PropertyType', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'alert_id'         => new sfValidatorPropelChoice(array('model' => 'Alert', 'column' => 'id')),
      'property_type_id' => new sfValidatorPropelChoice(array('model' => 'PropertyType', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('alert_property_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AlertPropertyType';
  }


}
