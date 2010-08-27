<?php

/**
 * ListingMetadataColumn filter form base class.
 *
 * @package    SWINESTATE
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseListingMetadataColumnFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'listing_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ListingType', 'add_empty' => true)),
      'code'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'label'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value_type'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'required'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'min_length'      => new sfWidgetFormFilterInput(),
      'max_length'      => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'listing_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ListingType', 'column' => 'id')),
      'code'            => new sfValidatorPass(array('required' => false)),
      'label'           => new sfValidatorPass(array('required' => false)),
      'value_type'      => new sfValidatorPass(array('required' => false)),
      'required'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'min_length'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'max_length'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('listing_metadata_column_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListingMetadataColumn';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'listing_type_id' => 'ForeignKey',
      'code'            => 'Text',
      'label'           => 'Text',
      'value_type'      => 'Text',
      'required'        => 'Boolean',
      'min_length'      => 'Number',
      'max_length'      => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
