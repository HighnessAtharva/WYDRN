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

    <link rel="stylesheet" href="CSS/welcome.css">

    <link rel="stylesheet" href="SearchBoxAPIs/Videogame/main.css">
    <link rel="stylesheet" href="SearchBoxAPIs/TV/main.css">
    <link rel="stylesheet" href="SearchBoxAPIs/Movie/main.css">
    <link rel="stylesheet" href="SearchBoxAPIs/Book/main.css">
    <link rel="stylesheet" href="SearchBoxAPIs/Music/main.css">

    <!-- Sweet Alert (Beautiful looking alert plugin-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>


<body>

<!--START OF MAIN  BODY-->
<!-- LEFT COLUMN-->
<div class="column">
    <form class="ms-5" method="POST" action="profile.php" name="userinput" onsubmit ="return Validation();">
        <div style="margin-right: 100px;">

            <!------------------------------------------------------
                                Music
            ------------------------------------------------------>
            <h3 class="mb-3">Music</h3>
            <div class="mb-3 ms-3" name="album">

                Album
                <input type="text" class="form-control" name="Album" autofocus="true" placeholder="Cavalcade" id="music-search-box" onkeyup="findAlbum()" onclick="findAlbum()"><br>

                Artist
                <input type="text" class="form-control" name="Artist" placeholder="Black Midi" id="music-artist" readonly><br>

                <div class="search-list-music" id="search-list-music">
                    <!--ALBUM SUGGESTIONS WILL APPEAR HERE-->
                </div>
            </div>

            <!------------------------------------------------------
                                 Books
            ------------------------------------------------------>
            <h3 class="mb-3">Books</h3>
            <div class="mb-3 ms-3" name="book">

                Book
                <input type="text" name="Book" class="form-control" placeholder="Royal Assassin" id="book-search-box" onkeyup="findBook()" onclick="findBook()"><br>

                Author
                <input type="text" class="form-control" name="Author" placeholder="Robin Hobb"  id="book-author" readonly><br>

                <div class="search-list-books" id="search-list-book">
                    <!--BOOK SUGGESTIONS WILL APPEAR HERE-->
                </div>
            </div>

            <!------------------------------------------------------
                                  Movies
            ------------------------------------------------------>
            <h3 class="mb-3">Movies</h3>
            <div class="mb-3 ms-3" name="movie">

                Movie
                <input type="text" class="form-control" name="Movie" placeholder="The Batman" id="movie-search-box" onkeyup="findMovies()" onclick="findMovies()"><br>

                Release Year
                <input type="text" class="form-control" name="MovieRelease" placeholder="2022" id="movie-year" readonly><br>

                <div class="search-list-movies" id="search-list-movies">
                     <!--MOVIE SUGGESTIONS WILL APPEAR HERE-->
                </div>

            </div>

            <!------------------------------------------------------
                                TV
            ------------------------------------------------------>
            <h3 class="mb-3">TV/Streaming</h3>
            <div class="mb-3 ms-3" name="TV">

                TV Show
                <input type="text" class="form-control" name="TV" placeholder="Peaky Blinders" id="tv-search-box" onkeyup="findTV()" onclick="findTV()"><br>

                Network
                <select class="form-control" name="StreamPlatform"><br>
                        <option value="" selected disabled hidden>Choose</option>
                        <option value="Netflix">Netflix</option>
                        <option value="Hulu">Hulu</option>
                        <option value="Amazon Prime">Amazon Prime</option>
                        <option value="HBO Max">HBO Max</option>
                        <option value="Disney+">Disney+</option>
                        <option value="Tencent Video">Tencent Video</option>
                        <option value="YouTube">YouTube Premium</option>
                        <option value="Peacock">Peacock</option>
                        <option value="Paramount+">Paramount+</option>
                        <option value="Discovery+">Discovery+</option>
                </select>

                <div class="search-list-tv" id="search-list-tv">
                     <!--MOVIE SUGGESTIONS WILL APPEAR HERE-->
                </div>


            </div>


            <!-------------------------------------------------
                         Video Games
            --------------------------------------------------->
            <h3 class="mb-3">Video Game</h3>
            <div class="mb-3 ms-3" name="videogame">

                Video Game
                <input class="form-control" type="text" name="Videogame" placeholder="Elden Ring" id="game-search-box" onkeyup="findgame()" onclick="findgame()"><br>

                Platform
                <select class="form-control" name="Platform">
                    <option value="" selected disabled hidden>Choose</option>
                    <option value="PC">PC</option>
                    <option value="Xbox">Xbox</option>
                    <option value="Playstation">Playstation</option>
                    <option value="Nintendo">Nintendo Switch</option>
                    <option value="Wii">Wii</option>
                </select>

                <div class="search-list-games" id="search-list-games">
                    <!--VIDEOGAME SUGGESTIONS WILL APPEAR HERE-->
                </div>
            </div>

        </div> <!---END OF 5 MEDIA CONTAINER DIV--->
        <form> <!---END OF FORM --->

          <!--The div below puts the submit button below the first column at center-->

        <div class="text-center mb-lg-3">
            <button type="submit" class="btn btn-outline-primary btn-light btn-lg" name="submit" value="btn1" style="margin-left:-100px">Submit</button>
        </div>


        </div>
        <!--END OF LEFT COLUMN-->

        <!--RIGHT COLUMN-->
        <div class="column" >
            <div style="background:black; color:white;margin-right:30px; padding:20px;">
                <ul>
                    <li>WYDRN is a website that allows you to instataneously add your current video games, music, books, movies, and TV  to your profile.  </li>
                    <li>You can then view your profile and see what you have added. </li>
                    <li> You can also search for other users and see their profiles.  </li>
                </ul>
            </div>
        </div>
        <!--END OF RIGHT COLUMN-->

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
function Validation(){
    let musicInput= document.getElementById("music-search-box").value;
    let bookInput= document.getElementById("book-search-box").value;
    let movieInput= document.getElementById("movie-search-box").value;
    let tvInput= document.getElementById("tv-search-box").value;
    let gameInput= document.getElementById("game-search-box").value;

    //If all of the inputs are empty, then the user will be alerted that they must fill in all the fields.
    if ((musicInput) || (bookInput) || (movieInput) || (tvInput) || (gameInput)){
        return true;   
    }
    else{
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

<?php mysqli_close($con);?>
</body>
</html>