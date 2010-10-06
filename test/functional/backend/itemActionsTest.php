<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new MealAppTestFunctional(new sfBrowser());

$browser->loadData();

/**
 * Feature 1: As an admin, I should be able to upload an excel file to add or update the menu items of a place
 */

$c = new Criteria();
$c->add(PlacePeer::NAME, 'Jollibee');
$place = PlacePeer::doSelectOne($c);
 
$browser->info('1 - Upload Menu Items')->
    login('mealapp.test@gmail.com', 'p4ssw0rd!')->
    get('/item')->
    
    info('1.1 - Admin user upload a CSV file containing menu items for a specific place')->
    click('Upload', array('item' => array('place_id' => $place->getId(), 'items' => sfConfig::get('sf_test_dir').'/fixtures/sample.csv')))->
    with('response')->
        isRedirected()->
        followRedirect()->
    
    info('1.2 - Menu items have been added successfully')->
    with('response')->begin()->
        checkElement('.notice', '/Items have been uploaded successfully/i')->
    end();