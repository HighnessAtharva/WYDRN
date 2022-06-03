<?php
include "header2.php";
include "footer.php";
session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Live Search using AJAX</title>
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
            $("#display").html("");
        }

        else {

            $.ajax({
                type: "POST",
                url: "ajax_search_users.php",
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
