<?php

/**
 * SHOWS NON-DUPLICATE BOOKS LOGGED BY THE USER IN A SINGLE PAGE TABULAR FORM. 
 *
 * @version    PHP 8.0.12
 * @since      August 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
  header("Location: login.php");
}
require "header.php";
require "connection.php";
require "functions.php";
require "quotes.php"; //to get a random quote
$user_data = check_login($con);
$username = $user_data['user_name'];

?>

<html>

<head>
  <link href="css/media_list_view.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.14/js/jquery.tablesorter.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!--Bootstrap Link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>


<body>

<?php
/**************** 
 * TO DISPLAY BOOKS LOGGED BY THE USER IN A SINGLE PAGE TABULAR FORM.
 *  
 * ******************/
if (isset($_GET['book'])) {
  $sql = "SELECT `book`, `author`, `date` FROM `data` where book != '' and username='$username' GROUP BY `book`";
  $result = mysqli_query($con, $sql);
  if ($query = mysqli_query($con, $sql)) {
    $totalcount = mysqli_num_rows($query);
    if ($totalcount > 0) {
      $list = '<div id="wrapper">
        <table id="keywords" cellspacing="0" cellpadding="0">';
      $list .= '<thead>
        <tr>
          <th><span>Book</span></th>
          <th><span>Author</span></th>
          <th><span>Logged On</span></th>
        </tr>
      </thead>';
      while ($row = mysqli_fetch_assoc($query)) {
        $book = strtoupper($row['book']);
        $author = strtoupper($row['author']);
        $date = $row['date'];
        $date = printable_date($date);
        $list .= "<tr><td class='lalign'>$book</td><td>$author</td><td>$date</td></tr>";
      }
      $list .= '  </table>
        </div> ';
      echo $list;
    } else {
      //NO BOOKS LOGGED MESSAGE
      $BooksNotAdded = "<br><center><div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'><img src='images/Icons/Book.svg' width='15' height='15' class='media-icon'>No books added to your account.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></center>";
      echo $BooksNotAdded;
    }
  }
}

?>


<?php
/******************  
 * TO DISPLAY MOVIES LOGGED BY THE USER IN A SINGLE PAGE TABULAR FORM.
 * 
 * ******************/
if (isset($_GET['movie'])) {
  $sql = "SELECT `movie`, `year`, `date` FROM `data` where movie != '' and username='$username' GROUP BY `movie`";
  $result = mysqli_query($con, $sql);
  if ($query = mysqli_query($con, $sql)) {
    $totalcount = mysqli_num_rows($query);
    if ($totalcount > 0) {
      $list = '<div id="wrapper">
        <table id="keywords" cellspacing="0" cellpadding="0">';
      $list .= '<thead>
        <tr>
          <th><span>Movie</span></th>
          <th><span>Release Year</span></th>
          <th><span>Logged On</span></th>
        </tr>
      </thead>';
      while ($row = mysqli_fetch_assoc($query)) {
        $movie = strtoupper($row['movie']);
        $year = strtoupper($row['year']);
        $date = $row['date'];
        $date = printable_date($date);
        $list .= "<tr><td class='lalign'>$movie</td><td>$year</td><td>$date</td></tr>";
      }
      $list .= '  </table>
        </div> ';
      echo $list;
    } else {
      //NO Movies LOGGED MESSAGE
      $MovieNotAdded = "<br><center><div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'><img src='images/Icons/Movie.svg' width='15' height='15' class='media-icon'>No Movies added to your account.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></center>";
      echo $MovieNotAdded;
    }
  }
}
?>


<?php
/******************  
 * TO DISPLAY TV SHOWS LOGGED BY THE USER IN A SINGLE PAGE TABULAR FORM.
 * 
 * ******************/
