<?php

/**
 * Alert filter form base class.
 *
 * @package    SWINESTATE
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseAlertFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bedrooms'               => new sfWidgetFormFilterInput(),
      'bathrooms'              => new sfWidgetFormFilterInput(),
      'car_spaces'             => new sfWidgetFormFilterInput(),
      'suburb'                 => new sfWidgetFormFilterInput(),
      'postcode'               => new sfWidgetFormFilterInput(),
      'min_price'              => new sfWidgetFormFilterInput(),
      'max_price'              => new sfWidgetFormFilterInput(),
      'alert_property_type_id' => new sfWidgetFormPropelChoice(array('model' => 'AlertPropertyType', 'add_empty' => true)),
      'amount_alerted'         => new sfWidgetFormFilterInput(),
      'active'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'user_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'name'                   => new sfValidatorPass(array('required' => false)),
      'bedrooms'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bathrooms'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'car_spaces'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'suburb'                 => new sfValidatorPass(array('required' => false)),
      'postcode'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'min_price'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'max_price'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'alert_property_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AlertPropertyType', 'column' => 'id')),
      'amount_alerted'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'active'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('alert_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Alert';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'user_id'                => 'ForeignKey',
      'name'                   => 'Text',
      'bedrooms'               => 'Number',
      'bathrooms'              => 'Number',
      'car_spaces'             => 'Number',
      'suburb'                 => 'Text',
      'postcode'               => 'Number',
      'min_price'              => 'Number',
      'max_price'              => 'Number',
      'alert_property_type_id' => 'ForeignKey',
      'amount_alerted'         => 'Number',
      'active'                 => 'Boolean',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
