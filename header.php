<!-- HEADER is header to be used in the WELCOME page where the Clicking on Profile redirects with GET Request-->

<!-- START OF HEADER-->

    <!--LOGOUT-->
    <div style="font-size:20px; position: absolute; top: 0.5em; right: 1em; padding:5px;">
        <a style="color:black;" href="logout.php">Logout</a>
    </div>

    <!--PROFILE-->
    <div style="font-size:20px; position: absolute; top: 0.5em; right: 5em; padding:5px;">
        <a style="color:black" href="profile.php?user_name=<?php echo $user_data['user_name'] ?>">Profile</a>
    </div>

    <!--Delete Account-->
    <div style="font-size:20px; position: absolute; top: 0.5em; right: 9em; padding:5px;" >
        <a href="delete_user.php" style="color:black;">Delete</a>
    </div>

     <!--Edit Profile-->
    <div style="font-size:20px; position: absolute; top: 0.5em; right: 12.5em; padding:5px;" >
        <a href="edit_profile.php" style="color:black;">Edit Profile</a>
    </div>

     <!--Export Data-->
     <div style="font-size:20px; position: absolute; top: 0.5em; right: 18em; padding:5px;" >
        <a href="pdf.php" style="color:black;">Export</a>
    </div>

    
     <!--Feed-->
     <div style="font-size:20px; position: absolute; top: 0.5em; right: 22em; padding:5px;" >
        <a href="feed.php" style="color:black;">Feed</a>
    </div>

    <!--Feed-->
    <div style="font-size:20px; position: absolute; top: 0.5em; right: 25em; padding:5px;" >
        <a href="diary.php" style="color:black;">Diary</a>
    </div>


    <!--WELCOME TO WRYDRN-->
    <div style="font-size:20px; position:absolute; color:black; top: 0.5em; left:2.3em; padding:5px;">
    <h4>WRYDN</h4>
    </div>

<!-- END OF HEADER-->