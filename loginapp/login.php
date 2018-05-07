<?php

$email = $_POST["email"];
$pass = $_POST["pass"];


require "init.php";                     //this will help to connect to the database

$query = "select * from userinfo where email like '".$email."' and password like '".$pass."';";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result)>0)          //checking whether there is similar record 
{
    $response = array();
    $code = "login_true";
    $row = mysql_fetch_array($result);  //fetching the array from the variable result
    $name = $row[0];                    //getting the name from the row
    $message = "Welcome ".$name;
    
    array_push($response,array("code"=>$code,"message"=>$message));
    echo json_encode(array("server_response"=>$response));
}
else
{
    $response = array();
    $code = "login_false";
    $message = "Login failed! Try again...";
    
    array_push($response,array("code"=>$code,"message"=>$message));
    echo json_encode(array("server_response"=>$response));
}


?>