<?php
include 'Config/conexion.php';

if (!defined('FPDF_FONTPATH')) {
	// Apuntar a la carpeta PDF donde hemos colocado las definiciones de fuente
	define('FPDF_FONTPATH', __DIR__ . '/PDF/');
}

require 'PDF/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'Reporte de Inventario', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Nombre', 1);
$pdf->Cell(40, 10, 'Cantidad', 1);
$pdf->Cell(40, 10, 'Precio', 1);
$pdf->Ln();

$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);

while ($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(20, 10, $fila['id'], 1);
	$pdf->Cell(60, 10, utf8_decode($fila['nombre']), 1);
	$pdf->Cell(40, 10, $fila['cantidad'], 1);
	$pdf->Cell(40, 10, '$' . number_format($fila['precio'], 2), 1);
	$pdf->Ln();
}

$pdf->Output();
?>