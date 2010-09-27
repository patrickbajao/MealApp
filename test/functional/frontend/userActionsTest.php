<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new MealAppTestFunctional(new sfBrowser());

$browser->loadData();

/**
 * Feature 1: As a user, I can login to my account
 */

$browser->
    info('1 - User Login')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/')->
    with('response')->begin()->
        checkElement('#welcome', true)->
    end()
;