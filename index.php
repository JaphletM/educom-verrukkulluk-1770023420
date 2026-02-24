<?php
//// Allereerst zorgen dat de "Autoloader" uit vendor opgenomen wordt:
require_once("./vendor/autoload.php");
require_once("lib/database.php");
require_once("lib/user.php");
require_once("lib/ingredient.php");
require_once("lib/keuken_type.php");
require_once("lib/artikel.php");
require_once("lib/gerecht_info.php");
require_once("lib/keuken_type.php");
require_once("lib/boodschappen.php");

/// Twig koppelen:
$loader = new \Twig\Loader\FilesystemLoader("./templates");
/// VOOR PRODUCTIE:
///$twig = new \Twig\Environment($loader), ["cache" => "./cache/cc"]);

/// VOOR DEVELOPMENT:
$twig = new \Twig\Environment($loader, ["debug" => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());

/******************************/

/// Next step, iets met je data doen. Ophalen of zo
require_once("lib/gerecht.php");
$db = new database();
$gerecht = new gerecht($db->getConnection());
$info = new gerecht_info($db->getConnection());
$data = $gerecht->selecteerGerecht();
$boodschappen = new boodschappen($db->getConnection());





/*
URL:
http://localhost/index.php?gerecht_id=4&action=detail
*/

$gerecht_id = isset($_GET["gerecht_id"]) ? $_GET["gerecht_id"] : "";
$action = isset($_GET["action"]) ? $_GET["action"] : "homepage";



switch ($action) {

    case "homepage": {
        $data = $gerecht->selecteerGerecht();
        $template = 'homepage.html.twig';
        $title = "homepage";
        break;
    }

    case "detail": {
        $data = $gerecht->selecteerGerecht($gerecht_id);
        $template = 'detail.html.twig';
        $title = "detail pagina";

        break;

    }

    case "toggle_favorite": {

        $favorite = $info->toggleFavorite(1, $gerecht_id);
        header('Content-Type: application/json');

        echo json_encode([
            "success" => true,
            "favorite" => $favorite
        ]);
        exit;
    }



    case "oplijst": {

        $data = $boodschappen->boodschappenToevoegen($gerecht_id, 1);
        header("Location: index.php?action=boodschappenlijst");
        exit;
    }

    case "boodschappenlijst": {
        $data = $boodschappen->getBoodschappenLijst(1);
        $template = 'boodschappenlijst.html.twig';
        $title = "boodschappen lijst";
        break;
    }

    case "rating": {

        $rating = $_GET["rating"];

        $waardering = $info->addRating($gerecht_id, $rating);
        header('Content-Type: application/json');

        echo json_encode([
            "success" => true,
            "waardering" => $waardering
        ]);
        exit;

    }

    case "delete": {

        $artikel_id = $_GET["artikel_id"];

        $delete = $boodschappen->deleteItem(1, $artikel_id);

       header("Location: index.php?action=boodschappenlijst");
    exit;
    }

    case "update_aantal":{
        $artikel_id = $_GET["artikel_id"];
        $aantal = $_GET["aantal_verpakkingen"]; 

        $update= $boodschappen->updateAantal($artikel_id,1,$aantal);

        header('Content-Type: application/json');

          echo json_encode([
            "success" => true,
            "update" => $update
        ]);

      

    }

    /// etc

}


/// Onderstaande code schrijf je idealiter in een layout klasse of iets dergelijks
/// Juiste template laden, in dit geval "homepage"
$template = $twig->load($template);


/// En tonen die handel!
echo $template->render(["title" => $title, "data" => $data,]);
