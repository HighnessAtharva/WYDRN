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
if ($_SERVER['REQUEST_METHOD']=='GET' and isset($_GET['user_name'])) {
  
  //we are checking if username passed in GET request actually exists in the database. If yes, we will show the stats of that user. If not, we will show an error message.
  $sql="SELECT `user_name` FROM `users` WHERE `user_name`='".$_GET['user_name']."'";
  if ($query = mysqli_query($con, $sql)) {
    $row = mysqli_fetch_array($query);
    if ($row[0]==$_GET['user_name']) {
      $username=$_GET['user_name'];
    }else{
        die("<h1> User not found! </h1>");
    }
}
}

// BY DEFAULT SHOW THE STATS OF THE LOGGED IN USER.
else{
  $username = $user_data['user_name'];
}

function executeSQL($con, $sql){
  if ($query = mysqli_query($con, $sql)) {
    $row = mysqli_fetch_array($query);
    return $row[0];
    }else{
        echo mysqli_error($con);
    }
}



/*************
  TOTAL MEDIA COUNT
*************/
$sql="SELECT sum(allcount) AS Total_Count FROM(
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


$total_media_count= executeSQL($con, $sql);


/*************
  TOTAL MEDIA COUNT UNIQUE
*************/
$sql="SELECT sum(allcount) AS Total_Count FROM(
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

$total_media_count_unique= executeSQL($con, $sql);



/*************
  TOTAL MEDIA ADDED LAST WEEK
*************/

$sql="SELECT sum(allcount) AS Total_Count FROM(
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
$total_media_added_last_week= executeSQL($con, $sql);


/*************
  TOTAL MEDIA ADDED LAST MONTH
*************/
$sql="SELECT sum(allcount) AS Total_Count FROM(
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
$total_media_added_last_month= executeSQL($con, $sql);



/*************
  TOTAL MEDIA ADDED LAST 3 MONTHS
*************/
$sql="SELECT sum(allcount) AS Total_Count FROM(
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
$total_media_added_last_3months= executeSQL($con, $sql);


/*************
  TOTAL MEDIA ADDED LAST 6 MONTHS
*************/
$sql="SELECT sum(allcount) AS Total_Count FROM(
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
$total_media_added_last_6months= executeSQL($con, $sql);


/*************
  TOTAL MEDIA ADDED LAST YEAR
*************/
$sql="SELECT sum(allcount) AS Total_Count FROM(
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
$total_media_added_last_year= executeSQL($con, $sql);


/*************
  TOTAL BOOKS COUNT 
*************/
$sql="SELECT count(book) AS Total_Count FROM `data` where `username`='$username' AND book!=''";
$total_book_count= executeSQL($con, $sql);


/*************
  TOTAL BOOKS COUNT UNIQUE
*************/
$sql="SELECT count(DISTINCT `book`) AS Total_Count FROM `data` where `username`='$username' AND book!=''";
$total_book_count_unique= executeSQL($con, $sql);


/*************
  Favorite BOOKS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/
$sql="SELECT book, count(book) as favorites FROM `data` where username='$username' and book!='' GROUP BY book HAVING count(book)>1 ORDER BY count(book) DESC LIMIT 5";

$top_books=executeSQL($con, $sql);


/*************
  Favorite AUTHORS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/
$sql="SELECT author, count(author) as favorites FROM `data` where username='$username' and author!='' GROUP BY book HAVING count(author)>1 ORDER BY count(author) DESC LIMIT 5";

$top_authors=executeSQL($con, $sql);

/*************
  TOTAL MOVIE COUNT
*************/
$sql="SELECT count(`movie`) AS Total_Count FROM `data` where `username`='$username' AND movie!=''";
$total_movie_count= executeSQL($con, $sql);


/*************
  TOTAL MOVIE COUNT UNIQUE
*************/
$sql="SELECT count(DISTINCT `movie`) AS Total_Count FROM `data` where `username`='$username' AND movie!=''";
$total_movie_count_unique= executeSQL($con, $sql);



/*************
  Favorite MOVIE 
*************/
$sql="SELECT movie, count(movie) as favorites FROM `data` where username='$username' and movie!='' GROUP BY movie HAVING count(movie)>1 ORDER BY count(movie) DESC LIMIT 5";

