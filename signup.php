<?php 
session_start();

/*

DESCRIPTION: SIMILAR TO LOGIN PAGE, THIS PAGE DISPLAYS THE SIGNUP PAGE WITH THE ACCOMODATION TO CHECK IF PASSWORDS MATCH. IF USERNAME IS ALREADY TAKEN, ECHOS AN ERROR REGARDING DUPLICATE VALUE. REDIRECTS TO LOGIN PAGE AFTER SUCCESSFUL SIGNUP.
- HASHES THE PASSWORD AND INSERTS TO DATABASE. 
*/

include("connection.php");
include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = mysqli_real_escape_string($con, $_POST['user_name']);
		$email=mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$confirm_password=mysqli_real_escape_string($con, $_POST['confirm_password']);
		
		//check if password and confirm_password are equal and if not, display error message
		if ($password==$confirm_password){
			// check that username does not contain special characters and is alphanumerical
			if (!ctype_alnum($user_name)){
				die('Username must not contain special characters' . mysqli_error($con));
			}
			if(!empty($user_name) && !empty($password) && ctype_alnum($user_name)){
				
				// hash the password
				$hashed_pass=password_hash($password, PASSWORD_DEFAULT);
				
				// generate a random userid
				$user_id = random_num(20);
				
				//insert into DB
				$query = "insert into users (user_id,user_name, email, password) values ('$user_id','$user_name','$email','$hashed_pass')";

				if (!mysqli_query($con, $query)){					
					die('Error: ' . mysqli_error($con));
				}
				
				//send a verification email then sleep for 2 seconds and redirect to login page.  
				mailer_verify_email($email);
				sleep(2);
				header("Location: login.php");
				
				die;
			}
			else{
				die('All the Details must be filled' . mysqli_error($con));
			}

		}
		else{
			die('Passwords do not match' . mysqli_error($con));
		}
	}
?>

<!--
	
HTML PART

-->

<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: blue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
		margin-top: 100px;
		align-content: center;
		align-items: center;
		text-align: center;
	}

	.inputboxes{
		color: white;  
		font-family: Baskerville,Times,'Times New Roman',serif; 
		padding-bottom:10px; 
		float:left;
	}

	.WYDRN{ font-family: Baskerville,Times,'Times New Roman',serif;
    font-size: 30px;
    color: #FFFFFF;
    font-variant: small-caps;
    text-align: center;
    font-weight: bold; 
	margin-bottom:30px;
	text-decoration: underline;
  text-decoration-color: blue;
}

</style>
<body style="background-image: url(images/website/signup.jpg); background-size: cover;">
	<div id="box"  style="background: rgba(0,0,0,0.5);">
		
		<form method="post">
			<div class="WYDRN">Sign Up</div>
			
			<span class="inputboxes" id="username">USERNAME</span>
			<input id="text" type="text" name="user_name" placeholder="HighnessAlexDaOne"><br><br>
			
			<span  class="inputboxes">E-MAIL ADDRESS</span>
			<input id="text" type="email" name="email" placeholder="AlexDaOne@gmail.com"><br><br>

			<span  class="inputboxes">PASSWORD</span>
			<input id="text" type="password" name="password" placeholder="Karm@beatsDogm@"><br><br>
			
			<span  class="inputboxes">CONFIRM PASSWORD</span>
			<input id="text" type="password" name="confirm_password" placeholder="Karm@beatsDogm@"><br><br>

			<input id="button" style="margin-top:15px; margin-bottom:20px" type="submit" value="Sign Up"><br><br>

			<a href="login.php" style="color:white;">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>