<?php

require_once("lib/database.php");
require_once("lib/user.php");

/// INIT
$db = new database();
$user = new user($db->getConnection());


/// VERWERK 
$data = $user->selecteerUser(2);

/// RETURN
var_dump($data);