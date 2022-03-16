<?php

/*

DESCRIPTION: LOGS OUT THE USER. REDIRCTS TO THE LOGIN PAGE AND CLEARS THE SESSION. 

*/

session_start();

if(isset($_SESSION['user_id']))
{
	unset($_SESSION['user_id']);

}

header("Location: login.php");
die;