<?php

/**
 * payment actions.
 *
 * @package    SWINESTATE
 * @subpackage payment
 * @author     Paul Van de Vreede
 */
class paymentActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {

        $c = new Criteria();

        // add criteria to SQL to only show payments that have been paid (so are actual payments, not pending)
        // and are for the current user
        $c->add(ListingTimePeer::PAYMENT_STATUS, 'Paid');
        $c->add(ListingTimePeer::USER_ID, $this->getUser()->getGuardUser()->getId());

        // setting the default value to showing all payments
        $this->singleListing = false;

        // if an id is put in the url then look at the payments of a single listing only and set the variable so the view knows its a single listing
        if ($request->hasParameter('id')) {
            $c->add(ListingTimePeer::LISTING_ID, $request->getParameter('id'));
            $this->singleListing = true;
        }

        $this->pager = new sfPropelPager(
                        'ListingTime',
                        sfConfig::get('app_items_on_page')
        );
        $this->pager->setCriteria($c);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->page_url = 'payment/index';

    }

    public function executeConfirm(sfWebRequest $request) {
        //$this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->ListingTime = ListingTimePeer::retrieveByPK($request->getParameter('id'));

        $this->form = new PaymentForm();

        $this->form->listing_time_id = $this->ListingTime->getId();

        $this->form->configure();

        // if the confirmation form has been submitted
        if ($request->hasParameter('payment') && $request->isMethod('post')) {

            //check that the form is valid
            $this->form->bind($request->getParameter($this->form->getName()));

            if ($this->form->isValid()) {

                /*                 * ********************************************
                 *  PUT CODE HERE FOR PAYPAL PAYMENT PROCESSING
                 * ******************************************* */


                // call the save method on the form which will update the payment status
                $this->receiptObject = $this->form->save();

                // send an email to the user with the receipt details
                $email = Swift_Message::newInstance()
                                ->setFrom(sfContext::get('app_from_email'))
                                ->setTo($this->getUser()->getProfile()->getEmailAddress())
                                ->setSubject(sfContext::get('app_app_name') . ' - Payment details')
                                ->setBody($this->getPartial('reciept', array(
                                            'receiptObject' => $this->receiptObject
                                        )));

                $this->getMailer()->send($email);

                // once successful then redirect to the receipt page
                $this->setTemplate('receipt');
            }
        }
    }

    public function executeShow(sfWebRequest $request) {
        $this->ListingTime = ListingTimePeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->ListingTime);
    }

    public function executeNew(sfWebRequest $request) {
        // create the payment model and put the listing id in
        $payment = new ListingTime();
        $payment->setListingId($request->getParameter('id'));
        
        
        $this->form = new ListingTimeForm();
        
        $this->form->getWidget('listing_id')->setDefault($request->getParameter('id'));



    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ListingTimeForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($ListingTime = ListingTimePeer::retrieveByPk($request->getParameter('id')), sprintf('Object ListingTime does not exist (%s).', $request->getParameter('id')));
        $this->form = new ListingTimeForm($ListingTime);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($ListingTime = ListingTimePeer::retrieveByPk($request->getParameter('id')), sprintf('Object ListingTime does not exist (%s).', $request->getParameter('id')));
        $this->form = new ListingTimeForm($ListingTime);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($ListingTime = ListingTimePeer::retrieveByPk($request->getParameter('id')), sprintf('Object ListingTime does not exist (%s).', $request->getParameter('id')));
        $ListingTime->delete();

        $this->redirect('payment/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $ListingTime = $form->save();

            $this->redirect('payment/confirm?id=' . $ListingTime->getId());
        }
    }

}
