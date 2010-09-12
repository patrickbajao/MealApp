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
    
    public function executeVote(sfWebRequest $request) {
        $user_id = $this->getUser()->getGuardUser()->getId();
        $meal_id  = $request->getParameter('meal_id');
        $vote = null;
        if(VotePeer::checkIfUserHasVoted($meal_id, $user_id)) {
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
    
    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()));
        if ($form->isValid()) {
            $meal = $form->save();
            return true;
        }
        return false;
    }
    
}