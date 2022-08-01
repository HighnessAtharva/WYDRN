<?php

/**
 * SHOWS NON-DUPLICATE BOOKS LOGGED BY THE USER IN A GRID/GALLERY FORM. ON HOVERING ON AN ITEM THE DATE OF LOGGING IS DISPLAYED.  
 *
 * @version    PHP 8.0.12 
 * @since      July 2022
 * @author     AtharvaShah
 */

 /* CACHING IMAGES*/
 session_cache_limiter('none'); 
 header('Cache-control: max-age='.(60*60*24*365));
 header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*365));
 
 if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
     header('HTTP/1.1 304 Not Modified');
     die();
  }
 
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "header.php";
require "connection.php";
require "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];
flush(); 
ob_flush();

function getposterpath($name, $author){
    $merge=$name."+".$author;
    $url = 'https://www.googleapis.com/books/v1/volumes?q='.$merge.'&orderBy=relevance';
    
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'Content-Type: application/json'
    ]);
    
    $response = curl_exec($curl);
    $response=json_decode($response,true);
    curl_close($curl);
    
    if (empty($response['items'][0]['volumeInfo']['imageLinks']['thumbnail'])) {
        $response = "https://www.prokerala.com/movies/assets/img/no-poster-available.jpg";
    }
    else {
        $response = $response['items'][0]['volumeInfo']['imageLinks']['thumbnail'];
    }
    // print_r ($response['items'][0]['volumeInfo']['imageLinks']['thumbnail']);
    return $response;
    
}
?>


<html>
<head>
<!--Bootstrap Link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!--Custom Link-->
<link rel="stylesheet" href="CSS/media_book.css">
</head>
<body>

<div class="heading">
  <h1>Your Books<span>"So many books, so little time." -  Frank Zappa</span></h1>
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
 
    $html_book="<br><br><section class='cards-wrapper'>"; // $html_book stores the html code for the movie cards
    
    $sql = "SELECT DISTINCT `book`, `author`, `date` FROM `data` where book != '' and username='$username' order by `date` DESC  LIMIT $start_from, $per_page_record;";
    if ($query = mysqli_query($con, $sql)) {
        $totalbookcount=mysqli_num_rows($query);
        if ($totalbookcount > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $book_name=$row['book'];
                $book_author=$row['author'];
                $book_logged=date("F jS, Y", strtotime($row['date']));

               
                $stripnamebook=$stripped = str_replace(' ', '+', $book_name);
                $stripnameauthor=$stripped = str_replace(' ', '+', $book_author);
                

                // one single div tag for each movie
                $html_book.="<div class='card-grid-space'>";
                    // image tag for the movie
                    $html_book.="<div class='card' style='background-image:url(";
                    $html_book.= getposterpath($stripnamebook, $stripnameauthor);  // get the poster path from the api
                    $html_book.=")'";
                    $html_book.=">";
                
                    $html_book.="<div>"; 
                    $html_book.="<div class='logged-date'>". $book_logged ."</div>"; 
                    $html_book.="</div>";  // end of div for the movie name


                    $html_book.="</div>"; // end of card

                    $html_book.="<h1 class='moviename'>". $book_name."</h1>";
                    $html_book.="<div class='tags'>"; // div for the tags
                    $html_book.="<div class='tag'>". $book_author."</div>";
                    $html_book.="</div>"; // end of tags
                    $html_book.="</div>"; //end of card-grid-space

            }
        }else{
            $html_book.="No Books Logged";
        }
}
    
    $html_book.="</section>";
    echo $html_book;

?>

<!--PAGINATION ROW -->
<center>
 <div class="pagination">
        <?php
        $query="SELECT DISTINCT count(DISTINCT `book`) FROM `data` where book != '' and username='$username'";
        $rs_result = mysqli_query($con, $query);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];

        echo "</br>";
        // CALCULATING THE NUMBER OF PAGES
        $total_pages = ceil($total_records / $per_page_record);
        $pageLink = "";

        // SHOW PREVIOUS BUTTON IF NOT ON PAGE 1
        if ($page >= 2) {
            echo "<a href='media_book.php?page=" . ($page - 1) . "'>  Prev </a>";
        }

        // SHOW THE LINKS TO EACH PAGE IN THE PAGINATION GRID 
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                $pageLink .= "<a class = 'active' href='media_book.php?page="
                    . $i . "'>" . $i . " </a>";
            } else {
                $pageLink .= "<a href='media_book.php?page=" . $i . "'>" . $i . " </a>";
            }
        }
        echo $pageLink;

        // SHOW NEXT BUTTON IF NOT ON LAST PAGE
        if ($page < $total_pages) {
            echo "<a href='media_book.php?page=" . ($page + 1) . "'>  Next </a>";
        }
        ?>
    </div><!--END OF PAGINATION ROW -->
</center>

<body>
</html>

<?php mysqli_close($con); ?>