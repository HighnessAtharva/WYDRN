<?php
include "connection.php";
include "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];

function getposterpath($name, $year){
    $api_key="e446bc89015229cf337e16b0849d506c";
    $url = 'https://api.themoviedb.org/3/search/movie?api_key='.$api_key.'&query='.$name.'&year='.$year.'&include_adult=true';
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);
    $response=json_decode($response,true);
    curl_close($curl);
    
    if (empty($response['results'][0]['poster_path'])) {
        $response = "https://via.placeholder.com/300x450";
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"></head>
<!--Custom Link-->
<link rel="stylesheet" href="css/media_movie.css">
</head>




<body>
    <?php
    $html_movie="<section class='cards-wrapper'>"; // $html_movie stores the html code for the movie cards
    
    $sql = "SELECT DISTINCT `movie`, `year`, `date` FROM `data` where movie != '' and username='$username' order by `date` DESC";
    if ($query = mysqli_query($con, $sql)) {
        $totalmoviecount=mysqli_num_rows($query);
        if ($totalmoviecount > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $movie_name=$row['movie'];
                $movie_year=$row['year'];
                $movie_logged=date("F jS, Y", strtotime($row['date']));

               
                $stripnamemovie=$stripped = str_replace(' ', '+', $movie_name);
                

                // one single div tag for each movie
                $html_movie.="<div class='card-grid-space'>";
                    // image tag for the movie
                    $html_movie.="<div class='card' style='background-image:url(";
                    $html_movie.= getposterpath($stripnamemovie, $movie_year);  // get the poster path from the api
                    $html_movie.=")'";
                    $html_movie.=">";
                
                    $html_movie.="<div>"; 
                    $html_movie.="<div class='logged-date'>". $movie_logged ."</div>"; 
                    $html_movie.="</div>";  // end of div for the movie name


                    $html_movie.="</div>"; // end of card

                    $html_movie.="<h1 class='moviename'>". $movie_name."</h1>";
                    $html_movie.="<div class='tags'>"; // div for the tags
                    $html_movie.="<div class='tag'>". $movie_year."</div>";
                    $html_movie.="</div>"; // end of tags
                    $html_movie.="</div>"; //end of card-grid-space

            }
        }else{
            $html_movie.="No Movies Logged";
        }
}
    
    $html_movie.="</section>";
    echo $html_movie;
?>


</body>
</html>