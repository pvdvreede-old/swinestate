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

      // deal with the search request when it comes in
      if ($request->hasParameter('suburb')) {

          $this->form->bind($request->getParameter($this->form->getName()));

          if ($this->form->isValid()) {

              $values = $this->form->getValues();

              // add criteria as we go along
              $c = new Criteria();

              if ($values['suburb'] == '') {

                  // create the join to the suburb to filter it
                  $c->addJoin(ListingPeer::ADDRESS_ID, AddressPeer::ID);
                  $c->addJoin(AddressPeer::SUBURB_ID, SuburbPeer::ID);
                  $c->add(SuburbPeer::NAME, '%'.strtolower($values['suburb']).'%', Criteria::LIKE);
              }

              if ($values['bathrooms'] != 0) {

                  $c->add(ListingPeer::BATHROOMS, $values['bathrooms'], Criteria::GREATER_EQUAL);
              }

              if ($values['bedrooms'] != 0) {

                  $c->add(ListingPeer::BEDROOMS, $values['bedrooms'], Criteria::GREATER_EQUAL);
              }

              if (!isset($values['listing_type'])) {

                  $c->add(ListingPeer::LISTING_TYPE_ID, $values['listing_type'], Criteria::IN);

              }


              

          }

      }



      $this->setTemplate('index');
  }

  public function executeRent(sfWebRequest $request)
  {
      $this->form = new SearchForm();
      $this->listing_type = 'rent';

      $this->setTemplate('index');
  }
}
