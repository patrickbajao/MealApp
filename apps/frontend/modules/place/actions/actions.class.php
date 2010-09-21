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
        $this->places = PlacePeer::doSelect(new Criteria());
    }
    
    public function executeShow(sfWebRequest $request) {
        $this->place = PlacePeer::retrieveByPk($request->getParameter('place_id'));
    }
    
}
