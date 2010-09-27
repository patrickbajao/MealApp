<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new MealAppTestFunctional(new sfBrowser());

$browser->loadData();

/**
 * Feature 1: As a user, I can pick a menu item from the place chosen to eat
 */

$browser->info('1 - Order Page')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/meals')->
    
    info('1.1 - User clicks on the Order button')->
    click('Order', array(), array('position' => 1))-> //First Order button will be clicked
    
    info('1.2 - User picks a menu item')->
    select('meal_order[item_id][]')-> //First checkbox will be selected
    
    info('1.3 - User clicks on the Place Order button')->
    click('Place Order')->
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

$browser->info('2 - Vote Page')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/meals')->
    
    info('2.1 - User clicks on the Vote link')->
    click('Vote', array(), array('position' => 1))-> //First Vote button will be clicked
    
    info('2.2 - User chooses a place from the list')->
    select('vote[place_id]', array('position' => 1))-> //First radiobutton will be selected
    
    info('2.3 - User clicks on the Place Vote button')->
    click('Place Vote')->
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