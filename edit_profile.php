<?php

/*

DESCRIPTION: THIS PAGE ALLOWS USER TO CHANGE THEIR PROFILE PHOTO, PROFILE BACKGROUND AND PASSWORD. MORE EDIT         ACTIVTY CAN BE ADDED LATER.

*/

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$username=$user_data['user_name'];
?>


Hello <?php echo $username?>, you can change your PFP and Background Image here.
<div>
    <form action="" method="POST" name="ImageUploads" enctype="multipart/form-data">
        
        <br><br><br>
        Select Profile Photo to Upload: <input type="file" name="PFP" accept=".png, .jpg, .jpeg, image/png, image/jpg, image/jpeg, .gif">
        
        <br><br><br>
        Select Background Photo to Upload: <input type="file" name="BgImage" accept=".png, .jpg, .jpeg, image/png, image/jpg, image/jpeg, .gif">

        <br><br><br>
        <input type="submit" value="Save" name="save_profile">
    </form>
</div>

<?php
// CODE TO CHANG THE PROFILE PICTURE AND BACKGROUND IMAGE
 if (isset($_POST['save_profile'])) {
    $PFPName= date("his")." - ".$_FILES["PFP"]["name"]; //profile picture
    $BGName= $_FILES["BgImage"]["name"]; //background image
    
    // For image upload
    $target_dir = "images/users/";
    $target_file = $target_dir . basename($PFPName);
    $target_file2= $target_dir . basename($BGName);
    
    // VALIDATION 
    // validate image size. Size is calculated in Bytes
    if($_FILES['PFP']['size'] > 1024000) {
      $msg = "Image size should not be greated than 1MBs";
      $msg_class = "alert-danger";
    }

    if($_FILES['BgImage']['size'] > 1024000) {
        $msg = "Image size should not be greated than 1MBs";
        $msg_class = "alert-danger";
      }
    
    
      // check if file exists
    if(file_exists($target_file)) {
      $msg = "File already exists";
      $msg_class = "alert-danger";
    }

    if(file_exists($target_file2)) {
        $msg = "File already exists";
        $msg_class = "alert-danger";
      }
    
    // Upload image only if no errors
    if (empty($error)) {
      
        //inserting PFP into DB
        if(move_uploaded_file($_FILES["PFP"]["tmp_name"], $target_file)) {
        $sql = "UPDATE users SET `profile_pic` = '$target_file' WHERE user_name='$username'";
        if(mysqli_query($con, $sql)){
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

       //inserting Background into DB
       if(move_uploaded_file($_FILES["BgImage"]["tmp_name"], $target_file2)) {
        $sql = "UPDATE users SET `background_pic` = '$target_file2' WHERE user_name='$username'";
        if(mysqli_query($con, $sql)){
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
  }
?>

