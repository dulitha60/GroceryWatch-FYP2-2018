<?php


$nameNew = $_SESSION['username'];
$deviceid = "";
$productid ="";



if(isset($_POST['add_device'])){

    //recieve input
	$deviceid = mysqli_real_escape_string($db,$_POST['deviceid']);
	$productid = mysqli_real_escape_string($db,$_POST['productid']);

     
     //validate input

	if (empty($deviceid)){array_push($errors,"DeviceID is required");}
	if (empty($productid)){array_push($errors,"ProductID is Required");}
	

//user validation-exist-dont exist

$user_check_query="SELECT * FROM configuration  WHERE deviceid='$deviceid' AND productid='$productid'";
$result = mysqli_query($db,$user_check_query);



if($result != FALSE && mysqli_num_rows($result) ===1){
		    echo "Device/Product is already registered";
		  }


else{
	
	$query = "INSERT INTO configuration (deviceid, productid) VALUES ( '$deviceid', '$productid')";
	mysqli_query($db,$query);
	//redirect user to dashboard
	header('Location: dashboard.php');
    exit;
       
    }
    
    
}

?>