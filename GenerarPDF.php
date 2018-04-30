<?php
require  "fpdf/fpdf.php";
session_start();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);


//  Datos del Usuario
$texto1="Cliente: ".$_SESSION['usuario'];

$pdf->SetXY(25, 50);
$pdf->MultiCell(90,10,$texto1,1,"L");

// Fecha de la factura (inventada)

$texto2="Factura numero: 01 de fecha: 13/03/2018";
$pdf->SetXY(25, 90);
$pdf->Cell(150,10,$texto2,1,0,"C");


// Definicion de la cabecera de la tabla
$pdf->SetXY(40, 120);
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(0,255,255);
$pdf->Cell(80,10,"Articulo",1,0,"C",true);
$pdf->Cell(30,10,"Cant.",1,0,"C",true);
$pdf->Cell(20,10,"Pr/Und",1,0,"C",true);
$pdf->Cell(30,10,"Subt.",1,1,"C",true);
$total=0;


$pdf->SetTextColor(0,0,0);

// Recorrer el array de la variable de sesion con el carrito.

foreach ($_SESSION['carrito'] as $valor){
    $importe = $valor["cantidad"]*$valor["precio"];
    $pdf->SetX(40);
    $pdf->Cell(80,10,$valor["descripcion"],1,0,"L");
    $pdf->Cell(30,10,$valor["cantidad"],1,0,"C");
    $pdf->Cell(20,10,number_format($valor["precio"],2),1,0,"C");
    $pdf->Cell(30,10,number_format(($importe),2),1,1,"R");
    $total += $importe;
}


$pdf->SetX(120);
$pdf->Cell(50,10,"Total:",1,0,"C");
$pdf->Cell(30,10,number_format($total,2),1,1,"R");


$pdf->Output();