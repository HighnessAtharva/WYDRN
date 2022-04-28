<?php
/*

DESCRIPTION: 
- CHECK_LOGIN ---> FUNCTION CHECKS IF A USER HAS LOGGED IN AND IF SO, RETURNS THE USER DATA.
- RANDOM_NUM ---> GENERATES A RANDOM NUMBER 5 TO 20 DIGIT NUMBER TO GENERATE DYNAMIC IDS FOR NEW REGISTRATIONS.
- MAILER_VERIFY_EMAIL ---> Sends an Email requesting verification of the account to the recipient.

*/


/*
Checks if a user is logged in and is valid. If yes, redirects to the login page. Important to start the session in order to perform the check_login function. Use session_start(); in pages that you wish to use this function.
*/ 
function check_login($con)
{
	if(isset($_SESSION['user_id']))
	{
		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	//header("Location: login.php");
	//die;

}

/*
Generates a random 5 to 20 digit number that is to be used to generate dynamic userIDs
*/ 
function random_num($length)
{
	$text = "";
	if($length < 5){
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++){ 
		$text .= rand(0,9);
	}

	return $text;
}

/*
Sends an Email requesting verification of the account to the recipient.
*/ 
function mailer_verify_email($recipient){
include("connection.php");
$to_email = $recipient;
$subject = "WYDRN - Verify Your Email";
$user_data = check_login($con);
$username = $user_data['user_name'];
$hashed_verify=md5($username);
$body = "Click the link below to verify your Account and get access to all the features. localhost/WYDRN/verify.php?link=$hashed_verify";
$headers = "From: WYDRNAPP@gmail.com";

	if (mail($to_email, $subject, $body, $headers)) {
		return 1;
	}else{
		return 0;
	}
}


/*
Sends an Email with Reset Password Link.
*/ 
function send_reset_link($recipient, $link){
$to_email = $recipient;
$subject = "WYDRN - Reset Password";
$body = $link;
$headers = "From: WYDRNAPP@gmail.com";

	if (mail($to_email, $subject, $body, $headers)) {
		return 1;
	}else{
		return 0;
	}
}

/*
Returns whether a user account is verified or not (1 - Verified  ||  0 -  Not Verified)
*/ 
function check_verified_status($username){
include("connection.php");
$sql = "SELECT verified FROM users WHERE user_name='$username'";
	if ($query = mysqli_query($con, $sql)) {
		if (mysqli_num_rows($query) == 1) {
			$row = mysqli_fetch_array($query);
			return $row['verified'];  
		} else {
			die('That user does not exist' . mysqli_error($con));
		}
	}
}


/*
Sets a user account is verified or not (1 - Verified  ||  0 -  Not Verified)
*/
function set_verified($username){
	include("connection.php");
	$sql = "UPDATE users SET verified=1 WHERE user_name='$username'";
	if (mysqli_query($con, $sql)){
		return 1;
	}
	else{
		echo "User does not exist";
		return 0;
	}
}

/*
Sets a user account is verified or not (1 - Verified  ||  0 -  Not Verified)
*/
function check_active_status($username){
include("connection.php");
$sql = "SELECT active FROM users WHERE user_name='$username'";
	if ($query = mysqli_query($con, $sql)) {
		if (mysqli_num_rows($query) == 1) {
			$row = mysqli_fetch_array($query);
			return $row['active'];  
		} else {
			die('That user does not exist' . mysqli_error($con));
		}
	}
}


/*
Sets a user account status as active (Returns 1 - Verified  ||  0 -  Not Verified)
*/
function set_active($username){
	include("connection.php");
	$sql = "UPDATE users SET active=1 WHERE user_name='$username'";
	if (mysqli_query($con, $sql)){
		return 1;
	}
	else{
		echo "User does not exist";
		return 0;
	}
}

function set_inactive($username){
	include("connection.php");
	$sql = "UPDATE users SET active=0 WHERE user_name='$username'";
	if (mysqli_query($con, $sql)){
		return 1;
	}
	else{
		echo "User does not exist";
		return 0;
	}
}