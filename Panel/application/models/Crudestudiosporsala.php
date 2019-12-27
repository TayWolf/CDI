<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudEstudiosporsala extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("estudioporsala"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
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

    function traeListaEntrega($idSala,$fechaconsu, $fechaconsuFinal, $doctor, $paciente)
    {
        $paciente=str_replace("%20", " ", $paciente);
        $contadorAND=-1;
        $condicionGeneral="WHERE citas.cancelar!=1 ";
        $condicionArea="";
        $condicionFecha="";
        $condicionDoctor="";
        $condicionPaciente="";
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
        if($contadorAND!=-1)
        {
            $condicionGeneral= "WHERE ".$condicionArea.$condicionFecha.$condicionDoctor.$condicionPaciente." AND  citas.cancelar!=1 AND citas.statusProceso>=4 ";

        }



        $prueba= $this->estudioporsala->traerListaEntrega($condicionGeneral);
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
        "statusProceso" => 5
    );  
    $this->estudioporsala->updateStatusCita($array, $idCita);
  }  
  function deleteCita($idCit,$tip)
  {
    $this->estudioporsala->borrarDatosEntr($idCit,$tip);
    $array = array(
        "statusProceso" => 4
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
  

	}


?>