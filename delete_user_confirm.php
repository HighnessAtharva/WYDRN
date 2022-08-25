<?php

/**
 * Wipe all user data from the database and redirect back to the login page.
 *
 * @version    PHP 8.0.12
 * @since      May 2022
 * @author     AtharvaShah
 */

/*------------------------------------------------------------------------------------------------
DESCRIPTION: CHECKS IF A USER HAS LOGGED IN AND IF SO, DELETES THE USER DATA FROM THE DATABASE.
------------------------------------------------------------------------------------------------*/

require "connection.php";
require "functions.php";

// if GET REQUEST IS MADE FROM ADMIN PAGE SET USERNAME TO IT
if (isset($_GET['user_name'])) {
    $username = $_GET['user_name'];
} 

// else assume user is logged in and delete their own data from the database
else {
    session_start();
    if (empty($_SESSION)) {
        header("Location: login.php");

    }
    $user_data = check_login($con);
    $username = $user_data['user_name']; //username of the currently logged in user
}

if (isset($_SESSION['user_id'])) {
    set_inactive($username);
    unset($_SESSION['user_id']);
}

/* ------------------------------------------------------------------------------------------------
DELETES THE USERS FROM THE USERS TABLE IN THE DATABASE.
------------------------------------------------------------------------------------------------*/
$sql = "DELETE FROM `users` WHERE `user_name` = '$username'";
if ($result = mysqli_query($con, $sql)) {
    echo "Deleted the User";
} else {
    die('Unable to delete the account in Users Table' . mysqli_error($con));
}

/*------------------------------------------------------------------------------------------------
DELETES THE ASSOCIATED RECORDS OF THE USER FROM THE DATA TABLE
------------------------------------------------------------------------------------------------*/
$sql2 = "DELETE FROM `data` WHERE `username` = '$username'";
if ($result = mysqli_query($con, $sql2)) {
    echo "Deleted the Data associated with the user.";
} else {
    die('Unable to delete User Data in Data Table' . mysqli_error($con));
}

/*------------------------------------------------------------------------------------------------
DELETES ALL THE RECORDS WHERE USER WAS FOLLOWING OTHER PEOPLE
------------------------------------------------------------------------------------------------*/
$sql3 = "DELETE FROM `social` WHERE `follower_username` = '$username'";
if ($result = mysqli_query($con, $sql3)) {
    echo "Removed all the records where user was following other people.";
} else {
    die('Unable to delete User Data in Social "SQL3"' . mysqli_error($con));
}

/*------------------------------------------------------------------------------------------------
DELETES SELECTIVE RECORDS WHERE OTHER PEOPLE FOLLOWED THE USER. ------------------------------------------------------------------------------------------------*/
$sql4 = "DELETE FROM `social` WHERE `followed_username` = '$username'";
if ($result = mysqli_query($con, $sql4)) {
    echo "Removed all the records where other people were following the user.";
    echo "ACCOUNT IS DELETED. REDIRECTING TO SIGNUP PAGE.";
    session_destroy();
    header("Location: login.php");
    die;
} else {
    die('Unable to delete User Data in Social "SQL4"' . mysqli_error($con));
}



?>

<!-------------------------------------------------------------------------------------
       			 NO HTML OR JAVASCRIPT IS REQUIRED FOR THIS PAGE
------------------------------------------------------------------------------------->