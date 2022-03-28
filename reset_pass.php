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
?>