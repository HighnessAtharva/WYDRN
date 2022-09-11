<?php

/**
 * PAGE WITH FORM THAT TAKES USER INPUT SUCH AS VIDEO GAMES, BOOKS, MOVIES, TV AND MUSIC AND SHOWS THE TOP MENU BAR WITH THE OPTIONS TO DELETE USER, EDIT PROFILE, SHARE PROFILE URL WITH FRIENDS AND LOGOUT. PAGE IS DIVIDED INTO TWO COLUMNS WHERE THE FORM TAKES THE LEFT HALF AND THE RIGHT HALF CONSISTS OF "WYDRN" DESCRIPTION AND USAGE GUIDELINES
 * @version    PHP 8.0.12
 * @since      June 2022
 * @author     AtharvaShah
 */

session_start();
require "connection.php";
require "functions.php";
require "header.php";
$user_data = check_login($con);
?>

<!------------------------------------------------------------------------------
                                        HTML PART
------------------------------------------------------------------------------>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WYDRN - Add Media</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">
    
    <link rel="stylesheet" href="CSS/welcome.css">

    <link rel="stylesheet" href="SearchBoxAPIs/Videogame/main.css">
    <link rel="stylesheet" href="SearchBoxAPIs/TV/main.css">
    <link rel="stylesheet" href="SearchBoxAPIs/Movie/main.css">
    <link rel="stylesheet" href="SearchBoxAPIs/Book/main.css">
    <link rel="stylesheet" href="SearchBoxAPIs/Music/main.css">
    <link href="css/backToTop.css" rel="stylesheet">

    <!-- Sweet Alert (Beautiful looking alert plugin-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>


<body><button onclick="topFunction()" id="BackToTopBtn" title="Go to top">&#8657;</button>

    <div class="page-wrapper p-t-180 p-b-100 font-poppins">
        <div class="mywrapper mywrapper--w1200">
            <form method="POST" action="profile.php" name="userinput" onsubmit="return Validation();">

                <!------------------------------------------------------
                                Music
            ------------------------------------------------------>
                <div class="card card-3">
                    <div class="card-heading" id="music-pic"></div>
                    <div class="card-body">
                        <h2 class="title">&#127911 Add Albums </h2>

                        <div class="input-group">
                            <input type="text" class="input--style-3" name="Album" autofocus="true" placeholder="Cavalcade" id="music-search-box" onkeyup="findAlbum()" onclick="findAlbum()" autocomplete="off"><br>
                        </div>
                        <div class="input-group">
                            <input type="text" class="input--style-3" name="Artist" placeholder="Black Midi" id="music-artist" readonly autocomplete="off"><br>
                        </div>
                    </div>
                </div>

                <div class="search-list-music" id="search-list-music">
                    <!--ALBUM SUGGESTIONS WILL APPEAR HERE-->
                </div>



                <!------------------------------------------------------
                                 Books
            ------------------------------------------------------>
                <div class="card card-3">
                    <div class="card-heading" id="book-pic"></div>
                    <div class="card-body">
                        <h2 class="title">&#128213 Add Books</h2>

                        <div class="input-group">
                            <input type="text" name="Book" class="input--style-3" placeholder="Royal Assassin" id="book-search-box" onkeyup="findBook()" onclick="findBook()" autocomplete="off"><br>
                        </div>
                        <div class="input-group">
                            <input type="text" class="input--style-3" name="Author" placeholder="Robin Hobb" id="book-author" readonly autocomplete="off"><br>
                        </div>
                    </div>
                </div>
                <div class="search-list-books" id="search-list-book">
                    <!--BOOK SUGGESTIONS WILL APPEAR HERE-->
                </div>


                <!------------------------------------------------------
                                  Movies
            ------------------------------------------------------>
                <div class="card card-3">
                    <div class="card-heading" id="movie-pic"></div>
                    <div class="card-body">
                        <h2 class="title">&#128253 Add Movies</h2>

                        <div class="input-group">
                            <input type="text" class="input--style-3" name="Movie" placeholder="The Batman" id="movie-search-box" onkeyup="findMovies()" onclick="findMovies()" autocomplete="off"><br>
                        </div>
                        <div class="input-group">
                            <input type="text" class="input--style-3" name="MovieRelease" placeholder="2022" id="movie-year" readonly autocomplete="off"><br>
                        </div>
                    </div>
                </div>
                <div class="search-list-movies" id="search-list-movies">
                    <!--MOVIE SUGGESTIONS WILL APPEAR HERE-->
                </div>



                <!------------------------------------------------------
                                TV
            ------------------------------------------------------>
                <div class="card card-3">
                    <div class="card-heading" id="tv-pic"></div>
                    <div class="card-body">
                        <h2 class="title">&#128250 Add TV Shows</h2>

                        <div class="input-group">
                            <input type="text" class="input--style-3" name="TV" placeholder="Peaky Blinders" id="tv-search-box" onkeyup="findTV()" onclick="findTV()" autocomplete="off">
                        </div>


                        <select class="input--style-3" name="StreamPlatform" id="tv-network"><br>
                            <option value="" selected disabled hidden>--Network--</option>
                            <option class="option-text" value="Netflix">Netflix</option>
                            <option class="option-text" value="Hulu">Hulu</option>
                            <option class="option-text" value="Amazon Prime">Amazon Prime</option>
                            <option class="option-text" value="HBO Max">HBO Max</option>
                            <option class="option-text" value="Disney+">Disney+</option>
                            <option class="option-text" value="Tencent Video">Tencent Video</option>
                            <option class="option-text" value="YouTube">YouTube Premium</option>
                            <option class="option-text" value="Peacock">Peacock</option>
                            <option class="option-text" value="Paramount+">Paramount+</option>
                            <option class="option-text" value="Discovery+">Discovery+</option>
                        </select>
                    </div>
                </div>

                <div class="search-list-tv" id="search-list-tv">
                    <!--MOVIE SUGGESTIONS WILL APPEAR HERE-->
                </div>



                <!-------------------------------------------------
                         Video Games
            --------------------------------------------------->
                <div class="card card-3">
                    <div class="card-heading" id="videogame-pic"></div>
                    <div class="card-body">
                        <h2 class="title">&#127918 Add Videogames </h2>

                        <div class="input-group">
                            <input class="input--style-3" type="text" name="Videogame" placeholder="Elden Ring" id="game-search-box" onkeyup="findgame()" onclick="findgame()" autocomplete="off"><br>
                        </div>


                        <select class="input--style-3" name="Platform" id="game-platform">
                            <option value="" selected disabled hidden>--Platform--</option>
                            <option class="option-text" value="PC">PC</option>
                            <option class="option-text" value="Xbox">Xbox</option>
                            <option class="option-text" value="Playstation">Playstation</option>
                            <option class="option-text" value="Nintendo">Nintendo Switch</option>
                            <option class="option-text" value="Wii">Wii</option>
                        </select>
                    </div>
                </div>
                <div class="search-list-games" id="search-list-games">
                    <!--VIDEOGAME SUGGESTIONS WILL APPEAR HERE-->
                </div>



                <!-- Add media button -->
                <div class="text-center mb-lg-3">
                    <button type="submit" class="btn btn-outline-primary btn-light btn-lg" name="submit" value="btn1">Add Media</button>
                </div>
            </form>
        </div>
    </div>



    <!--END OF MAIN BODY-->


    <!------------------------------------------------------------------------
                        JAVASCRIPT PART
-------------------------------------------------------------------------->
    <script src="SearchBoxAPIs/Music/script.js"></script>
    <script src="SearchBoxAPIs/TV/script.js"></script>
    <script src="SearchBoxAPIs/Movie/script.js"></script>
    <script src="SearchBoxAPIs/Book/script.js"></script>
    <script src="SearchBoxAPIs/Videogame/script.js"></script>
    <script>
        function Validation() {
            let musicInput = document.getElementById("music-search-box").value;
            let artistInput= document.getElementById("music-artist").value;

            let bookInput = document.getElementById("book-search-box").value;
            let authorInput = document.getElementById("book-author").value;

            let movieInput = document.getElementById("movie-search-box").value;
            let movieReleaseInput = document.getElementById("movie-year").value;

            let tvInput = document.getElementById("tv-search-box").value;
            let tvNetworkInput = document.getElementById("tv-network").value;
            
            let gameInput = document.getElementById("game-search-box").value;
            let gamePlatformInput = document.getElementById("game-platform").value;

            //If all of the inputs are empty or some media types are filled partially, then the user will be alerted that they must fill in all the fields.
            if ((musicInput && artistInput) || (bookInput && authorInput) || (movieInput && movieReleaseInput) || (tvInput && tvNetworkInput) || (gameInput && gamePlatformInput)) {
             //add an alert here as well saying that profile is updated
                return true;
                
            } else {
                //sweet alert plugin to display error message. IT REPLACES the JS alert() function.
                swal({
                    title: "Log a Media",
                    text: "You must enter at least one media type!",
                    icon: "error",
                    button: "Retry",
                });
                return false;
            }


        }


    </script>
    <script src="js/backToTop.js"></script>
    <?php mysqli_close($con); ?>

</body>

</html>