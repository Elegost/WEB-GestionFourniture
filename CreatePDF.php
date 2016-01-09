<?php

require('fpdf.php');

//Connect to your database
$servername = "localhost";
$username = "AllUser";
$password = "";
$dbname = "GestionFourniture";						
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

//Create new pdf file
$pdf=new FPDF();

//Open file
//$pdf->Open();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 25;
$y_axis=31;

//print column titles for the actual page
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('TIMES', 'B', 12);
$pdf->SetY($y_axis_initial);
$pdf->SetX(25);
$pdf->Cell(50, 6, 'Intitule', 1, 0, 'L', 1);
$pdf->Cell(30, 6, 'Quantite', 1, 0, 'C', 1);
$pdf->Cell(80, 6, 'Description', 1, 0, 'R', 1);

$y_axis = $y_axis + $row_height;

//Select the Products you want to show in your PDF file
$mail = $_SESSION['Email'];
if($mail == "")
{
    $mail="blangot@u-psud.fr";
}
$sqlquery = "SELECT Intitule, Quantite, Description FROM Fourniture WHERE IDClasse = (SELECT IDClasse from Eleve WHERE Mail='$mail' )";
//echo($sqlquery);
$result = $conn->query($sqlquery);


//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;

while($row = $result->fetch_assoc() )
{
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(25);
        $pdf->Cell(50, 6, 'Intitule', 1, 0, 'L', 1);
        $pdf->Cell(30, 6, 'Quantite', 1, 0, 'C', 1);
        $pdf->Cell(80, 6, 'Description', 1, 0, 'R', 1);

        //Go to next row
        $y_axis = $y_axis + $row_height;

        //Set $i variable to 0 (first row)
        $i = 0;
    }

    $intitule = $row['Intitule'];
    $quantite = $row['Quantite'];
    $description = $row['Description'];

    $pdf->SetY($y_axis);
    $pdf->SetX(25);
    $pdf->Cell(50, 6, $intitule, 1, 0, 'L', 1);
    $pdf->Cell(30, 6, $quantite, 1, 0, 'C', 1);
    $pdf->Cell(80, 6, $description, 1, 0, 'R', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}

$conn->close();

//Create file
$pdf->Output('ListeDesFourniture.pdf','I');
?>