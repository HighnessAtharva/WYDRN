<?php
include "connection.php";
include "functions.php";
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
<?php
    $html_album="<br><br><section class='cards-wrapper'>"; // $html_album stores the html code for the album cards
    
    $sql = "SELECT DISTINCT `album`, `artist`, `date` FROM `data` where album != '' and username='$username' order by `date` DESC";
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
    mysqli_close($con);
?>
</body>
</html>