
<?php session_start();
//conexion con la base de dtos
include "Conexion/conexion.php";
include "Conexion/base.php";
require('FPDF/fpdf.php');

$fecha=date('d-m-Y'); //fecha del servidor
$fechaU=date('Y-m-d');
$hora=date('H:i:s');
$idPa=$_REQUEST["idPa"];
$fecha=$_REQUEST["fecha"];


$idFolio=$_REQUEST['idFolio'];
$idUserSes=$_REQUEST["idU"];

$miCabecera = array('Sala','Estudio','Médico','Hora cita');
$misDatos = array();
$subtotal= array();

$actual = date('Y-m-d');
// $queryModifica = "update citas set statusProceso=1 WHERE idCita='$idCit'";

//        $mysqli->query($queryModifica);
//consulta que selecciona las citas a generar
$queryVerificar="SELECT idCita FROM citas WHERE citas.folioCita = $idFolio AND NOT EXISTS(SELECT idCita FROM responsableCita)";
$resultVerific = $mysqli->query($queryVerificar);
$idCitaRespuesta=0;
while ($rowVerific = $resultVerific->fetch_array(MYSQLI_ASSOC))
{
    $idCit=$rowVerific['idCita'];
    $queryss="INSERT INTO responsableCita (idUsuario,idCita,fechaRecibo,horaRecibo) VALUES('$idUserSes','$idCit','$fechaU','$hora')";
    $mysqli->query($queryss);
    $error=$mysqli->error;
}


