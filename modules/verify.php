

<?php

     include 'config1.php';
     if(isset($_POST['submit']))
     {
         $nm=$_POST['name'];
       
        $pass=$_POST['pass'];
        if( isset($nm) && isset($pass))
      {
        if(!empty($nm) && !empty($pass) )
        {


          
    
          $stmt = $conn->prepare("SELECT * FROM user WHERE uname= '$nm' AND password='$pass'"); 
            $stmt->execute();

             
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              print_r($result);
            if(count($result))
            {
              print_r($result);
          
            echo "<br>sucssess"; 
            session_start();
            // Use $HTTP_SESSION_VARS with PHP 4.0.6 or less
            
                $_SESSION['islogin'] ="1";
            
							header("location:../index.php");
            }
            else
            {
               header("location:../index.php?invalid=y");
            }
            
            
          }else
          {
             header("location:../index.php?invalid=y");
          }
        }
      }

?>