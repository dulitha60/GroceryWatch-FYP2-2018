<?php include('configure.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link href="css/validation-css.css" rel="stylesheet">

	<link rel="icon" href="img/icon.png" type="image/x-icon" />
       
        <title>Grocery Watch</title>
</head>
<body>

<div class="row">
    <h3 align="center">User Validation form</h3>
</div>
<div class="row">
    <h4 align="center">Device ID and Product ID can be found on your registration receipt.</h4>
</div>

<div class = "validation-page">
	<div class="form">
	<form method = "post" action = "validation.php">
  Device ID:<br>
  <input type="text" name="DeviceID">
  <br>
  Product ID:<br>
  <input type="text" name="productID">

   <button type="submit" name="validate_user">Submit</button>
   <p>Already a member?<a href="login.php">Sign in!</a></p>
   
   <p>If you don't have a registered device,<a href="https://smartstorage.000webhostapp.com/index.php">Please click here</a></p>
	</form>
	</div>


</div>

</body>
</html>