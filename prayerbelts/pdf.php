<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Better table
function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(40, 35, 40, 45);
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 35, 40, 45);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new FPDF('P','pt','Letter');
// Column headings
//$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
// Data loading
//$data = $pdf->LoadData('countries.txt');
$pdf->SetFont('Arial','',16);
$pdf->AddPage();
//$pdf->BasicTable($header,$data);
//$pdf->AddPage();
//$pdf->ImprovedTable($header,$data);

$pdf->SetMargins(50,50,50);

$pdf->Image('images/logo.jpg',50,25,300,0,'JPG');

// Move to 8 cm to the right
//$pdf->Cell(80);
// Centered text in a framed 20*10 mm cell and line break
$pdf->Cell(0,75,'PACKING SLIP',0,0,'R');

$pdf->Line(50,90,560,90,'JPG');

$pdf->SetXY(50,110);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(75,15,'SHIP TO:',0,0,'L');
$pdf->SetFont('Arial','',14);
$pdf->Cell(300,15,'Jeff Saunders',0,0,'L');
$pdf->Cell(0,15,date("m/d/y"),0,1,'R');
$pdf->SetX(125);
$pdf->Cell(300,15,'217 Creekside Drive',0,1,'L');
$pdf->SetX(125);
$pdf->Cell(300,15,'Murphy, TX  75094',0,1,'L');
$pdf->SetY($pdf->GetY()+45);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(135,15,'ORDER NUMBER:',0,0,'L');
$pdf->SetFont('Arial','',14);
$pdf->Cell(0,15,'0940336071',0,1,'L');

$pdf->SetY($pdf->GetY()+10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,25,'FEATURE','TLB',0,'L');
$pdf->Cell(350,25,'ITEM','TB',0,'C');
$pdf->Cell(0,25,'QUANTITY','TRB',1,'R');

$pdf->SetY($pdf->GetY()+10);
$pdf->SetFont('Arial','',14);
$pdf->Cell(80,15,'MESSAGE:',0,0,'L');
$pdf->Cell(355,15,'In JESUS Name We Pray',0,0,'L');
$pdf->Cell(75,15,'1',0,1,'C');
$pdf->Cell(80,15,'COLOR:',0,0,'L');
$pdf->Cell(355,15,'Black w/White Embroidery',0,1,'L');
$pdf->Cell(80,15,'SIZE:',0,0,'L');
$pdf->Cell(355,15,'One Size - 48"',0,1,'L');
$pdf->Cell(80,15,'WIDTH:',0,0,'L');
$pdf->Cell(355,15,'One Width - 1 1/2"',0,1,'L');
$pdf->Line(50,$pdf->GetY()+10,560,$pdf->GetY()+10,'JPG');

//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
$pdf->Output('csv/packingslips/0940336071.pdf','F');
?>