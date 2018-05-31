<?php 
include('server.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="img/icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title> Smart Grocery </title>

        <!-- Icon css link -->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Rev slider css -->
        <link href="vendors/revolution/css/settings.css" rel="stylesheet">
        <link href="vendors/revolution/css/layers.css" rel="stylesheet">
        <link href="vendors/revolution/css/navigation.css" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        
        <link href="css/Home-style.css" rel="stylesheet">
        <link href="css/Home-responsive.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
        <!--================Header Menu Area =================-->
        <header class="main_menu_area">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <h3 class="brand-name"> <a class="navbar-brand" href="#"><img src="img/icon.png" height="70" width="70" alt=""></a>smartStorage</h3>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                      
                <li align="right"class="nav-item"><a class="nav-link" href="dashboard.php">Refresh Page</a></li>  
                 <li align="right"class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--================End Header Menu Area =================-->

        <!--================Banner Area =================-->
        <section class="banner_area">
            <div class="container">
                <div class="banner_inner_text">
                    <h2>Dashboard</h2>
                    <p>Welcome to your hub, now you can monitor your grocery levels right here</p>
                </div>
            </div>
        </section>
        <!--================End Banner Area =================-->

      
     <!-- -->
    
    

        <!-- /.container -->
    <div class="container">
    <?php
    
    $name = $_SESSION['username'];
    $product = $_SESSION['productid'];
    
        
    if(isset($name)) echo "Welcome to your page ".$name ."";
    echo "<br>";
    if(isset($productid)) echo "Your product id : ".$product ;
    

    $sql = "SELECT weight from weight WHERE p_id = $product AND time = ( SELECT MAX(time) from weight WHERE p_id = $product) ORDER by id DESC";
    
    $sql2 = "SELECT weight from weight2 WHERE p_id = $product AND ts = ( SELECT MAX(ts) from weight2 WHERE p_id = $product) ORDER by w_id DESC";
    
    $sql3 = "SELECT can from can WHERE p_id = $product AND time = ( SELECT MAX(time) from can WHERE p_id = $product) ORDER by id DESC";
    
    //  $sql2 = "SELECT distance FROM can WHERE c_id IN (SELECT c_id FROM can WHERE ts = (SELECT MAX(ts) FROM candespenser)) ORDER BY c_id DESC LIMIT 1";
     
     $result = mysqli_query($db,$sql);
     $result2 = mysqli_query($db,$sql2);
     $result3 = mysqli_query($db,$sql3);

    //  $result2 = mysqli_query($db,$sql2);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                if($row["weight"] < 1){
                    echo " 
                    <div class='alert alert-danger' role='alert'>
                      <h1>Weight #1</h1>
                      <h1> Current Weight: ". $row["weight"] . " g Left</h1>
                    </div>"; 
                }else
                {
                  echo " 
                    <div class='alert alert-primary' role='alert'>
                      <h1>Weight1</h1>
                      <h1> Current Weight: ". $row["weight"] . "g Left</h1>
                    </div>";
                }
                
                
                
            }
        } else {
            echo "
            <div class='alert alert-primary role='alert'>    
            0 results
            </div>";
        }
        
        if ($result2->num_rows > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result2)) {
                if($row["weight"] < 1){
                    echo " 
                    <div class='alert alert-danger' role='alert'>
                      <h1>Weight 2</h1>
                      <h1> Current Weight: ". $row["weight"] . "g Left</h1>
                    </div>";
                }
               
                else{
                  echo " 
                    <div class='alert alert-primary' role='alert'>
                      <h1>Weight2 </h1>
                      <h1> Current Weight: ". $row["weight"] . "g Left</h1>
                    </div>";
                }
                
                
                
            }
        } else {
            echo "
            <div class='alert alert-primary role='alert'>    
            0 results
            </div>";
        }
        
        if ($result3->num_rows > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result3)) {
                if($row["can"] < 1){
                    echo " 
                    <div class='alert alert-danger' role='alert'>
                      <h1>Can Dispenser</h1>
                      <h1> Can Dispenser: ". $row["can"] . "can(s) left </h1>
                    </div>"; 
                    
                   if($result3->num_rows<2){
                   $email='suzuki.coding93@gmail.com';
                   $subject = "Stock is low/out. Time to Restock!";
                   $message='One or more products are low or out of stock';
                   while($row=$result->fetch_assoc()) {
                      $message.="{$row['can']}\n";
                   }
                   if(mail($email, $subject, $message)) {
                      //mail successfully sent
                   } else {
                      //mail unsuccessful
                   }
                }
        
                    
                }else
                {
                  echo " 
                    <div class='alert alert-primary' role='alert'>
                      <h1>Can Dispenser</h1>
                      <h1> Can Dispenser: ". $row["can"] . " can(s) Left</h1>
                    </div>";
                }
                
                
                
            }
        } else {
            echo "
            <div class='alert alert-primary role='alert'>    
            0 results
            </div>";
        }
        $db->close();
    ?>  
      </div>
      <p class="text-info">*Notice: Our system may take a few minutes to update your grocery levels, please be patient...</p>
      </div>
      
      <script src="js/jquery-3.2.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Rev slider js -->
        <script src="vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <!-- Extra plugin css -->
        <script src="vendors/counterup/jquery.waypoints.min.js"></script>
        <script src="vendors/counterup/jquery.counterup.min.js"></script> 
        <script src="vendors/counterup/apear.js"></script>
        <script src="vendors/counterup/countto.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="vendors/magnify-popup/jquery.magnific-popup.min.js"></script>
        <script src="js/smoothscroll.js"></script>
        
        <script src="js/theme.js"></script>
      </body
      </html>