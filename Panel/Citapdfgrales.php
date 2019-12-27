
<?php session_start();
//conexion con la base de dtos
include "Conexion/conexion.php";
include "Conexion/base.php";
require('FPDF/fpdf.php');
//$idUserSes=$this->session->userdata('idUser');
$fecha=date('d-m-Y'); //fecha del servidor
$fechaU=date('Y-m-d');
$hora=date('H:i:s');
$idPa=$_REQUEST["idPa"];
$fecha=$_REQUEST["fecha"];
$idCit=$_REQUEST["idCit"];
$idUserSes=$_REQUEST["idU"];

$miCabecera = array('Sala','Estudio','Médico','Hora cita');
$misDatos = array();
$subtotal= array();

$actual = date('Y-m-d');
 // $queryModifica = "update citas set statusProceso=1 WHERE idCita='$idCit'";

 //        $mysqli->query($queryModifica);

        $queryVerificar="SELECT idCita FROM citas WHERE NOT EXISTS (SELECT idCita FROM responsableCita where idCita=$idCit)";
        $resultVerific = $mysqli->query($queryVerificar);
        while ($rowVerific = $resultVerific->fetch_array(MYSQLI_ASSOC))
           {
               // $hay="Entra ";
                $idCitaRespuesta=$rowVerific['idCita'];
                
           }
           // if ($idCitaRespuesta==$idCit) {
           //         $queryss="INSERT INTO responsableCita (idUsuario,idCita,fechaRecibo,horaRecibo) VALUES('$idUserSes','$idCit','$fechaU','$hora')";
           //              $mysqli->query($queryss);
           //              $error=$mysqli->error;
           //      }else{
                   
           //      }

                $queryRe="select * from usuarios where idUser=$idUserSes";
    $resultRe = $mysqli->query($queryRe);
    while ($rowRs = $resultRe->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
       {
        $nombreRecibio=$rowRs['nombreUser'];
        }
/**/

    $query="SELECT citas.idCita,citas.horallegada,citas.fechallegada,Estudio.nombreEstudio,Pacientes.nombrePaci,Pacientes.generoPaci,Pacientes.fechanaciPaci,Pacientes.edadPaci,Pacientes.telefonoPaci,Salas.nombre,Doctores.nombreDoc,citas.horarioCita,Remitente.nombreRem,usuarios.nombreUser,citas.statusProceso,
                                  (SELECT CASE WHEN citas.tipoCitaa!=8
                                    THEN
                                      (SELECT CASE WHEN clientes.precioEspecial=1
                                        THEN (SELECT (CASE WHEN COUNT(precio)=0
                                          THEN
                                            (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)
                                          ELSE
                                            (SELECT precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)
                                          END) as precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)
                                        ELSE
                                          (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)
                                        END)
                                    ELSE
                                      (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)
                                        END)
                                   as precio
                                FROM citas 
                                JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente
                                JOIN clientes ON Pacientes.cliente=clientes.idCliente
                                JOIN Estudio ON citas.idEstudio=Estudio.idEstudio
                                JOIN Doctores ON citas.idMedico=Doctores.idDoctor
                                JOIN Salas ON Salas.idSala=citas.idSala 
                                JOIN Remitente on Remitente.idRemitente=Pacientes.remitente join usuarios on usuarios.idUser=citas.idUser WHERE Pacientes.idPaciente=$idPa and citas.fechaCita ='$fecha'";
    $result = $mysqli->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
       {
        $nombreEstudio=$row['nombreEstudio'];
        $nombreUser=$row['nombreUser'];
        $nombreRem=$row['nombreRem'];
        $nombrePaci=$row['nombrePaci'];
        $fechanaciPaci=$row['fechanaciPaci'];
        $nombreSala=$row['nombre'];
        $nombreDoc=$row['nombreDoc'];
        $horarioCita=$row['horarioCita'];
        $idCita=$row['idCita'];
  

       //$importe="$".$row['precio'];

        array_push($subtotal, $row['precio']);

        $horallegada=$row['horallegada'];
        $fechallegada=$row['fechallegada'];

        $generoPaci=$row['generoPaci'];
        $edadPaci=$row['edadPaci'];
        $edadPaci=$row['edadPaci'];
        $telefonoPaci=$row['telefonoPaci'];
        $statusProceso=$row['statusProceso'];
        //echo "statusProceso $statusProceso";
        // if (($horallegada=="00:00:00" || $horallegada=="00:00:00.000000") && $fechallegada=="0000-00-00" && $statusProceso<="1") {
        //      $queryModific = "update citas set statusProceso='1', horallegada='$hora', fechallegada='$fechaU' WHERE idCita = '$idCita'  ";
        //     $mysqli->query($queryModific);
        // }

        




      
//$error=$mysqli->error;

      //  $aux=explode('-', $horarioCita);
       // $horarioCita=$aux[2].'-'.$aux[1].'-'.$aux[0]; 
        
       
        array_push($misDatos,array(
            'nombreEstudio'=>$nombreEstudio,
            'nombrePaci' => $nombrePaci,
            'nombreSala' => $nombreSala,
            'nombreDoc' => $nombreDoc,
            'horarioCita' => $horarioCita,
            //'importe' => $importe
        ));
    }


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
        $this->SetXY(10,38);
        $this->SetFont('Arial','B',8);
        $this->SetFillColor(41,58,74);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        /* foreach($cabecera as $fila)
         {
            $this->CellFitSpace(25,7, utf8_decode($cabecera[0]),1, 0 , 'L', true );
            $this->CellFitSpace(60,7, utf8_decode($cabecera[1]),1, 0 , 'L', true );
            $this->CellFitSpace(60,7, utf8_decode($cabecera[2]),1, 0 , 'L', true );
            $this->CellFitSpace(25,7, utf8_decode($cabecera[3]),1, 0 , 'L', true );
            $this->CellFitSpace(25,7, utf8_decode($cabecera[4]),1, 0 , 'L', true );

           
            
       }*/
    }
 
    function datosHorizontal($datos, $subtotal)
    {
        $porcentajeIva=0.16;
        $this->SetXY(10,45);
        $this->SetFont('Arial','',8);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        /*foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            
            $this->CellFitSpace(25,7, utf8_decode($fila['nombreSala']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(60,7, utf8_decode($fila['nombreEstudio']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(60,7, utf8_decode($fila['nombreDoc']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(25,7, utf8_decode($fila['horarioCita']),1, 0 , 'L', $bandera );
            //$this->CellFitSpace(25,7, utf8_decode($fila['importe']),1, 0 , 'L', $bandera );


            
            $this->Ln();//Salto de línea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }*/
        $subtotalFinal=0;
        foreach ($subtotal as $valor)
        {
            $subtotalFinal+=$valor;
        }
        $this->SetX(155);

    }
 
    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal, $subtotal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal, $subtotal);
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


 if ($generoPaci==1)
    $generoPaci="MASCULINO";
    else
    {
    $generoPaci="FEMENINO";
    }



