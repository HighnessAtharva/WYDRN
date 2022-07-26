<?php

/**
 * USERS CAN SEARCH FOR OTHER USERS BY USERNAME AND VISIT THEIR PROFILE.
 *
 * @version    PHP 8.0.12 
 * @since      May 2022
 * @author     AtharvaShah
 */


session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
require "header.php";
?>

<!DOCTYPE html>
<html>
<head>
   <title>Live Search using AJAX</title>
   <!--Bootstrap Link-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

     <!-- CSS Stylesheet -->
     <link rel="stylesheet" href="CSS/search_users.css">

   <!--JQUERY-->
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>


<body>
<center>
<br><br>
<!-- Search box. -->
   <input type="text" id="search" placeholder="Search for users" autocomplete="off"/>

   <!-- Suggestions will be displayed in below div. -->
   <div id="display">


   </div>
</center>


<script>
    //function fill()
    function fill(Value) {
    $('#search').val(Value);
    $('#display').hide();
    }

    //Jquery for AJAX
    $(document).ready(function() {
    $("#search").keyup(function() {
        var name = $('#search').val();
        if (name == "") {
            $("#display").html("No Results Found");
        }

        else {

            $.ajax({
                type: "POST",
                url: "search_users_ajax.php",
                data: {
                    search: name
                },
                success: function(html) {
                    $("#display").html(html).show();
                }
            });
        }
    });
    });
</script>
</body>
</html>
