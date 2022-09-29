<?php

/**
 * Login Page for registered users.
 *
 * @version    PHP 8.0.12 
 * @since      March 2022
 * @author     AtharvaShah
 */

/*-----------------------------------------------------------------------------------
- THE HTML PART SHOWS THE LOGIN FORM WITH THE USERNAME AND PASSWORD FIELDS
- THE PHP PART GRABS THE INPUT FROM THE FORM, VALIDATES IT AND CHECKS IF THE USERNAME AND PASSWORD MATCHES WITH THE DATABASE.
- VERIFIES AND DECRYTPS THE HASH PASSWORD AND LOGS IN THE USER
- IF THE USERNAME AND PASSWORD MATCHES, THE USER IS REDIRECTED TO THE PROFILE PAGE.
-----------------------------------------------------------------------------------*/



require "connection.php";
require "functions.php";

// Trying to prevent logged in user from accessing the login page. If the user is already logged in, redirect to the profile page. Only logged out users can access the login page. Second check i.e. empty($_GET['logout']) is add to the exception when this page is being redirected to from the logout page.
session_start();
if (isset($_SESSION['user_name']) && empty($_GET['logout'])) {
	header("Location: profile.php");
}

/*********
 * logic for the SIGN IN form
 *********/
if (isset($_POST['signin'])) {

	$user_name = strip_tags(trim($_POST['user_name']));
	$password = strip_tags(trim($_POST['password']));

	$user_name= mysqli_real_escape_string($con, $user_name);
	$password = mysqli_real_escape_string($con, $password);

	$query = "select * from users where user_name = '$user_name' limit 1";
	$result = mysqli_query($con, $query);
	if ($result) {
		if ($result && mysqli_num_rows($result) > 0) {
			$user_data = mysqli_fetch_assoc($result);
			$hashed_pass = $user_data['password'];
			if (password_verify($password, $hashed_pass)) {
				//start the session only if user is authenticated
				session_start();
				$_SESSION['user_id'] = $user_data['user_id'];
				$_SESSION['user_name'] = $user_data['user_name'];
				header("Location: profile.php");

				die;
			}
		}
	}

	$invalid_login = "<center><div class='alert alert-danger w-50 text-center' style='position: absolute; top: 20px; left: 390px; z-index:500;' role='alert'>Username or Password does not match. Retry!
	</div></center>";
	echo $invalid_login;

}

/*********
 * logic for the SIGN UP form
 *********/
if (isset($_POST['signup'])) {
	/*------------------------------------------------------------------------------------------------------------------ 
	GRAB THE POSTED DATA FROM THE SIGNUP FORM AND STORE IT INSIDE VARIABLES AND PROCESS IT.
	------------------------------------------------------------------------------------------------------------------*/
	$user_name = strip_tags(trim($_POST['user_name']));
	$user_name = mysqli_real_escape_string($con, $user_name);
	
	$email = strip_tags(trim($_POST['email']));
	$email = mysqli_real_escape_string($con, $email);
	
	$password = strip_tags(trim($_POST['password']));
	$password = mysqli_real_escape_string($con, $password);
	
	$confirm_password = strip_tags(trim($_POST['confirm_password']));
	$confirm_password = mysqli_real_escape_string($con, $confirm_password);

	// hash the password
	$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

	// generate a random userid
	$user_id = random_num(20);

	$date = date("Y-m-d");

	//insert into DB
	$query = "INSERT INTO `users`(user_id, user_name, email, password, date) VALUES
	 		 ('$user_id','$user_name','$email','$hashed_pass','$date')";

	/*---------------------------------------------------------------------------------------------------------------------- IF THE USERNAME IS ALREADY TAKEN, DISPLAY BOOTSTRAP ERROR. SEND AN EMAIL AND REDIRECT TO LOGIN PAGE. ALSO DISPLAY AND ERROR IF THE EMAIL IS NOT SENT.
    -----------------------------------------------------------------------------------------------------------------------*/
	if (!mysqli_query($con, $query)) {
		$invalid_signup = "<center><div class='alert alert-danger w-25 text-center' style='position: absolute; top: 20px; left: 570px;z-index:500;' role='alert'>
  		That username or email is already taken!
		</div></center>";
		echo $invalid_signup;
	}

	/*-----------------------------------------------------------------------------------------------------------------
		 AFTER SUCCESSFUL SIGNUP, REDIRECT TO LOGIN PAGE;
   	-------------------------------------------------------------------------------------------------------------*/ else {
		//send a verification email if signup is successful.
		mailer_verify_email($email);
		header("Location: login.php");
		die;
	}
}

mysqli_close($con);
?>

<!-----------------------------------------------------------------------------------------------------------------------
													HTML PART
