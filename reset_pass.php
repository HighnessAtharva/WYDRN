<!--
  Description: 
  Upon Clicking the Link, user arrives here and is asked to enter a new password. This page asks the User to Enter the New password. 
  
  1) send_reset_link.php (Sends the Reset Link)
  2) reset_pass.php (Upon Clicking the Link, user arrives here and is asked to enter a new password)
  3) submit_new.php (Logic to update the database with the new password)
-->

<?php
include("connection.php");

if($_GET['key'] && $_GET['reset'])
{
  $email=$_GET['key'];
  $pass=$_GET['reset'];

  $select=mysqli_query($con,"select `email`, `password` from `users` where `email`='$email' and `password`='$pass'");
  if(mysqli_num_rows($select)==1)
  {
?>

    <!--HTML Form for Resetting Password-->
    <form method="POST" action="submit_new.php">
    <input type="hidden" name="email" value="<?php echo $email;?>">
    <p>Enter New password</p>
    <input type="password" name='password'>
    <input type="submit" name="submit_password">
    </form>
    <!--HTML Form for Resetting Password-->

    <?php
  }
}
mysqli_close($con);
?>