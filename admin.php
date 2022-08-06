<?php

/**
 * All The adminstrative functions such as member count, member deletion and member data/authorization will be displayed here.
 *
 * @version    PHP 8.0.12
 * @since      July 2022
 * @author     AtharvaShah & Anay Deshpande
 */

error_reporting(E_ERROR | E_PARSE);
if (!isset($_GET['letmein'])) {
    echo ("<img src='images/website/imposter.jpg' style='width: 100%; height: 100%;'>");
    die();
}

require "connection.php";
require "functions.php";

// executes the query and returns the first row of the result set.
function executeSQL($con, $sql)
{
    if ($query = mysqli_query($con, $sql)) {
        $row = mysqli_fetch_array($query);
        return $row[0];
    } else {
        echo mysqli_error($con);
    }
}

/*************
TOTAL MEDIA COUNT (SUM OF ALL USERS)
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
    (SELECT count(`videogame`) as allcount FROM `data` WHERE videogame!='')
    UNION ALL
    (SELECT count(album) AS allcount FROM `data` WHERE album!='')
    UNION ALL
    (SELECT count(book) AS allcount FROM `data` WHERE book!='')
    UNION ALL
    (SELECT count(movie) AS allcount FROM `data` WHERE movie!='')
    UNION ALL
    (SELECT count(tv) AS allcount FROM `data` WHERE tv!='')
)t";

$total_media_count = executeSQL($con, $sql);

/*************
TOTAL CURRENT ACTIVE USERS ON SITE
 *************/
$sql = "SELECT count(`user_name`) FROM `users` where `active`=1";
$current_active_users = executeSQL($con, $sql);

/*************
TOTAL USERS COUNT (TOTAL REGISTERED USERS)
 *************/

$sql = "SELECT count(`user_name`) FROM `users`";
$total_users_count = executeSQL($con, $sql);

/*************
TOTAL BOOKS COUNT (SUM OF ALL USERS)
 *************/
$sql = "SELECT count(`book`) FROM `data` where `book`!=''";
$total_book_count = executeSQL($con, $sql);

/*************
TOTAL MOVIE COUNT (SUM OF ALL USERS)
 *************/
$sql = "SELECT count(`movie`) FROM `data` where `movie`!=''";
$total_movie_count = executeSQL($con, $sql);

/*************
TOTAL TV COUNT (SUM OF ALL USERS)
 *************/
$sql = "SELECT count(`tv`) FROM `data` where `tv`!=''";
$total_tv_count = executeSQL($con, $sql);

/*************
TOTAL VIDEOGAME COUNT (SUM OF ALL USERS)
 *************/
$sql = "SELECT count(`videogame`) FROM `data` where `videogame`!=''";
$total_videogame_count = executeSQL($con, $sql);

/*************
TOTAL ALBUM COUNT (SUM OF ALL USERS)
 *************/
$sql = "SELECT count(`album`) FROM `data` where `album`!=''";
$total_album_count = executeSQL($con, $sql);

/*************
MOST LOGGED BOOKS -> ACROSS ALL USERS
 *************/
$sql = "SELECT book, count(book) FROM `data` where book!='' GROUP BY book HAVING count(book)>1 ORDER BY count(book) DESC LIMIT 50";

$top_books = executeSQL($con, $sql);

/*************
MOST LOGGED ALBUMS -> ACROSS ALL USERS
 *************/
$sql = "SELECT album, count(album) FROM `data` where album!='' GROUP BY album HAVING count(album)>1 ORDER BY count(album) DESC LIMIT 50";

$top_albums = executeSQL($con, $sql);

/*************
MOST LOGGED TV SHOWS -> ACROSS ALL USERS
 *************/
$sql = "SELECT tv, count(tv) FROM `data` where tv!='' GROUP BY tv HAVING count(tv)>1 ORDER BY count(tv) DESC LIMIT 50";

$top_tv = executeSQL($con, $sql);

/*************
MOST LOGGED VIDEOGAMES -> ACROSS ALL USERS
 *************/
$sql = "SELECT videogame, count(videogame) FROM `data` where videogame!='' GROUP BY videogame HAVING count(videogame)>1 ORDER BY count(videogame) DESC LIMIT 50";

$top_games = executeSQL($con, $sql);

/*************
MOST LOGGED MOVIES -> ACROSS ALL USERS
 *************/
