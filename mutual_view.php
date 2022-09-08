<style>
    .danger {
        background-color: #f7a7a3;
        border-left: 5px solid #8f130c;
        width: 50%;
        margin: 20px auto;
        padding: 30px;
        position: relative;
        border-radius: 5px;
        box-shadow: 0 0 15px 5px #ccc;
    }
</style>

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
    $otheruser = mysqli_real_escape_string($con, $_GET['user_name']);
    $me = $user_data['user_name'];


    // if otheruser name is passed as the logged in username show error
    if ($otheruser == $me) {
        echo "<div class='danger'><h3>You cannot view your own mutual media</h3></div>";
        die();
    }


    // to check whether the other username exists or not
    $query = "select * from `users` where `user_name`='$otheruser'";
    $result = mysqli_query($con, $query);
    $rowcount = mysqli_num_rows($result);
    //echo error if does not exist
    if ($rowcount != 1) {
        echo ("<div class='danger'><h3>No Such User Exists</h3></div>");
        die();
    }
}


//echo error if NO username is passed
else {
    echo ("<div class='danger'><h3>You must mention a username</h3></div>");
    die();
}

//to show in the animated progress/color wheel
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

//to get the number of rows returned by any query
function SQLGetCount($con, $sql)
{
    if ($query = mysqli_query($con, $sql)) {
        return mysqli_num_rows($query);
    } else {
        return 0;
    }
}


//count of media items for the logged in user
$videogamecount_me = SQLGetCount($con, "SELECT DISTINCT videogame FROM data WHERE username='$me' AND videogame != ''");
$moviecount_me = SQLGetCount($con, "SELECT DISTINCT movie FROM data WHERE username='$me' AND movie != ''");
$musiccount_me = SQLGetCount($con, "SELECT DISTINCT album FROM data WHERE username='$me' AND album != ''");
$bookcount_me = SQLGetCount($con, "SELECT DISTINCT book FROM data WHERE username='$me' AND book != ''");
$tvcount_me = SQLGetCount($con, "SELECT DISTINCT tv FROM data WHERE username='$me' AND tv != ''");


//count of media items for the other user
$videogamecount_other = SQLGetCount($con, "SELECT DISTINCT videogame FROM data WHERE username='$otheruser' AND videogame!=''");;
$moviecount_other = SQLGetCount($con, "SELECT DISTINCT movie FROM data WHERE username='$otheruser' AND movie!=''");;
$musiccount_other = SQLGetCount($con, "SELECT DISTINCT album FROM data WHERE username='$otheruser' AND album!=''");
$bookcount_other = SQLGetCount($con, "SELECT DISTINCT book FROM data WHERE username='$otheruser' AND book!=''");;
$tvcount_other = SQLGetCount($con, "SELECT DISTINCT tv FROM data WHERE username='$otheruser' AND tv!=''");;


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


//calculate mutal media percentage
$mutual_game_percentage = round(($videogamecount_mutual / $videogamecount_other) * 100);
$mutual_movie_percentage = round(($moviecount_mutual / $moviecount_other) * 100);
$mutual_music_percentage = round(($musiccount_mutual / $musiccount_other) * 100);
$mutual_book_percentage = round(($bookcount_mutual / $bookcount_other) * 100);
$mutual_tv_percentage = round(($tvcount_mutual / $tvcount_other) * 100);
$total_mutual_media_count = get_mutual_media_count($me, $otheruser)[5];
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

    <link href="css/mutual_view.css" rel="stylesheet">
    <link href="css/backToTop.css" rel="stylesheet">
</head>




