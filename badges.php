<?php

/**
 *  Display Achievement Badges earned by a user.
 *
 * @version    PHP 8.0.12
 * @since      June 2022
 * @author     Layout and Design by AtharvaShah. Populating and Badges by Anay Deshpande.
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



/*********SETTING COUNTERS FOR BADGES***************/

// BOOK COUNT
$total_book_count = getTotalBooksCount($con, $username);

// MOVIE COUNT
$total_movie_count = getTotalMoviesCount($con, $username);

// TV COUNT
$total_tv_count = getTotalTVCount($con, $username);

// MUSIC COUNT
$total_album_count = getTotalAlbumCount($con, $username);

// VIDEOGAME COUNT
$total_videogame_count = getTotalVideoGameCount($con, $username);

// FOLLOWER COUNT
$sql = "SELECT COUNT(follower_username) FROM `social` where `followed_username`='$username'";
$total_followers = executeSQL($con, $sql);


// MEMBER SINCE
$date_created = executeSQL($con, "SELECT `date` FROM `users` where `user_name`='$username'");
$date_created = strtotime($date_created);

//gets current date and converts it to date object
$today = date("Y-m-d");
$today = strtotime($today);

//gets the difference between the two date objects and converts it to days
$days_since_member = round(($today - $date_created) / (60 * 60 * 24));
if ($days_since_member == 0) {
  $days_since_member = 1;
}


/*********BADGE IMAGE PATHS***************/

/*

CONST ARRAY = [
[0] -> 'PATH/TO/IMAGE/1',
[1] -> 'BADGE NAME TO PRINT',
[2] -> COUNT OF MEDIAS NEEDED TO EARN BADGE];

 */

//BOOK
const BOOK_BRONZE_1 = ["images/badges/bronze_1.png", "BRONZE - I", 1];
const BOOK_BRONZE_2 = ["images/badges/bronze_2.png", "BRONZE - II", 5];
const BOOK_BRONZE_3 = ["images/badges/bronze_3.png", "BRONZE - III", 10];

const BOOK_SILVER_1 = ["images/badges/silver_1.png", "SILVER - I", 25];
const BOOK_SILVER_2 = ["images/badges/silver_2.png", "SILVER - II", 50];
const BOOK_SILVER_3 = ["images/badges/silver_3.png", "SILVER - III", 100];

const BOOK_GOLD_1 = ["images/badges/gold_1.png", "GOLD - I", 200];
const BOOK_GOLD_2 = ["images/badges/gold_2.png", "GOLD - II", 350];
const BOOK_GOLD_3 = ["images/badges/gold_3.png", "GOLD - III", 500];

//MOVIE
const MOVIE_BRONZE_1 = ["images/badges/bronze_1.png", "BRONZE - I", 3];
const MOVIE_BRONZE_2 = ["images/badges/bronze_2.png", "BRONZE - II", 10];
const MOVIE_BRONZE_3 = ["images/badges/bronze_3.png", "BRONZE - III", 20];

const MOVIE_SILVER_1 = ["images/badges/silver_1.png", "SILVER - I", 50];
const MOVIE_SILVER_2 = ["images/badges/silver_2.png", "SILVER - II", 100];
const MOVIE_SILVER_3 = ["images/badges/silver_3.png", "SILVER - III", 250];

const MOVIE_GOLD_1 = ["images/badges/gold_1.png", "GOLD - I", 500];
const MOVIE_GOLD_2 = ["images/badges/gold_2.png", "GOLD - II", 750];
const MOVIE_GOLD_3 = ["images/badges/gold_3.png", "GOLD - III", 1000];

//TV
const TV_BRONZE_1 = ["images/badges/bronze_1.png", "BRONZE - I", 1];
const TV_BRONZE_2 = ["images/badges/bronze_2.png", "BRONZE - II", 3];
const TV_BRONZE_3 = ["images/badges/bronze_3.png", "BRONZE - III", 5];