$letra=11;
$letraDos=10;
// Creación del objeto de la clase heredada
$pdf = new PDF('P', 'mm', 'Letter');

$pdf->AddPage();

$pdf->Image('content/images/cdi.png' , 5 ,5, 50 , 15);
$pdf->Ln(0);//eje de las x
$pdf->Cell(5);//eje de las y
$pdf->SetFont('Helvetica','B',8); //fuente
$pdf->Cell(15,35,"NOMBRE DEL PACIENTE:");

$pdf->Ln(0);
$pdf->Cell(42);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,35,utf8_decode($nombrePaci));
//$pdf->Cell(30,4," ");


//fecha nacimiento
$pdf->Ln(0);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(20,45,"F.NAC:");

$pdf->Ln(0);
$pdf->Cell(15);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(20,45,utf8_decode($fechanaciPaci));

//EDAD
$pdf->Ln(0);
$pdf->Cell(87);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,35,"EDAD:");

$pdf->Ln(0);
$pdf->Cell(97);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,35,$edadPaci.utf8_decode(" AÑOS"));


//cita
$pdf->Ln(0);
$pdf->Cell(140);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,45,utf8_decode("CITA:"));

$pdf->Ln(0);
$pdf->Cell(148);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,45,utf8_decode($nombreUser));


