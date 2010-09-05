<?php

/**
 * interest actions.
 *
 * @package    SWINESTATE
 * @subpackage interest
 * @author     Paul Van de Vreede
 */
class interestActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {

        $c = new Criteria();

        $c->add(InterestPeer::USER_ID, $this->getUser()->getGuardUser()->getId());

        // setting the default value to showing all payments
        $this->singleListing = false;

        // if an id is put in the url then look at the payments of a single listing only and set the variable so the view knows its a single listing
        if ($request->hasParameter('id')) {
            $c->add(InterestPeer::LISTING_ID, $request->getParameter('id'));
            $this->singleListing = true;
        }
        
        $this->pager = new sfPropelPager(
                        'Interest',
                        sfConfig::get('app_items_on_page')
        );
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->page_url = 'interest/index';
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
        $this->redirect('sale/show?id=' . $request->getParameter('listing_id'));
    }
    
    public function executeNew(sfWebRequest $request) {
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

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $Interest = $form->save();

            $this->redirect('interest/edit?id=' . $Interest->getId());
        }
    }

}
