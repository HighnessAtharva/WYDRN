<?php

/**
 * THIS WILL BE THE SOCIAL FEED WHERE USERS WILL SEE THE ACTIVITY OF THE PEOPLE THEY FOLLOW. PAGINATION IS IMPLEMENTED.
 *
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
include "connection.php";
include "functions.php";
include "header.php";
error_reporting(E_ERROR | E_PARSE);
$user_data = check_login($con);
$username = $user_data['user_name'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>WYDRN - Social Feed</title>
    
    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="CSS/feed.css">
 
</head>

<body style="background: white;">
    <div class="container">
        
<?php

$per_page_record = 30; // Number of entries to show in a page.
// Look for a GET variable page if not found default is 1.
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;
$sql = "SELECT `username`, `videogame`,`platform`,`album`,`artist`,`book`,`author`,`movie`,`year`,`tv`,`streaming`, `datetime`, `profile_pic` from `data` INNER JOIN `users` on `user_name` = `username` WHERE `username` in (SELECT `followed_username` from social where `follower_username`='$username') ORDER BY `datetime` DESC LIMIT $start_from, $per_page_record;";
if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) > 0) {
        for ($i = 0; $i <= mysqli_num_rows($query); $i++) {
            $row[$i] = mysqli_fetch_array($query);

            $person = $row[$i]['username'];
            $profile_pic = $row[$i]['profile_pic'];

            $videogame = $row[$i]['videogame'];
            $platform = $row[$i]['platform'];

            $album = $row[$i]['album'];
            $artist = $row[$i]['artist'];

            $book = $row[$i]['book'];
            $author = $row[$i]['author'];

            $movie = $row[$i]['movie'];
            $year = $row[$i]['year'];

            $tv = $row[$i]['tv'];
            $streaming = $row[$i]['streaming'];

            $datetime = $row[$i]['datetime'];

            if (empty($person)) {
                // echo "You are all caught up!";

            } else {
              
                //container of each post on the page
                echo "<div class='post'>";
              

                echo ("<img src=" . $profile_pic . " class='profile-pic' alt='Profile Picture'/>");
                echo ("<a class='username' href='profile.php?user_name=" . $person . "'>" . $person . "</a><br>");

                if ((!empty($videogame)) && (!empty($platform))) {
                    $playing = "<div class='activity'> &#127918 Playing <b>" . $videogame . "</b> on " . $platform . "</div>";
                    echo $playing;
                }

                if ((!empty($album)) && (!empty($artist))) {
                    $listening = "<div class='activity'> &#127911 Listening to <b>" . $album . "</b> by <b>" . $artist . "</b></div>";
                    echo $listening;
                }
                if ((!empty($book)) && (!empty($author))) {
                    $reading = "<div class='activity'> &#128213 Reading <b>" . $book . "</b> by <b>" . $author . "</b></div>";
                    echo $reading;
                }

                if ((!empty($movie)) && (!empty($year))) {
                    $watching = "<div class='activity'> &#128253 Watching <b>" . $movie . "</b> (" . $year . ")" . "</div>";
                    echo $watching;
                }

                if ((!empty($tv)) && (!empty($streaming))) {
                    $binging = "<div class='activity'> &#128250 Binging <b>" . $tv . "</b> on " . $streaming . "</div>";
                    echo $binging;
                }
                $datetime = printable_datetime($datetime);
                echo ("<div class='datetime'>" . $datetime . "</div>");

                echo "<br>";

                echo "</div>"; //container of each post on the page
            } //else ends
        }
    } else {
        echo "<center><b>EMPTY FEED. YOU ARE SUCH A LONER!</b><br><a href='search_users.php'>FOLLOW MORE PEOPLE</a></center>";
    }
}
?>

 <!--PAGINATION ROW -->
 <center>
 <div class="pagination">
        <?php
        // $query = "SELECT count(*) from `data` WHERE `username`= '$username'";
        $query="SELECT count(*) from `data` INNER JOIN `users` on `user_name` = `username` WHERE `username` in (SELECT `followed_username` from social where `follower_username`='$username')";
        $rs_result = mysqli_query($con, $query);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        echo "</br>";
        // CALCULATING THE NUMBER OF PAGES
        $total_pages = ceil($total_records / $per_page_record);
        
        // in pagination, show a max of 10 pages. No More!
        if($total_pages>10){
            $total_pages=10;
        }
        $pageLink = "";

        // SHOW PREVIOUS BUTTON IF NOT ON PAGE 1
        if ($page >= 2) {
            echo "<a href='feed.php?page=" . ($page - 1) . "'>  Prev </a>";
        }

        // SHOW THE LINKS TO EACH PAGE IN THE PAGINATION GRID 
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pageLink .= "<a class = 'active' href='feed.php?page="
                    . $i . "'>" . $i . " </a>";
            } else {
                $pageLink .= "<a href='feed.php?page=" . $i . "'>" . $i . " </a>";
            }
        }
        echo $pageLink;

        // SHOW NEXT BUTTON IF NOT ON LAST PAGE
        if ($page < $total_pages) {
            echo "<a href='feed.php?page=" . ($page + 1) . "'>  Next </a>";
        }
        ?>
    </div><!--END OF PAGINATION ROW -->
</center>


</div><!-- container div ends -->
</body>
</html>

<?php 

mysqli_close($con);?>