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
    $BookResult=exec("python Books/BookRecommendation.py");

    $result_array=json_decode($BookResult,true);
    foreach($result_array as $book=>$rank)
    {
        echo $book.":".$rank."<br>";
    }

}

function TVRecommendations($username){
    
    /*exec -> executes script in terminal and returns output || PASS THE USERNAME AS CMD LINE ARGUMENT TO THE PYTHON SCRIPT*/
    $TVResult=exec("python TV/TVRecommendation.py");

    $result_array=json_decode($TVResult,true);
    foreach($result_array as $show=>$rank)
    {
        echo $show.":".$rank."<br>";
    }

}


function AlbumRecommendations($username){
    
    /*exec -> executes script in terminal and returns output || PASS THE USERNAME AS CMD LINE ARGUMENT TO THE PYTHON SCRIPT*/
    $AlbumResult=exec("python Albums/AlbumRecommendation.py");

    $result_array=json_decode($AlbumResult,true);
    foreach($result_array as $album=>$rank)
    {
        echo $album.":".$rank."<br>";
    }

}

function GameRecommendations($username){
    
    /*exec -> executes script in terminal and returns output || PASS THE USERNAME AS CMD LINE ARGUMENT TO THE PYTHON SCRIPT*/
    $GameResult=exec("python VideoGame/VideoGameRecommendation.py");

    $result_array=json_decode($GameResult,true);
    foreach($result_array as $game=>$rank)
    {
        echo $game.":".$rank."<br>";
    }

}


//do not echo, just invoke the function. Designing and layout to be done inside the function itself. 

/*http://localhost/WYDRN/RecommendationML/recommendation.php?Movie*/
if (isset($_GET['Movie']))
{
    MovieRecommendations($username);
}

/*http://localhost/WYDRN/RecommendationML/recommendation.php?Book*/
if (isset($_GET['Book']))
{
    BookRecommendations($username);
}

/*http://localhost/WYDRN/RecommendationML/recommendation.php?TV*/
if (isset($_GET['TV']))
{
    TVRecommendations($username);
}


/*http://localhost/WYDRN/RecommendationML/recommendation.php?Album*/
if (isset($_GET['Album']))
{
    AlbumRecommendations($username);
}


/*http://localhost/WYDRN/RecommendationML/recommendation.php?Game*/
if (isset($_GET['Game']))
{
    GameRecommendations($username);
}

?>