<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudEstudiosporsala extends CI_Controller {
    function __construct(){
        parent::__construct();
        if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
        $this->load->model("estudioporsala"); //cargamos el modelo de User

    }

    public function index($index = 1)
    {
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=22;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        $data['page'] = $this->estudioporsala->data_pagination("/Crudcitas/index/",
            $this->estudioporsala->getTotalRowAllData(), 3);
        //$data['areas'] = $this->estudioporsala->getAreas();
        $tipoUser = $this->session->userdata('tipoUser');
        $idUser = $this->session->userdata('idUser');

        if( $tipoUser == 1 ){
            $data['areas'] = $this->estudioporsala->getAreas(array());
        }else if($tipoUser == 6){
            $data['areas'] = $this->estudioporsala->getAreasComplementaria(array(1, 4, 5, 6));
        }
        //$data['Estudios'] = $this->estudioporsala->getEstudios();
        $this->load->view('gridestudioporsala',$data);
    }


    public function entrega()
    {
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=23;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        $data['page'] = $this->estudioporsala->data_pagination("/Crudcitas/gridEntregaEstudios/",
            $this->estudioporsala->getTotalRowAllData(), 3);
        //$data['areas'] = $this->estudioporsala->getAreas();
        $tipoUser = $this->session->userdata('tipoUser');
        $idUser = $this->session->userdata('idUser');

        if( $tipoUser == 1 ){
            $data['areas'] = $this->estudioporsala->getAreas(array());
        }else if($tipoUser == 6){
            $data['areas'] = $this->estudioporsala->getAreasComplementaria(array(1, 4, 5, 6));
        }
        //$data['Estudios'] = $this->estudioporsala->getEstudios();
        //ASDAS
        $this->load->view('gridEntregaEstudios',$data);
    }

    function traeLista($idSala,$fechaconsu, $fechaconsuFinal, $doctor)
    {
        $contadorAND=-1;
        $condicionGeneral = "WHERE citas.cancelar!=1 AND citas.statusProceso>=4";
        $condicionArea="";
        $condicionFecha="";
        $condicionDoctor="";
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
        if($doctor!="0")
        {
            if($contadorAND>=0)
            {
                $condicionDoctor.="AND";
            }
            $condicionDoctor.=" Doctores.nombreDoc LIKE '%$doctor%' ";
            $contadorAND++;
        }
        if($contadorAND!=-1)
        {
            $condicionGeneral= "WHERE ".$condicionArea.$condicionFecha.$condicionDoctor;

        }



        $prueba= $this->estudioporsala->traerLista($condicionGeneral);
        echo json_encode($prueba);
        //echo json_encode("hola");
    }

    function traeListaEntrega($idSala, $fechaconsu, $fechaconsuFinal, $folioCita, $doctor, $paciente)
    {
        $paciente=str_replace("%20", " ", $paciente);
        $contadorAND=-1;
        $condicionGeneral="WHERE citas.cancelar!=1 AND citas.statusProceso>=4  ";
        $condicionArea="";
        $condicionFecha="";
        $condicionDoctor="";
        $condicionPaciente="";
        $condicionCita = "";
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
            }
            $condicionPaciente.=" Pacientes.nombrePaci LIKE '%$paciente%' ";
            $contadorAND++;
        }
        if ($folioCita != "0") {
            if ($contadorAND >= 0) {
                $condicionCita.= "AND";
            }
            $condicionCita .= " citas.folioCita LIKE '%$folioCita%' ";
            $contadorAND++;
        }
        if($contadorAND!=-1)
        {
            $condicionGeneral= "WHERE ".$condicionArea.$condicionFecha.$condicionDoctor.$condicionPaciente.$condicionCita." AND  citas.cancelar!=1 AND citas.statusProceso>=4 ";

        }



        $prueba= $this->estudioporsala->traerListaEntrega($condicionGeneral);
        //echo json_encode($condicionGeneral);
        echo json_encode($prueba);
        //echo json_encode("hola");
    }

    function traeListaTodo()
    {
        $tipoUser = $this->session->userdata('tipoUser');
        $idUser = $this->session->userdata('idUser');

        if( $tipoUser == 1 ){
            $prueba= $this->estudioporsala->traerListaTodo();
        }else{
            $prueba= $this->estudioporsala->traerListaTodoComplementaria(array(1, 4, 5, 6));
        }

        echo json_encode ($prueba);
    }

    function traeListaTodoEntrega()
    {
        if( $tipoUser == 1 ){
            $prueba= $this->estudioporsala->traerListaTodo();
        }else{
            $prueba= $this->estudioporsala->traerListaTodoComplementaria(array(1, 4, 5, 6));
        }
        echo json_encode ($prueba);
    }

    function comprobarExiste($idCita,$tip)
    {
        $prueba= $this->estudioporsala->traerExistenc($idCita,$tip);
        echo json_encode ($prueba);
    }


    function getContras()
    {
        $password=$this->input->post('password');
        $prueba= $this->estudioporsala->verificAPassword($password);
        echo json_encode ($prueba);
    }


    function insertardatos($idCita,$idUser,$tip)
    {
        $hora=date('H:i:s');
        $fechaEntrega=date('Y-m-d');
        $data = array(
            'idCita' => $idCita,
            'fechacaptura' => $fechaEntrega,
            'horaEntrega' => $hora,
            'idUser' => $idUser,
            'tipo' => $tip,
        );
        $this->estudioporsala->insertaDatosEnte($data);

        $array = array(
            //establece el status a 7 que es igual a "Entregado"
            "statusProceso" => 7
        );
        $this->estudioporsala->updateStatusCita($array, $idCita);
    }
    function deleteCita($idCit,$tip)
    {
        $this->estudioporsala->borrarDatosEntr($idCit,$tip);
        $array = array(
            //establece el status a 6 que es igual a "En espera de resultados"
            "statusProceso" => 6
        );
        $this->estudioporsala->updateStatusCita($array, $idCit);
        //redirect('http://localhost/CDI/Panel/index.php/Crudestudiosporsala/entrega');
    }

    function cambiarPrioridadEstudio($idCita, $valorPrioridad)
    {
        $this->estudioporsala->updatePrioridad($idCita, $valorPrioridad);
    }

    function insertaDato($idCita)
    {
        $idUser = $this->session->userdata('idUser');
        $hoy=date("Y-m-d");
        $hora = date('H:i:s');
        $array = array(
            "idCita" => $idCita,
            "status" => 1,
            "idUser" => $idUser,
            "fechaConfirmacion" => $hoy,
            "horaconfirma" => $hora
        );
        $this->estudioporsala->insertarDatoConfirma($array);
    }

    function getConfirmadoLista($idCita)
    {
        $prueba= $this->estudioporsala->getConfirma($idCita);
        echo json_encode ($prueba);

    }

    function eliminarCita($idCita)
    {
        $prueba= $this->estudioporsala->eliminarCon($idCita);
        echo json_encode ($prueba);
    }
    function editarNombreQuienRecibe(){
        $idCita=$this->input->post('idCita');
        $nombreRecibe=$this->input->post('nombreRecibe');

        //verificar que exista
        //si existe
        if(!empty($this->estudioporsala->verificarEntregaResultado($idCita)))
            $this->estudioporsala->actualizarEntregaResultado($idCita,array('recibeEstudio'=>$nombreRecibe));
        //si no:
        //  else
//      $this->estudioporsala->insertaDatosEnte(array('idCita' => $idCita, 'fechacaptura' => date("Y-m-d"), 'horaEntrega' => date("H:i:s"), 'idUser'=>$this->session->userdata('idUser'), 'tipo' => 1, 'recibeEstudio' => $nombreRecibe));

    }
    function cambiarStatusEntregaResultado($idCita, $columna, $valor)
    {

        $this->estudioporsala->insertarEntregaResultado($idCita,
            array(
                'idCita' => $idCita,
                'fechaCaptura' => date("Y-m-d"),
                'horaEntrega' => date("H:i:s"),
                'idUser' => $this->session->userdata("idusuariobase"),
                'interpretacion' => 0,
                'elaborado' => 0,
                'entrega' => 0
            ));



        if($columna==1)
        {
            $idUsuario=$this->session->userdata("idUser");
            //Esto verifica en la base de datos si ya existe un historial con el status y la cita pasadas que sea valid
            //Si no hay ninguno, inserta un historico. De lo contrario no pasa nada
            $existe=$this->estudioporsala->borrarPosteriores($idCita, 5);
            if(!$existe)
            {
                $historico=array('idCita' => $idCita, 'status' => 5, 'fecha' => date('Y-m-d'), 'hora' => date('H:i:s'), 'idUsuario' => $idUsuario, 'validez' => 1);
                $this->estudioporsala->insertarHistoricoStatus($historico);
            }

            $data = array(
                'statusProceso' => 5
            );
            $this->estudioporsala->cambiarStatusProceso($data, $idCita);
            $columna="interpretacion";
        }

        else if($columna==2)
            $columna="entrega";
        else if($columna==3)
            $columna="elaborado";




        $this->estudioporsala->actualizarEntregaResultado($idCita, array($columna =>  $valor));
    }


}


?>