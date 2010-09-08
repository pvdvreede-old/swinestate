<?php

// include the sale class to extend from
require_once(dirname(__FILE__).'/../../sale/actions/actions.class.php');

/**
 * sale actions.
 *
 * @package    SWINESTATE
 * @subpackage rent
 * @author     Paul Van de Vreede
 */
class rentActions extends saleActions
{

    public $_formObjectType = "RentListingForm";

    public function executeIndex(sfWebRequest $request) {
        parent::executeIndex($request);

        $this->page_url = 'rent/index';

    }

  
}
