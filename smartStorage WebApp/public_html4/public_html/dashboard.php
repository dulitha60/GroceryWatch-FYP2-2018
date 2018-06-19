<?php 
include('server.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<meta http-equiv="refresh" content="15">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="img/icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title> Smart Grocery </title>

        <!-- Icon css link -->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/loading.css" rel="stylesheet">
        
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
               <h3 class="brand-name"> <a class="navbar-brand" href="https://smartstorage.000webhostapp.com/Home.php"><img src="img/icon.png" height="70" width="70" alt=""></a>smartStorage</h3>

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
                    <p>Welcome to your hub, now you can monitor your grocery levels of all your devices right here</p>
                </div>
            </div>
        </section>
        <!--================End Banner Area =================-->

      
     <!-- -->
     <div class="container">
            <button type="button"><a href="add-product.php">Create New Product</a></button>
            <button type="button"><a href="removeproduct.php">Remove Existing Product</a></button>
    </div>
    

        <!-- /.container -->
    <div class="container">
        <br>
     <a type='button' href='weightInfo.php' class='btn btn-info' >Info<a/>
    <br>
    <br><br>
    <?php
    
    $name = $_SESSION['username'];
    
        
    if(isset($name)) echo "Welcome to your page ".$name ."";
    echo "<br>";
    
    echo "<div class='card text-center'>
            <div class='card-header'>
                <ul class='nav nav-tabs card-header-tabs'>";
    
    $sql = "SELECT productid FROM products WHERE username = '$name' ";
    $result = mysqli_query($db, $sql);
   
    while ( $row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $p_id = $row["productid"];
    
    echo "<li class='nav-item'>
            <a class='nav-link' data-toggle='tab' href='#$p_id'>Product $p_id</a>
          </li>";
         
    }
    echo "      </ul>
            </div>
            
     <div class='card-body'>
                <div class='tab-content'>";
    
    $qsql = "SELECT productid FROM products WHERE username = '$name' ";
    $qresult = mysqli_query($db, $qsql);
    
    while ( $qrow = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
    $qp_id = $qrow["productid"]; 
    
    $Wsql = "SELECT weight from weight WHERE p_id = $qp_id AND time = ( SELECT MAX(time) from weight WHERE p_id = $qp_id) ORDER by id DESC";
    
    $Wresult = mysqli_query($db,$Wsql);
    
    
    $Csql = "SELECT can from can WHERE p_id = $qp_id AND time = (SELECT MAX(time) from can WHERE p_id = $qp_id) ORDER by id DESC";
    
        $Cresult = mysqli_query($db,$Csql);
          $row3 = mysqli_fetch_array($Cresult, MYSQLI_ASSOC);
        $xy = $row3["can"];
    
        while($xy && $row2 = mysqli_fetch_array($Wresult, MYSQLI_ASSOC)) {
                if($row2["weight"] < 20){
                    
                   echo " <div class='tab-pane fade show' id ='$qp_id' role='tabpanel' aria-labelledby='$qp_id-tab'>
                            <div class='alert alert-danger' role='alert'>
                              <h1>Weight $qp_id</h1>
                              <h1> Weight: ". $row2["weight"] . "g Left</h1>
                            </div>
                             
                        ";
                }else{
                    
                    echo" <div class='tab-pane fade show' id='$qp_id' role='tabpanel' aria-labelledby='$qp_id-tab'>
                            <div class='alert alert-primary' role='primary'>
                              <h1>Weight $qp_id</h1>
                              <h1> Weight: ". $row2["weight"] . "g Left</h1>
                            </div>
                              
                        ";
                    
                }

                            if($xy < 3){
                                
                               echo "   <div class='alert alert-danger' role='alert'>
                                          <h1>Can $qp_id</h1>
                                          <h1> Available Cans: $xy Left</h1>
                                        </div>
                                    </div>";
                            }else{
                                echo"   <div class='alert alert-primary' role='primary'>
                                          <h1>Can $qp_id</h1>
                                          <h1> Available Cans: $xy Left</h1>
                                        </div>
                                    </div>";
                            }
                                
                            
                }
                    
        }
    
        echo "      </div>
            </div>
          </div>";
        
    
        $db->close();
    ?>  
    

    <div class="loader">*Notice: Our system may take a few minutes to update your grocery levels, please be patient<span class="loader__dot">.</span><span class="loader__dot">.</span><span class="loader__dot">.</span><span class="loader__dot">.</span><span class="loader__dot">.</span><span class="loader__dot">.</span><span class="loader__dot">.</span><span class="loader__dot">.</span><span class="loader__dot">.</span></div></p>
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