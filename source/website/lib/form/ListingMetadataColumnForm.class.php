<?php

/**
 * ListingMetadataColumn form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class ListingMetadataColumnForm extends sfForm
{
  public function configure()
  {

      $c = new Criteria();
	  
	  // get all the columns in the database that relate to a sale
      $columns = ListingMetadataColumnPeer::doSelect($c);
	  
	  // for each of the columns add a form input and form validation depending on the data type
      foreach ($columns as $column) {

          switch($column->getValueType()) {
              case "STRING":
                  $widget = new sfWidgetFormInputText(array(
                      'label' => $column->getLabel()
                  ));
                  $validator = new sfValidatorString(array(
                      'min_length' => $column->getMinLength(),
                      'max_length' => $column->getMaxLength(),
                      'required' => $column->getRequired()
                  ));
                  break;

              case "DATE":
                  $widget = new sfWidgetFormDateTime(array(
                      'label' => $column->getLabel()
                  ));
                  $validator = new sfValidatorDateTime();
                  break;

              case "INT":
                  $widget = new sfWidgetFormInputText(array(
                      'label' => $column->getLabel()
                  ));
                  $validator = new sfValidatorInteger(array(
                      'min' => $column->getMinLength(),
                      'max' => $column->getMaxLength(),
                      'required' => $column->getRequired()
                  ));
                  break;

              case "FLOAT":
                  $widget = new sfWidgetFormInputText(array(
                      'label' => $column->getLabel()
                  ));
                  $validator = new sfValidatorNumber(array(
                      'min' => $column->getMinLength(),
                      'max' => $column->getMaxLength(),
                      'required' => $column->getRequired(),                    
                  ));
                  break;
          }


          $this->widgetSchema[$column->getCode().'.'.$column->getId()] = $widget;

          $this->validatorSchema[$column->getCode().'.'.$column->getId()] = $validator;

      }

  }

  public function getModelName()
  {
    return 'ListingMetadataValue';
  }

  public function save(PropelPDO $con = null) {

      foreach($this->widgetSchema as $k => $item) {

        if ($this->getObject()->isNew()) {



        } else {

            

        }


      }

  }
}
