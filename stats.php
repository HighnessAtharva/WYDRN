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
$username = $user_data['user_name'];

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

if ($query = mysqli_query($con, $sql)) {
$row = mysqli_fetch_array($query);
$total_media_count= $row[0];
}else{
    echo mysqli_error($con);
}

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

if ($query = mysqli_query($con, $sql)) {
$row = mysqli_fetch_array($query);
$total_media_count_unique= $row[0];
}else{
    echo mysqli_error($con);
}

/*************
  TOTAL BOOKS COUNT 
*************/
$sql="SELECT count(book) AS Total_Count FROM `data` where `username`='$username' AND book!=''";

if ($query = mysqli_query($con, $sql)) {
$row = mysqli_fetch_array($query);
$total_book_count= $row[0];
}else{
    echo mysqli_error($con);
}

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
  TOTAL MEDIA ADDED LAST WEEK
*************/



/*************
  TOTAL MEDIA ADDED LAST MONTH
*************/



/*************
  TOTAL MEDIA ADDED LAST 3 MONTHS
*************/



/*************
  TOTAL MEDIA ADDED LAST 6 MONTHS
*************/



/*************
  TOTAL MEDIA ADDED LAST YEAR
*************/



/*************
  AVERAGE MEDIA ADDED PER DAY 
*************/
//Hint: Total Media Count/ (Current Date - Date of Account Creation ['date' column in 'users' table] )

?>

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
    <?php 
    echo "Total Media Count: ".$total_media_count."<br>";
    echo "Total Unique Media Count: ".$total_media_count_unique."<br>";
    echo "Total Books Count: ".$total_book_count."<br>";
    // add more queries and stats data below in similar way as above
    
    ?>
    </div>
</body>
</html>