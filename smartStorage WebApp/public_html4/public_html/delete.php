<?php 
include('server.php');

//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$result = mysqli_query($db, "DELETE FROM userDeleted WHERE deviceid=$id");
$result2 = mysqli_query($db, "DELETE FROM configuration WHERE deviceid=$id");
 
//redirecting to the display page (deleteddevices.php in our case)
header("Location:deleteddevices.php");

?>