<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crudestudios extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("Estudio"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=6;
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
     	$data['estudio'] = $this->Estudio->getDatos($index); 
     	$data['salas'] = $this->Estudio->getSalas();
     	$data['Clientes'] = $this->Estudio->getClientes();
     	$data['Categoria'] = $this->Estudio->getCategorias();
     	$data['empresa'] = $this->Estudio->getEmpresariales();
		$this->load->view('gridtodoestudio',$data);
		
	}
	public function detalleSala()
	{
		$idS=$_REQUEST['id'];   
         $this->load->view('griddetallesala',$idS);  
	}

	public function ModificarSala()
	{
		$idS=$_REQUEST['id'];   
         $this->load->view('grideditarsala',$idS);  
	}
	public function altaSala()
	{
		
         $this->load->view('gridaltasala');  
	}

	function obtenerDatos($idS)
    {
        $prueba= $this->salas->obtenerFicha($idS);
        echo json_encode ($prueba);
    }

    function traerCate()
    {
        $prueba= $this->Estudio->getCategorias();
        echo json_encode ($prueba);
    }
    function traerEmpr()
    {
        $prueba= $this->Estudio->getEmpresas();
        echo json_encode ($prueba);
    }

    function editacategoria(){
		$idcategoria = $this->input->post('idcategoria');
		$idEstudio = $this->input->post('id');
		//echo "dataa $ruta";
		$data = array(
		      'idCat' => $idcategoria
		     );
		$this->Estudio->modificaCategoria($data,$idEstudio);
		
	}

	function editaempresa(){
		$idempresa = $this->input->post('idEmpresa');
		$idEstudio = $this->input->post('id');
		//echo "dataa $ruta";
		$data = array(
		      'idEmpresa' => $idempresa
		     );
		$this->Estudio->modificaEmpre($data,$idEstudio);
		
	}

	function logout(){
	  $this->session->sess_destroy();
	  redirect('http://localhost/CDI/Panel/');
	 }

	  function deleteestudio($idEstudio){
        $this->Estudio->borrarDatos($idEstudio);
        redirect('http://localhost/CDI/Panel/index.php/Crudestudios');
    }

	 function agregaraltaestudio()
    {   
    	
        $data = array(  
                'nombreEstudio' => $this->input->post('nombreEstudio'),
	            'indicacionesPaciente' => $this->input->post('indicaciones'),
	            'claveSat' => $this->input->post('claveSat'),
	            'duracion' => $this->input->post('duracion'),
	            'precioPublico' => $this->input->post('precioP'),
	            'idCat' => $this->input->post('idCat'),
	            'idEmpresa' => $this->input->post('idEmpre'),
	            'diasResultado' => $this->input->post('diasEntrega'),
	            'numeroPlacas' => $this->input->post('numeroPlacas')
                );
        $this->Estudio->insertaDatos($data);
       // echo "1";
    }


	 function modificarDatos(){
        $IdEstudio = $this->input->post('IdEstudio');
        $nombreEstudio =$this->input->post('nombreEstudio');
         $nombreEstudio =mb_strtoupper($nombreEstudio);

        $indicacionesPaciente = $this->input->post('indicacionesPaciente');
        $indicacionesPaciente =  mb_strtoupper($indicacionesPaciente);

        $claveSat= $this->input->post('claveSat');
        $duracion= $this->input->post('duracion');
        $precioPublico= $this->input->post('precioPublico');
         $resultad= $this->input->post('resultad');
        $idCat= $this->input->post('idCat');
        $numeroPlacas= $this->input->post('numeroPlacas');

       			if (!empty($nombreEstudio)) {
					$data = array(
						'nombreEstudio' => $nombreEstudio
					);
					$this->Estudio->modificaDatos($data,$IdEstudio);
				}

       			if (!empty($numeroPlacas)) {
					$data = array(
						'numeroPlacas' => $numeroPlacas
					);
					$this->Estudio->modificaDatos($data,$IdEstudio);
				}
				if (!empty($indicacionesPaciente)) {
					$data = array(
						'indicacionesPaciente' => $indicacionesPaciente
					);
					$this->Estudio->modificaDatos($data,$IdEstudio);
				}

				if (!empty($claveSat)) {
					$data = array(
						'claveSat' => $this->input->post('claveSat')
					);
					$this->Estudio->modificaDatos($data,$IdEstudio);
				}

				if (!empty($duracion)) {
					$data = array(
						'duracion' => $this->input->post('duracion')
					);
					$this->Estudio->modificaDatos($data,$IdEstudio);
				}

				if (!empty($precioPublico)) {
					$data = array(
						'precioPublico' => $this->input->post('precioPublico')
					);
					$this->Estudio->modificaDatos($data,$IdEstudio);
				}

				if (!empty($idCat)) {
					$data = array(
						'idCat' => $this->input->post('idCat')
					);
					$this->Estudio->modificaDatos($data,$IdEstudio);
				}
				if (!empty($resultad)) {
					$data = array(
						'diasResultado' => $this->input->post('resultad')
					);
					$this->Estudio->modificaDatos($data,$IdEstudio);
				}
				echo "IdEstudio $IdEstudio";
    }

    function modificarPrecios(){
        $idpreciocliente = $this->input->post('idpreciocliente');
        $precio =$this->input->post('precio');
        echo "IdEstudio $IdEstudio Precio $precio";
       			if (!empty($precio)) {
					$data = array(
						'precio' => $precio
					);
					$this->Estudio->modificaPrecios($data,$idpreciocliente);
				}else{}
    }


	function buscadisponibles($i,$actual)
    {
        $prueba= $this->Estudio->obtenerdisponibles($i,$actual);
        echo json_encode ($prueba);
    }
	function buscaasignadas($i,$actual)
    {
        $prueba= $this->Estudio->obtenerasignadas($i,$actual);
        echo json_encode ($prueba);
    }


    function agregarPuente($idS,$total,$idactual)
    	{
    		
		    	 // for ($i=1; $i <= $total ; $i++) { 
		            $idub = $idS;
		    	 	 //$idub=$idub.$i;
		           // echo "id: $idub";
		            // if ($idub != "") {
		            //	echo "id: $idub";
		            	  $data = array(
				            'idEstudio' => $idactual,    
				            'idSala' => $idub    
				            );
				            $this->Estudio->insertaDatosPuente($data);
				           echo "entra".$idub;
		            // }
		        // }
    		
    	}


    function quitarpuente($idS,$total,$idactual){
        $this->Estudio->quitarDatosPuente($idS,$total,$idactual);
        // redirect('http://localhost/CDI/Panel/index.php/Crudestudios');
    }

	function traeclientes()
    {
        $prueba= $this->Estudio->obtenerClientes();
        echo json_encode ($prueba);
    }

    function traeprecios($iCli,$idEst)
    {
        $prueba= $this->Estudio->obtenerPreciosClientes($iCli,$idEst);
        echo json_encode ($prueba);
    }

   	function guardaprecio()
    {   
    	$idEst = $this->input->post('idE');
    	$idCli = $this->input->post('idC');
    	$precio = $this->input->post('precio');
        $data = array(  
                'IdEstudio' => $idEst,
	            'Idcliente' => $idCli,
	            'precio' => $precio
                );
        $this->Estudio->insertaPrecio($data);
    }

    function getListadoEstudios()
    {
    	 
        $columnas=array(
            0 => 'IdEstudio',
            1 => 'nombreEstudio',
            2 => 'indicacionesPaciente',
            3 => 'claveSat',
            4 => 'duracion',
            5 => 'precioPublico',
            6 => 'categoria',
            7 => 'empresa',
            8 => 'numeroPlacas',
            9 => 'asigSala',
            10 => 'asigaPreci',
            11 => 'resultad',
            12 => 'Eliminar'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columnas[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->Estudio->cuentaTodosEstudio();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value']))
        {
            $pacientes = $this->Estudio->allEstudio($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $pacientes =  $this->Estudio->busquedaEstudio($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->Estudio->cuentaEstudioFiltrados($search);
        }
        $data = array();
        if(!empty($pacientes))
        {
            foreach ($pacientes as $paciente)
            {

                $nestedData['IdEstudio']=$paciente['IdEstudio'];
                $nestedData['nombreEstudio']=$paciente['nombreEstudio'];
                $nestedData['indicacionesPaciente']=$paciente['indicacionesPaciente'];
                $nestedData['claveSat']=$paciente['claveSat'];
                
                $nestedData['duracion']=$paciente['duracion'];
                $nestedData['precioPublico']=$paciente['precioPublico'];
                $nestedData['categoria']="<div id='nombreCategoria".$paciente['IdEstudio']."' ondblclick=traerCategoria(".$paciente['IdEstudio'].");>".$paciente['nombreCat']."</div>
                                                       <td id='muestraselectcategoria".$paciente['IdEstudio']."' style='display: none;'>
                                                       <select style='display: none;' id='selectcategoria".$paciente['IdEstudio']."' name='selectcategoria".$paciente['IdEstudio']."' onchange='modificarDatosCate(".$paciente['IdEstudio'].");'> </select>
                                                       </td>";

                $nestedData['empresa']="<div id='nombreEmpresa".$paciente['IdEstudio']."' ondblclick=traerEmpresa(".$paciente['IdEstudio'].");>".$paciente['nombreEmpresa']."</div>
                                                       <td id='muestraselectempresas".$paciente['IdEstudio']."' style='display: none;'>
                                                       <select style='display: none;' id='selectempresa".$paciente['IdEstudio']."' name='selectempresa".$paciente['IdEstudio']."' onchange='modificarDatosEmpre(".$paciente['IdEstudio'].");'> </select>
                                                       </td>";
                $nestedData['numeroPlacas']="<div align='center'>".$paciente['numeroPlacas']."</div>";
                // $nestedData['Domicilio_Fiscal']=$paciente['domFiscal'];
                // $nestedData['RFC']=$paciente['RFC'];
                // $nestedData['Telefono']=$paciente['telefono'];
                // $nestedData['Colonia']=$paciente['colonia'];
                // $nestedData['Municipio']=$paciente['municipio'];
                
                $nestedData['asigSala']="<a href='#' onclick='traerId(".$paciente['IdEstudio'].");identificaSalasAsignadas();' data-toggle='modal' data-target='#myModal2'>Asignar Salas</a> ";
                $nestedData['asigaPreci']="<a href='#' onclick='traerId(".$paciente['IdEstudio']."); traeNombre(".$paciente['IdEstudio'].");traeclientes();' data-toggle='modal' data-target='#myModal3'>Asignar/Modificar Precios</a>";
                $nestedData['resultad']=$paciente['diasResultado'];
                $nestedData['Eliminar']="<a href='#' onclick='confirmaDeleteEstudio(".$paciente['IdEstudio'].");'>Eliminar</a>";

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
    function traeNombreEstudio($idEstudio)
    {
        echo $this->Estudio->getNombreEstudio($idEstudio);
    }
	
	}

?>