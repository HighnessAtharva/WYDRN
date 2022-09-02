<?php

/**
 *  BUTTON AT THE TOP TO ALLOW DOWNLOAD CSV EXPORT FILE. SHOWS TABULAR DATA OF RECENTLY ADDED MEDIA FROM THE DATABASE. 
 * @version    PHP 8.0.12
 * @since      June 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
    header("Location: ../login.php");
}
include "../connection.php";
include "../functions.php";
include "header.php";

$user_data = check_login($con);
$username = $user_data['user_name'];
?>


<!--**************
VIDEO GAME DATA
*****************-->
<?php

$querygame = "SELECT `videogame`, `platform`, DATE_FORMAT(date, '%D %b %Y') AS `date` FROM `data` where `username`='$username' and `videogame`!='' LIMIT 10";

if (!$result = mysqli_query($con, $querygame)) {
    mysqli_error($con);
}

if (mysqli_num_rows($result) > 0) {
    $gamedata = "<div class='table-wrapper'>";
    $gamedata .= "<table class='fl-table'>
    <thead>
    <tr>
        <th colspan='3' class='heading2'>Videogames</th>
    </tr>
    </thead>
        <tr>
            <th scope='col'>Videogame</th>
            <th scope='col'>Platform</th>
            <th scope='col'>Date</th>
        </tr>
    ";

    while ($row = mysqli_fetch_assoc($result)) {

        $videogame = $row['videogame'];
        $platform = $row['platform'];
        $date = $row['date'];

        // this if conditional is added to ensure that blank records are not displayed
        if (!empty($videogame)) {
            $gamedata .= '<tr><td>' . $videogame . '</td><td>' . $platform . '</td><td>' . $date . '</td>    </tr>';
        }
    }

    $gamedata .= '</table>';
    $gamedata .= "</div'>";
}

?>

<!--**************
ALBUM DATA
*****************-->
<?php

$queryalbum = "SELECT `album`, `artist`, DATE_FORMAT(date, '%D %b %Y') AS `date` FROM `data` where `username`='$username' and `album`!='' LIMIT 10";

if (!$result = mysqli_query($con, $queryalbum)) {
    mysqli_error($con);
}

if (mysqli_num_rows($result) > 0) {
    $albumdata = "<div class='table-wrapper'>";
    $albumdata .= "<table class='fl-table'>
    <thead>
    <tr>
        <th colspan='3' class='heading2'>Albums</th>
    </tr>
    </thead>
        <tr>
            <th scope='col'>Album</th>
            <th scope='col'>Artist</th>
            <th scope='col'>Date</th>
        </tr>
    ";

    while ($row = mysqli_fetch_assoc($result)) {

        $album = $row['album'];
        $artist = $row['artist'];
        $date = $row['date'];

        // this if conditional is added to ensure that blank records are not displayed
        if (!empty($album)) {
            $albumdata .= '<tr><td>' . $album . '</td><td>' . $artist . '</td><td>' . $date . '</td>    </tr>';
        }
    }

    $albumdata .= '</table>';
    $albumdata .= "</div'>";
}
?>



<!--**************
MOVIE DATA
*****************-->
<?php

$querymovie = "SELECT `movie`, `year`, DATE_FORMAT(date, '%D %b %Y') AS `date` FROM `data` where `username`='$username' and `movie`!='' LIMIT 10";

if (!$result = mysqli_query($con, $querymovie)) {
    mysqli_error($con);
}

if (mysqli_num_rows($result) > 0) {
    $moviedata = "<div class='table-wrapper'>";
    $moviedata .= "<table class='fl-table'>
    <thead>
    <tr>
        <th colspan='3' class='heading2'>Movies</th>
    </tr>
    </thead>
        <tr>
            <th scope='col'>Movie</th>
            <th scope='col'>Release Year</th>
            <th scope='col'>Date</th>
        </tr>
    ";

    while ($row = mysqli_fetch_assoc($result)) {

        $movie = $row['movie'];
        $year = $row['year'];
        $date = $row['date'];

        // this if conditional is added to ensure that blank records are not displayed
        if (!empty($album)) {
            $moviedata .= '<tr><td>' . $movie . '</td><td>' . $year . '</td><td>' . $date . '</td>    </tr>';
        }
    }

    $moviedata .= '</table>';
    $moviedata .= "</div'>";
}
?>




<!--**************
TV DATA
*****************-->
<?php

$querytv = "SELECT `tv`, `streaming`, DATE_FORMAT(date, '%D %b %Y') AS `date` FROM `data` where `username`='$username' and `tv`!='' LIMIT 10";

if (!$result = mysqli_query($con, $querytv)) {
    mysqli_error($con);
}

if (mysqli_num_rows($result) > 0) {
    $tvdata = "<div class='table-wrapper'>";
    $tvdata .= "<table class='fl-table'>
    <thead>
    <tr>
        <th colspan='3' class='heading2'>TV Shows</th>
    </tr>
    </thead>
        <tr>
            <th scope='col'>Show</th>
            <th scope='col'>Streaming Platform</th>
            <th scope='col'>Date</th>
        </tr>
    ";

    while ($row = mysqli_fetch_assoc($result)) {

        $tv = $row['tv'];
        $streaming = $row['streaming'];
        $date = $row['date'];

        // this if conditional is added to ensure that blank records are not displayed
        if (!empty($tv)) {
            $tvdata .= '<tr><td>' . $tv . '</td><td>' . $streaming . '</td><td>' . $date . '</td>    </tr>';
        }
    }

    $tvdata .= '</table>';
    $tvdata .= "</div'>";
}
?>

<!--**************
BOOK DATA
*****************-->
<?php

$querybook = "SELECT `book`, `author`, DATE_FORMAT(date, '%D %b %Y') AS `date` FROM `data` where `username`='$username' and `book`!='' LIMIT 10";

if (!$result = mysqli_query($con, $querybook)) {
    mysqli_error($con);
}

if (mysqli_num_rows($result) > 0) {
    $bookdata = "<div class='table-wrapper'>";
    $bookdata .= "<table class='fl-table'>
    <thead>
    <tr>
        <th colspan='3' class='heading2'>Books</th>
    </tr>
    </thead>
        <tr>
            <th scope='col'>Book</th>
            <th scope='col'>Author</th>
            <th scope='col'>Date</th>
        </tr>
    ";

    while ($row = mysqli_fetch_assoc($result)) {

        $book = $row['book'];
        $author = $row['author'];
        $date = $row['date'];

        // this if conditional is added to ensure that blank records are not displayed
        if (!empty($tv)) {
            $bookdata .= '<tr><td>' . $book . '</td><td>' . $author . '</td><td>' . $date . '</td>    </tr>';
        }
    }

    $bookdata .= '</table>';
    $bookdata .= "</div'>";
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data for user <?php echo $username; ?></title>

    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" type="text/css" href="../CSS/csv_export.css" />

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="../images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="../images/website/favicons/apple-touch-icon.png">
</head>

<body><br><br>

    <div class="container">

        <!--  Header  -->
        <center>
            <div class="row">
                <div class="col-md-12"><br><br>
                    <h2 class="heading">Export Data Requested by <u><?php echo $username; ?></u></h2>
                    <input type="button" value="Download CSV" onclick="location.href='download_csv.php'">
                </div>
            </div>
        </center>
        <!--  /Header  -->

        <br>
        <hr><br>

        <center>
            <!--  PRINTING VIDEOGAME DATA   -->
            <div class="form-group">
                <?php if (!empty($gamedata)) {
                    echo $gamedata;
                } else {
                    echo "<div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'>
                   <img src='../images/Icons/videogame.svg' class='media-icon'>No videogames added to your account.
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                   </div>";
                }

                ?>
            </div>


            <!--  PRINTING ALBUM DATA   -->
            <div class="form-group">
                <?php if (!empty($albumdata)) {
                    echo $albumdata;
                } else {
                    echo "<div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'>
                   <img src='../images/Icons/Music.svg' class='media-icon'>No albums added to your account.
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                   </div>";
                }

                ?>
            </div>

            <!--  PRINTING MOVIE DATA   -->
            <div class="form-group">
                <?php if (!empty($movie)) {
                    echo $moviedata;
                } else {
                    echo "<div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'>
                   <img src='../images/Icons/Movie.svg' class='media-icon'>No movies added to your account.
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                   </div>";
                }

                ?>
            </div>

            <!--  PRINTING TV DATA   -->
            <div class="form-group">
                <?php if (!empty($tvdata)) {
                    echo $tvdata;
                } else {
                    echo "<div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'>
                   <img src='../images/Icons/TV.svg' class='media-icon'>No tv shows added to your account.
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                   </div>";
                }

                ?>
            </div>

            <!--  PRINTING BOOK DATA   -->
            <div class="form-group">
                <?php if (!empty($bookdata)) {
                    echo $bookdata;
                } else {
                    echo "<div class='alert alert-danger w-50 text-center alert-dismissible fade show' role='alert'>
                   <img src='../images/Icons/Book.svg' class='media-icon'>No books added to your account.
                   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                   </div>";
                }

                ?>
            </div>
        </center>


    </div>
    <!--End of container-->
</body>

</html>