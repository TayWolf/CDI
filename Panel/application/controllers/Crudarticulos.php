<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudArticulos extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("articulos");
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=12;
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
		$data['page'] = $this->articulos->data_pagination("/Crudarticulos/index/",
        $this->articulos->getTotalRowAllData(), 3);
     	$data['Articulo'] = $this->articulos->getDatos($index); 
     	$data['Articulos'] = $this->articulos->obtenerDatos(); 
     	$data['linea'] = $this->articulos->getLineas(); 
     	$data['prove'] = $this->articulos->getProve(); 
		$this->load->view('gridtodoarticulos',$data);  

		
	}

	public function formAltaArticulo()
	{
		$this->load->view('gridaltaarticulo');  
	}

	public function pdfPedidos()
	{
		$this->load->view('gridpdfpedidos');  
	}

	public function formDetalleArticulo()
	{
		if(isset($_REQUEST['id']))
		{
			$idRem=$_REQUEST['id'];
			$this->session->set_userdata("idArticulo",$idRem); 
		}
		else
		{
			$idRem=$this->session->userdata('idArticulo');
		}	
		$this->load->view('griddetallearticulo',$idRem);
	}

public function formEditarArticulo()

	{
		if(isset($_REQUEST['id']))
		{
			$idRem=$_REQUEST['id'];
			$this->session->set_userdata("idArticulo",$idRem); 
		}
		else
		{
			$idRem=$this->session->userdata('idArticulo');
		}
		$this->load->view('grideditararticulo',$idRem); 
	}

	function obtenerDatos($idR)
	{
    	$prueba= $this->articulos->obtenerFicha($idR);
    	echo json_encode ($prueba);
	}
	function obtenerDatosbase($idubase)
	{
    	$prueba= $this->articulos->obtenerFichabase($idubase);
    	echo json_encode ($prueba);
	}

	function getListacaduca($idArt)
	{
    	$prueba= $this->articulos->obtenerListaCaduca($idArt);
    	echo json_encode ($prueba);
	}

	function getListacaducaEntr($idArt)
	{
    	$prueba= $this->articulos->obtenerListaCaducaEntrada($idArt);
    	echo json_encode ($prueba);
	}


