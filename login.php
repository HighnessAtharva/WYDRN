<?php 

/*

DESCRIPTION:
- THE HTML PART SHOWS THE LOGIN FORM WITH THE USERNAME AND PASSWORD FIELDS
- THE PHP PART GRABS THE INPUT FROM THE FORM, VALIDATES IT AND CHECKS IF THE USERNAME AND PASSWORD MATCHES WITH THE DATABASE.
- VERIFIES AND DECRYTPS THE HASH PASSWORD AND LOGS IN THE USER
- IF THE USERNAME AND PASSWORD MATCHES, THE USER IS REDIRECTED TO THE PROFILE PAGE.

*/

session_start();

	include("connection.php");
	include("functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
	
	
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					$hashed_pass=$user_data['password'];
					if(password_verify($password, $hashed_pass))
					{
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: profile.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		
	}
?>

<!--
	
HTML PART

-->
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!--ORDER OF PLACING CSS CDN AND SCRIPT IS IMPORTANT. CUSTOM CSS COMES LAST AS WE OVERRIDE BOOTSTRAP CLASSES.-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/login.css">
	
</head>
<body style="background-image: url(images/website/login.png); background-size: cover;">

	<div id="box" style="background: rgba(0,0,0,0.5);">
		
		<form method="post" action="login.php" onsubmit="return Validation()">
			<div class="WYDRN">WYDRN</div>

			<span class="userandpass" >USERNAME</span>
			<input class="text" id="username" type="text" name="user_name" placeholder="HighnessAlexDaOne" required><br><br>
			
			<span  class="userandpass">PASSWORD</span>
			<input class="text" id="pass" type="password" name="password" placeholder="Karm@beatsDogm@" required><br><br>

			<input id="button" style="margin-top:15px; margin-bottom:40px" type="submit" value="Login"><br>

			<a href="signup.php" style="color:white;">Click to Signup</a><br><br>
		</form>
	</div>
<!--Best place to place JS Script is just before the body tag ends-->
<script>
		function Validation(){
			var name = document.getElementById("username").value;
			var password = document.getElementById("pass").value;
		
			const isAlphaNumeric = str => /^[a-z0-9]+$/gi.test(str);

			if(name.length < 3 || name.length > 20){
				alert("Username must be between 3 and 20 characters");
				return false;
			}
			else if(!isAlphaNumeric(name)){
				alert("Username must not contain special characters");
				return false;
			}
	
			else if(password.length < 8 || password.length > 20){
				alert("Password must be between 8 and 20 characters");
				return false;
			}
			return true;
		}	
	</script>
</body>
</html>