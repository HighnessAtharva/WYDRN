<?php
/*

DESCRIPTION: THIS WILL BE THE SOCIAL FEED. 

*/
session_start();
error_reporting(E_ERROR | E_PARSE);
include "connection.php";
include "functions.php";
include "header2.php";
$user_data = check_login($con);
$username = $user_data['user_name'];

$sql="SELECT `username`, `videogame`,`platform`,`album`,`artist`,`book`,`author`,`movie`,`year`,`tv`,`streaming`,`datetime`, `profile_pic` from `data` INNER JOIN `users` on `user_name` = `username` WHERE `username` in (SELECT `followed_username` from social where `follower_username`='$username') ORDER BY `datetime` DESC;";
if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) > 0) {
        for ($i=0;$i<=mysqli_num_rows($query);$i++){
        $row[$i] = mysqli_fetch_array($query);
        
        $person=$row[$i]['username'];
        $profile_pic=$row[$i]['profile_pic'];
        
        $videogame= $row[$i]['videogame'];
        $platform=$row[$i]['platform'];
        
        $album=$row[$i]['album'];
        $artist=$row[$i]['artist'];
        
        $book=$row[$i]['book'];
        $author=$row[$i]['author'];
        
        $movie=$row[$i]['movie'];
        $year=$row[$i]['year'];
        
        $tv=$row[$i]['tv'];
        $streaming=$row[$i]['streaming'];
        
        $datetime=$row[$i]['datetime'];

        if (empty($person)){
            echo "You are all caught up!";
        
        // if (empty($videogame) && empty($album) && empty($book) && empty($movie) && empty($tv) ){
        //    echo "You are all caught up!";
        }else{
            echo("<img src=". $profile_pic. " style='width: 50px; height: 50px; border-radius: 50%;' alt='Profile Picture'/>");
            
            echo("<a href='profile.php?user_name=". $person."'>".$person."</a><br>");

        if ((!empty($videogame)) && (!empty($platform))){
            $playing="<div> &#127918 Playing <b>".$videogame."</b> on ".$platform."</div>";
            echo $playing;
        }
        
        if ((!empty($album)) && (!empty($artist))){
            $listening="<div> &#127911 Listening to <b>".$album."</b> by <b>".$artist."</b></div>";
            echo $listening;
        }
        if ((!empty($book)) && (!empty($author))){
        $reading="<div> &#128213 Reading <b>".$book."</b> by <b>".$author."</b></div>";
        echo $reading;
        }
        
        if ((!empty($movie)) && (!empty($year))){
            $watching="<div> &#128253 Watching <b>".$movie."</b> (".$year.")"."</div>";
            echo $watching;
        }
        
        if ((!empty($tv)) && (!empty($streaming))){
        $binging="<div> &#128250 Binging <b>".$tv."</b> on ".$streaming."</div>";
            echo $binging;
         }
        echo($datetime."<br>"); 
        echo "<br><br>";
            
    } //else ends
}   
}
else{
    echo "Nothing to show here";
}    
}

?>

