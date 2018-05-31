<?php

    
$servername = "localhost";
$username = "id5655845_smartdata";
$password = "1234567";
$db = "id5655845_smartdata";

$con = mysqli_connect($servername, $username, $password, $db);


$sql = "INSERT INTO `can` (`p_id`, `can`) VALUES ('".$_GET["p_id"]."', '".$_GET["can"]."')";

$run_query = mysqli_query($con,$sql);

if ($run_query) {
    include('emailnotification3.php');
} else {
    echo "oops";
}

?>