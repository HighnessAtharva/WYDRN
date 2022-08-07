<?php


/**
 *- ALLOW USER TO IMPORT DATA FROM EXPORTED CSV. DATA IS PROCESSED AND STORED IN THE DATABASE. THE USER MUST BE LOGGED IN TO DO SO.  
 *- FORMAT MUST STRICTLY BE THE SAME AS THE ONE EXPORTED. (CSV HEADERS)
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */

session_start();
include("../connection.php");
include("../functions.php");
include("header.php");
?>

<!doctype html>
<html lang="en">
 
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
  <title>Import CSV File into MySQL using PHP</title>
 
  <style>
    .custom-file-input.selected:lang(en)::after {
      content: "" !important;
    }
 
    .custom-file {
      overflow: hidden;
    }
 
    .custom-file-input {
      white-space: nowrap;
    }
  </style>
</head>
 

<!-- HTML UPLOAD FORM -->
<body>
 <br><br>
  <div class="container">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="input-group">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" name="file">
          <label class="custom-file-label" for="customFileInput">Select file</label>
        </div>
        <div class="input-group-append">
           <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </div>
      </div>
  </form>
  </div>

<!-- To prevent form resubmission when page is refreshed (F5 / CTRL+R) -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>



<?php

//PHP CODE TO IMPORT CSV FILE INTO MYSQL
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

            //data sanitization
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
                    
                } else {
                    echo "Insert failed! Please check CSV format.<br>";
                }
            }
        }
    
        $counter=$videogamecount+$albumcount+$moviecount+$bookcount+$tvcount;
        echo("Added ".$videogamecount." Videogames to your account."."<br>");
        echo("Added ".$moviecount." Movies to your account."."<br>");
        echo("Added ".$tvcount." TV Shows to your account."."<br>");
        echo("Added ".$bookcount." Books to your account."."<br>");
        echo("Added ".$albumcount." Albums to your account."."<br>");
        echo("Total media items added your account are: ".$counter."<br>");

        fclose($csvFile);
    } else {
        echo "Please select valid file";
    }
   

}
?>