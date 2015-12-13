<?php
ini_set('display_errors',1);

require('fpdf.php');

class PDF extends FPDF
{
    //Load data
    function LoadData($file)
    {
        //Read file lines
        $lines=file($file);
        $data=array();
        foreach($lines as $line)
            $data[]=explode(';',chop($line));
        return $data;
    }
    
    //Simple table
    function BasicTable($header,$data)
    {
        //Header
        foreach($header as $col)
            $this->Cell(60,7,$col,1);
        $this->Ln();
        //Data
        foreach($data as $row)
        {
            foreach($row as $col)
            {
                $this->Cell(60,6,$col,1);
            }
            $this->Ln();
        }
    }
}
    
    $pdf=new PDF();
    
    //Data loading
    $data=$pdf->LoadData('test.txt');
    //set font for the entire document
    $pdf->SetFont('TIMES','B',20);
    
    $pdf->SetAuthor('Langot Benjamin & Jean francois galietti');
    $pdf->SetTitle('Liste des eleves pdf');
    
    $pdf->AddPage();
    //display the title with a border around it
    $pdf->SetXY(50,20);
    $pdf->Cell(100,10,'Liste des eleves',1,0,'C',0);
    $pdf->Ln();
    $pdf->Ln();

    //Column titles
    $header=array('Nom', 'Classe');
    
    $pdf->BasicTable($header,$data);
    $pdf->Output();
?>

/*
//create a FPDF object
$pdf=new FPDF();

//set document properties
$pdf->SetAuthor('Langot Benjamin & Jean francois galietti');
$pdf->SetTitle('Liste des eleves pdf');

//set font for the entire document
$pdf->SetFont('TIMES','B',20);

//set up a page
$pdf->AddPage('P'); 

//display the title with a border around it
$pdf->SetXY(50,20);
$pdf->SetDrawColor(50,60,100);
$pdf->Cell(100,10,'Liste des eleves',1,0,'C',0);

//Set x and y position for the main text, reduce font size and write content
$pdf->SetXY (10,50);
$pdf->SetFontSize(10);


$pdf->Cell(50,10,'Thierry henriette',1,0,'C',0);
$pdf->Cell(50,10,'Terminal A',1,0,'C',0);

$pdf->Cell(50,10,'Jeannine Ninja',1,0,'C',0);
$pdf->Cell(50,10,'Pierre Rolefou',1,0,'C',0);

//Output the document
$pdf->Output('example1.pdf','I'); 

?>*/