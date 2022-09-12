<?php

/**
 * All The adminstrative functions such as member count, member deletion and member data/authorization will be displayed here.
 *
 * @version    PHP 8.0.12
 * @since      July 2022
 * @author     AtharvaShah & Anay Deshpande
 */

error_reporting(E_ERROR | E_PARSE);


require "connection.php";
require "functions.php";
session_start();

if (empty($_SESSION)) {
  header("Location: login.php");
}
$user_data = check_login($con);
$username = $user_data['user_name'];

if ($username != 'admin') {
  echo ("<img src='images/website/imposter.jpg' style='width: 100%; height: 100%;'>");
  die();
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
$sql = "SELECT `id`, `user_name`, `profile_pic`, `email`,`date`, `verified`, `active` FROM users";
$userlist = array();
if ($query = mysqli_query($con, $sql)) {
  while ($row = mysqli_fetch_assoc($query)) {
    $uid = $row['id'];
    $uname = $row["user_name"];
    $pfp = $row["profile_pic"];
    $emailadd = $row["email"];
    $date = $row["date"];
    $verified = $row["verified"];
    $active = $row["active"];
    array_push($userlist, array("uid" => $uid, "user_name" => $uname, "profile_pic" => $pfp, "email" => $emailadd, "date" => $date, "verified" => $verified, "active" => $active));
  }
} else {
  echo mysqli_error($con);
}

/*
STORE STATS DATA.
[0] -> STAT NAME,
[1] -> STAT COUNT,
[2] -> STAT ICON
*/

$data = array(
  array("Media Count", $total_media_count, "images/Icons/trophy.svg"),
  array("Users On Site Currently", $current_active_users, "images/Icons/profile.svg"),
  array("Registered Users", $total_users_count, "images/Icons/profile.svg"),
  array("Books Logged", $total_book_count, "images/Icons/Book.svg"),
  array("Movies Logged", $total_movie_count, "images/Icons/Movie.svg"),
  array("TV Shows Logged", $total_tv_count, "images/Icons/TV.svg"),
  array("Videogames Logged", $total_videogame_count, "images/Icons/Videogame.svg"),
  array("Albums Logged", $total_album_count, "images/Icons/Music.svg"),
  array("Unverified Users", $not_verified, "images/Icons/Close.svg"),
  array("Inactive Users (6 months)", $dead_accounts, "images/Icons/Close.svg"),
  array("Super Active Users", $whale_users, "images/Icons/Profile.svg"),
  array("Logged Items (Yesterday)", $total_media_added_yesterday, "images/Icons/trophy.svg"),
  array("Logged Items (Last Week)", $total_media_added_last_week, "images/Icons/trophy.svg"),
  array("Logged Items (Last Month)", $total_media_added_last_month, "images/Icons/trophy.svg"),
  array("Logged Items (Last Year)", $total_media_added_last_year, "images/Icons/trophy.svg"),
  array("Average Media Per User", $avg_media_per_user, "images/Icons/trophy.svg"),
  array("Most Logged Book", $top_books, "images/Icons/Book.svg"),
  array("Most Logged Album", $top_albums, "images/Icons/Music.svg"),
  array("Most Logged TV Show", $top_tv, "images/Icons/TV.svg"),
  array("Most Logged Videogame", $top_games, "images/Icons/Videogame.svg"),
  array("Most Logged Movie", $top_movies, "images/Icons/Movie.svg"),
  array("Most followed user", $popular_users, "images/Icons/Trophy.svg"),
);
?>

<!-------------------------------------------------------------------------------------
        HTML 
------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <title>WYDRN - Admin Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


  <!-- CSS -->
  <link rel="stylesheet" href="css/others/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="css/others/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/others/magnific-popup.css">
  <link rel="stylesheet" href="css/others/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="css/others/select2.min.css">
  <link rel="stylesheet" href="CSS/admin.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  
</head>

<body>

  <!-- BUTTON GROUPS SERVING VARIETY OF FUNCTIONS -->
  <div class="text-center" id="btn-group"><br>
    <button id='site-stats-btn' class='btn btn-primary'>Site Stats</button>
    <button id='user-management-btn' class='btn btn-primary'>Manage Users</button>
  </div>


  <!-- SITEWIDE STATS BEGINS-->


  <div id='site-stats-table' style="display:none;">

    <div class="main-container">

      <?php foreach ($data as $row) {
      ?>


        <!--STAT CARD-->
        <div class="user-box first-box">
          <div class="activity card" style="--delay: .2s">
            <div class="flex">
              <!--Stat Logo-->
              <div class="destination-profile flex-child-one">
                <img class="profile-img" src=<?php echo $row[2] ?> alt="" />
              </div>

              <!--Stat Name and Desc-->
              <div class="flex-child-two">
                <div class="title"><?php echo $row[0] ?></div>
              </div>
            </div>

            <div class="destination">
              <div class="destination-card">

                <!--Circle -->
                <div class="circle">
                  <div class="counter"><?php echo $row[1] ?></div>
                </div>

              </div>
            </div>

          </div>
        </div>
        <!--STAT CARD END-->

      <?php
      }
      ?>

      <!--Wrapper Stuff-->
    </div>

  <!-- SITEWIDE STATS END -->
  </div>


  <!-- USER MANAGEMENT TABLE BEGINS -->
  <div id="user-mgmt-table" style="display:block;">

    <!-- main content -->
    <main class="main">
      <div class="container-fluid">
        <div class="row">
          <!-- main title -->
          <div class="col-12">
            <div class="main__title">
              <h2>Users</h2>
              <span class="main__title-stat">Total <?php echo count($userlist); ?> Registered Members</span>
            </div>
          </div>
          <!-- end main title -->

          <!-- users -->
          <div class="col-12">
            <div class="main__table-wrap">
              <table class="main__table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>INFO</th>
                    <th>CREATED DATE</th>
                    <th>VERIFIED</th>
                    <th>STATUS</th>
                  </tr>
                </thead>


                <!-- 
                  "uid" => $uid, 
                  "user_name" => $uname, 
                  "profile_pic" => $pfp, 
                  "email" => $emailadd,
                  "date" => $date, 
                  "verified" => $verified, 
                  "active" => $active 
                -->

                <tbody>
                  <?php
                  foreach ($userlist as $user) {
                  ?>
                    <tr>
                      <!--User ID-->
                      <td>
                        <div class="main__table-text"><?php echo $user['uid'] ?></div>
                      </td>
                      <td>
                        <div class="main__user">
                          <!--User Profile Pic-->
                          <div class="main__avatar">
                            <img src="<?php echo $user['profile_pic'] ?>" width="50px" height="40px" alt="">
                          </div>
                          <!--Username and Email-->
                          <div class="main__meta">
                            <h3><?php echo $user['user_name'] ?></h3>
                            <span><?php echo $user['email'] ?></span>
                          </div>
                        </div>
                      </td>
                      <!--Date of Joining-->
                      <td>
                        <div class="main__table-text"><?php echo printable_date($user['date']) ?></div>
                      </td>
                      <!--User Verification Status (If 1, set text as Green otherwise set as Red-->
                      <td>
                        <?php
                        if ($user['verified'] == 1) {
                        ?>
                          <div class="main__table-text main__table-text--green">

                          <?php
                        } else {
                          ?>
                            <div class="main__table-text main__table-text--red">

                            <?php }
                          if ($user['verified'] == 1) {
                            echo "VERIFIED";
                          } else {
                            echo "NOT VERIFIED";
                          }
                            ?>
                            </div>
                      </td>
                      <!--User Active Status. If 1, show text as Green otherwise show text as Red.-->
                      <td>
                        <?php
                        if ($user['active'] == 1) {
                        ?>
                          <div class="main__table-text main__table-text--green">

                          <?php
                        } else {
                          ?>
                            <div class="main__table-text main__table-text--red">

                            <?php }
                          if ($user['active'] == 1) {
                            echo "ACTIVE";
                          } else {
                            echo "INACTIVE";
                          }
                            ?>
                            </div>
                      </td>

                      <td>
                        <!--BUTTONS-->
                        <div class="main__table-btns">
                          <!--VIEW PROFILE-->
                          <a href="profile.php?user_name=<?php echo $user['user_name'] ?>" class="main__table-btn main__table-btn--banned">
                            <i class="fa-solid fa-user"></i>
                          </a>
                          <!--VIEW STATS-->
                          <a href="stats.php?user_name=<?php echo $user['user_name'] ?>" class="main__table-btn main__table-btn--edit">
                            <i class="fa-solid fa-chart-simple"></i>
                          </a>
                          <!--DELETE USER-->
                          <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                            <i class="fa-solid fa-trash"></i>
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php
                  } //end of foreach
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end users -->

        </div>
      </div>
    </main>
    <!-- end main content -->



    <!-- modal delete -->
    <div id="modal-delete" class="zoom-anim-dialog mfp-hide modal">
      <h6 class="modal__title">User delete</h6>
      <p class="modal__text">Are you sure to permanently delete this user?</p>
      <div class="modal__btns">
        <button class="modal__btn modal__btn--apply" onclick=<?php echo "window.location.href='delete_user_confirm.php?user_name=" . $user['user_name'] . "'" ?> type="button">Delete</button>
        <button class="modal__btn modal__btn--dismiss" type="button">Dismiss</button>
      </div>
    </div>
    <!-- end modal delete -->
  </div>
  <!-- USER MANAGEMENT TABLE ENDS -->



  <!-------------------------------------------------------------------------------------
JAVASCRIPT 
------------------------------------------------------------------------------------->
  <script>
    // TOGGLE VISIBILITY FOR BUTTON SITEWIDE STATS
    const btnSiteStats = document.getElementById('site-stats-btn');
    const siteStatsDiv = document.getElementById('site-stats-table');

    btnSiteStats.onclick = function() {
      if (siteStatsDiv.style.display !== "none") {
        siteStatsDiv.style.display = "none";
      } else {
        //set other divs to none
        userMgmtDiv.style.display = "none";
        siteStatsDiv.style.display = "block";
      }
    };


    // TOGGLE VISIBILITY FOR BUTTON USER MANAGEMENT
    const btnUserMgmt = document.getElementById('user-management-btn');
    const userMgmtDiv = document.getElementById('user-mgmt-table');
    btnUserMgmt.onclick = function() {
      if (userMgmtDiv.style.display !== "none") {
        userMgmtDiv.style.display = "none";
      } else {
        //set other divs to none
        siteStatsDiv.style.display = "none";
        userMgmtDiv.style.display = "block";
      }
    };
  </script>


  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.mousewheel.min.js"></script>
  <script src="js/jquery.mCustomScrollbar.min.js"></script>
  <script src="js/select2.min.js"></script>
  <script src="js/utility.js"></script>
</body>

</html>