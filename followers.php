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

<!-------------------------------------------------------------------------------------
                              HTML PART
------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="shows followers of the loggedin user" />
  <meta name="keywords" content="WYDRN, followers" />
      <title>WYDRN - Followers</title>

      <!--ORDER OF PLACING CSS CDN AND SCRIPT IS IMPORTANT. CUSTOM CSS COMES LAST AS WE OVERRIDE BOOTSTRAP CLASSES.-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">
    
      <link href="CSS/followers.css" rel="stylesheet">
      <link href="css/backToTop.css" rel="stylesheet">
   </head>

<body>
<button onclick="topFunction()" id="BackToTopBtn" title="Go to top">&#8657;</button>

<?php

if(isset($_GET['user_name'])){
$follower=$_GET['user_name'];
}else{
   $follower=$username;
}


//join query for social and user table where the matching criteria is follower_username and username
$sql="SELECT count(*) from `social` s LEFT JOIN `users` u ON s.follower_username=u.user_name where followed_username='$follower'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$count = $row[0];

?>



<div class="container">
   <h1 class="h1count"><?php echo $count; ?> Followers</h1>
      <ul class="follow-ul">
         
         <?php
            $sql2="SELECT `follower_username`, `profile_pic` from `social` s LEFT JOIN `users` u ON s.follower_username=u.user_name where followed_username='$follower'";
            $result = mysqli_query($con, $sql2);
            if(mysqli_num_rows($result) > 0){
               while($row = mysqli_fetch_assoc($result)){
         ?>
   
                  <!-- DYNAMICALLY THE LIST OF ALL FOLLOWERS WITH PROFILE PIC AND LINK TO THEIR PROFILES -->
                  <li class='follow-li'>
                     <!--USERNAME-->
                     <?php $profile_link="profile.php?user_name=".$row['follower_username'];?>
                     <a class="follow-a" href=<?php echo $profile_link; ?>>
                        <div class="flex-container" style="vertical-align:middle;">
                        <span class="follow-span">
                           <img src=<?php echo $row['profile_pic']; ?> class="follower-pfp">
                        </span>
                        <strong class="follow-username"><?php echo strtoupper($row['follower_username']); ?></strong>
                        </div>
                     </a>                     
                  </li>
         
            
         <?php  
               }
            } 
         
         ?>
           
      </ul>        
</div> <!--Container DIV end.-->


<script src="js/backToTop.js"></script>
</body>
</html>
<?php 
	mysqli_close($con);
?>