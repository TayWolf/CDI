<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cruddeudores extends CI_Controller {
    function __construct(){
        parent::__construct();
        if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
        $this->load->model("Deudores"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=30;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos

    }  

    public function index()
    {
        $data['deudores']=$this->Deudores->getDeudores();
        $this->load->view('gridlistadeudor',$data);
    }

    public function listadoDeudores()
    {
        $data['deudores']=$this->Deudores->getDeudoreGrales();
        $this->load->view('gridlistadeudorgral',$data);
    }

    public function detalleHistorial($idDeudor)
    {
        $data = ['idDeudor' => $idDeudor];
         $data['nombreTipo']=$this->Deudores->getNombreDeudor($idDeudor);
         $data['historiaEtudios']=$this->Deudores->getestudiosGrales($idDeudor);
        $this->load->view('gridhistorialdeudaGral',$data);
    }

    public function verDeudores($verDeudores)
    {
        $data = ['verDeudores' => $verDeudores];
        $data['empresas']=$this->Deudores->getEmpresas();
        $data['nombrePaci']=$this->Deudores->getNombrePaci($verDeudores);
        $data['ContaTo'] = $this->Deudores->getToti();
        $this->load->view('griddeudorescaja', $data);
    }
    public function getClientes()
    {
        $Proved=$_REQUEST["q"];
        if(isset($Proved)){
            $result=$this->Deudores->getClientesPorNombre($Proved);
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
    

   
    public function filtrarTabla()
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
            $condicionIdPaciente.="Pacientes.idPaciente = $idPaciente ";
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
        $prueba= $this->Deudores->filtrar($condicionGeneral);
        echo json_encode($prueba);


    }

    ///////
    function getDatosDeudor()
    {
        $idCita = $this->input->post('idCita');
        $idAdeudo = $this->input->post('idAdeudo');
        $prueba= $this->Deudores->getDeudita($idAdeudo);
        echo json_encode($prueba);

    }
    public function filtrarTablaCaja()
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
       $prueba= $this->Deudores->filtrarCaja($condicionGeneral);
       echo json_encode($prueba);


    }

   function getListadoPagos($idD)
   {
        $prueba= $this->Deudores->getpagosListado($idD);
        echo json_encode($prueba);
   }

    function getfac($idEst){
        $prueba= $this->Deudores->getDatF($idEst);
        echo json_encode($prueba);
    }

    function getDatoFa($idPa){
        $prueba= $this->Deudores->getDatFactu($idPa);
        echo json_encode($prueba);
    }

    function sumaDeuda($idPa){
        $prueba= $this->Deudores->sumaTotalPagos($idPa);
        echo json_encode($prueba);
    }
    function getPrecio($idEstudio,$tipC,$idCliente){
        if ($tipC==8) {
           $prueba= $this->Deudores->getDatF($idEstudio);
                echo json_encode($prueba);
        }else{
            $prueba= $this->Deudores->getPrecioClien($idEstudio,$idCliente);
                echo json_encode($prueba);
        }        
    }

    function getPrecioDeudor($idC){
        $prueba= $this->Deudores->getDatFactudeudor($idC);
        echo json_encode($prueba);
    }

     function getTotalPrecio(){

        $idC=$this->Deudores->sacarId();
        $i=0;  
            foreach ($idC as $key) {
                $folioCita= $key['folioCita'];
                 $pruebaValores= $this->Deudores->getTotalesPrecio($folioCita);
                  foreach ($pruebaValores as $keyV) {
                    $totalEstudio= $keyV['totalEstudio'];

                  }
                 $prueba[$i]=array('totalEstudio' => $totalEstudio, 'folioCita' => $folioCita);
               $i++;
            }
 echo json_encode($prueba);
            //$prueba= $this->Deudores->getTotalesPrecio($folioCita);
           
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
        $this->Deudores->modDatosFiscales($dataP,$idPaciMod);
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

        $totalBD=$this->input->post('totalBD');
        $liquid=$totalBD-$montoPago;
        $idFactura=$this->Deudores->insertarFactura(
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
                    $this->Deudores->insertDatosFacturaPuente(array('idFactura' => $idFactura, 'idCita' => $cita));
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
                $this->Deudores->UpdateCitas(array('factura' => $requiereFactura), $citaSeleccionada);
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
                    $this->Deudores->UpdateCitas(array('statusPago' => 1), $numeroCita);
                    //insertar en historial de pagos si es necesario

                }
                //Crea el adeudo
                 if($adeudo>=$aPagar)
                {
                    $faltaPagar=$adeudo-$aPagar;
                    //crear adeudo
                    //$this->Deudores->UpdateCitas(array('statusPago' => 2), $numeroCita);
                    echo $this->Deudores->generarAdeudoListado($idAdeudaCita, $fecha, $aPagar, $idUser);
                }
            }
        }
    }

}

?>