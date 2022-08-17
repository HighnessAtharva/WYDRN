<?php

/**
 * PROGRAMATICALLY DUMPS THE DATABASE FOR THE USER INTO A CSV AND PROMPTS A DOWNLOAD WINDOW SO THAT CSV CAN BE DOWNLOADED ON LOCAL MACHINE OF THE USER.
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

$user_data = check_login($con);
$username=$user_data['user_name'];

// get data
$query = "SELECT  `videogame`, `platform`, `album`,`artist`,`book`,`author`,`movie`,`year`,`tv`,`streaming`,`datetime`, `date`  FROM `data` where `username`='$username'";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Export.csv');
ob_clean();
$output = fopen('php://output', 'w');
fputcsv($output, array('Videogame', 'Platform', 'Album', 'Artist', 'Book', 'Author', 'Movie', 'Year', 'TV', 'Streaming', 'Datetime', 'Date'));
if (count($data) > 0) {
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
}
?>