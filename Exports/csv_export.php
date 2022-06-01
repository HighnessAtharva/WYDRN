<?php

/*

DESCRIPTION: 
SHOWS TABULAR DATA FROM THE DATABASE. 
BUTTON AT THE TOP TO ALLOW DOWNLOAD OF CSV 

*/


session_start();
require("../connection.php");
require("../functions.php");
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
        $data .= '<tr>
            <td>' . $row['videogame'] . '</td>
            <td>' . $row['platform'] . '</td>
            <td>' . $row['album'] . '</td>
            <td>' . $row['artist'] . '</td>
            <td>' . $row['book'] . '</td>
            <td>' . $row['author'] . '</td>
            <td>' . $row['movie'] . '</td>
            <td>' . $row['year'] . '</td>
            <td>' . $row['tv'] . '</td>
            <td>' . $row['streaming'] . '</td>
            <td>' . $row['datetime'] . '</td>
            <td>' . $row['date'] . '</td>
          
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
<div class="container">
    <!--  Header  -->
    <center>
    <div class="row">
        <div class="col-md-12">
            
            <h2>Export Data for user <?php echo $username;?></h2>
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