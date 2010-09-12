<?php

include(dirname(__FILE__).'/../../bootstrap/Propel.php');

$t = new lime_test(1);

$t->comment('::getMealPlaceId()');
$meal = MealPeer::doSelectOne(new Criteria()); //Select the row of specific meal given a specific place_id
$t->is(MealPeer::getMealPlaceId($meal->getId()), $meal->getPlaceId(), '::getMealPlaceId() returns the place_id of a specific meal');