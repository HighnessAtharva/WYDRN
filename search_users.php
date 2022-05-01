<?php
include "header2.php";
include "connection.php";
include "functions.php";
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}

if (isset($_GET['search'])) {
    
    ECHO "<div class='search-results'>";
    
    $searchname = $_GET['search'];
    $sql = "SELECT profile_pic FROM users WHERE user_name='$searchname'";
    if ($query = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_array($query);
            $profile_pic = $row['profile_pic'];
            
            //profile pic of the search result
            echo "<img src='$profile_pic' class='profilepic' alt='profile_pic'>";

            // username of the searched result
            echo "<div class='centered'><a href=profile.php?user_name=".$searchname. ">".$searchname."</a></div><br>";
        } else {
            ECHO "<div class='centered2'>That user does not exist.</div>";
            
    }
}

    ECHO "</div>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users</title>
    <link href="css/search_users.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="" method="get">
<div class="searchBox">
<input class="searchInput" type="text" name="search" placeholder="Search">
<button type="submit" class="searchButton" href="search_users.php">
    <i class="material-icons"></i>
</button>
</div>
</form>

</body>
</html>
<?php include "footer.php";?>
