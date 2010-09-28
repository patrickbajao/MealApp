<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new MealAppTestFunctional(new sfBrowser());

$browser->loadData();

/**
 * Feature 1: As a user, I can pick a menu item from the place chosen to eat
 */

$c = new Criteria();
$c->add(MealPeer::VOTING_STOPPED, 1);
$c->add(MealPeer::ORDERING_STOPPED, 0);
$meal  = MealPeer::doSelectOne($c);

$c2 = new Criteria();
$c2->add(ItemPeer::PLACE_ID, $meal->getPlaceId());
$item = ItemPeer::doSelectOne($c2);

$browser->info('1 - Order Page')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/order/' . $meal->getId())->
    
    info('1.3 - User clicks on the Place Order button')->
    click('Place Order', array('meal_order' => array('item_id' => array($item->getId()))))->
    with('response')->
        isRedirected()->
        followRedirect()->
        
    info('1.3.1 - User successfully ordered and will be redirected to the Meals page with a success message')->
    with('response')->begin()->
        checkElement('.info', '/Your order has been placed./i')->
    end();

/**
 * Feature 2: As a user, I can vote on where to eat
 */

$c3 = new Criteria();
$c3->add(MealPeer::VOTING_STOPPED, 0);
$c3->add(MealPeer::ORDERING_STOPPED, 0);
$meal  = MealPeer::doSelectOne($c3);

$place = PlacePeer::doSelectOne(new Criteria());

$browser->info('2 - Vote Page')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/vote/' . $meal->getId())->
    
    info('2.3 - User clicks on the Place Vote button')->
    click('Place Vote', array('vote' => array('place_id' => $place->getId())))->
    with('response')->
        isRedirected()->
        followRedirect()->
        
    info('2.3.1 - User successfully voted and will be redirected to the Meals page with a success message')->
    with('response')->begin()->
        checkElement('.info', '/Your vote has been placed./i')->
    end();

/**
 * Feature 3: As a user, I can see the meals listed by schedule
 */
 
$browser->info('3 - Meals Page')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/meals')->
    with('response')->begin()->
        checkElement('div.title', '/Meals/i')->
        checkElement('div#scheduled-meal div.date', '/' . date('Y M j') . '/i')->
    end();