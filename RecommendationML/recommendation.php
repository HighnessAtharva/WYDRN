<?php

//Everything will work fine. Just put the respective CSV files in the same folder as the python file.

session_start();
if (empty($_SESSION)) {
    header("Location: ../login.php");
}
require "header.php";
require "../connection.php";
require "../functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];

function MovieRecommendations($username){
    
    /*exec -> executes script in terminal and returns output || PASS THE USERNAME AS CMD LINE ARGUMENT TO THE PYTHON SCRIPT*/
    $MovieResult=exec("python Movie/MovieRecommendation.py ".$username);
    
    //print_r($MovieResult);

    $result_array=json_decode($MovieResult,true);
    foreach($result_array as $movie=>$rank)
    {
        echo $movie.":".$rank."<br>";
    }

}

function BookRecommendations($username){
    
   /*exec -> executes script in terminal and returns output || PASS THE USERNAME AS CMD LINE ARGUMENT TO THE PYTHON SCRIPT*/
    $BookResult=exec("python Books/BookRecommendation.py ".$username);

    $result_array=json_decode($BookResult,true);
    foreach($result_array as $book=>$rank)
    {
        echo $book.":".$rank."<br>";
    }

}

function TVRecommendations($username){
    
    /*exec -> executes script in terminal and returns output || PASS THE USERNAME AS CMD LINE ARGUMENT TO THE PYTHON SCRIPT*/
    $TVResult=exec("python TV/TVRecommendation.py ".$username);

    $result_array=json_decode($TVResult,true);
    foreach($result_array as $show=>$rank)
    {
        echo $show.":".$rank."<br>";
    }

}


function AlbumRecommendations($username){
    
    /*exec -> executes script in terminal and returns output || PASS THE USERNAME AS CMD LINE ARGUMENT TO THE PYTHON SCRIPT*/
    $AlbumResult=exec("python Albums/AlbumRecommendation.py ".$username);

    $result_array=json_decode($AlbumResult,true);
    foreach($result_array as $album=>$rank)
    {
        echo $album.":".$rank."<br>";
    }

}

function GameRecommendations($username){
    
    /*exec -> executes script in terminal and returns output || PASS THE USERNAME AS CMD LINE ARGUMENT TO THE PYTHON SCRIPT*/
    $GameResult=exec("python VideoGame/VideogameRecommendation.py ".$username);

    $result_array=json_decode($GameResult,true);
    foreach($result_array as $game=>$rank)
    {
        echo $game.":".$rank."<br>";
    }

}


function PrintHeading($media){
    echo "<div class='heading'>";
        echo "<h1>".$media."</h1>";
    echo "</div>";
}

//do not echo, just invoke the function. Designing and layout to be done inside the function itself. 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WYDRN - Recommendations</title>

    <!-- custom css -->
    <link rel="stylesheet" href="recommendation.css">
</head>
<body>

<?php

/*http://localhost/WYDRN/RecommendationML/recommendation.php?Movie*/
if (isset($_GET['Movie']))
{
    PrintHeading("Movie Recommendations");
    MovieRecommendations($username);
}

/*http://localhost/WYDRN/RecommendationML/recommendation.php?Book*/
if (isset($_GET['Book']))
{
    PrintHeading("Book Recommendations");
    BookRecommendations($username);
}

/*http://localhost/WYDRN/RecommendationML/recommendation.php?TV*/
if (isset($_GET['TV']))
{
    PrintHeading("TV Recommendations");
    TVRecommendations($username);
}


/*http://localhost/WYDRN/RecommendationML/recommendation.php?Album*/
if (isset($_GET['Album']))
{
    PrintHeading("Album Recommendations");
    AlbumRecommendations($username);
}


/*http://localhost/WYDRN/RecommendationML/recommendation.php?Game*/
if (isset($_GET['Game']))
{
    PrintHeading("Game Recommendations");
    GameRecommendations($username);
}

?>

</body>
</html>