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
$user_data = check_login($con);
$username = $user_data['user_name'];
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
        $response = "https://www.prokerala.com/movies/assets/img/no-poster-available.jpg";
    }
    else {
        $response = $response['results'][0]['background_image'];
    }
    return $response;
    
}
?>


<html>
<head>
<!--Bootstrap Link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<!--Custom Link-->
<link rel="stylesheet" href="CSS/media_videogame.css">


</head>
<body>

<div class="heading">
  <h1>Your Video Games<span>"Praise the sun." - Dark Souls</span></h1>
</div>

<?php
    $html_game="<br><br><section class='cards-wrapper'>"; // $html_game stores the html code for the movie cards
    
    $sql = "SELECT DISTINCT `videogame`, `platform`, `date` FROM `data` where videogame != '' and username='$username' order by `date` DESC";
    if ($query = mysqli_query($con, $sql)) {
        $totalgamecount=mysqli_num_rows($query);
        if ($totalgamecount > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $game=$row['videogame'];
                $platform=$row['platform'];
                $game_logged=date("F jS, Y", strtotime($row['date']));

               
                $stripgame=str_replace(' ', '+', $game);
                

                // one single div tag for each movie
                $html_game.="<div class='card-grid-space'>";
                    // image tag for the movie
                    $html_game.="<div class='card' style='background-image:url(";
                    $html_game.= getposterpath($stripgame);  // get the poster path from the api
                    $html_game.=")'";
                    $html_game.=">";
                
                    $html_game.="<div>"; 
                    $html_game.="<div class='logged-date'>". $game_logged ."</div>"; 
                    $html_game.="</div>";  // end of div for the movie name


                    $html_game.="</div>"; // end of card

                    $html_game.="<h1 class='moviename'>". $game."</h1>";
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
    mysqli_close($con);
?>
<body>
</html>