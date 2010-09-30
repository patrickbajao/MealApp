<?php

class MealAppTestFunctional extends sfTestFunctional
{

    public function loadData() {
        $loader = new sfPropelData();
        $loader->loadData(sfConfig::get('sf_test_dir').'/fixtures');
        return $this;
    }

    public function login($username, $password) {
        return $this->post('/sfGuardAuth/signin', array('signin' => array('username' => $username, 'password' => $password, 'remember' => false), array('_with_csrf' => true)));
    }
    
    public function loginBackend($username, $password) {
        return $this->get('/sfGuardAuth/signin')->
            click('Login', array('signin' => array('username' => $username, 'password' => $password), array('_with_csrf' => true)));
    }
    
}