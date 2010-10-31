<?php

/**
 * ListingTime form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class ListingTimeForm extends BaseListingTimeForm
{
    /**
     * ListingTimeForm::configure()
     * 
     * @return
     */
    public function configure()
    {

        $this->widgetSchema['start_date'] = new sfWidgetFormJQueryDate(array('config' =>
            '{minDate: +0}'));

        $this->widgetSchema['end_date'] = new sfWidgetFormJQueryDate(array('config' =>
            '{minDate: +1}'));

        $this->removeFields();

        $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('start_date',
            '<', 'end_date', array(), array()));
    }

    /**
     * ListingTimeForm::removeFields()
     * 
     * @return
     */
    protected function removeFields()
    {
        $this->useFields(array('listing_id', 'start_date', 'end_date'));
    }
}
