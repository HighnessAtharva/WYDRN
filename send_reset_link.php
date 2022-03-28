<?php

include("connection.php");
include("functions.php");

if(isset($_POST['submit_email']) && $_POST['email'])
{
$email=$_POST['email'];
  $select=mysqli_query($con,"SELECT `email`, `password` FROM `users` WHERE `email`='$email'");
  if(mysqli_num_rows($select)==1)
  {
    while($row=mysqli_fetch_array($select))
    {
      $email=($row['email']);
      $pass=($row['password']);
    }
    $link="localhost/WYDRN/reset_pass.php?key=".$email."&reset=".$pass;
    if(send_reset_link($email, $link)){
        echo "Reset Link Sent to Your Email";
    } else{
        echo "Error in sending Password mail";
    }
  }	
}
?>