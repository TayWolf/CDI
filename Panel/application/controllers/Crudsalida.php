<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crudsalida extends CI_Controller {
	function __construct(){
		parent::__construct();
    if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("salida"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=16;
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
		
     	//$data['Estudios'] = $this->salida->getEstudios();
     
		$this->load->view('gridsalida');  

		
	}
	function traerIdSalida()
  {
      $prueba= $this->salida->obteneridSali();
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function pbtenerUnifFecah()
  {
      $idArt=$_REQUEST["idArt"];
      $prueba= $this->salida->getUnicosFechacadu($idArt);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function obtenerFcA()
  {
      $idArt=$_REQUEST["idArt"];
      $prueba= $this->salida->getFeC($idArt);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function traerValidacionMinimo()
  {
      $idArticulo=$_REQUEST["idArticulo"];
      $fCaducidad=$_REQUEST["fCaducidad"];
      $fCaducidadEntrada=$_REQUEST["fCaducidadEntrada"];
      $cantidadAr=$_REQUEST["cantidadAr"];

      $prueba= $this->salida->getValidacionMinimo($idArticulo,$fCaducidad,$fCaducidadEntrada,$cantidadAr);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function obtenerFcAEntrada()
  {
      $idArt=$_REQUEST["idArt"];
      $prueba= $this->salida->getFeCEntrada($idArt);
     // $prueba= $this->salida->getUnicosFechacadu($idArt);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
	
   
    function buscarNombreProved()
    {   

        $Proved=$_REQUEST["q"];
        if(isset($Proved)){
            $result=$this->salida->obtenerDatosProvedor($Proved);
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
            $result=$this->salida->obtenerDatosArto($articuloN);
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

    function agregaSalida()
    {
        
        $data = array(  
            'fechaSalida' => $this->input->post('fechaSoliMos'),//
            'nSalida' => $this->input->post('noSal'),//
            'idAlmacenista' => $this->input->post('idUser'),//
            'motivo' => $this->input->post('motivo'),//
            //'descuento' => $this->input->post('horaFinal'),
            'subtotal' => $this->input->post('subtotal'),//
            'iva' => $this->input->post('ivacantidad'),//
            'total' => $this->input->post('total')//
            );
        $this->salida->insertaDatos($data);

          $fechaSoliCom = $this->input->post('fechaSoliMos');
          $nSalida = $this->input->post('noSal');

          $prueba=$this->salida->idSali($fechaSoliCom,$nSalida);  
          foreach ($prueba as $key) {
            $idSalida= $key['idSalida'];
          }
//echo "loco $fechaSoliCom nSalida $nSalida ";
          $arregloDatos = $this->input->post('arreglo');
          $arregloDatos2= json_encode($arregloDatos);
          foreach ($arregloDatos as $key => $value) {
            foreach ($value as $key => $value) {

                 
              
                 $data2 = array(  
                  'idArticulo' => $value['idArticulo'],
                  'nombreArticulo' => $value['nomArt'],
                  'unidad' => $value['unidadA'],
                  'idSalida' => $idSalida,
                  'cantidadArt' => $value['cantidadA'],
                  'costoArticulo' => $value['costoAr'],
                  'fechaCaducidad' => $fechaSoliCom,
                  'tipoCaducidad' => $value['tipoCaducidad']
                  );
              $this->salida->insertaDatosPuente($data2);
              $idA=$value['idArticulo'];
                 $exis=$value['existencia']-$value['cantidadA'];
                  $dataupd = array(  
                    'costo_unitario' => $value['costoAr'],
                    'existencia' => $exis
                    
                    );
                $this->salida->updateArt($dataupd,$idA);

                $fechId=$value['fechId'];
                 $Ident=$value['Ident'];

                 $pruebaCE=$this->salida->idEC($fechId,$Ident);  
                foreach ($pruebaCE as $key) {
                  $ee= $key['existenciaAnterior'];
                }
                //echo "trae $ee";
                 $exiss=$ee-$value['cantidadA'];
                 if ($Ident==1) {
                    $dataPuenteUpdate = array(  
                    'existenciaAnterior' => $exiss
                    );
                $this->salida->updatePuenteC($dataPuenteUpdate,$Ident,$fechId);
                 } if ($Ident==2) {
                    $dataPuenteUpdate = array(  
                    'cantidadActual' => $exiss
                    );
                $this->salida->updatePuenteC($dataPuenteUpdate,$Ident,$fechId);
                 }
                
              
            }
          }

    }


	}


?>