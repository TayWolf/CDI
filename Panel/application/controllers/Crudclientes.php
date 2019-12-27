<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudClientes extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("clientes"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=8;
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

     	$data['clientes'] = $this->clientes->getDatos($index);
     	$data['clientesCompletos']= $this->clientes->getCompletos();
     	$data['estado'] = $this->clientes->Edo();
		$this->load->view('gridtodoclientes',$data);  

		
	}

	public function altaClientes()
	{
		$data['estado'] = $this->clientes->Edo();
         $this->load->view('gridaltacliente',$data);  
	}
	 function getMuni($idEdo)
	 {
	 	 $prueba= $this->clientes->obtenerMuni($idEdo);
        echo json_encode ($prueba);
	 }

	 function getColo($idMuni)
	 {
	 	 $prueba= $this->clientes->obtenerColo($idMuni);
        echo json_encode ($prueba);
	 }

	 function getPostal($coloniaCl)
	 {
	 	 $prueba= $this->clientes->obtenerPostal($coloniaCl);
        echo json_encode ($prueba);
	 }

	public function detalleCliente()
	{
		$idC=$_REQUEST['id'];   
         $this->load->view('griddetallecliente',$idC);  
	}

	public function CondicionesAlta()
	{
		$idC=$_REQUEST['id'];   
        $this->load->view('gridcondicionescliente',$idC);  
	}

	public function CondicionesDetalle()
	{
		$idC=$_REQUEST['id'];   
		$data['idC']=$idC;
		$data['condicion']=$this->clientes->obtenerCondicion($idC);
		if(sizeof($data['condicion'])>0)
        	$this->load->view('gridcondicionesdetalle',$data);  
        else
        	$this->load->view('gridcondicionescliente',$idC);  
	}

	public function ModificarCliente()
	{
		$idC=$_REQUEST['id'];   
		
         $this->load->view('grideditarcliente',$data,$idC);  
	}
	

	function obtenerDatos($idC)
    {
        $prueba= $this->clientes->obtenerFicha($idC);
        echo json_encode ($prueba);
    }

    function buscacondiciones($id)
    {
        $prueba= $this->clientes->obtenerCondicion($id);
        echo json_encode ($prueba);
    }

	function logout(){
	  $this->session->sess_destroy();
	  redirect('http://localhost/CDI/Panel/');
	 }

	  function eliminarCliente($id){
        $this->clientes->borrarDatos($id);
        redirect('http://localhost/CDI/Panel/index.php/Crudclientes');
    }

	 function agregaCliente()
    {   
        $data = array(  
                'nombreCliente' => $this->input->post('nombrecliente'),
	            'Clave' => $this->input->post('clave'),
	            'RFC' => $this->input->post('rfcCliente'),
	            'direccionCliente' => $this->input->post('direccionC'),
	            'CP' => $this->input->post('codigoP'),
	            'Colonia' => $this->input->post('coloniaCl'),
	            'municipio' => $this->input->post('municipio'),
	            'Estado' => $this->input->post('estado'),
	            'telefono' => $this->input->post('teleCliente'),
	            'precioEspecial' =>$this->input->post('precioEspecial')
                );
        $this->clientes->insertaDatos($data);
       // echo "1";
    }

	 function agregaCondicion()
    {   
        $data = array(  
                'descuento' => $this->input->post('descuento'),
	            'diasCredito' => $this->input->post('diascredito'),
	            'creditos' => $this->input->post('credito'),
	            'estadoCuenta' => $this->input->post('estadoc'),
	            'controldeVales' => $this->input->post('vales'),
	            'Catalogo' => $this->input->post('catalogo'),
	            'formaPago' => $this->input->post('fpago'),
	            'cuenta' => $this->input->post('cuenta'),
	            'cliente' => $this->input->post('id')
                );
        $this->clientes->insertaCondicion($data);
       // echo "1";
    }


	 function modificarDatos(){
		 
	 	$idCliente=$this->input->post('idCliente');
				$nombreCliente=$this->input->post('nombre');
				$nombre=mb_strtoupper($nombreCliente);


				$Clave=$this->input->post('clave');
				$clave=mb_strtoupper($Clave);

				$RFC=$this->input->post('rfc');
				$rfc=mb_strtoupper($RFC);

				$direccionCliente=$this->input->post('direccion');
				$direccion=mb_strtoupper($direccionCliente);

				$CP=$this->input->post('CP');
				$CP=mb_strtoupper($CP);

				$Colonia=$this->input->post('colonia');
				$colonia=mb_strtoupper($Colonia);

				$Municipio=$this->input->post('municipio');
				$municipio=mb_strtoupper($Municipio);

				$Estado=$this->input->post('Estado');
				$Estado=mb_strtoupper($Estado);

				$Telefono=$this->input->post('telefono');
				$telefono=mb_strtoupper($Telefono);
				
				$PrecioEspecial=$this->input->post('PrecioEspecial');
				if(!empty($PrecioEspecial)) {
					$data = array(
						'precioEspecial' => $PrecioEspecial
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}

				if (!empty($nombreCliente)) {
					$data = array(
						'nombreCliente' => $nombre
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}else{}

				if (!empty($Clave)) {
					$data = array(
						'Clave' => $clave
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}else{}

				if (!empty($RFC)) {
					$data = array(
						'RFC' => $rfc
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}else{}

					if (!empty($direccionCliente)) {
					$data = array(
						'direccionCliente' => $direccion
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}else{}

				if (!empty($Estado)) {
					$data = array(
						'Estado' => $Estado
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}else{}

				if (!empty($Municipio)) {
					$data = array(
						'municipio' => $municipio
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}else{}

				if (!empty($Colonia)) {
					$data = array(
						'Colonia' => $colonia
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}else{}

				if (!empty($CP)) {
					$data = array(
						'CP' => $CP
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}else{}

					if (!empty($Telefono)) {
					$data = array(
						'telefono' => $telefono //El que va en ''  es el de la base de datos.
					);
					$this->clientes->modificaDatos($data,$idCliente);
				}else{}
        // $idC = $this->input->post('idC');
        // $data = array(
        //     'nombreCliente' => $this->input->post('nombreCliente'),
	       //  'Clave' => $this->input->post('claveCl'),
	       //  'RFC' => $this->input->post('rfcCliente'),
	       //  'direccionCliente' => $this->input->post('direccionCli'),
	       //  'CP' => $this->input->post('codigoPo'),
	       //  'Colonia' => $this->input->post('coloniaCl'),
	       //  'municipio' => $this->input->post('municipioCli'),
	       //  'Estado' => $this->input->post('estadoClien'),
	       //  'telefono' => $this->input->post('telClien')
        //     );
        // $this->clientes->modificaDatos($data,$idC);
    }

    function modificarCondiciones(){
        $id = $this->input->post('id');
        $data = array(
            'descuento' => $this->input->post('descuento'),
	        'diasCredito' => $this->input->post('diascredito'),
	        'creditos' => $this->input->post('credito'),
	        'estadoCuenta' => $this->input->post('estadoc'),
	        'controldeVales' => $this->input->post('vales'),
	        'Catalogo' => $this->input->post('catalogo'),
	        'formaPago' => $this->input->post('fpago'),
	        'cuenta' => $this->input->post('cuenta')
            );
        $this->clientes->modificaCondicion($data,$id);
    }

	
	}

?>