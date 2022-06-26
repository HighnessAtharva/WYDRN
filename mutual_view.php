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
<?php
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}

require "connection.php";
require "functions.php";
require "header.php";

$user_data = check_login($con);
if (isset($_GET['user_name'])) {
    $otheruser = $_GET['user_name'];
    $me = $user_data['user_name'];
}?>

    <!--HEADING-->
    <center><h1>Mutual View for <?php echo ($me . " & " . $otheruser) ?></h1>
    
    <div class="flex spaceEvenly" id="counter">
        <div id="mydiv">
            Total Mutual Media<br><?php echo (get_mutual_media_count($me, $otheruser)[5]); ?>
        </div>
       
        <div id="mydiv">
            VideoGame<br><?php echo (get_mutual_media_count($me, $otheruser)[0]); ?>
        </div>
       
        <div id="mydiv">
            Albums<br><?php echo (get_mutual_media_count($me, $otheruser)[1]); ?>
        </div>
       
        <div id="mydiv">
            Books<br><?php echo (get_mutual_media_count($me, $otheruser)[2]); ?>
        </div>
       
        <div id="mydiv">
            Movies<br><?php echo (get_mutual_media_count($me, $otheruser)[3]); ?>
        </div>
        
        <div id="mydiv">
            TV<br><?php echo (get_mutual_media_count($me, $otheruser)[4]); ?>
        </div id="mydiv">
    <div>
    
    </center>
    <!--VIDEO GAMES-->
    <div class="media">
        <div>
            <h2>Video Games</h2>
        </div>

        <?php
        $sql = "SELECT videogame FROM data WHERE username='$me'  AND videogame != ''
                    INTERSECT
                    SELECT videogame FROM data WHERE username='$otheruser'  AND videogame != ''";
        if ($query = mysqli_query($con, $sql)) {
            if (mysqli_num_rows($query) > 0) {
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($query)) {
                    $videogame = $row['videogame'];
                    echo ("<li>".$videogame."</li>");
                }
                echo "</ul>";
            } else {
                echo ("There are no common videogames between you and $otheruser");
            }
        }
        ?>
    </div>


     <!--Music-->
     <div class="media">
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
    <div class="media">
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
      <div class="media">
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
      <div class="media">
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
mysqli_close($con);
?>
    </div>

</body>
</html>