<!--Bootstrap Link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<!-- CSS Stylesheet -->
<link rel="stylesheet" href="CSS/search_users_ajax.css">

<?php
/**
 *  DISPLAY DATA FROM THE DATABASE ASYNCHRONOUSLY ON THE SEARCH_USERS.PHP PAGE.
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     AtharvaShah
 */

session_start();
require "connection.php";
require "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];


if (isset($_POST['search'])) {
   $name = $_POST['search'];
   //filter out logged in users username.
   $query = "SELECT `user_name`, `profile_pic` FROM `users` WHERE `user_name` LIKE '%$name%' and `user_name`!='$username' LIMIT 5";
   $exec=mysqli_query($con,$query);
   while ($result = mysqli_fetch_assoc($exec)) {
?>

<center>
<div class='search-results'>
    <!-- Assigning searched result in "Search box" in "search.php" file. -->
    <?php 
         if ($result["user_name"]){
         echo "<img src=".$result['profile_pic']." class='profile-pic'></span>&nbsp&nbsp";
         echo "<a href=profile.php?user_name=".$result['user_name']." style='font-size:1.2em'>".$result['user_name']."</a>" ;
         }
     ?>
</div>
</center>


<!-- Below php code is just for closing parenthesis. Don't be confused. -->
<?php
   }}
   mysqli_close($con);
?>
</ul>


<!-------------------------------------------------------------------------------------
                    NO HTML OR JAVASCRIPT IS REQUIRED FOR THIS PAGE
------------------------------------------------------------------------------------->