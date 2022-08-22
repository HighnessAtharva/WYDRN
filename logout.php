<?php
/**
 * LOGS OUT THE USER. REDIRECTS TO THE LOGIN PAGE AND CLEARS THE SESSION.
 *
 * @version    PHP 8.0.12 
 * @since      March 2022
 * @author     AtharvaShah
 */


require("functions.php");
require("connection.php");
session_start();
if(empty($_SESSION))
{
  header("Location: login.php");
}
$user_data = check_login($con);
$username = $user_data['user_name'];

if(isset($_SESSION['user_id']))
{
	set_inactive($username);
	unset($_SESSION['user_id']);
}

// destroy the session and redirect to login page with a GET parameter of logout to pass the exception that the user is logged out.
session_destroy();
header("Location: login.php?logout=true");
mysqli_close($con);
die;

?>

<!-------------------------------------------------------------------------------------
                    NO HTML OR JAVASCRIPT IS REQUIRED FOR THIS PAGE
------------------------------------------------------------------------------------->
