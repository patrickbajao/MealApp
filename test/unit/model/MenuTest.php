<?php

include(dirname(__FILE__).'/../../bootstrap/Propel.php');

$t = new lime_test(1);

$t->comment('->getMenuItems()');
$menu = MenuPeer::doSelectOne(new Criteria()); //Select the first row in the list of menus
$c    = new Criteria();
$c->add(ItemPeer::MENU_ID, $menu->getId(), Criteria::EQUAL);
$t->is($menu->getMenuItems(), ItemPeer::doSelect($c), '->getMenuItems() returns all items of a specific menu');