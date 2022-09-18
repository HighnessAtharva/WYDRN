<?php

/**
 *  Displays Single Input Field asking user to enter an Email to Recieve the Password Link On.
 * On Form Submission It checks if the Email Entered is Registered with WYDRN Service and pushes an email if yes. 
 * 1) send_reset_link.php (Sends the Reset Link)
 * 2) reset_pass.php (Upon Clicking the Link, user arrives here and is asked to enter a new password)
 * 3) submit_new.php (Logic to update the database with the new password)
 *
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */


require("connection.php");
require("functions.php");
// DO NOT INCLUDE THE HEADER BECAUSE USER IS NOT LOGGED IN! IT WILL BE INCLUDED IN THE LOGIN PAGE.
?>


<!-------------------------------------------------------------------------------------
                             HTML PART
------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="sends reset password link to the user's email" />
  <meta name="keywords" content="WYDRN, send reset link" />
  <title> WYDRN - Password Reset</title>
  
  <link rel="stylesheet" href="css/others/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="css/others/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/others/ionicons.min.css">
  <link rel="stylesheet" href="css/utility.css">

  <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  	<!-- Sweet Alert (Beautiful looking alert plugin-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<!-- Body Begins -->

<body>
  <div class="sign section--bg" data-bg="images/website/assets/abstract/section.jpg">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="sign__content">
            
            <form method="post" action="send_reset_link.php" class="sign__form" onsubmit="return validation();">
            <a href="login.php" class="sign__logo">
                                <img src="images/website/logo.png" alt="">
                    </a>
                    <div class="sign__group">
                                <input type="text" id="email" class="sign__input" placeholder="Email" name="email" required>
                            </div>
              
              
                            <div class="sign__group sign__group--checkbox">
                                <input type="checkbox" checked="checked">
                                <label for="remember" class="agree-label">I agree to the <a href="privacy_policy.php">Privacy Policy</a></label>
                            </div>


              <input type="submit" value="Send" name="submit_email" class="forgot-mail-submit" id="mbtn">
              <span class="sign__text">We will E-mail you the password reset link </span>
            </form>
            
            <!-- end authorization form -->
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-------------------------------------------------------------------------------------
                    JAVASCRIPT PART
------------------------------------------------------------------------------------->
  <script>
    // To prevent form resubmission when page is refreshed (F5 / CTRL+R) 
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
    
    function validation(){

    var email = document.getElementById("email").value;
    var re = /\S+@\S+\.\S+/;
      
      
      if (!re.test(email)) {
				//sweet alert plugin to display error message. IT REPLACES the JS alert() function.
				swal({
					title: "Email Invalid",
					text: "Please enter a valid email address. Don't hoax.",
					icon: "warning",
					button: "Retry",
				});
				return false;
			}

      else{
        swal({
					title: "Reset Link Sent",
					text: "Check your email for the reset link",
					icon: "success",
					button: "OK",
				});
        return true;
      }
    }
  
</script>



    <!-- JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/utility.js"></script>
</body>

</html>




<!-------------------------------------------------------------------------------------
                             PHP PART
------------------------------------------------------------------------------------->
<?php

if (isset($_POST['submit_email']) && $_POST['email']) {
  
  $email = mysqli_real_escape_string($con, $_POST['email']);
  // Check if the email is registered with WYDRN 
  $select = mysqli_query($con, "SELECT `email`, `password` FROM `users` WHERE `email`='$email'");
  if (mysqli_num_rows($select) == 1) {
    while ($row = mysqli_fetch_array($select)) {
      $email = ($row['email']);
      $pass = ($row['password']);
    }


    // $link="<img src='images/website/logo.png' alt='WYDRN' width=100' height='100' style='margin-left:75px;'>";
    // $link.="<br><br><br>";
    $link = "<button style='padding:20px;'>";
    $link .= "<a style='text-decoration: none;' href='localhost/WYDRN/reset_pass.php?key=" . $email . "&reset=" . $pass . "'" . ">Click Here To Reset Password</a>";
    $link .= '</button>';

    // Check if mail was sent successfully
    if (send_reset_link($email, $link)) {
      echo "Reset Link Sent to Your Email";
    } else {
      echo "Error in sending Password mail";
    }
  } else {
    echo "Email Not Registered";
  }
}
mysqli_close($con);
?>