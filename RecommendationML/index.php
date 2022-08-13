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

function MovieRecommendations($username){
    $MovieResult=exec("python Movie/MovieRecommendation.py ".$username);
    return json_decode($MovieResult,true);
}

function BookRecommendations($username){
    $BookResult=exec("python Books/BookRecommendation.py ".$username);
    return json_decode($BookResult,true);
}

function TVRecommendations($username){
    $TVResult=exec("python TV/TVRecommendation.py ".$username);
    return json_decode($TVResult,true);
}


function AlbumRecommendations($username){
    $AlbumResult=exec("python Albums/AlbumRecommendation.py ".$username);
    return json_decode($AlbumResult,true);
}

function GameRecommendations($username){
    $GameResult=exec("python VideoGame/VideogameRecommendation.py ".$username);
    return json_decode($GameResult,true);
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
<body>
    <div class="heading">
        <h1>Recommendations</h1>
    </div>

    <div id="pp_gallery" class="pp_gallery">

        <div id="pp_loading" class="pp_loading"></div>
        <div id="pp_next" class="pp_next"></div>
        <div id="pp_prev" class="pp_prev"></div>
        <div id="pp_thumbContainer">


            <!-------------------------------------
                         BOOKS
            -------------------------------------->
            <div class="album">
                
            <!--Priting out the image, name and summary for the user.-->
                <div class="content">
                    <img src="images/album1/thumbs/1.jpg" alt="images/album1/1.jpg" />
                    <span>The Sixties by Tetsumo</span>
                </div>
                <div class="content">
                    <img src="images/album1/thumbs/2.jpg" alt="images/album1/2.jpg" />
                    <span>The Sixties by Tetsumo</span>
                </div>
                
                
                <div class="descr">
                    Books
                </div>
            </div>

            <!-------------------------------------
                         MOVIES
            -------------------------------------->
            <div class="album">

            <!--Priting out the image, name and summary for the user.-->
                <div class="content">
                    <img src="images/album2/thumbs/1.jpg" alt="images/album2/1.jpg" />
                    <span>Butterfly Girl</span>
                </div>
                <div class="content">
                    <img src="images/album2/thumbs/2.jpg" alt="images/album2/2.jpg" />
                    <span>Mmmmmmh Strawberries</span>
                </div>


                <div class="descr">
                    Movies
                </div>
            </div>

            <!-------------------------------------
                        TV
            -------------------------------------->
            <div class="album">
                
            <!--Priting out the image, name and summary for the user.-->
                <div class="content">
                    <img src="images/album2/thumbs/1.jpg" alt="images/album2/1.jpg" />
                    <span>Butterfly Girl</span>
                </div>
                <div class="content">
                    <img src="images/album2/thumbs/2.jpg" alt="images/album2/2.jpg" />
                    <span>Mmmmmmh Strawberries</span>
                </div>
                
                
                <div class="descr">
                    TV
                </div>
            </div>


            <!-------------------------------------
                        ALBUMS
            -------------------------------------->
            <div class="album">
                
                <!--Priting out the image, name and summary for the user.-->
                <div class="content">
                    <img src="images/album2/thumbs/1.jpg" alt="images/album2/1.jpg" />
                    <span>Butterfly Girl</span>
                </div>
                <div class="content">
                    <img src="images/album2/thumbs/2.jpg" alt="images/album2/2.jpg" />
                    <span>Mmmmmmh Strawberries</span>
                </div>
                
                
                <div class="descr">
                    Albums
                </div>
            </div>

            <!-------------------------------------
                        VIDEOGAMES
            -------------------------------------->
            <div class="album">
                
                <!--Priting out the image, name and summary for the user.-->
                <div class="content">
                    <img src="images/album2/thumbs/1.jpg" alt="images/album2/1.jpg" />
                    <span>Butterfly Girl</span>
                </div>
                <div class="content">
                    <img src="images/album2/thumbs/2.jpg" alt="images/album2/2.jpg" />
                    <span>Mmmmmmh Strawberries</span>
                </div>


                <div class="descr">
                    Videogames
                </div>
            </div>

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