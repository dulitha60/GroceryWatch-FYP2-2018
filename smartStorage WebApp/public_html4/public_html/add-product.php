<?php 
include('server.php');
include('add-product-server.php');
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
    <h3 align="center">Add product form</h3>
</div>
<div class="row">
    <h4 align="center">You can now monitor more than one Cabinet!.</h4>
</div>

<div class = "validation-page">
	<div class="form">
	  <h2>  <?php 
        $nameNew1 = $_SESSION['username'];
        if(isset($nameNew1)) echo "Hello". " " .$nameNew1 ."!"; 
    ?> </h2>
    
<form method = "post" action = "add-product.php">
    <?php include('errors.php'); ?>
  Device ID:<br>
  <input type="text" name="deviceid" >
  <br>
  Product ID:<br>
  <input type="text" name="productid" >

   <button type="submit" name="add_product">Add</button>
	</form>
	</div>


</div>

</body>
</html>