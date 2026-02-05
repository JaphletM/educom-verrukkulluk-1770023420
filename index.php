<?php

require_once("lib/database.php");
require_once("lib/user.php");

/// INIT
$db = new database();
$user = new user($db->getConnection());
$art=new artikel($db->getConnection());
$keuken=new keuken_type($db->getConnection());

/// VERWERK 
$userdata = $user->selecteerUser(2);
$keukendata = $keuken->selecteerKeukenType(2);
$artikeldata=$art->selecteerArtikel(2);

/// RETURN
var_dump($userdata);
var_dump($keuken_data);
var_dump($artikeldata);
