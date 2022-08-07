<?php

/**
 * SHOW FILTERED RECORDS OF MEDIA ITEMS FOR THE USER FROM THE DIARY BASED ON SELECTED DATE.
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     AtharvaShah
 */

error_reporting(E_ERROR | E_PARSE);
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}

require "connection.php";
require "functions.php";
require "header.php";
//getting the username from the session
$user_data = check_login($con);
$username = $user_data['user_name'];
?>

<?php
if(isset($_POST['userdate'])){
    $date_selected=$_POST['userdate'];
}

?>

<!--HTML PART -->
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WYDRN - Diary Filtered</title>
          
        <!--Bootstrap Link-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

        <!--Custom Link-->
        <link rel="stylesheet" href="css/diary.css">
    </head>
  
<body>
<br><br>
<div style="margin-left:50px;">
<h1> Diary Entries For <?php echo $username;?> <?php if (!empty($date_selected)) {echo "on ". printable_date($date_selected);}?> </h1>

<!--PHP PART -->
<?php
 $sql = "SELECT `videogame`,`platform`,`album`,`artist`,`book`,`author`,`movie`,`year`,`tv`,`streaming`,`date`, `datetime` from `data` WHERE `username`= '$username' AND `date`= '$date_selected' ORDER BY `date` DESC;";

if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) > 0) {
        for ($i = 0; $i <= mysqli_num_rows($query); $i++) {
            $row[$i] = mysqli_fetch_array($query);

            $videogame = $row[$i]['videogame'];
            $platform = $row[$i]['platform'];

            $album = $row[$i]['album'];
            $artist = $row[$i]['artist'];

            $book = $row[$i]['book'];
            $author = $row[$i]['author'];

            $movie = $row[$i]['movie'];
            $year = $row[$i]['year'];

            $tv = $row[$i]['tv'];
            $streaming = $row[$i]['streaming'];

            $date = $row[$i]['date'];
            $datetime = $row[$i]['datetime'];

            /* FORMATTING AND DISPLAYING BEGINS HERE */

            echo "<div class='post'>"; //div start
            echo ("<table id='diarytable'"); //table start

            //date and time. Check other fields because datetime will be added even in blank records added during clearing done by the user. 
            if ((!empty($videogame)) || (!empty($album)) || (!empty($book)) || (!empty($movie)) || (!empty($TV))) {
                $datetime = printable_datetime($datetime);
                echo ("<tr><td>");
                echo ("<div class='datetime'><h2>" . $datetime . "</h2></div>");
                echo ("</td></tr>");

                //videogame
                if ((!empty($videogame)) && (!empty($platform))) {
                    $playing = "<div class='activity'> &#127918 Playing <b>" . $videogame . "</b> on " . $platform . "</div>";
                    echo ("<tr><td>");
                    echo $playing;
                    echo ("</td></tr>");
                }

                //album
                if ((!empty($album)) && (!empty($artist))) {
                    $listening = "<div class='activity'> &#127911 Listening to <b>" . $album . "</b> by <b>" . $artist . "</b></div>";
                    echo ("<tr><td>");
                    echo $listening;
                    echo ("</td></tr>");
                }

                //book
                if ((!empty($book)) && (!empty($author))) {
                    $reading = "<div class='activity'> &#128213 Reading <b>" . $book . "</b> by <b>" . $author . "</b></div>";
                    echo ("<tr><td>");
                    echo $reading;
                    echo ("</td></tr>");
                }

                if ((!empty($movie)) && (!empty($year))) {
                    $watching = "<div class='activity'> &#128253 Watching <b>" . $movie . "</b> (" . $year . ")" . "</div>";
                    echo ("<tr><td>");
                    echo $watching;
                    echo ("</td></tr>");
                }

                //tv
                if ((!empty($tv)) && (!empty($streaming))) {
                    $binging = "<div class='activity'> &#128250 Binging <b>" . $tv . "</b> on " . $streaming . "</div>";
                    echo ("<tr><td>");
                    echo $binging;
                    echo ("</td></tr>");
                }

                echo "<br><br>";
            }

            echo ("<table>"); //table end
            echo "</div>"; //div end
        }
    } else{
        echo "No entries were found for this date for ".$username;
    }
} else{
    mysqli_error($con);
}
mysqli_close($con);
?>
</div>
<script>
    // To prevent form resubmission when page is refreshed (F5 / CTRL+R) 
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>