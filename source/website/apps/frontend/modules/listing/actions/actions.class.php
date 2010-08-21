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

  public function executeAlterListing(sfWebRequest $request)
  {

      $this->form = new SaleListingForm();

      if ($request->hasParameter('id')) {

        $listing = ListingPeer::retrieveByPK($request->getParameter('id'));

        $this->action = 'Edit';
        $this->form->configure($listing);

      } else {

        $this->action = 'Create';
        
      }
  }
}
