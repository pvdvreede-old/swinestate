<?php

/**
 * Settings filter form base class.
 *
 * @package    SWINESTATE
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseSettingsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'  => new sfWidgetFormFilterInput(),
      'name'  => new sfWidgetFormFilterInput(),
      'value' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'type'  => new sfValidatorPass(array('required' => false)),
      'name'  => new sfValidatorPass(array('required' => false)),
      'value' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('settings_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Settings';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'type'  => 'Text',
      'name'  => 'Text',
      'value' => 'Text',
    );
  }
}