if (isset($_GET['tv'])) {
  $sql = "SELECT `tv`, `streaming`, `date` FROM `data` where tv != '' and username='$username' GROUP BY `tv`";
  $result = mysqli_query($con, $sql);
  if ($query = mysqli_query($con, $sql)) {
    $totalcount = mysqli_num_rows($query);
    if ($totalcount > 0) {
      $list = '<div id="wrapper">
        <table id="keywords" cellspacing="0" cellpadding="0">';
      $list .= '<thead>
        <tr>
          <th><span>TV Show</span></th>
          <th><span>Network</span></th>
          <th><span>Logged On</span></th>
        </tr>
      </thead>';
      while ($row = mysqli_fetch_assoc($query)) {
        $tv = strtoupper($row['tv']);
        $streaming = strtoupper($row['streaming']);
        $date = $row['date'];
        $date = printable_date($date);
        $list .= "<tr><td class='lalign'>$tv</td><td>$streaming</td><td>$date</td></tr>";
      }
      $list .= '  </table>
        </div> ';
      echo $list;
    } else {
      //NO TV Shows LOGGED MESSAGE
      $TVNotAdded = "<br><center><div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'><img src='images/Icons/TV.svg' width='15' height='15' class='media-icon'>No TV Shows  added to your account.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></center>";
      echo $TVNotAdded;
    }
  }
}
?>



<?php
/******************  
 * TO DISPLAY ALBUMS LOGGED BY THE USER IN A SINGLE PAGE TABULAR FORM.
 * 
 * ******************/
if (isset($_GET['album'])) {
  $sql = "SELECT `album`, `artist`, `date` FROM `data` where tv != '' and username='$username' GROUP BY `album`";
  $result = mysqli_query($con, $sql);
  if ($query = mysqli_query($con, $sql)) {
    $totalcount = mysqli_num_rows($query);
    if ($totalcount > 0) {
      $list = '<div id="wrapper">
        <table id="keywords" cellspacing="0" cellpadding="0">';
      $list .= '<thead>
        <tr>
          <th><span>Album</span></th>
          <th><span>Artist</span></th>
          <th><span>Logged On</span></th>
        </tr>
      </thead>';
      while ($row = mysqli_fetch_assoc($query)) {
        $album = strtoupper($row['album']);
        $artist = strtoupper($row['artist']);
        $date = $row['date'];
        $date = printable_date($date);
        $list .= "<tr><td class='lalign'>$album</td><td>$artist</td><td>$date</td></tr>";
      }
      $list .= '  </table>
        </div> ';
      echo $list;
    } else {
      //NO Albums LOGGED MESSAGE
      $AlbumNotAdded = "<br><center><div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'><img src='images/icons/Music.svg' width='15' height='15' class='media-icon'>No Albums added to your account.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></center>";
      echo $AlbumNotAdded;
    }
  }
}
?>



<?php
/******************  
 * TO DISPLAY Videogames LOGGED BY THE USER IN A SINGLE PAGE TABULAR FORM.
 * 
 * ******************/
if (isset($_GET['videogame'])) {
  $sql = "SELECT `videogame`, `platform`, `date` FROM `data` where videogame != '' and username='$username' GROUP BY `videogame`";
  $result = mysqli_query($con, $sql);
  if ($query = mysqli_query($con, $sql)) {
    $totalcount = mysqli_num_rows($query);
    if ($totalcount > 0) {
      $list = '<div id="wrapper">
        <table id="keywords" cellspacing="0" cellpadding="0">';
      $list .= '<thead>
        <tr>
          <th><span>Videogame</span></th>
          <th><span>Platform</span></th>
          <th><span>Logged On</span></th>
        </tr>
      </thead>';
      while ($row = mysqli_fetch_assoc($query)) {
        $videogame = strtoupper($row['videogame']);
        $platform = strtoupper($row['platform']);
        $date = $row['date'];
        $date = printable_date($date);
        $list .= "<tr><td class='lalign'>$videogame</td><td>$platform</td><td>$date</td></tr>";
      }
      $list .= '  </table>
        </div> ';
      echo $list;
    } else {
      //NO Videogame LOGGED MESSAGE
      $VideogameNotAdded = "<br><center><div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'><img src='images/icons/Videogame.svg' width='15' height='15' class='media-icon'>No Videogames added to your account.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div></center>";
      echo $VideogameNotAdded;
    }
  }
}
?>




</body>
<script>
  $(function() {
    $('#keywords').tablesorter();
  });
</script>
</html>