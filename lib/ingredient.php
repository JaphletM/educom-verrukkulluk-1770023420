<?php 

class ingredient{
    private $connection;
    private $artikel;

    public function __construct($connection){
        $this->connection=$connection;
        $this->artikel=new artikel($connection);

    }

    public function selecteerIngredient($gerecht_id){
        $sql ="select * from ingredient where gerecht_id=$gerecht_id";

        $return=[];
    

        $result=mysqli_query($this->connection,$sql);
         
       
        while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $artikel=$this->selecteerArtikel($row["artikel_id"]);
           
            $return[]=[
                "id"=> $row["id"],
                "gerecht_id"=>$row["gerecht_id"],
                "aantal"=>$row["aantal"],
                "artikel_id"=>$artikel["id"],
                "naam"=>$artikel["naam"],
                "calorie"=>$artikel["calorie"],
                "eenheid"=>$artikel["eenheid"],
                "verpakking"=>$artikel["verpakking"]
            ];
            
        }
           
        return $return;
    }


    private function selecteerArtikel($artikel_id){
    
        
    return $this->artikel->selecteerArtikel($artikel_id);
        
    }

    
}
?>
