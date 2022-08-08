<?php
/**
 * USERS CAN ARRIVE HERE BY CLICKING ON THE MUTUAL VIEW BUTTON ON THE PROFILE OF OTHER USERS. SHOWS THE COMMON MEDIA ITEMS MUTUAL TO BOTH THE USERS.  
 *
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>WYDRN - Mutual View</title>
    
    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
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
        <button class="mydiv" >
            Total Mutual Media<br><?php echo (get_mutual_media_count($me, $otheruser)[5]); ?>
        </button>
       
        <button class="mydiv" id="mututalGameBtn">
            VideoGame<br><?php echo (get_mutual_media_count($me, $otheruser)[0]); ?>
        </button>
       
        <button class="mydiv" id="mututalMusicBtn">
            Albums<br><?php echo (get_mutual_media_count($me, $otheruser)[1]); ?>
        </button>
       
        <button class="mydiv" id="mututalBookBtn">
            Books<br><?php echo (get_mutual_media_count($me, $otheruser)[2]); ?>
        </button>
       
        <button class="mydiv" id="mututalMovieBtn">
            Movies<br><?php echo (get_mutual_media_count($me, $otheruser)[3]); ?>
        </button>
        
        <button class="mydiv" id="mututalTVBtn">
            TV<br><?php echo (get_mutual_media_count($me, $otheruser)[4]); ?>
        </button>
    <div>
    
    </center>
    <!--VIDEO GAMES-->
    <div class="media" id="mututalGameDiv" style="display:none;">
        <div>
            <h2>Video Games</h2>
        </div>

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


     <!--Music-->
     <div class="media" id="mututalMusicDiv" style="display:none;">
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
    <div class="media" id="mututalBookDiv" style="display:none;">
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
      <div class="media" id="mututalMovieDiv" style="display:none;">
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
      <div class="media" id="mututalTVDiv" style="display:none;">
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


<script>
const gameBtn= document.getElementById('mututalGameBtn');
const gameDiv= document.getElementById('mututalGameDiv');

const musicBtn= document.getElementById('mututalMusicBtn');
const musicDiv= document.getElementById('mututalMusicDiv');

const bookBtn= document.getElementById('mututalBookBtn');
const bookDiv= document.getElementById('mututalBookDiv');

const movieBtn= document.getElementById('mututalMovieBtn');
const movieDiv= document.getElementById('mututalMovieDiv');

const tvBtn= document.getElementById('mututalTVBtn');
const tvDiv= document.getElementById('mututalTVDiv');

//TOGGLE VISIBILITY FOR VIDEOGAME BUTTON
gameBtn.onclick = function () {
    if (gameDiv.style.display !== "none") {
        gameDiv.style.display = "none";
    } 
    else{    
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
musicBtn.onclick = function () {
    if (musicDiv.style.display !== "none") {
        musicDiv.style.display = "none";
    } 
    else{    
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
bookBtn.onclick = function () {
    if (bookDiv.style.display !== "none") {
        bookDiv.style.display = "none";
    } 
    else{    
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
movieBtn.onclick = function () {
    if (movieDiv.style.display !== "none") {
        movieDiv.style.display = "none";
    } 
    else{    
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
tvBtn.onclick = function () {
    if (tvDiv.style.display !== "none") {
        tvDiv.style.display = "none";
    } 
    else{    
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