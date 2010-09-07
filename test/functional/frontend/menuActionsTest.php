<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

/**
 * Feature 1: As a user, I can pick a menu item from the place chosen to eat
 */

$browser->info('1 - Pick a menu item from the place chosen to eat')->
    info('1.1 - User picks a menu item')->
    get('/chosen/menu')->
    click('Yum', array(), array('position' => 1))->
    with('request')->begin()->
        click('Place Order')->
    end()->
    with('response')->
        isRedirected()->
        followRedirect()->
    info('1.1.1 - Application redirects user to his home page')->
    with('response')->begin()->
        checkElement('.info', '/Your order has been placed./i')->
    end();