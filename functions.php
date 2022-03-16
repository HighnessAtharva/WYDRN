<?php
/*

DESCRIPTION: 
- CHECK_LOGIN FUNCTION CHECKS IF A USER HAS LOGGED IN AND IF SO, RETURNS THE USER DATA.
- RANDOM_NUM GENERATES A RANDOM NUMBER 5 TO 20 DIGIT NUMBER TO GENERATE DYNAMIC IDS FOR NEW REGISTRATIONS.
- MORE FUNCTIONS CAN BE ADDED HERE INSTEAD OF SEPERATE FILES. TREAT THIS FILE AS UTILITY FUNCTION FILE.

*/

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}