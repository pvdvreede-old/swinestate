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
        1 => '1+',
        2 => '2+',
        3 => '3+',
        4 => '4+');
    private static $bathroom_choices = array(0 => 'Any',
        1 => '1+',
        2 => '2+');

    public function configure() {

        // order by name column for listing type
        $list_criteria = new Criteria();
        $list_criteria->addAscendingOrderByColumn(PropertyTypePeer::NAME);

        $this->setWidgets(array(
            'suburb' => new sfWidgetFormInputText(),
            'property_type' => new sfWidgetFormPropelChoice(array(
                'model' => 'PropertyType',
                'criteria' => $list_criteria,
                'expanded' => true,
                'multiple' => 'true')
            ),
            'bedrooms' => new sfWidgetFormChoice(array(
                'choices' => self::$bathroom_choices
            )),
            'bathrooms' => new sfWidgetFormChoice(array(
                'choices' => self::$bathroom_choices
            )),
            'min_price' => new sfWidgetFormInputText(),
            'max_price' => new sfWidgetFormInputText()
        ));

        $this->setValidators(array(
            'suburb' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
            'property_type' => new sfValidatorPropelChoice(array('model' => 'PropertyType', 'column' => 'id', 'required' => false, 'multiple' => 'true')),
            'bedrooms' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false)),
            'bathrooms' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false)),
            'min_price' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false)),
            'max_price' => new sfValidatorInteger(array('min' => 0, 'max' => 2147483647, 'required' => false))
        ));

        // check that the user types in a max price that is greater than the min if they are both there
        $this->validatorSchema->setPostValidator(
                new sfValidatorSchemaCompare('max_price', '>=', 'min_price', array(), array())
        );

        $this->widgetSchema->setNameFormat('search[%s]');

        $this->disableLocalCSRFProtection();
    }

}

?>
