<?php

/**
 * SHOW STATS OF A USER SUCH AS BIFURCATION OF ACTIVITIES, NUMBER OF ACTIVITIES, WEEKLY AND YEARLY LOGGED ITEMS etc.
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     AtharvaShah
 */


error_reporting(E_ERROR | E_PARSE);
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



/*************
  TOP 5 MOST LOGGED BOOKS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/



/*************
  TOP 5 MOST LOGGED AUTHORS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/



/*************
  TOTAL MOVIE COUNT
*************/



/*************
  TOTAL MOVIE COUNT UNIQUE
*************/



/*************
  TOP 5 MOST LOGGED MOVIES -> MOST REPEATEDLY LOGGED. (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/



/*************
  TOTAL TV SHOW COUNT 
*************/



/*************
  TOTAL TV SHOW COUNT UNIQUE
*************/



/*************
  TOP 5 MOST LOGGED TV SHOWS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/



/*************
  TOP 5 MOST LOGGED STREAMING PLATFORM -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/



/*************
  TOTAL VIDEOGAME COUNT 
*************/



/*************
  TOTAL VIDEOGAME COUNT UNIQUE
*************/



/*************
  TOP 5 MOST LOGGED GAMING PLATFORM -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/


/*************
  TOP 5 MOST LOGGED VIDEOGAMES -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/



/*************
  TOTAL ALBUM COUNT 
*************/



/*************
  TOTAL ALBUM COUNT UNIQUE
*************/



/*************
  TOP 5 MOST LOGGED ALBUMS -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/



/*************
  TOP 5 MOST LOGGED ARTIST/SINGER/SONGWRITER -> MOST REPEATEDLY LOGGED (IF NO DUPLICATES AT ALL, THEN SAY 'NONE')
*************/



/*************
  WHAT'S YOUR FAVORITE MEDIA TYPE
*************/
//Hint: Select MAX(total book count, total movie count, total tv count, total videogame count, total album count). Use variables stored in above queries. 



/*************
  AVERAGE MEDIA ADDED PER DAY 
*************/
//Hint: Total Media Count/ (Current Date - Date of Account Creation ['date' column in 'users' table] )

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
    <title>Stats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stats.css">
</head>
<body>

    <div class="container">
        <h1>Stats for <?php echo $username;?></h1><br>
        <div class="stat-item">Total Media Count: <span> <?php echo($total_media_count) ?> </span></div>
        <div class="stat-item">Total Unique Media Count: <span> <?php echo($total_media_count_unique) ?></span></div>
        <div class="stat-item">Total Media Added Last Week: <span><?php echo($total_media_added_last_week)?></span></div>
        <div class="stat-item">Total Media Added Last Month: <span><?php echo($total_media_added_last_month)?></span></div>
        <div class="stat-item">Total Media Added Last 3 Months: <span><?php echo($total_media_added_last_3months)?></span></div>
        <div class="stat-item">Total Media Added Last 6 Months: <span><?php echo($total_media_added_last_6months)?></span></div>
        <div class="stat-item">Total Media Added Last Year: <span><?php echo($total_media_added_last_year)?></span></div>
        <div class="stat-item">Total Books Count: <span> <?php echo($total_book_count) ?></span></div>

           <!-- Add more stat items below in the same format as above. -->
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>
        <div class="stat-item"> <span> <?php?> </span></div>

    </div>
</body>
</html>