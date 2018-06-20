<?php


$nameNew = $_SESSION['username'];
$DeviceID = "";
$productID = "";
$productidNew ="";

$db = mysqli_connect("localhost","id5655845_smartdata","1234567","id5655845_smartdata");

if(isset($_POST['add_product'])){

    //recieve input
	$deviceid = mysqli_real_escape_string($db,$_POST['deviceid']);
	$productidNew = mysqli_real_escape_string($db,$_POST['productid']);

     
     //validate input

	if (empty($deviceid)){array_push($errors,"DeviceID is required");}
	if (empty($productidNew)){array_push($errors,"ProductID is Required");}
	

//user validation-exist-dont exist

$user_check_query="SELECT * FROM products  WHERE deviceid='$deviceid' AND productid='$productidNew'";
 $result = mysqli_query($db,$user_check_query);

$user_check_query1="SELECT * FROM configuration WHERE DeviceID='$deviceid' AND productID='$productidNew'";
$result1 = mysqli_query($db,$user_check_query1);


if($result1  != FALSE && mysqli_num_rows($result1) === 1){
	
	$query = "INSERT INTO products (deviceid, productid, username) VALUES ( '$deviceid', '$productidNew', '{$_SESSION['username']}')";
	mysqli_query($db,$query);
	//redirect user to dashboard
	header('Location: dashboard.php');
    exit;
       
    }

 else if($result != FALSE && mysqli_num_rows($result) === 1){
 		    echo "Device/Product is already registered";
 		  }
		  
    else{
        echo "Device/Product not registered";
        
    }
}

?>