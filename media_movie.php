<?php

/**
 * SHOWS NON-DUPLICATE MOVIES LOGGED BY THE USER IN A GRID/GALLERY FORM. ON HOVERING ON AN ITEM THE DATE OF LOGGING IS DISPLAYED.  
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
flush(); 
ob_flush();

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
        $response = "images/API/WYDRNmovie.png";
    }
    else {
        $response = "https://image.tmdb.org/t/p/w300".$response['results'][0]['poster_path'];
    }
    return $response;
    
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WYDRN - Your Movies</title>
        <!--Bootstrap Link-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <!--Custom Link-->
        <link rel="stylesheet" href="CSS/media_movie.css">
    </head>

<body class="css-selector">

<div class="heading">
  <h1>Your Movies<span><?php echo getRandomMovieQuote() ?></span></h1>
</div>


<!-- Sorting Functionality -->
<form method="get" action="" name="sort">
    <select name="sortby" id="sort-by-select" onchange="this.form.submit()">
    <option value="">Sort By</option>
    <option value="added-desc">Added Date (Newest To Oldest)</option>
    <option value="added-asc">Added Date (Oldest To Newest)</option>

    <option value="release-desc">Release Date (Newest to Oldest)</option>
    <option value="release-asc">Release Date (Oldest to Newest)</option>
    
    <option value="alphabetic-asc">Movie (A-Z)</option>
    <option value="alphabetic-desc">Movie (Z-A)</option>
    </select>
</form>

    <?php
    //set default sort order
    $sortby="added-desc";
    $sorting="`date`"; //default sorting is by added date;  
    $order="DESC"; //default order is newest to oldest  
    
    // default sorting is by added date;
    if (isset($_GET["sortby"])) {
        $sortby = $_GET["sortby"];


        /*************** SORT BY DATE OF LOGGING ***********/
        // Newest To Oldest
        if($sortby=="added-desc"){
            $sorting="`date`";
            $order="DESC";
        }

        // Oldest to Newest
        else if($sortby=="added-asc"){
            $sorting="`date`";
            $order="ASC";
        }


         /***************  SORT BY DATE OF RELEASE ***********/
        // Newest To Oldest
        else if ($sortby == "release-desc") {
            $sorting = "`year`";
            $order = "DESC";
        }

        // Oldest to Newest
        else if ($sortby == "release-asc") {
            $sorting = "`year`";
            $order = "ASC";
        }


         /***************  SORT BY ALPHABETIC SORT ***********/
        // A-Z
        else if ($sortby == "alphabetic-asc") {
            $sorting = "`movie`";
            $order = "ASC";
        }

        // Z-A
        else if ($sortby == "alphabetic-desc") {
            $sorting = "`movie`";
            $order = "DESC";
        }
        
    } //end of if isset($_GET["sortby"])
   
    $per_page_record = 15; // Number of entries to show in a page.
    // Look for a GET variable page if not found default is 1.
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    
      
    } else {
        $page = 1;
       
    }
    $start_from = ($page - 1) * $per_page_record;
    
    
    //only select unique movies logged by the user
    $html_movie="<br><br><section class='cards-wrapper'>"; // $html_movie stores the html code for the movie cards
    
    
    $sql = "SELECT `movie`, `year`, `date` FROM `data` where movie != '' and username='$username' GROUP BY `movie` order by ".$sorting." ".$order." LIMIT $start_from, $per_page_record;";
    if ($query = mysqli_query($con, $sql)) {
        $totalmoviecount=mysqli_num_rows($query);
        if ($totalmoviecount > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $movie_name=$row['movie'];
                $movie_year=$row['year'];
                $movie_logged=date("F jS, Y", strtotime($row['date']));

               
                $stripnamemovie= str_replace(' ', '+', $movie_name);
                
                 /**if poster is not downloaded, download the poster in the directory and show the image*/
                 
                //remove special characters since we are using it as a file name
                $filename= preg_replace('/[^A-Za-z0-9\-]/', '', $stripnamemovie);
                 $pseudo_poster='images/API/movie-'.$filename.'.jpg';
                 if (file_exists($pseudo_poster)) {
                     $posterpath=$pseudo_poster;
                 }
                 else {
                    $posterpath = getposterpath($stripnamemovie, $movie_year); // URL to download file from
                    $img = 'images/API/movie-'.$filename.'.jpg'; // Image path to save downloaded image
                    file_put_contents($img, file_get_contents($posterpath)); // Save image
                     
                 }

                // one single div tag for each movie
                $html_movie.="<div class='card-grid-space'>";
                    // image tag for the movie
                    $html_movie.="<div class='card' style='background-image:url(";
                    $html_movie.= $posterpath;  // get the poster path from the api
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


<!-------------------------------------------------------------------------------------
                                PAGINATION
------------------------------------------------------------------------------------->
<center>
 <div class="pagination">
        <?php
        $query="SELECT count(DISTINCT `movie`) FROM `data` where movie != '' and username='$username'";
        $rs_result = mysqli_query($con, $query);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        echo "</br>";
        // CALCULATING THE NUMBER OF PAGES
        $total_pages = ceil($total_records / $per_page_record);
        $pageLink = "";

        // SHOW PREVIOUS BUTTON IF NOT ON PAGE 1
        if ($page >= 2) {
            echo "<a href='media_movie.php?sortby=".$sortby."&page=" . ($page - 1) . "'><span class='neonText'> ← </span></a>";
        }

        // SHOW THE LINKS TO EACH PAGE IN THE PAGINATION GRID 
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pageLink .= "<a class = 'active' href='media_movie.php?page="
                    . $i . "'>" . $i . " </a>";
            } else {
                $pageLink .= "<a href='media_movie.php?sortby=".$sortby."&page=" . $i . "'>" . $i . " </a>";
            }
        }
        echo $pageLink;

        // SHOW NEXT BUTTON IF NOT ON LAST PAGE
        if ($page < $total_pages) {
            echo "<a href='media_movie.php?sortby=".$sortby."&page=" . ($page + 1) . "'><span class='neonText'> → </span></a>";
        }
        ?>
    </div><!--END OF PAGINATION ROW -->
</center>


</body>
</html>

<?php  mysqli_close($con);?>