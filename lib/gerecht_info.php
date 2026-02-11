<?php

class gerecht_info{
    private $connection;
    private $user;
    public function __construct($connection){
        $this->connection=$connection;
        $this->user=new user($connection);
    }

public function selecteerInfo($gerecht_id, $record_type){
    $sql="select * from gerecht_info where gerecht_id=$gerecht_id AND record_type=$record_type";

    $return=[];

    $result=mysqli_query($this->connection,$sql);
    
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

        if($row["record_type"]=="O"||$row["record_type"]=="F" ){
            $user=$this->selecteerUser($row["user_id"]);

            $return[]= [
            "id"=>$row["id"],
            "record_type"=>($row["record_type"]),
            "gerecht_id"=>($row["gerecht_id"]),
            "user_id"=>($user["id"]),
            "naam"=>($user["naam"]),
            "email"=>($user["email"]),
            "wachtwoord"=>($user["wachtwoord"]),
            "afbeelding"=>($user["afbeelding"]),
            "datum"=>($row["datum"]),
            "nummeriekveld"=>($row["nummeriekveld"]),
            "tekstveld"=>($row["tekstveld"]),
            
             ];
           
        }else{
        $return[]= $row;
    }
}
    return $return;
}

private function selecteerUser($user_id){

    return $this->user->selecteerUser($user_id);
}

private function addFavorite($user_id,$gerecht_id){
    $sql= "INSERT INTO gerecht_info (user_id, gerecht_id, record_type) VALUES
    ('$user_id','$gerecht_id','F')"; 

    $result =mysqli_query($this->connection,$sql);

    return($result);
}

private function deleteFavorite($user_id,$gerecht_id){
     $sql= "DELETE FROM gerecht_info WHERE user_id=$user_id AND gerecht_id=$gerecht_id AND record_type='F'";

    $result =mysqli_query($this->connection,$sql);
    
    return($result);
    }
}



?>