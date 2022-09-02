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
  $sql = "SELECT `user_name` FROM `users` WHERE `user_name`='" . $_GET['user_name'] . "'";
  if ($query = mysqli_query($con, $sql)) {
    if(mysqli_num_rows($query)>0){
    $row = mysqli_fetch_array($query);
    if ($row[0] == $_GET['user_name']) {
      $username = $_GET['user_name'];
    }
   } else {
      die("<h1> User not found! </h1>");
    }
  }
}

// BY DEFAULT SHOW THE STATS OF THE LOGGED IN USER.
else {
  $username = $user_data['user_name'];
}


/*************
  TOTAL MEDIA COUNT
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='')
    UNION ALL
    (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='')
    UNION ALL
    (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='')
    UNION ALL
    (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='')
    UNION ALL
    (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='')
)t";


$total_media_count = executeSQL($con, $sql);


/*************
  TOTAL MEDIA COUNT UNIQUE
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(DISTINCT `videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='')
    UNION ALL
    (SELECT count(DISTINCT `album`) AS allcount FROM `data` where `username`='$username' AND album!='')
    UNION ALL
    (SELECT count(DISTINCT `book`) AS allcount FROM `data` where `username`='$username' AND book!='')
    UNION ALL
    (SELECT count(DISTINCT `movie`) AS allcount FROM `data` where `username`='$username' AND movie!='')
    UNION ALL
    (SELECT count(DISTINCT `tv`) AS allcount FROM `data` where `username`='$username' AND tv!='')
)t";

$total_media_count_unique = executeSQL($con, $sql);



/*************
  TOTAL MEDIA ADDED LAST WEEK
 *************/

