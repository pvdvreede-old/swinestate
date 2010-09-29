<?php

/**
 * Country filter form base class.
 *
 * @package    SWINESTATE
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseCountryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'iso'          => new sfWidgetFormFilterInput(),
      'name'         => new sfWidgetFormFilterInput(),
      'display_name' => new sfWidgetFormFilterInput(),
      'iso3'         => new sfWidgetFormFilterInput(),
      'numcode'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'iso'          => new sfValidatorPass(array('required' => false)),
      'name'         => new sfValidatorPass(array('required' => false)),
      'display_name' => new sfValidatorPass(array('required' => false)),
      'iso3'         => new sfValidatorPass(array('required' => false)),
      'numcode'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('country_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Country';
  }

  public function getFields()
  {
    return array(
      'iso'          => 'Text',
      'name'         => 'Text',
      'display_name' => 'Text',
      'iso3'         => 'Text',
      'numcode'      => 'Number',
      'id'           => 'Number',
    );
  }
}
