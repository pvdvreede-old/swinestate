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

        // create a criteria when checking a payment id to make sure it have not been paid
        $listing_id_criteria = new Criteria();

        $listing_id_criteria->add(ListingTimePeer::PAYMENT_STATUS, 'pending');

        // validators for the above
        $this->setValidators(array(
            'paypal_name' => new sfValidatorString(),
            'paypal_password' => new sfValidatorString(),
            'paypal_password_again' => new sfValidatorString(),
            'listing_time_id' => new sfValidatorPropelChoice(array(
                'model' => 'ListingTime',
                'column' => 'id',
                'criteria' => $listing_id_criteria
            ), array(
                'invalid' => 'The payment has already been processed.'
            ))
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorSchemaCompare('paypal_password', '==', 'paypal_password_again', array(
                    'left_field' => 'The passwords do not match',
                    'right_field' => 'The passwords do not match'
                ))
        );

        $this->widgetSchema->setNameFormat('payment[%s]');
    }

    public function save(PropelPDO $con = null) {

        $fail = false;

        // wrap in try catch for transaction
        try {
            // get the lising time row to confirm that payment against
            $c = new Criteria();

            $c->add(ListingTimePeer::ID, $this->values['listing_time_id']);

            $payment = ListingTimePeer::doSelectOne($c);

            // set the payment status to paid and save the object to the DB
            $payment->setPaymentStatus('Paid');

            // save the date of the payment
            $payment->setPaymentDate(time());

            // save the paypal account name for auditing of suspicious behaviour
            $payment->setPayerAccountName($this->values['paypal_name']);
        } catch (Exception $ex) {
            $fail = true;
            
            throw $ex;
        }

        if (!$fail) {
            // seralise the values to the db
            $payment->save();
        }

        return $payment;
    }

}
