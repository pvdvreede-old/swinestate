<?php

/**
 * SaleDetails filter form base class.
 *
 * @package    SWINESTATE
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseSaleDetailsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'listing_id'   => new sfWidgetFormPropelChoice(array('model' => 'Listing', 'add_empty' => true)),
      'asking_price' => new sfWidgetFormFilterInput(),
      'actual_price' => new sfWidgetFormFilterInput(),
      'auction_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'listing_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Listing', 'column' => 'id')),
      'asking_price' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'actual_price' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'auction_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sale_details_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SaleDetails';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'listing_id'   => 'ForeignKey',
      'asking_price' => 'Number',
      'actual_price' => 'Number',
      'auction_date' => 'Date',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
