<?php
session_start();
include("connection.php");
include("functions.php");
$user_data = check_login($con);
$username=$user_data['user_name'];

// deletes the user from the users table 
$sql="DELETE FROM `users` WHERE `user_name` = '$username'";
if ($result=mysqli_query($con, $sql)){
    echo "Deleted the User";
    /*
    header("Location: login.php");
    die;
    */
}
else{
    die('Unable to delete the account in Users Table' . mysqli_error($con));
}

// deletes the associated records of the user from the data table 
$sql2="DELETE FROM `data` WHERE `username` = '$username'";
if ($result=mysqli_query($con, $sql2)){
    echo "Deleted the Data associated with the user";
    header("Location: login.php");
    die;
}
else{
    die('Unable to delete User Data in Data Table' . mysqli_error($con));
}

?>