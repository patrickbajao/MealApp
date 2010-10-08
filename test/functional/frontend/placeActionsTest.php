<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new MealAppTestFunctional(new sfBrowser());

$browser->loadData();

/**
 * Feature 1: As a user, I can make requests or suggestions of places
 */

$browser->info('1 - Places Page')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/places')->
    
    info('1.1 - Suggest a Place link is displayed')->
    with('response')->begin()->
        checkElement('a.place-suggest-link', true)->
    end()->
    
    info('1.2 - User clicks on the Suggest a Place link')->
    click('Suggest a Place')->
    
    click('Suggest', array('suggestion' => array('type' => 'place', 'name' => 'Karate Kid', 'description' => 'They have delicious food!')))->
    with('response')->
        isRedirected()->
        followRedirect()->
    
    info('1.3 - User successfully submit a suggestion and will be redirected to the Places page with a success message')->
    with('response')->begin()->
        checkElement('.info', '/Your suggestion has been submitted./i')->
    end();
    
/**
 * Feature 2: As a user, I can make requests or suggestions of menu items
 */

$browser->info('2 - Place Menu')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/places')->
    click('View Menu', array(), array('position' => 1))->
    
    info('2.1 - Suggest an Item link is displayed')->
    with('response')->begin()->
        checkElement('a.item-suggest-link', true)->
    end()->
    
    info('2.2 - User clicks on the Suggest an Item link')->
    click('Suggest an Item')->
    
    click('Suggest', array('suggestion' => array('type' => 'item', 'name' => 'New Item', 'description' => 'It\'s delicious!', 'price' => 100)))->
    with('response')->
        isRedirected()->
        followRedirect()->
    
    info('2.3 - User successfully submit a suggestion and will be redirected to the Place Menu page with a success message')->
    with('response')->begin()->
        checkElement('.info', '/Your suggestion has been submitted./i')->
    end();