<?php 
class gerecht_info{

    private $connection;
    public function __construct($connection){
        $this->connection =$connection;
    }
    public function selecteerInfo($gerecht_info_id){
        $sql="select * from gerecht_info 
                LEFT JOIN user
                ON user.id = gerecht_info.user_id
                WHERE gerecht_info.gerecht_id = $gerecht_info_id";
                

        $result=mysqli_query($this->connection,$sql);
        $gerecht_info=mysqli_fetch_array($result,MYSQLI_ASSOC);

        return($gerecht_info);
    }
   public function addFavorite($gerecht_id, $user_id) {

    $sql = "
        INSERT INTO gerecht_info (record_type_id, gerecht_id, user_id)
        VALUES ('F', $gerecht_id, $user_id)
        
    ";

    return mysqli_query($this->connection, $sql);
    

    if ($obj->addFavorite($gerecht_id, $user_id)) {
    echo "Recipe $gerecht_id is favorited by $user_id";
} else {
    echo "Error: " . mysqli_error($connection);
}
    }

    public function deleteFavorite($gerecht_id, $user_id) {

    $sql = "
        DELETE FROM gerecht_info
        WHERE record_type_id = 'F'
          AND gerecht_id = $gerecht_id
          AND user_id = $user_id
    ";

    return mysqli_query($this->connection, $sql);
    
    }

}
?>