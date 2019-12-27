<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudEmpresas extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("empresas"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=2;
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

     	$data['empresas'] = $this->empresas->getDatos($index); 
		$this->load->view('gridtodoempresas',$data);  

		
	}
	public function detalleEmpresa()
	{
		$idE=$_REQUEST['id'];   
         $this->load->view('griddetalleempresa',$idE);  
	}

	public function ModificarEmpresa()
	{
		$idE=$_REQUEST['id'];   
         $this->load->view('grideditarempresa',$idE);  
	}
	public function altaEmpresa()
	{
		
         $this->load->view('gridaltaempresa');  
	}

	function obtenerDatos($idE)
    {
        $prueba= $this->empresas->obtenerFicha($idE);
        echo json_encode ($prueba);
    }

	function logout(){
	  $this->session->sess_destroy();
	  redirect('http://localhost/CDI/Panel/');
	 }

	  function eliminarEmpresa($idEmpr){
        $this->empresas->borrarDatos($idEmpr);
        redirect('http://localhost/CDI/Panel/index.php/Crudempresas');
    }

	 function agregaEmpresa()
    {   
        $data = array(  
                'nombreEmpresa' => $this->input->post('nombre'),
	            'RFC' => $this->input->post('rfcEmpresa'),
	            'direccionEmpresa' => $this->input->post('direccionE'),
	            'coloniaEmpresa' => $this->input->post('coloniaempre'),
	            'EstadoEmpresa' => $this->input->post('estadoEm'),
	            'telefonoEmpresa' => $this->input->post('telefonoEmp'),
	            'nombreContacto' => $this->input->post('nombreContact')
                );
        $this->empresas->insertaDatos($data);
       // echo "1";
    }


	 function modificarDatos(){
        $idE = $this->input->post('idempresa');
        $nombre = $this->input->post('nombre');
        $nombre=mb_strtoupper ($nombre);

        $RFC = $this->input->post('RFC');
        $RFC = mb_strtoupper($RFC);

        $direccion = $this->input->post('direccion');
        $direccion =mb_strtoupper($direccion);

        $colonia = $this->input->post('colonia');
         $colonia = mb_strtoupper($colonia);

        $estado = $this->input->post('estado');
        $estado =mb_strtoupper($estado);

        $telefono = $this->input->post('telefono');
        $telefono = mb_strtoupper($telefono);

        $contacto = $this->input->post('contacto');
        $contacto = mb_strtoupper($contacto);

        if (!empty($nombre)) {
			$data = array(
				'nombreEmpresa' => $nombre
			);
			$this->empresas->modificaDatos($data,$idE);
		}else{}
		if (!empty($RFC)) {
			$data = array(
				'RFC' => $RFC
			);
			$this->empresas->modificaDatos($data,$idE);
		}else{}
		if (!empty($direccion)) {
			$data = array(
				'direccionEmpresa' => $direccion
			);
			$this->empresas->modificaDatos($data,$idE);
		}else{}
		if (!empty($colonia)) {
			$data = array(
				'coloniaEmpresa' => $colonia
			);
			$this->empresas->modificaDatos($data,$idE);
		}else{}
		if (!empty($estado)) {
			$data = array(
				'EstadoEmpresa' => $estado
			);
			$this->empresas->modificaDatos($data,$idE);
		}else{}
		if (!empty($telefono)) {
			$data = array(
				'telefonoEmpresa' => $telefono
			);
			$this->empresas->modificaDatos($data,$idE);
		}else{}
		if (!empty($contacto)) {
			$data = array(
				'nombreContacto' => $contacto
			);
			$this->empresas->modificaDatos($data,$idE);
		}else{}


        // $data = array(
        //     'nombreEmpresa' => $this->input->post('nombreEmp'),
        //     'RFC' => $this->input->post('rfcEmpresa'),
        //     'direccionEmpresa' => $this->input->post('direccionE'),
        //     'coloniaEmpresa' => $this->input->post('coloniaempre'),
        //     'EstadoEmpresa' => $this->input->post('estadoEm'),
        //     'telefonoEmpresa' => $this->input->post('telefonoEmp'),
        //     'nombreContacto' => $this->input->post('nombreContact')
        //     );
        // $this->empresas->modificaDatos($data,$idE);
    }

	
	}

?>