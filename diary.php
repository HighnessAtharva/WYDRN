<?php

/*

DESCRIPTION: SHOW USERS A LOG OF THIER ENTRIES ON WYDRN IN ORDER OF MOST RECENT TO LEAST RECENT IN A TABULAR MANNER GROUPED BY DATE. PAGINATION SUPPORT ADDED AT THE BOTTOM OF THE PAGE.  

*/

error_reporting(E_ERROR | E_PARSE);
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
include "header2.php";
include "connection.php";
include "functions.php";

//getting the username from the session
$user_data = check_login($con);
$username = $user_data['user_name'];
?>

<!--HTML PART -->
<html>
    <head><title>DIARY</title>
    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!--Custom Link-->
    <link rel="stylesheet" href="css/diary.css">
    </head>
<body>
<br><br>
<h1> Diary Entries For <?php echo $username; ?></h1>

<!--To Allow Users to Filter Date Wise -->
<form method="post" name="dateselect" action="diary_date.php">
Filter By Date: <input type="date" name="userdate" id="userdate">
<input type="submit" value="submit">
</form>


<!--PHP PART -->
<?php

$per_page_record = 10; // Number of entries to show in a page.
// Look for a GET variable page if not found default is 1.
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;

//In MYSQL - LIMIT offset, count; 
$sql = "SELECT `videogame`,`platform`,`album`,`artist`,`book`,`author`,`movie`,`year`,`tv`,`streaming`,`datetime` from `data` WHERE `username`= '$username' ORDER BY `datetime` DESC LIMIT $start_from, $per_page_record;";

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
            echo ("<table id='diarytable'"); //table start

            //date and time. Check other fields because datetime will be added even in blank records added during clearing done by the user. 
            if ((!empty($videogame)) || (!empty($album)) || (!empty($book)) || (!empty($movie)) || (!empty($TV))) {
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

<!--USING GRID CONTAINER TO SHOW PAGINATION ROW AND MANUAL INPUT BOX ADJACENT/NEXT TO EACH OTHER -->
<div class="grid-container">

    <!--PAGINATION ROW -->
    <div class="grid-child pagination">
        <?php
        $query = "SELECT count(*) from `data` WHERE `username`= '$username'";
        $rs_result = mysqli_query($con, $query);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        echo "</br>";
        // CALCULATING THE NUMBER OF PAGES
        $total_pages = ceil($total_records / $per_page_record);
        $pageLink = "";

        // SHOW PREVIOUS BUTTON IF NOT ON PAGE 1
        if ($page >= 2) {
            echo "<a href='diary.php?page=" . ($page - 1) . "'>  Prev </a>";
        }

        // SHOW THE LINKS TO EACH PAGE IN THE PAGINATION GRID 
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pageLink .= "<a class = 'active' href='diary.php?page="
                    . $i . "'>" . $i . " </a>";
            } else {
                $pageLink .= "<a href='diary.php?page=" . $i . "'>" . $i . " </a>";
            }
        }
        echo $pageLink;

        // SHOW NEXT BUTTON IF NOT ON LAST PAGE
        if ($page < $total_pages) {
            echo "<a href='diary.php?page=" . ($page + 1) . "'>  Next </a>";
        }
        ?>
    </div>
    <!--END OF PAGINATION ROW -->


    <!--MANUAL PAGINATION INPUT BOX-->
    <div class="inline grid-child">
    <input id="page" type="number" min="1" max="<?php echo $total_pages ?>"
    placeholder="<?php echo $page . "/" . $total_pages; ?>" required>
    <button onClick="go2Page();">Go</button>
    </div>
    <!--END OF MANUAL PAGINATION INPUT BOX-->

<!--END OF GRID CONTAINER-->
<div>

 <script>
    //FUNCTION TO GO TO SPECIFIED PAGE - INVOKED ONLY BY MANUAL PAGINATION INPUT BOX
    function go2Page()
    {
        var page = document.getElementById("page").value;
        //a check to ensure that the user enters a valid page number
        page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));
        window.location.href = 'diary.php?page='+page;
    }
  </script>
</body>
</html>
<?php include "footer.php"; ?>