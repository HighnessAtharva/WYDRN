<?php
include "connection.php";
include "functions.php";
include "footer.php";
include "header.php";

session_start();
$user_data = check_login($con);
$usermail = $user_data['email'];
$username = $user_data['user_name'];

if (check_verified_status($username) == 0) {
    if (mailer_verify_email($usermail)) {
        echo "Email sent!";
    } else {
        $email_error = "<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
                                    top: 50px; left: 570px;' role='alert'>
                                      Could not send the email!
                                    </div></center>";
        echo $email_error;
    }
} else {
    echo "<br>User is already Verified.";
}

if (isset($_GET['link'])) {
    $user_data = check_login($con);
    $username = $user_data['user_name'];
    // echo $username;
    // echo $_GET['link'];

    if ($_GET['link'] == md5($user_data['user_name'])) {
        $sql = "UPDATE users SET `verified` = '1' WHERE user_name='$username'";
        if (mysqli_query($con, $sql)) {
            echo ("Account Verified. <a href='profile.php'>Click here</a> to visit your profile.");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo ("Invalid Link. Your account remains unverified.");
    }
}
