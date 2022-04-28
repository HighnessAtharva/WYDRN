<?php

/*

DESCRIPTION: LOGS OUT THE USER. REDIRCTS TO THE LOGIN PAGE AND CLEARS THE SESSION. 

*/
include("functions.php");
include("connection.php");
session_start();
$user_data = check_login($con);
$username = $user_data['user_name'];

if(isset($_SESSION['user_id']))
{
	set_inactive($username);
	unset($_SESSION['user_id']);
}

header("Location: login.php");
die;