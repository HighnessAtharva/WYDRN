<?php
include "connection.php";
include "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];
?>

<html>
<head>
<!--Bootstrap Link-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"></head>
<!--Custom Link-->
<link rel="stylesheet" href="css/media_movie.css">

<script>
    const TDMBApiKey = "e446bc89015229cf337e16b0849d506c";

    async function getPoster(name, year) {
    const URL = `https://api.themoviedb.org/3/search/movie?api_key=${TDMBApiKey}&query=${name}&year=${year}&include_adult=true`;
    const res = await fetch(`${URL}`);
    const data = await res.json();
    try{
    var result="https://image.tmdb.org/t/p/w185"
    result += data['results'][0]['poster_path'];
    }
    catch(TypeError){ 
        result ="https://www.prokerala.com/movies/assets/img/no-poster-available.jpg";
    }
    console.log (result);
}
</script>
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

                $poster="<script>";
                $poster.="getPoster("."'$movie_name'".","."'$movie_year'".")";
                $poster.="</script>";
                echo $poster; // prints the poster image URL in CONSOLE

                // one single div tag for each movie
                $html_movie.="<div class='card-grid-space'>";
                $html_movie.="<div class='card'";
                $html_movie.="style='background-image:url(";
                $html_movie.= "https://picsum.photos/200"; //replace this with the poster url from the api - they appear in the console. Check console for URLs
                $html_movie.=")'";
                $html_movie.=">";

                $html_movie.="<div>";
                $html_movie.="<h1>". $movie_name."</h1>";
                $html_movie.="<div class='logged-date'>". $movie_logged ."</div>";
                $html_movie.="<div class='tags'>";
                $html_movie.="<div class='tag'>". $movie_year."</div>";
                $html_movie.="</div>";
                $html_movie.="</div>";
                $html_movie.="</div>";
                $html_movie.="</div>";
            
                
               
                
    }
    } else {
    $html_movie.="No Movies Logged";
    }
    }
    
   
    $html_movie.="</section>";
    echo $html_movie;
?>


</body>
</html>