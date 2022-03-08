<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<html>
<head><title>Profile</title> 
<link href="profile.css" rel="stylesheet"></head>
<body>


<!--Top Right Button (Logout)-->
<div style="position: fixed; top: 1em; right: 1em; padding:10px;">
    <a href="logout.php">Logout</a>
</div>

<!--Top Left Button (Add Data to Profile)-->
<div style="position:fixed; top: 1em;left: 1em; padding:10px;">
    <a href="WYDRN.html">Add to WYDRN</a>
</div>

<div class="shadow overflow">
    <div id="header"></div>

        <div id="profile">

        <div class="image"><img src="https://a4-images.myspacecdn.com/images03/2/85a286a4bbe84b56a6d57b1e5bd03ef4/300x300.jpg" alt=""/></div>

        <div name="" style="margin-bottom: 20px; border-bottom: 3px solid #f9dd94;">
            <span style=" font-family:Baskerville,Times,'Times New Roman',serif; font-size:25px; color:#000000;font-variant:small-caps; text-align:center;font-weight:bold;"><?php echo $user_data['user_name']; ?></span>
        </div>

      

        <!--Videogame, Album, Book, Movie and TV will be below here. -->
        <div name="activity" style="margin-right:30px; word-wrap: break-word;">
            <?php include( "WYDRN.php");?>
        </div>

    </div>  <!-- This DIV is the end of the bottom half of the card. White Section-->
</div> <!-- This DIV is the end of the entire card-->

</body>
</html