$sql = "SELECT movie, count(movie) FROM `data` where movie!='' GROUP BY movie HAVING count(movie)>1 ORDER BY count(movie) DESC LIMIT 50";

$top_movies = executeSQL($con, $sql);

/*************
GET MOST POPULAR USERS (USERS WITH MOST FOLLOWERS)
 *************/

$sql = "SELECT followed_username as popular_users, COUNT(*) AS follower_count
FROM social
GROUP BY followed_username ORDER BY follower_count desc limit 50";
$popular_users = executeSQL($con, $sql);

/*************
GET COUNT OF USERS WHO ARE NOT VERIFIED (CHECK `USERS` TABLE)
 *************/

$sql = "SELECT COUNT(`user_name`) FROM users where verified =0";
$not_verified = executeSQL($con, $sql);

/*************
GET COUNT OF USERS WHO HAVE NOT LOGGED ANY MEDIA (DEAD ACCOUNT)
 *************/
$sql = "SELECT count(t1.user_name)
FROM users t1
LEFT JOIN data t2 ON t2.username = t1.user_name
WHERE t2.username IS NULL";
$dead_accounts = executeSQL($con, $sql);

/*************
GET USERS WHO HAVE LOGGED MORE THAN 1000 MEDIA ITEMS (THIS CAN BE EXTENDED LATER TO CHECK FOR SPAMMING)
 *************/
$sql = "SELECT COUNT(*) FROM (

  SELECT sum(allcount) AS Total_Count FROM(
          (SELECT username, count(`videogame`) as allcount FROM `data` WHERE videogame!=''  GROUP BY username)
          UNION ALL
          (SELECT username, count(album) AS allcount FROM `data` WHERE album!=''  GROUP BY username)
          UNION ALL
          (SELECT username, count(book) AS allcount FROM `data` WHERE book!=''  GROUP BY username)
          UNION ALL
          (SELECT username, count(movie) AS allcount FROM `data` WHERE movie!='' GROUP BY username)
          UNION ALL
          (SELECT username, count(tv) AS allcount FROM `data` WHERE tv!=''  GROUP BY username)
  )t group by username having Total_count > 1000)

as whales";
$whale_users = executeSQL($con, $sql);

/*************
TOTAL MEDIA ADDED YESTERDAY
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
  (SELECT count(`videogame`) as allcount FROM `data` WHERE videogame!='' and date > DATE_SUB(now(), INTERVAL 1 DAY))
  UNION ALL
  (SELECT count(`album`) AS allcount FROM `data` WHERE album!='' and date > DATE_SUB(now(), INTERVAL 1 DAY))
  UNION ALL
  (SELECT count(`book`) AS allcount FROM `data` WHERE book!='' and date > DATE_SUB(now(), INTERVAL 1 DAY))
  UNION ALL
  (SELECT count(`movie`) AS allcount FROM `data` WHERE movie!='' and date > DATE_SUB(now(), INTERVAL 1 DAY))
  UNION ALL
  (SELECT count(`tv`) AS allcount FROM `data` WHERE tv!='' and date > DATE_SUB(now(), INTERVAL 1 DAY))
)t";
$total_media_added_yesterday = executeSQL($con, $sql);

/*************
TOTAL MEDIA ADDED LAST WEEK
 *************/

$sql = "SELECT sum(allcount) AS Total_Count FROM(
  (SELECT count(`videogame`) as allcount FROM `data` WHERE videogame!='' and date > DATE_SUB(now(), INTERVAL 7 DAY))
  UNION ALL
  (SELECT count(`album`) AS allcount FROM `data` WHERE album!='' and date > DATE_SUB(now(), INTERVAL 7 DAY))
  UNION ALL
  (SELECT count(`book`) AS allcount FROM `data` WHERE book!='' and date > DATE_SUB(now(), INTERVAL 7 DAY))
  UNION ALL
  (SELECT count(`movie`) AS allcount FROM `data` WHERE movie!='' and date > DATE_SUB(now(), INTERVAL 7 DAY))
  UNION ALL
  (SELECT count(`tv`) AS allcount FROM `data` WHERE tv!='' and date > DATE_SUB(now(), INTERVAL 7 DAY))
)t";
$total_media_added_last_week = executeSQL($con, $sql);

