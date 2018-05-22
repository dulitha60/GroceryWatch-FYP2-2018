<?php

$host = "localhost";
$user = "dulitha";
$password = "duli123";
$dbname = "userdb";

$con = mysqli_connect($host,$user,$password,$dbname);

if(!$con){ 
    die("Error in database connection". mysqli_connect_error());
}else{
    echo "<h3> Database connection Successfull ...";  
}





?>