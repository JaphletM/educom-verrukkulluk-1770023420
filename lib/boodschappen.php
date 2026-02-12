<?php

class boodschappen
{
    private $connection;
    private $user;
    private $ingredients;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->user = new user($connection);
        $this->ingredients = new ingredient($connection);

    }


    public function boodschappenToevoegen($gerecht_id, $user_id)
    {
        $ingredienten = $this->ophalenIngredienten($gerecht_id);

        $totaalVerpakkingen = 0;

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


            $oudePacks = (int) ceil($huidig / $verpakking);
            $nieuwePacks = (int) ceil(($huidig + $nodig) / $verpakking);

            $extraPacks = $nieuwePacks - $oudePacks;
            if ($extraPacks > 0) {
                $totaalVerpakkingen += $extraPacks;
            }

            $nieuweAantal=$huidig+$nodig;

            if ($bestaat = false) {
                $this->artikelToevoegen($artikel_id, $user_id, $nieuweAantal);
            } else {
                $this->artikelBijwerken($artikel_id, $user_id, $nieuweAantal);
            }
        }

        return true;
    }




    private function ArtikelOpLijst($artikel_id, $user_id)
    {
        $boodschappen = $this->ophalenBoodschappen($user_id);

        foreach ($boodschappen as $boodschap) {
            if ($boodschap["artikel_id"] === $artikel_id) {
                return $boodschap;

            }
        }
        return false;
    }

    private function ophalenBoodschappen($user_id)
    {
        $sql = "SELECT * FROM boodschappen_lijst 
            WHERE user_id=$user_id";

        $return = [];

        $result = mysqli_query($this->connection, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $return[] = $row;
        }
        ;

        return $return;
    }

    private function ophalenIngredienten($gerecht_id)
    {

        return $this->ingredients->selecteerIngredient($gerecht_id);

    }


    private function artikelToevoegen($artikel_id, $user_id, $aantal)
    {



        $sql = "INSERT INTO boodschappen_lijst (user_id, artikel_id, aantal) 
            VALUES ('$user_id','$artikel_id','$aantal')";


        $result = mysqli_query($this->connection, $sql);

        return $result;

    }

    private function artikelBijwerken($artikel_id, $user_id, $nieuweAantal)
    {
        $sql = "UPDATE boodschappen_lijst 
            SET aantal = $nieuweAantal
            WHERE artikel_id = $artikel_id 
            AND user_id = $user_id";

        $result = mysqli_query($this->connection, $sql);

        return $result;


    }
}


?>

