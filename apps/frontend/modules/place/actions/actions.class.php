<?php

/**
 * place actions.
 *
 * @package    MealApp
 * @subpackage place
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class placeActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(PlacePeer::NAME);
        $this->pager = new sfPropelPager('Place', 20);
        $this->pager->setCriteria($c);
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }
    
    public function executeShow(sfWebRequest $request) {
        $this->place = PlacePeer::retrieveByPk($request->getParameter('place_id'));
    }
    
}
