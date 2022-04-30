<?php

/*

DESCRIPTION: THE MAIN PROFILE PAGE OF  THE USER. THE MOST IMPORTANT PAGE TO THIS PROJECT.
- CHECKS IF USER HAS LOGGED IN AND GRABS THE USERNAME FROM THE DATABASE. IF THE USERNAME IS MENTIONED IN THE URL ADDRESS, THE USERNAME IS GRABBED USING A "GET" REQUEST AND THE USER DATA CORRESPONDING TO THE USERNAME IS GRABBED FROM THE DATABASE. (MAY BE THE SAME USER OR MAY BE A PUBLIC PROFILE URL OF ANOTHER USER)
- THIS FILE INCLUDES THE DEPENDENCY - WYDRN.PHP

 */

session_start();
if(empty($_SESSION))
{
  header("Location: login.php");
}
include "connection.php";
include "functions.php";

$user_data = check_login($con);
if (isset($_GET['user_name'])) {
    $username = $_GET['user_name'];
} else {
    $username = $user_data['user_name'];
    set_active($username);
}



$sql = "SELECT profile_pic, background_pic FROM users WHERE user_name='$username'";
if ($query = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($query) == 1) {
        $row = mysqli_fetch_array($query);
        $profile_pic = $row['profile_pic'];
        $background_pic = $row['background_pic'];
    } else {
        die('That user does not exist' . mysqli_error($con));
    }
}

if (isset($_POST['clear'])) {
    $username_coded = $user_data['user_name']; //this is the user who is logged in
    $sql = "INSERT INTO `data`(`username`, `videogame`, `platform`, `album`, `artist`, `book`, `author`, `movie`, `year`, `tv`, `streaming`) VALUES ('$username_coded', '', '', '', '', '', '', '', '', '', '')";
    $result = mysqli_query($con, $sql);
}
?>


<!--
    HTML PART
-->

<!DOCTYPE html>
<html>
<head><title>Profile</title>
<!--ORDER OF PLACING CSS CDN AND SCRIPT IS IMPORTANT. CUSTOM CSS COMES LAST AS WE OVERRIDE BOOTSTRAP CLASSES.-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="CSS/profile.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<!--Top Right Button (Logout)-->
<input type="button" value="Logout" onclick="location.href='logout.php'" style="color:black; position: fixed; top: 1em; right: 1em; padding:10px; background-color: white; cursor:pointer;">


<!--Top Left Button (Add Data to Profile)-->
<input type="button" value="Add to WYDRN" onclick="location.href='welcome.php'" style="color:black; position: fixed; top: 1em; left: 1em; padding:10px; background-color: white; cursor:pointer;">

<div class="shadow overflow">
    <!--Background Image-->
    <div id="header" style="background-image:url(<?php echo $background_pic ?>)" alt="Background Image"></div>

        <div id="profile">

            <!--Profile Image-->
            <div class="image">
                <img src="<?php echo $profile_pic ?>" alt="Profile Picture"/>
            </div>

            <!--Username on Profile-->
            <div name="" style="margin-bottom: 20px; border-bottom: 3px solid #f9dd94;">
                <span style="font-family: 'Baskerville', 'Times', 'Times New Roman', 'serif'; font-size: 25px; color: #000000; font-variant: small-caps; text-align: center; font-weight: bold;"><?php echo $username ?></span>

            <!--Displays a Follow Button only if User is visiting another users page-->
            
            <!------------------------------------------------------------------------------------
            HERE COMPLEX LOGIC IS USED FOR THE ANCHOR TAG
            - If the user is visiting his own profile, the anchor tag is not displayed.
            - If the user is visiting another users profile, the anchor tag is displayed.
            - If the user is not following another user, the anchor tag is displayed with the text "Follow"
            - If the user is already following another user, the anchor tag is displayed with the text "Unfollow"
            --------------------------------------------------------------------------------------->

            <a style="color:black" href="follow.php?user_name=<?php 
            if (isset($_GET['user_name'])){ 
                if ($_GET['user_name'] != $user_data['user_name']){
                    echo $_GET['user_name'];
                }
            }
            ?>" 
            
            <?php 
            if (!isset($_GET['user_name'])){ 
                    echo 'hidden';
            }

            if (isset($_GET['user_name'])){ 
                if ($_GET['user_name'] == $user_data['user_name']){
                    echo 'hidden';
                }
            }
            
            if (!isset($_POST)) {
                    echo 'hidden';
                }
            ?>>
        <!--THE CONTENT OF THE A TAG GOES HERE [FOLLOW/UNFOLLOW] DEPENDING ON WHETHER A USER IS ALREADY FOLLOWING A PERSON OR NOT.-->
            <?php
            $user_data = check_login($con);
            $username = $user_data['user_name'];
            $sql = "SELECT `followed_username` FROM `social` WHERE `follower_username`='$username' and `followed_username`='$_GET[user_name]'";
            if ($query = mysqli_query($con, $sql)) {
                $result=mysqli_num_rows($query);
                if ($result == 0) {
                    echo "Follow";
                } else {
                  echo "Unfollow";
                }
            }
            ?>
        </a>
            
            
        
            


            </div>
        
        <!--Videogame, Album, Book, Movie and TV will be below here. -->
        <div name="activity" style="margin-right:30px; word-wrap: break-word; max-height: 200px;
  overflow: auto; ">
            <?php include "WYDRN.php";?>
        </div>

    </div>  <!-- This DIV is the end of the bottom half of the card. White Section-->
</div> <!-- This DIV is the end of the entire card-->

<!--STICKY FOOTER INCLUDED AT THE BOTTOM OF THE PAGE-->
<?php include "footer.php";
?>
<!--END OF MAIN BODY-->
</body>
</html>