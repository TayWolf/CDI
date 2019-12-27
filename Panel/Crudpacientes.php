<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPacientes extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("pacientes"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->pacientes->data_pagination("/Crudpacientes/index/", 
        $this->pacientes->getTotalRowAllData(), 3);
     	$data['pacientes'] = $this->pacientes->getDatos($index); 
     	$data['medico'] = $this->pacientes->remitente();
		$data['cliente'] = $this->pacientes->cliente();
		$this->load->view('gridtodopacientes',$data);  

		
	}

	public function altaPacientes()
	{
		$data['medico'] = $this->pacientes->remitente();
		$data['cliente'] = $this->pacientes->cliente();
         $this->load->view('gridaltapaciente',$data);  
	}
	 // function getMuni($idEdo)
	 // {
	 // 	 $prueba= $this->clientes->obtenerMuni($idEdo);
  //       echo json_encode ($prueba);
	 // }

	 // function getColo($idMuni)
	 // {
	 // 	 $prueba= $this->clientes->obtenerColo($idMuni);
  //       echo json_encode ($prueba);
	 // }

	 // function getPostal($coloniaCl)
	 // {
	 // 	 $prueba= $this->clientes->obtenerPostal($coloniaCl);
  //       echo json_encode ($prueba);
	 // }

	public function detallePaciente()
	{
		$idP=$_REQUEST['id'];   
         $this->load->view('griddetallepaciente',$idP);  
	}

	public function ModificarPaciente()
	{
		$idP=$_REQUEST['id'];   
		$data['medico'] = $this->pacientes->remitente();
		$data['cliente'] = $this->pacientes->cliente();
        $this->load->view('grideditarpaciente',$data,$idP);  
	}
	

	function obtenerDatos($idP)
    {
        $prueba= $this->pacientes->obtenerFicha($idP);
        echo json_encode ($prueba);
    }
    function traeclave(){
    	$prueba= $this->pacientes->obtenerClave();
        echo json_encode ($prueba);
    }

	function eliminarPaciente($id)
	{
        $this->pacientes->borrarDatos($id);
        redirect('http://localhost/CDI/Panel/index.php/Crudpacientes');
    }

	 function agregaPaciente()
    {   

        $data = array(  
                'nombrePaci' => $this->input->post('nombre'),
	            'clavePaci' => $this->input->post('clave'),
	            'generoPaci' => $this->input->post('genero'),
	            'correoPaci' => $this->input->post('correo'),
	            'edadPaci' => $this->input->post('edad'),
	            'fechanaciPaci' => $this->input->post('fechanaci'),
	            'telefonoPaci' => $this->input->post('telefono'),
	            'remitente' => $this->input->post('remitente'),
	            'cliente' => $this->input->post('cliente'),
	            //Cambios
	            'razonSocial' => $this->input->post('razonSocial'),
	            'domFiscal' => $this->input->post('domfiscal'),
	            'RFC' => $this->input->post('RFC'),
	            'telefono' => $this->input->post('telefonopaciente'),
	            'colonia' => $this->input->post('colonia'),
	            'municipio' => $this->input->post('municipio'),
	            'estado' => $this->input->post('estado')
                );
        $idPrimaria=$this->pacientes->insertaDatos($data);
        foreach ($idPrimaria as $key3 =>$val)
                //echo($val['LAST_INSERT_ID()']);
       echo "rFC=".$this->input->post('RFC');
    }

	 function modificarDatos(){
	 	$idPaci=$this->input->post('idPaciente');
				$nombre=$this->input->post('nombre');
				$genero=$this->input->post('genero');
				$correo=$this->input->post('correo');
				$edad=$this->input->post('edad-paciente');
				$fecha=$this->input->post('fecha');
				$telefono=$this->input->post('telefono');
				/*$razonSocial=$this->input->post('razonsocial');
				$domFiscal=$this->input->post('domfiscal');
				$RFC=$this->input->post('rfc');
				$telefono=$this->input->post('telefonopaciente');
				$colonia=$this->input->post('colonia');
				$municipio=$this->input->post('municipio');
				$estado=$this->input->post('estado');*/

				if (!empty($nombre)) {
					$data = array(
						'nombrePaci' => $this->input->post('nombre')
					);
					$this->pacientes->modificaDatos($data,$idPaci);
				}

				if (!empty($genero)) {
					$data = array(
						'generoPaci' => $this->input->post('genero')
					);
					$this->pacientes->modificaDatos($data,$idPaci);
				}

				if (!empty($correo)) {
					$data = array(
						'correoPaci' => $this->input->post('correo')
					);
					$this->pacientes->modificaDatos($data,$idPaci);
				}

				if (!empty($edad)) {
					$data = array(
						'edadPaci' => $this->input->post('edad')
					);
					$this->pacientes->modificaDatos($data,$idPaci);
				}


				if (!empty($fecha)) {
					$data = array(
						'fechanaciPaci' => $this->input->post('fecha')
					);
					$this->pacientes->modificaDatos($data,$idPaci);
				}

				if (!empty($telefono)) {
					$data = array(
						'telefonoPaci' => $this->input->post('telefono')
					);
					$this->pacientes->modificaDatos($data,$idPaci);
				}

       // { $idP = $this->input->post('idP');
       //         $data = array(
       //             'nombrePaci' => $this->input->post('nombre'),
       // 	            'clavePaci' => $this->input->post('clave'),
       // 	            'generoPaci' => $this->input->post('genero'),
       // 	            'correoPaci' => $this->input->post('correo'),
       // 	            'edadPaci' => $this->input->post('edad'),
       // 	            'fechanaciPaci' => $this->input->post('fechanaci'),
       // 	            'telefonoPaci' => $this->input->post('telefono'),
       // 	            'remitente' => $this->input->post('remitente'),
       // 	            'cliente' => $this->input->post('cliente')
       //             );
       //         $this->pacientes->modificaDatos($data,$idP);}
    }
    function editaCliente(){
		$idClie = $this->input->post('idCliente');
		$idPac = $this->input->post('id');
		//echo "idClie $idClie idPac $idPac";
		$data = array(
		      'cliente' => $idClie
		     );
		$this->pacientes->modificaDatos($data,$idPac);
		
	}



	 function traerClie(){
    	$prueba= $this->pacientes->cliente();
        echo json_encode ($prueba);
    }

    function editaRemite(){
		$idRemi = $this->input->post('idRemi');
		$idPac = $this->input->post('id');
		//echo "idClie $idClie idPac $idPac";
		$data = array(
		      'remitente' => $idRemi
		     );
		$this->pacientes->modificaDatos($data,$idPac);
		
	}

     function traerRemite(){
    	$prueba= $this->pacientes->remitente();
        echo json_encode ($prueba);
    }
}

?>