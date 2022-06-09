<?php

/*

DESCRIPTION: MYSQL CONNECTIVITY WITH PHP IS DEFINED AND CONNECTED HERE

*/


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "WYDRN";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect!");
}
