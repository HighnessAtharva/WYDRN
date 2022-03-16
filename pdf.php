<?php
require('FPDF/mysql_table.php');
include ('connection.php');
include("functions.php");

session_start();	
$user_data = check_login($con);
$username=$user_data['user_name'];   



class PDF extends PDF_MySQL_Table
{
function Header()
{
    // Title
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,'Data Export',0,1,'C');
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