<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudCitas extends CI_Controller {
    function __construct(){
        parent::__construct();
        if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
        $this->load->model("citas"); //cargamos el modelo de User
    }

// INICIO DE BUSQUEDA

    function traeListaEntregaCitas($idSala=0,$fechaconsu=0, $fechaconsuFinal=0, $folioCita=0,$doctor=0, $paciente=0, $estudio=0)
    {

        $paciente=str_replace("%20", " ", $paciente);
        $contadorAND=-1;
        $condicionGeneral="";
        $condicionArea="";
        $condicionFecha="";
        $condicionDoctor="";
        $condicionPaciente="";
        $condicionEstudio="";
        $condicionCita="";

// AGREGUE CONDICIÓNESTUDIO

        if($idSala!="0")
        {
            $condicionArea=" citas.idSala=$idSala ";
            $contadorAND++;
        }

        if($fechaconsu!="0" && $fechaconsuFinal!="0")
        {
            if($contadorAND>=0)
            {
                $condicionFecha.="AND";
                $contadorAND--;
            }
            $condicionFecha.=" citas.fechaCita BETWEEN '$fechaconsu' AND '$fechaconsuFinal' ";
            $contadorAND++;
        }
        else if($fechaconsu!="0" )
        {
            if($contadorAND>=0)
            {
                $condicionFecha.="AND";
                $contadorAND--;
            }
            $condicionFecha.=" citas.fechaCita >= '$fechaconsu'";
            $contadorAND++;
        }
        else if($fechaconsuFinal!="0" )
        {
            if($contadorAND>=0)
            {
                $condicionFecha.="AND";
                $contadorAND--;
            }
            $condicionFecha.=" citas.fechaCita <= '$fechaconsuFinal'";
            $contadorAND++;
        }


        if($doctor!="0")
        {
            if($contadorAND>=0)
            {
                $condicionDoctor.="AND";
                $contadorAND--;
            }
            $condicionDoctor.=" Doctores.nombreDoc LIKE '%$doctor%' ";
            $contadorAND++;
        }

        if($paciente!="0")
        {
            if($contadorAND>=0)
            {
                $condicionPaciente.="AND";
                $contadorAND--;
            }
            $condicionPaciente.=" Pacientes.nombrePaci LIKE '%$paciente%' ";
            $contadorAND++;
        }

        if($estudio!="0")
        {
            if($contadorAND>=0)
            {
                $condicionEstudio.="AND";
            }
            $condicionEstudio.=" Estudio.nombreEstudio LIKE '%$estudio%' ";
            $contadorAND++;
        }
        if($folioCita!="0")
        {
            if($contadorAND>=0)
            {
                $condicionCita.="AND";
            }
            $condicionCita.=" citas.folioCita LIKE '%$folioCita%' ";
            $contadorAND++;
        }

        if($contadorAND!=-1)
        {
            $condicionGeneral= "WHERE ".$condicionArea.$condicionFecha.$condicionDoctor.$condicionPaciente.$condicionEstudio.$condicionCita." AND  citas.cancelar!=1 ";
        }
        $prueba= $this->citas->getListaTodoCitasGralCitas($condicionGeneral);
        echo json_encode($prueba);
    }

//FIN DE BUSQUEDA


    public function PoputEdit($idCi,$fech,$index = 1)
    {
        $data = ['idCi' => $idCi,'fech' => $fech];
        $data['page'] = $this->citas->data_pagination("/Crudcitas/index/",
            $this->citas->getTotalRowAllData(), 3);
        $data['medico'] = $this->citas->getDatos();
        $data['medicoRem'] = $this->citas->remitente();
        $data['cliente'] = $this->citas->cliente();
        $data['salas'] = $this->citas->listasSalas();
        //$data['datoCl'] = $this->citas->getEstudios();
        $data['tablaCitas']=$this->citas->getTablaStatusCita();
        $this->load->view('gridtodocitastres',$data);

    }

    public function citasProgramadas()
    {
        $data['areas'] = $this->citas->getAreas();
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=19;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        $this->load->view('gridtodocitasprogramadas', $data);
    }
    function eliminarCitasPorFolio($idFolio)
    {
        $this->citas->eliminarCitaPorFolio($idFolio);
    }




    public function PoputEditHours($idCi,$index = 1)
    {
        $data = ['idCi' => $idCi];
        $data['page'] = $this->citas->data_pagination("/Crudcitas/index/",
            $this->citas->getTotalRowAllData(), 3);
        $data['medico'] = $this->citas->getDatos();
        $data['medicoRem'] = $this->citas->remitente();
        $data['cliente'] = $this->citas->cliente();
        $data['salas'] = $this->citas->listasSalas();
        //$data['datoCl'] = $this->citas->getEstudios();
        $data['tablaCitas']=$this->citas->getTablaStatusCita();
        $this->load->view('gridtodocitacuatro',$data);

    }
    public function statusCita()
    {
        $data['tablaCitas']=$this->citas->getTablaStatusCita();
        $this->load->view('gridstatuscita', $data);
    }


    public function index($index = 1)
    {
        $data['page'] = $this->citas->data_pagination("/Crudcitas/index/",
            $this->citas->getTotalRowAllData(), 3);
        $data['medico'] = $this->citas->getDatos();
        $data['medicoRem'] = $this->citas->remitente();
        $data['cliente'] = $this->citas->cliente();
        $data['salas'] = $this->citas->listasSalas();
        //$data['ultimatid'] = $this->citas->getUltimoId();
        $data['tablaCitas']=$this->citas->getTablaStatusCita();
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=18;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        //$this->load->view('gridtodocitasdos',$data);
        $this->load->view('gridtodocitasdos',$data);

    }
    function editaDatos($fActa)
    {
        $horaLlega=$this->input->post('horaLlega');

        $idCita=$this->input->post('idCita');
        $sta=1;
        //echo "horaLlega $horaLlega  idCita $idCita fActa $fActa";
        if (!empty($horaLlega)) {
            $data = array(
                'statusProceso' => $sta,
                'horallegada' => $horaLlega,
                'fechallegada' => $fActa
            );
            $this->citas->mode($data,$idCita);
        }else{}
    }

    public function obtenerHistorial()
    {
        $condicion=" ";
        $fechaInicial=$this->input->post('fechaInicial');
        $fechaFinal=$this->input->post('fechaFinal');
        if(!empty($fechaInicial))
        {
            $condicion=!empty($fechaFinal)? "WHERE controlCambiosCitas.fechaMod BETWEEN '$fechaInicial' AND '$fechaFinal' ":"WHERE controlCambiosCitas.fechaMod>= '$fechaInicial' and citas.cancelar=0";
        }
        else if(!empty($fechaFinal))
        {
            $condicion="WHERE fechaCambio <= '$fechaFinal'  and citas.cancelar=0";
        }
        $retorno=$this->citas->historialCambios($condicion);
        echo json_encode($retorno);
    }


    function traerestudios($idS)
    {
        $prueba= $this->citas->getEstudios($idS);
        echo json_encode ($prueba);
    }

    function traerLista($fecha)
    {
        $prueba= $this->citas->getListaCitas($fecha);
        echo json_encode ($prueba);
    }

    function traerListaTodoCitas($fecha)
    {
        $prueba= $this->citas->getListaTodoCitas($fecha);
        echo json_encode ($prueba);
    }

    function traerListaTodoCitasGral($fecha)
    {
        $prueba= $this->citas->getListaTodoCitasGral($fecha);
        echo json_encode ($prueba);
    }

    function traerListaTodoCitasGralEnCitas()
    {
        $prueba= $this->citas->getListaTodoCitasGralEnCitas();
        echo json_encode ($prueba);
    }


    function getEstuPaciente()

    {
        $idPac = $this->input->post('idPac');
        $fech = $this->input->post('fecha');
        //echo "entra idPac $idPac fech $fech";
        $prueba= $this->citas->estuPac($idPac,$fech);
        echo json_encode ($prueba);
    }


    function traerListaTodoCitasxPeticion($valor,$fecha)
    {
        $valor1 = str_replace("%20", " ", $valor);
        $prueba= $this->citas->getListaTodoCitasXpeticion($valor1,$fecha);
        echo json_encode ($prueba);
    }

    function traerDuracion($idE)
    {
        $prueba= $this->citas->getHora($idE);
        echo json_encode ($prueba);
    }

    function cancelarCita($idC)
    {
        $data = array(
            'cancelar' => 1
        );
        $this->citas->canceCita($data,$idC);

    }

    function getContra()
    {
        $password=$this->input->post('password');
        $prueba= $this->citas->verificaPassword($password);
        echo json_encode ($prueba);
    }

    function detalleEdit($idontrol)
    {
        $data = ['idontrol' => $idontrol];
        $data['datosOri'] = $this->citas->getCiMod($idontrol);
        $data['datosActuale'] = $this->citas->getCiAc($idontrol);
        $this->load->view('griddetalleedicioncitas',$data);
    }


    function buscarNombre()

    {

        $paciente=$_REQUEST["q"];
        if(isset($paciente)){
            $result=$this->citas->obtenerDatosCliente($paciente);
            if(count($result)>0)
                foreach($result as $pr)

                    $arrResult[]=array("value"=>$pr->nombrePaci,
                        "idPaciente"=>$pr->idPaciente,
                        "generoPaci"=>$pr->generoPaci,
                        "correoPaci"=>$pr->correoPaci,
                        "edadPaci"=>$pr->edadPaci,
                        "fechanaciPaci"=>$pr->fechanaciPaci,
                        "telefonoPaci"=>$pr->telefonoPaci,
                        "cliente"=>$pr->cliente
                    );
            echo json_encode($arrResult);
        }
    }

    function buscarNombreEstudio()
    {
        $Estudio=$_REQUEST["q"];
        if(isset($Estudio)){
            $result=$this->citas->obtenerDatosEstudio($Estudio);
            if(count($result)>0)
                foreach($result as $pr)

                    $arrResult[]=array("value"=>$pr->nombreEstudio,
                        "IdEstudio"=>$pr->IdEstudio,
                        "diasResultado"=>$pr->diasResultado,
                        "indicacionesPaciente"=>$pr->indicacionesPaciente,
                        "duracion"=>$pr->duracion,
                        "idCat"=>$pr->idCat
                    );
            echo json_encode($arrResult);
        }
    }

    function obtenerDatos($idPacie)
    {
        $prueba= $this->citas->getPaciente($idPacie);
        echo json_encode ($prueba);
    }

    function obtenerDetallecitaModa($idC)
    {
        $prueba= $this->citas->getDatoCitaMod($idC);
        echo json_encode ($prueba);
    }

    function traetodoSalas($idEst)
    {
        $prueba= $this->citas->getSalaxEstudio($idEst);
        echo json_encode ($prueba);
    }

    function traeDatosMedico($sala)
    {
        $prueba= $this->citas->getTodoMedico($sala);
        echo json_encode ($prueba);
    }

    function compruebaDiasLaborales($dia, $medico)
    {
        $prueba= $this->citas->traeDiasLaborales($dia, $medico);
        echo json_encode ($prueba);
    }

    function traeduracion($idE)
    {
        $prueba= $this->citas->getDuracion($idE);
        echo json_encode ($prueba);
    }

    function traenoDispo($idS,$fecha)
    {
        $prueba= $this->citas->getnoDispo($idS,$fecha);
        echo json_encode ($prueba);
    }


    function verificarOcupado($idMe,$fecha)
    {
        $prueba= $this->citas->veOcu($idMe,$fecha);
        echo json_encode ($prueba);
    }

    function verificarOcupadoP($idP,$fecha)
    {
        $prueba= $this->citas->veOcuP($idP,$fecha);
        echo json_encode ($prueba);
    }

    function verificarDispo($idMe,$fecha)
    {
        $prueba= $this->citas->veDis($idMe,$fecha);
        echo json_encode ($prueba);
    }

    function traeProximonoDispo($idE,$idS,$fecha,$hora)
    {
        $prueba= $this->citas->getProxnoDispo($idE,$idS,$fecha,$hora);
        echo json_encode ($prueba);
    }

    function traerSala($idSal)
    {
        $prueba= $this->citas->getsalasocupadas($idSal);
        echo json_encode ($prueba);
    }

    function obtenerInfoGraCitas($idCita,$fech)
    {
        $prueba= $this->citas->getCitaGral($idCita,$fech);
        echo json_encode ($prueba);
    }
    function obtenerInfoGraCitasHour($idCita)
    {
        $prueba= $this->citas->getCitaGralHour($idCita);
        echo json_encode ($prueba);
    }

    function traeProximonoDispoParaUrgencia($estudio,$sala,$fecha,$hora)
    {
        $prueba= $this->citas->getProxnoDispoUrgencia($estudio,$sala,$fecha,$hora);
        echo json_encode ($prueba);
    }

    function QuitarCi($idC)
    {
        $prueba= $this->citas->quitarCita($idC);
    }

    function getEstudioR($foli)
    {
        $prueba= $this->citas->getEst($foli);
        echo json_encode ($prueba);
    }

    function traeUrgencianoDispo($idE,$idS,$fecha)
    {
        $prueba= $this->citas->getUrgencianoDispo($idE,$idS,$fecha);
        echo json_encode ($prueba);
    }

    function obtenerDatosClientess($idP)
    {
        $prueba= $this->citas->getCliente($idP);
        echo json_encode ($prueba);
    }

    function datosGetCitas($idc)
    {
        $prueba= $this->citas->getCiMod($idc);
        echo json_encode ($prueba);
    }

    function insertarCambio()
    {
        $array=array(
            'idUser' => $this->input->post('idUser'),
            'idCita' => $this->input->post('idCita'),
            'idSalaAnt' => $this->input->post('idSalaAnt'),
            'fechaAnt' => $this->input->post('fechaAnt'),
            'horaAnt' => $this->input->post('horaAnt'),
            'idSalaNueva' => $this->input->post('idSalaNueva'),
            'fechaNueva' => $this->input->post('fechaNueva'),
            'horaNueva' => $this->input->post('horaNueva'),
            'fechaCambio' => date("Y-m-d"),
            'horaCambio' => date("H:i:s")
        );
        $this->citas->insertarCambios($array);
    }

    function modificPaciente($idPacien){
        $data = array(
            'nombrePaci' => $this->input->post('nombreEdit'),
            'generoPaci' => $this->input->post('generoEdi'),
            'correoPaci' => $this->input->post('correoEd'),
            'edadPaci' => $this->input->post('edadEdi'),
            'fechanaciPaci' => $this->input->post('fechanaciEdi'),
            'telefonoPaci' => $this->input->post('telefonoEdi'),
            'remitente' => $this->input->post('medicoremitenteEdi'),
            'cliente' => $this->input->post('clienteEdit')
        );
        $this->citas->modifcPacie($data,$idPacien);
    }

    function agregacita()
    {
        $hoyRegistro=date("Y-m-d");

        $cancelar=0;
        $status=0;
        $fc=2;
        $hora="00:00:00";
        $fe="0000-00-00";
        $tipoCi=$this->input->post('tipoCi');
        if ($tipoCi!=8) {
            $Pago=4;
        }else{
            $Pago=0;
        }

        $horaRegistro = date('H:i:s');
        if ($this->input->post('cortesiaCit')!="") {
            $cortes=$this->input->post('cortesiaCit');
        }else{
            $cortes=0;
        }
        $calveCita=$this->input->post('codigoCita');
        $data = array(
            'idSala' => $this->input->post('Salas'),
            'idEstudio' => $this->input->post('Estud'),
            'fechaCita' => $this->input->post('fecha'),
            'horarioCita' => $this->input->post('horainicio'),
            'idPaciente' => $this->input->post('idPaciente'),
            'idMedico' => $this->input->post('medico'),
            'horaTerminada' => $this->input->post('HoraTerminada'),
            'idUser' => $this->input->post('idUser'),
            'urgencia'=> $this->input->post('emergencia'),
            'orden_medica'=> $this->input->post('orden'),
            'cancelar'=> $cancelar,
            'statusProceso'=> $status,
            'horallegada'=> $hora,
            'fechallegada'=> $fe,
            'factura'=> $fc,
            'tipoCitaa'=> $this->input->post('tipoCi'),
            'observacionesPaciente'=> $this->input->post('observacionesPaciente'),
            'statusPago'=> $Pago,
            'fEntrega'=> $this->input->post('fechaEntre'),
            'prioridad'=> $this->input->post('Priorid'),
            'cortesia'=>  $cortes,
            'tipocortesia'=> $this->input->post('tipCortes'),
            'precioEstudio' => 0,
            'fechaCaptura'=> $hoyRegistro,
            'hourRegistro'=> $horaRegistro,
            'folioCita'=> $calveCita
        );

        $llavePrimaria=$this->citas->insertaDatos($data);
        $tipoCi=$this->input->post('tipoCi');
        $Estud=$this->input->post('Estud');
        $returDat=$this->citas->getPreci($llavePrimaria,$tipoCi,$Estud);
        foreach ($returDat as $key) {
            $precioPr= $key['precio'];
        }

        $Preci = array(
            'precioEstudio' => $precioPr
        );
        $this->citas->updatecitas($Preci,$llavePrimaria);
        $horainicio = $this->input->post('horainicio');


    }

    function modificarC()
    {
        $idCita = $this->input->post('idCiMod');

        $returDat=$this->citas->detInfocitas($idCita);
        foreach ($returDat as $key) {
            $idSalaRE= $key['idSala'];
            $idEstudioRE= $key['idEstudio'];
            $fechaCitaRE= $key['fechaCita'];
            $horarioCitaRE= $key['horarioCita'];
            $idPacienteRE= $key['idPaciente'];
            $idMedicoRE= $key['idMedico'];
            $horaTerminadaRE= $key['horaTerminada'];
            $idUserRE= $key['idUser'];
            $precioPrTR= $key['precioEstudio'];
            $urgenciaRE= $key['urgencia'];
            $orden_medicaRE= $key['orden_medica'];
            $facturaRE= $key['factura'];
            $tipoCitaaRE= $key['tipoCitaa'];
            $fEntregaRE= $key['fEntrega'];
            $prioridadRE= $key['prioridad'];
            $cortesiaRE= $key['cortesia'];
            $tipocortesiaRE= $key['tipocortesia'];
            $observacionesPacienteRES= $key['observacionesPaciente'];
        }
        if ($this->input->post('cortesiaCit')!="") {
            $cortes=$this->input->post('cortesiaCit');
        }else{
            $cortes=0;
        }
        $dataControl = array(
            'idSala' => $idSalaRE,
            'idEstudio' => $idEstudioRE,
            'fechaCita' => $fechaCitaRE,
            'horarioCita' => $horarioCitaRE,
            'idPaciente' => $idPacienteRE,
            'idMedico' => $idMedicoRE,
            'horaTerminada' => $horaTerminadaRE,
            'idUser' => $this->input->post('idUser'),
            'urgencia'=> $urgenciaRE,
            'orden_medica'=> $orden_medicaRE,
            'observacionesPaciente'=> $observacionesPacienteRES,
            'tipoCitaa'=> $tipoCitaaRE,
            'fEntrega'=> $fEntregaRE,
            'prioridad'=> $prioridadRE,
            'fechaMod'=> $this->input->post('fechaOcuta'),
            'horaMod'=> $this->input->post('horaActual'),
            'cortesia'=>  $cortesiaRE,
            'tipocortesia'=>  $tipocortesiaRE,
            'idCita'=>$idCita
        );
        $this->citas->insertControlCmab($dataControl);


        $data = array(
            'idSala' => $this->input->post('Salas'),
            'idEstudio' => $this->input->post('Estud'),
            'fechaCita' => $this->input->post('fecha'),
            'horarioCita' => $this->input->post('horainicio'),
            'idPaciente' => $this->input->post('idPaciente'),
            'idMedico' => $this->input->post('medico'),
            'horaTerminada' => $this->input->post('HoraTerminada'),
            'idUser' => $this->input->post('idUser'),
            'urgencia'=> $this->input->post('emergencia'),
            'orden_medica'=> $this->input->post('orden'),
            'observacionesPaciente'=> $this->input->post('observacionesPaciente'),
            'tipoCitaa'=> $this->input->post('tipoCi'),
            'fEntrega'=> $this->input->post('fechaEntre'),
            'prioridad'=> $this->input->post('Priorid'),
            'cortesia'=> $cortes,
            'tipocortesia'=> $this->input->post('tipCortes'),
            'folioCita'=> $this->input->post('codigoCita')
        );
        //$this->citas->updatecitas($data,$idCita);
        $this->citas->insertaDatos($data);


        $tipoCi=$this->input->post('tipoCi');
        $Estud=$this->input->post('Estud');
        $returDat=$this->citas->getPreci($idCita,$tipoCi,$Estud);
        foreach ($returDat as $key) {
            $precioPr= $key['precio'];

        }
        $Preci = array(
            'precioEstudio' => $precioPr
        );
        $this->citas->updatecitas($Preci,$idCita);
    }



}


?>