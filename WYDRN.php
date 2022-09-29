<?php

/**
 *- STANDARDIZES USER INPUT IN PROPER FORMAT AND INSERTS INTO THE DATABASE. IF ALL FIELDS ARE EMPTY, INSERTS NOTHING AND DISPLAYS APPROPRIATE MESSAGE ON THE PROFILE CARD
 * - IF AT LEAST ONE OF THE FIELDS IS NOT EMPTY, INSERTS INTO THE DATABASE.
 * - DISPLAYS THE LATEST DATA FROM THE DATABASE ON THE PROFILE PAGE. 
 * - THIS IS THE MAIN DEPENDENCY OF PROFILE.PHP  
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */


echo '
<style type="text/css">
div{
    font-size: 14px;
}
</style>
';

	require("connection.php");
    $user_data = check_login($con);
    //$username=$user_data['user_name'];

    if (isset($_GET['user_name'])){
        $username=$_GET['user_name'];
        
    }else{
        $username=$user_data['user_name'];

    }

    //global variables initializing to ''
    $videogame='';
    $platform='';
    $album='';
    $artist='';
    $book='';
    $author='';
    $movie='';
    $movierelease='';
    $TV='';
    $streamplatform='';

    //video game validation
    if ((!empty($_POST['Videogame'])) &&  (!empty($_POST['Platform']))){
        global $videogame, $platform;
        $videogame=mysqli_real_escape_string($con, $_POST['Videogame']);            
        $platform=mysqli_real_escape_string($con, $_POST['Platform']);              
    }

    //music validation
    if ((!empty($_POST['Album'])) &&  (!empty($_POST['Artist']))){
        global $album, $artist; 
        $album=mysqli_real_escape_string($con, $_POST['Album']);                    
        $artist=mysqli_real_escape_string($con, $_POST['Artist']);                  
    }

    //book validation
    if ((!empty($_POST['Book'])) &&  (!empty($_POST['Author']))){
        global $book, $author;  
        $book=mysqli_real_escape_string($con, $_POST['Book']); 
        $book=trim($book,".");                                                      
        $author=mysqli_real_escape_string($con, $_POST['Author']);                  
    }

    //movie validation
    if ((!empty($_POST['Movie'])) &&  (!empty($_POST['MovieRelease']))){
        global $movie, $movierelease; 
        $movie=mysqli_real_escape_string($con, $_POST['Movie']);                    
        $movierelease=mysqli_real_escape_string($con, $_POST['MovieRelease']);
    }

    //tv validation
    if ((!empty($_POST['TV'])) &&  (!empty($_POST['StreamPlatform']))){
        global $TV, $streamplatform; 
        $TV=mysqli_real_escape_string($con,$_POST['TV']);                           
        $streamplatform=mysqli_real_escape_string($con,$_POST['StreamPlatform']);    
    }

    // insert the fields into the database if at least one of the above fields is filled.
    if ((!empty($videogame)) || (!empty($album)) || (!empty($book)) || (!empty($movie)) || (!empty($TV))) 
    {
        $sql="INSERT INTO `data`(`username`, `videogame`, `platform`, `album`, `artist`, `book`, `author`, `movie`, `year`, `tv`, `streaming`) 
        VALUES ('$username', '$videogame', '$platform', '$album', '$artist', '$book', '$author', '$movie', '$movierelease', '$TV', '$streamplatform')";
        
        $result=mysqli_query($con,$sql);

        // Check if insert statement was successful and display the relevant message    
        //uncomment the echo statements when debugging
        if($result){
            //echo "The record has been inserted successfully successfully!<br>";
        }
        else{
            //echo "Record not inserted. ERROR -> ". mysqli_error($con);
        }
    }   

    //select the data corresponding to the user (tail 1)
    $sql="SELECT * FROM `data` WHERE `username` = '$username' ORDER BY `datetime` DESC LIMIT 1";
    if ($result=mysqli_query($con, $sql)){

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            //uncomment when debugging 
            //print_r($row);

            //set the data
            $videogame=$row['videogame']; 
            $platform=$row['platform']; 

            $album=$row['album']; 
            $artist=$row['artist']; 
            
            $book=$row['book'];
            $author=$row['author']; 
            
            $movie=$row['movie']; 
            $movierelease=$row['year']; 
            
            $TV=$row['tv']; 
            $streamplatform=$row['streaming'];

            //display the data [UNCOMMENT THE ELSE AND THE LINE BELOW IT FOR ALL 5 SECTIONS TO HIDE THE NOT PLAYING MESSAGES. EASY FIX.]
            if ((!empty($videogame)) && (!empty($platform)))
            $playing="<div class='media-item' id='media-game'>&#127918 Playing <b>".$videogame."</b> on ".$platform."</div>";
            // else
            // $playing="<div class='media-item'>&#127918 NOT PLAYING ANYTHING ❌</div>";

            if ((!empty($album)) && (!empty($artist)))
            $listening="<div class='media-item' id='media-music'>&#127911 Listening to <b>".$album."</b> by  ".$artist."</div>";
            // else
            // $listening="<div class='media-item'>&#127911 NOT LISTENING TO ANYTHING ❌</div>";

            if ((!empty($book)) && (!empty($author)))
            $reading="<div class='media-item' id='media-book'>&#128213 Reading <b>".$book."</b> by  ".$author."</div>";
            // else
            // $reading="<div class='media-item'>&#128213 NOT READING ANYTHING ❌</div>";

            if ((!empty($movie)) && (!empty($movierelease)))
            $watching="<div class='media-item' id='media-movie'>&#128253 Watching <b>".$movie."</b> (".$movierelease.")</div>";
            // else
            // $watching="<div class='media-item'>&#128253 NOT WATCHING ANYTHING ❌</div>";

            if ((!empty($TV)) && (!empty($streamplatform)))
            $binging="<div class='media-item' id='media-tv'> &#128250 Binging <b>".$TV."</b> on  ".$streamplatform."</div>";
            // else
            // $binging="<div class='media-item'>&#128250  NOT BINGING ANYTHING ❌</div>";
            }
        }
    }


    if ((empty($playing))&& (empty($listening))&& (empty($reading))&& (empty($watching))&& (empty($binging)))
    echo "<div> &#128542 Nothing to see here.</div>";

   //this is stuff used to display the text on the browser. This will be eventually replaced by SQL queries. 
    if (!empty($playing)) echo $playing."<BR>";
    if (!empty($listening)) echo $listening."<BR>";
    if (!empty($reading)) echo $reading."<BR>";
    if (!empty($watching)) echo $watching."<BR>";
    if (!empty($binging)) echo $binging."<BR>";

 
    ?>