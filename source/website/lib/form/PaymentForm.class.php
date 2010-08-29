<?php

/**
 * Payment form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Your name here
 */
class PaymentForm extends sfForm {

    public $listing_time_id;
    
    public function configure() {
        // create inputs for details of the user's paypal account
        $this->setWidgets(array(
            'paypal_name' => new sfWidgetFormInputText(),
            'paypal_password' => new sfWidgetFormInputPassword(),
            'paypal_password_again' => new sfWidgetFormInputPassword(),
            'listing_time_id' => new sfWidgetFormInputHidden(array(), array(
                'value' => $this->listing_time_id
            ))
        ));

        // validators for the above
        $this->setValidators(array(
            'paypal_name' => new sfValidatorString(),
            'paypal_password' => new sfValidatorString(),
            'paypal_password_again' => new sfValidatorString()
        ));

        $this->widgetSchema->setNameFormat('payment[%s]');
    }
    
    public function save(PropelPDO $con = null) {
        
        // get the lising time row to confirm that payment against
        $c = new Criteria();
        
        $c->add(ListingTimePeer::ID, $this->values['listing_time_id']);
                
        $payment = ListingTimePeer::doSelectOne($c);
        
        // set the payment status to paid and save the object to the DB
        $payment->setPaymentStatus('Paid');
        
        $payment->save();       
        
    }

}
