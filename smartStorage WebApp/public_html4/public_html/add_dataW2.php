<?php

    
$servername = "localhost";
$username = "id5655845_smartdata";
$password = "1234567";
$db = "id5655845_smartdata";

$con = mysqli_connect($servername, $username, $password, $db);


$sql = "INSERT INTO `weight2` (`p_id`, `weight`) VALUES ('".$_GET["p_id"]."', '".$_GET["weight"]."')";

$run_query = mysqli_query($con,$sql);

if ($run_query) {
    include('emailnotifiction.php');
} else {
    echo "oops";
}

?>