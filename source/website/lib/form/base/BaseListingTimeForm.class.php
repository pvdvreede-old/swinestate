<?php

/**
 * ListingTime form base class.
 *
 * @method ListingTime getObject() Returns the current form's model object
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseListingTimeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'listing_id'         => new sfWidgetFormPropelChoice(array('model' => 'Listing', 'add_empty' => false, 'default' => 6)),
      'start_date'         => new sfWidgetFormDateTime(),
      'end_date'           => new sfWidgetFormDateTime(),
      'payment_status'     => new sfWidgetFormInputText(),
      'total_paid'         => new sfWidgetFormInputText(),
      'payer_account_name' => new sfWidgetFormInputText(),
      'payment_date'       => new sfWidgetFormDateTime(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'            => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'listing_id'         => new sfValidatorPropelChoice(array('model' => 'Listing', 'column' => 'id')),
      'start_date'         => new sfValidatorDateTime(array('required' => false)),
      'end_date'           => new sfValidatorDateTime(array('required' => false)),
      'payment_status'     => new sfValidatorString(array('max_length' => 10)),
      'total_paid'         => new sfValidatorNumber(array('required' => false)),
      'payer_account_name' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'payment_date'       => new sfValidatorDateTime(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('listing_time[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListingTime';
  }


}
