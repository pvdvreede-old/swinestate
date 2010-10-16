<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SearchForm
 *
 * @author paul
 */
class SearchForm extends sfForm {

    private static $bedrooms_choices = array(0 => 'Any',
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7');
    private static $bathroom_choices = array(0 => 'Any',
        1 => '1+',
        2 => '2+');

    public function configure() {

        // order by name column for listing type
        $list_criteria = new Criteria();
        $list_criteria->addAscendingOrderByColumn(PropertyTypePeer::NAME);

        $suburb_criteria = new Criteria();

        $this->setWidgets(array(
            'suburb' => new sfWidgetFormPropelChoice(array(
                'model' => 'PropertyType',
            )),
            'property_type' => new sfWidgetFormPropelChoice(array(
                'model' => 'PropertyType',
                'criteria' => $list_criteria,
                'expanded' => true,
                'multiple' => 'true')
            ),
            'bedrooms' => new sfWidgetFormChoice(array(
                'choices' => self::$bedrooms_choices
            )),
            'bathrooms' => new sfWidgetFormChoice(array(
                'choices' => self::$bedrooms_choices
            )),
            'car_spaces' => new sfWidgetFormChoice(array(
                'choices' => self::$bedrooms_choices
            )),
            'min_price' => new sfWidgetFormInputText(),
            'max_price' => new sfWidgetFormInputText(),
            'postcode' => new sfWidgetFormInputText()
        ));

        $this->setValidators(array(
            'suburb' => new sfValidatorPropelChoice(array('model' => 'Suburb', 'column' => 'id', 'required' => false, 'multiple' => 'true')),
            'property_type' => new sfValidatorPropelChoice(array('model' => 'PropertyType', 'column' => 'id', 'required' => false, 'multiple' => 'true')),
            'bedrooms' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false)),
            'bathrooms' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false)),
            'car_spaces' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false)),
            'min_price' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false)),
            'max_price' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false)),
            'postcode' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false))
        ));

        // check that the user types in a max price that is greater than the min if they are both there
        $this->validatorSchema->setPostValidator(
                new MinMaxValidatorSchema('min_price', 'max_price', array(), array())
        );

        // set options for ajax autocomplete    
        $this->widgetSchema['suburb']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
        $this->widgetSchema['suburb']->setOption('renderer_options', array(
            'model' => 'Suburb',
            'url' => $this->getOption('url'),
        ));

        $this->widgetSchema->setNameFormat('search[%s]');

        $this->disableLocalCSRFProtection();
    }

}

?>
