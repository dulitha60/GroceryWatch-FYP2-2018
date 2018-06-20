<?php
session_start();

//decalre variables

$DeviceID ="";
$productID ="";


//connect to database
$db = mysqli_connect("localhost","id5655845_smartdata","1234567","id5655845_smartdata");


//validate product id and device id are avaliable

if(isset($_POST['validate_user'])){
       $DeviceID = mysqli_real_escape_string($db,$_POST['DeviceID']);
       $productID = mysqli_real_escape_string($db,$_POST['productID']);


        $query2="SELECT * FROM users WHERE productid = $productID";
		$result2 = mysqli_query($db,$query2);


		$query = "SELECT * FROM configuration WHERE DeviceID='$DeviceID' AND productID='$productID'";
		$result1 = mysqli_query($db,$query);
		
	

        if($result2 != FALSE && mysqli_num_rows($result2) ===1){
		    echo "Device/Product is already registered";
		  }
		        
		else if($result1  != FALSE && mysqli_num_rows($result1) === 1){
			$_SESSION['DeviceID'] = $DeviceID;
			$_SESSION['success'] = "You are now logged in";
			header('Location: register.php');
			exit;
		}
		
		else{
			echo "Device Not registered";
			echo "Product Doesnt Exist";
		}
	
}