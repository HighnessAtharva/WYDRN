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
Checks whether a user is active or not (1 - Active  ||  0 -  Inactive)
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
Sets a user account status as active (Returns 1 - Set Active Successfully  ||  0 -  Error in Setting Active)
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

/*
Sets a user account status as inactive (Returns 1 - Set inactive Successfully  ||  0 -  Error in Setting inactive)
*/
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

/*
Used to pass the datetime and return a printable and user-friendly datetime format D:M:Y H:M:AM/PM
*/
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

/*
Get total mutual media count between two users
*/
function get_mutual_media_count($user1, $user2){
	include("connection.php");
	$array=array();
	
	// mutual video game count
	$sql = "SELECT count(*) FROM(SELECT videogame FROM data WHERE username='$user1' AND videogame != '' 
	INTERSECT
	SELECT videogame FROM data WHERE username='$user2' AND videogame != '') I";
	if ($query = mysqli_query($con, $sql)) {
		if (mysqli_num_rows($query) >0) {
			$row = mysqli_fetch_array($query);
			$mutual_videogame_count= $row[0];  
		} else {
			die('Could not get the records' . mysqli_error($con));
		}
	}

	// mutual album count
	$sql = "SELECT COUNT(*) FROM(SELECT album, artist FROM data WHERE username='$user1' AND album!='' AND artist!='' 
	INTERSECT
	SELECT album, artist FROM data WHERE username='$user2' AND album!='' AND artist!='') I";
	if ($query = mysqli_query($con, $sql)) {
		if (mysqli_num_rows($query) >0) {
			$row = mysqli_fetch_array($query);
			$mutual_album_count= $row[0];  
		} else {
			die('Could not get the records' . mysqli_error($con));
		}
	}

	// mutual book count
	$sql = "SELECT COUNT(*) FROM(SELECT book, author FROM data WHERE username='$user1'  AND book!='' AND author!='' 
	INTERSECT
	SELECT book, author FROM data WHERE username='$user2' AND book!='' AND author!='') I";
	if ($query = mysqli_query($con, $sql)) {
		if (mysqli_num_rows($query) >0) {
			$row = mysqli_fetch_array($query);
			$mutual_book_count= $row[0];  
		} else {
			die('Could not get the records' . mysqli_error($con));
		}
	}

	// mutual movie count
	$sql = "SELECT COUNT(*) FROM(SELECT movie, year FROM data WHERE username='$user1' AND movie!='' AND year!=''
	INTERSECT
	SELECT movie, year FROM data WHERE username='$user2' AND movie!='' AND year!='') I";
	if ($query = mysqli_query($con, $sql)) {
		if (mysqli_num_rows($query) >0) {
			$row = mysqli_fetch_array($query);
			$mutual_movie_count= $row[0];  
		} else {
			die('Could not get the records' . mysqli_error($con));
		}
	}
	


	// mutual tv show count
	$sql = "SELECT count(*) FROM(SELECT tv FROM data WHERE username='$user1' AND tv != '' 
	INTERSECT
	SELECT tv FROM data WHERE username='$user2' AND tv != '') I";
	if ($query = mysqli_query($con, $sql)) {
		if (mysqli_num_rows($query) >0) {
			$row = mysqli_fetch_array($query);
			$mutual_tvshow_count= $row[0];  
		} else {
			die('Could not get the records' . mysqli_error($con));
		}
	}


	$total_mutual_count=$mutual_videogame_count+$mutual_album_count+$mutual_book_count+$mutual_movie_count+$mutual_tvshow_count;
	
	// push videogame count
	array_push($array, $mutual_videogame_count, $mutual_album_count,$mutual_book_count,$mutual_movie_count, $mutual_tvshow_count, $total_mutual_count);

	/*$array will look like 
	[0]=>videogame count, 
	[1]=>album count, 
	[2]=>book count, 
	[3]=>movie count, 
	[4]=>tvshow count, 
	[5]=>total mutual count
	*/
	return $array;
}