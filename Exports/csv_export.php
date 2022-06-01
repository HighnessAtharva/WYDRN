<?php

/*

DESCRIPTION: 
SHOWS TABULAR DATA FROM THE DATABASE. 
BUTTON AT THE TOP TO ALLOW DOWNLOAD OF CSV 

*/


session_start();
include("../connection.php");
include("../functions.php");
include("../footer.php");
include("header.php");

$user_data = check_login($con);
$username=$user_data['user_name'];

// List data
$query = "SELECT * FROM `data` where `username`='$username'";
if (!$result = mysqli_query($con, $query)) {
    mysqli_error($con);
}

if (mysqli_num_rows($result) > 0) {
    $data = '<table class="table table-bordered table-dark">
        <tr>
            <th scope="col">Videogame</th>
            <th scope="col">Platform</th>
            <th scope="col">Album</th>
            <th scope="col">Artist</th>
            <th scope="col">Book</th>
            <th scope="col">Author</th>
            <th scope="col">Movie</th>
            <th scope="col">Year</th>
            <th scope="col">TV</th>
            <th scope="col">Streaming</th>
            <th scope="col">Datetime</th>
            <th scope="col">Date</th>
        </tr>
    ';

    while ($row = mysqli_fetch_assoc($result)) {
        
    $videogame=$row['videogame'];
    $platform=$row['platform'];
    $album=$row['album'];
    $artist=$row['artist'];
    $book=$row['book'];
    $author=$row['author'];
    $movie=$row['movie'];
    $year=$row['year'];
    $tv=$row['tv'];
    $streaming=$row['streaming'];
    $datetime=$row['datetime'];
    $date=$row['date'];


        $data .= '<tr>
            <td>' . $videogame . '</td>
            <td>' . $platform . '</td>
            <td>' . $album . '</td>
            <td>' . $artist . '</td>
            <td>' . $book . '</td>
            <td>' . $author . '</td>
            <td>' . $movie . '</td>
            <td>' . $year . '</td>
            <td>' . $tv . '</td>
            <td>' . $streaming . '</td>
            <td>' . $datetime . '</td>
            <td>' . $date . '</td>
          
        </tr>';
      
    }
    $data .= '</table>';
    $data .= '<br><hr>';
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export Data for user <?php echo $username;?></title>
    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
</head>
<body>
    <br><br>
<div class="container">
    <!--  Header  -->
    <center>
    <div class="row">
        <div class="col-md-12">
            <br><br>
            <h2>Export Data Requested by <u><?php echo $username;?></u></h2>
            <input type="button" value="Download CSV" onclick="location.href='download_csv.php'">
        </div>
    </div>
</center>
    <!--  /Header  -->

    <br><hr><br>
    <!--  Content   -->
    <div class="form-group">
        <?php echo $data ?>
    </div>
    <div class="form-group">
   
</div>
</body>
</html>