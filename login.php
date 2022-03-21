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
			
			$invalid_login="<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
							top: 100px; left: 570px;' role='alert'>
  						    	Username or Password does not match. Retry!
						    </div></center>";
			echo $invalid_login;
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body style="background-image: url(images/website/login.png); background-size: cover;" onload="getcookiedata()">>

	<div id="box" style="background: rgba(0,0,0,0.5);">
		<form method="post" action="login.php" onsubmit="return Validation();">
			<div class="WYDRN">WYDRN</div>

			<!--Username-->
			<span class="userandpass" >USERNAME</span>
			<input class="text" id="username" type="text" name="user_name" placeholder="HighnessAlexDaOne" autofocus="true" required><br><br>
			
			<!--Password-->
			<span  class="userandpass">PASSWORD</span>
			<input class="text" id="pass" type="password" name="password" placeholder="Karm@beatsDogm@" required><br>
			
			<!--Remember Me Checkbox-->
			<input type="checkbox" name="rememberme" style="margin-left:-130px; margin-top:20px;" onclick="setcookie()">
			<span style="color:#cccccc;">Remember Me</span><br>

			<!--Login Button-->
			<input id="button" style="margin-top:15px; margin-bottom:20px;" type="submit" value="Login"><br>

			<!--Signup Button-->
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
			for(var i = 0; i <ca.length; i++) {
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


	</script>
</body>
</html>