<style>
  .danger {
    background-color: #f7a7a3;
    border-left: 5px solid #8f130c;
    width: 50%;
    margin: 150px auto 0px auto;
    padding: 30px;
    position: relative;
    border-radius: 5px;
    box-shadow: 0 0 15px 5px #ccc;
}

  </style>


<?php

/**
 * SHOW STATS OF A USER SUCH AS BIFURCATION OF ACTIVITIES, NUMBER OF ACTIVITIES, WEEKLY AND YEARLY LOGGED ITEMS etc.
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     Anay Deshpande & Atharva Shah
 */


// error_reporting(E_ERROR | E_PARSE);
session_start();
if (empty($_SESSION)) {
  header("Location: login.php");
}
require "header.php";
require "connection.php";
require "functions.php";


//getting the username from the session
$user_data = check_login($con);


// http://localhost/WYDRN/stats.php?user_name=spammer (if get param is set)
if ($_SERVER['REQUEST_METHOD'] == 'GET' and isset($_GET['user_name'])) {

  //we are checking if username passed in GET request actually exists in the database. If yes, we will show the stats of that user. If not, we will show an error message.
  $sql = "SELECT `user_name` FROM `users` WHERE `user_name`='" . mysqli_real_escape_string($con,$_GET['user_name']) . "'";
  if ($query = mysqli_query($con, $sql)) {
    if(mysqli_num_rows($query)>0){
    $row = mysqli_fetch_array($query);
    if ($row[0] == $_GET['user_name']) {
      $username = mysqli_real_escape_string($con,$_GET['user_name']);
    }
   } 
   
   //if the username is not passed or a faulty username is passed in the get Request this error message will be displayed
   else {
      die("<div class='danger'><h3>Cannot display stats for a non-existent user</h3></div>");
    }
  }
}



// BY DEFAULT SHOW THE STATS OF THE LOGGED IN USER.
else {
  $username = $user_data['user_name'];
}

//general stats
$total_media_count=getTotalMediaCount($con, $username);
$total_media_count_unique = getTotalMediaCountUnique($con, $username);
$total_media_added_last_week = getTotalMediaAddedLastWeek($con, $username);
$total_media_added_last_month = getTotalMediaAddedLastMonth($con, $username);
$total_media_added_last_3months = getTotalMediaAddedLast3Months($con, $username);
$total_media_added_last_6months = getTotalMediaAddedLast6Months($con, $username);
$total_media_added_last_year = getTotalMediaAddedLastYear($con, $username);


//book stats
$total_book_count=getTotalBooksCount($con, $username);
$total_book_count_unique = getTotalBooksCountUnique($con, $username);
$top_book = getFavoriteBook($con, $username);
$top_author = getFavoriteAuthor($con, $username);


//movie stats
$total_movie_count = getTotalMoviesCount($con, $username);
$total_movie_count_unique = getTotalMoviesCountUnique($con, $username);
$top_movie = getFavoriteMovie($con, $username);

//tv stats
$total_tv_count = getTotalTVCount($con, $username);
$total_tv_count_unique = getTotalTVCountUnique($con, $username);
$top_tv = getFavoriteTV($con, $username);
$top_streaming = getFavoriteStreamingPlatform($con, $username);

//videogame stats
$total_videogame_count = getTotalVideoGameCount($con, $username);
$total_videogame_count_unique = getTotalVideoGameCountUnique($con, $username);
$top_platform = getFavoriteGamingPlatform($con, $username);
$top_videogames = getFavoriteVideoGame($con, $username);

//music stats
$total_album_count =  getTotalAlbumCount($con, $username);
$total_album_count_unique =  getTotalAlbumCountUnique($con, $username);
$top_album = getFavoriteAlbum($con, $username);
$top_artist = getFavoriteArtist($con, $username);


/*************
  WHAT'S YOUR FAVORITE MEDIA TYPE
 *************/
//Hint: Select MAX(total book count, total movie count, total tv count, total videogame count, total album count). Use variables stored in above queries. 
$media_array=array("Books"=>$total_book_count,
                  "Movies"=>$total_movie_count,
                  "TV"=>$total_tv_count,
                  "Video Games"=>$total_videogame_count,
                  "Albums"=>$total_album_count,
                  );

if($total_album_count==0 && $total_videogame_count==0 && $total_tv_count==0 && $total_movie_count==0 && $total_book_count==0){
  $fav_media_val="0";
  $fav_media="None";
}
else{
$fav_media_val = max($media_array); //gets the highest value in the array
$fav_media = array_search($fav_media_val, $media_array); //gets the key of the highest value in the array. Key is the media type.
}


/*************
  AVERAGE MEDIA ADDED PER DAY 
 *************/
//gets date of account creation and converts it to date object
$date_created = executeSQL($con, "SELECT `date` FROM `users` where `user_name`='$username'");
$date_created = strtotime($date_created);

//gets current date and converts it to date object
$today=date("Y-m-d");
$today=strtotime($today);

//gets the difference between the two date objects and converts it to days
$interval_in_days=round(($today-$date_created)/(60*60*24));
if ($interval_in_days==0) {
  $interval_in_days=1;
}

//divide total media count by the number of days since account creation and round to 2 decimal places
$avg_media_per_day = round($total_media_count/$interval_in_days);

?>

<!-------------------------------------------------------------------------------------
                              HTML PART
------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <title>WYDRN - User Stats</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
  <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

    
  <link rel="stylesheet" href="CSS/stats.css">
  <link href="css/backToTop.css" rel="stylesheet">