function altaArticulo()
	{	
			$data = array(	
			'nombre' => $this->input->post('nombre'),
			'presentacion' => $this->input->post('presentacion'),
			'medida' => $this->input->post('medida'),
			'ubicacion' => $this->input->post('ubicacion'),
			'costo_unitario' => $this->input->post('costouni'),
			'existencia' => $this->input->post('existencia'),
			'maximo' => $this->input->post('maximo'),
			'minimo' => $this->input->post('minimo')
			);
			$this->articulos->insertaDatos($data);
			echo "1";
    }


	function modificarDatos()
	{
			$idArticulo = $this->input->post('idArticulo');
			$nombre = $this->input->post('nombre');	
			$nombre = mb_strtoupper($nombre);						

			$presentacion = $this->input->post('presentacion');
			$presentacion=mb_strtoupper($presentacion);

			$medida = $this->input->post('medida');
			$medida=mb_strtoupper($medida);

			$ubicacion =$this->input->post('ubicacion');
			$ubicacion=mb_strtoupper($ubicacion);

			$costoUni =$this->input->post('costoUni');
			$existec =$this->input->post('existec');
			$maximo =$this->input->post('maximo');
			$minimo =$this->input->post('minimo');
			if (!empty($nombre)) {
				$data= array(
					'nombre' => $nombre 
				);
				$this->articulos->modificaDatos($data,$idArticulo);
			}
			if (!empty($presentacion)) {
		     $data = array(
		      'presentacion' => $presentacion
		     );
		     $this->articulos->modificaDatos($data,$idArticulo);
		    }else{}
		    if (!empty($medida)) {
		     $data = array(
		      'medida' => $medida
		     );
		     $this->articulos->modificaDatos($data,$idArticulo);
		    }else{}
		    if (!empty($ubicacion)) {
		     $data = array(
		      'ubicacion' => $ubicacion
		     );
		     $this->articulos->modificaDatos($data,$idArticulo);
		    }else{}
		    if (!empty($costoUni)) {
		     $data = array(
		      'costo_unitario' => $costoUni
		     );
		     $this->articulos->modificaDatos($data,$idArticulo);
		    }else{}

		    if (!empty($existec)) {
		     $data = array(
		      'existencia' => $existec
		     );
		     $this->articulos->modificaDatos($data,$idArticulo);
		    }else{}

		    if (!empty($maximo)) {
		     $data = array(
		      'maximo' => $maximo
		     );
		     $this->articulos->modificaDatos($data,$idArticulo);
		    }else{}

		    if (!empty($minimo)) {
		     $data = array(
		      'minimo' => $minimo
		     );
		     $this->articulos->modificaDatos($data,$idArticulo);
		    }else{}

	}	

	function editaestado(){
		$idestado = $this->input->post('idestado');
		$idciudad = $this->input->post('idciudad');
		$idcolonia = $this->input->post('idcolonia');
		$idRem = $this->input->post('id');
		$ruta = $this->input->post('ruta');
		echo "dataa $ruta";
		if ($ruta == "1") {
			$data = array(
		      'Estado' => $idestado,
		      'municipio' => $idciudad,
		      'Colonia' => $idcolonia
		     );
		$this->articulos->modificaestadocliente($data,$idRem);
		} else{
			$data = array(
		      'estadoRem' => $idestado,
		      'ciudadRem' => $idciudad,
		      'coloniaRem' => $idcolonia
		     );
		$this->articulos->modificaestado($data,$idRem);
		}
		
	}

	function eliminarArticulo($id)
	{
		
		$this->articulos->borrarDatos($id);
		redirect('http://localhost/CDI/Panel/index.php/Crudarticulos');
	}

	function getEstado()
	{
		$prueba=$this->articulos->traerEstado();
		echo json_encode($prueba);
	}

	function getMunicipio($idEstado)
	{
		$resultado=$this->articulos->traerMnunipio($idEstado);
		echo json_encode($resultado);
	}

	function buscaProvesignados($i,$actual)
    {
        $prueba= $this->articulos->obtenerProvsasignados($i,$actual);
        echo json_encode ($prueba);
    }

    function obtenerDatosPassword()
    {
    	$password = $this->input->post('inputValue');
    	$prueba= $this->articulos->getPassword($password);
        echo json_encode ($prueba);
    }

	function buscaLinasignados($i,$actual)
    {
        $prueba= $this->articulos->obtenerlinsasignados($i,$actual);
        echo json_encode ($prueba);
    }

	function getColonia($idMunic)
	{
		$resultado=$this->articulos->traerRegion($idMunic);
		echo json_encode($resultado);
	}

	function buscaLinedisponibles($i,$actual)
    {
        $prueba= $this->articulos->obtenerlinedisponibles($i,$actual);
        echo json_encode ($prueba);
    }

    function buscaProvedisponibles($i,$actual)
    {
        $prueba= $this->articulos->obtenerprovedisponibles($i,$actual);
        echo json_encode ($prueba);
    }

    function agregarPuenteLine($idD,$total,$idactual)
    {
        $idub = $idD;
        	$data = array(
		        'idLinea' => $idub,    
		        'idArticulo' => $idactual  
	        );
		    $this->articulos->insertaDatosPuenteLin($data);
		    echo "entra".$idub;
    }
    function quitarPuenteLinea($idD,$total,$idactual){
        $this->articulos->quitarDatosPuenteLin($idD,$total,$idactual);
    }

     function agregarPuenteProved($idD,$total,$idactual)
    {
        $idub = $idD;
        	$data = array(
		        'idProveedor' => $idub,    
		        'idarticulo' => $idactual  
	        );
		    $this->articulos->insertaDatosPuenteProv($data);
		    echo "entra".$idub;
    }

     function quitarPuenteProved($idD,$total,$idactual){
        $this->articulos->quitarDatosPuenteProv($idD,$total,$idactual);
    }
		

}

?>