//GeneroPaciente
$pdf->Ln(0);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,55,"GENERO:");

$pdf->Ln(0);
$pdf->Cell(19);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,55,utf8_decode($generoPaci));


//telefono
$pdf->Ln(0);
$pdf->Cell(140);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,35,utf8_decode("TELÉFONO:"));

$pdf->Ln(0);
$pdf->Cell(157);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,35,$telefonoPaci);

//RECIBIO
$pdf->Ln(0);
$pdf->Cell(140);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,55,utf8_decode("RECIBIO:"));

$pdf->Ln(0);
$pdf->Cell(153);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,55,utf8_decode($nombreRecibio));


//logo
$pdf->Ln(0);
$pdf->Cell(50);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(15,65,utf8_decode("CENTRO DE DIAGNOSTICO POR IMAGENES, S.A DE C.V."));


//FECHA.
$pdf->Ln(0);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,75,"FECHA:");

$pdf->Ln(0);
$pdf->Cell(16);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,75,$fecha);

//HORA CITA
$pdf->Ln(0);
$pdf->Cell(77);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,75,"HORA:");

$pdf->Ln(0);
$pdf->Cell(87);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,75,$horarioCita);



//No.Cita
$pdf->Ln(0);
$pdf->Cell(148);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,75,utf8_decode("CITA No.:"));

$pdf->Ln(0);
$pdf->Cell(162);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,75,$idCita);

//Medico remitente.
$pdf->Ln(0);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,95,utf8_decode("MÉDICO REMITENTE:"));

$pdf->Ln(0);
$pdf->Cell(35);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,95,utf8_decode($nombreRem));

//Medico 
$pdf->Ln(0);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,105,utf8_decode("MÉDICO:"));

$pdf->Ln(0);
$pdf->Cell(19);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,105,utf8_decode($nombreDoc));

//ESTUDIOS 
$pdf->Ln(0);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(15,115,utf8_decode("ESTUDIOS A REALIZAR:"));

$pdf->Ln(0);
$pdf->Cell(23);
$pdf->SetFont('Helvetica','',8);
$pdf->Cell(15,125,utf8_decode($nombreEstudio));


$pdf->Ln(0);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','I',10);
$pdf->Cell(15,168,utf8_decode("He revisado los datos personales sean correctos y autorizo a realizar los estudios arriba mencionados."));
$pdf->Ln(0);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','I',10);
$pdf->Cell(15,176,utf8_decode("Número de Placas:_____________________________"));

$pdf->Rect(20,101, 4, 3, 'rect1', $style1, array(255, 255, 0)); 
$pdf->Ln(0);
$pdf->Cell(14);
$pdf->SetFont('Helvetica','I',9);
$pdf->Cell(15,185,utf8_decode("Resultado por Correo:________________________________________________________________________"));
$pdf->Rect(20,105, 4, 3, ' rect2', $style1, array(255, 255, 0));
$pdf->Ln(0);
$pdf->Cell(14);
$pdf->SetFont('Helvetica','I',9);
$pdf->Cell(15,193,utf8_decode("Resultado en Fisico:_________________________________________________________________________"));
$pdf->Rect(20,109, 4, 3, ' rect3', $style1, array(255, 255, 0));
$pdf->Ln(0);
$pdf->Cell(14);
$pdf->SetFont('Helvetica','I',9);
$pdf->Cell(15,201,utf8_decode("Orden Medica:______________________________________________________________________________"));

$pdf->Output();
$mysqli->close();
?>
