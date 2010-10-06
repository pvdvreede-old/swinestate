<?php

/**
 * AlertPropertyType filter form base class.
 *
 * @package    SWINESTATE
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseAlertPropertyTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'alert_id'         => new sfWidgetFormPropelChoice(array('model' => 'Alert', 'add_empty' => true)),
      'property_type_id' => new sfWidgetFormPropelChoice(array('model' => 'PropertyType', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'alert_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Alert', 'column' => 'id')),
      'property_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PropertyType', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('alert_property_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AlertPropertyType';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'alert_id'         => 'ForeignKey',
      'property_type_id' => 'ForeignKey',
    );
  }
}
