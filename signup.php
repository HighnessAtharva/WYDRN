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
			
		// hash the password
		$hashed_pass=password_hash($password, PASSWORD_DEFAULT);
				
		// generate a random userid
		$user_id = random_num(20);
				
		
		//insert into DB
		$query = "insert into users (user_id,user_name, email, password) values ('$user_id','$user_name','$email','$hashed_pass')";

		// if the username is already taken, display bootstrap error. If not, insert into DB, send an email and redirect to login page. Also display and error if the email is not sent.
		if (!mysqli_query($con, $query)){					
			$invalid_signup="<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
							top: 50px; left: 570px;' role='alert'>
  						    	That username is already taken!
							</div></center>";
			echo $invalid_signup;

		}else{
			if(mailer_verify_email($email)){
				echo "Email sent!";
			}else{
				$email_error="<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
							top: 50px; left: 570px;' role='alert'>
  						    Could not send the email!
							</div></center>";
				echo $email_error;
			}	
			header("Location: login.php");
			die;			
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
	<!--ORDER OF PLACING CSS CDN AND SCRIPT IS IMPORTANT. CUSTOM CSS COMES LAST AS WE OVERRIDE BOOTSTRAP CLASSES.-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="css/signup.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="background-image: url(images/website/signup.jpg); background-size: cover;">
	<div id="box" style="background: rgba(0, 0, 0, 0.5);  width: 400px;
        margin-top: 120px; margin-left:560px">
		

		<form method="post" action="signup.php" onsubmit ="return Validation();">

			<div class="WYDRN">Sign Up</div>
			
			<span class="inputboxes" id="username" autofocus="true">USERNAME</span>
			<input class="text" id="name" type="text" name="user_name" placeholder="HighnessAlexDaOne" autofocus="true" required><br><br>
			
			<span  class="inputboxes">E-MAIL ADDRESS</span>
			<input class="text" id="email" type="email" name="email" placeholder="AlexDaOne@gmail.com" required><br><br>

			<span  class="inputboxes">PASSWORD</span>
			<input class="text" id="pass" type="password" name="password" placeholder="Karm@beatsDogm@" required><br><br>
			
			<span  class="inputboxes">CONFIRM PASSWORD</span>
			<input class="text" id="confirmpass" type="password" name="confirm_password" placeholder="Karm@beatsDogm@" required><br><br>

			<input id="button" style="" type="submit" value="Sign Up"><br><br>

			<a href="login.php" style="color:white;">Login</a>
			
		</form>	
	</div>

	<!--STICKY FOOTER INCLUDED AT THE BOTTOM OF THE PAGE-->
<?php include("footer.php");?>  
<!--END OF MAIN BODY-->  

	<!--Best place to place JS Script is just before the body tag ends-->
	<script>
		function Validation(){
			var name = document.getElementById("name").value;
			var password = document.getElementById("pass").value;
			var confirmpassword = document.getElementById("confirmpass").value;
			var email = document.getElementById("email").value;
			
			var re = /\S+@\S+\.\S+/;
			const isAlphaNumeric = str => /^[a-z0-9]+$/gi.test(str);

			if(name.length < 3 || name.length > 20){
				alert("Username must be between 3 and 20 characters");
				return false;
			}
			else if(!isAlphaNumeric(name)){
				alert("Username must not contain special characters");
				return false;
			}
			else if(!re.test(email)){
				alert("Please enter a valid email address");
				return false;
			}
			else if(password.length < 8 || password.length > 20){
				alert("Password must be between 8 and 20 characters");
				return false;
			}
			else if(password != confirmpassword){
				alert("Passwords do not match");
				return false;
			}
		return true;
		}	
	</script>
</body>
</html>