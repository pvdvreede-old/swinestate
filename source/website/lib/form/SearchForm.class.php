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
                                             2 => '2+'  );

    public function configure() {

        // order by name column for listing type
        $list_criteria = new Criteria();
        $list_criteria->addAscendingOrderByColumn(PropertyTypePeer::NAME);

        $this->setWidgets(array(
            'suburb' => new sfWidgetFormInputText(),
            'listing_type' => new sfWidgetFormPropelChoice(array(
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
            ))
        ));



    }

}
?>
