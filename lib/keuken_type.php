<?php 
class keuken_type{
private $connection;
public function __construct($connection){
    $this->connection=$connection;

}

public function selecteerKeukenType($keuken_id,$record_type){

$sql="SELECT * from keuken_type WHERE id=$keuken_id AND record_type =$record_type";

$result = mysqli_query($this->connection,$sql);
$keuken_type=mysqli_fetch_array($result,MYSQLI_ASSOC);

return($keuken_type);
}

}
