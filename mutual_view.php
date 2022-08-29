<?php

/**
 * USERS CAN ARRIVE HERE BY CLICKING ON THE MUTUAL VIEW BUTTON ON THE PROFILE OF OTHER USERS. SHOWS THE COMMON MEDIA ITEMS MUTUAL TO BOTH THE USERS.
 *
 * @version    PHP 8.0.12
 * @since      June 2022
 * @author     AtharvaShah
 */

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
}


function determineColor($value)
{
    $color = "";
    if (($value >= 0) && ($value <= 15)) {
        $color = "red";
    } else if (($value > 15) && ($value <= 30)) {
        $color = "orange";
    } else if (($value > 30) && ($value <= 45)) {
        $color = "yellow";
    } else if (($value > 45) && ($value <= 60)) {
        $color = "blue";
    } else if (($value > 60) && ($value <= 80)) {
        $color = "green";
    } else if (($value > 80)  && ($value <= 100)) {
        $color = "darkgreen";
    }

    return $color;
}

function SQLGetCount($con, $sql)
{
    if ($query = mysqli_query($con, $sql)) {
        return mysqli_num_rows($query);
    } else {
        return 0;
    }
}



$videogamecount_me = SQLGetCount($con, "SELECT DISTINCT videogame FROM data WHERE username='$me' AND videogame != ''");
$moviecount_me = SQLGetCount($con, "SELECT DISTINCT movie FROM data WHERE username='$me' AND movie != ''");
$musiccount_me = SQLGetCount($con, "SELECT DISTINCT album FROM data WHERE username='$me' AND album != ''");
$bookcount_me = SQLGetCount($con, "SELECT DISTINCT book FROM data WHERE username='$me' AND book != ''");
$tvcount_me = SQLGetCount($con, "SELECT DISTINCT tv FROM data WHERE username='$me' AND tv != ''");



$videogamecount_other = SQLGetCount($con, "SELECT videogame FROM data WHERE username='$otheruser' AND videogame!=''");;
$moviecount_other = SQLGetCount($con, "SELECT movie FROM data WHERE username='$otheruser' AND movie!=''");;
$musiccount_other = SQLGetCount($con, "SELECT album FROM data WHERE username='$otheruser' AND album!=''");
$bookcount_other = SQLGetCount($con, "SELECT book FROM data WHERE username='$otheruser' AND book!=''");;
$tvcount_other = SQLGetCount($con, "SELECT tv FROM data WHERE username='$otheruser' AND tv!=''");;



$videogamecount_mutual = SQLGetCount(
    $con,
    "SELECT LOWER(videogame) FROM data WHERE username='$me'  AND videogame != ''
INTERSECT
SELECT LOWER(videogame) FROM data WHERE username='$otheruser'  AND videogame != ''"
);

$moviecount_mutual = SQLGetCount(
    $con,
    "SELECT LOWER(movie) , year FROM data WHERE username='$me' AND movie!='' 
INTERSECT
SELECT LOWER(movie) , year FROM data WHERE username='$otheruser' AND movie!=''"
);

$musiccount_mutual = SQLGetCount(
    $con,
    "SELECT LOWER(album) , artist FROM data WHERE username='$me' AND album!='' AND artist!=''
INTERSECT
SELECT LOWER(album), artist FROM data WHERE username='$otheruser' AND album!='' AND artist!=''"
);

$bookcount_mutual = SQLGetCount(
    $con,
    "SELECT LOWER(book), author FROM data WHERE username='$me'  AND book!='' AND author!=''
INTERSECT
SELECT LOWER(book), author FROM data WHERE username='$otheruser'  AND book!='' AND author!=''"
);


$tvcount_mutual = SQLGetCount(
    $con,
    "SELECT tv FROM data WHERE username='$me' AND tv != ''
INTERSECT
SELECT tv FROM data WHERE username='$otheruser' AND tv != ''"
);


// TO PREVENT ZERO DIVISION ERROR
if ($videogamecount_other == 0) {
    $videogamecount_other = 1;
}

if ($bookcount_other == 0) {
    $bookcount_other = 1;
}

if ($musiccount_other == 0) {
    $musiccount_other = 1;
}

if ($moviecount_other == 0) {
    $moviecount_other = 1;
}

if ($tvcount_other == 0) {
    $tvcount_other = 1;
}



$mutual_game_percentage = round(($videogamecount_mutual / $videogamecount_other) * 100);
$mutual_movie_percentage = round(($moviecount_mutual / $moviecount_other) * 100);
$mutual_music_percentage = round(($musiccount_mutual / $musiccount_other) * 100);
$mutual_book_percentage = round(($bookcount_mutual / $bookcount_other) * 100);
$mutual_tv_percentage = round(($tvcount_mutual / $tvcount_other) * 100);

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

    <title>WYDRN - Mutual View</title>

    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


    <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

    
    <link href="css/mutual_view.css" rel="stylesheet">
</head>

