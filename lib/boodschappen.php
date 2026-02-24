<?php

class boodschappen
{
    private $connection;
    private $user;
    private $ingredients;

    private $artikel;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->user = new user($connection);
        $this->ingredients = new ingredient($connection);
        $this->artikel=new artikel ($connection);

    }


    public function boodschappenToevoegen($gerecht_id, $user_id)
    {
        $ingredienten = $this->ophalenIngredienten($gerecht_id);


        foreach ($ingredienten as $ingredient) {
            $artikel_id = (int) $ingredient["artikel_id"];
            $nodig = (int) $ingredient["aantal"];
            $verpakking = (int) $ingredient["verpakking"];


            $bestaat = $this->ArtikelOpLijst($artikel_id, $user_id);
         

            if ($bestaat != false) {
                $huidig = (int) $bestaat["aantal"];
            } else {
                $huidig = 0;
            }

            $nieuwePacks = (int) ceil(($huidig + $nodig) / $verpakking);


            if ($bestaat === false) {
                $this->artikelToevoegen($artikel_id, $user_id, $nodig, $nieuwePacks);
            } else {
                $this->artikelBijwerken($artikel_id, $user_id, $nodig, $nieuwePacks);
            }
        }

        return  $this->ophalenBoodschappen((int)$user_id);

    }

    


 

    private function ArtikelOpLijst($artikel_id, $user_id)
    {
        $boodschappen = $this->ophalenBoodschappen($user_id);


        foreach ($boodschappen as $boodschap) {
            if ($boodschap["artikel_id"] == $artikel_id) {
                return $boodschap;

            }
        }
        return false;

    }


    private function ophalenIngredienten($gerecht_id)
    {

        return $this->ingredients->selecteerIngredient($gerecht_id);

    }

    private function ophalenBoodschappen($user_id)
    {

        $sql = "SELECT * FROM boodschappen_lijst 
            WHERE user_id=$user_id";

       $return = [];

    $result = mysqli_query($this->connection, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $artikel = $this->artikel->selecteerArtikel($row["artikel_id"]);
        $return[] = [
            "artikel_id"=>$row["artikel_id"],
            "aantal"=>$row["aantal"],
            "aantal_verpakkingen"=>$row["aantal_verpakkingen"],
            "naam"=>$artikel["naam"],
            "eenheid"=>$artikel["eenheid"],
            "prijs"=>$artikel["prijs"]
        ];
    }

        return $return;
    }

    private function artikelToevoegen($artikel_id, $user_id, $aantal, $aantalverpakkingen)
    {


        $sql = "INSERT INTO boodschappen_lijst (user_id, artikel_id, aantal, aantal_verpakkingen) 
            VALUES ('$user_id','$artikel_id','$aantal','$aantalverpakkingen')";


        $result = mysqli_query($this->connection, $sql);

        return $result;

    }

    private function artikelBijwerken($artikel_id, $user_id, $extraAantal, $aantalverpakkingen)
    {
        $sql = "UPDATE boodschappen_lijst 
            SET aantal = aantal+$extraAantal, 
            aantal_verpakkingen= $aantalverpakkingen
            WHERE artikel_id = $artikel_id
            AND user_id = $user_id";

        $result = mysqli_query($this->connection, $sql);

        return $result;


    }
}


?>

