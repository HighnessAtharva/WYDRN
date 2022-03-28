<?php

include("connection.php");
if(isset($_POST['email']) && $_POST['password'] && $_POST['submit_password'])
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
  $pass=password_hash($pass, PASSWORD_DEFAULT);
  
  $result=mysqli_query($con, "update users set password='$pass' where email='$email'");
  if ($result) {
  echo "Password Changed Successfully";
}else{
    echo "Error in Changing Password";
    }
}
?>