<body><button onclick="topFunction()" id="BackToTopBtn" title="Go to top">&#8657;</button>
    <div class="heading">
        <h1>Mutual View<span>Media items you<?php echo (" & " . $otheruser) ?> have in common</span></h1>
    </div>

    <!------------------------------------------
            SHOWING BUTTONS
    --------------------------------------------->

    <div class="media-item-div" id="mutualGenericBtn">
        <h2 class="mutual-media-title"><?php echo ($total_mutual_media_count); ?>

            <?php if ($total_mutual_media_count > 1) echo "Mutual Medias";
            else echo "Mutual Media"; ?>
        </h2><br>
        <p style="font-size:150px;">
            <a class="emoji-link" href="#mutualGameBtn">&#127918</a>
            <a class="emoji-link" href="#mutualMusicBtn">&#127911</a>
            <a class="emoji-link" href="#mutualBookBtn">&#128213</a>
            <a class="emoji-link" href="#mutualMovieBtn">&#128191</a>
            <a class="emoji-link" href="#mutualTVBtn">&#128250</a>
        </p>
        <h3 class="mutual-media-subtitle"></h3>
    </div>


    <!------------------------------------------
        VIDEO GAMES SECTION
        --------------------------------------------->
    <div class="media-item-div" id="mutualGameBtn">


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

            <div class="single-chart">
                <h2 class="mutual-media-title">GAMES</h2>
                <p class="emoji">&#127918 </p>
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
    </div>


    <center>
        <div class="media" id="mutualGameDiv" style="display:none;">
            <!-- <video src="<?php echo randomVideo(); ?>" autoplay loop playsinline muted></video> -->

            <!--TO SHOW THE MEDIA ITEMS-->
            <div class="mediaGrid">
                <?php
                $sql = "SELECT videogame FROM data WHERE username='$me'  AND videogame != ''
                INTERSECT
                SELECT videogame FROM data WHERE username='$otheruser'  AND videogame != ''";
                if ($query = mysqli_query($con, $sql)) {
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $videogame = $row['videogame'];
                ?>
                            <div class="mediaContent">
                                <?php echo ucwords(strtolower($videogame)); ?>
                            </div>
                        <?php }
                    } else {
                        ?>

                        <div class="zero-media"><img src='images/Icons/Videogame.svg' width='15' height='15' class='media-icon'>&nbsp;&nbsp; No common videogames between <b>you</b> and <b><?php echo $otheruser; ?></b></div>
                <?php }
                }
                ?>
            </div>

        </div>
    </center>


    <!------------------------------------------
            ALBUMS SECTION
    --------------------------------------------->

    <div class="media-item-div" id="mutualMusicBtn">

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

            <div class="single-chart">
                <h2 class="mutual-media-title">ALBUMS</h2>
                <p class="emoji">&#127911</p>
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
    </div>


    <center>
        <div class="media" id="mutualMusicDiv" style="display:none;">
            <!-- <video src="<?php echo randomVideo(); ?>" autoplay loop playsinline muted></video> -->
            <!--TO SHOW THE MEDIA ITEMS-->
            <div class="mediaGrid">
                <?php
                $sql = "SELECT album, artist FROM data WHERE username='$me' AND album!='' AND artist!=''
                INTERSECT
                SELECT album, artist FROM data WHERE username='$otheruser' AND album!='' AND artist!=''";
                if ($query = mysqli_query($con, $sql)) {
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $album = $row['album'];

                ?>
                            <div class="mediaContent">
                                <?php echo ucwords(strtolower($album)); ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>

                        <div class="zero-media"><img src='images/Icons/Music.svg' width='15' height='15' class='media-icon'>&nbsp;&nbsp; No common music between <b>you</b> and <b><?php echo $otheruser; ?></b></div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </center>

    <!------------------------------------------
                BOOKS SECTION
    --------------------------------------------->

    <div class="media-item-div" id="mutualBookBtn">

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

            <div class="single-chart">
                <h2 class="mutual-media-title">BOOKS</h2>
                <p class="emoji">&#128213</p>
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
    </div>

    <center>
        <div class="media" id="mutualBookDiv" style="display:none;">

            <!-- <video src="<?php echo randomVideo(); ?>" autoplay loop playsinline muted></video> -->
            <!--TO SHOW THE MEDIA ITEMS-->
            <div class="mediaGrid">

                <?php
                $sql = "SELECT book, author FROM data WHERE username='$me'  AND book!='' AND author!=''
                INTERSECT
                SELECT book, author FROM data WHERE username='$otheruser'  AND book!='' AND author!=''";
                if ($query = mysqli_query($con, $sql)) {
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $book = $row['book']; ?>

                            <div class="mediaContent">
                                <?php echo ucwords(strtolower($book)); ?>
                            </div>

                        <?php
                        }
                    } else {
                        ?>

                        <div class="zero-media"><img src='images/Icons/Book.svg' width='15' height='15' class='media-icon'>&nbsp;&nbsp; No common books between <b>you</b> and <b><?php echo $otheruser; ?></b></div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </center>



    <!------------------------------------------
            MOVIES SECTION
    --------------------------------------------->

    <div class="media-item-div" id="mutualMovieBtn">

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

            <div class="single-chart">
                <h2 class="mutual-media-title">MOVIES</h2>
                <p class="emoji">&#128191</p>
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
    </div>

    <center>

        <div class="media" id="mutualMovieDiv" style="display:none;">

            <!-- <video src="<?php echo randomVideo(); ?>" autoplay loop playsinline muted></video> -->
            <!--TO SHOW THE MEDIA ITEMS-->
            <div class="mediaGrid">

                <?php
                $sql = "SELECT movie, year FROM data WHERE username='$me' AND movie!='' AND year!=''
                INTERSECT
                SELECT movie, year FROM data WHERE username='$otheruser' AND movie!='' AND year!=''";
                if ($query = mysqli_query($con, $sql)) {
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $movie = $row['movie'];

                ?>
                            <div class="mediaContent">
                                <?php echo ucwords(strtolower($movie)); ?>
                            </div>

                        <?php
                        }
                    } else {
                        ?>

                        <div class="zero-media"><img src='images/Icons/Movie.svg' width='15' height='15' class='media-icon'>&nbsp;&nbsp; No common movies between <b>you</b> and <b><?php echo $otheruser; ?></b></div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </center>

    <!------------------------------------------
                TV SERIES SECTION
    --------------------------------------------->

    <div class="media-item-div" id="mutualTVBtn">

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

            <div class="single-chart">
                <h2 class="mutual-media-title">TV</h2>
                <p class="emoji">&#128250 </p>
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
    </div>

    <center>
        <div class="media" id="mutualTVDiv" style="display:none;">



            <!-- <video src="<?php echo randomVideo(); ?>" autoplay loop playsinline muted></video> -->
            <!--TO SHOW THE MEDIA ITEMS-->
            <div class="mediaGrid">

                <?php
                $sql = "SELECT tv FROM data WHERE username='$me' AND tv != ''
                INTERSECT
                SELECT tv FROM data WHERE username='$otheruser' AND tv != ''";
                if ($query = mysqli_query($con, $sql)) {
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $tv = $row['tv'];

                ?>
                            <div class="mediaContent">
                                <?php echo ucwords(strtolower($tv)); ?>
                            </div>
                        <?php
                        }
                    } else {
                        ?>

                        <div class="zero-media"><img src='images/Icons/TV.svg' width='15' height='15' class='media-icon'>&nbsp;&nbsp; No common TV Shows between <b>you</b> and <b><?php echo $otheruser; ?></b></div>
                <?php
                    }
                }
                mysqli_close($con);
                ?>
            </div>
        </div>
    </center>


    <!----------------------------------------------------------------------
                       JAVASCRIPT PART
