<?php

include(dirname(__FILE__).'/../../bootstrap/Propel.php');

$t = new lime_test(1);

$t->comment('::checkUser()');
$username = 'patrick';
$password = 'password'; //This password will be hashed inside the ::checkUser() function
$t->is(UserPeer::checkUser($username, $password), true, '::checkUser() returns true if the user exists');