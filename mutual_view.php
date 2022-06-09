<!--

DESCRIPTION: USERS CAN ARRIVE HERE BY CLICKING ON THE MUTUAL VIEW BUTTON ON THE PROFILE OF A USERS. SHOWS THE COMMON MEDIA ITEMS MUTUAL TO BOTH THE USERS.

-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutual View</title>
    <link href="css/mutual_view.css" rel="stylesheet">
</head>
<body>
<br><br>

<?php
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
include "header2.php";
include "connection.php";
include "functions.php";
include "footer.php";

$user_data = check_login($con);
if (isset($_GET['user_name'])) {
    $otheruser = $_GET['user_name'];
    $me = $user_data['user_name'];
}?>

    <!--HEADING-->
    <center><h1>Mutual View for <?php echo ($me . " & " . $otheruser) ?></h1></center>

    <div>
        <div>Total Mutual Media<br><?php echo (get_mutual_media_count($me, $otheruser)[5]); ?></div>
        <div>VideoGame<br><?php echo (get_mutual_media_count($me, $otheruser)[0]); ?></div>
        <div>Albums<br><?php echo (get_mutual_media_count($me, $otheruser)[1]); ?></div>
        <div>Books<br><?php echo (get_mutual_media_count($me, $otheruser)[2]); ?></div>
        <div>Movies<br><?php echo (get_mutual_media_count($me, $otheruser)[3]); ?></div>
        <div>TV<br><?php echo (get_mutual_media_count($me, $otheruser)[4]); ?></div>
    <div>


    <!--VIDEO GAMES-->
    <div class="container">
        <div>
            <h2>Video Games</h2>
        </div>

        <?php
$sql = "SELECT videogame FROM data WHERE username='$me'  AND videogame != ''
            INTERSECT
            SELECT videogame FROM data WHERE username='$otheruser'  AND videogame != ''";
if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $videogame = $row['videogame'];
            echo $videogame;
            echo "<br>";
        }
    } else {
        echo ("There are no common videogames between you and $otheruser");
    }
}
?>
    </div>


     <!--Music-->
     <div class="container">
        <div>
            <h2>Music</h2>
        </div>

        <?php
$sql = "SELECT album, artist FROM data WHERE username='$me' AND album!='' AND artist!=''
            INTERSECT
            SELECT album, artist FROM data WHERE username='$otheruser' AND album!='' AND artist!=''";
if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $album = $row['album'];
            echo $album;
            echo "<br>";
        }
    } else {
        echo ("There are no common albums between you and $otheruser");
    }
}
?>
    </div>

    <!--Books-->
    <div class="container">
        <div>
            <h2>Books</h2>
        </div>

        <?php
$sql = "SELECT book, author FROM data WHERE username='$me'  AND book!='' AND author!=''
            INTERSECT
            SELECT book, author FROM data WHERE username='$otheruser'  AND book!='' AND author!=''";
if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $book = $row['book'];
            echo $book;
            echo "<br>";
        }
    } else {
        echo ("There are no common books between you and $otheruser");
    }
}
?>
    </div>

      <!--Movie-->
      <div class="container">
        <div>
            <h2>Movies</h2>
        </div>

        <?php
$sql = "SELECT movie, year FROM data WHERE username='$me' AND movie!='' AND year!=''
            INTERSECT
            SELECT movie, year FROM data WHERE username='$otheruser' AND movie!='' AND year!=''";
if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $movie = $row['movie'];
            echo $movie;
            echo "<br>";
        }
    } else {
        echo ("There are no common movies between you and $otheruser");
    }
}
?>
    </div>

      <!--TV-->
      <div class="container">
        <div>
            <h2>TV</h2>
        </div>

        <?php
$sql = "SELECT tv FROM data WHERE username='$me' AND tv != ''
            INTERSECT
            SELECT tv FROM data WHERE username='$otheruser' AND tv != ''";
if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $tv = $row['tv'];
            echo $tv;
            echo "<br>";
        }
    } else {
        echo ("There are no common Television Shows between you and $otheruser");
    }
}
?>
    </div>

</body>
</html>