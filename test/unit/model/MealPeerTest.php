<?php

include(dirname(__FILE__).'/../../bootstrap/Propel.php');

$t = new lime_test(1);

$t->comment('::getMealPlaceId()');
$place = PlacePeer::doSelectOne(new Criteria()); //Select the first row in the list of places
$c     = new Criteria();
$c->add(MealPeer::PLACE_ID, $place->getId(), Criteria::EQUAL);
$meal = MealPeer::doSelectOne($c); //Select the row of specific meal given a specific place_id
$t->is(MealPeer::getMealPlaceId($place->getId()), $meal->getPlaceId(), '::getMealPlaceId() returns the place_id of a specific meal');