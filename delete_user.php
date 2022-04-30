<?php

/*------------------------------------------------------------------------------------------------
DESCRIPTION: CHECKS IF A USER HAS LOGGED IN AND IF SO, DELETES THE USER DATA FROM THE DATABASE.
------------------------------------------------------------------------------------------------*/

session_start();
if(empty($_SESSION))
{
  header("Location: login.php");
}
include "connection.php";
include "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name']; //username of the currently logged in user

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
    header("Location: login.php");
    die;
} else {
    die('Unable to delete User Data in Social "SQL4"' . mysqli_error($con));
}
