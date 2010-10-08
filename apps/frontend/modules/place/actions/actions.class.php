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
    
    public function executeSuggest(sfWebRequest $request) {
        $type     = $request->getParameter('type');
        $place_id = $request->getParameter('place_id');
        $from = 'places';
        
        switch($type) {
            case 'place':
                $this->form = new PlaceSuggestionForm();
                break;
            case 'item':
                $this->form = new ItemSuggestionForm();
                $from = 'place/' . $place_id;
                break;
        }
        if('POST' == $request->getMethod()) {
            if($this->processForm($request, $this->form)) {
                if(!$request->isXmlHttpRequest()) {
                    $this->getUser()->setFlash('info', 'Your suggestion has been submitted.');
                    $this->redirect($from);
                } else {
                    $response = array(
                        'success' => true,
                        'info' => 'Your suggestion has been submitted.'
                    );
                    return $this->renderJSON($response);
                }
            }
        }
        
        $this->type     = $type;
        $this->from     = $from;
        $this->place_id = $place_id;
    }
    
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $place = $form->save();
            return true;
        }
        return false;
    }
    
    protected function renderJSON($response) {
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        return $this->renderText(json_encode($response));
    }
    
}
