<?php

/**
 * Address form base class.
 *
 * @method Address getObject() Returns the current form's model object
 *
 * @package    swinestate-pt
 * @subpackage form
 * @author     Paul Van de Vreede
 */
abstract class BaseAddressForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'suburb_id'     => new sfWidgetFormPropelChoice(array('model' => 'Suburb', 'add_empty' => false)),
      'street_number' => new sfWidgetFormInputText(),
      'street_name'   => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'suburb_id'     => new sfValidatorPropelChoice(array('model' => 'Suburb', 'column' => 'id')),
      'street_number' => new sfValidatorString(array('max_length' => 10)),
      'street_name'   => new sfValidatorString(array('max_length' => 255)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('address[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Address';
  }


}
