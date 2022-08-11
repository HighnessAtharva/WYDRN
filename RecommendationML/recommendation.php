<?php

//Everything will work fine. Just put the respective CSV files in the same folder as the python file.


function MovieRecommendations(){
    
    /*exec -> executes script in terminal and returns output*/
    $MovieResult=exec("python Movie/MovieRecommendation.py");
    
    //print_r($MovieResult);

    $result_array=json_decode($MovieResult,true);
    foreach($result_array as $movie=>$rank)
    {
        echo $movie.":".$rank."<br>";
    }

}

function BookRecommendations(){
    
    /*exec -> executes script in terminal and returns output*/
    $BookResult=exec("python Books/BookRecommendation.py");

    $result_array=json_decode($BookResult,true);
    foreach($result_array as $book=>$rank)
    {
        echo $book.":".$rank."<br>";
    }

}

function TVRecommendations(){
    
    /*exec -> executes script in terminal and returns output*/
    $TVResult=exec("python TV/TVRecommendation.py");

    $result_array=json_decode($TVResult,true);
    foreach($result_array as $show=>$rank)
    {
        echo $show.":".$rank."<br>";
    }

}


function AlbumRecommendations(){
    
    /*exec -> executes script in terminal and returns output*/
    $AlbumResult=exec("python Albums/AlbumRecommendation.py");

    $result_array=json_decode($AlbumResult,true);
    foreach($result_array as $album=>$rank)
    {
        echo $album.":".$rank."<br>";
    }

}

function GameRecommendations(){
    
    /*exec -> executes script in terminal and returns output*/
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
    MovieRecommendations();
}

/*http://localhost/WYDRN/RecommendationML/recommendation.php?Book*/
if (isset($_GET['Book']))
{
    BookRecommendations();
}

/*http://localhost/WYDRN/RecommendationML/recommendation.php?TV*/
if (isset($_GET['TV']))
{
    TVRecommendations();
}


/*http://localhost/WYDRN/RecommendationML/recommendation.php?Album*/
if (isset($_GET['Album']))
{
    AlbumRecommendations();
}


/*http://localhost/WYDRN/RecommendationML/recommendation.php?Game*/
if (isset($_GET['Game']))
{
    GameRecommendations();
}

?>