<?php

include(dirname(__FILE__).'/../../bootstrap/Propel.php');

$t = new lime_test(1);

$t->comment('->getUserCredential()');
$username = 'patrick';
$password = 'password';
$t->is(UserPeer::getUserCredential($username, $password));