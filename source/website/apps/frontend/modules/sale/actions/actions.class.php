<?php

/**
 * sale actions.
 *
 * @package    SWINESTATE
 * @subpackage sale
 * @author     Paul Van de Vreede
 */
class saleActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->pager = new sfPropelPager(
                        'Listing',
                        sfConfig::get('app_items_on_page')
        );
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->page_url = 'sale/index';
    }

    public function executeShow(sfWebRequest $request) {
        $this->Listing = ListingPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->Listing);
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new SaleListingForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new SaleListingForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->getParameter('id')));
        $this->form = new SaleListingForm($Listing);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->getParameter('id')));
        $this->form = new SaleListingForm($Listing);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->getParameter('id')));
        $Listing->delete();

        $this->redirect('sale/index');
    }

    public function executeInterest(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        // create the interest object, assign the listing interested in along with your user id
        $interest = new Interest();

        $interest->setUserId($this->getUser()->getGuardUser()->getId());
        $interest->setListingId($request->getParameter('listing_id'));

        // save the interest to the db
        $interest->save();

        //get the email address of the seller to send them an email
        $c = new Criteria();

        $c->add(ListingPeer::ID, $interest->getListingId());
        $c->addJoin(sfGuardUserProfilePeer::ID, ListingPeer::USER_ID);

        $seller = sfGuardUserProfilePeer::doSelectOne($c);
        
        // send an email to the seller notifying them of the interest
//        $email = Swift_Message::newInstance()
//                        ->setFrom(sfConfig::get('app_from_email'))
//                        ->setTo($seller->getEmailAddress())
//                        ->setSubject(sfConfig::get('app_app_name') . ' - Your listing has received some interest!')
//                        ->setBody($this->getPartial('profile', array(
//                                    'sf_user' => $this->getUser()
//                                )));
//
//        $this->getMailer()->send($email);

        $this->getUser()->setFlash('notice', 'Your interest has been sent to the seller.');

        //$this->setTemplate('sale/show');

        $this->redirect('sale/show?id='.$request->getParameter('listing_id'));

    }

    public function executeWithdraw(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        // get the interest item for this listing and user to delete
        $c = new Criteria();

        $c->add(InterestPeer::USER_ID, $this->getUser()->getGuardUser()->getId());
        $c->add(InterestPeer::LISTING_ID, $request->getParameter('listing_id'));

        $interest = InterestPeer::doSelectOne($c);

        // delete the interest as it has been withdrawn
        $interest->delete();

        $this->getUser()->setFlash('notice', 'Your interest been withdrawn.');

        // return the sale listing
        $this->redirect('sale/show?id='.$request->getParameter('listing_id'));
        
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $Listing = $form->save();

            $this->getUser()->setFlash('notice', 'The listing has been saved.');

            $this->redirect('listing/index');
        }
    }

}
