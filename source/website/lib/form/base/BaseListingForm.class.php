<?php

/**
 * Listing form base class.
 *
 * @method Listing getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseListingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'listing_type_id'   => new sfWidgetFormPropelChoice(array('model' => 'ListingType', 'add_empty' => false)),
      'property_type_id'  => new sfWidgetFormPropelChoice(array('model' => 'PropertyType', 'add_empty' => false)),
      'listing_status_id' => new sfWidgetFormPropelChoice(array('model' => 'ListingStatus', 'add_empty' => false)),
      'address_id'        => new sfWidgetFormPropelChoice(array('model' => 'Address', 'add_empty' => false)),
      'sale_details_id'   => new sfWidgetFormPropelChoice(array('model' => 'SaleDetails', 'add_empty' => true)),
      'rent_details_id'   => new sfWidgetFormPropelChoice(array('model' => 'RentDetails', 'add_empty' => true)),
      'name'              => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormTextarea(),
      'bedrooms'          => new sfWidgetFormInputText(),
      'bathrooms'         => new sfWidgetFormInputText(),
      'car_spaces'        => new sfWidgetFormInputText(),
      'alert_activated'   => new sfWidgetFormInputCheckbox(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'listing_type_id'   => new sfValidatorPropelChoice(array('model' => 'ListingType', 'column' => 'id')),
      'property_type_id'  => new sfValidatorPropelChoice(array('model' => 'PropertyType', 'column' => 'id')),
      'listing_status_id' => new sfValidatorPropelChoice(array('model' => 'ListingStatus', 'column' => 'id')),
      'address_id'        => new sfValidatorPropelChoice(array('model' => 'Address', 'column' => 'id')),
      'sale_details_id'   => new sfValidatorPropelChoice(array('model' => 'SaleDetails', 'column' => 'id', 'required' => false)),
      'rent_details_id'   => new sfValidatorPropelChoice(array('model' => 'RentDetails', 'column' => 'id', 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255)),
      'description'       => new sfValidatorString(),
      'bedrooms'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'bathrooms'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'car_spaces'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'alert_activated'   => new sfValidatorBoolean(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listing[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Listing';
  }


}
