<?php

/**
 *  Display Achievement Badges earned by a user.
 *
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */


session_start();
if (empty($_SESSION)) {
  header("Location: login.php");
}

require "header.php";
require "connection.php";
require "functions.php";

$user_data = check_login($con);

// http://localhost/WYDRN/badges.php?user_name=spammer 
if ($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET['user_name'])) {
  //we are checking if username passed in GET request actually exists in the database. If yes, we will show the badges of that user. If not, we will show an error message.
  $sql = "SELECT `user_name` FROM `users` WHERE `user_name`='" . $_GET['user_name'] . "'";
  if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_array($query);
      if ($row[0] == $_GET['user_name']) {
        $username = $_GET['user_name'];
      }
    } else {
      die("<h1> User not found! </h1>");
    }
  }
}

// http://localhost/WYDRN/badges.php?
else {
  // BY DEFAULT SHOW THE STATS OF THE LOGGED IN USER.
  $username = $user_data['user_name'];
}

function executeSQL($con, $sql)
{
  if ($query = mysqli_query($con, $sql)) {
    $row = mysqli_fetch_array($query);
    if (isset($row[0])) {
      return $row[0];
    } else {
      return '--';
    }
  } else {
    echo mysqli_error($con);
  }
}

/*********SETTING COUNTERS FOR BADGES***************/

// BOOK COUNT
$sql = "SELECT count(book) AS Total_Count FROM `data` where `username`='$username' AND book!=''";
$total_book_count = executeSQL($con, $sql);

// MOVIE COUNT

// TV COUNT

// MUSIC COUNT

// VIDEOGAME COUNT

// FOLLOWER COUNT

// MEMBER SINCE


/*********BADGE IMAGE PATHS***************/

// CONST ARRAY = ['PATH/TO/IMAGE/1', 'BADGE NAME TO PRINT', COUNT OF MEDIAS NEEDED TO EARN BADGE];

//BOOK
const BOOK_BRONZE_1 = ["images/badges/book_bronze_1.png", "BRONZE - I", 1];
const BOOK_BRONZE_2 = ["images/badges/book_bronze_2.png", "BRONZE - II", 5];
const BOOK_BRONZE_3 = ["images/badges/book_bronze_3.png", "BRONZE - III", 10];

const BOOK_SILVER_1 = ["images/badges/book_silver_1.png", "SILVER - I", 25];
const BOOK_SILVER_2 = ["images/badges/book_silver_2.png", "SILVER - II", 50];
const BOOK_SILVER_3 = ["images/badges/book_silver_3.png", "SILVER - III", 100];

const BOOK_GOLD_1 = ["images/badges/book_gold_1.png", "GOLD - I", 200];
const BOOK_GOLD_2 = ["images/badges/book_gold_2.png", "GOLD - II", 350];
const BOOK_GOLD_3 = ["images/badges/book_gold_3.png", "GOLD - III", 500];

//MOVIE
const MOVIE_BRONZE_1 = ["images/badges/movie_bronze_1.png", "BRONZE - I", 3];
const MOVIE_BRONZE_2 = ["images/badges/movie_bronze_2.png", "BRONZE - II", 10];
const MOVIE_BRONZE_3 = ["images/badges/movie_bronze_3.png", "BRONZE - III", 20];

const MOVIE_SILVER_1 = ["images/badges/movie_silver_1.png", "SILVER - I", 50];
const MOVIE_SILVER_2 = ["images/badges/movie_silver_2.png", "SILVER - II", 100];
const MOVIE_SILVER_3 = ["images/badges/movie_silver_3.png", "SILVER - III", 250];

const MOVIE_GOLD_1 = ["images/badges/movie_gold_1.png", "GOLD - I", 500];
const MOVIE_GOLD_2 = ["images/badges/movie_gold_2.png", "GOLD - II", 750];
const MOVIE_GOLD_3 = ["images/badges/movie_gold_3.png", "GOLD - III", 1000];


