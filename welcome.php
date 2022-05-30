<?php
/*

DESCRIPTION: PAGE WITH FORM THAT TAKES USER INPUT SUCH AS VIDEO GAMES, BOOKS, MOVIES, TV AND MUSIC AND SHOWS THE TOP MENU BAR WITH THE OPTIONS TO DELETE USER, EDIT PROFILE, SHARE PROFILE URL WITH FRIENDS AND LOGOUT. PAGE IS DIVIDED INTO TWO COLUMNS WHERE THE FORM TAKES THE LEFT HALF AND THE RIGHT HALF CONSISTS OF "WYDRN" DESCRIPTION AND USAGE GUIDELINES

 */
session_start();

include "connection.php";
include "functions.php";

$user_data = check_login($con);

?>


<!--
    HTML PART
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WYDRN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(90deg, #00C9FF 0%, #92FE9D 100%);
        }

        h3 {
            color: black;
        }

        .column {
            float: left;
            width: 50%;
            padding: 10px;
            margin-top:100px;
            }
    </style>
    <link rel="stylesheet" href="SearchBoxAPIs/Movie/main.css">
</head>


<body>
<?php include "header.php"; ?>


<!--START OF MAIN  BODY-->
<!-- LEFT COLUMN-->
<div class="column">
    <form class="ms-5" method="POST" action="profile.php" name="userinput">
        <div style="margin-right: 100px;">

            <!--Music-->
            <h3 class="mb-3">Music</h3>
            <div class="mb-3 ms-3" name="album">
                
                What Album you spinnin'?
                <input type="text" class="form-control" name="Album" placeholder="Cavalcade" id="music-search-box" onkeyup="findAlbum()" onclick="findAlbum()"><br>
                
                Who's the Artist?
                <input type="text" class="form-control" name="Artist" placeholder="Black Midi" id="music-artist"><br>
                
                <div class="search-list" id="search-list-music">
                    <!--ALBUM SUGGESTIONS WILL APPEAR HERE-->
                </div>
            </div>

            <!--Books-->
            <h3 class="mb-3">Books</h3>
            <div class="mb-3 ms-3" name="book">
                
            What is an intellectual like yourself Reading?
                <input type="text" name="Book" class="form-control" placeholder="Royal Assassin" id="book-search-box" onkeyup="findBook()" onclick="findBook()"><br>
                
                Drop the name of the Author bro
                <input type="text" class="form-control" name="Author" placeholder="Robin Hobb"  id="book-author"><br>
                
                <div class="search-list" id="search-list-book">
                    <!--BOOK SUGGESTIONS WILL APPEAR HERE-->
                </div>
            </div>

            <!--Movies-->
            <h3 class="mb-3">Movies</h3>
            <div class="mb-3 ms-3" name="movie">
                What movie we watchin' today matey? 
                <input type="text" class="form-control" name="Movie" placeholder="The Batman" id="movie-search-box" onkeyup="findMovies()" onclick="findMovies()"><br>
                
                Release Year
                <input type="text" class="form-control" name="MovieRelease" placeholder="2022" id="movie-year"><br>
                
                <div class="search-list" id="search-list-movies">
                     <!--MOVIE SUGGESTIONS WILL APPEAR HERE-->
                </div>

            </div>

            <!--TV-->
            <h3 class="mb-3">TV/Streaming</h3>
            <div class="mb-3 ms-3" name="TV">
                What TV series you watching RN hon? <input type="text" class="form-control" name="TV" placeholder="Peaky Blinders" id="tv-search-box" onkeyup="findTV()" onclick="findTV()"><br> 
                
                Where is it streaming/broadcasting? 
                <input type="text" class="form-control" name="StreamPlatform" placeholder="BBC"><br>

                <div class="search-list" id="search-list-tv">
                     <!--MOVIE SUGGESTIONS WILL APPEAR HERE-->
                </div>

           
            </div>
        </div>

              <!--Video Games-->
              <h3 class="mb-3">Video Game</h3>
            <div class="mb-3 ms-3" name="videogame">
                Watchu playing son?
                <input class="form-control" type="text" name="Videogame" placeholder="Elden Ring" autofocus="true" id="game-search-box" onkeyup="findgame()" onclick="findgame()"><br>
                
                Platform
                <input type="text" class="form-control" name="Platform" placeholder="PC"><br>
                
                <div class="search-list" id="search-list-games">
                    <!--VIDEOGAME SUGGESTIONS WILL APPEAR HERE-->
                </div>
            </div>

        <form>

          <!--The div below puts the submit button below the first column at center-->

        <div class="text-center mb-lg-3">
            <button type="submit" class="btn btn-outline-primary btn-light btn-lg" name="submit" value="btn1" style="margin-left:-100px">Submit</button>
    <!-- CLEAR BUTTON
            <button type="submit" class="btn btn-outline-primary btn-light btn-lg" style="margin-left:10px" name="clear" value="btn2">
            Clear</button>
       -->
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



<!--STICKY FOOTER INCLUDED AT THE BOTTOM OF THE PAGE-->
<?php include "footer.php";?>
<!--END OF MAIN BODY-->
<script src="SearchBoxAPIs/Videogame/script.js"></script> 
<script src="SearchBoxAPIs/Music/script.js"></script>
<script src="SearchBoxAPIs/Movie/script.js"></script>
<script src="SearchBoxAPIs/Book/script.js"></script>
<script src="SearchBoxAPIs/TV/script.js"></script>

</body>
</html>