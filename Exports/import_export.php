<?php
/*

DESCRIPTION: 
- THIS IS THE MAIN IMPORT/EXPORT PAGE WITH 3 BUTTONS
    1) IMPORT CSV -> csv_import.php -> upload_csv.php
    2) EXPORT CSV -> csv_export.php -> download_csv.php
    3) EXPORT DATA TO PDF -> pdf.php

*/
include("../footer.php");
include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Options</title>
</head>
<body>
<br><br>
<input type="button" value="Export to PDF" onclick="location.href='pdf.php'">
<input type="button" value="Export to CSV" onclick="location.href='csv_export.php'">
<input type="button" value="Import from CSV" onclick="location.href='csv_import.php'">

</body>
</html>