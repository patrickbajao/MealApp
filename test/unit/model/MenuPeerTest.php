<?php

include(dirname(__FILE__).'/../../bootstrap/Propel.php');

$t = new lime_test(1);

$t->comment('::getPlaceMenu()');
$place = PlacePeer::doSelectOne(new Criteria); //Select the first row in the list of places
$c     = new Criteria();
$c->add(MenuPeer::PLACE_ID, $place->getId(), Criteria::EQUAL);
$t->is(MenuPeer::getPlaceMenu($place->getId()), MenuPeer::doSelectOne($c), '::getPlaceMenu() returns the menu of a specific meal');