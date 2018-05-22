<?php

$name = $_POST["name"];
$email = $_POST["email"];
$pass = $_POST["pass"];

require "init.php"; //this will help to connect to the database

$query = "select * from userinfo where email like '".$email."';";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result)>0) //checking whether there is similar record 
{
    $response = array();
    $code = "reg_false";
    $message = "User Already Exists!";
    array_push($response,array("code"=>$code,"message"=>$message));
    echo json_encode(array("server_response"=>$response));
}
else
{
    $query = "insert into userinfo values('".$name."','".$email."','".$pass."');";
    $result = mysqli_query($con, $query);
    
    //Checking whether the server gets the data
    if(!$result)
    {
        $response = array();
        $code = "reg_false";
        $message = "Some server error occurred! Please try again.. ";
        array_push($response,array("code"=>$code,"message"=>$message));
        echo json_encode(array("server_response"=>$response));
    }
    else
    {
        $response = array();
        $code = "reg_true";
        $message = "Registration Successful! Thank You! ";
        array_push($response,array("code"=>$code,"message"=>$message));
        echo json_encode(array("server_response"=>$response));
    }
    
    mysqli_close($con);
}

?>