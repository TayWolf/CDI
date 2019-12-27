<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudDoctores extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("doctores"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=3;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
	}

	public function index($index = 1)
	{
     	$data['doctores'] = $this->doctores->getDatos($index); 
		$this->load->view('gridtododoctores',$data);
	}
	public function detalleDoctor()
	{
		$idD=$_REQUEST['id'];   
         $this->load->view('griddetalledoctor',$idD);  
	}

	public function ModificarDoctor()
	{
		$idD=$_REQUEST['id'];   
         $this->load->view('grideditardoctor',$idD);  
	}
	public function altaDoctor()
	{
		
         $this->load->view('gridaltadoctor');  
	}

	function obtenerDatos($idD)
    {
        $prueba= $this->doctores->obtenerFicha($idD);
        echo json_encode ($prueba);
    }

	function logout(){
	  $this->session->sess_destroy();
	  redirect('http://localhost/CDI/Panel/');
	 }

	 function quitaEstudiosDoctor($estudio,$idDoc){
        $this->doctores->borrarDatos($estudio,$idDoc);
        // redirect('http://localhost/CDI/Panel/index.php/Cruddoctores');
    }

	 function agregaDoctor()
    {   
        $data = array(
	        	'claveDoc' => $this->input->post('clave'),
                'nombreDoc' => $this->input->post('nombre'),
	            'fechanaciDoc' => $this->input->post('fecha'),
	            'cedulaDoc' => $this->input->post('cedula'),
	            'telefono' => $this->input->post('telefono'),
	            'correo' => $this->input->post('correo'),
	            'universidadDoc' => $this->input->post('universidad'),
	            'horarioDoc' => $this->input->post('horario'),
	            'status' => 1
                );
        $this->doctores->insertaDatos($data);
       // echo "1";
    }

    function guardaEstudiosDoctor($estudio,$doc)
    {
    	$data = array(
	        	'idDoctor' => $doc,
	            'idEstudio' => $estudio
                );
        $this->doctores->insertaEstudiosDoctor($data);
    }


	 function modificarDatos(){
        $idD = $this->input->post('idD');
        $claveDoc = $this->input->post('claveDoc');


        $nombreDoc = $this->input->post('nombre');
        $nombre=mb_strtoupper ($nombreDoc);

	    $fechanaciDoc = $this->input->post('fecha');
	    $cedulaDoc = $this->input->post('cedulaDoc');
	    $telefono = $this->input->post('telefono');
	    $correo = $this->input->post('correo');

	    $universidadDoc = $this->input->post('universidadDoc');
	    $universidadDoc = mb_strtoupper($universidadDoc);

	    $horarioDoc = $this->input->post('horarioDoc');
	    $horarioDoc = mb_strtoupper($horarioDoc);

	    if (!empty($claveDoc)) {
					$data = array(
						'claveDoc' => $this->input->post('claveDoc')
					);
					 $this->doctores->modificaDatos($data,$idD);
				}else{}

            if (!empty($nombreDoc)) {
					$data = array(
						'nombreDoc' => $nombre
					);
					 $this->doctores->modificaDatos($data,$idD);
				}else{} 

				 if (!empty($fechanaciDoc)) {
					$data = array(
						'fechanaciDoc' =>  $this->input->post('fecha')
					);
					 $this->doctores->modificaDatos($data,$idD);
				}else{}       

				 if (!empty($cedulaDoc)) {
					$data = array(
						'cedulaDoc' => $this->input->post('cedulaDoc')
					);
					 $this->doctores->modificaDatos($data,$idD);
				}else{} 

				if (!empty($telefono)) {
					$data = array(
						'telefono' => $this->input->post('telefono')
					);
					 $this->doctores->modificaDatos($data,$idD);
				}else{}

				if (!empty($correo)) {
					$data = array(
						'correo' => $this->input->post('correo')
					);
					 $this->doctores->modificaDatos($data,$idD);
				}else{}

				 if (!empty($universidadDoc)) {
					$data = array(
						'universidadDoc' => $universidadDoc
					);
					 $this->doctores->modificaDatos($data,$idD);
				}else{} 

				 if (!empty($horarioDoc)) {
					$data = array(
						'horarioDoc' => $horarioDoc
					);
					 $this->doctores->modificaDatos($data,$idD);
				}else{} 
    }





	function inactivo($id)
	{	
		$data = array(
					'status' => "2"
					);
		$this->doctores->desac($data,$id);
	}

	function activo($id)
	{	
		$data = array(
					'status' => "1"
					);
		$this->doctores->act($data,$id);
	}

	function traeSalaMedico($id)
    {
        $prueba= $this->doctores->obtenerSalas($id);
        echo json_encode ($prueba);
    }

    function buscaExistencia($idDoc)
    {
    	$prueba= $this->doctores->obtenerEstudiosDoc($idDoc);
        echo json_encode ($prueba);
    }

	function traeEstudios($clave)
    {
    	$clavesinespacios = str_replace('%20', ' ', $clave);
        $prueba= $this->doctores->obtenerEstudios($clavesinespacios);
        echo json_encode ($prueba);
    }

    function traeHorarioSalaMedico($id)
    {
        $prueba= $this->doctores->obtenerHorarios($id);
        echo json_encode ($prueba);
    }
     function traerHorapordia($dia,$id)
    {
        $prueba= $this->doctores->obtenerHorariosporDia($dia,$id);
        echo json_encode ($prueba);
    }



	
	}

?>