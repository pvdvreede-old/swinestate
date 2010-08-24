<?php

/**
 * search actions.
 *
 * @package    SWINESTATE
 * @subpackage search
 * @author     Paul Van de Vreede
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $request->setParameter('action', 'sale');

      $this->executeSale($request);
  }

  public function executeSale(sfWebRequest $request)
  {
      $this->form = new SearchForm();
      $this->listing_type = 'sale';

      $this->setTemplate('index');
  }

  public function executeRent(sfWebRequest $request)
  {
      $this->form = new SearchForm();
      $this->listing_type = 'rent';

      $this->setTemplate('index');
  }
}
