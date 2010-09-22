<?php

/**
 * meal actions.
 *
 * @package    MealApp
 * @subpackage meal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mealActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $this->meals = MealPeer::doSelect(new Criteria());
    }
    
    public function executeOrder(sfWebRequest $request) {
        $user_id = $this->getUser()->getGuardUser()->getId();
        $meal_id  = $request->getParameter('meal_id');
        $meal = MealPeer::getMeal($meal_id);
        
        // Check if ordering for a meal is stopped, then redirect it to Meals page
        if($meal->isOrderingStopped()) {
            $this->getUser()->setFlash('info', 'Ordering for meal ' . $meal_id . ' has already been stopped.');
            $this->redirect('@meals');
        }
        
        // Check if a meal has no chosen place, then redirect it to Meals page
        $place_id = $meal->getPlaceId();
        if(empty($place_id)) {
            $this->getUser()->setFlash('info', 'You can\'t place an order for that meal. It has no chosen place yet.');
            $this->redirect('@meals');
        }
        
        // Add criteria to the form so that it will only display items of the meal's chosen place
        $c = new Criteria();
        $c->add(ItemPeer::PLACE_ID, MealPeer::getMealPlaceId($meal_id));
        $this->form = new MealOrderForm(null, array('criteria' => $c));
        
        $old_order = null;
        $delete_old_order = false;
        if($meal->userHasOrdered($user_id)) {
            $this->getUser()->setFlash('info', 'You have already ordered for this meal. You are now about to change your order.');
            $old_order = $meal->getUserOrder($user_id);
            $this->form->bind($old_order);
            $delete_old_order = true;
        }
        
        $items = $request->getPostParameter('meal_order[item_id]');
        if('POST' == $request->getMethod()) {
            if(!empty($items)) {
                if(MealOrderPeer::saveOrder($meal_id, $user_id, $items, $delete_old_order, $old_order)) {
                    $this->getUser()->setFlash('info', 'Your order has been placed.');
                    $this->redirect('@meals');
                }
            } else {
                $this->getUser()->setFlash('info', 'Please order some food.');
            }
        }
    }
    
    public function executeVote(sfWebRequest $request) {
        $user_id = $this->getUser()->getGuardUser()->getId();
        $meal_id  = $request->getParameter('meal_id');
        $meal = MealPeer::getMeal($meal_id);
        if($meal->isVotingStopped()) {
            $this->getUser()->setFlash('info', 'Voting for meal ' . $meal_id . ' has already been stopped.');
            $this->redirect('@meals');
        }
        $vote = null;
        if($meal->userHasVoted($user_id)) {
            $this->getUser()->setFlash('info', 'You have already voted for this meal. You are now about to change your vote.');
            $vote = VotePeer::getVote($meal_id, $user_id);
        } else {
            $vote = new Vote();
            $vote->setSfGuardUserId($user_id);
            $vote->setMealId($meal_id);
        }
        $this->form = new VoteForm($vote);
        if('POST' == $request->getMethod()) {
            if($this->processForm($request, $this->form)) {
                $this->getUser()->setFlash('info', 'Your vote has been placed.');
                $this->redirect('@meals');
            } else {
                $this->getUser()->setFlash('info', 'Please choose one place to vote.');
            }
        }
    }
    
    public function executeStopVotes(sfWebRequest $request) {
        $meal_id  = $request->getParameter('meal_id');
        $meal = MealPeer::getMeal($meal_id);
        if(!$meal->isVotingStopped()) {
            $meal->setPlaceId($meal->getMostVotedPlace()->getId());
            $meal->setVotingStopped(1);
            if($meal->save()) {
                $this->getUser()->setFlash('info', 'Voting has stopped for meal ' . $meal_id . '.');
                $this->redirect('@meals');
            }
        } else {
            $this->getUser()->setFlash('info', 'Voting for meal ' . $meal_id . ' has already been stopped.');
            $this->redirect('@meals');
        }
    }
    
    public function executeStopOrders(sfWebRequest $request) {
        $meal_id  = $request->getParameter('meal_id');
        $meal = MealPeer::getMeal($meal_id);
        if(!$meal->isOrderingStopped()) {
            $meal->setOrderingStopped(1);
            if($meal->save()) {
                $this->getUser()->setFlash('info', 'Ordering has stopped for meal ' . $meal_id . '.');
                $this->redirect('@meals');
            }
        } else {
            $this->getUser()->setFlash('info', 'Ordering for meal ' . $meal_id . ' has already been stopped.');
            $this->redirect('@meals');
        }
    }
    
    public function executeStartVotes(sfWebRequest $request) {
    }
    
    public function executeStartOrders(sfWebRequest $request) {
    }
    
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $meal = $form->save();
            return true;
        }
        return false;
    }
    
}