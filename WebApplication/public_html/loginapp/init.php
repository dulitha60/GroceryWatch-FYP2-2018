<?php

$host = "localhost";
$user = "id5655845_smartdata";
$password = "1234567";
$dbname = "id5655845_smartdata";

$con = mysqli_connect($host,$user,$password,$dbname);

if(!$con){ 
    die("Error in database connection". mysqli_connect_error());
}else{
    echo "<h3> Database connection Successfull ...";  
}





?>