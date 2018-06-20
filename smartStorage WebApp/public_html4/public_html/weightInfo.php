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
               <h3 class="brand-name"> <a class="navbar-brand" href="https://smartstorage.000webhostapp.com/Home.php" ><img src="img/icon.png" height="70" width="70" alt=""></a>smartStorage</h3>

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
                    <h2>Your Current and Previous records</h2>
                    <p>Welcome to your Dashboard, now you can monitor your grocery levels right here</p>
                </div>
            </div>
        </section>
        
        
       <div class="container" styles="mardin-top:35px">
           <h4>Slect Number of Rows</h4>
           <div class="form-group">
                <select name="state" id="maxRows" class="form-control" style="width:150px;">
                    <option value="50">Show All</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>
           <table id= "mytable" class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th>ProductID</th>
                    <th>Weight</th>
                  </tr>
               </thead>
               <tbody>
       <?php
       
       $name = $_SESSION['username'];
       
       $sql = "SELECT productid FROM products WHERE username = '$name' ";
       $result = mysqli_query($db, $sql);
   
       while ( $row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
       $p_id = $row["productid"];
       
       
       $sql = "SELECT p_id , weight  from weight WHERE p_id = $p_id  ORDER by time DESC";
       
       $result = mysqli_query($db,$sql);
       
            
            while ($row = mysqli_fetch_array($result))
		{
			echo "<tr>
			        <td>{$row['p_id']}</td>
			        <td>{$row['weight']}</td>
			        </tr>\n";
        }
        
        }?>
        </tbody> 
        </table>
        
            <div class="pagination-container">
                <nav>
                    <ul class="pagination">
                     
                    </ul>
                </nav>
            </div>
     
       </div>
       
       
      <script src="js/jquery.min.js"></script>
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
        
        <script>
           var table = '#mytable'
           $('#maxRows').on('change', function(){
               $('.pagination').html('')
               var trnum = 0
               var maxRows = parseInt($(this).val())
               var totalRows = $(table+' tbody tr').length
               $(table+' tr:gt(0)').each(function(){
                   trnum++
                   if(trnum > maxRows){
                       $(this).hide()
                   }
               
                   if(trnum <= maxRows){
                       $(this).show()
                   }
               })
               if(totalRows > maxRows){
                   var pagenum = Math.ceil(totalRows/maxRows)
                   for(var i=1;i<=pagenum;){
                       $('.pagination').append('<li data-page="'+i+'">\<span>'+ i++ +'<span class="sr-only">(current)</span></span>\</li>').show()
                   }
               }
               $('.pagination li:first-child').addClass('active')
               $('.pagination li').on('click', function(){
                   var pageNum = $(this).attr('data-page')
                   var trIndex = 0;
                   $('.pagination li').removeClass('active')
                   $(this).addClass('active')
                   $(table+' tr:gt(0)').each(function(){
                       trIndex++
                       if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                           $(this).hide()
                       }else{
                           $(this).show()
                       }
                    })
               })
           })
           $(function(){
               $('table tr:eq(0)').prepend('<th>ID</th>')
               var id = 0;
               $('table tr:gt(0)').each(function(){
                   id++
                   $(this).prepend('<td>'+id+'</td>')
               })
           })
       </script>
      </body
      </html>