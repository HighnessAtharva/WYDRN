<?php
/**
 * ALLOWS USERS TO BROWSE GENERAL VIDEO GAMES
 *
 * @version    PHP 8.0.12 
 * @since      May 2022
 * @author     AtharvaShah
 */


session_start();
if (empty($_SESSION)) {
    $redirect_url="../../login.php";
    header("Location: $redirect_url");  
    die();
}
include "../../connection.php";
include "../../functions.php";
include "../header.php";
$user_data = check_login($con);
$username = $user_data['user_name'];

$disabled = false;
if (getTotalVideogameCountUnique($con, $username) < 30) {
    $disabled = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Allows users to browse videogames from the web and read the info" />
    <meta name="keywords" content="WYDRN, MediaAPI Videogames " />
    <title>WYDRN - Videogame Search</title>
    <!-- font awesome icons cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <!-- custom css -->
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <div class="wrapper">
       
         <!--------------------------
             SEARCH CONTAINER
        ---------------------------->
        <div class="search-container">
            <div class="search-element">
                <input type="text" class="form-control" placeholder="Search Videogame" id="movie-search-box" onkeyup="findgame()" onclick="findgame()"  autocomplete="off">

                <div class="search-list" id="search-list">
                    <!-- list here -->
                    <!-- <div class = "search-list-item">
                        <div class = "search-item-thumbnail">
                            <img src = "medium-cover.jpg">
                        </div>
                        <div class = "search-item-info">
                            <h3>Guardians of the Galaxy Vol. 2</h3>
                            <p>2017</p>
                        </div>
                    </div> -->
                </div>
            </div>


            <!--GET VIDEOGAME RECOMMENDATIONS-->
            <div>
                <button <?php if ($disabled == true) echo 'disabled';?> class="button-29" role="button" onclick="window.location.href='../../RecommendationML/index.php?videogame'"><?php 
                if ($disabled == true) 
                    echo 'Log 30 Unique Videogames to<br>Unlock Recommendations'; 
                else 
                    echo ' Get Videogame Recommendations';
                ?></button>
            </div>
        </div>
        <!--------------------------
            END OF SEARCH CONTAINER
       ---------------------------->

        <!---------------------
        RESULT CONTAINER
        ------------------->

                <div class="result-grid" id="result-grid">
                    <!-- movie information here -->
                </div>

      <!---------------------
        END OF RESULT CONTAINER
        ------------------->
    
    
    </div><!-- end of wrapper -->


    
<script src="script.js"></script>
<script src="../../js/headerResize.js"></script>
</body>
</html>