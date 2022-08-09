<?php

/**
 *   Upon Clicking the Link, user arrives here and is asked to enter a new password. This page asks the User to Enter the New password. 
 * 1) send_reset_link.php (Sends the Reset Link) 
 * 2) reset_pass.php (Upon Clicking the Link, user arrives here and is asked to enter a new password
 * 3) submit_new.php (Logic to update the database with the new password)
 *
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */

require("connection.php");

if(isset($_GET['key']) && isset($_GET['reset']))
{
  $email=$_GET['key'];
  $pass=$_GET['reset'];

  $select=mysqli_query($con,"select `email`, `password` from `users` where `email`='$email' and `password`='$pass'");
  if(mysqli_num_rows($select)==1)
  {
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> WYDRN - Password Reset</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
      
    </head>

    <body>
    <div class="container" style="justify-content:center">    
    <!--HTML Form for Resetting Password-->
        <form method="POST" action="submit_new.php">
        <input type="hidden" name="email" value="<?php echo $email;?>">
        <p class="alert-success alert">Enter New password</p>
        <input type="password" name='password'>
        <input type="submit" name="submit_password">
        </form>
        <!--HTML Form for Resetting Password-->
  </div>
      </body>    
</html>



<?php
  }
}
//if the user directly lands on this page, then they are not allowed to access the page and requested to use a reset link.
else{
  echo "You need a proper verification link to reset your password. Can't find the link in your inbox? <a href='send_reset_link.php'>Send another one</a>";
}

mysqli_close($con);
?>