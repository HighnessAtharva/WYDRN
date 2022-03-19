<?php
/*

DESCRIPTION: PAGE WITH FORM THAT TAKES USER INPUT SUCH AS VIDEO GAMES, BOOKS, MOVIES, TV AND MUSIC AND SHOWS THE TOP MENU BAR WITH THE OPTIONS TO DELETE USER, EDIT PROFILE, SHARE PROFILE URL WITH FRIENDS AND LOGOUT. PAGE IS DIVIDED INTO TWO COLUMNS WHERE THE FORM TAKES THE LEFT HALF AND THE RIGHT HALF CONSISTS OF "WYDRN" DESCRIPTION AND USAGE GUIDELINES

*/
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);
      
?>


<!--
    HTML PART
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WYDRN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background: rgb(27, 0, 36);
            background: linear-gradient(40deg, rgba(27, 0, 36, 1) 0%, rgba(45, 14, 68, 1) 50%, rgba(117, 0, 129, 1) 100%);
            color: rgba(255, 255, 255, 0.904)
        }
        
        h3 {
            color: rgba(255, 255, 255, 0.904);
        }

        .column {
            float: left;
            width: 50%;
            padding: 10px;
            margin-top:100px;
            }
    </style>
</head>


<body> 
<!-- START OF HEADER-->

    <!--LOGOUT-->
    <div style="font-size:20px; position: absolute; top: 0.5em; right: 1em; padding:5px;">
        <a style="color:white" href="logout.php">Logout</a>
    </div>

    <!--PROFILE-->
    <div style="font-size:20px; position: absolute; top: 0.5em; right: 5em; padding:5px;">
        <a style="color:white" href="profile.php?user_name=<?php echo $user_data['user_name']?>">Profile</a> 
    </div>

    <!--Delete Account-->
    <div style="font-size:20px; position: absolute; top: 0.5em; right: 9em; padding:5px;" >
        <a href="delete_user.php" style="color:white;">Delete</a>
    </div>

     <!--Edit Profile-->
    <div style="font-size:20px; position: absolute; top: 0.5em; right: 13.5em; padding:5px;" >
        <a href="edit_profile.php" style="color:white;">Edit Profile</a>
    </div>
    
    
    <!--WELCOME TO WRYDRN-->
    <div style="font-size:20px; position:absolute; color:white; top: 0.5em; right:20em; padding:5px;">
        <b>Welcome to WRYDN</b>
    </div>

<!-- END OF HEADER-->
    

<!--START OF MAIN  BODY-->
<!-- LEFT COLUMN-->
<div class="column">
    <form class="ms-5" method="POST" action="profile.php" name="userinput">
        <div style="margin-right: 100px;">
            <!--Video Games-->
            <h3 class="mb-3">Video Game</h3>
            <div class="mb-3 ms-3" name="videogame">
                Watchu playing son? 
                <input class="form-control" type="text" name="Videogame" placeholder="Elden Ring"><br> 
                Platform 
                <input type="text" class="form-control" name="Platform" placeholder="PC"><br>
            </div>

            <!--Music-->
            <h3 class="mb-3">Music</h3>
            <div class="mb-3 ms-3" name="album">
                What Album you spinnin'? 
                <input type="text" class="form-control" name="Album" placeholder="Cavalcade"><br> 
                Who's the Artist? 
                <input type="text" class="form-control" name="Artist" placeholder="Black Midi"><br>
            </div>

            <!--Books-->
            <h3 class="mb-3">Books</h3>
            <div class="mb-3 ms-3" name="book">
                What is an intellectual like yourself Reading? 
                <input type="text" name="Book" class="form-control" placeholder="Royal Assassin"><br> 
                
                Drop the name of the Author bro 
                <input type="text" class="form-control" name="Author" placeholder="Robin Hobb"><br>
            </div>

            <!--Movies-->
            <h3 class="mb-3">Movies</h3>
            <div class="mb-3 ms-3" name="movie">
                What movie we watchin' today matey? <input type="text" class="form-control" name="Movie" placeholder="The Batman"><br> Release Year <input type="text" class="form-control" name="MovieRelease" placeholder="2022"><br>
            </div>

            <!--TV-->
            <h3 class="mb-3">TV/Streaming</h3>
            <div class="mb-3 ms-3" name="TV">
                What TV series you watching RN hon? <input type="text" class="form-control" name="TV" placeholder="Peaky Blinders"><br> Where is it streaming/broadcasting? <input type="text" class="form-control" name="StreamPlatform" placeholder="BBC"><br>
            </div>
        </div>
        <form>
      
          <!--The div below puts the submit button below the first column at center-->
        
        <div class="text-center mb-lg-3">
            <button type="submit" class="btn btn-outline-primary btn-light btn-lg" style="margin-left:-100px">Submit</button>
        </div>

        </div>           
        <!--END OF LEFT COLUMN-->

        <!--RIGHT COLUMN-->
        <div class="column" >
            <div style="background:black; color:white;margin-right:30px; padding:20px;">
                <ul>    
                    <li>WYDRN is a website that allows you to instataneously add your current video games, music, books, movies, and TV  to your profile.  </li>
                    <li>You can then view your profile and see what you have added. </li>
                    <li> You can also search for other users and see their profiles.  </li>
                </ul> 
            </div>
        </div>
        <!--END OF RIGHT COLUMN-->
            
<!--END OF MAIN BODY-->             
</body>
</html>