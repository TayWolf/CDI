<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudAreainterna extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("areainterna"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=5;
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
     	$data['AreaInt'] = $this->areainterna->getDatos($index); 
		$this->load->view('gridtodointerno',$data);  
	}

	

	public function formAltaUsuario()
	{
			$this->load->view('gridaltausuario');  
	}


	

	function obtenerDatos($idu)
	{
    	$prueba= $this->areainterna->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}
	


function altaAreainterna()
	{	
		$data = array(	
		'nombreArea' => $this->input->post('nombreArea')
		);
		$this->areainterna->insertaDatos($data);
		echo "1";
	}

	function modificarDatos(){
				$idAreainterna=$this->input->post('idAreainterna');
				$nombreArea=$this->input->post('nombreArea');
				$nombreArea=mb_strtoupper($nombreArea);
				

				if (!empty($nombreArea)) {
					$data = array(
						'nombreArea' => $nombreArea
					);
					$this->areainterna->modificaDatos($data,$idAreainterna);
				}else{}
				
	}	

	function deleteArea($idArea){

		$this->areainterna->borrarDatos($idArea);
		redirect('http://localhost/CDI/Panel/index.php/Crudareainterna');
		
	}
		

	}

?>