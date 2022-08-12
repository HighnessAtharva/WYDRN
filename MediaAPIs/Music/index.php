<?php
/**
 * ALLOWS USERS TO BROWSE GENERAL MUSIC
 *
 * @version    PHP 8.0.12 
 * @since      May 2022
 * @author     AtharvaShah
 */


session_start();
if (empty($_SESSION)) {
    header("Location: ../../login.php");
}
include "../../connection.php";
include "../../functions.php";
include "../header.php";
$user_data = check_login($con);
$username = $user_data['user_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album Search</title>
    <!-- font awesome icons cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <!-- custom css -->
    <link rel="stylesheet" href="main.css">
</head>

<body style="color:white">

    <div class="wrapper">
        
        <!-- search container -->
        <div class="search-container">
            <div class="search-element">
                <h3>Search Album</h3>

                <input type="text" class="form-control" placeholder="Enter Artist Name and Album Name" id="movie-search-box" onkeyup="findAlbum()" onclick="findAlbum()">
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
        </div>
        <!-- end of search container -->

        <!-- result container -->
        <div class="container">
            <div class="result-container">
                <div class="result-grid" id="result-grid">
                    <!-- movie information here -->
                </div>
            </div>
        </div>
        <!-- end of result container -->
    </div>


    <!-- movie app js -->
    <!-- <script>
        $('#movie-search-box').keyup(_.debounce(findAlbum, 500));
    </script> -->
    <script src="script.js"></script>
    <!-- <script src="https: //cdn.jsdelivr.net/npm/underscore@1.13.3/underscore-umd-min.js"></script> -->
</body>
</body>

</html>