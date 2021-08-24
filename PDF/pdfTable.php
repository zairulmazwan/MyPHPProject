<?php
require('fpdf.php');

class PDF extends FPDF {

    // Simple table
    function BasicTable($header, $data)
    {
        $this->SetFont('Arial','B',12);
        // Header
        foreach($header as $col)
            
            $this->Cell(35,7,$col,1);
        $this->Ln();

        $this->SetFont('Arial','',12);
        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(35,7,$col,1);
            $this->Ln();
        }
    }

}


$db = new SQLite3('C:\xampp\Data\StudentModule.db');

$sql = "SELECT PersonalId, Username, Name, Status, Role FROM User";
$stmt = $db->query($sql);

while($row=$stmt->fetchArray(SQLITE3_NUM)){

    $res [] = $row;

}

//print_r($res[0]['PersonalId']);
//$users = array();
//I am trying to prepare the res into a table
/*
for ($i=0; $i<count($res); $i++){
    
    
        $users [$i][0] = $res[$i]['PersonalId'] ;
        $users [$i][1] = $res[$i]['Username'] ;
        $users [$i][2] = $res[$i]['Name'] ;
        $users [$i][3] = $res[$i]['Status'] ;
        $users [$i][4] = $res[$i]['Role'] ;
    
}
*/

//print_r($users);



$pdf = new PDF(); //create an object of PDF
$pdf->SetFont('Arial','B',12);

$pdf->AddPage();
$pdf->Cell(60,25,'List of Users');
$pdf->Ln(25);
$pdf->SetFont('Arial','',12);
$header = array("ID","Username","Name","Status","Role");

$pdf->BasicTable($header,$res);
$pdf->Output();



