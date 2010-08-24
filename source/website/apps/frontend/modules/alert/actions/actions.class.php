<?php

/**
 * alert actions.
 *
 * @package    SWINESTATE
 * @subpackage alert
 * @author     Your name here
 */
class alertActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');
        $this->Alerts = AlertPeer::doSelect(new Criteria());
    }

    public function executeShow(sfWebRequest $request) {
        $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');
        $this->Alert = AlertPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->Alert);
    }

    public function executeNew(sfWebRequest $request) {
        $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');
        $this->form = new AlertForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');

        $this->form = new AlertForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');
        $this->forward404Unless($Alert = AlertPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Alert does not exist (%s).', $request->getParameter('id')));
        $this->form = new AlertForm($Alert);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($Alert = AlertPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Alert does not exist (%s).', $request->getParameter('id')));
        $this->form = new AlertForm($Alert);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');
        $request->checkCSRFProtection();

        $this->forward404Unless($Alert = AlertPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Alert does not exist (%s).', $request->getParameter('id')));
        $Alert->delete();

        $this->redirect('alert/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $Alert = $form->save();

            $this->redirect('alert/edit?id=' . $Alert->getId());
        }
    }

}
