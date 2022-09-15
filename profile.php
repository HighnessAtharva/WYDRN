<?php

/**
 *  THE MAIN PROFILE PAGE OF  THE USER. THE MOST IMPORTANT PAGE TO THIS PROJECT.
 * CHECKS IF USER HAS LOGGED IN AND GRABS THE USERNAME FROM THE DATABASE. IF THE USERNAME IS MENTIONED IN THE URL ADDRESS, THE USERNAME IS GRABBED USING A "GET" REQUEST AND THE USER DATA CORRESPONDING TO THE USERNAME IS GRABBED FROM THE DATABASE. (MAY BE THE SAME USER OR MAY BE A PUBLIC PROFILE URL OF ANOTHER USER)
 * THIS FILE requireS THE DEPENDENCY - WYDRN.PHP
 *
 * @version    PHP 8.0.12
 * @since      July 2022
 * @author     AtharvaShah
 */



session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}

require "connection.php";
require "functions.php";

$user_data = check_login($con);
if (isset($_GET['user_name'])) {
    $username = mysqli_real_escape_string($con, $_GET['user_name']);
} else {
    $username = $user_data['user_name'];
    set_active($username);
}

// profile pic and background pic
$sql = "SELECT profile_pic, background_pic FROM users WHERE user_name='$username'";
if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) == 1) {
        $row = mysqli_fetch_array($query);
        $profile_pic = $row['profile_pic'];
        $background_pic = $row['background_pic'];
    } else {
        header('Location: http://localhost/WYDRN/ErrorPages/404.html');
    }
}

// get total followers count
$sql = "SELECT COUNT(follower_username) FROM `social` where `followed_username`='$username'";
if ($query = mysqli_query($con, $sql)) {
    $row = mysqli_fetch_array($query);
    $total_followers = $row[0];
} else {
    echo mysqli_error($con);
}

// get total following count
$sql = "SELECT COUNT(followed_username) FROM `social` where `follower_username`='$username'";
if ($query = mysqli_query($con, $sql)) {
    $row = mysqli_fetch_array($query);
    $total_following = $row[0];
} else {
    echo mysqli_error($con);
}

//profile.php?user_name=xyz -  get total media count for get request
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
if ($query = mysqli_query($con, $sql)) {
    $row = mysqli_fetch_array($query);
    $total_count_get = $row[0];
} else {
    echo mysqli_error($con);
}

//profile.php - get total media count for post request 
$sql2 = "SELECT sum(allcount) AS Total_Count FROM(
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

if ($query = mysqli_query($con, $sql2)) {
    $row = mysqli_fetch_array($query);
    $total_count_post = $row[0];
} else {
    echo mysqli_error($con);
}


?>


<!----------------------------------------------------------------------
                      HTML PART
------------------------------------------------------------------------>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WYDRN - Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link href="CSS/profile.css" rel="stylesheet">


</head>

