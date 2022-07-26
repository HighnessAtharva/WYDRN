<?php

/**
 * Shows list of users who are following a particular user.
 *
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */


session_start();
if(empty($_SESSION))
{
  header("Location: login.php");
}
require "connection.php";
require "functions.php";
require "header.php";
$user_data = check_login($con);
$username = $user_data['user_name'];
?>

<!--ORDER OF PLACING CSS CDN AND SCRIPT IS IMPORTANT. CUSTOM CSS COMES LAST AS WE OVERRIDE BOOTSTRAP CLASSES.-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link href="CSS/followers.css" rel="stylesheet">

<div><br><br><br>
<input type="button" class="btn btn-primary" style="margin-left:20px;" value="Return" onclick="window.location.href='profile.php?user_name=<?php echo $_GET['user_name']?>'">
<div>

<!--THIS IS THE DIV OF THE FOLLOWERS SECTION-->  
<div class="col-sm">
  <ul class="list-group ms-5 p-3" style="margin-top:50px; width: 400px;">
  
  <div>
      <?php
      $follower=$_GET['user_name'];
      $sql2 = "SELECT `follower_username`, `profile_pic` from `social` s LEFT JOIN `users` u ON s.followed_username=u.user_name where followed_username='$follower' AND `follower_username` = '$username'";    
      $result = mysqli_query($con, $sql2);
      if(mysqli_num_rows($result) > 0){
         echo ("You are following @". $follower);            
      }
      ?>
   </div>

   <div>
      <b>Followers of @<?php echo $follower?> - </b><br>
   </div>  
   

   <?php
   //outdated
   $sql = "SELECT `follower_username` from `social` where followed_username='$follower' AND `follower_username` != '$username';";
   
   //new
   $sql2="SELECT `follower_username`, `profile_pic` from `social` s LEFT JOIN `users` u ON s.follower_username=u.user_name where followed_username='$follower' AND `follower_username` != '$username'";

   $result = mysqli_query($con, $sql2);
   if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
         
            // this echo statement displays the list of followers with their own links.
            echo "<li class='list-group-item-info rounded-pill p-1 m-1'>".
            "<span><img src=".$row['profile_pic']." class='follower-pfp'></span>&nbsp&nbsp&nbsp".
            "<a href=profile.php?user_name=".$row['follower_username'].">".$row['follower_username']."</a>         
            </li>";
            
         }
      }  
   ?>
   </ul>
   </div>
   <!--DIV END FOLLOWERS SECTION-->  

   <?php 
   	mysqli_close($con);

   ?>