const TV_SILVER_1 = ["images/badges/silver_1.png", "SILVER - I", 10];
const TV_SILVER_2 = ["images/badges/silver_2.png", "SILVER - II", 15];
const TV_SILVER_3 = ["images/badges/silver_3.png", "SILVER - III", 25];

const TV_GOLD_1 = ["images/badges/gold_1.png", "GOLD - I", 50];
const TV_GOLD_2 = ["images/badges/gold_2.png", "GOLD - II", 75];
const TV_GOLD_3 = ["images/badges/gold_3.png", "GOLD - III", 100];

//MUSIC
const MUSIC_BRONZE_1 = ["images/badges/bronze_1.png", "BRONZE - I", 1];
const MUSIC_BRONZE_2 = ["images/badges/bronze_2.png", "BRONZE - II", 5];
const MUSIC_BRONZE_3 = ["images/badges/bronze_3.png", "BRONZE - III", 10];

const MUSIC_SILVER_1 = ["images/badges/silver_1.png", "SILVER - I", 25];
const MUSIC_SILVER_2 = ["images/badges/silver_2.png", "SILVER - II", 50];
const MUSIC_SILVER_3 = ["images/badges/silver_3.png", "SILVER - III", 75];

const MUSIC_GOLD_1 = ["images/badges/gold_1.png", "GOLD - I", 100];
const MUSIC_GOLD_2 = ["images/badges/gold_2.png", "GOLD - II", 250];
const MUSIC_GOLD_3 = ["images/badges/gold_3.png", "GOLD - III", 500];

//VIDEOGAME
const VIDEOGAME_BRONZE_1 = ["images/badges/bronze_1.png", "BRONZE - I", 1];
const VIDEOGAME_BRONZE_2 = ["images/badges/bronze_2.png", "BRONZE - II", 5];
const VIDEOGAME_BRONZE_3 = ["images/badges/bronze_3.png", "BRONZE - III", 10];

const VIDEOGAME_SILVER_1 = ["images/badges/silver_1.png", "SILVER - I", 15];
const VIDEOGAME_SILVER_2 = ["images/badges/silver_2.png", "SILVER - II", 25];
const VIDEOGAME_SILVER_3 = ["images/badges/silver_3.png", "SILVER - III", 40];

const VIDEOGAME_GOLD_1 = ["images/badges/gold_1.png", "GOLD - I", 50];
const VIDEOGAME_GOLD_2 = ["images/badges/gold_2.png", "GOLD - II", 75];
const VIDEOGAME_GOLD_3 = ["images/badges/gold_3.png", "GOLD - III", 100];

// FOLLOWERS
const FOLLOWERS_BRONZE = ["images/badges/bronze.png", "MESSIAH-I", 1];
const FOLLOWERS_SILVER = ["images/badges/silver.png", "MESSIAH-II", 3];
const FOLLOWERS_GOLD = ["images/badges/gold.png", "MESSIAH-III", 5];

// MEMBER SINCE DAYS
const PATRON_BRONZE = ["images/badges/bronze.png", "PATRON-I", 1];
const PATRON_SILVER = ["images/badges/silver.png", "PATRON-II", 5];
const PATRON_GOLD = ["images/badges/gold.png", "PATRON-II", 10];

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A badge page for users to see their achievements" />
  <meta name="keywords" content="WYDRN, badges" />
  <title>WYDRN - Badges</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

  <link href="css/backToTop.css" rel="stylesheet">
  <link href="CSS/badges.css" rel="stylesheet">
</head>

