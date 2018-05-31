<?php
session_start();

//intialising variables

$username="";
$email="";
$productid="";
$password_1="";
$userID="";


$errors = array();

//connecting to database

$db = mysqli_connect("localhost","id5655845_smartdata","1234567","id5655845_smartdata");

//register user

if(isset($_POST['reg_user'])){

    //recieve input
	$username = mysqli_real_escape_string($db,$_POST['username']);
	$email = mysqli_real_escape_string($db,$_POST['email']);
	$password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db,$_POST['password_2']);
	$productid = mysqli_real_escape_string($db,$_POST['productid']);

     
     //validate input

	if (empty($username)){array_push($errors,"Username is required");}
	if (empty($email)){
		array_push($errors,"Email is Required");
	}
	if ($password_1 != $password_2){
		array_push($errors,"The two passwords do not match");
	}

	if(empty($productid)){
		array_push($errors,"Please Enter your product id");
	    
	}


//user validation-exist-dont exist

$user_check_query="SELECT * FROM users  WHERE username='$username' OR email='$email' OR productid='$productid'  LIMIT 1";
$result = mysqli_query($db,$user_check_query);

$user = ($result != FALSE && mysqli_fetch_assoc($result));

if($user){
	if($user['username'] === $username){
		array_push($errors,"Username already exist");
	}

	if($user['email'] === $email){
		array_push($errors,"Email already exists");
	}

	if($user['productid'] === $productid){
		array_push($errors,"Product ID is already used!");
	}
}


//if no errors-register
if(count($errors) == 0){
	$password = md5($password_1);  //passowrd encyrption mechanism

	$query = "INSERT INTO users (username,email,password,productid) VALUES ('$username', '$email', '$password', '$productid')";

	mysqli_query($db,$query);
	$_SESSION['productid'] = $productid;
	$_SESSION['username'] = $username;
	$_SESSION['success'] = "Congrats! You are now logged in!";
	//redirect user to dashboard
	header('Location: dashboard.php');

 }
}



//login user

if(isset($_POST['login_user'])){
	$username = mysqli_real_escape_string($db,$_POST['username']);
	$password = mysqli_real_escape_string($db,$_POST['password']);
	$productid = mysqli_real_escape_string($db,$_POST['productid']);
	
	if(empty($username)){
		array_push($errors,"Username is required");
	}

	if(empty($password)){
		array_push($errors,"Password is required");
	}
	
	if(empty($productid)){
		array_push($errors,"Product id is required");
	}

	if(count($errors) == 0){
		$password = md5($password);
		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND productid='$productid'";
		$results = mysqli_query($db,$query);
		
	    
		if($results != FALSE && mysqli_num_rows($results) == 1){
		    
		    $_SESSION['productid'] = $productid;
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('Location: dashboard.php');
		}
		else{
			array_push($errors,"Please check your credentials!");
		}
	}
	
}







?>