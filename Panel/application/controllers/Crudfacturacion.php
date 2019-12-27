<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crudfacturacion extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("Facturacion"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->Facturacion->data_pagination("/Crudsalas/index/", 
        $this->Facturacion->getTotalRowAllData(), 3);
     	$data['estudio'] = $this->Facturacion->getDatos($index); 
     	$data['salas'] = $this->Facturacion->getSalas();
     	$data['Clientes'] = $this->Facturacion->getClientes();
     	$data['empresas'] = $this->Facturacion->getEmpresas();
		$this->load->view('gridfacturacion',$data);  

		
	}
	

    function traerCate()
    {
        $prueba= $this->Facturacion->getCategorias();
        echo json_encode ($prueba);
    }


	 function agregaraltaestudio()
    {   
    	
        $data = array(  
                'nombreEstudio' => $this->input->post('nombreEstudio'),
	            'indicacionesPaciente' => $this->input->post('indicaciones'),
	            'claveSat' => $this->input->post('claveSat'),
	            'duracion' => $this->input->post('duracion'),
	            'precioPublico' => $this->input->post('precioP'),
	            'idCat' => $this->input->post('idCat')
                );
        $this->Facturacion->insertaDatos($data);
       // echo "1";
    }
	
	}

?>