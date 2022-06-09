  <?php
  session_start();
  if(empty($_SESSION))
  {
    header("Location: login.php");
  }
  include "connection.php";
  include "functions.php";
  ?>

<!--ORDER OF PLACING CSS CDN AND SCRIPT IS IMPORTANT. CUSTOM CSS COMES LAST AS WE OVERRIDE BOOTSTRAP CLASSES.-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div>
<input type="button" class="btn btn-primary" value="Return To Profile" onclick="window.location.href='profile.php?user_name=<?php echo $_GET['user_name']?>'">
<div>

  <!--THIS IS THE DIV OF THE FOLLOWERS SECTION-->  
  <div class="col-sm">
   <ul class="list-group ms-5 p-3" style="margin-top:250px; width: 400px;">
         <?php
         
         $follower=$_GET['user_name']; // the user_name passed from the profile.php page
                     
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