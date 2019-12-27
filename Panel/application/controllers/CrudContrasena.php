<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudContrasena extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("ModeloContrasena"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=1;
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
     	$data['contrasena'] = $this->ModeloContrasena->getDatos($index); 
		$this->load->view('gridtodocontrasena',$data);  

		
	}

	function logout(){
  $this->session->sess_destroy();
  redirect('http://localhost/CDI/Panel/');
 }

	// public function formAltaCategoria()
	// {
	// 		$this->load->view('gridaltacategoria');  
	// }


	function obtenerDatos($idu)
	{
    	$prueba= $this->ModeloContrasena->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}
	// function obtenerDatosbase($idcbase)
	// {
 //    	$prueba= $this->ModeloContrasena->obtenerFichabase($idcbase);
 //    	echo json_encode ($prueba);
	// }


function altaContrasena()
	{	
		$data = array(	
		'contrasena' => $this->input->post('contrasena'),
		'permiso' => $this->input->post('permiso')
		);
		$this->ModeloContrasena->insertaDatos($data);
		echo "1";
	}

	function modificarDatos(){
				$idContrasena=$this->input->post('idContrasena');
				$contrasena=$this->input->post('contrasena');
				$tipo=$this->input->post('tipo');
				

				if (!empty($contrasena)) {
					$data = array(
						'contrasena' => $this->input->post('contrasena')
					);
					$this->ModeloContrasena->modificaDatos($data,$idContrasena);
				}else{}
				if (!empty($tipo)) {
					$data = array(
						'permiso' => $this->input->post('tipo')
					);
					$this->ModeloContrasena->modificaDatos($data,$idContrasena);
				}else{}
	}	

	function deleteContrasenas($idContrasena){

		$this->ModeloContrasena->borrarDatos($idContrasena);
		redirect('http://localhost/CDI/Panel/index.php/CrudContrasena');
		
	}
		

	}

?>