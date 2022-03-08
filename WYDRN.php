<?php

echo '
<style type="text/css">
div{
    font-size: 14px;
}
</style>
';


    //video game validation
    if ((!empty($_POST['Videogame'])) &&  (!empty($_POST['Platform']))){
        $videogame=$_POST['Videogame'];
        $platform=$_POST['Platform']; 

        if ((!empty($videogame)) && (!empty($platform)))
            $playing="<div> &#127918 Playing <b>".$videogame."</b> on ".$platform."</div>";
    }

    //music validation
    if ((!empty($_POST['Album'])) &&  (!empty($_POST['Artist']))){
        $album=$_POST['Album'];
        $artist=$_POST['Artist'];

        if ((!empty($album)) && (!empty($artist)))
            $listening="<div> &#127911 Listening to <b>".$album."</b> by <b>".$artist."</b></div>";
    }

    //book validation
    if ((!empty($_POST['Book'])) &&  (!empty($_POST['Author']))){
        $book=$_POST['Book'];
        $book=trim($book,".");
        $author=$_POST['Author'];

        if ((!empty($book)) && (!empty($author)))
            $reading="<div> &#128213 Reading <b>".$book."</b> by <b>".$author."</b></div>";
    }

    //movie validation
    if ((!empty($_POST['Movie'])) &&  (!empty($_POST['MovieRelease']))){
        $movie=$_POST['Movie'];
        $movierelease=$_POST['MovieRelease'];

        if ((!empty($movie)) && (!empty($movierelease)))
            $watching="<div> &#128253 Watching <b>".$movie."</b> (".$movierelease.")"."</div>";
    }

    //tv validation
    if ((!empty($_POST['TV'])) &&  (!empty($_POST['StreamPlatform']))){
        $TV=$_POST['TV'];
        $streamplatform=$_POST['StreamPlatform'];
        if ((!empty($TV)) && (!empty($streamplatform)))
            $binging="<div> &#128250 Binging <b>".$TV."</b> on ".$streamplatform."</div>";
    }


    if (!empty($playing)) echo $playing."<BR>";
    if (!empty($listening)) echo $listening."<BR>";
    if (!empty($reading)) echo $reading."<BR>";
    if (!empty($watching)) echo $watching."<BR>";
    if (!empty($binging)) echo $binging."<BR>";

    if ((empty($playing))&& (empty($listening))&& (empty($reading))&& (empty($watching))&& (empty($binging)))
        echo "<div> &#128542 Nothing to see here.</div>";
    ?>