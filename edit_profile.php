<?php

/**
 * THIS PAGE ALLOWS USER TO CHANGE THEIR PROFILE PHOTO, BACKGROUND BANNER. MORE EDIT OPTIONS LIKE CHANGE USERNAME AND PASSWORD TO BE ADDED LATER.
 *
 * @version    PHP 8.0.12 
 * @since      May 2022
 * @author     AtharvaShah
 */


session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "connection.php";
require "functions.php";
require "header.php";
$user_data = check_login($con);
$username = $user_data['user_name'];

/* USER ACTIVE STATUS */
if (check_active_status($username) == 1) {
    $active_or_not= "<br>User Status: Active<br>";
} else {
    $active_or_not= "<br>User Status: Offline<br>";
}


/* USER VERFICATION STATUS */
if (check_verified_status($username) == 1) {
    $verified_or_not= "User is Verified<br>";
} else {
    $verified_or_not= "<div id='verified-status'>User is not Verified.</div>";
    $current_user = check_login($con);
    $user_name = $current_user['user_name'];
    $hashed_verify = md5($user_name);
    $verified_or_not.= "<a href='verify.php' style='padding:5px; background-color: white; cursor:pointer;'><span>Verify Now</span></a><br>";
}


/* ACCOUNT BIRTHDAY */
$account_birthday = explode(" ", $user_data['date'])[0];
$account_birthday = "Member Since: " . printable_date($account_birthday);


/* Public Profile Link */
$public_profile_link="<br>Your Public Profile Link: <a href='profile.php?user_name=$username'>$username</a>";

?>

<!-------------------------------------------------------------------------------------
       			                HTML PART
