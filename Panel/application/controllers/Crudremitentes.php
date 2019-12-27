<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudRemitentes extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("remitente");
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=7;
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
		$data['page'] = $this->remitente->data_pagination("/Crudremitentes/index/", 
        $this->remitente->getTotalRowAllData(), 3);
     	$data['Remitente'] = $this->remitente->getDatos($index); 
     	$data['Remitentes'] = $this->remitente->obtenerDatos(); 
		$this->load->view('gridtodoremitentes',$data);  

		
	}

	public function formAltaRemitente()
	{
		$this->load->view('gridaltaremitente');  
	}


	public function formDetalleRemitente()
	{
		if(isset($_REQUEST['id']))
		{
			$idRem=$_REQUEST['id'];
			$this->session->set_userdata("idRemitente",$idRem); 
		}
		else
		{
			$idRem=$this->session->userdata('idRemitente');
		}	
		$this->load->view('griddetalleremitente',$idRem);
	}

public function formEditarRemitente()

	{
		if(isset($_REQUEST['id']))
		{
			$idRem=$_REQUEST['id'];
			$this->session->set_userdata("idRemitente",$idRem); 
		}
		else
		{
			$idRem=$this->session->userdata('idRemitente');
		}
		$this->load->view('grideditarremitente',$idRem); 
	}

	function obtenerDatos($idR)
	{
    	$prueba= $this->remitente->obtenerFicha($idR);
    	echo json_encode ($prueba);
	}
	function obtenerDatosbase($idubase)
	{
    	$prueba= $this->remitente->obtenerFichabase($idubase);
    	echo json_encode ($prueba);
	}


