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

<!-------------------------------------------------------------------------------------
       			               HTML
------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shows activity of followed users" />
    <meta name="keywords" content="WYDRN, feed" />
    <title>WYDRN - Social Feed</title>

    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="CSS/feed.css">
    <link href="css/backToTop.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

</head>

<body>
<button onclick="topFunction()" id="BackToTopBtn" title="Go to top">&#8657;</button>
    <div class="heading">
        <h1><img src="images/Icons/PageHeadings/feed.png" class='header-icon'> Social Feed<span>It's never too late to catch up with your friends.</span></h1>
    </div>
    <!-- 
<div class="container"> -->


    <!-------------------------------------------------------------------------------------
       			               PHP PART
------------------------------------------------------------------------------------->
    <?php

    $per_page_record = 30; // Number of entries to show in a page.
    // Look for a GET variable page if not found default is 1.
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $per_page_record;
    
    //select records of users followed by the logged in user where at least one media is logged
    $sql = "SELECT `username`, `videogame`,`platform`,`album`,`artist`,`book`,`author`,`movie`,`year`,`tv`,`streaming`, `datetime`, `profile_pic` from `data` INNER JOIN `users` on `user_name` = `username` WHERE `username` in (SELECT `followed_username` from social where `follower_username`='$username') AND (`videogame` !='' OR `album`!='' OR `book`!='' OR `movie`!='' OR `tv`!='')  ORDER BY `datetime` DESC LIMIT $start_from, $per_page_record;";
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
                    //if data is valid then we print the plx-card-gold

                    //to convert the database dateimte object into a prinatable user-friendly format.
                    $mydate = date("j", strtotime($datetime));
                    $month = date("M", strtotime($datetime));
                    $time = date("g:i", strtotime($datetime));
                    $meridian = date("A", strtotime($datetime));
                    $meridian = strtoupper($meridian);

    ?>

                    <div class="plx-card gold">
                        <!--Background image-->
                        <div class="pxc-bg" style="background:<?php echo getRandomGradient() ?>"> </div>
                        
                        <!--User profile pic-->
                        <div class="pxc-avatar"><img src="<?php echo $profile_pic ?>" width="240px" height="240px" /></div>
                        <div class="pxc-stopper"> </div>
                        <!--ACTUAL CARD CONTAINING DATA-->
                        <div class="pxc-subcard myrow">

                            <!--COLUMN 1 CONTAINS LOGGED ACTIVITIES-->
                            <div class="mycolumn1">
                                <div class="pxc-title"><a class="uname" href="<?php echo 'profile.php?user_name=' . $person ?>"><?php echo $person ?></a></div>

                                <?php if ((!empty($videogame)) && (!empty($platform))) { ?>
                                    <div class="pxc-sub">&#127918 Playing <b><?php echo strtoupper($videogame) ?></b> on <?php echo $platform ?></div>
                                <?php } ?>

                                <?php if ((!empty($album)) && (!empty($artist))) { ?>
                                    <div class="pxc-sub"> &#127911 Listening to <b><?php echo strtoupper($album) ?></b> by <?php echo $artist ?></div>
                                <?php } ?>

                                <?php if ((!empty($book)) && (!empty($author))) { ?>
                                    <div class="pxc-sub"> &#128213 Reading <b><?php echo strtoupper($book) ?></b> by <?php echo $author ?> </div>
                                <?php } ?>

                                <?php if ((!empty($movie)) && (!empty($year))) { ?>
                                    <div class="pxc-sub"> &#128253 Watching <b><?php echo strtoupper($movie) ?></b> (<?php echo $year ?>) </div>
                                <?php } ?>

                                <?php if ((!empty($tv)) && (!empty($streaming))) { ?>
                                    <div class="pxc-sub"> &#128250 Binging <b><?php echo strtoupper($tv) ?></b> On <?php echo $streaming ?> </div>
                                <?php } ?>

                            </div>
                            <!--COLUMN 2 SHOWS PRINTABLE DATE-->
                            <div class="mycolumn2">
                                <div class="date">
                                    <p><?php echo $mydate ?><span><?php echo $month ?></span></p>
                                </div>
                            </div>
                            <div class="mycolumn3">
                                <div class="date">
                                    <p class="time"><?php echo $time ?><span><?php echo $meridian ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

    <?php
                } //else ends
            }
        } else {
            //MESSAGE TO BE SHOWN WHEN THE FEED IS EMPTY.
            echo "<center><p style='color:black; padding: 20px; width:fit-content; background-color:white;'> EMPTY FEED. YOU ARE SUCH A LONER!</p><br>
        <a href='search_users.php' style='color:white;padding: 10px; border-radius:5px;background-color:green; text-decoration:none; '>FOLLOW MORE PEOPLE</a></center>";
        }
    }
    ?>


    <!-------------------------------------------------------------------------------------
                                PAGINATION
------------------------------------------------------------------------------------->
    <center>
        <div class="pagination">
            <?php
            // $query = "SELECT count(*) from `data` WHERE `username`= '$username'";
            $query = "SELECT count(*) from `data` INNER JOIN `users` on `user_name` = `username` WHERE `username` in (SELECT `followed_username` from social where `follower_username`='$username')";
            $rs_result = mysqli_query($con, $query);
            $row = mysqli_fetch_row($rs_result);
            $total_records = $row[0];

            echo "</br>";
            // CALCULATING THE NUMBER OF PAGES
            $total_pages = ceil($total_records / $per_page_record);

            // in pagination, show a max of 10 pages. No More!
            if ($total_pages > 10) {
                $total_pages = 10;
            }
            $pageLink = "";

            // SHOW PREVIOUS BUTTON IF NOT ON PAGE 1
            if ($page >= 2) {
                echo "<a href='feed.php?page=" . ($page - 1) . "'> <span class='neonText'> ← </span> </a>";
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

            // SHOW NEXT BUTTON IF NOT O-N LAST PAGE
            if ($page < $total_pages) {
                echo "<a href='feed.php?page=" . ($page + 1) . "'>  <span class='neonText'> → </span> </a>";
            }
            ?>
        </div>
        <!--END OF PAGINATION ROW -->
    </center>

</body>

<script src="js/backToTop.js"></script>


</html>
<?php mysqli_close($con); ?>