<!--
  Description: 
  Displays Single Input Field asking user to enter an Email to Recieve the Password Link On.
  On Form Submission It checks if the Email Entered is Registered with WYDRN Service and pushes an email if yes. 

  1) send_reset_link.php (Sends the Reset Link)
  2) reset_pass.php (Upon Clicking the Link, user arrives here and is asked to enter a new password)
  3) submit_new.php (Logic to update the database with the new password)
-->

<html>

<body>
    <form method="post" action="send_reset_link.php">
        <p>Enter Email Address To Send Password Link</p>
        <input type="text" name="email">
        <input type="submit" name="submit_email">
    </form>
</body>

</html>


<?php

require("connection.php");
require("functions.php");

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
mysqli_close($con);
?>