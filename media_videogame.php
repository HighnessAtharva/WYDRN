<?php


/**
 * SHOWS NON-DUPLICATE VIDEO GAMES LOGGED BY THE USER IN A GRID/GALLERY FORM. ON HOVERING ON AN ITEM THE DATE OF LOGGING IS DISPLAYED.  
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     AtharvaShah
 */

/*****  CACHING IMAGES********/
/* session_cache_limiter('none'); 
 header('Cache-control: max-age='.(60*60*24*365));
 header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*365));
 
 if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
     header('HTTP/1.1 304 Not Modified');
     die();
  }
*/
 
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "header.php";
require "connection.php";
require "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];

flush(); 
ob_flush();
function getposterpath($name){
    $api_key="fe197746ce494b4791441d9a9161c1be";
    $url = 'https://api.rawg.io/api/games?search='.$name.'&key='.$api_key;
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);
    $response=json_decode($response,true);
    curl_close($curl);
    
    if (empty($response['results'][0]['background_image'])) {
        $response = "images/API/WYDRNgame.png";
    }
    else {
        $response = $response['results'][0]['background_image'];
    }
    return $response;
    
}
?>


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


</head>
<body class="css-selector">

<div class="heading">
  <h1>Your Video Games<span>"Praise the sun." - Dark Souls</span></h1>
</div>

<?php
  $per_page_record = 8; // Number of entries to show in a page.
  // Look for a GET variable page if not found default is 1.
  if (isset($_GET["page"])) {
      $page = $_GET["page"];
  } else {
      $page = 1;
  }
  $start_from = ($page - 1) * $per_page_record;

    $html_game="<br><br><section class='cards-wrapper'>"; // $html_game stores the html code for the movie cards
    
    $sql = "SELECT DISTINCT `videogame`, `platform`, `date` FROM `data` where videogame != '' and username='$username' order by `date` DESC LIMIT $start_from, $per_page_record;";
    if ($query = mysqli_query($con, $sql)) {
        $totalgamecount=mysqli_num_rows($query);
        if ($totalgamecount > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $game=$row['videogame'];
                $platform=$row['platform'];
                $game_logged=date("F jS, Y", strtotime($row['date']));

               
                $stripgame=str_replace(' ', '+', $game);
                

                
            /**if poster is not downloaded, download the poster in the directory and show the image*/
            $pseudo_poster='images/API/game-'.$stripgame.'.jpg';
            if (file_exists($pseudo_poster)) {
                $posterpath=$pseudo_poster;
            }
            else {
                $posterpath = getposterpath($stripgame); // URL to download file from
                $img = 'images/API/game-'.$stripgame.'.jpg'; // Image path to save downloaded image
                // Save image 
                file_put_contents($img, file_get_contents($posterpath));
                
            }
         

                // one single div tag for each movie
                $html_game.="<div class='card-grid-space'>";
                    // image tag for the movie
                    $html_game.="<div class='card' style='background-image:url(";
                    $html_game.= $posterpath;  // get the poster path from the api
                    $html_game.=")'";
                    $html_game.=">";
                
                    $html_game.="<div>"; 
                    $html_game.="<div class='logged-date'>". $game_logged ."</div>"; 
                    $html_game.="</div>";  // end of div for the movie name


                    $html_game.="</div>"; // end of card

                    $html_game.="<h1 class='moviename'><b>". $game."</b></h1>";
                    $html_game.="<div class='tags'>"; // div for the tags
                    $html_game.="<div class='tag'>". $platform."</div>";
                    $html_game.="</div>"; // end of tags
                    $html_game.="</div>"; //end of card-grid-space

            }
        }else{
            $html_game.="No Videogames Logged";
        }
}
    
    $html_game.="</section>";
    echo $html_game;
    
?>

<!--PAGINATION ROW -->
<center>
 <div class="pagination">
        <?php
        $query="SELECT DISTINCT count(DISTINCT `videogame`) FROM `data` where videogame != '' and username='$username'";
        $rs_result = mysqli_query($con, $query);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        echo "</br>";
        // CALCULATING THE NUMBER OF PAGES
        $total_pages = ceil($total_records / $per_page_record);
        $pageLink = "";

        // SHOW PREVIOUS BUTTON IF NOT ON PAGE 1
        if ($page >= 2) {
            echo "<a href='media_videogame.php?page=" . ($page - 1) . "'> <span class='neonText'> ← </span> </a>";
        }

        // SHOW THE LINKS TO EACH PAGE IN THE PAGINATION GRID 
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pageLink .= "<a class = 'active' href='media_videogame.php?page="
                    . $i . "'>" . $i . " </a>";
            } else {
                $pageLink .= "<a href='media_videogame.php?page=" . $i . "'>" . $i . " </a>";
            }
        }
        echo $pageLink;

        // SHOW NEXT BUTTON IF NOT ON LAST PAGE
        if ($page < $total_pages) {
            echo "<a href='media_videogame.php?page=" . ($page + 1) . "'>  <span class='neonText'> → </span> </a>";
        }
        ?>
    </div><!--END OF PAGINATION ROW -->
</center>
<body>
</html>
<?php  mysqli_close($con);?>