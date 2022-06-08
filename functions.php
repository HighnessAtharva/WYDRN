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
	require "PHPMailer/Exception.php";
	require "PHPMailer/PHPMailer.php";
	require "PHPMailer/SMTP.php";
	$user_data = check_login($con);
	$username = $user_data['user_name'];
	$hashed_verify=md5($username);

	$mail = new PHPMailer\PHPMailer\PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "wydrnapp@gmail.com";
	$mail->Password = "apfyljgxwbgwutlq"; //Google Account -> Security -> App Passwords
	$mail->SetFrom("wydrnapp@gmail.com");
	$mail->Subject = "WYDRN - Verify Your Email";
	$mail->Body = "Click the link below to verify your Account and get access to all the features. localhost/WYDRN/verify.php?link=$hashed_verify";
	$mail->AddAddress($recipient);

	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		return 0;
	} else {
		echo "Message has been sent";
		return 1;
	}
}


/*
Sends an Email with Reset Password Link.
*/ 
function send_reset_link($recipient, $link){

	require "PHPMailer/Exception.php";
	require "PHPMailer/PHPMailer.php";
	require "PHPMailer/SMTP.php";

	$mail = new PHPMailer\PHPMailer\PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = "wydrnapp@gmail.com";
	$mail->Password = "apfyljgxwbgwutlq"; //Google Account -> Security -> App Passwords
	$mail->SetFrom("wydrnapp@gmail.com");
	$mail->Subject = "WYDRN - Reset Password";
	$mail->Body = $link;
	$mail->AddAddress($recipient);

	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		return 0;
	} else {
		echo "Message has been sent";
		return 1;
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

function printable_date($datetime){
	$datetime=explode(" ", $datetime);

	$date=$datetime[0];
	$date=explode("-", $date);
	$year=$date[0];
	$month=$date[1];
	$day=$date[2];

	$time=$datetime[1];
	$time=explode(":", $time);
	$hours=$time[0];
	$mins=$time[1];
	$meridian='';
	if ($hours>=12)
		$meridian='PM';
	else{
		$meridian='AM';
	}
	$new_datetime = $day ."-". $month ."-" .$year. " | " .$hours. ":" .$mins." ".$meridian;
	return $new_datetime; 
}