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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was
	
    $user_name = strip_tags(trim($_POST['user_name']));
    $password = strip_tags(trim($_POST['password']));

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
                header("Location: profile.php");
                die;
            }
        }
    }

    $invalid_login = "<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
					top: 100px; left: 570px;' role='alert'>
			    	Username or Password does not match. Retry!
				    </div></center>";
    echo $invalid_login;
}
mysqli_close($con);
?>

<!-----------------------------------------------------------------------------------------------------------------------
													HTML PART
------------------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>WYDRN - Login</title>
	<!------------------
	BOOTSTRAP CDN
	-------------------->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
	<link rel="stylesheet" href="CSS/login.css">
	
    <!-- Sweet Alert (Beautiful looking alert plugin-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="background-image: url(images/website/login.png); background-size: cover;" onload="getcookiedata()">>
	<div id="box" style="background: rgba(0,0,0,0.5); margin-top: 150px;">
		<form method="post" action="login.php" onsubmit="return Validation();">
			<div class="WYDRN">WYDRN</div>
			

			<!----------------
			USERNAME
			------------------>
			<span class="userandpass" >USERNAME</span>
			<input class="text" id="username" type="text" name="user_name" placeholder="HighnessAlexDaOne" autofocus="true" required><br><br>

			<!-------------
			PASSWORD
			-------------->
			<span  class="userandpass">PASSWORD</span>
			<input class="text" id="pass" type="password" name="password" placeholder="Karm@beatsDogm@" onCopy="return false" required><br>

			<!-- An element to toggle between password visibility -->
			<input type="checkbox" onclick="showPass()" value="Show Password" ><span style="color:white">Show Password<br>
			<!--------------
			REMEMBER ME CHECKBOX
			----------------->
			<input type="checkbox" name="rememberme" style="margin-top:20px;margin-left:65px;" onclick="setcookie()">
			<span style="color:#cccccc;">Remember Me</span><br>

			<!--------------
			Forgot Password 
			----------------->
			<a name="forgotpass" style="margin-top:20px;margin-left:65px;" href="send_reset_link.php">
			<span style="color:#cccccc;">Forgot Password</span><br>

			<!----------------
			LOGIN BUTTON
			------------------>
			<input id="button" style="margin-top:15px; margin-bottom:20px; margin-left:80px;" type="submit" value="Login"><br>

			<!---------------
			SIGNUP BUTTON
			----------------->
			<a href="signup.php" style="color:white; margin-left:108px;">Signup</a><br><br>
		</form>
	</div>




<!-------------------------------------------------------------------------------------
JAVASCRIPT VALIDATION
------------------------------------------------------------------------------------->
<script>
		
		// To prevent form resubmission when page is refreshed (F5 / CTRL+R) 
		if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
		}

		//toggle password visibilty
		function showPass() {
			var x = document.getElementById("pass");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}

		// to check and validate form data and raise alerts if input is erronous. 
		function Validation(){
			var name = document.getElementById("username").value;
			var password = document.getElementById("pass").value;
			const isAlphaNumeric = str => /^[a-z0-9_]+$/gi.test(str);
			
			

			// CHECK IF USERNAME IS ALPHANUMERIC
			if(!isAlphaNumeric(name)){
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
		function setcookie(){
			//"username" & "pass" is the ID of the two input fields
            var u =document.getElementById('username').value;
            var p =document.getElementById('pass').value;

			//"USERNAME" & "PSWD" are the cookie key names
            document.cookie="USERNAME="+u+";path=http://localhost/WYDRN/";
            document.cookie="PSWD="+p+";path=http://localhost/WYDRN/";
           }


        function getcookiedata(){
            console.log(document.cookie);
			//"USERNAME" & "PSWD" are the cookie key names
            var user=getCookie('USERNAME');
            var pswd=getCookie('PSWD');

			//"username" & "pass" is the ID of the two input fields
            document.getElementById('username').value=user;
            document.getElementById('pass').value=pswd;
        }

		function getCookie(cname) {
			var name = cname + "=";
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			for(var i = 0; i <ca.length; i++){
				var c = ca[i];
				while (c.charAt(0) == ' '){
					c = c.substring(1);
					}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
					}
			}
			return "";
        }
	</script>
</body>
</html>