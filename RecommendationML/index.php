<?php

//Everything will work fine. Just put the respective CSV files in the same folder as the python file.

session_start();
if (empty($_SESSION)) {
    header("Location: ../login.php");
}

include("../connection.php");
include("../functions.php");
include("header.php");
$user_data = check_login($con);
$username = $user_data['user_name'];


function MovieRecommendations($username)
{
    $MovieResult = exec("python MovieRecommendation.py " . $username);
    $result = json_decode($MovieResult, true);
    return $result;
}


function getMoviePosterPath($name)
{
    $api_key = "e446bc89015229cf337e16b0849d506c";
    $url = 'https://api.themoviedb.org/3/search/movie?api_key=' . $api_key . '&query=' . $name . '&include_adult=false';
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['results'][0]['poster_path'])) {
        $response = "../images/API/WYDRNmovie.png";
    } else {
        $response = "https://image.tmdb.org/t/p/w300" . $response['results'][0]['poster_path'];
    }
    return $response;
}


function BookRecommendations($username)
{
    $BookResult = exec("python BookRecommendation.py " . $username);
    return json_decode($BookResult, true);
}

function getBookPosterPath($name)
{
    $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $name . '&orderBy=relevance';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['items'][0]['volumeInfo']['imageLinks']['thumbnail'])) {
        $response = "../images/API/WYDRNbook.png";
    } else {
        $response = $response['items'][0]['volumeInfo']['imageLinks']['thumbnail'];
    }
    // print_r ($response['items'][0]['volumeInfo']['imageLinks']['thumbnail']);
    return $response;
}

function TVRecommendations($username)
{
    $TVResult = exec("python TVRecommendation.py " . $username);
    return json_decode($TVResult, true);
}

function getTvPosterPath($name)
{
    $api_key = "e446bc89015229cf337e16b0849d506c";
    $url = 'https://api.themoviedb.org/3/search/tv?api_key=' . $api_key . '&query=' . $name . '&include_adult=false';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['results'][0]['poster_path'])) {
        $response = "../images/API/WYDRNtv.png";
    } else {
        $response = "https://image.tmdb.org/t/p/w300" . $response['results'][0]['poster_path'];
    }
    return $response;
}

function AlbumRecommendations($username)
{
    $AlbumResult = exec("python AlbumRecommendation.py " . $username);
    return json_decode($AlbumResult, true);
}

function getAlbumPosterPath($name)
{
    $api_key = "6a4eb1d0536cfe3583784a65332ee179";
    $url = 'https://ws.audioscrobbler.com/2.0/?method=album.search&api_key=' . $api_key . '&album=' . $name . '&format=json';
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['results']['albummatches']['album'][0]['image'][3]['#text'])) {
        $response = "../images/API/WYDRNmusic.png";
    } else {
        $response = $response['results']['albummatches']['album'][0]['image'][3]['#text'];
    }
    return $response;
}

function GameRecommendations($username)
{
    $GameResult = exec("python VideogameRecommendation.py " . $username);
    return json_decode($GameResult, true);
}

function getGamePosterPath($name)
{
    $api_key = "fe197746ce494b4791441d9a9161c1be";
    $url = 'https://api.rawg.io/api/games?search=' . $name . '&key=' . $api_key;
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['results'][0]['background_image'])) {
        $response = "../images/API/WYDRNgame.png";
    } else {
        $response = $response['results'][0]['background_image'];
    }
    return $response;
}

//do not echo, just invoke the function. Designing and layout to be done inside the function itself. 

?>


<html>

<head>
    <title>WYDRN - Recommendations</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
    <!-------------------------------------
         INCLUDING CSS STYLESHEET
    -------------------------------------->
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="../images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="../images/website/favicons/apple-touch-icon.png">

    <!-------------------------------------
         INCLUDING JQUERY AND OTHER JS FRAMEWORKS
    -------------------------------------->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="js/cufon-yui.js" type="text/javascript"></script>

    <script type="text/javascript">
        Cufon.replace('span');
        Cufon.replace('h1', {
            textShadow: '0px 1px #ddd'
        });
    </script>
</head>


<!-------------------------------------
             BODY START
-------------------------------------->

<body style="background-image:linear-gradient(to left, rgba(10, 10, 10, 0.5), rgb(21, 21, 21)), url(../<?php echo randomImage(); ?>)">

<?php
$mediaType='';            
if (isset($_GET['movie'])) {
$mediaType='movie';
} else if (isset($_GET['tv'])) {
$mediaType='tv';
} else if (isset($_GET['album'])) {
$mediaType='album';
} else if (isset($_GET['videogame'])) {
$mediaType='game';
}else if (isset($_GET['book'])) {
$mediaType='book';
}
?>