/*************
TOTAL MEDIA ADDED LAST MONTH
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
  (SELECT count(`videogame`) as allcount FROM `data` WHERE videogame!='' and date > DATE_SUB(now(), INTERVAL 31 DAY))
  UNION ALL
  (SELECT count(`album`) AS allcount FROM `data` WHERE album!='' and date > DATE_SUB(now(), INTERVAL 31  DAY))
  UNION ALL
  (SELECT count(`book`) AS allcount FROM `data` WHERE book!='' and date > DATE_SUB(now(), INTERVAL 31 DAY))
  UNION ALL
  (SELECT count(`movie`) AS allcount FROM `data` WHERE movie!='' and date > DATE_SUB(now(), INTERVAL 31  DAY))
  UNION ALL
  (SELECT count(`tv`) AS allcount FROM `data` WHERE tv!='' and date > DATE_SUB(now(), INTERVAL 31  DAY))
)t";
$total_media_added_last_month = executeSQL($con, $sql);

/*************
TOTAL MEDIA ADDED LAST YEAR
 *************/
$sql = "SELECT sum(allcount) AS Total_Count FROM(
  (SELECT count(`videogame`) as allcount FROM `data` WHERE videogame!='' and date > DATE_SUB(now(), INTERVAL 1 YEAR))
  UNION ALL
  (SELECT count(`album`) AS allcount FROM `data` WHERE album!='' and date > DATE_SUB(now(), INTERVAL 1 YEAR))
  UNION ALL
  (SELECT count(`book`) AS allcount FROM `data` WHERE book!='' and date > DATE_SUB(now(), INTERVAL 1 YEAR))
  UNION ALL
  (SELECT count(`movie`) AS allcount FROM `data` WHERE movie!='' and date > DATE_SUB(now(), INTERVAL 1 YEAR))
  UNION ALL
  (SELECT count(`tv`) AS allcount FROM `data` WHERE tv!='' and date > DATE_SUB(now(), INTERVAL 1 YEAR))
  )t";
$total_media_added_last_year = executeSQL($con, $sql);

/*************
AVERAGE MEDIA ADDED PER USER
 *************/
$avg_media_per_user = $total_media_count / $total_users_count;
$avg_media_per_user = round($avg_media_per_user);

/*************
GET PROFILE PHOTO, USERNAME, AND EMAIL FOR EACH USER
 *************/
$sql = "SELECT `id`, `user_name`, `profile_pic`, `email` FROM users";
$userlist = array();
if ($query = mysqli_query($con, $sql)) {
    while ($row = mysqli_fetch_assoc($query)) {
        $uid = $row['id'];
        $uname = $row["user_name"];
        $pfp = $row["profile_pic"];
        $emailadd = $row["email"];
        array_push($userlist, array("uid" => $uid, "user_name" => $uname, "profile_pic" => $pfp, "email" => $emailadd));
    }} else {
    echo mysqli_error($con);
}

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

  <title>WYDRN - Admin Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="CSS/admin.css">
</head>

<body>

<!-- BUTTON GROUPS SERVING VARIETY OF FUNCTIONS -->
<div class="text-center" id="btn-group"><br>
  <button id='site-stats-btn' class='btn btn-primary'>Site Stats</button>
  <button id='user-management-btn' class='btn btn-primary'>Manage Users</button>
</div>


