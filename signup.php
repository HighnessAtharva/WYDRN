<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
		
			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			if (!mysqli_query($con, $query))
			{
				die('Error: ' . mysqli_error($con));
			}
			
			
			sleep(2);
			header("Location: login.php");
			die;
		}else
		{
			echo "Please fill in all the details!";
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
<body style="background-image: url(images/signup.jpg); background-size: cover;">
	<div id="box"  style="background: rgba(0,0,0,0.5);">
		
		<form method="post">
			<div class="WYDRN">Sign Up</div>
			<span class="userandpass">USERNAME</span>
			<input id="text" type="text" name="user_name" placeholder="HighnessAlexDaOne"><br><br>
			<span  class="userandpass">PASSWORD</span>
			<input id="text" type="password" name="password" placeholder="Karm@beatsDogm@"><br><br>

			<input id="button" style="margin-top:15px; margin-bottom:20px" type="submit" value="Sign Up"><br><br>

			<a href="login.php" style="color:white;">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>