<?php

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    $username=$user_data['user_name'];

$sql="INSERT INTO `data`(`username`, `videogame`, `platform`, `album`, `artist`, `book`, `author`, `movie`, `year`, `tv`, `streaming`) 
VALUES ($username, $videogame, $platform, $album, $artist, $book, $author, $movie, $movierelease, $TV, $streamplatform);"

$result=($conn, $sql)

if($result){
    echo "The record has been inserted successfully successfully!<br>";
}
else{
    echo "Record not inserted. ERROR -> ". mysqli_error($conn);
}

?>