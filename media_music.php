<?php

/**
 * SHOWS NON-DUPLICATE ALBUMS LOGGED BY THE USER IN A GRID/GALLERY FORM. ON HOVERING ON AN ITEM THE DATE OF LOGGING IS DISPLAYED.  
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     AtharvaShah
 */


session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "header.php";
require "connection.php";
require "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];

function getposterpath($name, $artist){
    $api_key="6a4eb1d0536cfe3583784a65332ee179";
    $url = 'https://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key='.$api_key.'&artist='.$artist.'&album='.$name.'&format=json';
    // echo $url . "<br>";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);
    $response=json_decode($response,true);
    curl_close($curl);
    
    if (empty($response['album']['image'][5]['#text'])) {
        $response = "https://appletoolbox.com/wp-content/uploads/2018/11/Blank-iTunes-Album-Cover-no-artwork.jpg";
    }
    else {
        $response = $response['album']['image'][5]['#text'];
    }
    return $response;
}
?>


<html>
<head>
<!--Bootstrap Link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<!--Custom Link-->
<link rel="stylesheet" href="CSS/media_music.css">

</head>




<body>

<div class="heading">
  <h1>Your Albums<span>"I light my torch and burn it. I am the beast I worship" - Death Grips</span></h1>
</div>

<?php
$per_page_record = 12; // Number of entries to show in a page.
// Look for a GET variable page if not found default is 1.
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $per_page_record;


    $html_album="<br><br><section class='cards-wrapper'>"; // $html_album stores the html code for the album cards
    
    $sql = "SELECT DISTINCT `album`, `artist`, `date` FROM `data` where album != '' and username='$username' order by `date` DESC LIMIT $start_from, $per_page_record;";
    if ($query = mysqli_query($con, $sql)) {
        $totalalbumcount=mysqli_num_rows($query);
        if ($totalalbumcount > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $album_name=$row['album'];
                $album_artist=$row['artist'];
                $album_logged=date("F jS, Y", strtotime($row['date']));
                $stripalbum=$stripped = str_replace(' ', '+', $album_name);
                $stripartist=$stripped = str_replace(' ', '+', $album_artist);
                
                // one single div tag for each album
                $html_album.="<div class='card-grid-space'>";
                    // image tag for the album
                    $html_album.="<div class='card' style='background-image:url(";
                    $html_album.= getposterpath($stripalbum, $stripartist);  // get the poster path from the api
                    $html_album.=")'";
                    $html_album.=">";
                
                    $html_album.="<div>"; 
                    $html_album.="<div class='logged-date'>". $album_logged ."</div>"; 
                    $html_album.="</div>";  // end of div for the album name


                    $html_album.="</div>"; // end of card

                    $html_album.="<h1 class='moviename'>". $album_name."</h1>";
                    $html_album.="<div class='tags'>"; // div for the tags
                    $html_album.="<div class='tag'>". $album_artist."</div>";
                    $html_album.="</div>"; // end of tags
                    $html_album.="</div>"; //end of card-grid-space
            }
        }else{
            $html_album.="No Albums Logged";
        }
    }
    $html_album.="</section>";
    echo $html_album;

?>


<!--PAGINATION ROW -->
<center>
 <div class="pagination">
        <?php
        $query="SELECT DISTINCT count(*) FROM `data` where album != '' and username='$username'";
        $rs_result = mysqli_query($con, $query);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        echo "</br>";
        // CALCULATING THE NUMBER OF PAGES
        $total_pages = ceil($total_records / $per_page_record);
        $pageLink = "";

        // SHOW PREVIOUS BUTTON IF NOT ON PAGE 1
        if ($page >= 2) {
            echo "<a href='media_music.php?page=" . ($page - 1) . "'>  Prev </a>";
        }

        // SHOW THE LINKS TO EACH PAGE IN THE PAGINATION GRID 
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pageLink .= "<a class = 'active' href='media_music.php?page="
                    . $i . "'>" . $i . " </a>";
            } else {
                $pageLink .= "<a href='media_music.php?page=" . $i . "'>" . $i . " </a>";
            }
        }
        echo $pageLink;

        // SHOW NEXT BUTTON IF NOT ON LAST PAGE
        if ($page < $total_pages) {
            echo "<a href='media_music.php?page=" . ($page + 1) . "'>  Next </a>";
        }
        ?>
    </div><!--END OF PAGINATION ROW -->
</center>

</body>
</html>

<?php  mysqli_close($con);?>