<div class="heading">
        <h1><?php echo strtoupper($mediaType);?> Recommendations<span>Curated Media Items Just For You!</span></h1>
    </div>
 


    <div id="pp_gallery" class="pp_gallery">

        <div id="pp_loading" class="pp_loading"></div>
        <div id="pp_next" class="pp_next"></div>
        <div id="pp_prev" class="pp_prev"></div>
        <div id="pp_thumbContainer">


            <!-------------------------------------
                            MOVIES
            -------------------------------------->

            <?php
            if (isset($_GET['movie'])) {
            ?>
                <div class="album">
                    <?php
                    $movieList = MovieRecommendations($username);
                    foreach ($movieList as $movie => $rank) {
                        $stripmovie = str_replace(' ', '+', $movie);
                        $moviePoster = getMoviePosterPath($stripmovie);
                    ?>
                        <!--Priting out the image, name and summary for the user.-->
                        <div class="content">
                            <!--important: CODE WILL BREAK IF ALT TAG IS NOT PROVIDED WITH IMAGE-->
                            <img src="<?php echo $moviePoster ?>" alt="<?php echo $moviePoster ?>" />
                            <span><?php echo $movie ?></span>
                        </div>

                    <?php
                    }
                    ?>
                    <div class="name">
                        Movies
                    </div>
                </div>

            <?php
            }
            ?>

            <!-------------------------------------
                         BOOKS
            -------------------------------------->
            <?php
            if (isset($_GET['book'])) {
            ?>

                <div class="album">
                    <?php
                    $bookList = BookRecommendations($username);
                    foreach ($bookList as $book => $rank) {
                        $stripbook = str_replace(' ', '+', $book);
                        $bookPoster = getBookPosterPath($stripbook);
                    ?>
                        <!--Priting out the image, name and summary for the user.-->
                        <div class="content">
                            <img src="<?php echo $bookPoster ?>" alt="<?php echo $bookPoster ?>" />
                            <span><?php echo $book ?></span>
                        </div>


                    <?php
                    }
                    ?>
                    <div class="name">
                        Books
                    </div>
                </div>

            <?php
            }
            ?>


            <!-------------------------------------
                        TV
            -------------------------------------->

            <?php
            if (isset($_GET['tv'])) {
            ?>

                <div class="album">
                    <?php
                    $tvList = TVRecommendations($username);
                    foreach ($tvList as $tv => $rank) {
                        $striptv = str_replace(' ', '+', $tv);
                        $tvPoster = getTvPosterPath($striptv);
                    ?>
                        <!--Priting out the image, name and summary for the user.-->
                        <div class="content">
                            <img src="<?php echo $tvPoster ?>" alt="<?php echo $tvPoster ?>" />
                            <span><?php echo $tv ?></span>
                        </div>

                    <?php
                    }
                    ?>
                    <div class="name">
                        TV
                    </div>
                </div>


            <?php
            }
            ?>


            <!-------------------------------------
                        ALBUMS
            -------------------------------------->

            <?php
            if (isset($_GET['album'])) {
            ?>

                <div class="album">
                    <?php
                    $albumList = AlbumRecommendations($username);
                    foreach ($albumList as $album => $rank) {
                        $stripalbum = str_replace(' ', '+', $album);
                        $albumPoster = getAlbumPosterPath($stripalbum);
                    ?>
                        <!--Priting out the image, name and summary for the user.-->
                        <div class="content">
                            <img src="<?php echo $albumPoster ?>" alt="<?php echo $albumPoster ?>" />
                            <span><?php echo $album; ?></span>
                        </div>

                    <?php
                    }
                    ?>
                    <div class="name">
                        Albums
                    </div>
                </div>

            <?php
            }
            ?>

            <!-------------------------------------
                        VIDEOGAMES
            -------------------------------------->

            <?php
            if (isset($_GET['videogame'])) {
            ?>

                <div class="album">
                    <?php
                    $gameList = GameRecommendations($username);
                    foreach ($gameList as $game => $rank) {
                        $stripgame = str_replace(' ', '+', $game);
                        $gamePoster = getGamePosterPath($stripgame);
                    ?>

                        <!--Priting out the image, name and summary for the user.-->
                        <div class="content">
                            <!--BUG: echoing the $gamePoster in image tag breaks the entire page. -->
                            <img src="<?php echo $gamePoster; ?>" alt="<?php echo  $gamePoster; ?>" id="gameCover" />
                            <span><?php echo $game ?></span>
                        </div>

                    <?php
                    }
                    ?>

                    <div class="name">
                        Videogames
                    </div>
                </div>

            <?php
            }
            ?>


            <div id="pp_back" class="pp_back">Recommendations</div>
        </div>
    </div>


    <!-------------------------------------
         INCLUDING JS AND ENDING BODY
-------------------------------------->

    <!-- The JavaScript -->
    <script src="js/jquery.transform-0.8.0.min.js"></script>
    <script src="js/polaroid.js"></script>
</body>

</html>