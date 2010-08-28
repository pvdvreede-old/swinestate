<?php

/**
 * ListingPhotos filter form base class.
 *
 * @package    SWINESTATE
 * @subpackage filter
 * @author     Paul Van de Vreede
 */
abstract class BaseListingPhotosFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'listing_id' => new sfWidgetFormPropelChoice(array('model' => 'Listing', 'add_empty' => true)),
      'path'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'caption'    => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'listing_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Listing', 'column' => 'id')),
      'path'       => new sfValidatorPass(array('required' => false)),
      'caption'    => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('listing_photos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListingPhotos';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'listing_id' => 'ForeignKey',
      'path'       => 'Text',
      'caption'    => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
