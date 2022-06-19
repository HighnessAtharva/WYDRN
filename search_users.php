<?php
/*

DESCRIPTION: SEARCH PAGE FOR THE USERS. USERS CAN SEARCH FOR USERS BY USERNAME.  

*/

include "header2.php";

session_start();
if (empty($_SESSION)) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
   <title>Live Search using AJAX</title>
   <!--Bootstrap Link-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
            $("#display").html("");
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
<?php include "footer.php"; ?>
