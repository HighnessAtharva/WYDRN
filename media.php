<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Media</title>

    <!--Bootstrap Link-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"></head>
    <!--Custom Link-->
    <link rel="stylesheet" href="css/media.css">
</head>
<body>
    <br><br><br>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type=submit name="music" value="music" class="">
    <input type=submit name="book" value="book" class="">
    <input type=submit name="movie" value="movie" class="">
    <input type=submit name="tv" value="tv" class="">
    <input type=submit name="videogame" value="videogame" class="">
</form>
<script>
    //to prevent confirm form submission browser alert
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>

<?php
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
include "header2.php";
include "footer.php";

if (isset($_POST['movie'])) {
    require "media_movie.php";
} elseif (isset($_POST['book'])) {

} elseif (isset($_POST['music'])) {
    $html_music = "";
    echo $html_music;
} elseif (isset($_POST['tv'])) {
    $html_tv = "";
    echo $html_tv;
} elseif (isset($_POST['videogame'])) {
    $html_videogame = "";
    echo $html_videogame;
}

?>