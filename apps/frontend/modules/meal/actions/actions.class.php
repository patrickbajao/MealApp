<?php

/**
 * meal actions.
 *
 * @package    MealApp
 * @subpackage meal
 * @author     Earl Patrick Bajao
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mealActions extends sfActions
{

    public function executeIndex(sfWebRequest $request) {
        $week = $request->getParameter('week');
        
        $date = date('Y-m-d', strtotime($week . ' week'));
        $day_number = date('w', strtotime($date)); //Get the current day represented by number (Sunday = 0, Saturday = 6)
        $sunday = date('Y-m-d', strtotime('-' . $day_number . ' days', strtotime($date)));
        $saturday = date('Y-m-d', strtotime('+6 days', strtotime($sunday)));

        $this->meals = MealPeer::getMealsByWeek($sunday, $saturday);
        $this->week = $week;
        $this->sunday = $sunday;
        $this->saturday = $saturday;
    }
    
    public function executeOrder(sfWebRequest $request) {
        $user_id    = $this->getUser()->getGuardUser()->getId();
        $meal_id    = $request->getParameter('meal_id');
        $from_param = $request->getParameter('from');
        $from       = $this->_parseQuery($from_param); // Call the _parseQuery to parse the $from_parameter and convert it into an acceptable symfony route
        $prev_meal  = $request->getParameter('prev_meal');
        $meal       = MealPeer::getMeal($meal_id);
        
        // Check if ordering for a meal is stopped, then redirect it to Meals page
        if($meal->isOrderingStopped()) {
            $this->getUser()->setFlash('info', 'Ordering for meal ' . $meal_id . ' has already been stopped.');
            $this->redirect($from);
        }
        
        // Check if a meal has no chosen place, then redirect it to Meals page
        $place_id = $meal->getPlaceId();
        if(empty($place_id)) {
            $this->getUser()->setFlash('info', 'You can\'t place an order for that meal. It has no chosen place yet.');
            $this->redirect($from);
        }
        
        // Get the items of the place chosen for a meal to be displayed to the order page
        $c = new Criteria();
        $c->add(ItemPeer::PLACE_ID, MealPeer::getMealPlaceId($meal_id));
        $this->menu = ItemPeer::doSelect($c);
        
        $this->order = null;
        $delete_old_order = false;
        if($meal->userHasOrdered($user_id) && !$prev_meal) {
            $this->order = $meal->getUserOrder($user_id);
            $delete_old_order = true;
        }
        
        if($prev_meal) {
            $this->order = $meal->getPreviousOrder($user_id);
            $delete_old_order = true;
        }
        
        if('POST' == $request->getMethod()) {
            $items = $request->getPostParameter('meal_order[items]');
            
            // Check if item_id is passed. If not passed, unset the whole row
            foreach($items as $key => $item) {
                if(!isset($item['item_id'])) {
                    unset($items[$key]);
                }
            }
            
            if(!empty($items)) {
                if(MealOrderPeer::saveOrder($meal_id, $user_id, $items, $delete_old_order, $this->order)) {
                    if(!$request->isXmlHttpRequest()) {
                        $this->getUser()->setFlash('info', 'Your order has been placed.');
                        $this->redirect($from);
                    } else {
                        $response = array(
                            'success' => true,
                            'info' => 'Your order has been placed.',
                            'load' => $from,
                            'id' => $meal_id
                        );
                        return $this->renderJSON($response);
                    }
                }
            } else {
                if(!$request->isXmlHttpRequest()) {
                    $this->getUser()->setFlash('error', 'Please order some food.');
                    $this->order = $items;
                } else {
                    $response = array(
                        'success' => false,
                        'error' => 'Please order some food.'
                    );
                    return $this->renderJSON($response);
                }
            }
        }
        
        // Pass variables needed in the view
        $this->from_param = $from_param;
        $this->from       = $from;
        $this->meal       = $meal;
        $this->meal_id    = $meal_id;
    }
    
    public function executeVote(sfWebRequest $request) {
        $user_id    = $this->getUser()->getGuardUser()->getId();
        $meal_id    = $request->getParameter('meal_id');
        $from_param = $request->getParameter('from');
        $from       = $this->_parseQuery($from_param); // Call the _parseQuery to parse the $from_parameter and convert it into an acceptable symfony route
        $meal       = MealPeer::getMeal($meal_id);
        
        if($meal->isVotingStopped()) {
            $this->getUser()->setFlash('info', 'Voting for meal ' . $meal_id . ' has already been stopped.');
            $this->redirect($from);
        }
        
        $vote = null;
        if($meal->userHasVoted($user_id)) {
            $vote = VotePeer::getVote($meal_id, $user_id);
        } else {
            $vote = new Vote();
            $vote->setSfGuardUserId($user_id);
            $vote->setMealId($meal_id);
        }
        
        $this->form = new VoteForm($vote);
        if('POST' == $request->getMethod()) {
            if($this->processForm($request, $this->form)) {
                if(!$request->isXmlHttpRequest()) {
                    $this->getUser()->setFlash('info', 'Your vote has been placed.');
                    $this->redirect($from);
                } else {
                    $response = array(
                        'success' => true,
                        'info' => 'Your vote has been placed.',
                        'load' => $from,
                        'id' => $meal_id
                    );
                    return $this->renderJSON($response);
                }
            } else {
                if(!$request->isXmlHttpRequest()) {
                    $this->getUser()->setFlash('error', 'Please choose one place to vote.');
                } else {
                    $response = array(
                        'success' => false,
                        'error' => 'Please choose one place to vote.'
                    );
                    return $this->renderJSON($response);
                }
            }
        }
        
        // Pass variables needed in the view
        $this->from_param = $from_param;
        $this->from = $from;
        $this->meal_id = $meal_id;
    }
    
    public function executeViewOrders(sfWebRequest $request) {
        $meal_id  = $request->getParameter('meal_id');
        $layout  = $request->getParameter('layout');
        $this->meal = MealPeer::getMeal($meal_id);
        $orders = array();
        $ctr = 0;
        foreach($this->meal->getMealOrders() as $order) {
            $orders['orders'][$order->getSfGuardUserId()]['user'] = $order->getSfGuardUser();
            $orders['orders'][$order->getSfGuardUserId()]['items'][$ctr]['item'] = $order->getItem();
            $orders['orders'][$order->getSfGuardUserId()]['items'][$ctr]['count'] = $order->getQuantity();
            $orders['orders'][$order->getSfGuardUserId()]['items'][$ctr]['comments'] = $order->getComments();
            $orders['all'][$order->getItem()->getId()]['name'] = $order->getItem()->getName();
            if(isset($orders['all'][$order->getItem()->getId()]['count'])) {
                $orders['all'][$order->getItem()->getId()]['count'] += $order->getQuantity();
            } else {
                $orders['all'][$order->getItem()->getId()]['count'] = $order->getQuantity();
            }
            $ctr++;
        }
        $this->orders = $orders;
        if('print' == $layout) {
            $this->setLayout($layout);
        }
    }
    
    public function executeViewVotes(sfWebRequest $request) {
        $meal_id  = $request->getParameter('meal_id');
        $this->meal = MealPeer::getMeal($meal_id);
        $votes = array();
        $meal_votes = $this->meal->getVotes();
        if(!empty($meal_votes)) {
            foreach($this->meal->getVotes() as $vote) {
                $votes[$vote->getPlaceId()]['place'] = $vote->getPlace()->getName();
                if(isset( $votes[$vote->getPlaceId()]['votes'])) {
                     $votes[$vote->getPlaceId()]['votes'] += 1;
                } else {
                     $votes[$vote->getPlaceId()]['votes'] = 1;
                }
            }
        } else {
            $this->getUser()->setFlash('info', 'There are no votes for meal ' . $meal_id . '.');
            $this->redirect('@meals');
        }
        $this->votes = $votes;
    }
    
    public function executeStopVotes(sfWebRequest $request) {
        $meal_id    = $request->getParameter('meal_id');
        $from_param = $request->getParameter('from');
        $from       = $this->_parseQuery($from_param); // Call the _parseQuery to parse the $from_parameter and convert it into an acceptable symfony route
        $meal       = MealPeer::getMeal($meal_id);
        if(!$meal->isVotingStopped()) {
            $meal->setPlaceId($meal->getMostVotedPlace()->getId());
            $meal->setVotingStopped(1);
            if($meal->save()) {
                if(!$request->isXmlHttpRequest()) {
                    $this->getUser()->setFlash('info', 'Voting has been stopped.');
                    $this->redirect($from);
                } else {
                    $response = array(
                        'success' => true,
                        'info' => 'Voting has been stopped.',
                        'load' => $from,
                        'id' => $meal_id
                    );
                    return $this->renderJSON($response);
                }
            }
        } else {
            $this->getUser()->setFlash('info', 'Voting for meal ' . $meal_id . ' has already been stopped.');
            $this->redirect($from);
        }
    }
    
    public function executeStopOrders(sfWebRequest $request) {
        $meal_id    = $request->getParameter('meal_id');
        $from_param = $request->getParameter('from');
        $from       = $this->_parseQuery($from_param); // Call the _parseQuery to parse the $from_parameter and convert it into an acceptable symfony route
        $meal       = MealPeer::getMeal($meal_id);
        if(!$meal->isOrderingStopped()) {
            $meal->setOrderingStopped(1);
            if($meal->save()) {
                if(!$request->isXmlHttpRequest()) {
                    $this->getUser()->setFlash('info', 'Ordering has been stopped.');
                    $this->redirect($from);
                } else {
                    $response = array(
                        'success' => true,
                        'info' => 'Ordering has been stopped.',
                        'load' => $from,
                        'id' => $meal_id
                    );
                    return $this->renderJSON($response);
                }
            }
        } else {
            $this->getUser()->setFlash('info', 'Ordering for meal ' . $meal_id . ' has already been stopped.');
            $this->redirect($from);
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
    
    protected function renderJSON($response) {
        $this->getResponse()->setHttpHeader('Content-type', 'application/json');
        return $this->renderText(json_encode($response));
    }
    
    private function _parseQuery($query) {
        $from  = str_replace('week', 'week=', str_replace('meals-', 'meals?', $query));
        $url = parse_url($from);
        $params = array();
        if(isset($url['query'])) {
            $query = explode('=', $url['query']);
            $params = array($query[0] => $query[1]);
        }
        $route = $this->generateUrl($url['path'], $params);
        return $route;
    }
    
}