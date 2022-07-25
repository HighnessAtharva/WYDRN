<!--
  Description: 
  Logic to update the database with the new password
  
  1) send_reset_link.php (Sends the Reset Link)
  2) reset_pass.php (Upon Clicking the Link, user arrives here and is asked to enter a new password)
  3) submit_new.php (Logic to update the database with the new password)
-->

<?php

include("connection.php");
if(isset($_POST['email']) && $_POST['password'] && $_POST['submit_password'])
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
  if (strlen($pass)<=8){
    echo "<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
                                top: 50px; left: 570px;' role='alert'>
                                  Password must be atleast 8 characters long!
                                </div></center>";
                                die;
  }
  $pass=password_hash($pass, PASSWORD_DEFAULT);
  
  $result=mysqli_query($con, "update users set password='$pass' where email='$email'");
  if ($result) {
  echo "Password Changed Successfully. Redirecting you to Login Page in 5 seconds";
  sleep(5);
  header("Location: login.php");
}else{
    echo "Error in Changing Password";
    }
}
mysqli_close($con);
?>