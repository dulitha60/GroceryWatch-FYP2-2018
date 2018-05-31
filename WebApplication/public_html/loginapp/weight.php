<?php

$host = "localhost";
$user = "id5655845_smartdata";
$password = "1234567";
$dbname = "id5655845_smartdata";

$con = mysqli_connect($host,$user,$password,$dbname);//establish connection to the database

$query = "select id,time,weight from weight order by id desc limit 10;";

$result = mysqli_query($con, $query);
$response = array();

while($row = mysqli_fetch_array($result)){
    
    array_push($response,array('id'=>$row[0], 'time'=>$row[1],'weight'=>$row[2]));
    
}
mysqli_close($con);
echo json_encode(array('server_response'=>$response));



?>