<body>


  <div class="page">
    <button onclick="topFunction()" id="BackToTopBtn" title="Go to top">&#8657;</button>

    <!---------------
    BOOK BADGES SECTION
    ------------------->
    <div class="archive">

      <article class="article">
        <span class="emoji" style='font-size:100px;'>&#128213</span>
      </article>
      <article class="article heading-text" id="BookTitle">
        THE BIBLIOPHILE BADGES
      </article>

      <?php
      if ($total_book_count >= BOOK_BRONZE_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
      <article class="article" data-title="<?php echo BOOK_BRONZE_1[2]; ?> book Milestone">
        <p class="badge-name bronze"><?php echo BOOK_BRONZE_1[1]; ?></p>
        <img class="<?php echo $status ?>" src="<?php echo BOOK_BRONZE_1[0]; ?>" alt="<?php echo BOOK_BRONZE_1[1]; ?>">
        <span class="<?php echo $lockicon; ?>"><span>
      </article>



      <?php
      if ($total_book_count >= BOOK_BRONZE_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
      <article class="article" data-title="<?php echo BOOK_BRONZE_2[2]; ?> book Milestone">
        <p class="badge-name bronze"> <?php echo BOOK_BRONZE_2[1]; ?></p>
        <img class="<?php echo $status ?>" src="<?php echo BOOK_BRONZE_2[0]; ?>" alt="<?php echo BOOK_BRONZE_2[1]; ?>">
        <span class="<?php echo $lockicon; ?>"><span>
      </article>



      <?php if ($total_book_count >= BOOK_BRONZE_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
      <article class="article" data-title="<?php echo BOOK_BRONZE_3[2]; ?> book Milestone">
        <p class="badge-name bronze"> <?php echo BOOK_BRONZE_3[1]; ?></p>
        <img class="<?php echo $status ?>" src="<?php echo BOOK_BRONZE_3[0]; ?>" alt="<?php echo BOOK_BRONZE_3[1]; ?>">
        <span class="<?php echo $lockicon; ?>"><span>
      </article>


      <?php if ($total_book_count >= BOOK_SILVER_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
      <article class="article" data-title="<?php echo BOOK_SILVER_1[2]; ?> book Milestone">
        <p class="badge-name silver"> <?php echo BOOK_SILVER_1[1]; ?></p>
        <img class="<?php echo $status ?>" src="<?php echo BOOK_SILVER_1[0]; ?>" alt="<?php echo BOOK_SILVER_1[1]; ?>">
        <span class="<?php echo $lockicon; ?>"><span>
      </article>


      <?php if ($total_book_count >= BOOK_SILVER_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
      <article class="article" data-title="<?php echo BOOK_SILVER_2[2]; ?> book Milestone">
        <p class="badge-name silver"> <?php echo BOOK_SILVER_2[1]; ?></p>
        <img class="<?php echo $status ?>" src="<?php echo BOOK_SILVER_2[0]; ?>" alt="<?php echo BOOK_SILVER_2[1]; ?>">
        <span class="<?php echo $lockicon; ?>"><span>
      </article>



      <?php if ($total_book_count >= BOOK_SILVER_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
      <article class="article" data-title="<?php echo BOOK_SILVER_3[2]; ?> book Milestone">
        <p class="badge-name silver"> <?php echo BOOK_SILVER_3[1]; ?></p>
        <img class="<?php echo $status ?>" src="<?php echo BOOK_SILVER_3[0]; ?>" alt="<?php echo BOOK_SILVER_3[1]; ?>">
        <span class="<?php echo $lockicon; ?>"><span>
      </article>


      <?php if ($total_book_count >= BOOK_GOLD_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
      <article class="article" data-title="<?php echo BOOK_GOLD_1[2]; ?> book Milestone">
        <p class="badge-name gold"> <?php echo BOOK_GOLD_1[1]; ?></p>
        <img class="<?php echo $status ?>" src="<?php echo BOOK_GOLD_1[0]; ?>" alt="<?php echo BOOK_GOLD_1[1]; ?>">
        <span class="<?php echo $lockicon; ?>"><span>
      </article>


      <?php if ($total_book_count >= BOOK_GOLD_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
      <article class="article" data-title="<?php echo BOOK_GOLD_2[2]; ?> book Milestone">
        <p class="badge-name gold"> <?php echo BOOK_GOLD_2[1]; ?></p>
        <img class="<?php echo $status ?>" src="<?php echo BOOK_GOLD_2[0]; ?>" alt="<?php echo BOOK_GOLD_2[1]; ?>">
        <span class="<?php echo $lockicon; ?>"><span>
      </article>


      <?php if ($total_book_count >= BOOK_GOLD_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
      <article class="article" data-title="<?php echo BOOK_GOLD_3[2]; ?> book Milestone">
        <p class="badge-name gold"> <?php echo BOOK_GOLD_3[1]; ?></p>
        <img class="<?php echo $status ?>" src="<?php echo BOOK_GOLD_3[0]; ?>" alt="<?php echo BOOK_GOLD_3[1]; ?>">
        <span class="<?php echo $lockicon; ?>"><span>
      </article>



    </div>




    <!---------------
    MOVIES BADGE SECTION
    ------------------->
    <div class="archive">
      <article class="article">
        <span class="emoji" style='font-size:100px;'>&#127909</span>
      </article>
      <article class="article heading-text" id="MovieTitle">THE CINEPHILE BADGES
      </article>

      <?php if ($total_movie_count >= MOVIE_BRONZE_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MOVIE_BRONZE_1[2]; ?> movie Milestone">
          <p class="badge-name bronze"> <?php echo MOVIE_BRONZE_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MOVIE_BRONZE_1[0]; ?>" alt="<?php echo MOVIE_BRONZE_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_movie_count >= MOVIE_BRONZE_2[2]){$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MOVIE_BRONZE_2[2]; ?> movie Milestone">
          <p class="badge-name bronze"> <?php echo MOVIE_BRONZE_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MOVIE_BRONZE_2[0]; ?>" alt="<?php echo MOVIE_BRONZE_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
    


      <?php if ($total_movie_count >= MOVIE_BRONZE_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo  MOVIE_BRONZE_3[2]; ?> movie Milestone">
          <p class="badge-name bronze"> <?php echo MOVIE_BRONZE_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MOVIE_BRONZE_3[0]; ?>" alt="<?php echo MOVIE_BRONZE_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
    


      <?php if ($total_movie_count >= MOVIE_SILVER_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MOVIE_SILVER_1[2]; ?> movie Milestone">
          <p class="badge-name silver"> <?php echo MOVIE_SILVER_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MOVIE_SILVER_1[0]; ?>" alt="<?php echo MOVIE_SILVER_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
   


      <?php if ($total_movie_count >= MOVIE_SILVER_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MOVIE_SILVER_2[2]; ?> movie Milestone">
          <p class="badge-name silver"> <?php echo MOVIE_SILVER_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MOVIE_SILVER_2[0]; ?>" alt="<?php echo MOVIE_SILVER_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     


      <?php if ($total_movie_count >= MOVIE_SILVER_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MOVIE_SILVER_3[2]; ?> movie Milestone">
          <p class="badge-name silver"> <?php echo MOVIE_SILVER_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MOVIE_SILVER_3[0]; ?>" alt="<?php echo MOVIE_SILVER_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     


      <?php if ($total_movie_count >= MOVIE_GOLD_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MOVIE_GOLD_1[2]; ?> movie Milestone">
          <p class="badge-name gold"> <?php echo MOVIE_GOLD_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MOVIE_GOLD_1[0]; ?>" alt="<?php echo MOVIE_GOLD_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_movie_count >= MOVIE_GOLD_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MOVIE_GOLD_2[2]; ?> movie Milestone">
          <p class="badge-name gold"> <?php echo MOVIE_GOLD_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MOVIE_GOLD_2[0]; ?>" alt="<?php echo MOVIE_GOLD_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     



      <?php if ($total_movie_count >= MOVIE_GOLD_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MOVIE_GOLD_3[2]; ?> movie Milestone">
          <p class="badge-name gold"> <?php echo MOVIE_GOLD_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MOVIE_GOLD_3[0]; ?>" alt="<?php echo MOVIE_GOLD_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
    </div>






    <!---------------
    TV BADGE SECTION
    ------------------->
    <div class="archive">
      <article class="article">
        <span class="emoji" style='font-size:100px;'>&#128250</span>
      </article>
      <article class="article heading-text" id="TvTitle">THE 'OUCH 'OTATO BADGES
      </article>

      <?php if ($total_tv_count >= TV_BRONZE_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo TV_BRONZE_1[2]; ?> TV Milestone">
          <p class="badge-name bronze"> <?php echo TV_BRONZE_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo TV_BRONZE_1[0]; ?>" alt="<?php echo TV_BRONZE_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_tv_count >= TV_BRONZE_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo TV_BRONZE_2[2]; ?> TV Milestone">
          <p class="badge-name bronze"> <?php echo TV_BRONZE_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo TV_BRONZE_2[0]; ?>" alt="<?php echo TV_BRONZE_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     


      <?php if ($total_tv_count >= TV_BRONZE_3[2]){$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo TV_BRONZE_3[2]; ?> TV Milestone">
          <p class="badge-name bronze"> <?php echo TV_BRONZE_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo TV_BRONZE_3[0]; ?>" alt="<?php echo TV_BRONZE_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     


      <?php if ($total_tv_count >= TV_SILVER_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo TV_SILVER_1[2]; ?> TV Milestone">
          <p class="badge-name silver"> <?php echo  TV_SILVER_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo  TV_SILVER_1[0]; ?>" alt="<?php echo TV_SILVER_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_tv_count >= TV_SILVER_2[2]){$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo TV_SILVER_2[2]; ?> TV Milestone">
          <p class="badge-name silver"> <?php echo  TV_SILVER_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo  TV_SILVER_2[0]; ?>" alt="<?php echo TV_SILVER_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
      <?php if ($total_tv_count >= TV_SILVER_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo TV_SILVER_3[2]; ?> TV Milestone">
          <p class="badge-name silver"> <?php echo  TV_SILVER_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo  TV_SILVER_3[0]; ?>" alt="<?php echo TV_SILVER_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_tv_count >= TV_GOLD_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo TV_GOLD_1[2]; ?> TV Milestone">
          <p class="badge-name gold"> <?php echo  TV_GOLD_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo  TV_GOLD_1[0]; ?>" alt="<?php echo TV_GOLD_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_tv_count >= TV_GOLD_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo TV_GOLD_2[2]; ?> TV Milestone">
          <p class="badge-name gold"> <?php echo  TV_GOLD_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo  TV_GOLD_2[0]; ?>" alt="<?php echo TV_GOLD_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_tv_count >= TV_GOLD_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo TV_GOLD_3[2]; ?> TV Milestone">
          <p class="badge-name gold"> <?php echo  TV_GOLD_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo  TV_GOLD_3[0]; ?>" alt="<?php echo TV_GOLD_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
    </div>





    <!---------------
    MUSIC BADGE SECTION
    ------------------->
    <div class="archive">
      <article class="article">
        <span class="emoji" style='font-size:100px;'>&#127911</span>
      </article>
      <article class="article heading-text" id="MusicTitle">THE AUDIOPHILE BADGES
      </article>

      <?php if ($total_album_count >= MUSIC_BRONZE_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MUSIC_BRONZE_1[2]; ?> Music Milestone">
          <p class="badge-name bronze"> <?php echo MUSIC_BRONZE_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MUSIC_BRONZE_1[0]; ?>" alt="<?php echo MUSIC_BRONZE_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_album_count >= MUSIC_BRONZE_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MUSIC_BRONZE_2[2]; ?> Music Milestone">
          <p class="badge-name bronze"> <?php echo MUSIC_BRONZE_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MUSIC_BRONZE_2[0]; ?>" alt="<?php echo MUSIC_BRONZE_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
      <?php if ($total_album_count >= MUSIC_BRONZE_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MUSIC_BRONZE_3[2]; ?> Music Milestone">
          <p class="badge-name bronze"> <?php echo MUSIC_BRONZE_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MUSIC_BRONZE_3[0]; ?>" alt="<?php echo MUSIC_BRONZE_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
      <?php if ($total_album_count >= MUSIC_SILVER_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MUSIC_SILVER_1[2]; ?> Music Milestone">
          <p class="badge-name silver"> <?php echo MUSIC_SILVER_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MUSIC_SILVER_1[0]; ?>" alt="<?php echo MUSIC_SILVER_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
      <?php if ($total_album_count >= MUSIC_SILVER_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MUSIC_SILVER_2[2]; ?> Music Milestone">
          <p class="badge-name silver"> <?php echo MUSIC_SILVER_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MUSIC_SILVER_2[0]; ?>" alt="<?php echo MUSIC_SILVER_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
      <?php if ($total_album_count >= MUSIC_SILVER_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MUSIC_SILVER_3[2]; ?> Music Milestone">
          <p class="badge-name silver"> <?php echo MUSIC_SILVER_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MUSIC_SILVER_3[0]; ?>" alt="<?php echo MUSIC_SILVER_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
      <?php if ($total_album_count >= MUSIC_GOLD_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MUSIC_GOLD_1[2]; ?> Music Milestone">
          <p class="badge-name gold"> <?php echo MUSIC_GOLD_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MUSIC_GOLD_1[0]; ?>" alt="<?php echo MUSIC_GOLD_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
      <?php if ($total_album_count >= MUSIC_GOLD_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MUSIC_GOLD_2[2]; ?> Music Milestone">
          <p class="badge-name gold"> <?php echo MUSIC_GOLD_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MUSIC_GOLD_2[0]; ?>" alt="<?php echo MUSIC_GOLD_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
      <?php if ($total_album_count >= MUSIC_GOLD_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo MUSIC_GOLD_3[2]; ?> Music Milestone">
          <p class="badge-name gold"> <?php echo MUSIC_GOLD_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo MUSIC_GOLD_3[0]; ?>" alt="<?php echo MUSIC_GOLD_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

    </div>



    <!--VIDEOGAME DIV-->
    <div class="archive" id="myGame">
      <article class="article">
        <span class="emoji" style='font-size:100px;'>&#127918</span>
        <img class="image">

      </article>
      <article class="article heading-text" id="GameTitle">SWEATY PALMS BADGES</article>

      <?php if ($total_videogame_count >= VIDEOGAME_BRONZE_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo VIDEOGAME_BRONZE_1[2]; ?> Game Milestone">
          <p class="badge-name bronze"> <?php echo VIDEOGAME_BRONZE_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo VIDEOGAME_BRONZE_1[0]; ?>" alt="<?php echo VIDEOGAME_BRONZE_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_videogame_count >= VIDEOGAME_BRONZE_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo VIDEOGAME_BRONZE_2[2]; ?> Game Milestone">
          <p class="badge-name bronze"> <?php echo VIDEOGAME_BRONZE_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo VIDEOGAME_BRONZE_2[0]; ?>" alt="<?php echo VIDEOGAME_BRONZE_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_videogame_count >= VIDEOGAME_BRONZE_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo VIDEOGAME_BRONZE_3[2]; ?> Game Milestone">
          <p class="badge-name bronze"> <?php echo VIDEOGAME_BRONZE_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo VIDEOGAME_BRONZE_3[0]; ?>" alt="<?php echo VIDEOGAME_BRONZE_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_videogame_count >= VIDEOGAME_SILVER_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo VIDEOGAME_SILVER_1[2]; ?> Game Milestone">
          <p class="badge-name silver"> <?php echo VIDEOGAME_SILVER_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo VIDEOGAME_SILVER_1[0]; ?>" alt="<?php echo VIDEOGAME_SILVER_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_videogame_count >= VIDEOGAME_SILVER_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo VIDEOGAME_SILVER_2[2]; ?> Game Milestone">
          <p class="badge-name silver"> <?php echo VIDEOGAME_SILVER_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo VIDEOGAME_SILVER_2[0]; ?>" alt="<?php echo VIDEOGAME_SILVER_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_videogame_count >= VIDEOGAME_SILVER_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo VIDEOGAME_SILVER_3[2]; ?> Game Milestone">
          <p class="badge-name silver"> <?php echo VIDEOGAME_SILVER_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo VIDEOGAME_SILVER_3[0]; ?>" alt="<?php echo VIDEOGAME_SILVER_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_videogame_count >= VIDEOGAME_GOLD_1[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo VIDEOGAME_GOLD_1[2]; ?> Game Milestone">
          <p class="badge-name gold"> <?php echo VIDEOGAME_GOLD_1[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo VIDEOGAME_GOLD_1[0]; ?>" alt="<?php echo VIDEOGAME_GOLD_1[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_videogame_count >= VIDEOGAME_GOLD_2[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo VIDEOGAME_GOLD_2[2]; ?> Game Milestone">
          <p class="badge-name gold"> <?php echo VIDEOGAME_GOLD_2[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo VIDEOGAME_GOLD_2[0]; ?>" alt="<?php echo VIDEOGAME_GOLD_2[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($total_videogame_count >= VIDEOGAME_GOLD_3[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo VIDEOGAME_GOLD_3[2]; ?> Game Milestone">
          <p class="badge-name gold"> <?php echo VIDEOGAME_GOLD_3[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo VIDEOGAME_GOLD_3[0]; ?>" alt="<?php echo VIDEOGAME_GOLD_3[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
    </div>


    <!--MISC DIV-->
    <div class="archive">
      <article class="article">
        <span class="emoji" style='font-size:100px;'>&#11088;</span>
        <img class="image">

      </article>
      <article class="article heading-text" id="CultTitle">CULT LEADER BADGES

      </article>

      <?php if ($total_followers >= FOLLOWERS_BRONZE[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo FOLLOWERS_BRONZE[2]; ?> Follower Milestone">
          <p class="badge-name bronze"> <?php echo FOLLOWERS_BRONZE[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo FOLLOWERS_BRONZE[0]; ?>" alt="<?php echo FOLLOWERS_BRONZE[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     


      <?php if ($total_followers >= FOLLOWERS_SILVER[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo FOLLOWERS_SILVER[2]; ?> Follower Milestone">
          <p class="badge-name silver"> <?php echo FOLLOWERS_SILVER[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo FOLLOWERS_SILVER[0]; ?>" alt="<?php echo FOLLOWERS_SILVER[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     


      <?php if ($total_followers >= FOLLOWERS_GOLD[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo FOLLOWERS_GOLD[2]; ?> Follower Milestone">
          <p class="badge-name gold"> <?php echo FOLLOWERS_GOLD[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo FOLLOWERS_GOLD[0]; ?>" alt="<?php echo FOLLOWERS_GOLD[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($days_since_member >= PATRON_BRONZE[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo PATRON_BRONZE[2]; ?> Day Milestone">
          <p class="badge-name bronze"> <?php echo PATRON_BRONZE[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo PATRON_BRONZE[0]; ?>" alt="<?php echo PATRON_BRONZE[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     

      <?php if ($days_since_member >= PATRON_SILVER[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo PATRON_SILVER[2]; ?> Day Milestone">
          <p class="badge-name silver"> <?php echo PATRON_SILVER[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo PATRON_SILVER[0]; ?>" alt="<?php echo PATRON_SILVER[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     


      <?php if ($days_since_member >= PATRON_GOLD[2]) {$status = "mybadge"; $lockicon="";}
      else {$status = "mybadge locked"; $lockicon="cross";}
      ?>
        <article class="article" data-title="<?php echo PATRON_GOLD[2]; ?> Day Milestone">
          <p class="badge-name gold"> <?php echo PATRON_GOLD[1]; ?></p>
          <img class="<?php echo $status ?>" src="<?php echo PATRON_GOLD[0]; ?>" alt="<?php echo PATRON_GOLD[1]; ?>">
          <span class="<?php echo $lockicon; ?>"><span>
        </article>
     
    </div>


  </div>
  <!--END OF PAGE-->

  <script src="js/backToTop.js"></script>

</body>

</html>
<?php mysqli_close($con); ?>