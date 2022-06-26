<?php

/*

DESCRIPTION: THIS PAGE ALLOWS USER TO CHANGE THEIR PROFILE PHOTO, PROFILE BACKGROUND AND PASSWORD. MORE EDIT         ACTIVTY CAN BE ADDED LATER.

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
?>

<!--
    HTML PART
-->
<!DOCTYPE html>
<html>
<head>
  <title>Edit Profile</title>
  <!--ORDER OF PLACING CSS CDN AND SCRIPT IS IMPORTANT. CUSTOM CSS COMES LAST AS WE OVERRIDE BOOTSTRAP CLASSES.-->
    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link href="css/header.css" type="stylesheet/css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!--MAIN DIV-->
<div style="margin-top:50px; margin-left:25px;">
<div>Hello <b><u><?php echo ucfirst($username) ?></u></b></div>
<div>
    <div>
        <?php
//user active status
if (check_active_status($username) == 1) {
    echo "<br>User Status: Active<br>";
} else {
    echo "<br>User Status: Offline<br>";
}

// user verification status
if (check_verified_status($username) == 1) {
    echo "User is Verified<br>";
} else {
    echo "User is not Verified.";

    $current_user = check_login($con);
    $user_name = $current_user['user_name'];
    $hashed_verify = md5($user_name);
    echo "<a href='verify.php' style='padding:5px; background-color: white; cursor:pointer;'>Verify Now</a></span><br>";
}

// Account Created On
$account_birthday = explode(" ", $user_data['date'])[0];
echo "Member Since: " . printable_date($account_birthday) . "<br>";

// Public Profile Link
echo "<br>Your Public Profile Link: <a href='profile.php?user_name=$username'>$username</a>";
?>

</div>
<form action="" method="POST" name="ImageUploads" enctype="multipart/form-data">
        <br>
        Select Profile Photo to Upload: <br><input type="file" name="PFP" accept=".png, .jpg, .jpeg, image/png, image/jpg, image/jpeg, .gif">
        <br><br>
        Select Background Photo to Upload: <br><input type="file" name="BgImage" accept=".png, .jpg, .jpeg, image/png, image/jpg, image/jpeg, .gif">

        <br><br><br>
        <input type="submit" value="Update Profile" name="save_profile">
    </form>
</div>
        </div>

<!--END OF MAIN BODY-->
</body>
</html>


<!--

    PHP PART
-->

<?php
// CODE TO CHANG THE PROFILE PICTURE AND BACKGROUND IMAGE
if (isset($_POST['save_profile'])) {
    $target_dir = "images/users/";

    /*****************
    FOR PROFILE PICTURE 
    ******************/
    $PFPName = date("his") . $_FILES["PFP"]["name"]; //profile picture
    $target_file = $target_dir . basename($PFPName);

    if ($_FILES['PFP']['size'] > 1024000) {
        $msg = "Image size should not be greated than 1MBs";
        $msg_class = "alert-danger";
    }

    if (file_exists($target_file)) {
        $msg = "File already exists";
        $msg_class = "alert-danger";
    }

    //inserting PFP into DB
    if (move_uploaded_file($_FILES["PFP"]["tmp_name"], $target_file)) {
        $sql = "UPDATE users SET `profile_pic` = '$target_file' WHERE user_name='$username'";
        if (mysqli_query($con, $sql)) {
            $msg = "Image uploaded and saved in the Database";
        } else {
            $msg = "There was an error in the database";
        }
    } else {
        $errorPFP = "There was an erro uploading the file";
    }

    if (!empty($errorPFP)) {
        $messed = "<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
               top: 450px; left: 570px;' role='alert'>
               Could not update the Profile Pic
               </div></center>";
        echo $messed;
    } else {
        $updated = "<center><div class='alert alert-success w-25 text-center' style='position: absolute;
        top: 450px; left: 570px;' role='alert'>
        Profile Pic Updated Successfully!
        </div></center>";
        echo $updated;
    }
    /*****************
    FOR BACKGROUND IMAGE 
    ******************/
    $BGName = $_FILES["BgImage"]["name"]; //background image
    $target_file2 = $target_dir . basename($BGName);

    if ($_FILES['BgImage']['size'] > 1024000) {
        $msg = "Image size should not be greated than 1MBs";
    }

    if (file_exists($target_file2)) {
        $msg = "File already exists";
    }

    //inserting Background into DB
    if (move_uploaded_file($_FILES["BgImage"]["tmp_name"], $target_file2)) {
        $sql = "UPDATE users SET `background_pic` = '$target_file2' WHERE user_name='$username'";
        if (mysqli_query($con, $sql)) {
            $msg = "Image uploaded and saved in the Database";
            $msg_class = "alert-success";
        } else {
            $msg = "There was an error in the database";
        }
    } else {
        $errorBG = "There was an erro uploading the file";
    }

    if (!empty($errorBG)) {
        $messed = "<center><div class='alert alert-danger w-25 text-center' style='position: absolute; top: 490px; left: 570px;' role='alert'>
        Could not update the background image!
        </div></center>";
        echo $messed;
    } else {
        $updated = "<center><div class='alert alert-success w-25 text-center' style='position: absolute; top: 490px; left: 570px;' role='alert'>
        Background image updated successfully!
        </div></center>";
        echo $updated;
    }
  
	mysqli_close($con);

}
?>