<body>

    <div class="shadow overflow" style="position:relative;">
    <?php require "header4profile.php"; ?>

        <!----------------
	Background Image
	------------------>
        <div id="header" style="background-image:url(<?php echo $background_pic ?>)" alt="Background Image">

            <!--Content that appears on hovering on the banner pic-->
            <div class="hide">

                <!--MEMBER SINCE-->
                <div class="join-date">
                    <img src="images/Icons/since.png" class="since-icon" title="Member Since">
                    <span><?php echo getDateofJoining($con, $username); ?> </span>
                </div>

                <!--VIEW STATS-->
                <div class="stats-text">
                    <a href="stats.php?user_name=<?php echo $username ?>">
                        <span>Stats</span>
                        <img src="images/Icons/stats.png" class="stats-icon" title="View Stats">
                    </a>
                </div>

            </div>
        </div>

        <div id="profile">

            <!----------------
			Profile Pic
			------------------>
            <div class="image"><img src="<?php echo $profile_pic ?>" alt="Profile Picture"></div>


            <!----------------
			Username
			------------------>
            <span id="user-font"><?php echo $username ?></span>


            <!----------------
			Clear Icon
			------------------>
            <span data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <!-- Hide this if a GET request is made but username is not matching to logged in person-->
                <span <?php
                        if (isset($_GET['user_name'])) {
                            if ($_GET['user_name'] != $user_data['user_name']) {
                                echo "hidden";
                            }
                        } ?>><img src="images/icons/clear.svg" title="Clear Profile" class="clear-icon"></span>
            </span>

            <!----------------
			Badge Icon
			------------------>
            <?php
            //when visiting other users profile display badge icon with link to THEIR badge page (badge.php?user_name=xyz)
            if (isset($_GET['user_name'])) {
                $badgefor = $_GET['user_name'];
            ?>

                <a href="badges.php?user_name=<?php echo $badgefor; ?>">
                    <img src="images/Icons/badges.gif" class="badge-gif" alt="Badges" title="Badges">
                </a>

            <?php }

            // by default when user_name GET request is not set display badge icon with link to standard badges.php page 
            else { ?>
                <a href="badges.php">
                    <img src="images/Icons/badges.gif" class="badge-gif" alt="Badges">
                </a>
            <?php }
            ?>

            <!-- Modal for Clear Activity Confirmation-->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Clear Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="alert-danger alert"> Are you sure you want to clear your current profile activity?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" onclick="window.location.href='clear.php'" class="btn btn-danger">Yes</button>
                        </div>
                    </div>
                </div>
            </div>


            <!----------------
			Follow/Unfollow Button based on state change
            

            HERE COMPLEX LOGIC IS USED FOR THE ANCHOR TAG
            - If the user is visiting his own profile, the anchor tag is not displayed.
            - If the user is visiting another users profile, the anchor tag is displayed.
            - If the user is not following another user, the anchor tag is displayed with the text "Follow"
            - If the user is already following another user, the anchor tag is displayed with the text "Unfollow"
 
		    ------------------>
            <span>
                <a style="color:black" href="follow.php?user_name=<?php
                                                                    if (isset($_GET['user_name'])) {
                                                                        if ($_GET['user_name'] != $user_data['user_name']) {
                                                                            echo $_GET['user_name'];
                                                                        }
                                                                    }
                                                                    ?>" <?php
                                                                        if (!isset($_GET['user_name'])) {
                                                                            echo 'hidden';
                                                                        }

                                                                        if (isset($_GET['user_name'])) {
                                                                            if ($_GET['user_name'] == $user_data['user_name']) {
                                                                                echo 'hidden';
                                                                            }
                                                                        }

                                                                        if (!isset($_POST)) {
                                                                            echo 'hidden';
                                                                        }
                                                                        ?>>
                    <!--THE CONTENT OF THE A TAG GOES HERE [FOLLOW/UNFOLLOW] DEPENDING ON WHETHER A USER IS ALREADY FOLLOWING A PERSON OR NOT.-->
                    <?php
                    $user_data = check_login($con);
                    $username = $user_data['user_name'];
                    $sql = "SELECT `followed_username` FROM `social` WHERE `follower_username`='$username' and `followed_username`='$_GET[user_name]'";
                    if ($query = mysqli_query($con, $sql)) {
                        $result = mysqli_num_rows($query);
                        if ($result == 0) {
                            // echo "Follow";
                            echo "<img src='images/icons/follow.svg' class='follow-icon' title='Follow User'>";
                        } else {
                            // echo "Unfollow";
                            echo "<img src='images/icons/unfollow.svg' class='unfollow-icon' title='Unfollow User'>";
                        }
                    }
                    ?>
                </a>
            </span>

            <div class="content">
                <div class="data">
                    <ul>
                        <!--Total Media Added (on logged in user profile)/Mutual Count (on other users profile)-->
                        <li id="myCount">

                            <!----------------
			Total Media Count
			------------------>
                            <?php
                            // ADDED MEDIA COUNT - GET REQUEST (on logged in user profile)
                            if (isset($_GET['user_name'])) {
                                if ($_GET['user_name'] == $user_data['user_name']) {
                                    echo $total_count_get;
                                }
                            }
                            ?>

                            <?php
                            // ADDED MEDIA COUNT - POST REQUEST (on logged in user profile)
                            if (!isset($_GET['user_name'])) {
                                echo $total_count_post;
                            }
                            ?>

                            <!----------------
			Mutual Media Count
			------------------>
                            <?php
                            // MUTUAL MEDIA COUNT - GET REQUEST (on other users profile)
                            if (isset($_GET['user_name'])) {
                                $otheruser = $_GET['user_name'];
                                $me = $user_data['user_name'];
                                if ($otheruser != $me) {
                                    echo (get_mutual_media_count($me, $otheruser)[5]);
                                }
                            }
                            ?>

                            <span>
                                <?php
                                // MUTUAL MEDIA 
                                if (isset($_GET['user_name'])) {
                                    echo ("<a href='mutual_view.php?user_name=" . $_GET['user_name'] . "' style='color:black'");
                                    if ($_GET['user_name'] == $user_data['user_name'])
                                        echo ("hidden");
                                    echo (">Mutual Media</a>");
                                }
                                ?>

                                <?php
                                // ADDED MEDIA
                                if (isset($_GET['user_name'])) {
                                    if ($_GET['user_name'] == $user_data['user_name'])
                                        echo ("<a style='color:black'>Added Media</a>");
                                }
                                if (!isset($_GET['user_name'])) {
                                    echo ("<a style='color:black'>Added Media</a>");
                                }
                                ?>
                            </span>
                        </li>

                        <!----------------
			FOLLOWERS COUNT
			------------------>
                        <li> <a href="followers.php?user_name=<?php
                                                                    if (isset($_GET['user_name'])) {
                                                                        echo $_GET['user_name'];
                                                                    } else {
                                                                        echo $username;
                                                                    }
                                                                    ?>" style="color:black">
                            <?php echo $total_followers; ?>
                           <span>Followers</span></a>
                        </li>

                        <!----------------
			FOLLOWING COUNT
			------------------>
                        <li>
                        <a href="following.php?user_name=<?php
                                                                    if (isset($_GET['user_name'])) {
                                                                        echo $_GET['user_name'];
                                                                    } else {
                                                                        echo $username;
                                                                    } ?>" style="color:black"><?php echo $total_following; ?>
                            <span>Following</span></a>
                        </li>

                    </ul>
                    <!--End of Follower, Following and Media Count Grid-->



                    </div>
            <!--End of content-->
                </div>
                <!--End of data-->
           


            <!----------------------------------------------------------------
	Videogame, Album, Book, Movie and TV will be below here.
------------------------------------------------------------------>
            <div name="activity" id="activity">
                <?php require "WYDRN.php"; ?>
            </div>

          

        </div> <!-- This DIV is the end of the bottom half of the card. White Section-->
    </div> <!-- This DIV is the end of the entire card-->



    <?php mysqli_close($con); ?>



    <!----------------------------------------------------------------------
                       JAVASCRIPT PART
------------------------------------------------------------------------>

    <script>
        //  To prevent form resubmission when page is refreshed (F5 / CTRL+R)
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>