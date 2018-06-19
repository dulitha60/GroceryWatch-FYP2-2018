<?php 
include('server.php');
include('add-client-server.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link href="css/validation-css.css" rel="stylesheet">

	<link rel="icon" href="img/icon.png" type="image/x-icon" />
       
        <title>Grocery Watch</title>
</head>
<body>
    
<div class="row">
    <h3 align="center">Add a new product</h3>
</div>

<div class = "validation-page">
	<div class="form">
	  <h2>  
    <?php 
        $nameNew1 = $_SESSION['username'];
        if(isset($nameNew1)) echo "Hi". " " .$nameNew1 ."! You can add 1 product now"; 
    ?> 
    </h2>
    
    
<form method = "post" action = "addClient.php">
    <?php include('errors.php'); ?>
  Device ID:<br>
  <input type="text" name="deviceid" >
  <br>
  Product ID:<br>
  <input type="text" name="productid" >

   <button type="submit" name="add_device">Add</button>
	</form>
	</div>


</div>

</body>
</html>