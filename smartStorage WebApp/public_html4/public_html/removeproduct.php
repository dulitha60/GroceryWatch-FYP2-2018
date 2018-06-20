<?php include('delete-product.php') ?>
<!DOCTYPE html>
<html>
<head>
	<link href="css/validation-css.css" rel="stylesheet">

	<link rel="icon" href="img/icon.png" type="image/x-icon" />
       
        <title>Grocery Watch</title>
</head>
<body>

<div class="row">
    <h3 align="center">Delete a cabinet information</h3>
</div>
<div class="row">
    <h4 align="center">Please enter the device and product id of the cabinet you want to delete.</h4>
</div>

<div class = "validation-page">
	<div class="form">
	<form method = "post" action = "removeproduct.php">
	    
  Device ID:<br>
  <input type="text" name="deviceid" value="<?php echo $deviceid; ?>">
  <br>
  Product ID:<br>
  <input type="text" name="productid" value="<?php echo $productid; ?>">

   <button type="submit" name="remove_product">Delete</button>
	</form>
	</div>


</div>

</body>
</html>