//TV
const TV_BRONZE_1 = ["images/badges/tv_bronze_1.png", "BRONZE - I", 1];
const TV_BRONZE_2 = ["images/badges/tv_bronze_2.png", "BRONZE - II", 3];
const TV_BRONZE_3 = ["images/badges/tv_bronze_3.png", "BRONZE - III", 5];

const TV_SILVER_1 = ["images/badges/tv_silver_1.png", "SILVER - I", 10];
const TV_SILVER_2 = ["images/badges/tv_silver_2.png", "SILVER - II", 15];
const TV_SILVER_3 = ["images/badges/tv_silver_3.png", "SILVER - III", 25];

const TV_GOLD_1 = ["images/badges/tv_gold_1.png", "GOLD - I", 50];
const TV_GOLD_2 = ["images/badges/tv_gold_2.png", "GOLD - II", 75];
const TV_GOLD_3 = ["images/badges/tv_gold_3.png", "GOLD - III", 100];

//MUSIC
const MUSIC_BRONZE_1 = ["images/badges/music_bronze_1.png", "BRONZE - I", 1];
const MUSIC_BRONZE_2 = ["images/badges/music_bronze_2.png", "BRONZE - II", 5];
const MUSIC_BRONZE_3 = ["images/badges/music_bronze_3.png", "BRONZE - III", 10];

const MUSIC_SILVER_1 = ["images/badges/music_silver_1.png", "SILVER - I", 25];
const MUSIC_SILVER_2 = ["images/badges/music_silver_2.png", "SILVER - II", 50];
const MUSIC_SILVER_3 = ["images/badges/music_silver_3.png", "SILVER - III", 75];

const MUSIC_GOLD_1 = ["images/badges/music_gold_1.png", "GOLD - I", 100];
const MUSIC_GOLD_2 = ["images/badges/music_gold_2.png", "GOLD - II", 250];
const MUSIC_GOLD_3 = ["images/badges/music_gold_3.png", "GOLD - III", 500];

//VIDEOGAME
const VIDEOGAME_BRONZE_1 = ["images/badges/videogame_bronze_1.png", "BRONZE - I", 1];
const VIDEOGAME_BRONZE_2 = ["images/badges/videogame_bronze_2.png", "BRONZE - II", 5];
const VIDEOGAME_BRONZE_3 = ["images/badges/videogame_bronze_3.png", "BRONZE - III", 10];

const VIDEOGAME_SILVER_1 = ["images/badges/videogame_silver_1.png", "SILVER - I", 15];
const VIDEOGAME_SILVER_2 = ["images/badges/videogame_silver_2.png", "SILVER - II", 25];
const VIDEOGAME_SILVER_3 = ["images/badges/videogame_silver_3.png", "SILVER - III", 40];

const VIDEOGAME_GOLD_1 = ["images/badges/videogame_gold_1.png", "GOLD - I", 50];
const VIDEOGAME_GOLD_2 = ["images/badges/videogame_gold_2.png", "GOLD - II", 75];
const VIDEOGAME_GOLD_3 = ["images/badges/videogame_gold_3.png", "GOLD - III", 100];


// FOLLOWERS
const FOLLOWERS_BRONZE = ["images/badges/followers_bronze.png", "BRONZE", 5];
const FOLLOWERS_SILVER = ["images/badges/followers_silver.png", "SILVER", 20];
const FOLLOWERS_GOLD = ["images/badges/followers_gold.png", "GOLD", 50];


// MEMBER SINCE DAYS
const PATRON_BRONZE = ["images/badges/patron_bronze.png", "BRONZE", 10];
const PATRON_SILVER = ["images/badges/patron_silver.png", "SILVER", 30];
const PATRON_GOLD = ["images/badges/patron_gold.png", "GOLD", 90];



?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>WYDRN - Badges</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

  <link href="CSS/badges.css" rel="stylesheet">
</head>

