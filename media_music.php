<?php
include "connection.php";
include "functions.php";
$user_data = check_login($con);
$username = $user_data['user_name'];

?>


<html>
<head>
<!--Bootstrap Link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!--Custom Link-->
<link rel="stylesheet" href="css/media_music.css">
</head>
<body>
Music Content shall be displayed here.
<body>
</html>