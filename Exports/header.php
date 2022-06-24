
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <style type="stylesheet">
        /* ============ desktop view ============ */

        @media all and (min-width: 992px) {
            .navbar .nav-item .dropdown-menu {
                display: none;
            }
            .navbar .nav-item:hover .dropdown-menu {
                display: block;
            }
            .navbar .nav-item .dropdown-menu {
                margin-top: 0;
            }
        }
        /* ============ desktop view .end// ============ */
    </style>
</head>

<body>

    <!-- <div class="container"> -->

    <!-- ============= COMPONENT ============== -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="welcome.php"><img src="../images/website/logos/WYDRN-logos_transparent.png" style="height:50px; width:50px;" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
            <div class="collapse navbar-collapse" id="main_nav">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../diary.php"> Diary </a></li>
                    <li class="nav-item"><a class="nav-link" href="../feed.php"> Social Feed </a></li>
                    <li class="nav-item"><a class="nav-link" href="../search_users.php"> Search Users </a></li>
                    <li class="nav-item"><a class="nav-link" href="../media.php"> Your Media </a></li>
                    <li class="nav-item dropdown">
                        <li class="nav-link" href="#" data-bs-toggle="dropdown"> <img src="https://picsum.photos/200" class="h-10 w-10 rounded-circle" style="height:25px; width:25px;"> </li>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="../profile.php"> Profile</a></li>
                            <li><a class="dropdown-item" href="../edit_profile.php"> Settings </a></li>
                            <li><a class="dropdown-item" href="import_export.php"> Import/Export</a></li>
                            <li><a class="dropdown-item" href="../logout.php"> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- navbar-collapse.// -->
        </div>
        <!-- container-fluid.// -->
    </nav>

    <!-- ============= COMPONENT END// ============== -->


    <!-- </div> -->
    <!-- container //  -->

</body>

</html>
