<?php

/**
 * MYSQL CONNECTIVITY WITH PHP IS DEFINED AND CONNECTED HERE
 *
 * @version    PHP 8.0.12 
 * @since      May 2022
 * @author     AtharvaShah
 */


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "WYDRN";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}

?>

<!-------------------------------------------------------------------------------------
       			 NO HTML OR JAVASCRIPT IS REQUIRED FOR THIS PAGE
------------------------------------------------------------------------------------->