<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudDeudoresClientes extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("DeudoresClientes"); //cargamos el modelo de User
    }  

    public function index()
    {
        $data['deudores']=$this->DeudoresClientes->getDeudores();
        $this->load->view('gridlistadeudorCliente',$data);
    }
    public function verDeudores($verDeudores)
    {
        $data = ['verDeudores' => $verDeudores];
        $arrayDeudor=$this->DeudoresClientes->getFechaAdeudo($verDeudores);
        $data['fecha']=$arrayDeudor['fechaPago'];
        $data['empresas']=$this->DeudoresClientes->getEmpresas();
        $data['nombreCliente']=$this->DeudoresClientes->getNombreCliente($verDeudores);
        $this->load->view('griddeudoresClientes', $data);
    }
    public function getClientes($Proved)
    {
        $Proved=urldecode($Proved);
        if(isset($Proved)){
            $result=$this->DeudoresClientes->getClientesPorNombre($Proved);
            if(count($result)>0)
                foreach($result as $pr)
                    $arrResult[]=array("value"=>$pr->nombreCliente,
                        "idCliente"=>$pr->idCliente,
                        "nombreCliente"=>$pr->nombreCliente,
                        "Clave"=>$pr->Clave,
                        "RFC"=>$pr->RFC,
                        "direccionCliente"=>$pr->direccionCliente,
                        "CP"=>$pr->CP,
                        "Colonia"=>$pr->Colonia,
                        "municipio"=>$pr->municipio,
                        "Estado"=>$pr->Estado,
                        "telefono"=>$pr->telefono,
                        "precioEspecial"=>$pr->precioEspecial
                    );
            echo json_encode($arrResult);
        }
    }
    function insertaAdeudoCliente($numeroCitas, $fecha, $idCliente)
    {
        $fecha=urldecode($fecha);
        for($i=0; $i<$numeroCitas; $i++)
        {
            $numeroCita=$this->input->post('numeroCitaAdeudo'.$i);
            if(!empty($numeroCita))
            {
                $adeudo=$this->input->post('estudioAdeudado'.$i);
                $aPagar=$this->input->post('estudioSaldoPagado'.$i);
                //No crea adeudo
                if($aPagar>=$adeudo)
                {
                    //Actualizar la cita a pagada
                    $this->DeudoresClientes->UpdateCitas(array('statusPago' => 1), $numeroCita);
                }
                //Crea el adeudo
                else if($adeudo>$aPagar)
                {
                    $faltaPagar=$adeudo-$aPagar;
                    //crear adeudo
                    $this->DeudoresClientes->UpdateCitas(array('statusPago' => 2), $numeroCita);

                }
                //insertar en historial de pagos
                $idAdeudoCita=$this->DeudoresClientes->obtenerAdeudoCliente($idCliente, $fecha, $numeroCita, $faltaPagar);
                $this->DeudoresClientes->insertarAbono(array('idAdeudaCita'=>$idAdeudoCita, 'abono'=> $aPagar, 'fechaPago' => date("Y-m-d"), 'idUser' =>$_SESSION['idusuariobase']));
            }
        }
    }
    public function filtrarTabla()
    {

        /*Recuperación de datos*/
        $fechaInicial = $this->input->post('fechaInicial');
        $fechaFinal = $this->input->post('fechaFinal');
        $idCita = $this->input->post('idCita');
        $idPaciente = $this->input->post('idPaciente');
        $idCliente =  $this->input->post('idCliente');

        $condicionGeneral="WHERE citas.statusPago=2 ";
        $condicionFechaInicial="";
        $condicionFechaFinal="";
        $condicionFechas="";
        $condicionIdCita="";
        $condicionIdPaciente="";
        $condicionIdCliente =  "";
        if(!empty($fechaInicial))
        {
            if(!empty($fechaFinal))
            {
                $condicionFechas="AND fechaCita BETWEEN '$fechaInicial' AND '$fechaFinal' ";
            }
            else
            {
                $condicionFechaInicial="AND fechaCita>='$fechaInicial' ";

            }
        }
        else if(!empty($fechaFinal))
        {
            $condicionFechaInicial.="AND fechaCita<='$fechaFinal' ";

        }
        if(!empty($idCita))
        {

            $condicionIdCita.="AND idCita=$idCita ";
        }
        if(!empty($idPaciente))
        {
            $condicionIdPaciente.="AND Pacientes.nombrePaci LIKE '%$idPaciente%' ";
        }
        if(!empty($idCliente))
        {
            $condicionIdCliente.="AND nombreCliente LIKE '%$idCliente%' ";
        }
        $condicionGeneral.=$condicionFechaInicial.$condicionFechaFinal.$condicionFechas.$condicionIdCita.$condicionIdPaciente.$condicionIdCliente;
        $prueba= $this->DeudoresClientes->filtrar($condicionGeneral);
        echo json_encode($prueba);


    }
    function getDatoCliente($idCliente)
    {
        $prueba= $this->DeudoresClientes->getDatoCliente($idCliente);
        echo json_encode($prueba);
    }

    function getDatosDeudor()
    {
        $idCita = $this->input->post('idCita');
        $idAdeudo = $this->input->post('idAdeudo');
        $prueba= $this->DeudoresClientes->getDeudita($idAdeudo);
        echo json_encode($prueba);

    }
    function filtrarTablaCaja()
    {

        /*Recuperación de datos*/
        $fechaInicial = $this->input->post('fechaInicial');
        $fechaFinal = $this->input->post('fechaFinal');
        $idCita = $this->input->post('idCita');
        $idPaciente = $this->input->post('idPaciente');
        $idCliente = "particular";
        //echo "idCi $idCita";

        //TODO: MOSTRAR POR CITAS CONFIRMADAS O NO CONFIRMADAS
        $contadorAND=-1;
        $condicionGeneral="";
        $condicionFechaInicial="";
        $condicionFechaFinal="";
        $condicionFechas="";
        $condicionIdCita="";
        $condicionIdPaciente="";
        $condicionIdCliente =  "";
        if(!empty($fechaInicial))
        {
            if(!empty($fechaFinal))
            {
                //TODO: MOSTRAR BETWEEN DE LAS FECHAS
                $condicionFechas="fechaCita BETWEEN '$fechaInicial' AND '$fechaFinal' ";
            }
            else
            {
                $condicionFechaInicial="fechaCita>='$fechaInicial' ";

            }

            $contadorAND++;
        }
        else if(!empty($fechaFinal))
        {
            $condicionFechaInicial.="fechaCita<='$fechaFinal' ";
            $contadorAND++;
        }
        if(!empty($idCita))
        {
            if($contadorAND>=0)
            {
                $condicionIdCita.="AND ";
                $contadorAND--;
            }
            $condicionIdCita.="idCita=$idCita ";
            $contadorAND++;
        }
        if(!empty($idPaciente))
        {
            if($contadorAND>=0)
            {
                $condicionIdPaciente.="AND ";
                $contadorAND--;
            }
            $condicionIdPaciente.="Pacientes.idPaciente =$idPaciente ";
            $contadorAND++;
        }
        if(!empty($idCliente))
        {
           
            if($contadorAND>=0)
            {
                $condicionIdCliente.="AND ";
                $contadorAND--;
            }
            $condicionIdCliente.="citas.tipoCitaa =8 ";
            $contadorAND++;
        }


        $condicionGeneral.=$condicionFechaInicial.$condicionFechaFinal.$condicionFechas.$condicionIdCita.$condicionIdPaciente.$condicionIdCliente;

        if(!empty($condicionGeneral))
            $condicionGeneral="WHERE ".$condicionGeneral;
       // echo "chingon $condicionGeneral";
       $prueba= $this->DeudoresClientes->filtrarCaja($condicionGeneral);
       echo json_encode($prueba);


    }
    public function GetEsF()
    {

        /*Recuperación de datos*/
        $fechaInicial = $this->input->post('fechaInicial');
        $fechaFinal = $this->input->post('fechaFinal');
        $idEst = $this->input->post('idEst');
        $idPaciente = $this->input->post('idPaciente');
        $idCliente =  $this->input->post('idCliente');


        //TODO: MOSTRAR POR CITAS CONFIRMADAS O NO CONFIRMADAS
        $condicionGeneral=" WHERE citas.statusPago=0 ";
        $condicionFechaInicial="";
        $condicionFechaFinal="";
        $condicionFechas="";
        $condicionIidE="";
        $condicionIdPaciente="";
        $condicionIdCliente =  "";
        if(!empty($fechaInicial))
        {
            if(!empty($fechaFinal))
            {
                //TODO: MOSTRAR BETWEEN DE LAS FECHAS
                $condicionFechas="AND fechaCita BETWEEN '$fechaInicial' AND '$fechaFinal' ";
            }
            else
            {
                $condicionFechaInicial="AND fechaCita>='$fechaInicial' ";

            }


        }
        else if(!empty($fechaFinal))
        {
            $condicionFechaInicial.="AND fechaCita<='$fechaFinal' ";
        }
        if(!empty($idEst))
        {
            $condicionIidE.="AND Estudio.IdEstudio=$idEst ";
        }
        if(!empty($idPaciente))
        {
            $condicionIdPaciente.="AND Pacientes.nombrePaci LIKE '%$idPaciente%' ";
        }
        if(!empty($idCliente))
        {
            $condicionIdCliente.="AND nombreCliente LIKE '%$idCliente%' ";
        }


        $condicionGeneral.=$condicionFechaInicial.$condicionFechaFinal.$condicionFechas.$condicionIidE.$condicionIdPaciente.$condicionIdCliente;
        $prueba= $this->DeudoresClientes->filtrarEstF($condicionGeneral);
        echo json_encode($prueba);


    }
    function getfac($idEst)
    {
        $prueba= $this->DeudoresClientes->getDatF($idEst);
        echo json_encode($prueba);
    }
    function getDatoFa($idPa)
    {
        $prueba= $this->DeudoresClientes->getDatFactu($idPa);
        echo json_encode($prueba);
    }
    function getPrecio($idCita,$tipC,$idCliente)
    {
        $prueba= $this->DeudoresClientes->getPrecioClien($idCita,$idCliente);
        echo json_encode($prueba);
    }
    function getPrecioDeudor($idC)
    {
        $prueba= $this->DeudoresClientes->getDatFactudeudor($idC);
        echo json_encode($prueba);
    }
    function modificFiscal()
    {
        $idPaciMod=$this->input->post('idPaciMod');
        $dataP = array(
            'razonSocial' => $this->input->post('clienteFactura'),
            'domFiscal' => $this->input->post('domiFa'),
            'RFC' => $this->input->post('rfcFac'),
            'telefono' => $this->input->post('telFact'),
            'colonia' => $this->input->post('coloniaFa'),
            'estado' => $this->input->post('edoFact'),
            'Municipio' => $this->input->post('deleFact')
            );
        $this->DeudoresClientes->modDatosFiscales($dataP,$idPaciMod);
    }
    function insertaPago()
    {
        //datos generales
        $idSesion=$this->input->post('idSesion');
        $fecha=date("Y-m-d H:i:s");
        $formaPago=$this->input->post('formaPago');
        $metodoPago=$this->input->post('metodoPago');
        $cuentaPago=$this->input->post('cuentaPago');
        $usoCFDI=$this->input->post('usoCFDI');
        $montoPago=$this->input->post('montoPago');
        $empresa=$this->input->post('empresa');
        $cliente=$this->input->post('clienteFactura');
        $rfc=$this->input->post('rfcFac');
        $domicilio=$this->input->post('domiFa');
        $colonia=$this->input->post('coloniaFa');
        $delegacion=$this->input->post('deleFact');
        $estado=$this->input->post('edoFact');
        $telefono=$this->input->post('telFact');
        $totali=$this->input->post('totali');
        $fechaFa=$this->input->post('fechaFa');
        $cantidadEstudios=$this->input->post('xxc');

        $totalBD=$this->input->post('totalBD');
        $liquid=$totalBD-$montoPago;
        $idFactura=$this->DeudoresClientes->insertarFactura(
            array('idUsuario'=>$idSesion, 'fecha' => $fecha, 'formaPago' => $formaPago,
            'metodoPago' => $metodoPago, 'cuentaPago' => $cuentaPago,
            'usoCFDI' => $usoCFDI, 'montoPago' => $montoPago, 'cliente'=> $cliente, 'empresa' => $empresa,
            'rfc' => $rfc, 'domicilio' => $domicilio, 'colonia' => $colonia, 'delegacion' => $delegacion,
            'estado' => $estado, 'telefono' => $telefono));

        //datos de las citas de la factura
        for ($i=0; $i <=$cantidadEstudios ; $i++)
        {
            $estudioSeleccionado=$this->input->post('estudioSeleccionado'.$i);
            if($estudioSeleccionado)
            {
                $cita=$this->input->post('cita'.($i+1));
                if($cita)
                    $this->DeudoresClientes->insertDatosFacturaPuente(array('idFactura' => $idFactura, 'idCita' => $cita));
            }
        }
        echo "ok";
    }
    function establecerFacturas($requiereFactura)
    {
        $citasSeleccionadas=$this->input->post('citas');
        echo json_encode($citasSeleccionadas);
        if(!empty($citasSeleccionadas))
            foreach ($citasSeleccionadas as $citaSeleccionada)
            {
                $this->DeudoresClientes->UpdateCitas(array('factura' => $requiereFactura), $citaSeleccionada);
            }
    }
    function insertaAdeudolistado($numeroCitas)
    {
        $fecha=date("Y-m-d");
        //PRUEBA
        //$fecha='2019-01-30';

        for($i=0; $i<$numeroCitas; $i++)
        {

            $numeroCita=$this->input->post('numeroCitaAdeudo'.$i);
            $idAdeudaCita=$this->input->post('idcitadeudo'.$i);

            if(!empty($numeroCita))
            {
                $adeudo=$this->input->post('estudioAdeudado'.$i);
                $aPagar=$this->input->post('estudioSaldoPagado'.$i);
                 $idUser=$this->input->post('idUser');
                //No crea adeudo
                if($aPagar>=$adeudo)
                {
                    //Actualizar la cita a pagada
                    $this->DeudoresClientes->UpdateCitas(array('statusPago' => 1), $numeroCita);
                    //insertar en historial de pagos si es necesario

                }
                //Crea el adeudo
                 if($adeudo>=$aPagar)
                {
                    $faltaPagar=$adeudo-$aPagar;
                    //crear adeudo
                    //$this->DeudoresClientes->UpdateCitas(array('statusPago' => 2), $numeroCita);
                    echo $this->DeudoresClientes->generarAdeudoListado($idAdeudaCita, $fecha, $aPagar, $idUser);
                }
            }
        }
    }
}

?>