<?php
session_start();

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
               Unable to follow!
               </div></center>";
               echo $invalid_follow; 
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
   <ul class="list-group" style="margin-top:250px;">
         <?php
         $user_data = check_login($con);
         $follower=$user_data['user_name']; // the person who is logged in
                     
         // Displays the complete list of people logged-in user is following
         echo "List of people ". $follower." is following";
         echo "<br>";
         $sql2 = "SELECT `followed_username` from `social`  where follower_username='$follower';";    
         $result = mysqli_query($con, $sql2);
         if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
               echo "<li class='list-group-item'>".$row['followed_username']."</li>";
               }
            }
         
         ?>
   </ul>
   </div>
</body>
</html>