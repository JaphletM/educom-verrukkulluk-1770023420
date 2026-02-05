<?php 
class gerecht_info {
    private $connection;
    public function __construct($connection){
        $this->connection=$connection;
    }
        public function selecteerInfo($gerecht_info_id){
            $sql ="select * from gerecht_info where id=$gerecht_info_id";

            $result = mysqli_query($this->connection,$sql);
            $gerecht_info=mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            return($gerecht_info);
        }

        public function selecteerInfoMetUser($gerecht_id){

    $sql = "
        SELECT *
        FROM gerecht_info
        LEFT JOIN `user`
            ON user.id = gerecht_info.user_id
        WHERE gerecht_info.gerecht_id = $gerecht_id
          AND gerecht_info.record_type IN ('O','F')
    ";

    $result = mysqli_query($this->connection, $sql);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
    

    public function addFavorite($gerecht_id, $user_id){

    // 1) Check if favorite already exists
    $checkSql = "
        SELECT id 
        FROM gerecht_info 
        WHERE record_type = 'F'
        AND gerecht_id = $gerecht_id
        AND user_id = $user_id
    ";

    $checkResult = mysqli_query($this->connection, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Favorite already exists
        return true;
    }

    // 2) Insert new favorite
    $insertSql = "
        INSERT INTO gerecht_info (record_type, gerecht_id, user_id)
        VALUES ('F', $gerecht_id, $user_id)
    ";

    return mysqli_query($this->connection, $insertSql);
}


public function deleteFavorite($gerecht_id, $user_id){

    $sql = "
        DELETE FROM gerecht_info
        WHERE record_type = 'F'
        AND gerecht_id = $gerecht_id
        AND user_id = $user_id
    ";

    return mysqli_query($this->connection, $sql);
}
}