<?php

/**
 * THIS IS THE MAIN IMPORT/EXPORT PAGE WITH 3 BUTTONS 
 * 1) IMPORT CSV -> csv_import.php -> upload_csv.php 
 * 2) EXPORT CSV -> csv_export.php -> download_csv.php 
 * 3) EXPORT DATA TO PDF -> pdf.php
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
    header("Location: ../login.php");
}
require "header.php";
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
    <div>
        At WYDRN, we strongly believe that the data you share with us is valuable to you. We value your privacy and want to make sure that your data is safe and secure. We also believe that users should have complete control over their data and should be able to easily import and export it as and when they want it instaneously. This is why we have created an Import/Export feature. You can use this feature to import your data from a CSV file and export it to a CSV file. You can also export your data to a PDF file for a more portable and easy to use format. If you wish to wipe your data, you can delete your account <a href='../delete_user.php'>here</a>. Please ensure that you export your data first before deleting your account so that you can import it back later. Cheers and keep adding your favorite medias to WYDRN. 
    </div>
<input type="button" value="Export to PDF" onclick="location.href='pdf.php'">
<input type="button" value="Export to CSV" onclick="location.href='csv_export.php'">
<input type="button" value="Import from CSV" onclick="location.href='csv_import.php'">

</body>
</html>