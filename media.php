<?php
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logged Media</title>
    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!--Custom Link-->
    <link rel="stylesheet" href="css/media.css">
</head>
<body>
<br><br><br>
<center>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
    <input type=submit name="music" value="music" class="">
    <input type=submit name="book" value="book" class="">
    <input type=submit name="movie" value="movie" class="">
    <input type=submit name="tv" value="tv" class="">
    <input type=submit name="videogame" value="videogame" class="">
</form>
</center>
<script>
    //to prevent confirm form submission browser alert
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>


<?php
// to display movie medias
if (isset($_GET['movie'])) {
    require "media_movie.php";
} 
// to display book medias
elseif (isset($_GET['book'])) {
    require("media_book.php");
} 

// to display music medias    
elseif (isset($_GET['music'])) {
    require("media_music.php");
}

// to display TV medias    
elseif (isset($_GET['tv'])) {
    require("media_tv.php");
} 

// to display videogame medias    
elseif (isset($_GET['videogame'])) {
    require("media_videogame.php");
}

?>