<?php


/**
 * SHOWS NON-DUPLICATE VIDEO GAMES LOGGED BY THE USER IN A GRID/GALLERY FORM. ON HOVERING ON AN ITEM THE DATE OF LOGGING IS DISPLAYED.  
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "header.php";
require "connection.php";
require "functions.php";
require "quotes.php"; //to get a random quote
$user_data = check_login($con);
$username = $user_data['user_name'];

// flush();
// ob_flush();
function getposterpath($name)
{
    $api_key = "fe197746ce494b4791441d9a9161c1be";
    $url = 'https://api.rawg.io/api/games?search=' . $name . '&key=' . $api_key;
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);

    if (empty($response['results'][0]['background_image'])) {
        $response = "images/API/WYDRNgame.png";
    } else {
        $response = $response['results'][0]['background_image'];
    }
    return $response;
}
?>

<!-------------------------------------------------------------------------------------
                        HTML PART
------------------------------------------------------------------------------------->
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WYDRN - Your Video Games</title>

    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!--Custom Link-->
    <link rel="stylesheet" href="CSS/media_videogame.css">

    <!--Preloader Links-->
    <link rel="stylesheet" href="css/preloader.css">

    <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">
    
    <script src="js/modernizr-2.6.2.min.js"></script>

    <!--PRELOADER JS-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')
    </script>
    <script>
        $(document).ready(function() {

            setTimeout(function() {
                $('body').addClass('loaded');
                $('h1').css('color', '#222222');
            }, 1000);

        });
    </script>
</head>

<body class="css-selector">
    <div>
        <!--PRELOADER-->
        <header class="entry-header">
            <h1 class="entry-title"></h1>
        </header>
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <!--END OF PRELOADER-->

        <!--ALL MEDIA ITEMS THAT WILL APPEAR AFTER PRELOADER-->
        <div id="content">
            <div class="heading">
                <h1>Your Video Games<span><?php echo getRandomVideoGameQuote(); ?> </span></h1>
            </div>

            <div class="flex">
            <!-- Sorting Functionality -->
            <form method="get" action="" name="sort">
                <select name="sortby" id="sort-by-select" onchange="this.form.submit()">
                    <option value="">Sort By</option>

                    <option value="added-desc">Added Date (Newest To Oldest)</option>
                    <option value="added-asc">Added Date (Oldest To Newest)</option>


                    <option value="alphabetic-asc">Videogame (A-Z)</option>
                    <option value="alphabetic-desc">Videogame (Z-A)</option>

                    <option value="platform-asc">Platform (A-Z)</option>
                    <option value="platform-desc">Platform(Z-A)</option>

                </select>
            </form>

            <button class="btn" onclick="window.location.href='media_list_view.php?videogame'"><img src="images/Icons/list-view.png"></button>
    </div>

            <!-------------------------------------------------------------------------------------
                         DYNAMICALLY GENERATED PHP PART 
------------------------------------------------------------------------------------->

            <?php

            //set default sort order
            $sortby = "added-desc";
            $sorting = "`date`"; //default sorting is by added date;  
            $order = "DESC"; //default order is newest to oldest  

            // default sorting is by added date;
            if (isset($_GET["sortby"])) {
                $sortby = $_GET["sortby"];


                /***************  SORT BY DATE OF LOGGING ***********/
                // Newest To Oldest
                if ($sortby == "added-desc") {
                    $sorting = "`date`";
                    $order = "DESC";
                }

                //Oldest to Newest
                else if ($sortby == "added-asc") {
                    $sorting = "`date`";
                    $order = "ASC";
                }

                /***************  SORT BY VIDEOGAME NAME ***********/
                //A-Z
                else if ($sortby == "alphabetic-asc") {
                    $sorting = "`videogame`";
                    $order = "ASC";
                }
                // Z-A
                else if ($sortby == "alphabetic-desc") {
                    $sorting = "`videogame`";
                    $order = "DESC";
                }

                /***************  SORT BY GAMING PLATFORM***********/
                //A-Z
                else if ($sortby == "platform-asc") {
                    $sorting = "`platform`";
                    $order = "ASC";
                }
                //Z-A
                else if ($sortby == "platform-desc") {
                    $sorting = "`platform`";
                    $order = "DESC";
                }
            } //end of if isset($_GET["sortby"])


            // Number of entries to show in a page.
            $per_page_record = 9;

            // Look for a GET variable page if not found default is 1.
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            } else {
                $page = 1;
            }
            $start_from = ($page - 1) * $per_page_record;

            $html_game = "<br><br><section class='cards-wrapper'>"; // $html_game stores the html code for the movie cards

            //only select unique videogames logged by the user
            $sql = "SELECT `videogame`, `platform`, `date` FROM `data` where videogame != '' and username='$username' GROUP BY `videogame` order by " . $sorting . " " . $order . " LIMIT $start_from, $per_page_record;";
            if ($query = mysqli_query($con, $sql)) {
                $totalgamecount = mysqli_num_rows($query);
                if ($totalgamecount > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $game = $row['videogame'];
                        $platform = $row['platform'];
                        $game_logged = date("F jS, Y", strtotime($row['date']));
                        $stripgame = str_replace(' ', '+', $game);


                        /**if poster is not downloaded, download the poster in the directory and show the image*/

                        //remove special characters since we are using it as a file name
                        $filename = preg_replace('/[^A-Za-z0-9\-]/', '', $stripgame);
                        $pseudo_poster = 'images/API/game-' . $filename . '.jpg';
                        if (file_exists($pseudo_poster)) {
                            $posterpath = $pseudo_poster;
                        } else {
                            $posterpath = getposterpath($stripgame); // URL to download file from
                            $img = 'images/API/game-' . $filename . '.jpg'; // Image path to save downloaded image
                            // Save image 
                            file_put_contents($img, file_get_contents($posterpath));
                        }

                        // one single div tag for each movie
                        $html_game .= "<div class='card-grid-space'>";

                        // image tag for the movie
                        $html_game .= "<div class='card' style='background-image:url(";
                        $html_game .= $posterpath;  // get the poster path from the api
                        $html_game .= ")'";
                        $html_game .= ">";

                        $html_game .= "<div>";
                        $html_game .= "<div class='logged-date'>" . $game_logged . "</div>";
                        $html_game .= "</div>";  // end of div for the movie name

                        $html_game .= "</div>"; // end of card

                        $html_game .= "<h1 class='moviename'>" . $game . "</h1>";
                        $html_game .= "<div class='tags'>"; // div for the tags
                        $html_game .= "<div class='tag'>" . $platform . "</div>";
                        $html_game .= "</div>"; // end of tags
                        $html_game .= "</div>"; //end of card-grid-space
                    }
                } else {

                    //NO VIDEOGAMES LOGGED MESSAGE
                    $GamesNotAdded= "<center><div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'><img src='images/Icons/Videogame.svg' width='15' height='15' class='media-icon'>No Videogames added to your account.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></center>";
                    echo $GamesNotAdded;
                }
            }
            $html_game .= "</section>";
            echo $html_game;
            ?>

            <!-------------------------------------------------------------------------------------
                                PAGINATION
