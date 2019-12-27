<?php
include "Conexion/conexion.php";
include "Conexion/base.php"; 
require('FPDF/fpdf.php');
// require("num2letras.php");
require("numeros.php");

$idOrdeCom = $_REQUEST['idCompra'];
$subtotal=0;
$iva=0;
$total=0;
$query = "SELECT ordenCompra.fechaEmitida,ordenCompra.nOrden,Proveedores.nombreP,ordenCompra.fechaPedido,ordenCompra.fechaEntrega FROM `ordenCompra` join Proveedores on Proveedores.idProveedor=ordenCompra.idProveedor WHERE ordenCompra.idCompra=$idOrdeCom "; 
$resultres = $mysqli->query($query);
while ($rores = $resultres->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                      DE LA COLUMNA
{
$fechaEmitida=$rores["fechaEmitida"];  
$nOrden=$rores["nOrden"];  
$nombreP=$rores["nombreP"];  
$fechaPedido=$rores["fechaPedido"];  
$fechaEntrega=$rores["fechaEntrega"];  
}

$pdf=new FPDF();
$pdf->AddPage();
$pdf->Rect(5  , 5, 200, 285); //el segundo valor es la separacion de rectangulo y hoja/el tercer valor es el ancho de la pagina
//$pdf->Ln(5);
$pdf->Image('content/images/cdi.png' , 5 ,5, 50 , 15);
		
		//$pdf->Ln(1);
        $pdf->Cell(125); 
        $pdf->SetFont('Helvetica', '',8);
        $pdf->Cell(35,7,utf8_decode('Fecha de Emision: '.$fechaEmitida));
        $pdf->Ln(6);
        $pdf->Cell(125); 
        $pdf->SetFont('Helvetica', '',8);
        $pdf->Cell(35,7,utf8_decode('No. Orden de Compra: '.$nOrden));


		$pdf->Ln(0);
		//$pdf->Ln(7);
        $pdf->Cell(70); 
        $pdf->SetFont('Helvetica','B',13);
        $pdf->Cell(35,7,utf8_decode('Orden de Compra'));


       




$pdf->Ln(10);
// $pdf->SetDrawColor(246,236,21);//colores amarillo
$pdf->Rect(5  , 5, 55, 35);
// $pdf->SetDrawColor(85,250,8);//colores verde
$pdf->Rect(60  , 5, 75, 35);
// $pdf->SetDrawColor(8,250,21);//colores azul claro
$pdf->Rect(135  , 5, 70, 35);
// $pdf->SetDrawColor(2,32,253);//colores azul fuerte
$pdf->Rect(5 , 40, 200, 25);
// $pdf->SetDrawColor(253,46,2);//colores rojo
$pdf->Rect(5, 227, 200,63);
// $pdf->SetDrawColor(89,2,253);//colores morado
$pdf->Rect(5, 230, 200,15);
// $pdf->Ln(130);//madre con cell
// $pdf->Cell(1);
// $pdf->SetFont('Helvetica' , 'B', 7);
// $pdf->Cell(10,10,"IVA:",1,0,"C");// aqui acaba esa madre
// $pdf->SetDrawColor(13,80,8);//colores verde feo
$pdf->Rect(5, 245, 200,15);










// $pdf->SetDrawColor(220,100,200);//colores rosa


         
        $pdf->Ln(1);
        $pdf->Cell(5); 
        $pdf->SetFont('Helvetica','B',11);
        $pdf->Cell(30,7,utf8_decode('ISO 9001:2015'));


       $pdf->Ln(15);
	   //$pdf->Ln(7);
       $pdf->Cell(1); 
       $pdf->SetFont('Helvetica','',11);
       $pdf->Cell(78,7,utf8_decode('Proveedor: '.$nombreP));


        
         
         

         $pdf->Cell(48);
         $pdf->Cell(30,7,utf8_decode('Fecha de Pedido: '.$fechaPedido));

         $pdf->Ln(7);
         $pdf->Cell(127);
         $pdf->Cell(30,7,utf8_decode('Fecha de Entrega: '.$fechaEntrega));

         $pdf->SetFillColor(140, 131, 130);
         $pdf->Rect(5, 70, 200, 5, 'DF');
         $pdf->Line(5, 70 , 205, 70);
         $pdf->Line(5, 75 , 205, 75);
         $pdf->Rect(5, 70, 30, 5, 'DF');
         $pdf->Rect(35, 70, 30, 5, 'DF');
         $pdf->Rect(65, 70, 100, 5, 'DF');
         $pdf->Rect(140, 70, 30, 5, 'DF');

         

         $pdf->Ln(21);

        $pdf->Cell(3);

        $pdf->SetFont('Helvetica','B',7); //fuente

        $pdf->Cell(26,5,"CANTIDAD","C");


        $pdf->Ln(0);

        $pdf->Cell(35);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(20,5,"UNIDAD","C");


        $pdf->Ln(0);

        $pdf->Cell(80);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(55,5,"CONCEPTO", "C");


        $pdf->Ln(0);

        $pdf->Cell(134);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(35,5,"COSTO UNITARIO","C");


         $pdf->Ln(0);

        $pdf->Cell(169);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(35,5,"IMPORTE","C");

       
        
       $pdf->SetFillColor(255,255,255);
        $pdf->Ln(1);
		$pdf->Rect(6, 77, 198, 150, 'F');
		//$pdf->SetXY(5, 1000);

		$queryC = "SELECT articulos.*,articulosOrdencompra.cantidad FROM articulos join articulosOrdencompra on articulosOrdencompra.idArticulo=articulos.idArticulo WHERE articulosOrdencompra.idCompra=$idOrdeCom "; 
            $resultresC = $mysqli->query($queryC);
            while ($roresC = $resultresC->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                      DE LA COLUMNA
            {
            $nombreArt=$roresC["nombre"];  
            $cantidadA=$roresC["cantidad"];  
            $medidaA=$roresC["medida"];  
            $costo_unitario=$roresC["costo_unitario"];  
            $iMpor=$cantidadA*$costo_unitario;
                $pdf->Ln(5);   
             //$pdf->Ln(0);
             $pdf->Cell(3);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(10,5,$cantidadA,0,0,"C");

             $pdf->Cell(15);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(15,5,$medidaA);

             $pdf->Cell(15);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(15,5,utf8_decode($nombreArt));

             $pdf->Cell(60);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(15,5,$costo_unitario);

             $pdf->Cell(18);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(15,5,$iMpor);
             $subtotal+=$iMpor;
             $iva=$subtotal*.16;
             $total=$subtotal+$iva;




            
            
            }
            $queryT = "SELECT COUNT(idCompra) AS total from articulosOrdencompra where idCompra = $idOrdeCom "; 
            $resultresT = $mysqli->query($queryT);
            while ($roresT = $resultresT->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                      DE LA COLUMNA
            {
            $totalR=$roresT["total"]; 
            }

         for ($i=1; $i <=$totalR ; $i++) { 
         	$inc=5*$i;
            $pdf->Ln(5);   
             //$pdf->Ln(0);
             /*$pdf->Cell(3);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(10,5,$cantidadA,0,0,"C");

             $pdf->Cell(15);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(15,5,$medidaA);

             $pdf->Cell(15);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(15,5,$nombreArt);

             $pdf->Cell(60);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(15,5,$costo_unitario);

             $pdf->Cell(18);
             $pdf->SetFont('Helvetica' , '', 7);
             $pdf->Cell(15,5,$iMpor);*/

            
             $pdf->Rect(5, 70+$inc, 200, 5);
             $pdf->Rect(5, 70+$inc, 30, 5);
             $pdf->Rect(35, 70+$inc, 30, 5);
             $pdf->Rect(65, 70+$inc, 75, 5);
             $pdf->Rect(140, 70+$inc, 30, 5);

		}

        
            //primer cuadro
        $pdf->Rect(140,230,30,5);
        $pdf->SetXY(0,0);
        $pdf->Ln(228);//madre con cell
        $pdf->Cell(130);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(30,10,"Subtotal:",0,0,"C");
        $pdf->Cell(1);
        $pdf->Cell(35,10,"$ ".$subtotal,0,0,"C");
        $pdf->Rect(170,230,35,5);//segunda celda
        //Aqui termina primer cuadro
        //Inicia segundo cuadro
        $pdf->Rect(140,235,30,5);
        $pdf->Ln(5);//madre con cell
        $pdf->Cell(1);
        $pdf->SetFont('Helvetica' , 'B', 7);
        //$pdf->Cell(120,10,"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",0,0,"C");// aqui acaba esa madre
        $pdf->Cell(120,10,strtoupper(convertir($total,2)),1,0,"C");
        $pdf->Cell(10);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(30,10,"IVA:",0,0,"C");
        $pdf->Cell(1);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(35,10,"$ ".$iva,0,0,"C");// aqui acaba esa madre
        $pdf->Rect(170,235,35,5);
        //termina segundo cuadro
        //inicia tercer cuadro
        $pdf->Rect(140,240,30,5);//Primer celda
        $pdf->Ln(7);//madre con cell
        $pdf->Cell(130);
        $pdf->SetFont('Helvetica' , 'B', 7);
         $pdf->Cell(30,5,"Total:",0,0,"C");
         $pdf->Cell(1);
        $pdf->SetFont('Helvetica' , 'B', 7);
         $pdf->Cell(35,5,"$ ".$total,0,0,"C");// aqui acaba esa madre
        $pdf->Rect(170,240,35,5);//Segunda celda
        //termina tercer cuadro
        //Requisitos de entrega
        $pdf->SetXY(0,0);
        $pdf->Ln(245);//madre con cell
        $pdf->Cell(-5);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(200,5,"Requisitos de entrega:",0,1,"C");// aqui acaba esa madre
        $pdf->Cell(-5);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(200,5,"Horario de entrega: de lunes a sabado de 8:00 a 14:00 hrs.",0,1,"L");// aqui acaba esa madre
        $pdf->Cell(-5);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(200,5,"Anexar orden de compra a la factura",0,1,"L");// aqui acaba esa madre
        $pdf->Ln(1);
        $pdf->Cell(-5);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(135,5,"Calidad:",0,1,"L");// aqui acaba esa madre
        $pdf->Ln(2);
        $pdf->Cell(-5);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(135,5,"Servicio:",0,1,"L");// aqui acaba esa madre
        $pdf->SetXY(0,0);
        $pdf->Ln(263);
        $pdf->Cell(136);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(65,0,"Nombre, fecha  y Firma de Recibido",0,1,"L");// aqui acaba esa madre
        $pdf->Rect(20,261,10,5);
        $pdf->Rect(20,268,10,5);
         $pdf->SetXY(0,0);
        $pdf->Ln(276);//madre con cell
        $pdf->Cell(-5);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(200,0,"Area y Persona (s) autorizada (s) para recibir :__________________________________________________",0,2,"L");// aqui acaba esa madre
        $pdf->SetAutoPageBreak(false);
        $pdf->Ln(5);
        $pdf->Cell(-5);
        $pdf->SetFont('Helvetica' , 'B', 7);
        $pdf->Cell(200,0,"Observaciones:____________________________________________________________________________",0,2,"L");// aqui acaba esa madre
        

		
   
$pdf->Output();
?>