<?php

echo '
<style type="text/css">
div{
    font-size: 14px;
}
</style>
';

	include("connection.php");
    $user_data = check_login($con);
    $username=$user_data['user_name'];

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
        $videogame=$_POST['Videogame'];
        $platform=$_POST['Platform']; 

        if ((!empty($videogame)) && (!empty($platform)))
            $playing="<div> &#127918 Playing <b>".$videogame."</b> on ".$platform."</div>";
    }

    //music validation
    if ((!empty($_POST['Album'])) &&  (!empty($_POST['Artist']))){
        global $album, $artist; 
        $album=$_POST['Album'];
        $artist=$_POST['Artist'];

        if ((!empty($album)) && (!empty($artist)))
            $listening="<div> &#127911 Listening to <b>".$album."</b> by <b>".$artist."</b></div>";
    }

    //book validation
    if ((!empty($_POST['Book'])) &&  (!empty($_POST['Author']))){
        global $book, $author;  
        $book=$_POST['Book'];
        $book=trim($book,".");
        $author=$_POST['Author'];

        if ((!empty($book)) && (!empty($author)))
            $reading="<div> &#128213 Reading <b>".$book."</b> by <b>".$author."</b></div>";
    }

    //movie validation
    if ((!empty($_POST['Movie'])) &&  (!empty($_POST['MovieRelease']))){
        global $movie, $movierelease; 
        $movie=$_POST['Movie'];
        $movierelease=$_POST['MovieRelease'];

        if ((!empty($movie)) && (!empty($movierelease)))
            $watching="<div> &#128253 Watching <b>".$movie."</b> (".$movierelease.")"."</div>";
    }

    //tv validation
    if ((!empty($_POST['TV'])) &&  (!empty($_POST['StreamPlatform']))){
        global $TV, $streamplatform; 
        $TV=$_POST['TV'];
        $streamplatform=$_POST['StreamPlatform'];
        if ((!empty($TV)) && (!empty($streamplatform)))
            $binging="<div> &#128250 Binging <b>".$TV."</b> on ".$streamplatform."</div>";
    }

    // insert the fields into the database if at least one of the above fields is filled.
    if ((!empty($videogame)) || (!empty($album)) || (!empty($book)) || (!empty($movie)) || (!empty($TV))) 
    {
        $sql="INSERT INTO `data`(`username`, `videogame`, `platform`, `album`, `artist`, `book`, `author`, `movie`, `year`, `tv`, `streaming`) 
        VALUES ('$username', '$videogame', '$platform', '$album', '$artist', '$book', '$author', '$movie', '$movierelease', '$TV', '$streamplatform')";
        
        $result=mysqli_query($con,$sql);

        // Check if insert statement was successful and display the relevant message    
        if($result){
            echo "The record has been inserted successfully successfully!<br>";
        }
        else{
            echo "Record not inserted. ERROR -> ". mysqli_error($con);
        }
    }   

   //this is stuff used to display the text on the browser. This will be eventually replaced by SQL queries. 
    if (!empty($playing)) echo $playing."<BR>";
    if (!empty($listening)) echo $listening."<BR>";
    if (!empty($reading)) echo $reading."<BR>";
    if (!empty($watching)) echo $watching."<BR>";
    if (!empty($binging)) echo $binging."<BR>";

    if ((empty($playing))&& (empty($listening))&& (empty($reading))&& (empty($watching))&& (empty($binging)))
        echo "<div> &#128542 Nothing to see here.</div>";


    
    ?>