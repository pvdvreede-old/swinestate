<?php

/**
 * Address filter form base class.
 *
 * @package    swinestate-pt
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseAddressFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'suburb_id'     => new sfWidgetFormPropelChoice(array('model' => 'Suburb', 'add_empty' => true)),
      'street_number' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'street_name'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'suburb_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Suburb', 'column' => 'id')),
      'street_number' => new sfValidatorPass(array('required' => false)),
      'street_name'   => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('address_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Address';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'suburb_id'     => 'ForeignKey',
      'street_number' => 'Text',
      'street_name'   => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
