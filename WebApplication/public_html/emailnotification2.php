<?php 
include('server.php');

    $SQLCommand = "SELECT productid FROM users";
     
     $result = mysqli_query($db, $SQLCommand); // This line executes the MySQL query that you typed above

        while($row = mysqli_fetch_assoc($result)) {
           
           echo $row['productid'];
           
            foreach($row as $row1)
            {
                $productid = $row['productid'];
                
                
                $sqlselectweight = "SELECT weight from weight WHERE p_id = $productid AND time = (SELECT MAX(time) FROM weight WHERE p_id = $productid) ORDER BY id DESC";
                
                $resultweight = mysqli_query($db, $sqlselectweight);
                $row2 = mysqli_fetch_assoc($resultweight);
                
                echo $row2["weight"];
                
                foreach ($row2 as $row9)
                
                {
                
                    if($row2["weight"] < 10){
                        
                        $weight = $row2["weight"];
                    
                        $sqlselectp_id = "SELECT p_id from weight WHERE weight = $weight";
                        $resultp_id = mysqli_query($db, $sqlselectp_id);
                        $row3 = mysqli_fetch_assoc($resultp_id);
                        $p_id = $row3["p_id"];
                        echo $p_id;
                        
                            
                            
                                $sqlselectemail = "SELECT email FROM users WHERE productid = $p_id";
                                $resultemail = mysqli_query($db, $sqlselectemail);
                                $row4 = mysqli_fetch_assoc($resultemail);
                                $email = $row4["email"];
                                
                                            
                                    
                                       
                                            $sendemail= $email;
                                            $subject = "Stock is low/out. Time to Restock on your First casket!";
                                            $message='The weight on your 1st container is low';
                                           
                                                 $message.="{$weight}\n";
                                            
                                            if(mail($sendemail, $subject, $message)) {
                                                echo "doone";
                                                } else {
                                                echo "oops";
                                                }
                    }  
                }
         
            }
       
           
           
           
        }
         
     

?>