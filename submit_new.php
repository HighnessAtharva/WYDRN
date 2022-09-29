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

include("connection.php");
include("functions.php");
if(isset($_POST['email']) && $_POST['password'] && $_POST['submit_password']){
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $pass=mysqli_real_escape_string($con,$_POST['password']);

    if (strlen($pass)<8){
      echo "<center><div class='alert alert-danger w-25 text-center' style='position: absolute; top: 50px; left: 570px;' role='alert'>Password must be atleast 8 characters long!</div></center>";
      die;
    }
  

    $pass=password_hash($pass, PASSWORD_DEFAULT);
  
    $result=mysqli_query($con, "update users set password='$pass' where email='$email'");
    // on success display the message, await for 3 seconds and redirect to login page.
    if ($result){
    echo "Password Changed Successfully. Redirecting you to Login Page in 3 seconds";
    
    
    //on successful password reset send an email to the user.
    $link = "<button style='padding:20px;'>";
    $link .= "<a style='text-decoration: none;' href='localhost/WYDRN/login.php'>Your Password has been successfully reset. Click here to login.</a>";
    $link .= '</button>';
    send_password_reset_notif($email, $link);
    sleep(3);
    // Password was reset, email was sent now redirecting.
    
    //set logout=true which will be dealt with on the login page.
    header("Location: login.php?logout=true");
    }else{
      echo "Error in Changing Password";
    }
}
mysqli_close($con);
?>


<!----------------------------------------------------
      NO HTML OR JAVASCRIPT CODE NEEDED FOR THIS FILE
------------------------------------------------------->