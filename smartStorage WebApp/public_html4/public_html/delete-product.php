<?php
session_start();


$deviceid = "";
$productid = "";


$db = mysqli_connect("localhost","id5655845_smartdata","1234567","id5655845_smartdata");

if(isset($_POST['remove_product'])){
    
    $name = $_SESSION['username'];

    //recieve input
	$deviceid = mysqli_real_escape_string($db,$_POST['deviceid']);
	$productid = mysqli_real_escape_string($db,$_POST['productid']);
	
	


    $sql="DELETE FROM products WHERE deviceid = '$deviceid' AND productid = '$productid'";
    $resultsql = mysqli_query($db,$sql);


    if($resultsql != FALSE && mysqli_affected_rows($db)==1){
        
        
            $query = "INSERT INTO userDeleted (deviceid, productid, username) VALUES ( '$deviceid', '$productid', '$name')";
	        mysqli_query($db,$query);
	        
	
		    header('Location: dashboard.php');
	        exit;
            
            echo "Device/Product is deleted!";
		  }

    else{
        echo "Device/Product not registered";
        
    }
    
}

if(isset($_POST['delete_prod'])){
    
    $name = $_SESSION['username'];

    //recieve input
	$deviceid = mysqli_real_escape_string($db,$_POST['deviceid']);
	$productid = mysqli_real_escape_string($db,$_POST['productid']);
	
	


    $sql="DELETE FROM userDeleted WHERE deviceid = '$deviceid' AND productid = '$productid'";
    $resultsql = mysqli_query($db,$sql);


    if($resultsql != FALSE && mysqli_affected_rows($db)==1){
        
        
            $query = "INSERT INTO userDeleted (deviceid, productid, username) VALUES ( '$deviceid', '$productid', '$name')";
	        mysqli_query($db,$query);
	        
	
		    header('Location: dashboard.php');
	        exit;
            
            echo "Device/Product is deleted!";
		  }

    else{
        echo "Device/Product not registered";
        
    }
    
}
?>