<?php

require_once("lib/database.php");
require_once("lib/user.php");
require_once("lib/ingredient.php");
require_once("lib/keuken_type.php");
require_once("lib/artikel.php");

/// INIT
$db = new database();
$user = new user($db->getConnection());
$art=new artikel($db->getConnection());
$keuken=new keuken_type($db->getConnection());
$ingr=new ingredient($db->getConnection());

/// VERWERK 
$userdata = $user->selecteerUser(2);
$keukendata = $keuken->selecteerKeukenType(2);
$artikeldata=$art->selecteerArtikel(2);
$ingredientdata=$ingr->selecteerIngredient(2);

/// RETURN
var_dump($userdata);
echo"<br>";
var_dump($keukendata);
echo"<br>";
var_dump($artikeldata);
echo"<br>";
var_dump($ingredientdata);
echo"<br>";
