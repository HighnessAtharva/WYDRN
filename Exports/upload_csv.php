<?php

/**
 * - Accept a CSV file from the user and log all records from the CSV into the user database. Basically, this is the import function.
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */


// include mysql database configuration file
session_start();
include("../connection.php");
include("../functions.php");
include("header.php");
$user_data = check_login($con);
$username = $user_data['user_name'];
echo ("<br><br>");
if (isset($_POST['submit'])) {

    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
    );

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {

        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        // Skip the first line
        fgetcsv($csvFile);

        // Parse data from CSV file line by line
        // Parse data from CSV file line by line
        $counter=0;
        $videogamecount=0;
        $albumcount=0;
        $moviecount=0;
        $bookcount=0;
        $tvcount=0;
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== false) {
            if(empty($getData)){
                continue;
            }
            $videogamecount++;
            $albumcount++;
            $moviecount++;
            $bookcount++;
            $tvcount++;
            $videogame = strtoupper(mysqli_real_escape_string($con, $getData[0]));
            $platform = strtoupper(mysqli_real_escape_string($con,$getData[1]));
            $album = strtoupper(mysqli_real_escape_string($con,$getData[2]));
            $artist = strtoupper(mysqli_real_escape_string($con,$getData[3]));
            $book = strtoupper(mysqli_real_escape_string($con,$getData[4]));
            $author = strtoupper(mysqli_real_escape_string($con,$getData[5]));
            $movie =strtoupper( mysqli_real_escape_string($con,$getData[6]));
            $year = strtoupper(mysqli_real_escape_string($con,$getData[7]));
            $tv = strtoupper(mysqli_real_escape_string($con,$getData[8]));
            $streaming =strtoupper( mysqli_real_escape_string($con,$getData[9]));
            $datetime = strtoupper(mysqli_real_escape_string($con,$getData[10]));
            $date = strtoupper(mysqli_real_escape_string($con,$getData[11]));

            if (empty($videogame)){
                $videogame = "";
                $videogamecount--;
            }
            if (empty($platform)){
                $platform = "";
            }
            if (empty($album)){
                $album = "";
                $albumcount--;
            }
            if (empty($artist)){
                $artist = "";
            }
            if (empty($book)){
                $book = "";
                $bookcount--;
            }
            if (empty($author)){
                $author = "";
            }
            if (empty($movie)){
                $movie = "";
                $moviecount--;
            }
            if (empty($year)){
                $year = "";
            }
            if (empty($tv)){
                $tv = "";
                $tvcount--;
            }
            if (empty($streaming)){
                $streaming = "";
            }
            
            if ((!empty($videogame)) || (!empty($album)) || (!empty($book)) || (!empty($movie)) || (!empty($tv))) {
                // If user already exists in the database with the same email
                $query = "INSERT INTO `data` (`username`, `videogame`, `platform`, `album`, `artist`, `book` ,`author` ,`movie`,`year`,`tv`,`streaming`) VALUES ('$username', '$videogame', '$platform', '$album', '$artist', '$book', '$author', '$movie', '$year', '$tv', '$streaming')";

                if (mysqli_query($con, $query)) {
                  
                    $counter+=mysqli_affected_rows($con);
                } else {
                    echo "Insert failed! Please check CSV format.<br>";
                }
            }
        }
    

        echo("Added ".$videogamecount." Videogames to your account."."<br>");
        echo("Added ".$moviecount." Movies to your account."."<br>");
        echo("Added ".$tvcount." TV Shows to your account."."<br>");
        echo("Added ".$bookcount." Books to your account."."<br>");
        echo("Added ".$albumcount." Albums to your account."."<br>");
        echo("Total media items to your account are: ".$counter."<br>");

        fclose($csvFile);
    } else {
        echo "Please select valid file";
    }
   

}
