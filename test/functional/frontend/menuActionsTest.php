<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

/**
 * Feature 1: As a user, I can pick a menu item from the place chosen to eat
 */

$browser->info('1 - Order Page')->
    get('/order/1')->
    with('response')->
    with('request')->begin()->
        click('Login', array('signin' => array('username' => 'tester', 'password' => 'p4ssw0rd!')))->
    end()->
    with('response')->
        isRedirected()->
        followRedirect()->
    info('1.1 - User picks a menu item')->
    select('item[1]')->
    info('1.2 - User clicks on the Place Order button')->
    with('request')->begin()->
        click('Place Order')->
    end()->
    with('response')->
        isRedirected()->
        followRedirect()->
    info('1.2.1 - User successfully ordered and will be redirected to the Menu page with a success message')->
    with('response')->begin()->
        checkElement('.info', '/Your order has been placed./i')->
    end();