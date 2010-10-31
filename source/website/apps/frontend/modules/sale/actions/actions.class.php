<?php

/**
 * This module is for creating, updating and showing a listing that is for selling a property.
 * The alertation of renting properties inherits from this class as most things are the same
 * regardless of the listing type.
 *
 * @package    SWINESTATE
 * @subpackage sale
 * @author     Paul Van de Vreede
 */
class saleActions extends sfActions
{

    public $_formObjectType = "SaleListingForm";

    /**
     * saleActions::executeIndex()
     * 
     * @param mixed $request
     * @return
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->pager = new sfPropelPager('Listing', sfConfig::get('app_items_on_page'));
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->page_url = 'sale/index';
    }

    /**
     * saleActions::executeShow()
     * 
     * @param mixed $request
     * @return
     */
    public function executeShow(sfWebRequest $request)
    {

        $c = new Criteria();
        $c->add(ListingPeer::ID, $request->getParameter('id'));
        $listings = ListingPeer::doSelectJoinAll($c);
        $this->Listing = $listings[0];
        $this->forward404Unless($this->Listing);
        
        // security check to make sure that the user requesting the show view is allowed to see the listing
        $this->forward404Unless($this->Listing->canView());
    }

    /**
     * saleActions::executeNew()
     * 
     * @param mixed $request
     * @return
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new $this->_formObjectType();
    }

    /**
     * saleActions::executeCreate()
     * 
     * @param mixed $request
     * @return
     */
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new $this->_formObjectType();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    /**
     * saleActions::executeEdit()
     * 
     * @param mixed $request
     * @return
     */
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->
            getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->
            getParameter('id')));
        $this->form = new $this->_formObjectType($Listing);
    }

    /**
     * saleActions::executeUpdate()
     * 
     * @param mixed $request
     * @return
     */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->
            isMethod(sfRequest::PUT));
        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->
            getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->
            getParameter('id')));
        $this->form = new $this->_formObjectType($Listing);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    /**
     * saleActions::executeDelete()
     * 
     * @param mixed $request
     * @return
     */
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->
            getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->
            getParameter('id')));
        $Listing->delete();

        $this->redirect('sale/index');
    }

    /**
     * This function checks any forms from this module and makes sure they are valid then
     * saves then. If they are not valid then the form is return to the posting page 
     * with the errors displayed.
     * 
     * @param mixed $request
     * @param mixed $form
     * @return
     */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->
            getName()));
        if ($form->isValid()) {
            
            // if its an update to a listing the alert needs to be reset for the alerting job to check it again in case it
            // needs to send out alerts to  new users based on a change to suburb, bedroom count or something else
            $form->getObject()->setAlertActivated(0);
            
            $Listing = $form->save();

            $this->getUser()->setFlash('notice', 'The listing has been saved.');

            $this->redirect('listing/index');
        }
    }

}
