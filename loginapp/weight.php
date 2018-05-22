<?php

$host = "localhost";
$user = "dulitha";
$password = "duli123";
$dbname = "grocery";

$con = mysqli_connect($host,$user,$password,$dbname);//establish connection to the database

$query = "select * from weight;";

$result = mysqli_query($con, $query);
$response = array();

while($row = mysqli_fetch_array($result)){
    
    array_push($response,array('id'=>$row[0], 'time'=>$row[1],'weight'=>$row[2]));
    
}
mysqli_close($con);
echo json_encode(array('server_response'=>$response));



?>