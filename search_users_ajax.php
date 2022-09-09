<!--Bootstrap Link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<!-- CSS Stylesheet -->
<link rel="stylesheet" href="CSS/search_users.css">

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
   $name = mysqli_real_escape_string($con,$_POST['search']);
   //filter out logged in users username.
   $query = "SELECT `user_name`, `profile_pic` FROM `users` WHERE `user_name` LIKE '%$name%' and `user_name`!='$username' LIMIT 5";
   $exec = mysqli_query($con, $query);
   while ($result = mysqli_fetch_assoc($exec)) {
?>

      <center>
         <!-- <div class='search-results'> -->
            <div id="list">
               <!-- Assigning searched result in "Search box" in "search.php" file. -->
               <?php
               if ($result["user_name"]) {
               ?>

                  
                  <a class="my-list-item" href=profile.php?user_name=<?php echo $result['user_name'] ?>>
                     <div class="list-item__avatar">
                        <img src="<?php echo $result['profile_pic'] ?>">
                     </div>
                     <div class="list-item__content">
                        <strong class="list-item__name">
                           <?php echo $result['user_name'] ?></strong>
                     </div>
                  </a>
               <?php
               }
               ?>
            </div>
         <!-- </div> -->
      </center>


      <!-- Below php code is just for closing parenthesis. Don't be confused. -->
<?php
   }
}
mysqli_close($con);
?>
</ul>


<!-------------------------------------------------------------------------------------
                    NO HTML OR JAVASCRIPT IS REQUIRED FOR THIS PAGE
------------------------------------------------------------------------------------->