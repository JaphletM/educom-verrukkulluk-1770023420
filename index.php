<?php

require_once("lib/database.php");
require_once("lib/user.php");
require_once("lib/ingredient.php");
require_once("lib/artikel.php");
require_once("lib/gerecht_info.php");
require_once("lib/gerecht.php");
require_once("lib/keuken_type.php");



/// INIT
$db = new database();

$ingr=new ingredient($db->getConnection());

$inf=new gerecht_info($db->getConnection());

$gerecht=new gerecht($db->getConnection());



/// VERWERK 
$ingredientdata=$ingr->selecteerIngredient(1);
$gerechtinfodata=$inf->selecteerInfo(1,"B");
$gerechtdata=$gerecht->selecteerGerecht();



/// RETURN
echo"<pre>";
//var_dump($ingredientdata);
//var_dump($gerechtinfodata);
var_dump($gerechtdata);

