

<?php

/**
 *  Show badge unlocks and follower notifications
 *
 * @version    PHP 8.0.12
 * @since      September 2022
 * @author     Atharva Shah
 */

session_start();
if (empty($_SESSION)) {
  header("Location: login.php");
}

require "header.php";
require "connection.php";
require "functions.php";

$user_data = check_login($con);
$username = $user_data['user_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <title>WYDRN - Notification</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

  <link href="css/backToTop.css" rel="stylesheet">
  <link href="CSS/notifications.css" rel="stylesheet">
</head>

<body>
    <button onclick="topFunction()" id="BackToTopBtn" title="Go to top">&#8657;</button>
    <div class="notif-group">
    <?php

$sql="SELECT `follower_username`, `followed_time` FROM `social` WHERE `followed_username` = '$username' ORDER BY `followed_time` DESC";
$result = mysqli_query($con, $sql);
 while($followers=mysqli_fetch_assoc($result)){
   $follower_username = $followers['follower_username'];
   $followed_time = $followers['followed_time'];
  
   $sql="SELECT `user_name`, `profile_pic` FROM `users` WHERE `user_name` = '$follower_username'";
   $result2 = mysqli_query($con, $sql);
   $follower=mysqli_fetch_assoc($result2);
   $follower_image = $follower['profile_pic']; 
?>
    
    <div class='notification'>
        <img src='<?php echo $follower_image?>' class='profile_pic'>
        
        <a href='profile.php?user_name=<?php echo $follower_username?>'>
        <span class="followerUname"><?php echo $follower_username?></span>
        </a> started followed you on 

        <span class="followedTimestamp"><?php echo date('M j, \'y, g:ia ',strtotime($followed_time)); ?></span>
    </div>


    <?php }
    ?>
     </div>
<script src="js/backToTop.js"></script>
</body>
</html>
<?php mysqli_close($con); ?>