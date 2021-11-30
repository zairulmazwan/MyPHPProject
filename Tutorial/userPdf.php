<?php

require('../PDF/fpdf.php');

class PDF extends FPDF {

    // Simple table
    function BasicTable($header, $data)
    {
        $this->SetFont('Arial','B',12);
        // Header
        foreach($header as $col){
            $this->Cell(35,10,$col,1);
        }
        $this->Ln(); //new line after print the header

        $this->SetFont('Arial','',12);
        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(35,10,$col,1);
            $this->Ln();
        }
    }

}


$db = new SQLite3('C:\xampp\Data\StudentModule.db');

$sql = "SELECT userId, Username, firstName, Status, Role FROM User";
$stmt = $db->query($sql);

while($row=$stmt->fetchArray(SQLITE3_NUM)){

    $res [] = $row;

}


$pdf = new PDF(); //create an object of PDF
$pdf->SetFont('Arial','B',12);

$pdf->AddPage();
$pdf->Cell(60,25,'List of Users');
$pdf->Ln(25);
$pdf->SetFont('Arial','',12);
$header = array("ID","Username","Name","Status","Role");

$pdf->BasicTable($header,$res);
$pdf->Output();

