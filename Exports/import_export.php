<?php

/**
 * THIS IS THE MAIN IMPORT/EXPORT PAGE WITH 3 BUTTONS
 * 1) IMPORT CSV -> csv_import.php -> upload_csv.php
 * 2) EXPORT CSV -> csv_export.php -> download_csv.php
 * 3) EXPORT DATA TO PDF -> pdf.php
 * @version    PHP 8.0.12
 * @since      June 2022
 * @author     AtharvaShah
 */

session_start();
if (empty($_SESSION)) {
    header("Location: ../login.php");
}

// require "header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WYDRN - Export Options</title>

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="../images/website/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="../images/website/favicons/apple-touch-icon.png">

    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,300,700'>
    <link rel="stylesheet" href="../css/import_export.css">



</head>

<body>
    <div class="container">
        <div class="heading">
            <h1>Import & Export<span>Seamless Backup & Recovery. Instantaneous and Absolute.</span></h1>
        </div>


        <div class="description">
            <p>At WYDRN, we strongly believe that the data you share with us is valuable to you. We value your privacy and want to make sure that your data is safe and secure. We also believe that users should have complete control over their data and should be able to easily import and export it as and when they want it instaneously. </p>
            <hr>
            <p>This is why we have created an Import/Export feature. You can use this feature to import your data from a CSV file and export it to a CSV file. You can also export your data to a PDF file for a more portable and easy to use format. If you wish to wipe your data, you can delete your account <a href='../delete_user.php'>here.</a></p>
            <hr>
            <p> Please ensure that you export your data first before deleting your account so that you can import it back later. Cheers and keep adding your favourite medias to WYDRN.</p>
        </div>

        <div class="buttons">

