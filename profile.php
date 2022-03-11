<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    if (isset($_GET['user_name'])){
        $username=$_GET['user_name'];
        
    }else{
        $username=$user_data['user_name'];   

    }

    // TESTING THIS SECTION
    $sql="SELECT profile_pic, background_pic FROM users WHERE user_name='$username'";
                if($query=mysqli_query($con,$sql)){
                    if(mysqli_num_rows($query) ==1){
                        $row=mysqli_fetch_array($query);
                        $profile_pic=$row['profile_pic'];
                        $background_pic=$row['background_pic'];
                    }
                }
    // TESTING THIS SECTION
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
    <a href="welcome.php">Add to WYDRN</a>
</div>

<div class="shadow overflow">
    <!--Background Image-->    
    <div id="header" style="background:<?php echo $background_pic?>;"></div>

        <div id="profile">
            
        <!--Profile Image-->
        <div class="image"><img src="<?php echo $profile_pic?>" alt="Profile Picture"/>
        
        </div>

        <div name="" style="margin-bottom: 20px; border-bottom: 3px solid #f9dd94;">
            <span style=" font-family:Baskerville,Times,'Times New Roman',serif; font-size:25px; color:#000000;font-variant:small-caps; text-align:center;font-weight:bold;"><?php echo $username?></span>
        </div>

      

        <!--Videogame, Album, Book, Movie and TV will be below here. -->
        <div name="activity" style="margin-right:30px; word-wrap: break-word;">
            <?php include( "WYDRN.php");?>
        </div>

    </div>  <!-- This DIV is the end of the bottom half of the card. White Section-->
</div> <!-- This DIV is the end of the entire card-->

</body>
</html