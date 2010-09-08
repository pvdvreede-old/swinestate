<?php

/**
 * Listing filter form base class.
 *
 * @package    SWINESTATE
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseListingFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'listing_type_id'   => new sfWidgetFormPropelChoice(array('model' => 'ListingType', 'add_empty' => true)),
      'property_type_id'  => new sfWidgetFormPropelChoice(array('model' => 'PropertyType', 'add_empty' => true)),
      'listing_status_id' => new sfWidgetFormPropelChoice(array('model' => 'ListingStatus', 'add_empty' => true)),
      'address_id'        => new sfWidgetFormPropelChoice(array('model' => 'Address', 'add_empty' => true)),
      'sale_details_id'   => new sfWidgetFormPropelChoice(array('model' => 'SaleDetails', 'add_empty' => true)),
      'rent_details_id'   => new sfWidgetFormPropelChoice(array('model' => 'RentDetails', 'add_empty' => true)),
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'bedrooms'          => new sfWidgetFormFilterInput(),
      'bathrooms'         => new sfWidgetFormFilterInput(),
      'car_spaces'        => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'user_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'listing_type_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ListingType', 'column' => 'id')),
      'property_type_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PropertyType', 'column' => 'id')),
      'listing_status_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ListingStatus', 'column' => 'id')),
      'address_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Address', 'column' => 'id')),
      'sale_details_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SaleDetails', 'column' => 'id')),
      'rent_details_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RentDetails', 'column' => 'id')),
      'name'              => new sfValidatorPass(array('required' => false)),
      'description'       => new sfValidatorPass(array('required' => false)),
      'bedrooms'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bathrooms'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'car_spaces'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
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
      'id'                => 'Number',
      'user_id'           => 'ForeignKey',
      'listing_type_id'   => 'ForeignKey',
      'property_type_id'  => 'ForeignKey',
      'listing_status_id' => 'ForeignKey',
      'address_id'        => 'ForeignKey',
      'sale_details_id'   => 'ForeignKey',
      'rent_details_id'   => 'ForeignKey',
      'name'              => 'Text',
      'description'       => 'Text',
      'bedrooms'          => 'Number',
      'bathrooms'         => 'Number',
      'car_spaces'        => 'Number',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