<div class="parent">
            <div class="div1"><img src="../images/Icons/pdf-export.png" alt="Export CSV" height="100px" width="100px"></div>
            <div class="div4"><button  class="button-29"  onclick="location.href='pdf.php'">Export to PDF</button></div>

            <div class="div2"><img src="../images/Icons/csv-export.png" alt="Export CSV" height="100px" width="100px"></div>
            <div class="div5"><button  class="button-29"  onclick="location.href='csv_export.php'">Export to CSV</button></div>

            <div class="div3"><img src="../images/Icons/csv-import.png" alt="Export CSV" height="100px" width="100px"></div>
            <div class="div6"><button  class="button-29"  onclick="location.href='csv_import.php'">Import from CSV</button></div>

        </div>
    </div>

    <!------------------
        HOW TO IMPORT SECTION
    ----------------->

    <div class="description">
        <p>You can also import your existing media from several popular services. </p>
        <p>Take a look below for a easy-to-follow walkthrough and onboard with WYDRN in minutes. Happy logging!</a></p>

    </div>


    <section id="fancyTabWidget" class="tabs t-tabs">
        <ul class="nav nav-tabs fancyTabs" role="tablist">

            <li class="tab fancyTab active">
                <div class="arrow-down">
                    <div class="arrow-down-inner"></div>
                </div>
                <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" aria-selected="true" data-toggle="tab" tabindex="0">
                    <span><img src="../images/Icons/goodreads.svg" height="100" width="100"></span>
                    <span class="hidden-xs"><br><b>Goodreads</b><br>Import Books</span></a>
                <div class="whiteBlock"></div>
            </li>

            <li class="tab fancyTab">
                <div class="arrow-down">
                    <div class="arrow-down-inner"></div>
                </div>
                <a id="tab1" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0"><span><img src="../images/Icons/rym.png" height="100" width="100"></span>
                    <span class="hidden-xs"><br><b>RYM</b><br>Import Albums</span></a>
                <div class="whiteBlock"></div>
            </li>

            <li class="tab fancyTab">
                <div class="arrow-down">
                    <div class="arrow-down-inner"></div>
                </div>
                <a id="tab2" href="#tabBody2" role="tab" aria-controls="tabBody2" aria-selected="true" data-toggle="tab" tabindex="0"><span>
                        <img src="../images/Icons/imdb.svg" height="100" width="100"></span>
                    </span><span class="hidden-xs"><br><b>IMDB/Letterboxd</b><br>Import Movies</span></a>
                <div class="whiteBlock"></div>
            </li>

            <li class="tab fancyTab">
                <div class="arrow-down">
                    <div class="arrow-down-inner"></div>
                </div>
                <a id="tab3" href="#tabBody3" role="tab" aria-controls="tabBody3" aria-selected="true" data-toggle="tab" tabindex="0"><span>
                        <img src="../images/Icons/steam.svg" height="100" width="100"></span>
                    </span><span class="hidden-xs"><br><b>Steam</b><br>Import Videogames</span></a>
                <div class="whiteBlock"></div>
            </li>

            <li class="tab fancyTab">
                <div class="arrow-down">
                    <div class="arrow-down-inner"></div>
                </div>
                <a id="tab4" href="#tabBody4" role="tab" aria-controls="tabBody4" aria-selected="true" data-toggle="tab" tabindex="0"><span>
                        <img src="../images/Icons/trakt.svg" height="100" width="100"></span>
                    </span><span class="hidden-xs"><br><b>Trakt</b><br>Import TV Shows</span></a>
                <div class="whiteBlock"></div>
            </li>


        </ul>
        <div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
            <div class="tab-pane  fade active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
                <div>
                    <div class="row">

                        <div class="col-md-12">
                            <p><b>Goodreads</b> is a website that allows you to keep a catalogue of your books. You can import your books from Goodreads and add them to WYDRN. </p>
                            <li>
                                <b>Step 1:</b> Go to <a href="https://www.goodreads.com/user/sign_in">https://www.goodreads.com/user/sign_in</a> and sign in with your Goodreads account.
                            </li>
                            <li>
                                <b>Step 2:</b> Click on the "My Books" tab. You will be redirected to the page where you can see all of your books.
                            </li>
                            <li>
                                <b>Step 3:</b> Click on the "Export" button in the left sidebar and and request an export. You will be granted a link to download your book catalogue. Download the CSV.
                            </li>
                            <li>
                                <b>Step 4:</b> Copy paste the Title and the Author fields from your export CSV into the appropriate columns in blank CSV from WYDRN Template and upload it to WYDRN. Done!
                            </li>
                            <br>

                            <iframe width="1100" height="600" src="https://www.youtube.com/embed/L4CERBKG9qw">
                            </iframe>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane  fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
                <div class="row">

                    <div class="col-md-12">

                        <p><b> Rate Your Music </b> is a website that allows you to keep a catalogue of your albums. You can import your albums from RYM and add them to WYDRN.</p>

                        <li>
                            <b>Step 1:</b> Go to <a href="https://rateyourmusic.com/">https://rateyourmusic.com/</a> and sign in with your RYM account.

                        </li>
                        <li>
                            <b>Step 2:</b> Scroll to the bottom of the profile and find Export button. You will be redirected to the page where you can download a CSV containing all your catalogued albums.
                        </li>
                        <li>
                            <b>Step 3:</b> Copy paste the Album and the Artist fields from your export CSV to the appropriate columns in blank CSV from WYDRN Template and and upload it to WYDRN. Done!
                        </li>

                        <br>
                        <iframe width="1100" height="600" src="https://www.youtube.com/embed/3ITSWlR0p-c"></iframe>

                    </div>
                </div>
            </div>
            <div class="tab-pane  fade" id="tabBody2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
                <div class="row">
                    <div class="col-md-12">

                        <!--IMDB-->
                        <p><b>IMDB</b> is a website that allows you to keep a catalogue of your movies. You can import your movies from IMDB and add them to WYDRN. </p>
                        <li>
                            <b>Step 1:</b> Go to <a href="https://www.imdb.com/">https://www.imdb.com/</a> and sign in with your IMDB account.
                        </li>
                        <li>
                            <b>Step 2:</b> Click on the "My Ratings" tab. You will be redirected to the page where you can see all of your movies.
                        </li>
                        <li>
                            <b>Step 3:</b> Click on the 3 dots at the top right of your list and press the "Export" button. A CSV will be downloaded.
                        </li>
                        <li>
                            <b>Step 4:</b> Copy paste the Movie and the Release fields from your export CSV into the appropriate columns in blank CSV from WYDRN Template and upload it to WYDRN. Done!
                        </li>
                        <br>

                        <iframe width="1100" height="600" src="https://www.youtube.com/embed/A2WY8rySOh0">
                        </iframe>

                        <hr>


                        <!--Letterboxd-->
                        <p><b>Letterboxd</b> is a website that allows you to keep a catalogue of your movies. You can import your movies from Letterboxd and add them to WYDRN. </p>
                        <li>
                            <b>Step 1:</b> Go to <a href="https://letterboxd.com/">https://letterboxd.com/</a> and sign in with your Letterboxd account.
                        </li>
                        <li>
                            <b>Step 2:</b> Click on Your Profile -> Settings -> Import and Export and select "Export Movies". Extract watched.CSV from the downloaded ZIP.
                        </li>
                        <li>
                            <b>Step 3:</b> Copy paste the Movie and the Release fields from your watched CSV into the appropriate columns in blank CSV from WYDRN Template and upload it to WYDRN. Done!
                        </li>
                        <br>

                        <iframe width="1100" height="600" src="https://www.youtube.com/embed/vF37BcYNC98">
                        </iframe>

                    </div>
                </div>
            </div>
            <div class="tab-pane  fade" id="tabBody3" role="tabpanel" aria-labelledby="tab3" aria-hidden="true" tabindex="0">
                <div class="row">
                    <div class="col-md-12">
                        <p><b>Steam</b> is a website that allows you to keep a catalogue of your videogames. You can import your videogames from Steam and add them to WYDRN. </p>
                        <li>
                            <b>Step 1:</b> Go to <a href="https://store.steampowered.com/">https://store.steampowered.com/</a> and sign in with your Steam account.
                        </li>
                        <li>
                            <b>Step 2:</b> Visit your profile and Copy your SteamID from the URL.
                        </li>
                        <li>
                            <b>Step 3:</b> Visit <a href="https://steam.tools/games/">https://steam.tools/games/</a> and paste your copied SteamID here. Say Add User, select your PFP and click Import Games. Your games will appear in the right sidebar. Say Export.
                        </li>
                        <li>
                            <b>Step 4:</b> Copy paste the Game list that is displayed in the browser into the appropriate columns in blank CSV from WYDRN Template and upload it to WYDRN. Done!
                        </li>
                        <br>

                        <iframe width="1100" height="600" src="https://www.youtube.com/embed/CHj6s3HsN30">
                        </iframe>


                    </div>
                </div>
            </div>
            <div class="tab-pane  fade" id="tabBody4" role="tabpanel" aria-labelledby="tab4" aria-hidden="true" tabindex="0">
                <div class="row">
                    <div class="col-md-12">
                        <p><b>Trakt tv</b> is a website that allows you to keep a catalogue of your TV Shows. You can import your TV Shows from Trakt and add them to WYDRN. </p>
                        <li>
                            <b>Step 1:</b> Go to <a href="https://trakt.tv/">https://trakt.tv/</a> and sign in with your Trakt account.
                        </li>
                        <li>
                            <b>Step 2:</b> Note your username. Visit <a href="https://darekkay.com/blog/trakt-tv-backup/">https://darekkay.com/blog/trakt-tv-backup/</a> and paste your username here.
                        </li>
                        <li>
                            <b>Step 3:</b>Extract the watched_shows.txt file from the downloaded ZIP. Now Visit <a href="https://konklone.io/json/">https://konklone.io/json/</a> and paste contents from the text file here. Download the CSV file.
                        </li>
                        <li>
                            <b>Step 4:</b> Copy paste the TV show and platform of your choice into the appropriate columns in blank CSV from WYDRN Template and upload it to WYDRN. Done!
                            <br>

                            <iframe width="1100" height="600" src="https://www.youtube.com/embed/RQxkgee4kEE">
                            </iframe>

                    </div>
                </div>
            </div>

        </div>

    </section>
    </div>


    <!------------------
       END OF HOW TO IMPORT SECTION
    ----------------->
    <!-- partial -->
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="./script.js"></script>
</body>

</html>