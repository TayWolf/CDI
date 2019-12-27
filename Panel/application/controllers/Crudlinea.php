<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudLinea extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("linea"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=13;
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
     	$data['Linea'] = $this->linea->getDatos($index); 
		$this->load->view('gridtodolinea',$data);  

		
	}

	function logout(){
  $this->session->sess_destroy();
  redirect('http://localhost/CDI/Panel/');
 }

	public function formAltaCategoria()
	{
			$this->load->view('gridaltacategoria');  
	}


	function obtenerDatos($idc)
	{
    	$prueba= $this->linea->obtenerFicha($idc);
    	echo json_encode ($prueba);
	}
	function obtenerDatosbase($idcbase)
	{
    	$prueba= $this->linea->obtenerFichabase($idcbase);
    	echo json_encode ($prueba);
	}


function altaLinea()
	{	
		$data = array(	
		'nombre' => $this->input->post('nombreLine'),
		'controla_caducidad' => $this->input->post('Caduci')
		);
		$this->linea->insertaDatos($data);
		echo "1";
	}

	function modificarDatos(){
				$idLinet=$this->input->post('idLinea');
				$nombreLine=$this->input->post('nombre');
				$nombre=mb_strtoupper($nombreLine);

				$TIP=$this->input->post('tipo');
				//echo "tipo  $TIP id $idLinet ";
				if (!empty($nombreLine)) {
					$data = array(
						'nombre' => $nombre
						
						
					);
					$this->linea->modificaDatos($data,$idLinet);
				}else{}

				if (!empty($TIP)) {
					$data = array(
						
						'controla_caducidad' => $this->input->post('tipo')
					);
					$this->linea->modificaDatos($data,$idLinet);
				}else{}
	}	

	function deleteLinea($idLinea){

		$this->linea->borrarDatos($idLinea);
		redirect('http://localhost/CDI/Panel/index.php/Crudlinea');
		
	}
		

	}

?>