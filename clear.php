<?php

/**
 * Clear the a users' profile page by inserting a blank row in the DB.
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "connection.php";
require "functions.php";

//to insert blank records into the database
$user_data = check_login($con); 
$username_coded = $user_data['user_name']; //this is the user who is logged in
$sql = "INSERT INTO `data`(`username`, `videogame`, `platform`, `album`, `artist`, `book`, `author`, `movie`, `year`, `tv`, `streaming`) VALUES ('$username_coded', '', '', '', '', '', '', '', '', '', '')";
$result = mysqli_query($con, $sql);


//to delete all the blank records from the database except the most recent blank record. 
$sql = "DELETE FROM data WHERE 
username = '$username_coded' AND videogame = '' AND platform ='' AND album='' and artist='' and book='' and author='' and movie='' and year='' and tv='' and streaming='' AND datetime<> (SELECT max(datetime) from data where videogame = '' AND platform ='' AND album='' and artist='' and book='' and author='' and movie='' and year='' and tv='' and streaming='')";
$result = mysqli_query($con, $sql);
mysqli_close($con);
// redirect back to the profile page
header("Location: profile.php");
?>

<!-------------------------------------------------------------------------------------
                    NO HTML OR JAVASCRIPT IS REQUIRED FOR THIS PAGE
------------------------------------------------------------------------------------->