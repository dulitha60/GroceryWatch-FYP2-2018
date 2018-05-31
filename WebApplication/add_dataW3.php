<?php

    
$servername = "localhost";
$username = "id5655845_smartdata";
$password = "1234567";
$db = "id5655845_smartdata";

$con = mysqli_connect($servername, $username, $password, $db);


$sql = "INSERT INTO  `weight` (`weight`, `weight1`) VALUES ('".$_GET["weight"]."', '".$_GET["weight1"]."')";

$run_query = mysqli_query($con, $sql);

if ($run_query) {
    include('emailnotification2.php');
} else {
    echo "oops";
}

?>