<body>



  <?php 
  // echo $username;
  // echo "<br>";
  // if($total_book_count >= BOOK_BRONZE_1[2]) {
  //     echo "<img src='" . BOOK_BRONZE_1[0] . "' alt='" . BOOK_BRONZE_1[1] . "'>";
  // }
  // if($total_book_count >= BOOK_BRONZE_2[2]) {
  //     echo "<img src='" . BOOK_BRONZE_2[0] . "' alt='" . BOOK_BRONZE_2[1] . "'>";
  // }
  // if($total_book_count >= BOOK_BRONZE_3[2]) {
  //     echo "<img src='" . BOOK_BRONZE_3[0] . "' alt='" . BOOK_BRONZE_3[1] . "'>";
  // }

  // if($total_book_count >= BOOK_SILVER_1[2]) {
  //     echo "<img src='" . BOOK_SILVER_1[0] . "' alt='" . BOOK_SILVER_1[1] . "'>";
  // }
  // if($total_book_count >= BOOK_SILVER_2[2]) {
  //     echo "<img src='" . BOOK_SILVER_2[0] . "' alt='" . BOOK_SILVER_2[1] . "'>";
  // }
  // if($total_book_count >= BOOK_SILVER_3[2]) {
  //     echo "<img src='" . BOOK_SILVER_3[0] . "' alt='" . BOOK_SILVER_3[1] . "'>";
  // }

  // if($total_book_count >= BOOK_GOLD_1[2]) {
  //     echo "<img src='" . BOOK_GOLD_1[0] . "' alt='" . BOOK_GOLD_1[1] . "'>";
  // }
  // if($total_book_count >= BOOK_GOLD_2[2]) {
  //     echo "<img src='" . BOOK_GOLD_2[0] . "' alt='" . BOOK_GOLD_2[1] . "'>";
  // }
  // if($total_book_count >= BOOK_GOLD_3[2]) {
  //     echo "<img src='" . BOOK_GOLD_3[0] . "' alt='" . BOOK_GOLD_3[1] . "'>";
  // }
  ?>




  <div class="page">
    <h1>BADGES</h1>

    <!--BOOK DIV-->
    <div class="archive">
      <article class="article">
        <span style='font-size:100px;'>&#128213</span>
      </article>
      <article class="article">
        Book Text
      </article>
      
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3<br>
        <hr class="image">
        <hr>
        <hr>
      </article>

    </div>




    <!--MOVIE DIV-->
    <div class="archive">
      <article class="article">
        <span style='font-size:100px;'>&#127909</span>
      </article>
      <article class="article">Movie Text
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3<br>
        <hr class="image">
        <hr>
        <hr>
      </article>

    </div>






    <!--TV DIV-->
    <div class="archive">
      <article class="article">
        <span style='font-size:100px;'>&#128250</span>
      </article>
      <article class="article">TV Text
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3<br>
        <hr class="image">
        <hr>
        <hr>
      </article>

    </div>




    <!--MUSIC DIV-->
    <div class="archive">
      <article class="article">
        <span style='font-size:100px;'>&#127911</span>
      </article>
      <article class="article">Music Text
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>

      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3<br>
        <hr class="image">
        <hr>
        <hr>
      </article>

    </div>



    <!--VIDEOGAME DIV-->
    <div class="archive">
      <article class="article">
        <span style='font-size:100px;'>&#127918</span>
        <img class="image">
        <hr>
      </article>
      <article class="article">Videogame Text
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">BADGE NAME 3<br>
        <hr class="image">
        <hr>
        <hr>
      </article>
    </div>






       <!--MISC DIV-->
       <div class="archive">
      <article class="article">
        <span style='font-size:100px;'>&#11088;</span>
        <img class="image">
        <hr>
      </article>
      <article class="article">Followers and Patrons Text
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
      </article>
      <article class="article">FOLLOWERS BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">FOLLOWERS BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">FOLLOWERS BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">PATRONS BADGE NAME 1
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">PATRONS BADGE NAME 2
        <hr class="image">
        <hr>
        <hr>
      </article>
      <article class="article">PATRONS BADGE NAME 3
        <hr class="image">
        <hr>
        <hr>
      </article>
    </div>


  </div> <!--END OF PAGE-->

</body>
</html>
<?php mysqli_close($con); ?>