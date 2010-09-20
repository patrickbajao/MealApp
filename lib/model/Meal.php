<?php


/**
 * Skeleton subclass for representing a row from the 'meal' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Sep  8 08:38:39 2010
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Meal extends BaseMeal
{
    
    public function userHasVoted($user_id) {
        $vote = VotePeer::getVote($this->getId(), $user_id);
        if(!empty($vote)) {
            return true;
        }
        return false;
    }
    
    public function userHasOrdered($user_id) {
        $order = MealOrderPeer::getOrder($this->getId(), $user_id);
        if(!empty($order)) {
            return true;
        }
        return false;
    }
    
    public function isVotingStopped() {
        if(1 == $this->getVotingStopped()) {
            return true;
        }
        return false;
    }
    
    public function isOrderingStopped() {
        if(1 == $this->getOrderingStopped()) {
            return true;
        }
        return false;
    }
    
    public function getVoteCount() {
        return VotePeer::getVoteCount($this->getId());
    }
    
    public function getOrderCount() {
        return MealOrderPeer::getOrderCount($this->getId());
    }
    
    public function getMostVotedPlace() {
        return VotePeer::getMostVotedPlace($this->getId());
    }
    
    public function getUserOrder($user_id) {
        $orders = MealOrderPeer::getOrders($this->getId(), $user_id);
        $user_order = array();
        foreach($orders as $order) {
            $user_order['item_id'][$order->getId()] = $order->getItemId();
        }
        return $user_order;
    }
    
} // Meal