------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html>
<head>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>WYDRN - Edit Profile</title>
  
    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/edit_profile.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Sweet Alert (Beautiful looking alert plugin-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script>
        function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $("#pfpinput").attr("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
    </script>
</head>

<body>
<!--MAIN DIV-->
<div style="margin-top:50px; margin-left:25px;">
<h2>Hello <u><?php echo ucfirst($username) ?></u></h2>


<?php
echo $active_or_not;
echo $verified_or_not;
echo $account_birthday;
echo $public_profile_link;
?>


    <!-- CHANGE AVATAR AND BANNER -->
    <form action="" method="POST" name="ImageUploads" enctype="multipart/form-data" onsubmit ="return Validation();">
        <br>
        <fieldset>     
            <legend> Change Account Photos</legend>   
        <br>
        
        
        Select Profile Photo: <br>
        <input type="file" id="pfpinput" name="PFP" accept="image/png, image/gif, image/jpeg" onchange="previewFile(this);"/>
        <img id="pfpinput" src="images/website/preview.jpg" alt="" style="width:100px; height:100px; border-radius:50%;">
        <br>


        Select Background Banner Photo: <br>
        <input type="file" id="bginput" name="BgImage" accept="image/png, image/gif, image/jpeg"/>
        <br><br>


        <input type="submit" value="Update Profile" class="btn btn-success" name="save_profile">
        
    </fieldset>
    </form>
    <br>

    <!-- TO DELETE ACCOUNT PERMANENTLY -->
        <fieldset>     
            <legend> Delete Account</legend>
            <button type="button"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Delete Account</button>
        </fieldset>




<!-- Modal for Delete Account Confirmation-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">WARNING: Account Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p class="alert-danger alert"> Are you sure you want to delete your account? This action is not reversible. We encourage you to export your data first. Do it <a href="exports/csv_export.php">here</a>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" onclick="window.location.href='delete_user_confirm.php'" class="btn btn-danger">Yes, Delete Account</button>
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
if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
}

function Validation(){
let pfpfile = document.getElementById("pfpinput").value;
let bgfile = document.getElementById("bginput").value;
    
    if ((pfpfile) || (bgfile)){
        return true;
        
    }
    else{
        //sweet alert plugin to display error message. IT REPLACES the JS alert() function.
        swal({
        title: "Select a file",
        text: "Upload at least one file!",
        icon: "error",
        button: "Retry",
        });
        return false;
    }
}

//sweet alert plugin to display error message. IT REPLACES the JS alert() function.
//Gets verification status of the user and if account is not verified, displays a reminders.
let verification= document.getElementById("verified-status");
if (verification.innerHTML == "User is not Verified."){
    swal({
        title: "Verify Account",
        text: "Get your account verified soon!",
        icon: "warning",
        button: "I will do it",
        });
}

</script>
</body>
</html>


<!-------------------------------------------------------------------------------------
       			               PHP PART
------------------------------------------------------------------------------------->
<?php

// CODE TO CHANGE THE PROFILE PICTURE AND BACKGROUND IMAGE
if (isset($_POST['save_profile'])) {
    $target_dir = "images/users/";

    /*****************
    FOR PROFILE PICTURE 
    ******************/
    if(is_uploaded_file($_FILES['PFP']['tmp_name'])){
   
            $PFPName = date("his") . $_FILES["PFP"]["name"]; //profile picture

            $PFPName = str_replace(' ', '', $PFPName); //remove any whitespaces
            $target_file = $target_dir . basename($PFPName);

            $file_type = $_FILES['PFP']['type']; //returns the mimetype
            $allowed = array("image/jpeg", "image/gif", "image/png");
            
            $msg_class="";

            if(!in_array($file_type, $allowed)) {
                $msg= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $msg_class = "alert-danger";
            }

            if ($_FILES['PFP']['size'] > 1024000) {
                $msg = "Image size should not be greater than 1 MB";
                $msg_class = "alert-danger";
            }

            if (file_exists($target_file)) {
                $msg = "File already exists";
                $msg_class = "alert-danger";
            }

            if($msg_class==""){
                if (move_uploaded_file($_FILES["PFP"]["tmp_name"], $target_file)){
                
                    // ADDING CONTENT BELOW TO AUTOMATICALLY DELETE PREVIOUSLY STORED PFP WHEN A NEW ONE IS UPLOADED
                    $sql = "SELECT `profile_pic` FROM `users` WHERE user_name='$username'";
                    if (mysqli_query($con, $sql)) {
                        $result = mysqli_query($con, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $profile_pic_old = $row['profile_pic'];
                        
                        //ensure that you don't delete the default profile image
                        if ($profile_pic_old != "images/website/defaultPFP.png") {
                            unlink($profile_pic_old);
                        }
                    }

                    // UPDATE THE PROFILE PICTURE IN THE DATABASE
                    $sql = "UPDATE users SET `profile_pic` = '$target_file' WHERE user_name='$username'";
                    if (mysqli_query($con, $sql)) {
                        echo("<center><div class='alert alert-success w-25 text-center alert-dismissible fade show' style='position: absolute; top: 75px; left: 570px;width:fit-content;' role='alert'>
                        Profile Picture Updated Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div></center>");
                    } else {
                        $msg = "There was an error in the database";
                    }
                } else {
                    echo "There was an error uploading the file";
                }
            }// end of if(msg=="")
        
            // if(msg!="") we print the relevant message.
            else{
                echo ("<center><div class='alert alert-danger w-25 text-center alert-dismissible fade show' style='position: absolute; top: 75px; left: 570px; width:500px;' role='alert'>
                "
                .$msg.
                "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div></center>");
            }
   
    } //end of is_uploaded_file(PROFILE IMG)       


    /*****************
    FOR BACKGROUND IMAGE 
    ******************/
    if(is_uploaded_file($_FILES['BgImage']['tmp_name'])){
            $BGName = date("his") . $_FILES["BgImage"]["name"]; //background image
            $BGName = str_replace(' ', '', $BGName); //remove any whitespaces
            $target_file2 = $target_dir . basename($BGName);

            $file_type2 = $_FILES['BgImage']['type']; //returns the mimetype
            $allowed = array("image/jpeg", "image/gif", "image/png");
            
            $msg2="";
            
            if(!in_array($file_type2, $allowed)) {
                $msg2= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $msg_class = "alert-danger";
            }

            if ($_FILES['BgImage']['size'] > 1024000) {
                $msg2 = "Image size should not be greater than 1MB";
            }

            if (file_exists($target_file2)) {
                $msg2 = "File already exists";
            }

            if($msg2==""){
            if (move_uploaded_file($_FILES["BgImage"]["tmp_name"], $target_file2)) {
                // ADDING CONTENT BELOW TO AUTOMATICALLY DELETE PREVIOUSLY STORED BACKGROUND BANNER WHEN A NEW ONE IS UPLOADED
                $sql = "SELECT `background_pic` FROM `users` WHERE user_name='$username'";
                if (mysqli_query($con, $sql)) {
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $bg_pic_old = $row['background_pic'];
                    //ensure that you don't delete the default banner image
                    if ($bg_pic_old != "images/website/defaultBackground.jpg") {
                        unlink($bg_pic_old);
                    }
                }
                // ADDING CONTENT ABOVE TO AUTOMATICALLY DELETE PREVIOUSLY STORED BACKGROUND BANNER WHEN A NEW ONE IS UPLOADED


                $sql = "UPDATE users SET `background_pic` = '$target_file2' WHERE user_name='$username'";
                if (mysqli_query($con, $sql)) {
                    echo("<center><div class='alert alert-success w-25 text-center alert-dismissible fade show' style='position: absolute; top: 150px; left: 570px;width:fit-content;' role='alert'>
                    Background Picture Updated Successfully
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div></center>");
                } else {
                    $msg2 = "There was an error in the database";
                }
            } else {
                $errorBG = "There was an erro uploading the file";
            }
        }// end of if(msg2=="")
        
        // if(msg2!="") we print the relevant message.
        else{
                echo ("<center><div class='alert alert-danger w-25 text-center alert-dismissible fade show' style='position: absolute; top: 160px; left: 570px; width:500px;' role='alert'>"
                .$msg2.
                "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div></center>");
        }
        
        } //end of is_uploaded_file(BACKGROUND IMG)        
            
} //end of isset(submit)

mysqli_close($con);
?>

