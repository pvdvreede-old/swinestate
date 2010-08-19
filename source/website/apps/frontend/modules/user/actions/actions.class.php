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
  public function executeRegister(sfWebRequest $request)
  {
    $this->form = new RegisterForm();
  }

  public function executeSearch(sfWebRequest $request)
  {

      $this->form = new SearchForm();

      $c = new Criteria();

      if ($request->getParameter('suburb') != '') {

          $c->addJoin(ListingPeer::ADDRESS_ID, SuburbPeer::ID);
          $c->addJoin(AddressPeer::SUBURB_ID, SuburbPeer::ID);
          $c->add(SuburbPeer::NAME, '%'.strtolower($request->getParameter('suburb')).'%', Criteria::LIKE);

      }

      if ($request->getParameter('listing_type') != 0) {

          $c->add(ListingPeer::LISTING_TYPE_ID, $request->getParameter('listing_type'));

      }

      $c->add(ListingPeer::BATHROOMS, $request->getParameter('bathrooms'), Criteria::GREATER_EQUAL);
      $c->add(ListingPeer::BEDROOMS, $request->getParameter('bedrooms'), Criteria::GREATER_EQUAL);

      $this->listings = ListingPeer::doSelect($c);

  }

  public function executeView(sfWebRequest $request)
  {
      $this->listing = ListingPeer::retrieveByPK($request->getParameter('id'));
  }
}
