<?php
require('fpdf.php');


class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetY(10);
        // Logo
        $this->Image('Pictures/Zairul.jpg',20,10,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'My Profile',1,0,'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

/*
$text ="Hello world. I am using FPDF!";
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,$text);
$pdf->Output();
*/

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
//for($i=1;$i<=40;$i++)
    //$pdf->Cell(10,40,'Printing line number '.$i,0,1);
    $pdf->SetY(50);
    $pdf->SetX(20);
    $pdf->Cell(20,10,'Hello, my name is Wan!');
    $pdf->Ln(5);
    //$pdf->SetY(50);
    //$pdf->SetX(15);
    $pdf->Cell(20,10,'This is my profile page.');
$pdf->Output();
?>

