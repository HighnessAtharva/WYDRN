<?php
/**
 *  Displays Single Input Field asking user to enter an Email to Recieve the Password Link On.
 * On Form Submission It checks if the Email Entered is Registered with WYDRN Service and pushes an email if yes. 
 * 1) send_reset_link.php (Sends the Reset Link)
 * 2) reset_pass.php (Upon Clicking the Link, user arrives here and is asked to enter a new password)
 * 3) submit_new.php (Logic to update the database with the new password)
 *
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */


require("connection.php");
require("functions.php");
// DO NOT INCLUDE THE HEADER BECAUSE USER IS NOT LOGGED IN! IT WILL BE INCLUDED IN THE LOGIN PAGE.
?>


<html>
  <!-- Head begins -->
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title> WYDRN - Password Reset</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  </head>

  <!-- Body Begins -->
  <body>
  <div class="container" style="justify-content:center">
  <form method="post" action="send_reset_link.php">
          <p class="alert-success alert">Enter Email Address To Send Password Reset Link</p>
          <input type="text" name="email">
          <input type="submit" name="submit_email">
      </form>

      
    <script>
          // To prevent form resubmission when page is refreshed (F5 / CTRL+R) 
    if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
    }
    </script>
  </body>
</html>


<?php
if(isset($_POST['submit_email']) && $_POST['email'])
{
$email=$_POST['email'];
// Check if the email is registered with WYDRN Service
$select=mysqli_query($con,"SELECT `email`, `password` FROM `users` WHERE `email`='$email'");
if(mysqli_num_rows($select)==1){
  while($row=mysqli_fetch_array($select)){
    $email=($row['email']);
    $pass=($row['password']);
  }
  $link="<a href='localhost/WYDRN/reset_pass.php?key=".$email."&reset=".$pass."'".">Click Here To Reset Password</a>";
  // Check if mail was sent successfully
  if(send_reset_link($email, $link)){
      echo "Reset Link Sent to Your Email";
  }else{
      echo "Error in sending Password mail";
  }
}else{
  echo "Email Not Registered";
}	
}
mysqli_close($con);
?>