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
            }else{
            $success="<center><div class='alert alert-success w-25 text-center' style='position: absolute;
            top: 50px; left: 570px;' role='alert'> Added as a follower</div></center>";
            echo $follower . " will start following ". $to_follow;
            echo $success; 
            }
         }
}else{
   echo "Cannot follow yourself dummy";
   die;
}
   
   // Displays list of people logged-in user is following
   echo $follower. " is now following";
   $sql2 = "SELECT `followed_username` from `social`  where follower_username='$follower';";    
   $result = mysqli_query($con, $sql2);
   if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
         print_r($row['followed_username']);
         echo "<br>";
         }
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
   
</body>
</html>