<?php


/**
 *- ALLOW USER TO IMPORT DATA FROM EXPORTED CSV. DATA IS PROCESSED AND STORED IN THE DATABASE. THE USER MUST BE LOGGED IN TO DO SO.  
 *- FORMAT MUST STRICTLY BE THE SAME AS THE ONE EXPORTED. (CSV HEADERS)
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
    header("Location: ../login.php");
}
include("../connection.php");
include("../functions.php");
include("header.php");
?>

<html lang="en">
 
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/csv_import.css">
  
  <!-- Sweet Alert (Beautiful looking alert plugin-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  <title>Import CSV File into MySQL using PHP</title>
 
</head>
 

<!-- HTML UPLOAD FORM -->
<body>
 <br><br>
 <div class="heading">
  <h1>Upload CSV<span>Quickly Import Your Medias</span></h1>
</div>

<center><div class="info">
    CSV headers should be <u>Videogame, Platform, Album, Artist, Book,	Author,	Movie, Year, TV, Streaming,	Datetime, Date</u>. Order of the CSV headers should be the same as the order of the columns mentioned. If Datetime, Date is absent in the CSV, it will be automatically filled with the current date and time. Sample Import File will look like this. Download it and use it as a template if required.
    <br><br>
    <button onclick="window.location.href='dummy_import_data.csv'">Download Import CSV (Contains DATA)</button>
    <button onclick="window.location.href='dummy_import_data_blank.csv'">Download Import CSV (BLANK)</button> 
</div></center>
<br><br>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data" onsubmit ="return Validation();">
      <div class="input-group">
        <div class="custom-file">
          <input type="file" id='user-csv' class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" name="file">
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

function Validation(){
let csvfile = document.getElementById("user-csv").value;
    
    if (csvfile){
        return true;
        
    }
    else{
        //sweet alert plugin to display error message. IT REPLACES the JS alert() function.
        swal({
        title: "Select a file",
        text: "Upload a CSV file first!",
        icon: "error",
        button: "Upload",
        });
        return false;
    }
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
        $TotalMediaCount=0;
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
            $videogame = mysqli_real_escape_string($con, $getData[0]);
            $platform = mysqli_real_escape_string($con,$getData[1]);
            $album = mysqli_real_escape_string($con,$getData[2]);
            $artist = mysqli_real_escape_string($con,$getData[3]);
            $book = mysqli_real_escape_string($con,$getData[4]);
            $author = mysqli_real_escape_string($con,$getData[5]);
            $movie = mysqli_real_escape_string($con,$getData[6]);
            $year = mysqli_real_escape_string($con,$getData[7]);
            $tv = mysqli_real_escape_string($con,$getData[8]);
            $streaming = mysqli_real_escape_string($con,$getData[9]);
            $datetime = mysqli_real_escape_string($con,$getData[10]);
            $date = mysqli_real_escape_string($con,$getData[11]);

            $videogame = mb_convert_encoding($videogame,'HTML-ENTITIES','utf-8');
            $platform = mb_convert_encoding($platform,'HTML-ENTITIES','utf-8');
            $album = mb_convert_encoding($album,'HTML-ENTITIES','utf-8');
            $artist = mb_convert_encoding($artist,'HTML-ENTITIES','utf-8');
            $book = mb_convert_encoding($book,'HTML-ENTITIES','utf-8');
            $author = mb_convert_encoding($author,'HTML-ENTITIES','utf-8');
            $movie = mb_convert_encoding($movie,'HTML-ENTITIES','utf-8');
            $year = mb_convert_encoding($year,'HTML-ENTITIES','utf-8');
            $tv = mb_convert_encoding($tv,'HTML-ENTITIES','utf-8');
            $streaming = mb_convert_encoding($streaming,'HTML-ENTITIES','utf-8');

            if (empty($videogame) || empty($platform)){
                $videogame = "";
                $platform = "";
                $videogamecount--;
            }
            if (empty($album) || empty($artist)){
                $album = "";
                $artist = "";
                $albumcount--;
            }
            if (empty($book)|| empty($author)){
                $book = "";
                $author = "";
                $bookcount--;
            }
            if (empty($movie) || empty($year)){
                $movie = "";
                $year = "";
                $moviecount--;
            }
          
            if (empty($tv)|| empty($streaming)){
                $tv = "";
                $streaming = "";
                $tvcount--;
            }
            
            if(empty($date)){
                $date=date("Y-m-d");
                $datetime=date("Y-m-d H:i:s");
            }
            
            if ((!empty($videogame)) || (!empty($album)) || (!empty($book)) || (!empty($movie)) || (!empty($tv))){
                // If user already exists in the database with the same email
                $query = "INSERT INTO `data` (`username`, `videogame`, `platform`, `album`, `artist`, `book` ,`author` ,`movie`,`year`,`tv`,`streaming`, `datetime`,`date`) VALUES ('$username', '$videogame', '$platform', '$album', '$artist', '$book', '$author', '$movie', '$year', '$tv', '$streaming','$datetime','$date')";

                if (mysqli_query($con, $query)) {
                    
                } else {
                    echo "Insert failed! Please check CSV format.<br>";
                }
            }
        }
    
        $TotalMediaCount=$videogamecount+$albumcount+$moviecount+$bookcount+$tvcount;

        fclose($csvFile);
        ?>
 
        
        <center>
        <!-- Videogame Import Success Message! -->
        <div class='alert alert-success w-50 text-center alert-dismissible fade show' role='alert'>
        <img src="../images/Icons/videogame.svg" class="media-icon">Added <?php echo($videogamecount); ?> Videogames to your account.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>

        <!-- Movie Import Success Message! -->
        <div class='alert alert-success w-50 text-center alert-dismissible fade show' role='alert'>
        <img src="../images/Icons/Movie.svg" class="media-icon">Added <?php echo($moviecount); ?> Movies to your account.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>

        <!-- TV Import Success Message! -->
        <div class='alert alert-success w-50 text-center alert-dismissible fade show' role='alert'>
        <img src="../images/Icons/TV.svg" class="media-icon">Added <?php echo($tvcount); ?> TV Shows to your account.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>

        <!-- Book Import Success Message! -->
        <div class='alert alert-success w-50 text-center alert-dismissible fade show' role='alert'>
        <img src="../images/Icons/Book.svg" class="media-icon">Added <?php echo($bookcount); ?> Books to your account.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>

        <!-- Album Import Success Message! -->
        <div class='alert alert-success w-50 text-center alert-dismissible fade show' role='alert'>
        <img src="../images/Icons/Music.svg" class="media-icon">Added <?php echo($albumcount); ?> Albums to your account.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    
        <!--Total Media Added Count -->
        <div class='alert alert-success w-50 text-center alert-dismissible fade show' role='alert'>
        <img src="../images/Icons/Like.svg" class="media-icon">Total <?php echo($TotalMediaCount); ?> Medias imported
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>

        <!--Click here to go to your profile -->
        <button onclick="window.location.href='../profile.php'">Return to Profile</button>
        
        <br>
        <br>
        </center>
<?php
    }else {
        echo "<center><div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'>
     Please select a valid file format.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div></center>";
    }
}
?>