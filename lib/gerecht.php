<?php 
class gerecht {
    private $connection;
    private $user;
    private $ingredient;
    private $info;

    public function __construct($connection){
        $this->connection=$connection;
        $this->user=new user($connection);
        $this->ingredient=new ingredient($connection);
        $this->info=new gerecht_info($connection);
    }

    public function selecteerGerecht($gerecht_id){
        $sql="SELECT * from gerecht WHERE gerecht_id=$gerecht_id ";

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
        return $totalPrijs;

    }

    private function selectRating($gerecht_id){
        $informatie=$this->selecteerInfo($gerecht_id,"B");

        $ratings=[];

        foreach ($informatie as $info){
                $ratings[]=$info["nummeriekveld"];
        }

    return $ratings;    

    }

    private function selectSteps($gerecht_id){

    

}
?>