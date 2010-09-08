<?php

/**
 * listing actions.
 *
 * @package    SWINESTATE
 * @subpackage listing
 * @author     Paul Van de Vreede
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listingActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

        $c = new Criteria();

        $c->add(ListingPeer::USER_ID, $this->getUser()->getGuardUser()->getId());

        $c->addDescendingOrderByColumn(ListingPeer::UPDATED_AT);

        $this->pager = new sfPropelPager(
                        'Listing',
                        sfConfig::get('app_items_on_page')
        );
        $this->pager->setCriteria($c);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
        $this->page_url = 'listing/index';
        $this->show_results = true;
        $this->module_link = 'listing';
        $this->page_url = 'listing/index';

    }

}
