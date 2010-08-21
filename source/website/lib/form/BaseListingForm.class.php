<?php

/**
 * Description of SearchForm
 *
 * @author paul
 */
class BaseListingForm extends sfForm {

    private static $room_choices = array(
        0 => '0',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5');

    public function configure($listing = null) {

        $this->setWidgets(array(
            'name' => new sfWidgetFormInputText(),
            'description' => new sfWidgetFormTextareaTinyMCE(array(
                'width' => 750,
                'height' => 350,
                'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
            )),
            'property_type' => new sfWidgetFormPropelChoice(array(
                'model' => 'PropertyType'
            )),
            'bedrooms' => new sfWidgetFormChoice(array(
                'choices' => self::$room_choices)),
            'bathrooms' => new sfWidgetFormChoice(array(
                'choices' => self::$room_choices)),
            'carspaces' => new sfWidgetFormChoice(array(
                'choices' => self::$room_choices)),
            'unit_number' => new sfWidgetFormInputText(),
            'street_number' => new sfWidgetFormInputText(),
            'street_name' => new sfWidgetFormInputText(),
            'suburb' => new sfWidgetFormInputText(),
            'postcode' => new sfWidgetFormInputText(),
            'state' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'name' => new sfValidatorString(array('min_length' => 3)),
            'description' => new sfValidatorString(array('min_length' => 3)),
            'property_type' => new sfValidatorString(array('min_length' => 6))
        ));


        if ($listing != null) {

            $this->widgetSchema['name']->addOption('default', $listing->getName());
            $this->widgetSchema['description']->addOption('default', $listing->getDescription());
            $this->widgetSchema['property_type']->addOption('default', $listing->getPropertyType());
        }

        $this->widgetSchema->setNameFormat('listing[%s]');
    }

}
