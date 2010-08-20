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
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeDetails(sfWebRequest $request)
  {

    $this->form = new UserDetailsForm();

    if ($this->getUser()->isAuthenticated()) {
        $this->form->configure($this->getUser()->getProfile());
        $this->action = 'Update';
        $new = false;
    } else {       
        $this->action = 'Create';
        $new = true;      
    }
    
    // deal with the request
    if ($request->isMethod('post')) {
     
        $this->form->bind($request->getParameter('user'));
        
        if ($this->form->isValid()) {
            
            $userValues = $this->form->getValues();
            
            if ($new) {
                
                $user = new sfGuardUser();
                $user->setUsername($userValues['username']);
                $user->setPassword($userValues['password']);
                $user->save();
                
                $this->getUser()->signin($user, false);

                $this->getUser()->getProfile()->setEmailAddress($userValues['email_address']);

            } else {

                //if ($userValues['password'] != '')
                    //$this->getUser()-setPassword($userValues['password']);

            }

            $this->getUser()->getProfile()->setFirstName($userValues['first_name']);
            $this->getUser()->getProfile()->setLastName($userValues['last_name']);
            
            $this->getUser()->getProfile()->setPhoneNumber($userValues['phone_number']);
            $this->getUser()->getProfile()->save();
            

            $this->redirect('@profile_page');
            
        }
        
    }

  }

  public function executeProfile(sfWebRequest $request)
  {
       if (!$this->getUser()->isAuthenticated()) {

           $this->redirect('@homepage');

       }
   

  }

  public function executeView(sfWebRequest $request)
  {
      $this->listing = ListingPeer::retrieveByPK($request->getParameter('id'));
  }
}
