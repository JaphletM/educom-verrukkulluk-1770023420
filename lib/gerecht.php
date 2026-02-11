<?php 
class gerecht {
    private $connection;
    private $user;
    private $ingredient;
    private $infor;

    private $keuken;

    public function __construct($connection){
        $this->connection=$connection;
        $this->user=new user($connection);
        $this->ingredient=new ingredient($connection);
        $this->infor=new gerecht_info($connection);
        $this ->keuken=new keuken_type($connection);
    }

    public function selecteerGerecht($gerecht_id){
        $sql="SELECT * from gerecht WHERE id=$gerecht_id ";

        $return=[];

        $result=mysqli_query($this->connection,$sql);

        while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $return[]=$row;
        }
        return $return;
    }

    private function selecteerUser($user_id){

        return $this->user->selecteerUser($user_id);

    }
    
    private function selecteerIngredient($gerecht_id){
        
    return $this->ingredient->selecteerIngredient($gerecht_id);

    }

    private function calCalories($gerecht_id){
        $ingredients=$this->selecteerIngredient($gerecht_id);

        $totalCalories=0;

        foreach($ingredients as $ingredient){
            $aantal=$ingredient["aantal"];
            $calorie=$ingredient["calorie"];

            $totalCalories+=($aantal*$calorie);
        }
        return $totalCalories;

    }

    private function calcPrijs($gerecht_id){
        $ingredients= $this->selecteerIngredient($gerecht_id);

        $totalPrijs= 0;

        foreach($ingredients as $ingredient){
            $aantal=$ingredient["aantal"];
            $prijs=$ingredient["prijs"];

            $totalPrijs+=($aantal*$prijs);
        }
        return $totalPrijs/100 ;

    }

    private function selectRating($gerecht_id){
        $infor=$this->infor->selecteerInfo($gerecht_id,"W");

        $ratings=[];

        foreach ($infor as $info){
                $ratings[]=$info["nummeriekveld"];
        }

    return $ratings;    

    }

    private function selectSteps($gerecht_id){
        $infor= $this->infor->selecteerInfo($gerecht_id,"B");

        $steps=[];
        
        foreach ($infor as $info){
            $steps[]=[
                "nummer"=> $info["nummeriekveld"],
                "instructie"=> $info["tekstveld"],
            ];
        }
        return $steps;
    }


    private function selectKitchen($keuken_id, $record_type){

    return $this->keuken->selecteerKeukenType($keuken_id, ["K"]);
 
    }

    private function selectType($keuken_id,$record_type){

        return $this->keuken->selecteerKeukenType($keuken_id, ["T"]);
    }

    private function determineFavorite($user_id,$gerecht_id){
        $info=$this->infor->selecteerInfo($gerecht_id,["F"]);

        foreach ($info as $row){
            if($row["record_type"]=="F"&& $row["user_id"]==$user_id){
                return true;
            
            } else {
                return false;
            }
        }

    }
}

?>