<!-- SITEWIDE STATS BEGINS-->
  <div id='site-stats-table' class="table-wrapper" style="display:none;">
    <table class="fl-table">
      <thead>
        <tr>
          <th colspan="2" class="heading2">Sitewide Stats</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>TOTAL MEDIA ADDED BY ALL USERS</td><td><?php echo $total_media_count; ?></td></tr>
        <tr><td> CURRENT ACTIVE USERS ON SITE </td><td> <?php echo $current_active_users; ?> </td></tr>
        <tr><td> TOTAL USERS COUNT </td><td> <?php echo $total_users_count; ?> </td></tr>
        <tr><td> TOTAL BOOKS ADDED BY ALL USERS </td><td> <?php echo $total_book_count; ?> </td></tr>
        <tr><td> TOTAL MOVIES ADDED BY ALL USERS </td><td> <?php echo $total_movie_count; ?> </td></tr>
        <tr><td> TOTAL TVS ADDED BY ALL USERS </td><td> <?php echo $total_tv_count; ?> </td></tr>
        <tr><td> TOTAL VIDEOGAMES ADDED BY ALL USERS </td><td> <?php echo $total_videogame_count; ?> </td></tr>
        <tr><td> TOTAL ALBUMS ADDED BY ALL USERS </td><td> <?php echo $total_album_count; ?> </td></tr>
        <tr><td> COUNT OF USERS WHO ARE NOT VERIFIED </td><td> <?php echo $not_verified; ?> </td></tr>
        <tr><td> COUNT OF USERS WHO HAVE NOT LOGGED ANY MEDIA </td><td> <?php echo $dead_accounts; ?> </td></tr>
        <tr><td> COUNT OF USERS WITH MORE THAN 1000 MEDIA ITEMS </td><td> <?php echo $whale_users; ?> </td></tr>
        <tr><td> TOTAL MEDIA ADDED YESTERDAY </td><td> <?php echo $total_media_added_yesterday; ?> </td></tr>
        <tr><td> TOTAL MEDIA ADDED LAST WEEK </td><td> <?php echo $total_media_added_last_week; ?> </td></tr>
        <tr><td> TOTAL MEDIA ADDED LAST MONTH </td><td> <?php echo $total_media_added_last_month; ?> </td></tr>
        <tr><td> TOTAL MEDIA ADDED LAST YEAR </td><td> <?php echo $total_media_added_last_year; ?> </td></tr>
        <tr><td>  AVERAGE MEDIA ADDED PER USER  </td><td> <?php echo $avg_media_per_user; ?> </td></tr>
        <tr><td> MOST LOGGED BOOK </td><td> <?php echo $top_books; ?> </td></tr>
        <tr><td> MOST LOGGED ALBUM </td><td> <?php echo $top_albums; ?> </td></tr>
        <tr><td> MOST LOGGED TV SHOW </td><td> <?php echo $top_tv; ?> </td></tr>
        <tr><td> MOST LOGGED VIDEOGAME </td><td> <?php echo $top_games; ?> </td></tr>
        <tr><td> MOST LOGGED MOVIE </td><td>  <?php echo $top_movies; ?> </td></tr>
        <tr><td> MOST POPULAR USER </td><td> <?php echo $popular_users; ?> </td></tr>
      </tbody>
    </table>
  </div>
<!-- SITEWIDE STATS END -->



<!-- USER MANAGEMENT TABLE BEGINS -->
<div id="user-mgmt-table" style="display:none;">

  <?php
foreach ($userlist as $user) {
    ?>
    <div class='user-container'>
    <img class='user-pfp' src=<?php echo $user['profile_pic'] ?> >
    <div class='user-name'> <?php echo $user['user_name'] ?></div>
    <div class='user-email'> <?php echo $user['email'] ?></div>
        <div class='user-buttons'>

        <!-- <?php echo "window.location.href='delete_user_confirm.php?user_name=" . $user['user_name'] . "'" ?> -->

           <!-- View Profile Button -->
            <button class='btn btn-success' id=<?php echo $user['uid'] ?> onclick=<?php echo "window.location.href='profile.php?user_name=" . $user['user_name'] . "'" ?>
            >View Profile
            </button>


            <!-- Delete User Button -->
            <button class='btn btn-danger' id=<?php echo $user['uid'] ?> onclick=<?php echo "window.location.href='delete_user_confirm.php?user_name=" . $user['user_name'] . "'" ?>
            >Delete User
            </button>

        </div>
    </div>

    <?php
} //end of foreach
?>

</div>
<!-- USER MANAGEMENT TABLE ENDS -->





<script>
// TOGGLE VISIBILITY FOR BUTTON SITEWIDE STATS
const btnSiteStats= document.getElementById('site-stats-btn');
const siteStatsDiv= document.getElementById('site-stats-table');
btnSiteStats.onclick = function () {
if (siteStatsDiv.style.display !== "none") {
  siteStatsDiv.style.display = "none";
} else {
  //set other divs to none
  userMgmtDiv.style.display = "none";
  siteStatsDiv.style.display = "block";
}
};


// TOGGLE VISIBILITY FOR BUTTON USER MANAGEMENT
const btnUserMgmt= document.getElementById('user-management-btn');
const userMgmtDiv= document.getElementById('user-mgmt-table');
btnUserMgmt.onclick = function () {
  if (userMgmtDiv.style.display !== "none") {
    userMgmtDiv.style.display = "none";
  } else {
    //set other divs to none
    siteStatsDiv.style.display = "none";
    userMgmtDiv.style.display = "block";
  }
};
</script>
</body>
</html>