function altaRemitente()
	{	
			$data = array(	
			'nombreRem' => $this->input->post('nombre'),
			'claveRem' => $this->input->post('clave'),
			'calleRem' => $this->input->post('calle'),
			'coloniaRem' => $this->input->post('colonia'),
			'telefonoRemuno' => $this->input->post('teluno'),
			'telefonoRemdos' => $this->input->post('teldos'),
			'EmailRem' => $this->input->post('correo'),
			'especialidadRem' => $this->input->post('especialidad'),
			'fechanaciRem' => $this->input->post('fecha'),
			'ciudadRem' => $this->input->post('ciudad'),
			//'estadoRem' => $this->input->post('estado'),
			'controlRem' => $this->input->post('control')
			);
			$this->remitente->insertaDatos($data);
			echo "1";
    }


	function modificarDatos()
	{
			$idRem = $this->input->post('idRemitente');
			$nombre = $this->input->post('nombreRem');
			$nombreRem =  mb_strtoupper($nombre);

			$claveRem = $this->input->post('claveRem');
			$calleRem = $this->input->post('calleRem');
			$calleRem = mb_strtoupper($calleRem);


			$telefonoRemuno =$this->input->post('telefonoRemuno');
			$telefonoRemdos =$this->input->post('telefonoRemdos');
			$EmailRem =$this->input->post('EmailRem');
			$especialidadRem =$this->input->post('especialidadRem');
			$especialidadRem =mb_strtoupper($especialidadRem);

			$fechanaciRem =$this->input->post('fechanaciRem');
			$valorciudad =$this->input->post('ciudadRem');
			$ciudadRem =mb_strtoupper($valorciudad);

			$valorcolonia =$this->input->post('coloniaRem');
			$coloniaRem =mb_strtoupper($valorcolonia);

			$control=$this->input->post('controlRem');
			
			if (!empty($control)) {
				$data= array(
					'controlRem' => $control 
				);
				$this->remitente->modificaDatos($data,$idRem);
			}else{}

			if (!empty($nombre)) {
		     $data = array(
		      'nombreRem' => $nombreRem
		     );
		     $this->remitente->modificaDatos($data,$idRem);
		    }else{}

		    if (!empty($claveRem)) {
		     $data = array(
		      'claveRem' => $claveRem
		     );
		     $this->remitente->modificaDatos($data,$idRem);
		    }else{}

		    if (!empty($calleRem)) {
		     $data = array(
		      'calleRem' => $calleRem
		     );
		     $this->remitente->modificaDatos($data,$idRem);
		    }else{}
		    if (!empty($telefonoRemuno)) {
		     $data = array(
		      'telefonoRemuno' => $telefonoRemuno
		     );
		     $this->remitente->modificaDatos($data,$idRem);
		    }else{}

		    if (!empty($telefonoRemdos)) {
		     $data = array(
		      'telefonoRemdos' => $telefonoRemdos
		     );
		     $this->remitente->modificaDatos($data,$idRem);
		    }else{}

		    if (!empty($EmailRem)) {
		     $data = array(
		      'EmailRem' => $EmailRem
		     );
		     $this->remitente->modificaDatos($data,$idRem);
		    }else{}

		    if (!empty($especialidadRem)) {
		     $data = array(
		      'especialidadRem' => $especialidadRem
		     );
		     $this->remitente->modificaDatos($data,$idRem);
		    }else{}

		    if (!empty($fechanaciRem)) {
		     $data = array(
		      'fechanaciRem' => $fechanaciRem
		     );
		     $this->remitente->modificaDatos($data,$idRem);
		    }else{}

		    //
		     if (!empty($valorciudad)) {
		     $data = array(
		      'ciudadRem' => $ciudadRem
		     );
		     $this->remitente->modificaDatos($data,$idRem);
		    }else{}

		     if (!empty($valorcolonia)) {
		     $data = array(
		      'coloniaRem' => $coloniaRem
		     );
		     $this->remitente->modificaDatos($data,$idRem);
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
		$this->remitente->modificaestadocliente($data,$idRem);
		} else{
			$data = array(
		      'estadoRem' => $idestado,
		      'ciudadRem' => $idciudad,
		      'coloniaRem' => $idcolonia
		     );
		$this->remitente->modificaestado($data,$idRem);
		}
		
	}

	function deleteRem($id)
	{
		$prueba= $this->remitente->obtenerFichaDelete($id);
		$this->remitente->borrarDatos($id);
		redirect('http://localhost/CDI/Panel/index.php/Crudremitentes');
	}

	function eliminarRemitente($id)
    {
        $this->remitente->borrarDatos($id);
        redirect('http://localhost/CDI/Panel/index.php/Crudremitentes');
    }

	function getEstado()
	{
		$prueba=$this->remitente->traerEstado();
		echo json_encode($prueba);
	}

	function getMunicipio($idEstado)
	{
		$resultado=$this->remitente->traerMnunipio($idEstado);
		echo json_encode($resultado);
	}

	function getColonia($idMunic)
	{
		$resultado=$this->remitente->traerRegion($idMunic);
		echo json_encode($resultado);
	}

	function getListadoRemitentes()
    {
        $columnas=array(
            0 => 'idRemitente',
            1 => 'nombreRem',
            2 => 'claveRem',
            3 => 'calleRem',
            4 => 'telefonoRemuno',
            5 => 'telefonoRemdos',
            6 => 'EmailRem',
            7 => 'especialidadRem',
            8 => 'fechanaciRem',
            9 => 'ciudadRem',
            10 => 'coloniaRem',
            11 => 'controlRem',
            12 => 'Eliminar'
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columnas[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->remitente->cuentaTodosRemitentes();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value']))
        {
            $remitentes = $this->remitente->allRemitentes($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $remitentes =  $this->remitente->busquedaRemitente($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->remitente->cuentaRemitenteFiltrados($search);
        }
        $data = array();
        if(!empty($remitentes))
        {
            foreach ($remitentes as $remitente)
            {


                $nestedData['idRemitente']=$remitente['idRemitente'];

                $nestedData['nombreRem']=$remitente['nombreRem'];
                $nestedData['claveRem']=$remitente['claveRem'];
                $nestedData['calleRem']=$remitente['calleRem'];
                $nestedData['telefonoRemuno']=$remitente['telefonoRemuno'];
                $nestedData['telefonoRemdos']=$remitente['telefonoRemdos'];
                $nestedData['EmailRem']=$remitente['EmailRem'];
                $nestedData['especialidadRem']=$remitente['especialidadRem'];
                $nestedData['fechanaciRem']=$remitente['fechanaciRem'];
                $nestedData['ciudadRem']=$remitente['ciudadRem'];
                $nestedData['coloniaRem']=$remitente['coloniaRem'];
                $nestedData['controlRem']=$remitente['controlRem'];
                $nestedData['Eliminar']="<a href='#' onclick='deleteRemitente(".$remitente['idRemitente'].");'>Eliminar</a>";

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);

    }

    function traerRemite(){
        $prueba= $this->remitentes->remitente();
        echo json_encode ($prueba);
    }
		

}

?>