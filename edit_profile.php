<?php

/*

DESCRIPTION: THIS PAGE ALLOWS USER TO CHANGE THEIR PROFILE PHOTO, PROFILE BACKGROUND AND PASSWORD. MORE EDIT         ACTIVTY CAN BE ADDED LATER.

 */

session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
include "connection.php";
include "functions.php";
include "header2.php";
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
	
    <link href="css/header.css" type="stylesheet/css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!--MAIN DIV-->
<div style="margin-top:50px; margin-left:25px;">
<div>Hello <b><u><?php echo ucfirst($username) ?></u></b>, you can change your PFP and Background Image here.</div>
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
    echo "<a href='verify.php' style='padding:5px; background-color: white; cursor:pointer;'>Verify Now</a></span>";
}

// Account Created On
$account_birthday = explode(" ", $user_data['date'])[0];
echo "Member Since: " . $account_birthday . "<br>";

// Public Profile Link
echo "<br>Your Public Profile Link: <a href='profile.php?user_name=$username'>$username</a>";
?>

</div>
<form action="" method="POST" name="ImageUploads" enctype="multipart/form-data">
        <br>
        Select Profile Photo to Upload: <input type="file" name="PFP" accept=".png, .jpg, .jpeg, image/png, image/jpg, image/jpeg, .gif">
        <br><br>
        Select Background Photo to Upload: <input type="file" name="BgImage" accept=".png, .jpg, .jpeg, image/png, image/jpg, image/jpeg, .gif">

        <br><br><br>
        <input type="submit" value="Save" name="save_profile">
    </form>
</div>
        </div>
<!--STICKY FOOTER INCLUDED AT THE BOTTOM OF THE PAGE-->
<?php include "footer.php";?>
<!--END OF MAIN BODY-->
</body>
</html>


<!--

    PHP PART
-->

<?php
// CODE TO CHANG THE PROFILE PICTURE AND BACKGROUND IMAGE
if (isset($_POST['save_profile'])) {
    $PFPName = date("his") . $_FILES["PFP"]["name"]; //profile picture
    $BGName = $_FILES["BgImage"]["name"]; //background image

    // For image upload
    $target_dir = "images/users/";
    $target_file = $target_dir . basename($PFPName);
    $target_file2 = $target_dir . basename($BGName);

    // VALIDATION
    // validate image size. Size is calculated in Bytes
    if ($_FILES['PFP']['size'] > 1024000) {
        $msg = "Image size should not be greated than 1MBs";
        $msg_class = "alert-danger";
    }

    if ($_FILES['BgImage']['size'] > 1024000) {
        $msg = "Image size should not be greated than 1MBs";
        $msg_class = "alert-danger";
    }

    // check if file exists
    if (file_exists($target_file)) {
        $msg = "File already exists";
        $msg_class = "alert-danger";
    }

    if (file_exists($target_file2)) {
        $msg = "File already exists";
        $msg_class = "alert-danger";
    }

    // Upload image only if no errors
    if (empty($error)) {

        //inserting PFP into DB
        if (move_uploaded_file($_FILES["PFP"]["tmp_name"], $target_file)) {
            $sql = "UPDATE users SET `profile_pic` = '$target_file' WHERE user_name='$username'";
            if (mysqli_query($con, $sql)) {
                $msg = "Image uploaded and saved in the Database";
            } else {
                $msg = "There was an error in the database";
            }
        } else {
            $error = "There was an erro uploading the file";
        }

        //inserting Background into DB
        if (move_uploaded_file($_FILES["BgImage"]["tmp_name"], $target_file2)) {
            $sql = "UPDATE users SET `background_pic` = '$target_file2' WHERE user_name='$username'";
            if (mysqli_query($con, $sql)) {
                $msg = "Image uploaded and saved in the Database";
                $msg_class = "alert-success";
            } else {
                $msg = "There was an error in the database";
                $msg_class = "alert-danger";
            }
        } else {
            $error = "There was an erro uploading the file";
            $msg = "alert-danger";
        }
    }
    if (!empty($error)) {
        $messed = "<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
               top: 450px; left: 570px;' role='alert'>
               Could not update the details!
               </div></center>";
        echo $messed;
    } else {
        $updated = "<center><div class='alert alert-success w-25 text-center' style='position: absolute;
        top: 450px; left: 570px;' role='alert'>
       Details updated successfully!
        </div></center>";
        echo $updated;
    }
}
?>

