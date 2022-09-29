<?php

/**
 *  TO DELETE A MEDIA ITEM FROM THE DATABASE. ONLY PERFORMS BACKEND FUNCTION. REDIRECTS USERS TO THE PAGE THEY LANDED HERE FROM (USUALLY THE MEDIA PAGE)

 *
 * @version    PHP 8.0.12
 * @since      September 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}


require "connection.php";
require "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];
function sendLettersToBack($bkName){
    if(substr($bkName, 0, 4)=='The '){
        $bkName = substr($bkName, 4). ', The';
    }
    elseif(substr($bkName, 0, 2)=='A '){
        $bkName = substr($bkName, 2). ', A';
    }
    return $bkName;
}


// When user clicks on delete button on media_book.php
if(isset($_GET['book'])){
    $bookToDelete =  $_GET['book'];
    // $bookToDelete =sendLettersToBack($bookToDelete);
    // echo $bookToDelete;
    //do not delete the entire row as it contians the other media items. Instead update the book field and the author field to nullable string values.
    $sql = "UPDATE `data` SET `book` = '', `author`='' WHERE `username` = '$username' AND `book` = '$bookToDelete'";
    $result = mysqli_query($con, $sql);
    if($result){
        header("Location: media_book.php");
    }else{
        echo "Error deleting record: " . mysqli_error($con);
    }
}


// When user clicks on delete button on media_movie.php
if(isset($_GET['movie'])){
    $movieToDelete =  $_GET['movie'];
    // echo $movieToDelete;
    //do not delete the entire row as it contians the other media items. Instead update the movie field and the year field to nullable string values.
    $sql = "UPDATE `data` SET `movie` = '', `year`='' WHERE `username` = '$username' AND `movie` = '$movieToDelete'";
    $result = mysqli_query($con, $sql);
    if($result){
        header("Location: media_movie.php");
    }else{
        echo "Error deleting record: " . mysqli_error($con);
    }
}



// When user clicks on delete button on media_tv.php
if(isset($_GET['tv'])){
    $tvToDelete =  $_GET['tv'];
    // echo $tvToDelete;
    //do not delete the entire row as it contians the other media items. Instead update the tv field and the streaming field to nullable string values.
    $sql = "UPDATE `data` SET `tv` = '', `streaming`='' WHERE `username` = '$username' AND `tv` = '$tvToDelete'";
    $result = mysqli_query($con, $sql);
    if($result){
        header("Location: media_tv.php");
    }else{
        echo "Error deleting record: " . mysqli_error($con);
    }
}


// When user clicks on delete button on media_music.php
if(isset($_GET['music'])){
    $musicToDelete =  $_GET['music'];
    // echo $musicToDelete;
    //do not delete the entire row as it contians the other media items. Instead update the movie field and the year field to nullable string values.
    $sql = "UPDATE `data` SET `album` = '', `artist`='' WHERE `username` = '$username' AND `album` = '$musicToDelete'";
    $result = mysqli_query($con, $sql);
    if($result){
        header("Location: media_music.php");
    }else{
        echo "Error deleting record: " . mysqli_error($con);
    }
}


// When user clicks on delete button on media_videogame.php
if(isset($_GET['videogame'])){
    $gameToDelete =  $_GET['videogame'];
    // echo $musicToDelete;
    //do not delete the entire row as it contians the other media items. Instead update the movie field and the year field to nullable string values.
    $sql = "UPDATE `data` SET `videogame` = '', `platform`='' WHERE `username` = '$username' AND `videogame` = '$gameToDelete'";
    $result = mysqli_query($con, $sql);
    if($result){
        header("Location: media_videogame.php");
    }else{
        echo "Error deleting record: " . mysqli_error($con);
    }
}