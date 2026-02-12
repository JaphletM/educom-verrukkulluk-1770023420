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

    public function selecteerGerecht($gerecht_id=null){
        if($gerecht_id!==null){
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
                "comments" => $this->selectRemarks($row["id"]),
            ];
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
        return "€".round($totalPrijs/100,2) ;

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

    return $ratings;    

    }

    private function selectRemarks($gerecht_id){

        return $this->infor->selecteerInfo($gerecht_id,"O");
    
    }

    private function selectSteps($gerecht_id){
        $infor= $this->infor->selecteerInfo($gerecht_id,"B");

        $steps=[];
        
        foreach ($infor as $info){
            $steps[]=[
                "stap"=> $info["nummeriekveld"],
                "instructie"=> $info["tekstveld"],
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

    private function determineFavorite($user_id,$gerecht_id){
        $info=$this->infor->selecteerInfo($gerecht_id,"F");

        foreach ($info as $row){
            if($row["user_id"]==$user_id){
                return true;
            } 
                
        }
        return false;
    }
}

?>