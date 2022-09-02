<?php

/**
 *   Upon Clicking the Link, user arrives here and is asked to enter a new password. This page asks the User to Enter the New password. 
 * 1) send_reset_link.php (Sends the Reset Link) 
 * 2) reset_pass.php (Upon Clicking the Link, user arrives here and is asked to enter a new password
 * 3) submit_new.php (Logic to update the database with the new password)
 *
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */

require("connection.php");

//page will only serve data when the key and reset parameters are set
if (isset($_GET['key']) && isset($_GET['reset'])) {
  $email = $_GET['key'];
  $pass = $_GET['reset'];

  //select the email and the passsword of the current user
  $select = mysqli_query($con, "select `email`, `password` from `users` where `email`='$email' and `password`='$pass'");
  if (mysqli_num_rows($select) == 1) {
?>

    <!----------------------------------------------------------------
                        HTML PART
----------------------------------------------------------------->
    <html>

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> WYDRN - Password Reset</title>


      <link rel="stylesheet" href="css/others/bootstrap-reboot.min.css">
      <link rel="stylesheet" href="css/others/bootstrap-grid.min.css">
      <link rel="stylesheet" href="css/others/ionicons.min.css">
      <link rel="stylesheet" href="css/utility.css">

      <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
      <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        	<!-- Sweet Alert (Beautiful looking alert plugin-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    </head>

    <body>
      <div class="sign section--bg" data-bg="images/website/assets/abstract/section.jpg">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="sign__content">
                <!--HTML Form for Resetting Password-->
                <form method="POST" action="submit_new.php" class="sign__form" onsubmit="return validation();">
                  <a href="login.php" class="sign__logo">
                    <img src="images/website/logo.png" alt="">
                  </a>


                  <!--Take on the email from the get request and pass it onto the next page whilst keeping it hidden because password will be updated where email is matching -->

                  <input type="hidden" class="sign__input" name="email" value="<?php echo $email; ?>">

                  <!--INPUT FIELD TO ACCEPT THE NEW PASS FROM THE USER-->
                  <div class="sign__group">
                    <input type="password" id="pass" name='password' class="sign__input" placeholder="Enter new password" required>
                  </div>

                  <!-- SHOW PASSWORD-->
                  <label style="color:white; cursor:pointer; margin-left:-160px; margin-top: -10px;"><input type="checkbox" onclick="showPass()" value="Show Password" />
                    Show Password</label>

                  <input type="submit" value="Update Password" name="submit_password" class="forgot-mail-submit">
                </form>
                <!--HTML Form for Resetting Password-->
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- JS -->
      <script src="js/jquery-3.5.1.min.js"></script>
      <script src="js/jquery.magnific-popup.min.js"></script>
      <script src="js/jquery.mCustomScrollbar.min.js"></script>
      <script src="js/select2.min.js"></script>
      <script src="js/utility.js"></script>

      <script>
        //toggle password visibility.
        function showPass() {
          var x = document.getElementById("pass");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }

        //check if password is not empty or password is of valid length
        function validation() {
          var password = document.getElementById("pass").value;
          if (password.length < 8 || password.length > 30) {
            //sweet alert plugin to display error message. IT REPLACES the JS alert() function.
            swal({
              title: "Password Invalid",
              text: "Password must be between 8 and 30 characters",
              icon: "warning",
              button: "Retry",
            });
            return false;
          } else {
            swal({
              title: "Success",
              text: "Your password has been updated",
              icon: "success",
              button: "OK",
            });
            return true;
          }
        }
      </script>
    </body>

    </html>


    <!----------------------------------------------------------------
                        PHP ART
----------------------------------------------------------------->
<?php
  }
}

//if the user directly lands on this page, then they are not allowed to access the page and requested to use a reset link.
else {
  $invalid_reset_link_error = "<center><div class='alert alert-danger w-50 text-center ' style='position: absolute; top: 75px; left: 400px;' role='alert'>You need a proper verification link to reset your password. Can't find the link in your inbox? <a href='send_reset_link.php'>Send another one</a>";
  echo $invalid_reset_link_error;
}

mysqli_close($con);
?>