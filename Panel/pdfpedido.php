<?php session_start();
//conexion con la base de dtos
include "Conexion/conexion.php";
include "Conexion/base.php";
require('FPDF/fpdf.php');

$idCompra=$_REQUEST["idCompra"];
$miCabecera = array('Cantidad', 'Unidad','Nombre Articulo','Área uso','Observaciones ');
$misDatos = array();

        
      

  $query="SELECT controlPedidos.* , usuarios.nombreUser FROM `controlPedidos` join usuarios on usuarios.idUser=controlPedidos.idUser  where controlPedidos.idSolicitud=$idCompra";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
       {
        $fechaPedido=$row['fechaPedido'];
        $noPedido=$row['noPedido'];
        $AreaPedido=$row['AreaPedido'];
        $PersonaPedido=$row['personaPedido'];
        $nombreUser=$row['nombreUser'];
       
        }
        $queryAi="SELECT * FROM `areaInterna` where idInterno=$AreaPedido";
        $resultAi = $mysqli->query($queryAi);
        while ($rowAi = $resultAi->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
           {
            $nombreAreaGral=$rowAi['nombreArea'];
           }

        

        $queryArr="SELECT * FROM `pedidoArticulo` where idPedido=$idCompra";
    $resultArr = $mysqli->query($queryArr);
    while ($rowArr = $resultArr->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
       {
        $cantidadPedido=$rowArr['cantidadPedido'];
        $unidadPedido=$rowArr['unidadPedido'];
        $nombreArt=$rowArr['nombreArt'];
        $areaUso=$rowArr['areaUso'];
        $observacionesPedido=$rowArr['observacionesPedido'];
        $queryAii="SELECT * FROM `areaInterna` where idInterno=$areaUso";
        $resultAii = $mysqli->query($queryAii);
        while ($rowAii = $resultAii->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
           {
            $nombreArea=$rowAii['nombreArea'];
           }
        
        array_push($misDatos,array(
            
            'cantidad'=>$cantidadPedido,
            'unidad' => $unidadPedido,
            'nombreArticulo' => $nombreArt,
            'nombreArea' => $nombreArea,
            'observacionesPedido' => $observacionesPedido));
    
    }

    

$fecha=date('d-m-Y'); //fecha del servidor
foreach ($misDatos as $key => $value) {
    foreach ($value as $k => $v) {
    //echo "$k :::: $v <br>";
    }
}

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // imagen de fondo
//    $this->Image('font2/boleta_pension.jpg',5,8,213);

}

function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10,50);
        $this->SetFont('Arial','B',8);
        $this->SetFillColor(140, 131, 130);//Fondo verde de celda
        $this->SetTextColor(0, 0, 0); //Letra color blanco
        // foreach($cabecera as $fila)
        // {
        

            $this->CellFitSpace(17,7, utf8_decode($cabecera[0]),1, 0 , 'L', true);
            $this->CellFitSpace(15,7, utf8_decode($cabecera[1]),1, 0 , 'L', true );
            $this->CellFitSpace(70,7, utf8_decode($cabecera[2]),1, 0 , 'L', true );
            $this->CellFitSpace(30,7, utf8_decode($cabecera[3]),1, 0 , 'L', true );
            $this->CellFitSpace(60,7, utf8_decode($cabecera[4]),1, 0 , 'L', true );
            
       // }
    }
 
    function datosHorizontal($datos)
    {
        $this->SetXY(10,57);
        $this->SetFont('Arial','',8);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            
            $this->CellFitSpace(17,7, utf8_decode($fila['cantidad']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(15,7, utf8_decode($fila['unidad']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(70,7, utf8_decode($fila['nombreArticulo']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(30,7, utf8_decode($fila['nombreArea']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(60,7, utf8_decode($fila['observacionesPedido']),1, 0 , 'L', $bandera );

           
             
            
            $this->Ln();//Salto de línea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }
 
    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
 
    //***** Aquí comienza código para ajustar texto *************
    //***********************************************************
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);
 
        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;
 
        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }
 
        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
 
        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
 
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }
 
    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }





}


$letra=11;
$letraDos=10;
// Creación del objeto de la clase heredada
$pdf = new PDF('P', 'mm', 'A4');
#Establecemos los márgenes izquierda, arriba y derecha: 
//$pdf->SetMargins(, 25 ,0); 

#Establecemos el margen inferior: 
//$pdf->SetAutoPageBreak(true,25);
$pdf->AddPage();

$pdf->Image('content/images/cdi.png',10,10,55,18);
$pdf->SetFillColor(140, 131, 130);

$pdf->Ln(2);
$pdf->Cell(130);
$pdf->SetFont('Helvetica','',$letra);
$pdf->Cell(25,5,"FOLIO:  ".$noPedido);

$pdf->Ln(15);
$pdf->Cell(70);
$pdf->SetFont('Helvetica','',$letra);
$pdf->Rect(70, 25, 85, 10, 'DF');
$pdf->Cell(26,5,"SOLICITUD DE ALMACEN");

setlocale(LC_ALL,"es_ES");
$fecha5=strftime("%d de %B del %Y",strtotime($fechaPedido));



$pdf->Ln(0);
$pdf->Cell(151);
$pdf->SetFillColor(254, 247, 246);
$pdf->Rect(152, 25, 50, 10, 'DF');
$pdf->SetFont('Helvetica','',$letra);
$pdf->Cell(26,5,$fecha5);

$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFillColor(140, 131, 130);
$pdf->Rect(10, 42, 45, 5, 'DF');
$pdf->SetFillColor(140, 131, 130);
$pdf->Rect(10, 37, 45, 5, 'DF');

$pdf->SetFont('Helvetica','',$letra);
$pdf->Cell(25,5,"Area solicitante");
$pdf->Cell(15);
$pdf->Cell(147,5,utf8_decode("$nombreAreaGral"),1,0,"C");

$pdf->Ln(5);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','',$letra);
$pdf->Cell(25,5,"Solicitado por");
$pdf->Cell(15);
$pdf->Cell(147,5,utf8_decode("$PersonaPedido"),1,0,"C");





 

$pdf->tablaHorizontal($miCabecera, $misDatos);
//$pdf->SetXY(10,82);


//$pdf->SetFillColor(254, 247, 246);
//$pdf->Rect(50, 25, 151, 5, 'DF');
$pdf->Ln(5);
$pdf->SetFont('Helvetica','',6);
$pdf->Cell(16,4,"S/C",1,0,"C");
$pdf->Cell(55,4,utf8_decode("AUTORIZÓ:"),1,0,"L");
$pdf->Cell(70,4,utf8_decode("ENTREGÓ:"),1,0,"L");
$pdf->Cell(51,4,utf8_decode("RECIBIÓ: $PersonaPedido"),1,0,"L");

$pdf->Ln(4);
$pdf->SetFont('Helvetica','',6);
$pdf->Cell(142,4,utf8_decode("REF. COMP-PROC-01"),0,0,"C");
$pdf->Cell(50,4,utf8_decode("COM-FORM-02"),0,0,"L");

$pdf->Ln(4);
$pdf->Cell(192,0,"",1,0,"C");

//$pdf->Cell(15);
//$pdf->Cell(147,5,utf8_decode("Armina Flores Molina"),1,0,"C");
// $pdf->Ln(0);
// $pdf->Cell(135);
// $pdf->SetFont('Helvetica','B',$letra);
// $pdf->Cell(135,30,'Existencia Actual: '.$existenciaactual);

$pdf->Output();
$mysqli->close();
?>



  




  