<?php

require_once("lib/database.php");
require_once("lib/user.php");
require_once("lib/ingredient.php");
require_once("lib/artikel.php");
require_once("lib/gerecht_info.php");



/// INIT
$db = new database();

$ingr=new ingredient($db->getConnection());

$inf=new gerecht_info($db->getConnection());


/// VERWERK 
$ingredientdata=$ingr->selecteerIngredient(1);
$gerechtinfodata=$inf->selecteerInfo(1);


/// RETURN
echo"<pre>";
///var_dump($ingredientdata);
var_dump($gerechtinfodata);
