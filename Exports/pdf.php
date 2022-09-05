<?php

/**
 * - UTILITY EXPORT TOOL ALLOWING THE USER TO EXPORT THE DATA TO PDF IN A TABULAR FORMAT ALONG WITH DATETIME AND RECORDED ACTIVITY FROM THE DATABASE. THE USER MUST BE LOGGED IN TO DO SO. 
 * - BE CAREFUL OF THE DEPENDENCIES OF THIS FILE. IT INCLUDES, REQUIRES AND EXTENDS OTHER FILES SUCH AS FPDF AND PDF_MYSQL_TABLE.
 * 
 * @version    PHP 8.0.12 
 * @since      June 2022
 * @author     AtharvaShah
 */

require('FPDF/mysql_table.php');
include ('../connection.php');
include("../functions.php");

session_start();	
if(empty($_SESSION))
{
  header("Location: ../login.php");
}
$user_data = check_login($con);
$username=$user_data['user_name'];   


class PDF extends PDF_MySQL_Table{
function Header()
{   
    global $username;
    // Title
    $this->SetFont('Courier','B',40);
    $this->Cell(0,6,'Data Export for '.strtoupper($username),0,1,'C');
    $this->Ln(15);

    $this->SetFont('Courier','B',15);
    $this->Cell(0,6,'Generated On: '. printable_date(date("Y-m-d")) ,0,1,'C');
    $this->Ln(2);

    $this->SetFont('Courier','I',15);
    $this->Cell(0,6,'Prepared for you by your friends at WYDRN. Happy Logging!',2,1,'C');
    $this->Ln(20);
    // Ensure table header is printed
    parent::Header();
}
}

$pdf = new PDF();



/*********
CELL SYNTAX = Cell(float width [, float height [, string txt [, mixed border 0 or 1 [, int ln 0, 1,2  [, string align 'C" is Center [, boolean fill [, mixed link]]]]]]])
*********/

// table properties
$prop = array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(210,245,255),
            'padding'=>5,
            // 'width'=>350
          );

/*********
VIDEOGAMES
*********/
$pdf->AddPage();
$sql = "SELECT DATE_FORMAT(datetime, '%D %b %Y | %H:%i') AS DATE, CONCAT_WS(' on ', videogame, platform) AS VIDEOGAMES from data where username='$username' AND videogame != ''";

$pdf->Cell(50,10,'Video Games',1,2,'C');

//empty transparent cell to keep margin between heading and table
$pdf->Cell(50,10,'',0,2,'C');
$pdf->AddCol('DATE',40,'','C');
$pdf->AddCol('VIDEOGAMES',370,'','C');
$pdf->Table($con,$sql, $prop);


/*********
ALBUMS
*********/
$pdf->AddPage();
$sql = "SELECT DATE_FORMAT(datetime, '%D %b %Y | %H:%i') AS DATE, CONCAT_WS(' by ', album, artist) AS ALBUMS from data where username='$username' AND album != ''";

$pdf->Cell(50,10,'Albums',1,2,'C');

//empty transparent cell to keep margin between heading and table
$pdf->Cell(50,10,'',0,2,'C');
$pdf->AddCol('DATE',40,'','C');
$pdf->AddCol('ALBUMS',370,'','C');
$pdf->Table($con,$sql, $prop);

/*********
BOOKS
*********/
$pdf->AddPage();
$sql = "SELECT DATE_FORMAT(datetime, '%D %b %Y | %H:%i') AS DATE, CONCAT_WS(' by ', book, author) AS BOOKS from data where username='$username' AND book != ''";


$pdf->Cell(50,10,'Books',1,2,'C');

//empty transparent cell to keep margin between heading and table
$pdf->Cell(50,10,'',0,2,'C');
$pdf->AddCol('DATE',40,'','C');
$pdf->AddCol('BOOKS',370,'','C');
$pdf->Table($con,$sql, $prop);

/*********
TV
*********/
$pdf->AddPage();
$sql = "SELECT DATE_FORMAT(datetime, '%D %b %Y | %H:%i') AS DATE, CONCAT_WS(' on ', tv, streaming) AS SHOWS from data where username='$username' AND tv != ''";


$pdf->Cell(50,10,'TV',1,2,'C');

//empty transparent cell to keep margin between heading and table
$pdf->Cell(50,10,'',0,2,'C');
$pdf->AddCol('DATE',40,'','C');
$pdf->AddCol('SHOWS',370,'','C');
$pdf->Table($con,$sql, $prop);


/*********
MOVIES
*********/
$pdf->AddPage();
$sql = "SELECT DATE_FORMAT(datetime, '%D %b %Y | %H:%i') AS DATE, CONCAT_WS(' - ', movie, year) AS MOVIES from data where username='$username' AND movie != ''";


$pdf->Cell(50,10,'Movies',1,2,'C');

//empty transparent cell to keep margin between heading and table
$pdf->Cell(50,10,'',0,2,'C');
$pdf->AddCol('DATE',40,'','C');
$pdf->AddCol('MOVIES',370,'','C');
$pdf->Table($con,$sql, $prop);

// ob_end_clean() will clear all the echoed output. REMEDY AGAINST  FPDF error: Some data has already been output, can't send PDF file in C:\xampp\htdocs\
ob_end_clean();
$pdf->Output();
?>