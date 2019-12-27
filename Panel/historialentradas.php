<?php session_start();
//conexion con la base de dtos
include "Conexion/conexion.php";
include "Conexion/base.php";
require('FPDF/fpdf.php');

$idAr=$_REQUEST["idAr"];
$miCabecera = array('Fecha de Entrada','Usuario','Articulo','Cantidad','Caducidad');
$misDatos = array();

$existenciaactual=0;      
      

    $query="SELECT * FROM `entradaArticulo` WHERE idArticulo=$idAr";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
       {
        $nombreArticulo=$row['nombreArticulo'];
        $cantidadEntrada=$row['cantidadArt'];
        $idEntrada=$row['idEntrada'];
         $idArticulo=$row['idArticulo'];
         $fechaCaducidad=$row['fechaCaducidad'];

         $query45="SELECT * FROM `articulos` WHERE idArticulo=$idArticulo";
        $result45 = $mysqli->query($query45);
        while ($row45 = $result45->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA DE LA COLUMNA
           {
                $existenciaactual=$row45['existencia'];
                
           }
        
        $query2="SELECT * FROM `entrada` WHERE idEntrada=$idEntrada";
        $result2 = $mysqli->query($query2);
        while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA DE LA COLUMNA
           {
                $fechaEntrada=$row2['fechaEntrada'];
                $idAlmacenista=$row2['idAlmacenista'];
           }
               
        $query3="SELECT * FROM `usuarios` WHERE idUser=$idAlmacenista";
        $result3 = $mysqli->query($query3);
        while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA DE LA COLUMNA
           {
                $usuario=$row3['nombreUser'];
           }

       
        $aux=explode('-', $fechaEntrada);
        $fechaEntrada=$aux[2].'-'.$aux[1].'-'.$aux[0]; 
        
        // if ($ExistenciaAnt=='') {
        //     $ExistenciaAnt='null';
        // }

        array_push($misDatos,array(
            'fechaEntrada'=>$fechaEntrada,
            'usuario' => $usuario,
            'nombreArticulo' => $nombreArticulo,
            
            'cantidad' => $cantidadEntrada,
            'caducidad' => $fechaCaducidad

        ));
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
        $this->SetXY(10,30);
        $this->SetFont('Arial','B',8);
        $this->SetFillColor(41,58,74);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        // foreach($cabecera as $fila)
        // {
            $this->CellFitSpace(25,7, utf8_decode($cabecera[0]),1, 0 , 'L', true );
            $this->CellFitSpace(40,7, utf8_decode($cabecera[1]),1, 0 , 'L', true );
            $this->CellFitSpace(50,7, utf8_decode($cabecera[2]),1, 0 , 'L', true );
            $this->CellFitSpace(25,7, utf8_decode($cabecera[3]),1, 0 , 'L', true );
            $this->CellFitSpace(25,7, utf8_decode($cabecera[4]),1, 0 , 'L', true );
            
       // }
    }
 
    function datosHorizontal($datos)
    {
        $this->SetXY(10,37);
        $this->SetFont('Arial','',8);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            
            $this->CellFitSpace(25,7, utf8_decode($fila['fechaEntrada']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(40,7, utf8_decode($fila['usuario']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(50,7, utf8_decode($fila['nombreArticulo']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(25,7, utf8_decode($fila['cantidad']),1, 0 , 'L', $bandera );
             $this->CellFitSpace(25,7, utf8_decode($fila['caducidad']),1, 0 , 'L', $bandera );

            
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
$pdf->Ln(0);//eje de las x
$pdf->Cell(1);//eje de las y
$pdf->SetFont('Helvetica','B',14); //fuente
$pdf->Cell(150,30,"LABORATORIO CDI HISTORIAL DE ENTRADAS");
$pdf->Cell(30,4," ");

$pdf->Ln(0);
$pdf->Cell(145);
$pdf->SetFont('Helvetica','B',$letra);
$pdf->Cell(150,30,"Fecha:");
//FECHA.
$pdf->Ln(0);
$pdf->Cell(160);
$pdf->SetFont('Helvetica','',$letra);
$pdf->Cell(150,30,$fecha);



$pdf->tablaHorizontal($miCabecera, $misDatos);

$pdf->Ln(0);
$pdf->Cell(135);
$pdf->SetFont('Helvetica','B',$letra);
$pdf->Cell(135,30,'Existencia Actual: '.$existenciaactual);

$pdf->Output();
$mysqli->close();
?>



  




  