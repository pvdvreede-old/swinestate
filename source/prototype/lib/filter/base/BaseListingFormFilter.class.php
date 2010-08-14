<?php

/**
 * Listing filter form base class.
 *
 * @package    swinestate-pt
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseListingFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'listing_type_id' => new sfWidgetFormPropelChoice(array('model' => 'ListingType', 'add_empty' => true)),
      'action_type_id'  => new sfWidgetFormPropelChoice(array('model' => 'ActionType', 'add_empty' => true)),
      'address_id'      => new sfWidgetFormPropelChoice(array('model' => 'Address', 'add_empty' => true)),
      'name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bedrooms'        => new sfWidgetFormFilterInput(),
      'bathrooms'       => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'listing_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ListingType', 'column' => 'id')),
      'action_type_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ActionType', 'column' => 'id')),
      'address_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Address', 'column' => 'id')),
      'name'            => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'bedrooms'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bathrooms'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('listing_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Listing';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'listing_type_id' => 'ForeignKey',
      'action_type_id'  => 'ForeignKey',
      'address_id'      => 'ForeignKey',
      'name'            => 'Text',
      'description'     => 'Text',
      'bedrooms'        => 'Number',
      'bathrooms'       => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
