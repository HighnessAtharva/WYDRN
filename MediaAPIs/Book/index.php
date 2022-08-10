<?php
/**
 * ALLOWS USERS TO BROWSE GENERAL BOOKS
 *
 * @version    PHP 8.0.12 
 * @since      May 2022
 * @author     AtharvaShah
 */


session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
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
    <title>Book Search</title>
    <!-- font awesome icons cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <!-- custom css -->
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <div class="wrapper">
        
        <!-- search container -->
        <div class="search-container">
            <div class="search-element">
                <h3>Search Book</h3>

                <input type="text" class="form-control" placeholder="Enter Book Name and Author's name" id="movie-search-box" onkeyup="findBook()" onclick="findBook()">
                <div class="search-list" id="search-list">
                    <!--  Dynamically generated LIST APPEARS IN THIS MANNER -->
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


   
<script src="script.js"></script>
</body>
</body>
</html>