$queryRe="select * from usuarios where idUser=$idUserSes";
$resultRe = $mysqli->query($queryRe);
while ($rowRs = $resultRe->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA                        DE LA COLUMNA
{
    $nombreRecibio=$rowRs['nombreUser'];
}


$query="SELECT citas.idCita,citas.horallegada,citas.fechallegada,Estudio.nombreEstudio,Pacientes.nombrePaci,Pacientes.generoPaci,Pacientes.fechanaciPaci,Pacientes.edadPaci,Pacientes.telefonoPaci,Salas.nombre,Doctores.nombreDoc,citas.horarioCita,Remitente.nombreRem,usuarios.nombreUser, Estudio.numeroPlacas, citas.statusProceso,
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
                                JOIN Remitente on Remitente.idRemitente=Pacientes.remitente join usuarios on usuarios.idUser=citas.idUser 
                                WHERE Pacientes.idPaciente=$idPa and citas.fechaCita ='$fecha' AND citas.folioCita='$idFolio' ORDER BY citas.horarioCita DESC";
$result = $mysqli->query($query);
while ($row = $result->fetch_array(MYSQLI_ASSOC))
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

    array_push($subtotal, $row['precio']);

    $horallegada=$row['horallegada'];
    $fechallegada=$row['fechallegada'];

    $generoPaci=$row['generoPaci'];
    $edadPaci=$row['edadPaci'];
    $edadPaci=$row['edadPaci'];
    $telefonoPaci=$row['telefonoPaci'];
    $statusProceso=$row['statusProceso'];
    //echo "statusProceso $statusProceso";
    if (($horallegada=="00:00:00" || $horallegada=="00:00:00.000000") && $fechallegada=="0000-00-00" && $statusProceso<="1") {
        $queryModific = "update citas set statusProceso='1', horallegada='$hora', fechallegada='$fechaU' WHERE idCita = '$idCita'  ";
        $mysqli->query($queryModific);
    }

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
    }

    function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10,38);
        $this->SetFont('Arial','B',8);
        $this->SetFillColor(41,58,74);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
    }

    function datosHorizontal($datos, $subtotal)
    {
        $this->SetXY(10,45);
        $this->SetFont('Arial','',8);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
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
$pdf->setX(10); //eje de las x
$pdf->setY(10); //eje de las y

$pdf->SetFont('Helvetica','B',10); //fuente
$pdf->Cell(47,35,"NOMBRE DEL PACIENTE:");
$pdf->SetFont('Helvetica','',10);


$pdf->Cell(60,35,utf8_decode($nombrePaci));



//fecha nacimiento
$pdf->setY(10);

$anio=substr($fechanaciPaci, 0, -6);
$mes=substr($fechanaciPaci, 5, -3);
$dia=substr($fechanaciPaci, 8, 2);

$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(19,45,"F.NAC:");
$pdf->SetFont('Helvetica','',10);

$pdf->Cell(23,45,utf8_decode($dia."/".$mes."/".$anio));

//EDAD

$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(22,45,"EDAD:");


$pdf->SetFont('Helvetica','',10);

$pdf->Cell(15,45,$edadPaci.utf8_decode(" AÑOS"));


//cita
$pdf->Ln(0);
$pdf->Cell(120);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(23,45,utf8_decode("CITA:"));

$pdf->Ln(0);
$pdf->Cell(140);
$pdf->SetFont('Helvetica','',10);

$pdf->Cell(15,45,utf8_decode($nombreUser));


//GeneroPaciente
$pdf->setY(10);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(15,55,"GENERO:");

$pdf->Ln(0);
$pdf->Cell(19);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(10,55,utf8_decode($generoPaci));

//telefono
$pdf->Ln(0);
$pdf->Cell(42);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(22,55,utf8_decode("TELÉFONO:"));

$pdf->Ln(0);
$pdf->Cell(64);
$pdf->SetFont('Helvetica','',10);

$pdf->Cell(15,55,$telefonoPaci);

//RECIBIO
$pdf->Ln(0);
$pdf->Cell(120);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(15,55,utf8_decode("RECIBIO:"));

$pdf->Ln(0);
$pdf->Cell(140);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(15,55,utf8_decode($nombreRecibio));


//logo
// $pdf->Ln(0);
// $pdf->Cell(50);
// $pdf->SetFont('Helvetica','B',9);
// $pdf->Cell(15,65,utf8_decode("CENTRO DE DIAGNOSTICO POR IMAGENES, S.A DE C.V."));


//FECHA.
$pdf->setY(10);

$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(15,65,"FECHA:");

$pdf->Ln(0);
$pdf->Cell(19);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(15,65,$fecha);

//HORA CITA
$pdf->Ln(0);
$pdf->Cell(77);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(16,65,"HORA:");

$pdf->Ln(0);
$pdf->Cell(90);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(15,65,$horarioCita);



//No.Cita
$pdf->Ln(0);
$pdf->Cell(120);
$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(14,65,utf8_decode("FOLIO: "));

$pdf->Ln(0);
$pdf->Cell(140);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(10,65,$idFolio);

//Medico remitente.
$pdf->setY(10);

$pdf->SetFont('Helvetica','B',10);
$pdf->Cell(15,85,utf8_decode("MÉDICO REMITENTE:"));

$pdf->Ln(0);
$pdf->Cell(40);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(15,85,utf8_decode($nombreRem));


//ESTUDIOS 

$pdf->setY(12);
$pdf->SetFont('Helvetica','B',9);
$pdf->Cell(15,100,utf8_decode("ESTUDIOS A REALIZAR:"));

$pdf->setY(15);
$result = $mysqli->query($query);
$coordenadaY=16;
$pdf->Cell(1);
$contadorEstudios=1;
$pdf->Cell(15);
$pdf->Cell(8,106,utf8_decode("Placas"));
$pdf->Cell(5);
$pdf->Cell(15,106,utf8_decode("Estudio"));
$pdf->Cell(30);
$pdf->Cell(15,106,utf8_decode("Doctor"));
$pdf->SetFont('Helvetica','',8.5);
$contadorPlacas=0;
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
    $nombreEstudio=$row['nombreEstudio'];
    $contadorPlacas+=$row['numeroPlacas'];
    $pdf->setY($coordenadaY+=3);
    $pdf->Cell(16);
    $pdf->Cell(8,104,utf8_decode($row['numeroPlacas']));
    $pdf->Cell(5);
    $pdf->Cell(15,104,utf8_decode($nombreEstudio));
    $pdf->Cell(30);
    $pdf->Cell(15,104,utf8_decode($row['nombreDoc']));
}


//logo
$pdf->setY($coordenadaY++);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','I',7.5);
$pdf->Cell(15,148,utf8_decode("He revisado los datos personales sean correctos y autorizo a realizar los estudios arriba mencionados."));
$pdf->setY($coordenadaY++);
$pdf->Cell(5);
$pdf->SetFont('Helvetica','I',7.5);


$pdf->Cell(15,156,utf8_decode("Número de placas:_____________________________"));
$pdf->Cell(26);
$pdf->Cell(30,156,utf8_decode("$contadorPlacas"));
$style1="D";

$pdf->setY($coordenadaY++);
$pdf->Cell(10);
$pdf->Rect(17, 80+$pdf->getY(), 3, 3, "D");
$pdf->Cell(20,163,utf8_decode("Resultado por Correo:___________________________________________________________________________________________________"));


$pdf->setY($coordenadaY++);
$pdf->Cell(10);
$pdf->Rect(17, 84+$pdf->getY(), 3, 3, "D");
$pdf->Cell(20,171,utf8_decode("Resultado en físico"));



$pdf->setY($coordenadaY++);
$pdf->Cell(10);
$pdf->Rect(17, 88+$pdf->getY(), 3, 3, "D");
$pdf->Cell(20,179,utf8_decode("Orden médica"));




$pdf->Output();
$mysqli->close();
?>
