<?php 

/*

DESCRIPTION: THE MAIN PROFILE PAGE OF  THE USER. THE MOST IMPORTANT PAGE TO THIS PROJECT. 
- CHECKS IF USER HAS LOGGED IN AND GRABS THE USERNAME FROM THE DATABASE. IF THE USERNAME IS MENTIONED IN THE URL ADDRESS, THE USERNAME IS GRABBED USING A "GET" REQUEST AND THE USER DATA CORRESPONDING TO THE USERNAME IS GRABBED FROM THE DATABASE. (MAY BE THE SAME USER OR MAY BE A PUBLIC PROFILE URL OF ANOTHER USER)
- THIS FILE INCLUDES THE DEPENDENCY - WYDRN.PHP

*/

session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
    if (isset($_GET['user_name'])){
        $username=$_GET['user_name'];
        
    }else{
        $username=$user_data['user_name'];   

    }


    $sql="SELECT profile_pic, background_pic FROM users WHERE user_name='$username'";
                if($query=mysqli_query($con,$sql)){
                    if(mysqli_num_rows($query) ==1){
                        $row=mysqli_fetch_array($query);
                        $profile_pic=$row['profile_pic'];
                        $background_pic=$row['background_pic'];
                    }
                    else{
                        die('That user does not exist' . mysqli_error($con));
                    }
                }
 
?>

<html>
<head><title>Profile</title> 
<link href="css/profile.css" rel="stylesheet"></head>
<body style="">

<!--Top Right Button (Logout)-->
<input type="button" value="Logout" onclick="location.href='logout.php'" style="color:black; position: fixed; top: 1em; right: 1em; padding:10px; background-color: white; cursor:pointer;">


<!--Top Left Button (Add Data to Profile)-->
<input type="button" value="Add to WYDRN" onclick="location.href='welcome.php'" style="color:black; position: fixed; top: 1em; left: 1em; padding:10px; background-color: white; cursor:pointer;">
   


<div class="shadow overflow">
    <!--Background Image-->    
    <div id="header" style="background-image:url(<?php echo $background_pic?>)" alt="Background Image"></div>

        <div id="profile">
            
            <!--Profile Image-->
            <div class="image">
                <img src="<?php echo $profile_pic?>" alt="Profile Picture"/>
            </div>

            <!--Username on Profile-->
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