------------------------------------------------------------------------>
    <script>
        // const gameBtn = document.getElementById('mutualGameBtn');
        // const gameDiv = document.getElementById('mutualGameDiv');

        // const musicBtn = document.getElementById('mutualMusicBtn');
        // const musicDiv = document.getElementById('mutualMusicDiv');

        // const bookBtn = document.getElementById('mutualBookBtn');
        // const bookDiv = document.getElementById('mutualBookDiv');

        // const movieBtn = document.getElementById('mutualMovieBtn');
        // const movieDiv = document.getElementById('mutualMovieDiv');

        // const tvBtn = document.getElementById('mutualTVBtn');
        // const tvDiv = document.getElementById('mutualTVDiv');

        $(document).ready(function() {

            //sliding animation toggle
            $("#mutualGameBtn").click(function() {
                $("#mutualGameDiv").slideToggle("slow");
            });

            $("#mutualMusicBtn").click(function() {
                $("#mutualMusicDiv").slideToggle("slow");
            });

            $("#mutualBookBtn").click(function() {
                $("#mutualBookDiv").slideToggle("slow");
            });

            $("#mutualMovieBtn").click(function() {
                $("#mutualMovieDiv").slideToggle("slow");
            });

            $("#mutualTVBtn").click(function() {
                $("#mutualTVDiv").slideToggle("slow");
            });

        });
    </script>
    <script src="js/backToTop.js"></script>
</body>

</html>