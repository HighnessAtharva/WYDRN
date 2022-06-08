<?php
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
include "connection.php";
include "functions.php";

$user_data = check_login($con); 
$username_coded = $user_data['user_name']; //this is the user who is logged in
$sql = "INSERT INTO `data`(`username`, `videogame`, `platform`, `album`, `artist`, `book`, `author`, `movie`, `year`, `tv`, `streaming`) VALUES ('$username_coded', '', '', '', '', '', '', '', '', '', '')";
$result = mysqli_query($con, $sql);
header("Location: profile.php");
?>