<?php


require_once("lib/database.php");
require_once("lib/user.php");
require_once("lib/ingredient.php");
require_once("lib/artikel.php");
require_once("lib/gerecht_info.php");
require_once("lib/gerecht.php");
require_once("lib/keuken_type.php");
require_once("lib/boodschappen.php");



/// INIT
$db = new database();



$bood= new boodschappen($db->getConnection());



/// VERWERK 

$boodschapdata=$bood->boodschappenToevoegen(1,1);