$sql = "SELECT sum(allcount) AS Total_Count FROM(
  (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
  UNION ALL
  (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
  UNION ALL
  (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
  UNION ALL
  (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
  UNION ALL
  (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 7 DAY)
)t ";
$total_media_added_last_week = executeSQL($con, $sql);


/*************
  TOTAL MEDIA ADDED LAST MONTH
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
  (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
  UNION ALL
  (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
  UNION ALL
  (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
  UNION ALL
  (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
  UNION ALL
  (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 30 DAY)
)t ";
$total_media_added_last_month = executeSQL($con, $sql);



/*************
  TOTAL MEDIA ADDED LAST 3 MONTHS
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
  (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
  UNION ALL
  (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
  UNION ALL
  (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
  UNION ALL
  (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
  UNION ALL
  (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 90 DAY)
)t ";
$total_media_added_last_3months = executeSQL($con, $sql);


/*************
  TOTAL MEDIA ADDED LAST 6 MONTHS
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
  (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
  UNION ALL
  (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
  UNION ALL
  (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
  UNION ALL
  (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
  UNION ALL
  (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 180 DAY)
)t ";
$total_media_added_last_6months = executeSQL($con, $sql);


/*************
  TOTAL MEDIA ADDED LAST YEAR
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
  (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
  UNION ALL
  (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
  UNION ALL
  (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
  UNION ALL
  (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
  UNION ALL
  (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='' AND DATE(date) >= CURDATE() - INTERVAL 365 DAY)
)t ";
$total_media_added_last_year = executeSQL($con, $sql);


/*************
  TOTAL BOOKS COUNT 
 *************/
$sql = "SELECT count(book) AS Total_Count FROM `data` where `username`='$username' AND book!=''";
$total_book_count = executeSQL($con, $sql);


/*************
  TOTAL BOOKS COUNT UNIQUE
 *************/
$sql = "SELECT count(DISTINCT `book`) AS Total_Count FROM `data` where `username`='$username' AND book!=''";
$total_book_count_unique = executeSQL($con, $sql);


/*************
  Favorite BOOKS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
 *************/
$sql = "SELECT book, count(book) as favorites FROM `data` where username='$username' and book!='' GROUP BY book HAVING count(book)>1 ORDER BY count(book) DESC LIMIT 5";

$top_books = executeSQL($con, $sql);


/*************
  Favorite AUTHORS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
 *************/
$sql = "SELECT author, count(author) as favorites FROM `data` where username='$username' and author!='' GROUP BY book HAVING count(author)>1 ORDER BY count(author) DESC LIMIT 5";

$top_authors = executeSQL($con, $sql);

/*************
  TOTAL MOVIE COUNT
 *************/
$sql = "SELECT count(`movie`) AS Total_Count FROM `data` where `username`='$username' AND movie!=''";
$total_movie_count = executeSQL($con, $sql);


/*************
  TOTAL MOVIE COUNT UNIQUE
 *************/
$sql = "SELECT count(DISTINCT `movie`) AS Total_Count FROM `data` where `username`='$username' AND movie!=''";
$total_movie_count_unique = executeSQL($con, $sql);



/*************
  Favorite MOVIE 
 *************/
$sql = "SELECT movie, count(movie) as favorites FROM `data` where username='$username' and movie!='' GROUP BY movie HAVING count(movie)>1 ORDER BY count(movie) DESC LIMIT 5";

$top_movies = executeSQL($con, $sql);


/*************
  TOTAL TV SHOW COUNT 
 *************/
$sql = "SELECT count(`tv`) AS Total_Count FROM `data` where `username`='$username' AND tv!=''";
$total_tv_count = executeSQL($con, $sql);


/*************
  TOTAL TV SHOW COUNT UNIQUE
 *************/
$sql = "SELECT count(DISTINCT `tv`) AS Total_Count FROM `data` where `username`='$username' AND tv!=''";
$total_tv_count_unique = executeSQL($con, $sql);



/*************
  Favorite TV SHOW 
 *************/
$sql = "SELECT tv, count(tv) as favorites FROM `data` where username='$username' and tv!='' GROUP BY tv HAVING count(tv)>1 ORDER BY count(tv) DESC LIMIT 5";

$top_tv = executeSQL($con, $sql);


/*************
  Favorite STREAMING PLATFORM 
 *************/
$sql = "SELECT streaming, count(streaming) as favorites FROM `data` where username='$username' and streaming!='' GROUP BY streaming HAVING count(streaming)>1 ORDER BY count(streaming) DESC LIMIT 5";

$top_streaming = executeSQL($con, $sql);


/*************
  TOTAL VIDEOGAME COUNT 
 *************/
$sql = "SELECT count(`videogame`) AS Total_Count FROM `data` where `username`='$username' AND videogame!=''";
$total_videogame_count = executeSQL($con, $sql);


/*************
  TOTAL VIDEOGAME COUNT UNIQUE
 *************/
$sql = "SELECT count(DISTINCT `videogame`) AS Total_Count FROM `data` where `username`='$username' AND videogame!=''";
$total_videogame_count_unique = executeSQL($con, $sql);



/*************
  Favorite GAMING PLATFORM -> MOST REPEATEDLY LOGGED 
 *************/
$sql = "SELECT platform, count(platform) as favorites FROM `data` where username='$username' and platform!='' GROUP BY platform HAVING count(platform)>1 ORDER BY count(platform) DESC LIMIT 5";

$top_platform = executeSQL($con, $sql);

/*************
  Favorite VIDEOGAME -> MOST REPEATEDLY LOGGED 
 *************/
$sql = "SELECT videogame, count(videogame) as favorites FROM `data` where username='$username' and videogame!='' GROUP BY videogame HAVING count(videogame)>1 ORDER BY count(videogame) DESC LIMIT 5";

$top_videogames = executeSQL($con, $sql);


/*************
  TOTAL ALBUM COUNT 
 *************/
$sql = "SELECT count(`album`) AS Total_Count FROM `data` where `username`='$username' AND album!=''";
$total_album_count = executeSQL($con, $sql);


/*************
  TOTAL ALBUM COUNT UNIQUE
 *************/
$sql = "SELECT count(DISTINCT `album`) AS Total_Count FROM `data` where `username`='$username' AND album!=''";
$total_album_count_unique = executeSQL($con, $sql);



/*************
  Favorite ALBUMS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
 *************/
$sql = "SELECT album, count(album) as favorites FROM `data` where username='$username' and album!='' GROUP BY album HAVING count(album)>1 ORDER BY count(album) DESC LIMIT 5";

$top_albums = executeSQL($con, $sql);


/*************
  Favorite ARTIST/SINGER/SONGWRITER -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
 *************/
$sql = "SELECT artist, count(artist) as favorites FROM `data` where username='$username' and artist!='' GROUP BY artist HAVING count(artist)>1 ORDER BY count(artist) DESC LIMIT 5";

$top_artists = executeSQL($con, $sql);


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
$fav_media_val = max($media_array); //gets the highest value in the array
$fav_media = array_search($fav_media_val, $media_array); //gets the key of the highest value in the array. Key is the media type.



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

  <title>WYDRN - User Stats</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

    
  <link rel="stylesheet" href="CSS/stats.css">
</head>

<body>


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
          <td> <?php echo $top_books; ?></td>
        </tr>

        <tr>
          <td>Favorite Author</td>
          <td> <?php echo $top_authors; ?></td>
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
          <td> <?php echo $top_movies; ?></td>
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
          <td> <?php echo $top_albums; ?></td>
        </tr>

        <tr>
          <td>Favorite Artist</td>
          <td> <?php echo $top_artists; ?></td>
        </tr>

      </tbody>
    </table>
  </div>

  </div>
</body>
</html>