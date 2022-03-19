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
	
		if(!empty($user_name) && !empty($password) && ctype_alnum($user_name))
		{

			//read from database
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
						
						echo (
							"<div class='alert alert-success'>
							<strong>Welcome to WYDRN!</strong> Login Successful!
							</div>"
							);
						
						
						header("Location: profile.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}

		
	}

?>

<!--
	
HTML PART

-->
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
		margin: auto;
		width: 300px;
		padding: 20px;
		margin-top: 200px;
		align-content: center;
		align-items: center;
		text-align: center;

	}

	.userandpass{
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

<body style="background-image: url(images/website/login.png); background-size: cover;">

	<div id="box" style="background: rgba(0,0,0,0.5);">
		
		<form method="post">
			<div class="WYDRN">WYDRN</div>
			<span class="userandpass">USERNAME</span>
			<input id="text" type="text" name="user_name" placeholder="HighnessAlexDaOne" required><br><br>
			<span  class="userandpass">PASSWORD</span>
			
			<input id="text" type="password" name="password" placeholder="Karm@beatsDogm@" required><br><br>
			<input id="button" style="margin-top:15px; margin-bottom:40px" type="submit" value="Login"><br>

			<a href="signup.php" style="color:white;">Click to Signup</a><br><br>
		</form>
	</div>
	
</body>
</html>