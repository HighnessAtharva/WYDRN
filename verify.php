<?php

/**
 * Sends an email to the user with a link to view the form to reset their password.
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "header.php";
require "connection.php";
require "functions.php";

$user_data = check_login($con);
$usermail = $user_data['email'];
$username = $user_data['user_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta name="description" content="send email to verify account" />
  <meta name="keywords" content="WYDRN, verify" />
    <title>
        WYDRN - Verification
    </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/verify.css">
</head>

</html>

<body>

    <?php

    if (isset($_GET['link'])) {
        $user_data = check_login($con);
        $username = $user_data['user_name'];
        // echo $username;
        // echo $_GET['link'];

        if ($_GET['link'] == md5($user_data['user_name'])) {
            $sql = "UPDATE users SET `verified` = '1' WHERE user_name='$username'";
            //succcess message
            if (mysqli_query($con, $sql)) {
                echo "<div class='alert success-alert'><h3>Your account is now verified</h3>
            <a href='profile.php'>Click here</a> to visit your profile.
            </div>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        }
        //if user enters an invalid or missing link.
        else {
            echo "<div class='alert danger-alert'><h3>Invalid Link. Your account remains unverified</h3>
        </div>";
        }
    }else{
        if (check_verified_status($username) == 0) {
            if (mailer_verify_email($usermail)) {
                echo "<div class='alert success-alert'><h3>Verification Email Sent To <small><u>". $usermail."</u></small></h3></div>";
            } else {
                $email_error = "<div class='alert danger-alert'><h3>Could not send the E-mail</h3></div>";
                echo $email_error;
            }
        } else {
            echo "<div class='alert danger-alert'><h3>User is already verified</h3></div>";
        }
    
    }
    mysqli_close($con);
    ?>

</body>

</html>