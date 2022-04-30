<?php 
session_start();
if(empty($_SESSION))
{
  header("Location: login.php");
}
include "header2.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Feed</title>
    <link rel="stylesheet" href="css/feed.css">
</head>

<body style="background: linear-gradient(90deg, #1CB5E0 0%, #000851 100%);">
        <div class="container"  style="margin-top:100px;">
        <?php include "social.php";?>
        </div>
<?php include "footer.php";?>
</body>
</html>