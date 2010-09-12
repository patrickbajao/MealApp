<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$loader = new sfPropelData();
$loader->loadData(sfConfig::get('sf_test_dir').'/fixtures');

/**
 * Feature 1: As a user, I can vote on where to eat
 */

$browser->info('1 - Vote Page')->
    get('/meals')->
    with('response')->
    with('request')->begin()->
        click('Login', array('signin' => array('username' => 'tester', 'password' => 'p4ssw0rd!')))->
    end()->
    with('response')->
        isRedirected()->
        followRedirect()->
    info('1.1 - User clicks on the Vote link')->
    with('request')->begin()->
        click('Vote', array(), array('position' => 1))-> //First Vote button will be clicked
    end()->
    info('1.2 - User chooses a place from the list')->
    select('vote[place_id]', array('position' => 1))-> //First radiobutton will be selected
    info('1.3 - User clicks on the Place Vote button')->
    with('request')->begin()->
        click('Place Vote')->
    end()->
    with('response')->
        isRedirected()->
        followRedirect()->
    info('1.3.1 - User successfully voted and will be redirected to the Meals page with a success message')->
    with('response')->begin()->
        checkElement('.info', '/Your vote has been placed./i')->
    end();