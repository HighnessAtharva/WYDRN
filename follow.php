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
   }
      else{
      echo "Cannot follow yourself dummy";
      die; 
      }
}
       

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Follow</title>
</head>
<!--ORDER OF PLACING CSS CDN AND SCRIPT IS IMPORTANT. CUSTOM CSS COMES LAST AS WE OVERRIDE BOOTSTRAP CLASSES.-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<body>
   <div>
      <a href="profile.php">Return</a>
   </div>

<div class="container">
   <div class="row">

   <!--THIS IS THE DIV OF THE FOLLOWING SECTION-->  
   <div class="col-sm">
   <ul class="list-group ms-5 p-3" style="margin-top:250px; width: 400px;">
         <?php
         $user_data = check_login($con);
         $follower=$user_data['user_name']; // the person who is logged in
                     
         // Displays the complete list of people logged-in user is following
         echo "<b>". $follower." - Following </b>";
         echo "<br>";
        $sql2 = "SELECT `followed_username` from `social`  where `follower_username`='$follower';";    
         $result = mysqli_query($con, $sql2);
         if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
               if(check_active_status($row['followed_username'])==1){
                  // this echo statement displays the list of followers with their own links.
                  echo "<li class='list-group-item-info rounded-pill p-1 m-1'>
                  <a href=profile.php?user_name=".$row['followed_username'].">".$row['followed_username']."</a>
                  <span class='badge badge-success text-success'>Online</span>
                  </li>";
                  
               }
               
               if(check_active_status($row['followed_username'])==0){
                  // this echo statement displays the list of followers with their own links.
                  echo "<li class='list-group-item-info rounded-pill p-1 m-1'>
                  <a href=profile.php?user_name=".$row['followed_username'].">".$row['followed_username']."</a>
                  <span class='badge badge-success text-danger'>Offline</span>
                  </li> ";
                  
               }
               }
            }  
         ?>
   </ul>
   </div>
   <!--DIV END FOLLOWING SECTION-->  


   <!--THIS IS THE DIV OF THE FOLLOWERS SECTION-->  
   <div class="col-sm">
   <ul class="list-group ms-5 p-3" style="margin-top:250px; width: 400px;">
         <?php
         $user_data = check_login($con);
         $follower=$user_data['user_name']; // the person who is logged in
                     
         // Displays the complete list of people logged-in user is following
         echo "<b>". $follower." - Followers</b>";
         echo "<br>";
         $sql2 = "SELECT `follower_username` from `social`  where followed_username='$follower';";    
         $result = mysqli_query($con, $sql2);
         if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
               if(check_active_status($row['follower_username'])==1){
                  // this echo statement displays the list of followers with their own links.
                  echo "<li class='list-group-item-info rounded-pill p-1 m-1'>
                  <a href=profile.php?user_name=".$row['follower_username'].">".$row['follower_username']."</a>
                  <span class='badge badge-success text-success'>Online</span>
                  </li>";
                  
               }
               
               if(check_active_status($row['follower_username'])==0){
                  // this echo statement displays the list of followers with their own links.
                  echo "<li class='list-group-item-info rounded-pill p-1 m-1'>
                  <a href=profile.php?user_name=".$row['follower_username'].">".$row['follower_username']."</a>
                  <span class='badge badge-success text-danger'>Offline</span>
                  </li> ";
                  
               } 
            }
            }  
         ?>
   </ul>
   </div>
   <!--DIV END FOLLOWERS SECTION-->  

         </div>
         </div>


</body>
</html>