<?php

/**
 * Header Navbar for all the pages.
 *
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */


include_once("connection.php");
if(empty($_SESSION))
{
  header("Location: login.php");
}
if(isset($_SESSION['user_id']))
	{
		$id = $_SESSION['user_id'];
		$query = "select `profile_pic` from users where user_id = '$id'";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0){
			$pic = mysqli_fetch_array($result);
			$pfp= $pic[0];
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- custom css link -->
    <link href="CSS/header.css" rel="stylesheet" crossorigin="anonymous">

    <style type="text/css">
        /* ============ desktop view ============ */
        @media all and (min-width: 992px) {
            .navbar .nav-item .dropdown-menu {
                display: none !important;
            }
            .navbar .nav-item:hover .dropdown-menu {
                display: block !important;
            }
            .navbar .nav-item .dropdown-menu {
                margin-top: 0 !important;
            }
        }
        /* ============ desktop view .end// ============ */
    </style>
</head>


    <!-- <div class="container"> -->
    <!-- ============= COMPONENT ============== -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="welcome.php"><img src="images/website/logo.png" height="50" width="50"/></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
            <div class="collapse navbar-collapse" id="main_nav">
                <ul class="navbar-nav ms-auto">
                    
                     <!-- Browse Media Dropdown-->
                     <li class="nav-item dropdown">
                        <li class="nav-link" href="#" data-bs-toggle="dropdown">Browse</li>
                        <ul class="dropdown-menu dropdown-menu-right" id="browse">
                            <li><a class="dropdown-item" href="MediaAPIs/Book/index.php">
                            <span>&#128213 Book</span>
                            </a></li>

                            <li><a class="dropdown-item" href="MediaAPIs/Movie/index.php">
                            <span>&#128253 Movie</span> 
                            </a></li>

                            <li><a class="dropdown-item" href="MediaAPIs/Music/index.php">
                            <span>&#127911 Music</span>
                            </a></li>

                            <li><a class="dropdown-item" href="MediaAPIs/TV/index.php">
                            <span>&#128250 TV</span>
                            </a></li>

                            <li><a class="dropdown-item" href="MediaAPIs/Videogame/index.php">
                            <span>&#127918 Videogame</span>
                            </a></li>
                        </ul>
                    </li>
                

                    <!-- DIARY, FEED AND SEARHC USERS -->
                    <li class="nav-item"><a class="nav-link" href="diary.php">Diary</a></li>
                    <li class="nav-item"><a class="nav-link" href="feed.php">Feed</a></li>
                    <li class="nav-item"><a class="nav-link" href="search_users.php">Search Users</a></li>
                   


                    <!-- Your Media Dropdown -->
                    <li class="nav-item dropdown">
                        <li class="nav-link" href="#" data-bs-toggle="dropdown">Media</li>
                        <ul class="dropdown-menu dropdown-menu-end" id="media">
                            <li><a class="dropdown-item" href="media_book.php">
                            <span>&#128213 Book</span>
                            </a></li>

                            <li><a class="dropdown-item" href="media_movie.php">
                            <span>&#128253 Movie</span>
                            </a></li>

                            <li><a class="dropdown-item" href="media_music.php">
                            <span>&#127911 Music</span>
                            </a></li>

                            <li><a class="dropdown-item" href="media_tv.php">
                            <span>&#128250 TV</span>
                            </a></li>

                            <li><a class="dropdown-item" href="media_videogame.php">
                            <span>&#127918 Videogame</span>
                            </a></li>

                        </ul>
                    </li>


                    <!-- Your Account Dropdown -->
                    <li class="nav-item dropdown">
                        <li class="nav-link" href="#" data-bs-toggle="dropdown"> <img src="<?php echo $pfp;?>" class="h-10 w-10 rounded-circle" width="25" height="25"> </li>
                        <ul class="dropdown-menu dropdown-menu-end" id="your-account">
                            
                            <li><a class="dropdown-item" href="profile.php"> 
                            <span><img src="images/Icons/profile.png" class='header-icon'>Profile</span>
                            </a></li>
                            
                            <li><a class="dropdown-item" href="edit_profile.php"> 
                            <span><img src="images/Icons/settings.png" class='header-icon'>Settings</span>
                            </a></li>
                            
                            <li><a class="dropdown-item" href="Exports/import_export.php"> 
                            <span><img src="images/Icons/importexport.png" class='header-icon'>Import/Export</span>
                            </a></li>
                            
                            <li><a class="dropdown-item" href="logout.php"> 
                            <span><img src="images/Icons/logout.png" class='header-icon'>Logout</span>
                            </a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            <!-- navbar-collapse.// -->
        </div>
        <!-- container-fluid.// -->
    </nav>
<!-- ============= COMPONENT END// ============== -->