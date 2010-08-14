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

    public function configure() {

        // order by name column for listing type
        $list_criteria = new Criteria();
        $list_criteria->addAscendingOrderByColumn(ListingTypePeer::NAME);

        $this->setWidgets(array(
            'search' => new sfWidgetFormInputText(),
            'listing_type' => new sfWidgetFormPropelChoice(array(
                'model' => 'ListingType',
           
                'criteria' => $list_criteria
            )))
        );
    }

}

?>
