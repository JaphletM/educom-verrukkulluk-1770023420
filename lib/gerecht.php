<?php 
class gerecht {
    private $connection;
    private $user;
    private $ingredients;
    private $infor;

    private $keuken;

    public function __construct($connection){
        $this->connection=$connection;
        $this->user=new user($connection);
        $this->ingredients=new ingredient($connection);
        $this->infor=new gerecht_info($connection);
        $this ->keuken=new keuken_type($connection);
    }

    public function selecteerGerecht($gerecht_id=0){
        if($gerecht_id>0){
        $sql="SELECT * from gerecht WHERE id=$gerecht_id ";
        } else{
            $sql= "SELECT* FROM gerecht";
        }

        $return=[];

        $result=mysqli_query($this->connection,$sql);

        while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $user=$this->selecteerUser($row["user_id"]);
            $keuken=$this->selectKitchen($row["keuken_id"],"K");
            $type=$this->selectType($row["type_id"],"T");
            $ingredients=$this->selecteerIngredient($row["id"]);
            


            $return[]=[
                "id"=> $row["id"],
                "keuken_type"=>$keuken["omschrijving"]??null,
                "gerecht_type"=>$type["omschrijving"]??null,
                "gerecht_titel"=>$row["titel"],
                "user_id"=>$user["id"],
                "usernaam"=>$user["naam"],
                "datum_toegevoegd"=>$row["datum_toegevoegd"],
                "korte omschrijving"=>$row["korte_omschrijving"],
                "lange omschrijving"=>$row["lange_omschrijving"],
                "afbeelding"=>$row["afbeelding"],
                "ingredients"=>$ingredients,
                "aantal calorieen"=>$this->calCalories($ingredients),
                "totaal prijs"=> $this->calcPrijs($ingredients),
                "steps" => $this->selectSteps($row["id"]),
                "ratings" => $this->selectRatings($row["id"]),
                "average_rating"=>$this->getAverageRating($row["id"]),
                "comments" => $this->selectRemarks($row["id"]),
                

            ];
        }
       
    if ($gerecht_id > 0) {
        return $return[0] ?? null;   
    }
        return $return;
    }

    private function selecteerUser($user_id){

        return $this->user->selecteerUser($user_id);

    }
    
    private function selecteerIngredient($gerecht_id){
        
    return $this->ingredients->selecteerIngredient($gerecht_id);

    }

    private function calCalories($ingredients){
        
        $totalCalories=0;

        foreach($ingredients as $ingredient){
            $aantal=$ingredient["aantal"];
            $calorie=$ingredient["calorie"];

            $totalCalories+= ($aantal*$calorie);
        }
        return (int) $totalCalories . " calorieen";

    }

    private function calcPrijs($ingredients){

        $totalPrijs= 0;

        foreach($ingredients as $ingredient){
            $aantal=$ingredient["aantal"];
            $prijs=$ingredient["prijs"];
            $verpakking=$ingredient["verpakking"];

            $totalPrijs+=($aantal/$verpakking)*$prijs;
        }
        return round($totalPrijs/100,2) ;

    }

    private function getAverageRating($gerecht_id){
    $ratings = $this->selectRatings($gerecht_id);

    $sum = 0;
    foreach ($ratings as $r){
        $sum += $r["rating"];
    }

    return count($ratings) ? round($sum / count($ratings), 1) : 0;
}

    private function selectRatings($gerecht_id){
        $infor=$this->infor->selecteerInfo($gerecht_id,"W");

        $ratings=[];
       
        foreach ($infor as $info){
            $user=$this->selecteerUser($info["user_id"]);
                $ratings[]=[
                    "user_id"=> $info["user_id"],
                    "usernaam"=>$user["naam"],
                    "rating"=> $info["nummeriekveld"]
                ];
        }

    return  $ratings;
    }

    private function selectRemarks($gerecht_id){

        $infor=$this->infor->selecteerInfo($gerecht_id,"O");
        $comments=[];
        
        foreach ($infor as $info){
            $comments[]=[
                "user"=> $info["naam"],
                "comment"=> $info["tekstveld"],
                 "afbeelding"=> $info["afbeelding"]
            ];
        }
        return $comments;

    
    }

    private function selectSteps($gerecht_id){
        $infor= $this->infor->selecteerInfo($gerecht_id,"B");

        $steps=[];
        
        foreach ($infor as $info){
            $steps[]=[
                "stap"=> $info["nummeriekveld"],
                "instructie"=> $info["tekstveld"]
               
            ];
        }
        return $steps;
    }


    private function selectKitchen($keuken_id,$record_type){

        return $this->keuken->selecteerKeukenType($keuken_id,$record_type);
 
    }

    private function selectType($type_id,$record_type){

        return $this->keuken->selecteerKeukenType($type_id,$record_type);
    }


} 

?>