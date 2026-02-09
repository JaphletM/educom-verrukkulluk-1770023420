<?php 

class gerecht {
    private $connection;

    public function __construct($connection){
        $this->connection= $connection;

    }

    public function selecteerGerecht($gerecht_id){
        $sql="select * from gerecht where id=$gerecht_id";

        $result=mysqli_query($this->connection,$sql);
        $gerecht=mysqli_fetch_array($result,MYSQLI_ASSOC);

        return($gerecht);
    }

    private function selecteerUser($gerecht_id){

}

 public function
}
?>
    


















/* JOIN is voor later
    public function calcPrijs($gerecht_id){
    $sql = "
        SELECT ingredient.aantal, artikel.prijs, artikel.verpakking
        FROM ingredient 
        JOIN artikel 
            ON artikel.id = ingredient.artikel_id
        WHERE ingredient.gerecht_id = $gerecht_id
    ";

    $result = mysqli_query($this->connection, $sql);

    $totaal = 0;

   while($row = mysqli_fetch_assoc($result)){
        $totaal += ((float)$row['aantal'] / (float)$row['verpakking']) * (float)$row['prijs'];
    }

    return  "€".$totaal/100 ;
}
public function calCalorieen($gerecht_id){
    $sql="
        SELECT ingredient.aantal, artikel.calorie
        FROM ingredient 
        JOIN artikel 
            ON artikel.id = ingredient.artikel_id
        WHERE ingredient.gerecht_id = $gerecht_id
    ";


    $result = mysqli_query($this->connection, $sql);

    $totaal = 0;

   while($row = mysqli_fetch_assoc($result)){
        $totaal += (float)$row['aantal'] * (float)$row['prijs'];
    }

    return  $totaal ;
}

public function selecteerWaardering($gerecht_id){
    $sql="
        SELECT ingredient.aantal, artikel.calorie
        FROM ingredient 
        JOIN waardering 
            ON artikel.id = ingredient.artikel_id
        WHERE ingredient.gerecht_id = $gerecht_id
    ";
}*/

