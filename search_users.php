<?php

/**
 * USERS CAN SEARCH FOR OTHER USERS BY USERNAME AND VISIT THEIR PROFILE.
 *
 * @version    PHP 8.0.12 
 * @since      May 2022
 * @author     AtharvaShah
 */


session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}

require "header.php";

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title> WYDRN - Search Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">
    
    <link rel="stylesheet" href="CSS/search_users.css">

    <!--JQUERY-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>


<body>

<!--title-->
<div class="heading">
  <h1>Search Users<span>Find friendlies with the best tastes.</span></h1>
</div>

<!----------------------------
        FLEX COLUMNS
------------------------------->
<div class="columns">
    
    <!----------------------------
        Top 10 Most Followed users
    ------------------------------->
    <div class="column" id="most-followed-div">
        
    <article class="leaderboard column">
        <header>
        <?php echo file_get_contents("images/icons/trophy.svg"); ?>
        <h1 class="leaderboard__title"><span class="leaderboard__title--top">WYDRN</span>
        <span class="leaderboard__title--bottom">Most Followed Users</span></h1>
        </header>
    </article>
            
    <main class="leaderboard__profiles">
    <?php
        // Get the top 10 most followed users.
        $sql="SELECT `followed_username` as `user_name`, COUNT(*) as `follower_count` from social GROUP BY `followed_username` ORDER BY `follower_count` desc  limit 10";
        $query = mysqli_query($con, $sql);
        if (mysqli_num_rows($query) > 0) {
            for ($i = 1; $i <=mysqli_num_rows($query); $i++) {
                $row[$i] = mysqli_fetch_array($query);
                $username = $row[$i]['user_name'];
                $follower_count = $row[$i]['follower_count'];
    ?>
            <!--HTML CONTENTS-->
            <a href=<?php echo "profile.php?user_name=".$username; ?>> 
            <article class="leaderboard__profile">
            <img src="images/website/assets/numbers/<?php echo $i;?>.png" alt="" class="leaderboard__picture">
            <span class="leaderboard__name"><?php echo $username;?></span>
            <span class="leaderboard__value"><?php echo $follower_count; ?> </span>
            </article>
            </a>
                        
                            
        <?php
            }
        }
        ?>
    </main>
    </div>
   


    <!----------------------------
       Search Box
    ------------------------------->


    <div class="column" id='search-div'>
            <center>
            <input type="text" id="search" placeholder="Search for users" autocomplete="off"/>
            <!-- Suggestions will be displayed in below div. -->
            <div id="display"></div>
            </center>
    </div>
 



    <!----------------------------
    Top 10 Users with most logged items 
    ------------------------------->
    <div class="column" id="most-active-div">
        <article class="leaderboard column">
  <header>

  <?php echo file_get_contents("images/icons/trophy.svg"); ?>

    <h1 class="leaderboard__title"><span class="leaderboard__title--top">WYDRN</span><span class="leaderboard__title--bottom">Most Active Users</span></h1>
  </header>
    </article>

    <main class="leaderboard__profiles">
            <?php
            // Get the top 10 most followed users.
            $sql="SELECT sum(allcount) as media_count, username  FROM(
                (SELECT username, count(`videogame`) as allcount FROM `data` WHERE videogame!=''  GROUP BY username)
                UNION ALL
                (SELECT username, count(album) AS allcount FROM `data` WHERE album!=''  GROUP BY username)
                UNION ALL
                (SELECT username, count(book) AS allcount FROM `data` WHERE book!=''  GROUP BY username)
                UNION ALL
                (SELECT username, count(movie) AS allcount FROM `data` WHERE movie!='' GROUP BY username)
                UNION ALL
                (SELECT username, count(tv) AS allcount FROM `data` WHERE tv!=''  GROUP BY username)
            )t group by username ORDER BY media_count DESC LIMIT 10;";
            $query = mysqli_query($con, $sql);
            if (mysqli_num_rows($query) > 0) {
                for ($i = 1; $i <=mysqli_num_rows($query); $i++) {
                    $row[$i] = mysqli_fetch_array($query);
                    
                    // $pfp=$row[$i]['profile_pic'];
                    $username = $row[$i]['username'];
                    $media_count = $row[$i]['media_count'];

            ?>

                    <a href=<?php echo "profile.php?user_name=".$username; ?>> 
                    <article class="leaderboard__profile">
                    <img src="images/website/assets/numbers/<?php echo $i;?>.png"  alt="" class="leaderboard__picture">
                    <span class="leaderboard__name"><?php echo $username;?></span>
                    <span class="leaderboard__value"><?php echo $media_count; ?> </span>
                    </article>
                    </a>

                      
            <?php
                }
            }
            ?>
        </main>
    </div>

<!-------------------------------------------------------------------------------------
                            JAVASCRIPT PART
------------------------------------------------------------------------------------->
<script>
    //function fill()
    function fill(Value) {
    $('#search').val(Value);
    $('#display').hide();
    }

    //Jquery for AJAX
    $(document).ready(function() {
    $("#search").keyup(function() {
        var name = $('#search').val();
        if (name == "") {
            $("#display").html("No Results Found");
        }

        else {

            $.ajax({
                type: "POST",
                url: "search_users_ajax.php",
                data: {
                    search: name
                },
                success: function(html) {
                    $("#display").html(html).show();
                }
            });
        }
    });
    });
</script>
</body>
</html>
