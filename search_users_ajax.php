<?php
//Including Database configuration file
include "connection.php";
include "functions.php";
if (isset($_POST['search'])) {
   $name = $_POST['search'];
   $query = "SELECT `user_name` FROM `users` WHERE `user_name` LIKE '%$name%' LIMIT 5";
   

   $exec=mysqli_query($con,$query);
   while ($result = mysqli_fetch_assoc($exec)) {
       ?>

<center>
<div style="padding: 5px; background-color:skyblue;">
    <p onclick='fill("<?php echo $result["user_name"]; ?>")' style='font-size:1.2em '>    
    <a>
    <!-- Assigning searched result in "Search box" in "search.php" file. -->
        <?php 
        echo "<a href=profile.php?user_name=".$result['user_name'].">".$result['user_name']."</a>" ;
        ?>
    </p>
    </a>
</div>
</center>


<!-- Below php code is just for closing parenthesis. Don't be confused. -->
   <?php
}}
?>
</ul>