$top_movies=executeSQL($con, $sql);


/*************
  TOTAL TV SHOW COUNT 
*************/
$sql="SELECT count(`tv`) AS Total_Count FROM `data` where `username`='$username' AND tv!=''";
$total_tv_count= executeSQL($con, $sql);


/*************
  TOTAL TV SHOW COUNT UNIQUE
*************/
$sql="SELECT count(DISTINCT `tv`) AS Total_Count FROM `data` where `username`='$username' AND tv!=''";
$total_tv_count_unique= executeSQL($con, $sql);



/*************
  Favorite TV SHOW 
*************/
$sql="SELECT tv, count(tv) as favorites FROM `data` where username='$username' and tv!='' GROUP BY tv HAVING count(tv)>1 ORDER BY count(tv) DESC LIMIT 5";

$top_tv=executeSQL($con, $sql);


/*************
  Favorite STREAMING PLATFORM 
*************/
$sql="SELECT streaming, count(streaming) as favorites FROM `data` where username='$username' and streaming!='' GROUP BY streaming HAVING count(streaming)>1 ORDER BY count(streaming) DESC LIMIT 5";

$top_streaming=executeSQL($con, $sql);


/*************
  TOTAL VIDEOGAME COUNT 
*************/
$sql="SELECT count(`videogame`) AS Total_Count FROM `data` where `username`='$username' AND videogame!=''";
$total_videogame_count= executeSQL($con, $sql);


/*************
  TOTAL VIDEOGAME COUNT UNIQUE
*************/
$sql="SELECT count(DISTINCT `videogame`) AS Total_Count FROM `data` where `username`='$username' AND videogame!=''";
$total_videogame_count_unique= executeSQL($con, $sql);



/*************
  Favorite GAMING PLATFORM -> MOST REPEATEDLY LOGGED 
*************/
$sql="SELECT platform, count(platform) as favorites FROM `data` where username='$username' and platform!='' GROUP BY platform HAVING count(platform)>1 ORDER BY count(platform) DESC LIMIT 5";

$top_platform=executeSQL($con, $sql);

/*************
  Favorite VIDEOGAME -> MOST REPEATEDLY LOGGED 
*************/
$sql="SELECT videogame, count(videogame) as favorites FROM `data` where username='$username' and videogame!='' GROUP BY videogame HAVING count(videogame)>1 ORDER BY count(videogame) DESC LIMIT 5";

$top_videogames=executeSQL($con, $sql);


/*************
  TOTAL ALBUM COUNT 
*************/
$sql="SELECT count(`album`) AS Total_Count FROM `data` where `username`='$username' AND album!=''";
$total_album_count= executeSQL($con, $sql);


/*************
  TOTAL ALBUM COUNT UNIQUE
*************/
$sql="SELECT count(DISTINCT `album`) AS Total_Count FROM `data` where `username`='$username' AND album!=''";
$total_album_count_unique= executeSQL($con, $sql);



/*************
  Favorite ALBUMS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/
$sql="SELECT album, count(album) as favorites FROM `data` where username='$username' and album!='' GROUP BY album HAVING count(album)>1 ORDER BY count(album) DESC LIMIT 5";

$top_albums=executeSQL($con, $sql);


/*************
  Favorite ARTIST/SINGER/SONGWRITER -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/
$sql="SELECT artist, count(artist) as favorites FROM `data` where username='$username' and artist!='' GROUP BY artist HAVING count(artist)>1 ORDER BY count(artist) DESC LIMIT 5";

$top_artists=executeSQL($con, $sql);


/*************
  WHAT'S YOUR FAVORITE MEDIA TYPE
*************/
//Hint: Select MAX(total book count, total movie count, total tv count, total videogame count, total album count). Use variables stored in above queries. 



