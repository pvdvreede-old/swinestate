<?php

/**
 * ListingMetadataValue filter form base class.
 *
 * @package    SWINESTATE
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseListingMetadataValueFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'metadata_column_id' => new sfWidgetFormPropelChoice(array('model' => 'ListingMetadataColumn', 'add_empty' => true)),
      'listing_id'         => new sfWidgetFormPropelChoice(array('model' => 'Listing', 'add_empty' => true)),
      'value'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'metadata_column_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ListingMetadataColumn', 'column' => 'id')),
      'listing_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Listing', 'column' => 'id')),
      'value'              => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('listing_metadata_value_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListingMetadataValue';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'metadata_column_id' => 'ForeignKey',
      'listing_id'         => 'ForeignKey',
      'value'              => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
