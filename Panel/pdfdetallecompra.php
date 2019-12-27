<?php session_start();
//conexion con la base de dtos
include "Conexion/conexion.php";
include "Conexion/base.php";
require('FPDF/fpdf.php');

$idCompra=$_REQUEST["idCompra"];
$miCabecera = array('Caducidad', 'Cantidad','Unidad','Nombre Articulo','Costo Unitario','% ','Importe','IVA','Total');
$misDatos = array();

        
      

   $query="SELECT usuarios.nombreUser,Proveedores.*,compra.* FROM `compra` join usuarios on compra.idAlmacenista=usuarios.idUser join Proveedores on Proveedores.idProveedor=compra.idProveedor where compra.idCompra=$idCompra";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
       {
        $nombreP=$row['nombreP'];
        $direccionPro=$row['direccion'];
        $poblacionP=$row['poblacion'];
        $coloniaP=$row['colonia'];
        $cpPr=$row['codigo_postal'];
        $telefonoPr=$row['telefonoUno'];
        $subtotalito=$row['subtotalito'];
        $ivaGral=$row['iva'];
        $totalGral=$row['total'];
             
            $aux=explode('-', $fechasalida);
            $fechasalida=$aux[2].'-'.$aux[1].'-'.$aux[0]; 
            
            if ($ExistenciaAnt=='') {
                $ExistenciaAnt='null';
            }

        }

        $queryArr="SELECT * FROM `compraarticulo` where idCompra=$idCompra";
    $resultArr = $mysqli->query($queryArr);
    while ($rowArr = $resultArr->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
       {
        $fechaCaducidadA=$rowArr['fechaCaducidad'];
        $unidadA=$rowArr['unidad'];
        $cantidadArtA=$rowArr['cantidadArt'];
        $nombreArticuloA=$rowArr['nombreArticulo'];
        $descuentoA=$rowArr['descuento'];
        $costoUn=$rowArr['costoArticulo'];

        $ivaa=$rowArr['iva'];
        $totalArticulo=$rowArr['totalArticulo'];
        $impor=$costoUn*$cantidadArtA;
        $tos=$ivaa+$totalArticulo;
        array_push($misDatos,array(
            'caducidad' => $fechaCaducidadA,
            'cantidad'=>$cantidadArtA,
            'unidad' => $unidadA,
            'nombreArticulo' => $nombreArticuloA,
            'costo_Unitario' => $costoUn,
            'descuento' => $descuentoA,
            'importe' => $totalArticulo,
           
            'IVA' => $ivaa,
        'Total' => $tos));
    
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
        $this->SetFillColor(41,58,74);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        // foreach($cabecera as $fila)
        // {
        

            $this->CellFitSpace(17,7, utf8_decode($cabecera[0]),1, 0 , 'L', true);
            $this->CellFitSpace(15,7, utf8_decode($cabecera[1]),1, 0 , 'L', true );
            $this->CellFitSpace(15,7, utf8_decode($cabecera[2]),1, 0 , 'L', true );
            $this->CellFitSpace(70,7, utf8_decode($cabecera[3]),1, 0 , 'L', true );
            $this->CellFitSpace(19,7, utf8_decode($cabecera[4]),1, 0 , 'L', true );
            $this->CellFitSpace(10,7, utf8_decode($cabecera[5]),1, 0 , 'L', true );
            $this->CellFitSpace(15,7, utf8_decode($cabecera[6]),1, 0 , 'L', true );
            $this->CellFitSpace(15,7, utf8_decode($cabecera[7]),1, 0 , 'L', true );
            $this->CellFitSpace(15,7, utf8_decode($cabecera[8]),1, 0 , 'L', true );
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
            
            $this->CellFitSpace(17,7, utf8_decode($fila['caducidad']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(15,7, utf8_decode($fila['cantidad']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(15,7, utf8_decode($fila['unidad']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(70,7, utf8_decode($fila['nombreArticulo']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(19,7, utf8_decode($fila['costo_Unitario']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(10,7, utf8_decode($fila['descuento']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(15,7, utf8_decode($fila['importe']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(15,7, utf8_decode($fila['IVA']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(15,7, utf8_decode($fila['Total']),1, 0 , 'L', $bandera );

            
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

//bioclinico
$pdf->Ln(3);//eje de las x
$pdf->Cell(1);//eje de las y
$pdf->SetFont('Helvetica','B',14); //fuente
$pdf->Cell(50,8,"LABORATORIO CDI");
$pdf->Cell(30,4," ");

$pdf->Ln(0);
$pdf->Cell(145);
$pdf->SetFont('Helvetica','B',$letra);
$pdf->Cell(15,5,"Fecha:");
//FECHA.
$pdf->Ln(0);
$pdf->Cell(160);
$pdf->SetFont('Helvetica','',$letra);
$pdf->Cell(25,5,$fecha);

$pdf->Ln(7);
$pdf->Cell(1);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(50,5,"Nombre del proveedor: ");

//$pdf->Cell();
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(25,5,utf8_decode("$nombreP"));

$pdf->Ln(5);
$pdf->Cell(1);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(22,5,"Direccion: ");

$pdf->SetFont('Helvetica','',12);
$pdf->Cell(70,5,utf8_decode("$direccionPro"));

$pdf->Ln(5);
$pdf->Cell(1);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(22,5,utf8_decode("Población: "));

$pdf->SetFont('Helvetica','',12);
$pdf->Cell(70,5,utf8_decode("$poblacionP"));

$pdf->Ln(5);
$pdf->Cell(1);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(19,5,utf8_decode("Colonia: "));

$pdf->SetFont('Helvetica','',12);
$pdf->Cell(70,5,utf8_decode("$coloniaP"));

$pdf->Ln(5);
$pdf->Cell(1);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(13,5,utf8_decode("C.P. : "));

$pdf->SetFont('Helvetica','',12);
$pdf->Cell(10,5,"$cpPr");

$pdf->Ln(5);
$pdf->Cell(1);
$pdf->SetFont('Helvetica','B',12);
$pdf->Cell(20,5,utf8_decode("Teléfono:"));

$pdf->SetFont('Helvetica','',12);
$pdf->Cell(10,5,"$telefonoPr");

 

$pdf->tablaHorizontal($miCabecera, $misDatos);

$pdf->Ln(3);
$pdf->Cell(161);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(15,5,utf8_decode("Subtotal:"),1);
$pdf->Cell(15,5,utf8_decode("$subtotalito"),1);

$pdf->Ln(5);
$pdf->Cell(161);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(15,5,utf8_decode("IVA:"),1);
$pdf->Cell(15,5,utf8_decode("$ivaGral"),1);

$pdf->Ln(5);
$pdf->Cell(161);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(15,5,utf8_decode("Total:"),1);
$pdf->Cell(15,5,utf8_decode("$totalGral"),1);

// $pdf->Ln(0);
// $pdf->Cell(135);
// $pdf->SetFont('Helvetica','B',$letra);
// $pdf->Cell(135,30,'Existencia Actual: '.$existenciaactual);

$pdf->Output();
$mysqli->close();
?>



  




  