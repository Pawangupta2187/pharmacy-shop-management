<?php
include("dbpharmacy.php");
include("fpdf.php");
$id = $_GET['id'];
$sql = "SELECT M_name,Item_mrp,Item_quantity,Item_discount,Item_amount FROM `of_item`,`medicine` where medicine.M_id = of_item.Item_id AND Order_id = '$id'";
$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($conn));

$pdf = new FPDF( 'P', 'mm', 'A4' );
$pdf->AddPage();

$pdf->SetFillColor(224,235,255);
   $pdf->SetTextColor(0);
$pdf->SetFont('Arial','B',30);
    $pdf->Cell(50);
$pdf->Cell(40,20,"Pharmacy Invoice",0,1);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(20,20,"Date:- ".Date('d-m-Y'),0,0);
 $pdf->Cell(130);
$pdf->Cell(20,20,"Order no:- ".$id,0,0);


$pdf->SetFillColor(255,0,0);
   $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);

$pdf->SetFont('Arial','B',12);
$header = array('Medicine Name', 'MRP', 'Quantity', 'Discount','Total');

$pdf->Ln(22);
for($i=0;$i<count($header);$i++)
{
$pdf->Cell(38,12,$header[$i],1,0,'C',true);
}
$pdf->SetFillColor(224,235,255);
   $pdf->SetTextColor(0);
$pdf->SetFont('Arial','B',12);
    

while($rows = mysqli_fetch_assoc($resultset)) {
$pdf->SetFont('Arial','',12);
$pdf->Ln();

foreach($rows as $column) {
$pdf->Cell(38,12,$column,1);
}
}
$sql1 = "SELECT O_date,Amount FROM `order` where Order_id = '$id'";
$resultset1 = mysqli_query($con, $sql1) or die("database error:". mysqli_error($conn));
while($rows = mysqli_fetch_assoc($resultset1)) {
$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->Cell(114);
foreach($rows as $column) {
$pdf->Cell(38,12,$column,1);
}
}

$pdf->Ln(140);
$pdf->Cell(130);

$pdf->Cell(20,20,"Pharmacy-shop-management",0,1);
$pdf->Output();
?>

