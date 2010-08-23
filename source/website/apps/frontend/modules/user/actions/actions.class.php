<?php

/**
 * user actions.
 *
 * @package    SWINESTATE
 * @subpackage user
 * @author     Your name here
 * @version
 */
class userActions extends sfActions
{

  public function executeIndex(sfWebRequest $request)
  {
    // show index page with user options if signed in, other go to login page
      if ($this->getUser()->isAuthenticated()) {
          $this->template('show');
      } else {
          $this->redirect('@sf_guard_signin');
      }

  }

  public function executeShow(sfWebRequest $request)
  {
    $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->forward404Unless(!$this->getUser()->isAuthenticated());
    $this->form = new sfGuardUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new sfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');
    $this->form = new sfGuardUserForm($this->getUser()->getGuardUser());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->redirectUnless($this->getUser()->isAuthenticated(), '@sf_guard_signin');
    
    $this->form = new sfGuardUserForm($this->getUser()->getGuardUser());

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $user = $form->save();

      $this->getUser()->signin($user, false);

      $this->redirect('user/show');
    }
  }

}
