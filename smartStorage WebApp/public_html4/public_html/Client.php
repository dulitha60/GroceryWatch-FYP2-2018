<?php 
include('server.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="refresh" content="15">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="img/icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title> Smart Grocery </title>

        <!-- Icon css link -->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        
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
                    <h2>Admin Page</h2>
                    <?php 
                        // $nameNew1 = $_SESSION['username'];
                        if(isset($nameNew1)) echo "Hello". " " .$nameNew1 ."! You can manage all your smartStorage devices here"; 
                    ?>
                </div>
            </div>
        </section>
        <!--================End Banner Area =================-->

      
     <!-- -->
     <div class="container">
            <button type="button"><a href="addClient.php">Add a new product</a></button>
            <button type="button"><a href="deleteddevices.php">Deleted Devices</a></button>
            
            <div class = "table-responsive">
                <table class="table table-hover" "table table-dark">
                    <thead> 
                        <tr>
                            <th>Device ID</th>
                            <th>Product ID</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT deviceid , productid  from configuration";
       
                        $result = mysqli_query($db,$sql);
       
            
                        while ($row = mysqli_fetch_array($result))
		                {
			                echo "<tr>
			                <td>{$row['deviceid']}</td>
			                <td>{$row['productid']}</td>
			                </tr>\n";
                    }?>
                        
                    </tbody>
                </table>
                
            </div>
        </div>
    
      </div>
    
    

    <!-- /.container -->
    <div class="container">
    
      
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