<?php
include "connection.php";
include "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];

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
<?php
    $html_book="<br><br><section class='cards-wrapper'>"; // $html_book stores the html code for the movie cards
    
    $sql = "SELECT DISTINCT `book`, `author`, `date` FROM `data` where book != '' and username='$username' order by `date` DESC";
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
<body>
</html>