/*************
  AVERAGE MEDIA ADDED PER DAY 
*************/
//Hint: Total Media Count/ (Current Date - Date of Account Creation ['date' column in 'users' table] )
$sql= "SELECT @today := CURRENT_DATE(); 
SELECT @registered :=  `date` from users where user_name='$username'; 
SELECT @interval := DATEDIFF(@today, @registered);
SELECT sum(allcount)/@interval AS Total_Count FROM(
    (SELECT count(`videogame`) as allcount FROM `data` where `username`='$username' AND videogame!='')
    UNION ALL
    (SELECT count(album) AS allcount FROM `data` where `username`='$username' AND album!='')
    UNION ALL
    (SELECT count(book) AS allcount FROM `data` where `username`='$username' AND book!='')
    UNION ALL
    (SELECT count(movie) AS allcount FROM `data` where `username`='$username' AND movie!='')
    UNION ALL
    (SELECT count(tv) AS allcount FROM `data` where `username`='$username' AND tv!='')
)";

//$avg_media_added=executeSQL($con, $sql);

?>

<!-- *******************
       HTML STUFF
******************* -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>WYDRN - User Stats</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/stats.css">
</head>
<body>

    <div class="container">
        <h1 class="heading">Your Stats</h1>
        <br>

        <h2 class="heading2">General</h2>
        <div class="stat-item">Media Count: <span> <?php echo($total_media_count) ?> </span></div>
        <div class="stat-item">Unique Media Count: <span> <?php echo($total_media_count_unique) ?></span></div>
        <div class="stat-item">Media Added Last Week: <span><?php echo($total_media_added_last_week)?></span></div>
        <div class="stat-item">Media Added Last Month: <span><?php echo($total_media_added_last_month)?></span></div>
        <div class="stat-item">Media Added Last 3 Months: <span><?php echo($total_media_added_last_3months)?></span></div>
        <div class="stat-item">Media Added Last 6 Months: <span><?php echo($total_media_added_last_6months)?></span></div>
        <div class="stat-item">Media Added Last Year: <span><?php echo($total_media_added_last_year)?></span></div>
        <div class="stat-item">Favorite Media Type: <span><B>DO THIS LATER!!!</B> </span></div>
        <div class="stat-item">Average Media Added Per Day:  <span> <B>DO THIS LATER!!!</B> </span></div>
        
        <h2 class="heading2">Books</h2>
        <div class="stat-item">Books Count: <span> <?php echo($total_book_count) ?></span></div>
        <div class="stat-item">Books Count Unique: <span> <?php echo $total_book_count_unique;?> </span></div>
        <div class="stat-item">Favorite Book:  <span>  <?php echo $top_books;?>  </span></div>
        <div class="stat-item">Favorite Author: <span> <?php echo $top_authors; ?> </span></div>

        <h2 class="heading2">Movies</h2>
        <div class="stat-item">Movie Count: <span> <?php echo $total_movie_count;?> </span></div>
        <div class="stat-item">Movie Count Unique: <span> <?php echo $total_movie_count_unique;?> </span></div>
        <div class="stat-item">Favorite Movie : <span> <?php echo $top_movies;?> </span></div>

        <h2 class="heading2">TV</h2>
        <div class="stat-item">TV Show Count:  <span> <?php echo $total_tv_count;?> </span></div>
        <div class="stat-item">TV Show Count Unique: <span> <?php echo $total_tv_count_unique;?> </span></div>
        <div class="stat-item">Favorite TV Show:  <span> <?php echo $top_tv;?> </span></div>
        <div class="stat-item">Favorite Streaming Platform: <span> <?php echo $top_streaming;?> </span></div>
        
        <h2 class="heading2">VideoGame</h2>
        <div class="stat-item">Videogame Count:  <span> <?php echo $total_videogame_count;?> </span></div>
        <div class="stat-item">Videogame Count Unique: <span> <?php echo $total_videogame_count_unique;?> </span></div>
        <div class="stat-item">Favorite Videogame: <span> <?php  echo $top_videogames;?> </span></div>
        <div class="stat-item">Favorite Videogame Platform: <span> <?php echo $top_platform;?> </span></div>
      
        <h2 class="heading2">Album</h2>
        <div class="stat-item">Album Count:  <span> <?php echo $total_album_count;?> </span></div>
        <div class="stat-item">Album Count Unique: <span> <?php echo $total_album_count_unique;?> </span></div>
        <div class="stat-item">Favorite Album: <span> <?php echo $top_albums;?> </span></div>
        <div class="stat-item">Favorite Artist: <span> <?php echo $top_artists;?> </span></div>


    </div>
</body>
</html>