<?php

/*

DESCRIPTION: 
- UTILITY EXPORT TOOL ALLOWING THE USER TO EXPORT THE DATA TO PDF IN A TABULAR FORMAT ALONG WITH DATETIME AND RECORDED ACTIVITY FROM THE DATABASE. THE USER MUST BE LOGGED IN TO DO SO. 
- BE CAREFUL OF THE DEPENDENCIES OF THIS FILE. IT INCLUDES, REQUIRES AND EXTENDS OTHER FILES SUCH AS FPDF AND PDF_MYSQL_TABLE.

*/

require('FPDF/mysql_table.php');
include ('../connection.php');
include("../functions.php");

session_start();	
if(empty($_SESSION))
{
  header("Location: login.php");
}
$user_data = check_login($con);
$username=$user_data['user_name'];   



class PDF extends PDF_MySQL_Table{
function Header()
{   
    global $username;
    // Title
    $this->SetFont('Arial','',15);
    $this->Cell(0,6,'Data Export --'.$username.'-- '.date("Y-m-d"),0,1,'C');
    $this->Ln(10);
    // Ensure table header is printed
    parent::Header();
}
}

$pdf = new PDF();
$pdf->AddPage();
// First table: output all columns
$sql = "SELECT datetime,
        CONCAT_WS(' - ', videogame, platform) AS VIDEOGAME,
        CONCAT_WS(' - ', album, artist) AS ALBUM,
        CONCAT_WS(' - ', book, author) AS BOOK,
        CONCAT_WS(' - ', movie, year) AS MOVIE,
        CONCAT_WS(' - ', tv, streaming) AS TV
        from data where username='$username'";
        
$pdf->Table($con,$sql);
$pdf->Output();
?>