<body>

    <!------------------------------------------
            SHOWING BUTTONS
    --------------------------------------------->

    <h1>Mutual View for <?php echo ($me . " & " . $otheruser) ?></h1>


    <div class="media-item-div" id="mutualGenericBtn">
        <h2 class="mutual-media-title">Total Mutual Media</h2><br>
        <h3 class="mutual-media-subtitle"><?php echo (get_mutual_media_count($me, $otheruser)[5]); ?></h3>
    </div>


    <!------------------------------------------
        VIDEO GAMES SECTION
        --------------------------------------------->
    <div class="media-item-div" id="mutualGameBtn">
        <h2 class="mutual-media-title">VIDEOGAMES</h2><br>
        <h3 class="mutual-media-subtitle"><?php echo (get_mutual_media_count($me, $otheruser)[0]); ?></h3>
    </div>


    <center>
        <div class="media" id="mutualGameDiv" style="display:none;">
            <div>
                <!-- <h2>Videogames</h2> -->
            </div>


            <!-- CIRCULAR ANIMATION -->
            <div class="flex-wrapper">
                <!--DISPLAY WATCHED X/Y COUNT WHERE X = YOUR MEDIA AND Y=THEIR MEDIA-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart black">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="100, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <text x="18" y="20.35" class="mutual-items-count">
                            <?php echo $videogamecount_mutual ?>/<?php echo $videogamecount_other ?>
                        </text>

                    </svg>
                </div>

                <!--DISPLAY PERCENTAGE-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart <?php echo determineColor($mutual_game_percentage) ?>">

                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="<?php echo $mutual_game_percentage ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <text x="18" y="20.35" class="percentage">
                            <?php echo $mutual_game_percentage ?>%
                        </text>
                    </svg>
                </div>
            </div>


            <!--TO SHOW THE MEDIA ITEMS-->
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
    </center>


    <!------------------------------------------
            ALBUMS SECTION
    --------------------------------------------->

    <div class="media-item-div" id="mutualMusicBtn">
        <h2 class="mutual-media-title">ALBUMS</h2><br>
        <h3 class="mutual-media-subtitle"><?php echo (get_mutual_media_count($me, $otheruser)[1]); ?></h3>
    </div>


    <center>
        <div class="media" id="mutualMusicDiv" style="display:none;">
            <div>
                <!-- <h2>Music</h2> -->
            </div>

            <!-- CIRCULAR ANIMATION -->
            <div class="flex-wrapper">
                <!--DISPLAY WATCHED X/Y COUNT WHERE X = YOUR MEDIA AND Y=THEIR MEDIA-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart black">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="100, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <text x="18" y="20.35" class="mutual-items-count">
                            <?php echo $musiccount_mutual ?>/<?php echo $musiccount_other ?>
                        </text>

                    </svg>
                </div>

                <!--DISPLAY PERCENTAGE-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart <?php echo determineColor($mutual_music_percentage) ?>">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="<?php echo $mutual_music_percentage ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <text x="18" y="20.35" class="percentage">
                            <?php echo $mutual_music_percentage ?>%
                        </text>
                    </svg>
                </div>
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
    </center>

    <!------------------------------------------
                BOOKS SECTION
    --------------------------------------------->

    <div class="media-item-div" id="mutualBookBtn">
        <h2 class="mutual-media-title">BOOKS</h2><br>
        <h3 class="mutual-media-subtitle"><?php echo (get_mutual_media_count($me, $otheruser)[2]); ?>
    </div>

    <center>
        <div class="media" id="mutualBookDiv" style="display:none;">
            <div>
                <!-- <h2>Books</h2> -->
            </div>

            <!-- CIRCULAR ANIMATION -->
            <div class="flex-wrapper">
                <!--DISPLAY WATCHED X/Y COUNT WHERE X = YOUR MEDIA AND Y=THEIR MEDIA-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart black">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="100, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <text x="18" y="20.35" class="mutual-items-count">
                            <?php echo $bookcount_mutual ?>/<?php echo $bookcount_other ?>
                        </text>

                    </svg>
                </div>


                <!--DISPLAY PERCENTAGE-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart <?php echo determineColor($mutual_book_percentage) ?>">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="<?php echo $mutual_book_percentage ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <text x="18" y="20.35" class="percentage">
                            <?php echo $mutual_book_percentage ?>%
                        </text>
                    </svg>
                </div>
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
    </center>



    <!------------------------------------------
            MOVIES SECTION
    --------------------------------------------->

    <div class="media-item-div" id="mutualMovieBtn">
        <h2 class="mutual-media-title">MOVIES</h2><br>
        <h3 class="mutual-media-subtitle"><?php echo (get_mutual_media_count($me, $otheruser)[3]); ?></h3>
    </div>

    <center>

        <div class="media" id="mutualMovieDiv" style="display:none;">
            <div>
                <!-- <h2>Movies</h2> -->
            </div>

            <!-- CIRCULAR ANIMATION -->
            <div class="flex-wrapper">
                <!--DISPLAY WATCHED X/Y COUNT WHERE X = YOUR MEDIA AND Y=THEIR MEDIA-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart black">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="100, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <text x="18" y="20.35" class="mutual-items-count">
                            <?php echo $moviecount_mutual ?>/<?php echo $moviecount_other ?>
                        </text>

                    </svg>
                </div>

                <!--DISPLAY PERCENTAGE-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart <?php echo determineColor($mutual_movie_percentage) ?>">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="<?php echo $mutual_movie_percentage ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <text x="18" y="20.35" class="percentage">
                            <?php echo $mutual_movie_percentage ?>%
                        </text>
                    </svg>
                </div>
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
    </center>

    <!------------------------------------------
                TV SERIES SECTION
    --------------------------------------------->

    <div class="media-item-div" id="mutualTVBtn">
        <h2 class="mutual-media-title">TV</h2><br>
        <h3 class="mutual-media-subtitle"><?php echo (get_mutual_media_count($me, $otheruser)[4]); ?></h3>
    </div>

    <center>
        <div class="media" id="mutualTVDiv" style="display:none;">
            <div>
                <!-- <h2>TV</h2> -->
            </div>

            <!-- CIRCULAR ANIMATION -->
            <div class="flex-wrapper">
                <!--DISPLAY WATCHED X/Y COUNT WHERE X = YOUR MEDIA AND Y=THEIR MEDIA-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart black">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="100, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <text x="18" y="20.35" class="mutual-items-count">
                            <?php echo $tvcount_mutual ?>/<?php echo $tvcount_other ?>
                        </text>

                    </svg>
                </div>

                <!--DISPLAY PERCENTAGE-->
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart <?php echo determineColor($mutual_tv_percentage) ?>">
                        <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="<?php echo $mutual_tv_percentage ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <text x="18" y="20.35" class="percentage">
                            <?php echo $mutual_tv_percentage ?>%
                        </text>
                    </svg>
                </div>
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
    </center>


    <!----------------------------------------------------------------------
                       JAVASCRIPT PART
