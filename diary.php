


<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
//include "header2.php";
include "connection.php";
include "functions.php";
//getting the username from the session
$user_data = check_login($con);
$username = $user_data['user_name'];
?>



<html>
    <head><title>DIARY</title></head>
<body>
<h1> Diary Entries For <?php echo $username; ?></h1>

<?php
$sql = "SELECT `videogame`,`platform`,`album`,`artist`,`book`,`author`,`movie`,`year`,`tv`,`streaming`,`datetime` from `data` WHERE `username`= '$username' ORDER BY `datetime` DESC;";
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

            $datetime = $row[$i]['datetime'];

            /* FORMATTING AND DISPLAYING BEGINS HERE */

            echo "<div class='post'>"; //div start
            echo ("<table border='1' style='width:80%'>"); //table start

            //date and time
            if (!empty($datetime)) {
                $datetime = printable_date($datetime);
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
    }
}
?>

</body></html>