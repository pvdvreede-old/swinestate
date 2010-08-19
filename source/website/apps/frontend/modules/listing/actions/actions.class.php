<?php

/**
 * listing actions.
 *
 * @package    SWINESTATE
 * @subpackage listing
 * @author     Your name here
 * @version    
 */
class listingActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new SearchForm();
  }

  public function executeSearch(sfWebRequest $request)
  {

      $c = new Criteria();

      if ($request->getParameter('suburb') != '') {

          $c->add(SuburbPeer::NAME, '%'.strtolower($request->getParameter('suburb')).'%', Criteria::LIKE);

      }

      $c->add(ListingPeer::BATHROOMS, $request->getParameter('bathrooms'), Criteria::GREATER_EQUAL);
      $c->add(ListingPeer::BEDROOMS, $request->getParameter('bedrooms'), Criteria::GREATER_EQUAL);

      $this->listings = ListingPeer::doSelect($c);

  }
}