------------------------------------------------------------------------>
    <script>
        const gameBtn = document.getElementById('mutualGameBtn');
        const gameDiv = document.getElementById('mutualGameDiv');

        const musicBtn = document.getElementById('mutualMusicBtn');
        const musicDiv = document.getElementById('mutualMusicDiv');

        const bookBtn = document.getElementById('mutualBookBtn');
        const bookDiv = document.getElementById('mutualBookDiv');

        const movieBtn = document.getElementById('mutualMovieBtn');
        const movieDiv = document.getElementById('mutualMovieDiv');

        const tvBtn = document.getElementById('mutualTVBtn');
        const tvDiv = document.getElementById('mutualTVDiv');

        //TOGGLE VISIBILITY FOR VIDEOGAME BUTTON
        gameBtn.onclick = function() {
            if (gameDiv.style.display !== "none") {
                gameDiv.style.display = "none";
            } else {
                //set other divs to none
                musicDiv.style.display = "none";
                bookDiv.style.display = "none";
                movieDiv.style.display = "none";
                tvDiv.style.display = "none";

                //set game div to block
                gameDiv.style.display = "block";
            }
        };


        //TOGGLE VISIBILITY FOR MUSIC BUTTON
        musicBtn.onclick = function() {
            if (musicDiv.style.display !== "none") {
                musicDiv.style.display = "none";
            } else {
                //set other divs to none
                gameDiv.style.display = "none";
                bookDiv.style.display = "none";
                movieDiv.style.display = "none";
                tvDiv.style.display = "none";

                //set music div to block
                musicDiv.style.display = "block";
            }
        };


        //TOGGLE VISIBILITY FOR Books BUTTON
        bookBtn.onclick = function() {
            if (bookDiv.style.display !== "none") {
                bookDiv.style.display = "none";
            } else {
                //set other divs to none
                gameDiv.style.display = "none";
                musicDiv.style.display = "none";
                movieDiv.style.display = "none";
                tvDiv.style.display = "none";

                //set book div to block
                bookDiv.style.display = "block";
            }
        };


        //TOGGLE VISIBILITY FOR Movie BUTTON
        movieBtn.onclick = function() {
            if (movieDiv.style.display !== "none") {
                movieDiv.style.display = "none";
            } else {
                //set other divs to none
                gameDiv.style.display = "none";
                musicDiv.style.display = "none";
                bookDiv.style.display = "none";
                tvDiv.style.display = "none";

                //set movie div to block
                movieDiv.style.display = "block";
            }
        };


        //TOGGLE VISIBILITY FOR TV BUTTON
        tvBtn.onclick = function() {
            if (tvDiv.style.display !== "none") {
                tvDiv.style.display = "none";
            } else {
                //set other divs to none
                gameDiv.style.display = "none";
                musicDiv.style.display = "none";
                bookDiv.style.display = "none";
                movieDiv.style.display = "none";

                //set tv div to block
                tvDiv.style.display = "block";
            }
        };
    </script>
</body>

</html>