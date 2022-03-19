<?php
/*

DESCRIPTION: 
- CHECK_LOGIN FUNCTION CHECKS IF A USER HAS LOGGED IN AND IF SO, RETURNS THE USER DATA.
- RANDOM_NUM GENERATES A RANDOM NUMBER 5 TO 20 DIGIT NUMBER TO GENERATE DYNAMIC IDS FOR NEW REGISTRATIONS.
- MORE FUNCTIONS CAN BE ADDED HERE INSTEAD OF SEPERATE FILES. TREAT THIS FILE AS UTILITY FUNCTION FILE.

*/


/*
Checks if a user is logged in and is valid. If yes, redirects to the login page. 
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
	header("Location: login.php");
	die;

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
$to_email = $recipient;
$subject = "WYDRN - Verify Your Email";
$body = "Click the link below to verify your Account and get access to all the features. ";
$headers = "From: WYDRNAPP@gmail.com";

	if (mail($to_email, $subject, $body, $headers)) {
		return 1;
	}else{
		return 0;
	}
}