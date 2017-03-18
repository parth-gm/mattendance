
<div class="container">
  
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">
      <img src="images/mattendance_logo_small.png" alt="mAttendance">
      <h4>Teacher's Section</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6">
      <form class="form-horizontal" action="index.php" method="post">
        <div class="form-group">
          <label for="inputEmail3" class="control-label">Username</label>
          <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Username">
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="control-label">Password</label>
          <input type="password" class="form-control" id="inputPassword3"  name="pass" placeholder="Password">
        </div>

        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-default" value="Sign in">
        </div>
      </form>
    </div>
  </div>
  <hr class="col-md-offset-3 col-md-6" />
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6 text-center">
      <h4>Student's Section</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-lg-6">
      <form class="form-horizontal" action="modules/studentdata.php" method="post">
        <div class="form-group">
          <label for="rollno" class="control-label">Roll No.</label>
          <input type="text" class="form-control" id="rollno"  name="rollno" placeholder="Roll No.">
           <input type="submit" name="ssubmit"  value=" GO ">
        </div>
      </form>
    </div>  
  </div>
</div>


    <?php

     include 'config.php';
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
            
              //header("location:modules/attendance.php");
            }
            else
            {
               header("location:../index.php");
            }
            
            
          }else
          {
             header("location:../index.php");
            echo "problem with credential";   
          }
        }
      }

?>