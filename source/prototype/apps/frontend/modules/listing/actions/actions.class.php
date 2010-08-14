<?php

/**
 * listing actions.
 *
 * @package    swinestate-pt
 * @subpackage listing
 * @author     Your name here
 */
class listingActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->forward('listing', 'search');
    }

    public function executeSearch(sfWebRequest $request) {
        $this->form = new SearchForm();
    }

    public function executeFind(sfWebRequest $request) {
        $search_criteria = new Criteria();
        $search_criteria->add(ListingPeer::NAME, 
                '%'.strtolower($request->getParameter('search')).'%',
                Criteria::LIKE);
        $search_criteria->add(ListingPeer::LISTING_TYPE_ID, $request->getParameter('listing_type'));
        
        $this->Listings = ListingPeer::doSelect($search_criteria);

//        $this->pager = new sfPropelPager('Listing', 15);
//        $this->pager->getCriteria($search_criteria);
//        $this->pager->setPage($request->getParameter('page'), 1);
//        $this->pager->init();
    }

    public function executeView(sfWebRequest $request) {
        
        $this->listing = ListingPeer::retrieveByPK($request->getParameter('id'));
 
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new ListingForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new ListingForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->getParameter('id')));
        $this->form = new ListingForm($Listing);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->getParameter('id')));
        $this->form = new ListingForm($Listing);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->getParameter('id')));
        $Listing->delete();

        $this->redirect('listing/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $Listing = $form->save();

            $this->redirect('listing/edit?id=' . $Listing->getId());
        }
    }

}
