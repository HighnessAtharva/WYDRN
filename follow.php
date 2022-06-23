<?php

/*

DESCRIPTION: USERS LAND ON THIS PAGE FROM THE FOLLOW/FOLLOWING BUTTON ON THE PROFILE PAGE. ALLOWS USERS TO FOLLOW OTHER USERS AND DISPLAYS A LIST OF ALL THE FOLLOWED/FOLLOWING USERS WITH HYPERLINKS TO THIER PROFILES IN FORM OF 2 DIVS.   

*/


session_start();
if(empty($_SESSION))
{
  header("Location: login.php");
}
include "connection.php";
include "functions.php";

if(isset($_GET['user_name'])){
$user_data = check_login($con);
$follower=$user_data['user_name']; // the person who is logged in
$to_follow=$_GET['user_name'];  // the person who is being followed

if($to_follow!=$follower){
 
      // query to check if the user to follow exists in user database.
      $query = "select `user_name` from `users` where user_name = '$to_follow'";
      $result = mysqli_query($con, $query);
      if ($result && mysqli_num_rows($result)>0){
      
            // query to insert as a successful follower if a user exists in the database.
            $sql = "INSERT INTO `social`(`follower_username`, `followed_username`) VALUES ('$follower', '$to_follow')";    
            if (!mysqli_query($con, $sql)) {
               $invalid_follow = "<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
               top: 50px; left: 570px;' role='alert'>
               Already following that user!
               </div></center>";
               echo $invalid_follow; 
               // if a user is trying to follow an already followed person, make the user unfollow the person..
               $sql_delete = "DELETE FROM `social` WHERE `follower_username` = '$follower' AND `followed_username` = '$to_follow'";   
               if (mysqli_query($con, $sql_delete)) {
                  $unfollow = "<center><div class='alert alert-danger w-25 text-center' style='position: absolute;
                  top: 50px; left: 570px;' role='alert'><b>". $follower . "</b> unfollowed <b>". $to_follow."</b></div></center>";
                  echo $unfollow; 
               }

            }else{
            $success="<center><div class='alert alert-success w-25 text-center' style='position: absolute;
            top: 50px; left: 570px;' role='alert'><b>". $follower . "</b> is now following <b>". $to_follow."</b></div></center>";
            
            echo $success; 
            //header("Location: profile.php"); 
            }
         }
         header("Location: profile.php?user_name=".$to_follow);
   }
      else{
      echo "Cannot follow yourself dummy";
      die; 
      }
}
mysqli_close($con);
?>
