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

    public function executeSale(sfWebRequest $request) {


        $this->form = new SearchForm();
        $this->listing_type = 'sale';

        // deal with the search request when it comes in
        if ($request->hasParameter('search')) {

            $this->form->bind($request->getParameter($this->form->getName()));

            if ($this->form->isValid()) {

                $values = $this->form->getValues();

                // add criteria as we go along
                $c = new Criteria();

                // set criteria that only gets listings that have paid
                $c->addJoin(ListingPeer::ID, ListingTimePeer::LISTING_ID);
                $c->add(ListingTimePeer::START_DATE, time(), Criteria::LESS_THAN);
                $c->add(ListingTimePeer::END_DATE, time(), Criteria::GREATER_THAN);
                $c->add(ListingTimePeer::PAYMENT_STATUS, 'Paid');

                // set the listing type as a selling property
                $c->add(ListingPeer::LISTING_TYPE_ID, ListingTypePeer::getIdFromName('Sale'));

                if ($values['suburb'] != '') {
                    // create the join to the suburb to filter it
                    $c->addJoin(ListingPeer::ADDRESS_ID, AddressPeer::ID);
                    $c->addJoin(AddressPeer::SUBURB_ID, SuburbPeer::ID);
                    $c->add(SuburbPeer::NAME, '%' . strtolower($values['suburb']) . '%', Criteria::LIKE);
                }

                if ($values['bathrooms'] != 0) {

                    $c->add(ListingPeer::BATHROOMS, $values['bathrooms'], Criteria::GREATER_EQUAL);
                }

                if ($values['bedrooms'] != 0) {

                    $c->add(ListingPeer::BEDROOMS, $values['bedrooms'], Criteria::GREATER_EQUAL);
                }

                if (isset($values['property_type'])) {

                    $c->add(ListingPeer::PROPERTY_TYPE_ID, $values['property_type'], Criteria::IN);
                }

                $this->pager = new sfPropelPager(
                                'Listing',
                                sfConfig::get('app_search_items_on_page')
                );
                $this->pager->setCriteria($c);
                $this->pager->setPage($request->getParameter('page', 1));
                $this->pager->init();
                $this->page_url = 'alert/index';
                $this->show_results = true;
                $this->module_link = 'sale';
                $this->page_url = 'search/sale';
                $this->get_string = $this->buildPaginateString($request);
            }
        }

        $this->setTemplate('index');
    }

    protected function buildPaginateString($request) {

        // re build the url for the pagination to return the same search with the next page number.
        $gets = $request->getGetParameters();

        $gets_string = '';
 
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
        $this->listing_type = 'rent';

        $this->setTemplate('index');
    }

}