------------------------------------------------------------------------------------->
            <center>
                <div class="pagination">
                    <?php
                    $query = "SELECT DISTINCT count(DISTINCT `videogame`) FROM `data` where videogame != '' and username='$username'";
                    $rs_result = mysqli_query($con, $query);
                    $row = mysqli_fetch_row($rs_result);
                    $total_records = $row[0];

                    echo "</br>";
                    // CALCULATING THE NUMBER OF PAGES
                    $total_pages = ceil($total_records / $per_page_record);
                    $pageLink = "";

                    // SHOW PREVIOUS BUTTON IF NOT ON PAGE 1
                    if ($page >= 2) {
                        echo "<a href='media_videogame.php?sortby=" . $sortby . "&page=" . ($page - 1) . "'> <span class='neonText'> ← </span> </a>";
                    }

                    // SHOW THE LINKS TO EACH PAGE IN THE PAGINATION GRID 
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $page) {
                            $pageLink .= "<a class = 'active' href='media_videogame.php?page="
                                . $i . "'>" . $i . " </a>";
                        } else {
                            $pageLink .= "<a href='media_videogame.php?sortby=" . $sortby . "&page=" . $i . "'>" . $i . " </a>";
                        }
                    }
                    echo $pageLink;

                    // SHOW NEXT BUTTON IF NOT ON LAST PAGE
                    if ($page < $total_pages) {
                        echo "<a href='media_videogame.php?sortby=" . $sortby . "&page=" . ($page + 1) . "'>  <span class='neonText'> → </span> </a>";
                    }
                    ?>

                </div>
                <!--END OF PAGINATION ROW -->
        </div>
        <!--END OF MEDIA CONTENT -->

    </div>
    <!---END OF ENTIRE DOCUMENT (PRELOADER + MEDIA CONTENT) -->
    </center>

    <body>

</html>
<?php mysqli_close($con); ?>