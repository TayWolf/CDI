<?php 
include "Conexion/conexion.php";
include "Conexion/base.php";
require('FPDF/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->Rect(5  , 5, 200, 285);
$fecha=date('Y-m-d');
setlocale(LC_ALL,"es_ES");
$fechaAc= date("d-m-Y",strtotime($fecha));
$pdf->Ln(2);
$pdf->SetFont('Helvetica','B',16);
$pdf->Cell(144,8,"Laboratorios CDI",1,0);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(46,8,"Fecha: ".$fechaAc,1,1);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(10,8,"No.",1,0,'L');
$pdf->Cell(88,8,"Nombre del articulo",1,0,'L');
$pdf->Cell(23,8,"Por pedir",1,0,'L');
$pdf->Cell(23,8,"Existencia",1,0,'L');
$pdf->Cell(23,8,"Maximo",1,0,'L');
$pdf->Cell(23,8,"Minimo",1,0,'L');
$pdf->Ln(2);
$queryC = "SELECT * FROM `articulos` WHERE `existencia` < `minimo` "; 
            $resultresC = $mysqli->query($queryC);
            $nu=1;
            while ($roresC = $resultresC->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA DE LA COLUMNA
            {
            $nombreArt=$roresC["nombre"];
            $existencia=$roresC["existencia"];
            $maximo=$roresC["maximo"];
            $minimo=$roresC["minimo"];
            $perd=$minimo-$existencia;
            $pdf->Ln(6);
            $pdf->SetFont('Helvetica','',10);
            $pdf->Cell(10,6,"".$nu,1,0,'L');
			$pdf->Cell(88,6,"".utf8_decode($nombreArt),1,0,'L');
			$pdf->Cell(23,6,"".$perd,1,0,'C');
			$pdf->Cell(23,6,"".$existencia,1,0,'C');
			$pdf->Cell(23,6,"".$maximo,1,0,'C');
			$pdf->Cell(23,6,"".$minimo,1,0,'C');
			$nu++;
            }

$queryT = "SELECT COUNT(idArticulo) as totali FROM `articulos` WHERE `existencia` < `minimo` "; 
            $resultresT = $mysqli->query($queryT);
            while ($roresT = $resultresT->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                      DE LA COLUMNA
            {
            $totalR=$roresT["totali"]; 
            }

			/*$prueba=prueba;
		 for ($i=0; $i <= $totalR ; $i++) { 
		         	$inc=8*$i;
				$pdf->Rect(10, 28+$inc, 10, 8);
				$pdf->Rect(20, 28+$inc, 88, 8);
				$pdf->Rect(108, 28+$inc, 23, 8);
				$pdf->Rect(131, 28+$inc, 23, 8);
				$pdf->Rect(154, 28+$inc, 23, 8);
				$pdf->Rect(177, 28+$inc, 23, 8);
				       }*/


$pdf->Output();
 ?>