<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudEntradas extends CI_Controller {
	function __construct(){
		parent::__construct();
    if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("entradas"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=15;
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
		
     	//$data['Estudios'] = $this->entradas->getEstudios();
     
		$this->load->view('gridentradas');  

		
	}
	
  function traerIdEntrada()
  {
      $prueba= $this->entradas->obteneridcompra();
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
	
   
    function buscarNombreProved()
    {   

        $Proved=$_REQUEST["q"];
        if(isset($Proved)){
            $result=$this->entradas->obtenerDatosProvedor($Proved);
            if(count($result)>0)
                foreach($result as $pr)

                    $arrResult[]=array("value"=>$pr->nombreP,
                        "idProveedor"=>$pr->idProveedor,
                       "direccion"=>$pr->direccion,
                       "poblacion"=>$pr->poblacion,
                       "colonia"=>$pr->colonia,
                       "codigo_postal"=>$pr->codigo_postal,
                       "reg_fed_cau"=>$pr->reg_fed_cau,
                       "nombreContacto"=>$pr->nombreContacto,
                       "telefonoUno"=>$pr->telefonoUno
                        );
                echo json_encode($arrResult);
       }
    }

    function traerArt()

    {   
        $articuloN=$_REQUEST["q"];  
        $idProveedor=0;
          if(isset($idProveedor)){     
            $result=$this->entradas->obtenerDatosArto($articuloN,$idProveedor);
            if(count($result)>0)
                foreach($result as $pr)

                    $arrResult[]=array("value"=>$pr->nombre,
                        "idArticulo"=>$pr->idArticulo,
                       "medida"=>$pr->medida,
                       "costo_unitario"=>$pr->costo_unitario,
                       "existencia"=>$pr->existencia,
                       "maximo"=>$pr->maximo,
                       "minimo"=>$pr->minimo
                        );
                echo json_encode($arrResult);
          }
    }

    function agregaEntrada()
    {
        
        $data = array(  
            'fechaEntrada' => $this->input->post('fechaSoliMos'),//
            'nEntrada' => $this->input->post('noEnt'),//
            'idAlmacenista' => $this->input->post('idUser'),//
            'motivo' => $this->input->post('motivo'),//
            //'descuento' => $this->input->post('horaFinal'),
            'subtotal' => $this->input->post('subtotal'),//
            'iva' => $this->input->post('ivacantidad'),//
            'total' => $this->input->post('total')//
            );
        $this->entradas->insertaDatos($data);

          $fechaSoliCom = $this->input->post('fechaSoliMos');
          $nEntrada = $this->input->post('noEnt');

          $prueba=$this->entradas->idEntra($fechaSoliCom,$nEntrada);  
          foreach ($prueba as $key) {
            $idEntrada= $key['idEntrada'];
          }

          $arregloDatos = $this->input->post('arreglo');
          $arregloDatos2= json_encode($arregloDatos);
          foreach ($arregloDatos as $key => $value) {
            foreach ($value as $key => $value) {
              $exis=$value['existencia']+$value['cantidadA'];
                 $data2 = array(  
                  'idArticulo' => $value['idArticulo'],
                  'nombreArticulo' => $value['nomArt'],
                  'unidad' => $value['unidadA'],
                  'idEntrada' => $idEntrada,
                  'cantidadArt' => $value['cantidadA'],
                  'costoArticulo' => $value['costoAr'],
                  'fechaCaducidad' => $value['caducidadA'],
                  'cantidadActual' => $exis
                  );
              $this->entradas->insertaDatosPuente($data2);
              $idA=$value['idArticulo'];
                $costoReal = 0 ;
                $costoPromedio = $value['costoPromedio'];
                $costoArt=$value['costoAr'];
              
              //echo "exis $exis";
                if ($costoArt==$costoPromedio) {
                     $costoReal=$costoArt;
                   }else{
                      $costoReal=$costoPromedio;
                   }
                  $dataupd = array(  
                    'costo_unitario' => $value['costoAr'],
                    'existencia' => $exis
                    
                    );
                $this->entradas->updateArt($dataupd,$idA);
              
            }
          }

    }


	}


?>