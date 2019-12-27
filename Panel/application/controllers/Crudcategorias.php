<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudCategorias extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("categoria"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=10;
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

     	$data['Categoria'] = $this->categoria->getDatos($index); 
		$this->load->view('gridtodocategorias',$data);  

		
	}

	function logout(){
  $this->session->sess_destroy();
  redirect('http://localhost/CDI/Panel/');
 }

	public function formAltaCategoria()
	{
			$this->load->view('gridaltacategoria');  
	}


	// public function formDetalleCategoria()
	// {
	// 	if(isset($_REQUEST['id']))
	// 	{
	// 		$idCat=$_REQUEST['id'];
	// 		$this->session->set_userdata("idusuario",$idCat); 
	// 	}
	// 	else
	// 	{
	// 			$idUser=$this->session->userdata('idusuario');
	// 	}	
	// 		$this->load->view('griddetallecategoria',$idCat);
	// }

// public function formEditarUsuario()
// 	{
// 		if(isset($_REQUEST['id']))
// 		{
// 			$idCat=$_REQUEST['id'];
// 			$this->session->set_userdata("idusuario",$idCat); 
// 		}
// 		else
// 		{
// 				$idCat=$this->session->userdata('idusuario');
// 		}
		
// 			$this->load->view('grideditarcategoria',$idCat); 
// 	}

	function obtenerDatos($idc)
	{
    	$prueba= $this->categoria->obtenerFicha($idc);
    	echo json_encode ($prueba);
	}
	function obtenerDatosbase($idcbase)
	{
    	$prueba= $this->categoria->obtenerFichabase($idcbase);
    	echo json_encode ($prueba);
	}


function altaCategoria()
	{	
		$data = array(	
		'nombreCat' => $this->input->post('nombreCat')
		);
		$this->categoria->insertaDatos($data);
		echo "1";
	}

	function modificarDatos(){
				$idCat=$this->input->post('idcategoria');
				$nombreCat=$this->input->post('nombreCat');
				$nombreCat=mb_strtoupper($nombreCat);

				if (!empty($nombreCat)) {
					$data = array(
						'nombreCat' => $nombreCat
					);
					$this->categoria->modificaDatos($data,$idCat);
				}else{}
	}	

	function deleteCategoria($idCat){

		$this->categoria->borrarDatos($idCat);
		redirect('http://localhost/CDI/Panel/index.php/Crudcategorias');
		
	}
		

	}

?>