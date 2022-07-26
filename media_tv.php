<?php


/**
 * SHOWS NON-DUPLICATE TV SHOWS LOGGED BY THE USER IN A GRID/GALLERY FORM. ON HOVERING ON AN ITEM THE DATE OF LOGGING IS DISPLAYED.  
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
    $api_key="e446bc89015229cf337e16b0849d506c";
    $url = 'https://api.themoviedb.org/3/search/tv?api_key='.$api_key.'&query='.$name.'&include_adult=true';
   
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);
    $response=json_decode($response,true);
    curl_close($curl);
    
    if (empty($response['results'][0]['poster_path'])) {
        $response = "https://www.prokerala.com/movies/assets/img/no-poster-available.jpg";
    }
    else {
        $response = "https://image.tmdb.org/t/p/w300".$response['results'][0]['poster_path'];
    }
    return $response;
    
}
?>


<html>
<head>
<!--Bootstrap Link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!--Custom Link-->
<link rel="stylesheet" href="CSS/media_tv.css">
</head>
<body>

<div class="heading">
  <h1>Your TV Shows<span>"There is ugliness in this world. Disarray. I choose to see the beauty." - Westworld</span></h1>
</div>

<?php
$html_tv="<br><br><section class='cards-wrapper'>"; // $html_tv stores the html code for the movie cards
    
$sql = "SELECT DISTINCT `tv`, `streaming`, `date` FROM `data` where tv != '' and username='$username' order by `date` DESC";
if ($query = mysqli_query($con, $sql)) {
    $totaltvcount=mysqli_num_rows($query);
    if ($totaltvcount > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $tvname=$row['tv'];
            $platform=$row['streaming'];
            $tv_logged=date("F jS, Y", strtotime($row['date']));

           
            $stripnametv=$stripped = str_replace(' ', '+', $tvname);
            

            // one single div tag for each movie
            $html_tv.="<div class='card-grid-space'>";
                // image tag for the movie
                $html_tv.="<div class='card' style='background-image:url(";
                $html_tv.= getposterpath($stripnametv);  // get the poster path from the api
                $html_tv.=")'";
                $html_tv.=">";
            
                $html_tv.="<div>"; 
                $html_tv.="<div class='logged-date'>". $tv_logged ."</div>"; 
                $html_tv.="</div>";  // end of div for the movie name


                $html_tv.="</div>"; // end of card

                $html_tv.="<h1 class='moviename'>". $tvname."</h1>";
                $html_tv.="<div class='tags'>"; // div for the tags
                $html_tv.="<div class='tag'>". $platform."</div>";
                $html_tv.="</div>"; // end of tags
                $html_tv.="</div>"; //end of card-grid-space

        }
    }else{
        $html_tv.="No TV shows Logged";
    }
}

$html_tv.="</section>";
echo $html_tv;
mysqli_close($con);
?>
<body>
</html>