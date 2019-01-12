<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id, type FROM users WHERE username = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      $type = $row['type'];
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1 && $type == "admin") {
         $_SESSION['login_user'] = $myusername;
         header("location: session.php");
      }
      if($count == 1 && $type == "user") {
         echo "You have no admin rights!";
      }
      else {
         echo "Your Login Name or Password is invalid!";
      }
   }
?>