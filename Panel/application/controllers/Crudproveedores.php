<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudProveedores extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("proveedores"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=11;
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

     	$data['Proveedor'] = $this->proveedores->getDatos($index); 
		$this->load->view('gridtodoproveedores',$data);  

		
	}

	function logout(){
  $this->session->sess_destroy();
  redirect('http://localhost/CDI/Panel/');
 }

	public function formAltaProveedor()
	{
			$this->load->view('gridaltaproveedor');  
	}


	// public function formDetalleProveedor()
	// {
	// 	if(isset($_REQUEST['id']))
	// 	{
	// 		$idUser=$_REQUEST['id'];
	// 		$this->session->set_userdata("idusuario",$idUser); 
	// 	}
	// 	else
	// 	{
	// 			$idUser=$this->session->userdata('idusuario');
	// 	}	
	// 		$this->load->view('griddetalleusuario',$idUser);
	// }

// public function formEditarProveedor()

// 	{
// 		if(isset($_REQUEST['id']))
// 		{
// 			$idUser=$_REQUEST['id'];
// 			$this->session->set_userdata("idusuario",$idUser); 
// 		}
// 		else
// 		{
// 				$idUser=$this->session->userdata('idusuario');
// 		}
		
// 			$this->load->view('grideditarusuario',$idUser); 
// 	}

	function obtenerDatos($idp)
	{
    	$prueba= $this->proveedores->obtenerFicha($idp);
    	echo json_encode ($prueba);
	}
	function obtenerDatosbase($idpbase)
	{
    	$prueba= $this->proveedores->obtenerFichabase($idpbase);
    	echo json_encode ($prueba);
	}


function altaProveedor()
	{	
		$data = array(	
		'nombreP' => $this->input->post('nombreproveedor'),
		'direccion' => $this->input->post('direccion'),
		'poblacion' => $this->input->post('poblacion'),
		'colonia' => $this->input->post('colonia'),
		'codigo_postal' => $this->input->post('codigopostal'),
		'reg_fed_cau' => $this->input->post('reg_fed_cau'),
		'nombreContacto' => $this->input->post('nomcontacto'),
		'telefonoUno' => $this->input->post('telefono'),
		'saldo' => $this->input->post('saldo')
		);
		$this->proveedores->insertaDatos($data);
		echo "1";
	}

	function modificarDatos(){
				$idProveedor=$this->input->post('idproveedor');
				$nombreP=$this->input->post('nombreproveedor');
				$nombreproveedor=mb_strtoupper($nombreP);

				$direccion=$this->input->post('direccion');
				$direccion=mb_strtoupper($direccion);

				$poblacion=$this->input->post('poblacion');
				$poblacion=mb_strtoupper($poblacion);

				$colonia=$this->input->post('colonia');
				$colonia=mb_strtoupper($colonia);

				$codigo_postal=$this->input->post('codigopostal');
				$reg_fed_cau=$this->input->post('reg_fed_cau');
				$reg_fed_cau=mb_strtoupper($reg_fed_cau);

				$nombreContacto=$this->input->post('nomcontacto');
				$nomcontacto=mb_strtoupper($nombreContacto);

				$telefonoUno=$this->input->post('telefono');
				$telefono=mb_strtoupper($telefonoUno);

				$saldo=$this->input->post('saldo');

				if (!empty($nombreP)) {
					$data = array(
						'nombreP' => $nombreproveedor
					);
					$this->proveedores->modificaDatos($data,$idProveedor);
				}else{}
				if (!empty($direccion)) {
					$data = array(
						'direccion' => $direccion
					);
					$this->proveedores->modificaDatos($data,$idProveedor);
				}else{}
				if (!empty($poblacion)) {
					$data = array(
						'poblacion' => $poblacion
					);
					$this->proveedores->modificaDatos($data,$idProveedor);
				}else{}
				if (!empty($colonia)) {
					$data = array(
						'colonia' => $colonia
					);
					$this->proveedores->modificaDatos($data,$idProveedor);
				}else{}
				if (!empty($codigo_postal)) {
					$data = array(
						'codigo_postal' => $this->input->post('codigopostal')
					);
					$this->proveedores->modificaDatos($data,$idProveedor);
				}else{}
				if (!empty($reg_fed_cau)) {
					$data = array(
						'reg_fed_cau' => $reg_fed_cau
					);
					$this->proveedores->modificaDatos($data,$idProveedor);
				}else{}
				if (!empty($nombreContacto)) {
					$data = array(
						'nombreContacto' => $nomcontacto
					);
					$this->proveedores->modificaDatos($data,$idProveedor);
				}else{}
				if (!empty($telefonoUno)) {
					$data = array(
						'telefonoUno' => $telefono
					);
					$this->proveedores->modificaDatos($data,$idProveedor);
				}else{}
				if (!empty($saldo)) {
					$data = array(
						'saldo' => $this->input->post('saldo')
					);
					$this->proveedores->modificaDatos($data,$idProveedor);
				}else{}
	}	

	function deleteProveedor($idProveedor){

		$this->proveedores->borrarDatos($idProveedor);
		redirect('http://localhost/CDI/Panel/index.php/Crudproveedores');
		
	}
		

	}

?>