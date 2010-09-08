<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

/**
 * Feature 1: As a user, I can pick a menu item from the place chosen to eat
 */

$browser->info('1 - Pick a menu item from the place chosen to eat')->
    info('1.1 - User picks a menu item')->
    get('/order/1')->
    with('response')->
    with('request')->begin()->
        click('Login', array('signin' => array('username' => 'tester', 'password' => 'p4ssw0rd!')))->
    end()->
    with('response')->
        isRedirected()->
        followRedirect()->
    click('Yum', array(), array('position' => 1))->
    with('request')->begin()->
        click('Place Order')->
    end()->
    with('response')->
        isRedirected()->
        followRedirect()->
    with('response')->begin()->
        checkElement('.info', '/Your order has been placed./i')->
    end();