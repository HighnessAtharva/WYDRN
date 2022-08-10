<?php

/**
 * Page to ask for confirmation to delete the user account.
 *
 * @version    PHP 8.0.12 
 * @since      May 2022
 * @author     AtharvaShah
 */


session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>WYDRN - Delete Account</title>
    
    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <center>
    <div>
        <p class="alert-danger alert"> Are you sure you want to delete your account? This action is not reversible. We encourage you to export your data first. Do it <a href="exports/csv_export.php">here</a>.</p>
        <input type="button" value="Delete Account" onclick="window.location.href='delete_user_confirm.php'">
    </div>
    </center>
</body>
</html>
