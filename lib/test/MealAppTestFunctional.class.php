<?php

class MealAppTestFunctional extends sfTestFunctional
{

    public function loadData() {
        $loader = new sfPropelData();
        $loader->loadData(sfConfig::get('sf_test_dir').'/fixtures');
        return $this;
    }

    public function login($username, $password) {
        return $this->post('/sfGuardAuth/signin', array('signin' => array('username' => $username, 'password' => $password, 'remember' => false, '_csrf_token' => true)));
    }
    
    public function getMealWithChosenPlace() {
        $c = new Criteria();
        $c->add(MealPeer::VOTING_STOPPED, 1);
        $c->add(MealPeer::ORDERING_STOPPED, 0);
        $meal  = MealPeer::doSelectOne($c);
        return $this;
    }
    
    public function getItemFromPlace($place_id) {
        $c = new Criteria();
        $c->add(ItemPeer::PLACE_ID, $place_id);
        $item = ItemPeer::doSelectOne($c);
        return $this;
    }
    
}