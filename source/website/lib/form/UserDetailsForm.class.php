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
class UserDetailsForm extends sfForm {

    public function configure($site_user = null) {

        $this->setWidgets(array(                
                'first_name' => new sfWidgetFormInputText(),
                'last_name' => new sfWidgetFormInputText(),
                'phone_number' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
                'first_name' => new sfValidatorString(array('min_length' => 3)),
                'last_name' => new sfValidatorString(array('min_length' => 3)),
                'phone_number' => new sfValidatorString(array('min_length' => 6))
         ));
        
        
        if ($site_user == null) {

            $this->widgetSchema['username'] = new sfWidgetFormInputText();
            $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
            $this->widgetSchema['re-enter_password'] = new sfWidgetFormInputPassword();
            $this->widgetSchema['email_address'] = new sfWidgetFormInputText();

            $this->validatorSchema['username'] = new sfValidatorString(array('min_length' => 4));
            $this->validatorSchema['password'] = new sfValidatorString(array('min_length' => 4));
            $this->validatorSchema['re-enter_password'] = new sfValidatorString(array('min_length' => 4));
            $this->validatorSchema['email_address'] = new sfValidatorEmail();

        } else {

            $this->widgetSchema['first_name']->addOption('default', $site_user->getFirstName());
            $this->widgetSchema['last_name']->addOption('default', $site_user->getLastName());
            $this->widgetSchema['phone_number']->addOption('default', $site_user->getPhoneNumber());

        }

        $this->widgetSchema->setNameFormat('user[%s]');
    }



}

?>
