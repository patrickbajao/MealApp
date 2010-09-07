<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

/**
 * Feature 1: As a user, I can login to my account
 *
 * Given: I entered my correct username and password
 *   When I press the Login button
 *   Then I should be redirected to my home page
 */

$browser->info('1 - User Login')->
    info('1.1 - User enters his correct username and password then clicks the Login button')->
    get('/')-> 
    with('request')->begin()->
        click('Login')->
        post('/user/login', array('username' => 'patrick', 'password' => 'password'))->
    end()->
    with('response')->
        isRedirected()->
        followRedirect()->
    info('1.1.1 - Application redirects user to his home page')->
    with('response')->begin()->
        checkElement('#welcome', true)->
    end();