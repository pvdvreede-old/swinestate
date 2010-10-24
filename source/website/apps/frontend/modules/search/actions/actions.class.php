<?php

/**
 * search actions.
 *
 * @package    SWINESTATE
 * @subpackage search
 * @author     Paul Van de Vreede
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $request->setParameter('action', 'sale');

        $this->executeSale($request);
    }

    public function executeAjax(sfWebRequest $request) {

        $this->getResponse()->setContentType('application/json');

        $suburbs = SuburbPeer::retrieveForAutoComplete($request->getParameter('q'), $request->getParameter('limit'));

        return $this->renderText(json_encode($suburbs));
    }

    public function executeSale(sfWebRequest $request) {
     
        $this->form = new SearchForm(null, array('url' => $this->getController()->genUrl('search/ajax')));
        $this->listing_type = 'Sale';
        $this->listing_type_id = ListingTypePeer::getIdFromName('Sale');
        $this->module_link = 'sale';
        $this->page_url = 'search/sale';

        $this->buildSearchQuery($request);
    }


    protected function buildSearchQuery($request) {

        // deal with the search request when it comes in
        if ($request->hasParameter('search')) {

            $this->form->bind($request->getParameter($this->form->getName()));

            if ($this->form->isValid()) {

                $values = $this->form->getValues();

                // add criteria as we go along
                $c = new Criteria();

                // order the listings with the newest one first, then order by price
                $c->addDescendingOrderByColumn(ListingPeer::CREATED_AT);

                // set criteria that only gets listings that have paid
                $c->addJoin(ListingPeer::ID, ListingTimePeer::LISTING_ID);
                $c->add(ListingTimePeer::START_DATE, time(), Criteria::LESS_THAN);
                $c->add(ListingTimePeer::END_DATE, time(), Criteria::GREATER_THAN);
                $c->add(ListingTimePeer::PAYMENT_STATUS, 'Paid');

                // set criteria that get listings that arent sold or rented
                $c->add(ListingPeer::LISTING_STATUS_ID, array(
                    ListingStatusPeer::getIdFromName('Sold'),
                    ListingStatusPeer::getIdFromName('Rented')
                    ), Criteria::NOT_IN);

                // set the listing type as a selling property
                $c->add(ListingPeer::LISTING_TYPE_ID, ListingTypePeer::getIdFromName($this->listing_type));
                
                $suburb_search = $request->getParameter('autocomplete_search');
                
                if ($values['postcode'] != '') {
                   // create the join to the postcode to filter it
                    $c->addJoin(ListingPeer::ADDRESS_ID, AddressPeer::ID);
                    $c->addJoin(AddressPeer::SUBURB_ID, SuburbPeer::ID);
                    $c->add(SuburbPeer::POSTCODE, $values['postcode']);
                }
                // only allow either the suburb or the post code for filtering
                elseif ($suburb_search['suburb'] != '') {
                    // split if there is comma for the country
                    $parts = explode(',', $suburb_search['suburb']);
                    
                    // create the join to the suburb to filter it
                    $c->addJoin(ListingPeer::ADDRESS_ID, AddressPeer::ID);
                    $c->addJoin(AddressPeer::SUBURB_ID, SuburbPeer::ID);
                    $c->add(SuburbPeer::NAME, '%'.$parts[0].'%', Criteria::LIKE);
                    
//                    if (count($parts) == 2) {
//                        
//                        $c->addJoin(SuburbPeer::COUNTRY_ID, CountryPeer::ID);
//                        $c->add(CountryPeer::DISPLAY_NAME, $parts[1]);
//                        
//                    }
                    
                    // set a var so that the template can grab the suburb text for the alert saving
                    $this->suburb_text = $parts[0];
                }

                if ($values['bathrooms'] != 0) {

                    $c->add(ListingPeer::BATHROOMS, $values['bathrooms']);
                }

                if ($values['bedrooms'] != 0) {

                    $c->add(ListingPeer::BEDROOMS, $values['bedrooms']);
                }
                
                if ($values['car_spaces'] != 0) {

                    $c->add(ListingPeer::CAR_SPACES, $values['car_spaces']);
                }

                if (isset($values['property_type'])) {

                    $c->add(ListingPeer::PROPERTY_TYPE_ID, $values['property_type'], Criteria::IN);
                }

                if (isset($values['min_price'])) {

                    // need to check whether its a sale or rent search for which table to check
                    if ($this->listing_type == 'Sale') {

                        $c->addJoin(ListingPeer::SALE_DETAILS_ID, SaleDetailsPeer::ID);
                        $c->add(SaleDetailsPeer::ASKING_PRICE, $values['min_price'], Criteria::GREATER_EQUAL);

                    } elseif ($this->listing_type == 'Rent') {

                        $c->addJoin(ListingPeer::RENT_DETAILS_ID, RentDetailsPeer::ID);
                        $c->add(RentDetailsPeer::AMOUNT_MONTH_PRICE, $values['min_price'], Criteria::GREATER_EQUAL);

                    }

                }

                if (isset($values['max_price'])) {

                    // need to check whether its a sale or rent search for which table to check
                    if ($this->listing_type == 'Sale') {

                        $c->addJoin(ListingPeer::SALE_DETAILS_ID, SaleDetailsPeer::ID);
                        $c->add(SaleDetailsPeer::ASKING_PRICE, $values['max_price'], Criteria::LESS_EQUAL);

                    } elseif ($this->listing_type == 'Rent') {

                        $c->addJoin(ListingPeer::RENT_DETAILS_ID, RentDetailsPeer::ID);
                        $c->add(RentDetailsPeer::AMOUNT_MONTH_PRICE, $values['max_price'], Criteria::LESS_EQUAL);

                    }

                }

                $this->pager = new sfPropelPager(
                                'Listing',
                                sfConfig::get('app_search_items_on_page')
                );
                $this->pager->setCriteria($c);
                $this->pager->setPeerMethod('doSelectJoinAll');
                $this->pager->setPage($request->getParameter('page', 1));
                $this->pager->init();
                $this->show_results = true;
                $this->get_string = $this->buildPaginateString($request);

            }
        }

        $this->setTemplate('index');

    }

    protected function buildPaginateString($request) {

        // re build the url for the pagination to return the same search with the next page number.
        $gets = $request->getGetParameters();
        $auto = $request->getParameter('autocomplete_search');
        $gets_string = 'autocomplete_search[suburb]='.$auto['suburb'].'&';
        
        foreach ($gets['search'] as $k => $v) {

            if (is_array($v)) {
                
                foreach ($v as $l => $b) {
                    
                    $gets_string .= 'search[' . $k . '][]=' . $b . '&';
                    
                }
                
            } else {

                $gets_string .= 'search[' . $k . ']=' . $v . '&';

            }
        }

        return $gets_string; //substr($gets_string, 0, -1);
    }

    public function executeRent(sfWebRequest $request) {
        $this->form = new SearchForm();
        $this->listing_type = 'Rent';
        $this->module_link = 'rent';
        $this->listing_type_id = ListingTypePeer::getIdFromName('Rent');
        $this->page_url = 'search/rent';

        $this->buildSearchQuery($request);
    }

}