------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-signin-client_id" content="518704041766-41bs6d5lc0c0d8e08692m43isb78sv2b.apps.googleusercontent.com">
	<meta name="description" content="login page for users to login" />
 	<meta name="keywords" content="WYDRN, login" />
	<title>WYDRN - Login</title>

	<!--- BOOTSTRAP CDN ---->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<!-- Add icon library -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="CSS/login.css">
	
	<link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

	<!-- Sweet Alert (Beautiful looking alert plugin-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


	<!-- Google OAuth Sign In -->
	<script src="https://apis.google.com/js/platform.js" async defer></script>
</head>


<body onload="getcookiedata()">

<video src="<?php echo randomVideo(); ?>" autoplay loop playsinline muted></video>
<!-----------------------
Container for Two Forms
-------------------------->
	<div class="container" id="container">

	<!------------------
	Sign In Form
	-------------------->
		<div class="form-container sign-in-container">
			<form method="post" action="login.php" onsubmit="return SignInValidation();">
				<h1>Sign in</h1>

				<!-- USERNAME -->
				<div class="flex">
					<input class="input-box" id="username" type="text" name="user_name" placeholder="Username" autofocus="true" required />
					<i class="fa fa-user icon"></i>
				</div>

				<!-- PASSWORD -->
				<div class="flex">
					<input class="input-box" id="pass" type="password" name="password" placeholder="Password" onCopy="return false" autocomplete="on" required /><br>
					<i class="fa fa-key icon"></i>
				</div>

				<!-- SHOW PASSWORD-->
				<label><input type="checkbox" onclick="LoginshowPass()" value="Show Password" />
				Show Password</label>

				<!-- REMEMBER ME CHECKBOX -->
				<label><input type="checkbox" name="rememberme" onclick="setcookie()" />
				Remember Me</label>

				<!-- FORGOT PASSWORD -->
				<a href="send_reset_link.php">Forgot Your Password?</a>

				<!-- SIGNIN BUTTON -->
				<button type="submit" name="signin">Sign In</button>

				<!--Uncomment For Google Account Button-->
				<!-- <div class="g-signin2" data-onsuccess="onSignIn"></div> -->
				
			</form>
			
		</div>
		<!------------------
	END OF Sign In Form
	-------------------->




		<!----------------
		SIGN UP FORM
	------------------>
		<div class="form-container sign-up-container">
			<form method="post" action="login.php" onsubmit="return SignUpValidation();">
				<h1>Create Account</h1>

				<!-- USERNAME -->
				<div class="flex">
					<input class="input-box" id="name" type="text" name="user_name" placeholder="Username" autofocus="true" required />
					<i class="fa fa-user icon"></i>
				</div>

				<!-- E-MAIL -->
				<div class="flex">
					<input class="input-box" id="email" type="email" name="email" placeholder="E-mail" required />
					<i class="fa fa-envelope icon"></i>
				</div>

				<!-- PASSWORD -->
				<div class="flex">
					<input class="input-box" id="firstpass" type="password" name="password" placeholder="Password" onCopy="return false" required />
					<i class="fa fa-key icon"></i>
				</div>

				<!-- CONFIRM PASSWORD -->
				<div class="flex">
					<input class="input-box" id="confirmpass" type="password" name="confirm_password" placeholder="Confirm Password" onCopy="return false" required />
					<i class="fa fa-key icon"></i>
				</div>
				
				<!-- SHOW PASSWORD-->
				<label><input type="checkbox" onclick="showPass()" value="Show Password" />Show Password</label>

					<!-- SIGNUP PASSWORD-->
					<button type="submit" name="signup">Sign Up</button>
			</form>
		</div>

		<!------------------
	END OF Sign Up Form
	-------------------->



		<div class="overlay-container">
			<div class="overlay">
				
				<div class="overlay-panel overlay-left">
					<a href="home.html"><img src="images/website/logo.png" alt="WYDRN" class="logo"/></a>
					<h1>Welcome Back!</h1>
					<p>Stay updated with your entertainment and see what your friends are up to.</p>
					<button class="ghost" id="signIn">Sign In</button>
					
				</div>
				
				<div class="overlay-panel overlay-right">
				<a href="home.html"><img src="images/website/logo.png" alt="WYDRN" class="logo"/></a>
					<h1>Hello, Friend!</h1>
					<p>Want to join the fun? Start adding your favorite Movies, Shows, Music, Books and Videogames and show off your incredible taste. </p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>





	<!-------------------------------------------------------------------------------------
JAVASCRIPT VALIDATION
------------------------------------------------------------------------------------->
	<script>
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');

		signUpButton.addEventListener('click', () => {
			container.classList.add("right-panel-active");
		});

		signInButton.addEventListener('click', () => {
			container.classList.remove("right-panel-active");
		});


		// To prevent form resubmission when page is refreshed (F5 / CTRL+R) 
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}

		//toggle password visibilty
		function LoginshowPass() {
			var x = document.getElementById("pass");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}

		// to check and validate form data and raise alerts if input is erronous. 
		function SignInValidation() {
			var name = document.getElementById("username").value;
			var password = document.getElementById("pass").value;
			const isAlphaNumeric = str => /^[a-z0-9_]+$/gi.test(str);



			// CHECK IF USERNAME IS ALPHANUMERIC
			if (!isAlphaNumeric(name)) {
				//sweet alert plugin to display error message. IT REPLACES the JS alert() function.
				swal({
					title: "Username Invalid",
					text: "Username must not contain special characters",
					icon: "warning",
					button: "Retry",
				});

				return false;
			}

			// RETURN VALID AFTER ALL CHECKS PASS
			return true;
		}


		//implementing cookies for the REMEMBER ME function.
		function setcookie() {
			//"username" & "pass" is the ID of the two input fields
			var u = document.getElementById('username').value;
			var p = document.getElementById('pass').value;

			//"USERNAME" & "PSWD" are the cookie key names
			document.cookie = "USERNAME=" + u + ";path=http://localhost/WYDRN/";
			document.cookie = "PSWD=" + p + ";path=http://localhost/WYDRN/";
		}


		function getcookiedata() {
			console.log(document.cookie);
			//"USERNAME" & "PSWD" are the cookie key names
			var user = getCookie('USERNAME');
			var pswd = getCookie('PSWD');

			//"username" & "pass" is the ID of the two input fields
			document.getElementById('username').value = user;
			document.getElementById('pass').value = pswd;
		}

		function getCookie(cname) {
			var name = cname + "=";
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			for (var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}



		//toggle password visibilty
		function showPass() {
			var x = document.getElementById("firstpass");
			var y = document.getElementById("confirmpass");
			if ((x.type === "password") && (y.type === "password")) {
				x.type = "text";
				y.type = "text";
			} else {
				x.type = "password";
				y.type = "password";
			}
		}

		// to check and validate form data and raise alerts if input is erronous. 	
		function SignUpValidation() {
			var name = document.getElementById("name").value;
			var password = document.getElementById("firstpass").value;
			var confirmpassword = document.getElementById("confirmpass").value;
			var email = document.getElementById("email").value;
			var re = /\S+@\S+\.\S+/;
			const isAlphaNumeric = str => /^[a-z0-9_]+$/gi.test(str);

			// CHECK IF USERNAME IS LONG ENOUGH
			if (name.length < 3 || name.length > 20) {
				//sweet alert plugin to display error message. IT REPLACES the JS alert() function.
				swal({
					title: "Username Invalid",
					text: "Username must be between 3 and 20 characters",
					icon: "warning",
					button: "Retry",
				});
				return false;
			}

			// CHECK IF USERNAME IS ALPHANUMERIC
			else if (!isAlphaNumeric(name)) {
				//sweet alert plugin to display error message. IT REPLACES the JS alert() function.
				swal({
					title: "Username Invalid",
					text: "Username must not contain special characters",
					icon: "warning",
					button: "Retry",
				});
				return false;
			}

			// CHECK FOR VALID EMAIL
			else if (!re.test(email)) {
				//sweet alert plugin to display error message. IT REPLACES the JS alert() function.
				swal({
					title: "Email Invalid",
					text: "Please enter a valid email address. Don't hoax.",
					icon: "warning",
					button: "Retry",
				});
				return false;
			}

			// CHECK FOR PASSWORD SECURITY LENGTH
			else if (password.length < 8 || password.length > 30) {
				//sweet alert plugin to display error message. IT REPLACES the JS alert() function.
				swal({
					title: "Password Invalid",
					text: "Password must be between 8 and 30 characters",
					icon: "warning",
					button: "Retry",
				});
				return false;
			}

			// CHECK FOR PASSWORD EQUALITY
			else if (password != confirmpassword) {
				//sweet alert plugin to display error message. IT REPLACES the JS alert() function.
				swal({
					title: "Confirm Password Invalid",
					text: "Passwords do not match",
					icon: "warning",
					button: "Retry",
				});
				return false;
			}

			// RETURN VALID AFTER ALL CHECKS PASS
			return true;
		}

		// Google OAuth Sign In
		function onSignIn(googleUser) {
  			var profile = googleUser.getBasicProfile();
 		 	console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  			console.log('Name: ' + profile.getName());
  			console.log('Image URL: ' + profile.getImageUrl());
  			console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
		}
	</script>
</body>

</html>