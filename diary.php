<?php

/**
 * SHOW USERS A LOG OF THIER ENTRIES ON WYDRN IN ORDER OF MOST RECENT TO LEAST RECENT IN A TABULAR MANNER GROUPED BY DATE. PAGINATION SUPPORT ADDED AT THE BOTTOM OF THE PAGE. 
 *
 * @version    PHP 8.0.12 
 * @since      May 2022
 * @author     AtharvaShah
 */


error_reporting(E_ERROR | E_PARSE);
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "header.php";
require "connection.php";
require "functions.php";

//getting the username from the session
$user_data = check_login($con);
$username = $user_data['user_name'];

if (isset($_GET['userdate'])) {
    $date_selected = $_GET['userdate'];
}
?>

<!--HTML PART -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WYDRN - Diary</title>

    <!--Bootstrap Link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet" />

    <!--Custom Link-->
    <link rel="stylesheet" href="css/diary.css">
    <link href="css/backToTop.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="images/website/favicons/apple-touch-icon.png">

</head>

<body> <br><br>
    <button onclick="topFunction()" id="BackToTopBtn" title="Go to top" style="height: fit-content;">&#8657;</button>


    <div style="margin-left:50px;">
        <center>

            <!-- Heading -->
            <h1> Diary Entries For
                <?php
                echo $username;
                if (!empty($date_selected)) {
                    echo " on " . printable_date($date_selected);
                }
                ?>
            </h1>

            <!--To Allow Users to Filter Date Wise -->
            <form method="get" name="dateselect" action="diary.php">

                <!--Change button text value depending on if the date is selcted or not-->
                <?php if (empty($date_selected)) { ?>
                    <input type="date" name="userdate" id="userdate">
                    <input type="submit" value="Filter" id="submitBtn" class="btn btn-primary" style="margin-bottom:5px;">
                <?php } ?>
                <?php if (!empty($date_selected)) { ?>
                    <input type="submit" value="Show All" id="submitBtn2" class="btn btn-primary" style="margin-bottom:5px;">
                <?php } ?>



            </form>



        </center>
        <hr>

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


        // if date is selected and get query is passed show the entries of the user on the selected date
        if (!empty($date_selected)) {
            $sql = "SELECT `videogame`,`platform`,`album`,`artist`,`book`,`author`,`movie`,`year`,`tv`,`streaming`,`date`, `datetime` from `data` WHERE `username`= '$username' AND `date`= '$date_selected' ORDER BY `datetime` DESC";
        }

        // otherwise show all the entries of the user.
        else {
            $sql = "SELECT `videogame`,`platform`,`album`,`artist`,`book`,`author`,`movie`,`year`,`tv`,`streaming`,`date`, `datetime` from `data` WHERE `username`= '$username' ORDER BY `datetime` DESC LIMIT $start_from, $per_page_record;";
        }

        ?>


        <!--Timeline View Wrapper-->
        <section class="timeline_area section_padding_130">
            <div class="container">
                <div class="myrow">
                    <div class="col-12">
                        <div class="apland-timeline-area">

                            <?php
                            if ($query = mysqli_query($con, $sql)) {
                                $totalcount = mysqli_num_rows($query);
                                if ($totalcount > 0) {
                                    for ($i = 1; $i <= $totalcount; $i++) {
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

                                        //date and time. Check other fields because datetime will be added even in blank records added during clearing done by the user. 
                                        if ((!empty($videogame)) || (!empty($album)) || (!empty($book)) || (!empty($movie)) || (!empty($tv))) {
                                            $datetime = printable_datetime($datetime);
                            ?>

                                            <!-- Single Timeline Content (Printing Date on the left of the timeline-->
                                            <div class="single-timeline-area">
                                                <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                    <p class='my-date'><?php echo $datetime; ?></p>
                                                </div>
                                                <!--ONE ENTIRE DIARY ENTRY TOWARDS THE RIGHT OF THE TIMELINE-->
                                                <div class="row">
                                                    <?php
                                                    //Print the videogame div if the videogame field is not empty
                                                    if ((!empty($videogame)) && (!empty($platform))) {
                                                    ?>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.5s" id="gameCard">
                                                                <div class="timeline-icon"><i class="fa-solid fa-gamepad gameicon" aria-hidden="true"></i></div>
                                                                <div class="timeline-text">
                                                                    <h6 title="<?php echo $videogame; ?>">
                                                                        <?php echo mb_strimwidth($videogame, 0, 27, "..."); ?></h6>

                                                                    <p title="<?php echo $platform; ?>" class='my-date'><?php echo mb_strimwidth($platform, 0, 27, "..."); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    //Print the album div if the album field is not empty
                                                    if ((!empty($album)) && (!empty($artist))) {
                                                    ?>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.7s" id="musicCard">
                                                                <div class="timeline-icon"><i class="fa-solid fa-music musicicon" aria-hidden="true"></i></div>
                                                                <div class="timeline-text">
                                                                    <h6 title="<?php echo $album; ?>"><?php echo mb_strimwidth($album, 0, 27, "..."); ?></h6>
                                                                    <p class='my-date' title="<?php echo $artist; ?>"><?php echo mb_strimwidth($artist, 0, 27, "...") ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    // Print the book div if the book field is not empty
                                                    if ((!empty($book)) && (!empty($author))) {
                                                    ?>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.7s" id="bookCard">
                                                                <div class="timeline-icon"><i class="fa-solid fa-book bookicon" aria-hidden="true"></i></div>
                                                                <div class="timeline-text">
                                                                    <h6 title="<?php echo $book; ?>"><?php echo mb_strimwidth($book, 0, 27, "..."); ?></h6>
                                                                    <p class='my-date' title="<?php echo $author; ?>"><?php echo mb_strimwidth($author, 0, 27, "..."); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    // Print the movie div if the movie field is not empty
                                                    if ((!empty($movie)) && (!empty($year))) {
                                                    ?>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.7s" id="movieCard">
                                                                <div class="timeline-icon"><i class="fa-solid fa-clapperboard movieicon" aria-hidden="true"></i></div>
                                                                <div class="timeline-text">
                                                                    <h6 title="<?php echo $movie; ?>"><?php echo mb_strimwidth($movie, 0, 27, "..."); ?></h6>
                                                                    <p title="<?php echo $year; ?>" class='my-date'><?php echo mb_strimwidth($year, 0, 27, "..."); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    // Print the tv div if the tv field is not empty
                                                    if ((!empty($tv)) && (!empty($streaming))) {
                                                    ?>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.7s" id="tvCard">
                                                                <div class="timeline-icon"><i class="fa-solid fa-tv tvicon" aria-hidden="true"></i></div>
                                                                <div class="timeline-text">
                                                                    <h6 title="<?php echo $tv; ?>"><?php echo mb_strimwidth($tv, 0, 27, "..."); ?></h6>
                                                                    <p title="<?php echo $streaming; ?>" class='my-date'><?php echo mb_strimwidth($streaming, 0, 27, "..."); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                <?php }

                                // if the count of rows is 0, show the empty diary image.
                                else {
                                    echo "<center><img src='images/website/empty-diary.jpg' alt='Empty Diary' height='300' width='350'></center>";
                                }
                            }
                                ?>

                                <!-- END OF Single Timeline Content and end of wrapper section-->
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <?php
        //PAGINATION FOR THE DIARY        
        //Only show the pagination if filtering is not done.
        if (empty($date_selected)) {
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
                    $unmodified_total_pages = $total_pages;
                    if ($total_pages > 10) {
                        $total_pages = 10;
                    }
                    $pageLink = "";

                    // SHOW PREVIOUS BUTTON IF NOT ON PAGE 1
                    if ($page >= 2) {
                        echo "<a href='diary.php?page=" . ($page - 1) . "'>  <span class='neonText'> ← </span></a>";
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
                        echo "<a href='diary.php?page=" . ($page + 1) . "'>  <span class='neonText'> → </span>  </a>";
                    }
                    ?>
                </div>
                <!--END OF PAGINATION ROW -->


                <!--MANUAL PAGINATION INPUT BOX-->

                <?php
                if ($totalcount > 0) { ?>
                    <div class="inline grid-child">
                        <input id="page" type="number" min="1" max="<?php echo $unmodified_total_pages ?>" placeholder="<?php echo $page . "/" . $unmodified_total_pages; ?>" required>
                        <button onClick="go2Page();">Go</button>
                    </div>

                <?php } ?>
                <!--END OF MANUAL PAGINATION INPUT BOX-->

                <!--END OF GRID CONTAINER-->
            </div>

        <?php
        }
        ?>
    </div>
    <!--END OF MAIN DIV-->

    <script>
        //FUNCTION TO GO TO SPECIFIED PAGE - INVOKED ONLY BY MANUAL PAGINATION INPUT BOX
        function go2Page() {
            var page = document.getElementById("page").value;
            //a check to ensure that the user enters a valid page number
            page = ((page > <?php echo $unmodified_total_pages; ?>) ? <?php echo $unmodified_total_pages; ?> : ((page < 1) ? 1 : page));
            window.location.href = 'diary.php?page=' + page;
        }
    </script>
</body>
<script src="js/backToTop.js"></script>

</html>
<?php
mysqli_close($con); ?>