<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudFacturacionClientes extends CI_Controller {
    function __construct(){
        parent::__construct();
        if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
        $this->load->model("FacturacionClientes"); //cargamos el modelo de User

    }

    public function index($index = 1)
    {
        $data['page'] = $this->FacturacionClientes->data_pagination("/Crudsalas/index/",
            $this->FacturacionClientes->getTotalRowAllData(), 3);
        $data['datos'] = $this->FacturacionClientes->getDatos($index);
        
        $this->load->view('gridfacturacionclientes',$data);
    }

    public function verFacturacion()
    {
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=26;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        $data['pacientes']=$this->FacturacionClientes->getPacientes();
        $data['empresas']=$this->FacturacionClientes->getEmpresas();

        $this->load->view('gridfacturacionclientes', $data);
    }

    public function verFacturacionCaja()
    {
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=27;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        $data['pacientes']=$this->FacturacionClientes->getPacientes();
        $data['empresas']=$this->FacturacionClientes->getEmpresas();
        $data['ContaTo'] = $this->FacturacionClientes->getToti();
        $this->load->view('gridfacturacioncaja', $data);
    }
    public function getClientes()
    {
        $Proved=$_REQUEST["q"];
        if(isset($Proved)){
            $result=$this->FacturacionClientes->getClientesPorNombre($Proved);
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
    public function traerPacientes($like)
    {
        $like=str_replace("%20", " ", $like);
        $result=($this->FacturacionClientes->getPacientesFiltrados($like));

        foreach ($result as $pr)
        {
            $arrResult[]=array("value"=>$pr['nombrePaci'],
                "idPaciente"=>$pr['idPaciente']
            );
            echo json_encode($arrResult);
        }

    }

    public function obtenerTablaClientes($idCliente)
    {
        echo json_encode($this->FacturacionClientes->tablaCliente($idCliente));
    }
    public function filtrarTabla()
    {

        /*Recuperación de datos*/
        $fechaInicial = $this->input->post('fechaInicial');
        $fechaFinal = $this->input->post('fechaFinal');
        $idCita = $this->input->post('idCita');
        $idPaciente = $this->input->post('idPaciente');
        $idCliente =  $this->input->post('idCliente');


        //TODO: MOSTRAR POR CITAS CONFIRMADAS O NO CONFIRMADAS
       // $condicionGeneral="WHERE (citas.statusPago=0 or citas.statusPago=4)";
        $condicionGeneral="WHERE (citas.statusPago=0 or citas.statusPago=4)";
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

            $condicionIdCita.=" AND folioCita like '%$idCita%' ";
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
        $prueba= $this->FacturacionClientes->filtrar($condicionGeneral);
        //echo "ss $condicionGeneral";
        echo json_encode($prueba);


    }

    ///////
    public function filtrarTablaCaja()
    {

        /*Recuperación de datos*/
        $fechaInicial = $this->input->post('fechaInicial');
        $fechaFinal = $this->input->post('fechaFinal');
        $folioCita = $this->input->post('folioCita');
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
        if(!empty($folioCita))
        {
            if($contadorAND>=0)
            {
                $condicionIdCita.="AND ";
                $contadorAND--;
            }
            $condicionIdCita.="citas.folioCita like '%$folioCita%' ";
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
       //echo "condicion $condicionGeneral";
      $prueba= $this->FacturacionClientes->filtrarCaja($condicionGeneral);
      echo json_encode($prueba);


    }

    public function GetEs()
    {

        /*Recuperación de datos*/
        $fechaInicial = $this->input->post('fechaInicial');
        $fechaFinal = $this->input->post('fechaFinal');
        $idCita = $this->input->post('idCita');
        $idPaciente = $this->input->post('idPaciente');
        $idCliente =  $this->input->post('idCliente');


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
            $condicionIdPaciente.="Pacientes.nombrePaci LIKE '%$idPaciente%' ";
            $contadorAND++;
        }
        if(!empty($idCliente))
        {
            if($contadorAND>=0)
            {
                $condicionIdCliente.="AND ";
                $contadorAND--;
            }
            $condicionIdCliente.="nombreCliente LIKE '%$idCliente%' ";
            $contadorAND++;
        }


        $condicionGeneral.=$condicionFechaInicial.$condicionFechaFinal.$condicionFechas.$condicionIdCita.$condicionIdPaciente.$condicionIdCliente;

        if(!empty($condicionGeneral))
            $condicionGeneral="WHERE ".$condicionGeneral;
        $prueba= $this->FacturacionClientes->filtrarEst($condicionGeneral);
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
        $contadorAND=-1;
        $condicionGeneral="";
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
        if(!empty($idEst))
        {
            if($contadorAND>=0)
            {
                $condicionIidE.="AND ";
                $contadorAND--;
            }
            $condicionIidE.="Estudio.IdEstudio=$idEst ";
            $contadorAND++;
        }
        if(!empty($idPaciente))
        {
            if($contadorAND>=0)
            {
                $condicionIdPaciente.="AND ";
                $contadorAND--;
            }
            $condicionIdPaciente.="Pacientes.nombrePaci LIKE '%$idPaciente%' ";
            $contadorAND++;
        }
        if(!empty($idCliente))
        {
            if($contadorAND>=0)
            {
                $condicionIdCliente.="AND ";
                $contadorAND--;
            }
            $condicionIdCliente.="nombreCliente LIKE '%$idCliente%' ";
            $contadorAND++;
        }


        $condicionGeneral.=$condicionFechaInicial.$condicionFechaFinal.$condicionFechas.$condicionIidE.$condicionIdPaciente.$condicionIdCliente;

        if(!empty($condicionGeneral))
            $condicionGeneral="WHERE ".$condicionGeneral;
        $prueba= $this->FacturacionClientes->filtrarEstF($condicionGeneral);
        echo json_encode($prueba);


    }

    public function GetEsFCa()//
    {

        /*Recuperación de datos*/
        $fechaInicial = $this->input->post('fechaInicial');
        $fechaFinal = $this->input->post('fechaFinal');
        $idEst = $this->input->post('idEst');
        $idPaciente = $this->input->post('idPaciente');
        //$idCliente =  $this->input->post('idCliente');
        $idCliente = "particular";

        //TODO: MOSTRAR POR CITAS CONFIRMADAS O NO CONFIRMADAS
        $contadorAND=-1;
        $condicionGeneral="";
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
        if(!empty($idEst))
        {
            if($contadorAND>=0)
            {
                $condicionIidE.="AND ";
                $contadorAND--;
            }
            $condicionIidE.="Estudio.IdEstudio=$idEst ";
            $contadorAND++;
        }
        if(!empty($idPaciente))
        {
            if($contadorAND>=0)
            {
                $condicionIdPaciente.="AND ";
                $contadorAND--;
            }
            $condicionIdPaciente.="Pacientes.idPaciente= $idPaciente ";
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


        $condicionGeneral.=$condicionFechaInicial.$condicionFechaFinal.$condicionFechas.$condicionIidE.$condicionIdPaciente.$condicionIdCliente;

        if(!empty($condicionGeneral))
            $condicionGeneral="WHERE ".$condicionGeneral;
        $prueba= $this->FacturacionClientes->filtrarEstFCaja($condicionGeneral);
        echo json_encode($prueba);


    }
    function getfac($idEst){
        $prueba= $this->FacturacionClientes->getDatF($idEst);
        echo json_encode($prueba);
    }

    function getDatoFa($idPa){
        $prueba= $this->FacturacionClientes->getDatFactu($idPa);
        echo json_encode($prueba);
    }
    function getDatoCliente($idCliente){
        $prueba= $this->FacturacionClientes->getDatoCliente($idCliente);
        echo json_encode($prueba);
    }
    function getPrecio($idEstudio,$tipC,$idCliente){
        if ($tipC==8) {
           $prueba= $this->FacturacionClientes->getDatF($idEstudio);
                echo json_encode($prueba);
        }else{
            $prueba= $this->FacturacionClientes->getPrecioClien($idEstudio,$idCliente);
                echo json_encode($prueba);
        }        
    }

    function modificFiscal(){
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
        $this->FacturacionClientes->modDatosFiscales($dataP,$idPaciMod);
    }

    function insertaPago(){
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
        //echo "idPacient ";
        $totalBD=$this->input->post('totalBD');
        $liquid=$totalBD-$montoPago;
        $idFactura=$this->FacturacionClientes->insertarFactura(
            array('idUsuario'=>$idSesion, 'fecha' => $fecha, 'formaPago' => $formaPago,
            'metodoPago' => $metodoPago, 'cuentaPago' => $cuentaPago,
            'usoCFDI' => $usoCFDI, 'montoPago' => $montoPago, 'cliente'=> $cliente, 'empresa' => $empresa,
            'rfc' => $rfc, 'domicilio' => $domicilio, 'colonia' => $colonia, 'delegacion' => $delegacion,
            'estado' => $estado, 'telefono' => $telefono));
        $requiereFactura=$this->input->post('requiereFactura');
        
        for ($i=0; $i <=$cantidadEstudios ; $i++)
        {
            $estudioSeleccionado=$this->input->post('estudioSeleccionado'.$i);
            if($estudioSeleccionado)
            {
                $cita=$this->input->post('cita'.($i+1));
                if($cita)
                {
                    $this->FacturacionClientes->insertDatosFacturaPuente(array('idFactura' => $idFactura, 'idCita' => $cita));
                    $this->FacturacionClientes->UpdateCitas(array('factura' => $requiereFactura), $cita);
                }

            }


        }
        echo "$fecha";
    }
    function establecerFacturas($requiereFactura)
    {

        $citasSeleccionadas=$this->input->post('citas');
        echo json_encode($citasSeleccionadas);
        if(!empty($citasSeleccionadas))
            foreach ($citasSeleccionadas as $citaSeleccionada)
            {
                $this->FacturacionClientes->UpdateCitas(array('factura' => $requiereFactura), $citaSeleccionada);
            }
    }
    function insertaAdeudo($numeroCitas, $fecha)
    {
        $fecha=urldecode($fecha);
        //PRUEBA
        //$fecha='2019-01-30';
        $idPaciente=$this->input->post('idPaciente');
        echo "datos $idPaciente";
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
                    $this->FacturacionClientes->UpdateCitas(array('statusPago' => 1), $numeroCita);
                    //insertar en historial de pagos si es necesario

                }
                //Crea el adeudo
                else if($adeudo>$aPagar)
                {
                    $faltaPagar=$adeudo-$aPagar;
                    //crear adeudo
                    $this->FacturacionClientes->UpdateCitas(array('statusPago' => 2), $numeroCita);
                    echo $this->FacturacionClientes->generarAdeudo($idPaciente, $fecha, $numeroCita, $faltaPagar);
                }
            }
        }
    }

    function insertaPagoCliente($cliente){
        //datos generales
        $idSesion=$this->input->post('idSesion');

        $fecha=date("Y-m-d H:i:s");
        $formaPago=$this->input->post('formaPago');
        $metodoPago=$this->input->post('metodoPago');
        $cuentaPago=$this->input->post('cuentaPago');
        $usoCFDI=$this->input->post('usoCFDI');
        $montoPago=$this->input->post('montoPago');
        $empresa=$this->input->post('empresa');

        $rfc=$this->input->post('rfcFac');
        $domicilio=$this->input->post('domiFa');
        $colonia=$this->input->post('coloniaFa');
        $delegacion=$this->input->post('deleFact');
        $estado=$this->input->post('edoFact');
        $telefono=$this->input->post('telFact');
        $totali=$this->input->post('totali');
        $fechaFa=$this->input->post('fechaFa');
        $cantidadEstudios=$this->input->post('xxc');

        $conceptoFact=$this->input->post('conceptoFact');
        $referenciaFact=$this->input->post('referenciaFact');
        $statusPago=2;
        $totalBD=$this->input->post('totalBD');
        $liquid=$totalBD-$montoPago;
        $idFactura=$this->FacturacionClientes->insertarFacturaClientes(
            array('idUsuario'=>$idSesion, 'fecha' => $fecha, 'formaPago' => $formaPago,
                'metodoPago' => $metodoPago, 'cuentaPago' => $cuentaPago,
                'usoCFDI' => $usoCFDI, 'montoPago' => $totalBD, 'conceptoFact' => $conceptoFact, 'referenciaFact' => $referenciaFact , 'cliente'=> $cliente, 'empresa' => $empresa,
                'rfc' => $rfc, 'domicilio' => $domicilio, 'colonia' => $colonia, 'delegacion' => $delegacion,
                'estado' => $estado, 'telefono' => $telefono, 'statusPago' => $statusPago));
        $requiereFactura=1;
        //datos de las citas de la factura
        for ($i=0; $i <=$cantidadEstudios ; $i++)
        {
            $estudioSeleccionado=$this->input->post('estudioSeleccionado'.$i);

            if($estudioSeleccionado)
            {

                $cita=$this->input->post('cita'.($i+1));
                if($cita)
                {

                    $this->FacturacionClientes->insertDatosFacturaClientePuente(array('idFacturaClientes' => $idFactura, 'idCita' => $cita));
                    $this->FacturacionClientes->UpdateCitas(array('factura' => $requiereFactura, 'statusPago' => 1), $cita);
                }

            }


        }
        echo "$fecha";
    }
    function insertaAdeudoCliente($numeroCitas, $fecha, $idCliente)
    {
        $fecha=urldecode($fecha);
        //PRUEBA


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
                    $this->FacturacionClientes->UpdateCitas(array('statusPago' => 1), $numeroCita);
                    //insertar en historial de pagos si es necesario
                }
                //Crea el adeudo
                else if($adeudo>$aPagar)
                {
                    $faltaPagar=$adeudo-$aPagar;
                    //crear adeudo
                    $this->FacturacionClientes->UpdateCitas(array('statusPago' => 2), $numeroCita);
                    echo $this->FacturacionClientes->generarAdeudoCliente($idCliente, $fecha, $numeroCita, $faltaPagar);
                }
            }
        }
    }
}

?>