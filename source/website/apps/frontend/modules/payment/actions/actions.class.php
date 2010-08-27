<?php

/**
 * payment actions.
 *
 * @package    SWINESTATE
 * @subpackage payment
 * @author     Paul Van de Vreede
 */
class paymentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ListingTimes = ListingTimePeer::doSelect(new Criteria());
  }

  public function executeConfirm(sfWebRequest $request)
  {
      
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->ListingTime = ListingTimePeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->ListingTime);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ListingTimeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ListingTimeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ListingTime = ListingTimePeer::retrieveByPk($request->getParameter('id')), sprintf('Object ListingTime does not exist (%s).', $request->getParameter('id')));
    $this->form = new ListingTimeForm($ListingTime);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ListingTime = ListingTimePeer::retrieveByPk($request->getParameter('id')), sprintf('Object ListingTime does not exist (%s).', $request->getParameter('id')));
    $this->form = new ListingTimeForm($ListingTime);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ListingTime = ListingTimePeer::retrieveByPk($request->getParameter('id')), sprintf('Object ListingTime does not exist (%s).', $request->getParameter('id')));
    $ListingTime->delete();

    $this->redirect('payment/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ListingTime = $form->save();

      $this->redirect('payment/edit?id='.$ListingTime->getId());
    }
  }
}
