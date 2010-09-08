<?php

/**
 * sale actions.
 *
 * @package    SWINESTATE
 * @subpackage sale
 * @author     Paul Van de Vreede
 */
class saleActions extends sfActions {

    public $_formObjectType = "SaleListingForm";

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
        $this->form = new $this->_formObjectType();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new $this->_formObjectType();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->getParameter('id')));
        $this->form = new $this->_formObjectType($Listing);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->getParameter('id')));
        $this->form = new $this->_formObjectType($Listing);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($Listing = ListingPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Listing does not exist (%s).', $request->getParameter('id')));
        $Listing->delete();

        $this->redirect('sale/index');
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