</head>

<body><button onclick="topFunction()" id="BackToTopBtn" title="Go to top">&#8657;</button>


  <h1 class="heading">Stats for <?php echo $username?></h1>
  <br>

<!-----------------------------
      GENERAL STATS TABLE
-------------------------------->
  <div class="table-wrapper">
    <table class="fl-table">
      <thead>
        <tr>
          <th colspan="2" class="heading2">General</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Media Count</td>
          <td> <?php echo ($total_media_count) ?></td>
        </tr>
        <tr>
          <td>Unique Media Count</td>
          <td> <?php echo ($total_media_count_unique) ?></td>
        </tr>
        <tr>
          <td>Media Added Last Week</td>
          <td> <?php echo ($total_media_added_last_week) ?></td>
        </tr>
        <tr>
          <td>Media Added Last Month</td>
          <td> <?php echo ($total_media_added_last_month) ?></td>
        </tr>

        <tr>
          <td>Media Added Last 3 Months</td>
          <td> <?php echo ($total_media_added_last_3months) ?></td>
        </tr>

        <tr>
          <td>Media Added Last 6 Months</td>
          <td> <?php echo ($total_media_added_last_6months) ?></td>
        </tr>

        <tr>
          <td>Media Added Last Year</td>
          <td> <?php echo ($total_media_added_last_year) ?></td>
        </tr>

        <tr>
          <td>Favorite Media Type</td>
          <td> <?php echo ($fav_media ." (total ".$fav_media_val." logged)" ); ?></td>
        </tr>

        <tr>
          <td>Average Media Added Per Day</td>
          <td> <?php echo $avg_media_per_day; ?>
        </tr>
      </tbody>
    </table>
  </div>


  
<!-----------------------------
      BOOK STATS TABLE
-------------------------------->
  <div class="table-wrapper">
    <table class="fl-table">
      <thead>
        <tr>
          <th colspan="2" class="heading2">Book Stats</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Books Count</td>
          <td> <?php echo ($total_book_count) ?></td>
        </tr>

        <tr>
          <td>Books Count Unique</td>
          <td> <?php echo $total_book_count_unique; ?></td>
        </tr>

        <tr>
          <td>Favorite Book</td>
          <td> <?php echo $top_book; ?></td>
        </tr>

        <tr>
          <td>Favorite Author</td>
          <td> <?php echo $top_author; ?></td>
        </tr>

      </tbody>
    </table>
  </div>




<!-----------------------------
      MOVIE STATS TABLE
-------------------------------->
  <div class="table-wrapper">
    <table class="fl-table">
      <thead>
        <tr>
          <th colspan="2" class="heading2">Movie Stats</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Movie Count</td>
          <td> <?php echo $total_movie_count; ?></td>
        </tr>

        <tr>
          <td>Movie Count Unique</td>
          <td> <?php echo $total_movie_count_unique; ?></td>
        </tr>

        <tr>
          <td>Favorite Movie</td>
          <td> <?php echo $top_movie; ?></td>
        </tr>

      </tbody>
    </table>
  </div>



<!-----------------------------
      TV SHOW STATS TABLE
-------------------------------->
  <div class="table-wrapper">
    <table class="fl-table">
      <thead>
        <tr>
          <th colspan="2" class="heading2">TV Stats</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>TV Show Count</td>
          <td> <?php echo $total_tv_count; ?></td>
        </tr>

        <tr>
          <td>TV Show Count Unique</td>
          <td> <?php echo $total_tv_count_unique; ?></td>
        </tr>

        <tr>
          <td>Favorite TV Show</td>
          <td> <?php echo $top_tv; ?></td>
        </tr>

        <tr>
          <td>Favorite Streaming Platform</td>
          <td> <?php echo $top_streaming; ?></td>
        </tr>

      </tbody>
    </table>
  </div>




<!-----------------------------
      VIDEOGAME STATS TABLE
-------------------------------->
  <div class="table-wrapper">
    <table class="fl-table">
      <thead>
        <tr>
          <th colspan="2" class="heading2">VideoGame Stats</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Videogame Count</td>
          <td> <?php echo $total_videogame_count; ?></td>
        </tr>

        <tr>
          <td>Videogame Count Unique</td>
          <td> <?php echo $total_videogame_count_unique; ?></td>
        </tr>

        <tr>
          <td>Favorite Videogame</td>
          <td> <?php echo $top_videogames; ?></td>
        </tr>

        <tr>
          <td>Favorite Videogame Platform</td>
          <td> <?php echo $top_platform; ?></td>
        </tr>


      </tbody>
    </table>
  </div>




<!-----------------------------
      ALBUM STATS TABLE
-------------------------------->
  <div class="table-wrapper">
    <table class="fl-table">
      <thead>
        <tr>
          <th colspan="2" class="heading2">Music Stats</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Album Count</td>
          <td> <?php echo $total_album_count; ?></td>
        </tr>

        <tr>
          <td>Album Count Unique</td>
          <td> <?php echo $total_album_count_unique; ?></td>
        </tr>

        <tr>
          <td>Favorite Album</td>
          <td> <?php echo $top_album; ?></td>
        </tr>

        <tr>
          <td>Favorite Artist</td>
          <td> <?php echo $top_artist; ?></td>
        </tr>

      </tbody>
    </table>
  </div>

  </div>

  
<script src="js/backToTop.js"></script>
</body>
</html>