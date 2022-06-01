<?php
// include mysql database configuration file
session_start();
include("../connection.php");
include("../functions.php");
include("../footer.php");
include("header.php");
$user_data = check_login($con);
$username=$user_data['user_name'];
echo ("<br><br>");
if (isset($_POST['submit']))
{
 
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
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
 
            // Skip the first line
            fgetcsv($csvFile);
 
            // Parse data from CSV file line by line
             // Parse data from CSV file line by line
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
                
            $videogame=$getData[0];
            $platform=$getData[1];
            $album=$getData[2];
            $artist=$getData[3];
            $book=$getData[4];
            $author=$getData[5];
            $movie=$getData[6];
            $year=$getData[7];
            $tv=$getData[8];
            $streaming=$getData[9];
            $datetime=date($getData[10]);
            $date=date($getData[11]);
                
            if ((!empty($videogame)) || (!empty($album)) || (!empty($book)) || (!empty($movie)) || (!empty($TV))) 
            {
                // If user already exists in the database with the same email
                $query = "INSERT INTO data (`username`, `videogame`, `platform`, `album`, `artist`, `book` ,`author` ,`movie`,`year`,`tv`,`streaming`, `datetime`, `date`) VALUES ('$username','$videogame' ,'$platform' ,'$album' ,'$artist' ,'$book' ,'$author' ,'$movie' ,'$year' ,'$tv' ,'$streaming', '$datetime', '$date')";
 
                
                if (mysqli_query($con, $query))
                {
                   echo "Data insert success!";
                }
                else
                {
                    mysqli_error($con);
                    echo "Insert failed! Please check CSV format.";
                    echo "<br>";
                }
            }else{
                echo "Please check CSV file format.";
            }
        }
        
 
            // Close opened CSV file
            fclose($csvFile);
           // header("Location: import_export.php");
         
    }
    else
    {
        echo "Please select valid file!";
    }
}