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
    
    info('1.1 - User clicks on the Place Order button')->
    click('Place Order', array('meal_order' => array('items' => array($item->getId() => array('item_id' => $item->getId())))))->
    with('response')->
        isRedirected()->
        followRedirect()->
        
    info('1.2 - User successfully ordered and will be redirected to the Meals page with a success message')->
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

$c = new Criteria();
$c->add(MealPlacePeer::MEAL_ID, $meal->getId());
$meal_place = MealPlacePeer::doSelectOne($c);

$browser->info('2 - Vote Page')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/vote/' . $meal->getId())->
    
    info('2.1 - User clicks on the Place Vote button')->
    click('Place Vote', array('vote' => array('place_id' => $meal_place->getPlaceId())))->
    with('response')->
        isRedirected()->
        followRedirect()->
        
    info('2.2 - User successfully voted and will be redirected to the Meals page with a success message')->
    with('response')->begin()->
        checkElement('.info', '/Your vote has been placed./i')->
    end();

/**
 * Feature 3: As a user, I can see the meals listed by schedule
 */

$browser->info('3 - Scheduled Meal')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/')->
    info('3.1 - User will be able to see meals listed by schedule')->
    with('response')->begin()->
        checkElement('div.subtitle', '/Scheduled Meal/i')->
        checkElement('div.legend', true)->
    end();

/**
 * Feature 4: As a user, I should be able to add comments on my order per item
 */

$c = new Criteria();
$c->add(MealPeer::VOTING_STOPPED, 1);
$c->add(MealPeer::ORDERING_STOPPED, 0);
$meal  = MealPeer::doSelectOne($c);

$c2 = new Criteria();
$c2->add(ItemPeer::PLACE_ID, $meal->getPlaceId());
$item = ItemPeer::doSelectOne($c2);
 
$browser->info('4 - Order with Comments')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/order/' . $meal->getId())->
    
    info('4.1 - User clicks on the Place Order button and submits form with an order comment')->
    click('Place Order', array('meal_order' => array('items' => array($item->getId() => array('item_id' => $item->getId(), 'comments' => 'blah!')))))->
    with('response')->
        isRedirected()->
        followRedirect()->
        
    info('4.2 - User successfully ordered and will be redirected to the Meals page with a success message')->
    with('response')->begin()->
        checkElement('.info', '/Your order has been placed./i')->
    end();

/**
 * Feature 5: As a user, I should be able to specify the quantity of my order per item
 */

$browser->info('5 - Order with Quantity')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/order/' . $meal->getId())->
    
    info('5.1 - User clicks on the Place Order button and submits form with an order quantity')->
    click('Place Order', array('meal_order' => array('items' => array($item->getId() => array('item_id' => $item->getId(), 'quantity' => 3)))))->
    with('response')->
        isRedirected()->
        followRedirect()->
        
    info('5.2 - User successfully ordered and will be redirected to the Meals page with a success message')->
    with('response')->begin()->
        checkElement('.info', '/Your order has been placed./i')->
    end();
    
/**
 * Feature 6: As a user, I can see the status of a meal based on its color and icon
 */

$browser->info('6 - Meal Status/Type')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/meals')->
    
    with('response')->begin()->
        checkElement('div.legend', true)->
    end();

/**
 * Feature 7: As a user, I should be able to set my order from previous meal as my order for the current meal
 */

$c = new Criteria();
$c->add(MealPeer::VOTING_STOPPED, 1);
$c->add(MealPeer::ORDERING_STOPPED, 0);
$c->addDescendingOrderByColumn(MealPeer::SCHEDULED_AT);
$meal  = MealPeer::doSelectOne($c);

$browser->info('7 - User Previous Order Link')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/order/' . $meal->getId())->
    
    info('7.1 - Previous Order link is displayed')->
    with('response')->begin()->
        checkElement('a.prev-order', true)->
    end()->
    
    info('7.2 - User clicks on the Previous Meal link')->
    with('request')->begin()->
        click('Set Order from Previous Meal')->
    end()->
       
    info('7.3 - User is returned to the Meal Order page and the orders from a previous meal is set')->
    with('response')->begin()->
        checkElement('.title', '/Meal Order/i')->
    end();

/**
 * Feature 8: As a user or admin, I should be able to print the orders for a specific meal
 */

$c = new Criteria();
$c->add(MealPeer::VOTING_STOPPED, 1);
$c->add(MealPeer::ORDERING_STOPPED, 0);
$meal  = MealPeer::doSelectOne($c);
 
$browser->info('8 - Print Orders')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/orders/' . $meal->getId())->
    
    info('8.1 - Print Order link is displayed')->
    with('response')->begin()->
        checkElement('a.print-link', true)->
    end()->
    
    info('8.2 - User clicks on the Print Order link')->
    with('request')->begin()->
        click('Print Order')->
    end()->
    
    info('8.3 - User is redirected to a page showing the print preview with a print link')->
    with('response')->begin()->
        checkElement('#bar', true)->
        checkElement('#bar', '/Print Preview/i')->
        checkElement('#bar a', '/Print/i')->
    end();