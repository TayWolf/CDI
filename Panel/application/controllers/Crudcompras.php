<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudCompras extends CI_Controller {
	function __construct(){
		parent::__construct();
    if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("compras"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=14;
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
		$data['page'] = $this->compras->data_pagination("/Crudcitas/index/", 
        $this->compras->getTotalRowAllData(), 3);
     	$data['salas'] = $this->compras->getDatos();
     	//$data['Estudios'] = $this->compras->getEstudios();
     
		$this->load->view('gridcompras',$data);  

		
	}

  public function Folio()
  {
    $this->load->view('gridfoliocompra');  
  }
	
 function traerlistaCompraFilt($feIni,$feFin)
  {
      $prueba= $this->compras->traerListaOFiltro($feIni,$feFin);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
	
  function getDetalle($idComp)
  {
      $prueba= $this->compras->getDetallado($idComp);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function getDetalleArray($idComp)
  {
      $prueba= $this->compras->getDetalladoArray($idComp);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function getfiltroCheck($pagadasC,$creditoC,$pagosC,$feIniC,$feFinC)
  {
      $prueba= $this->compras->filtroCh($pagadasC,$creditoC,$pagosC,$feIniC,$feFinC);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function getDetalleFolio($OrdeComp)
  {
      $prueba= $this->compras->getDetalladofolio($OrdeComp);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

   function traerLisAr($idCom)
  {
      $prueba= $this->compras->getDetalleart($idCom);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
   
    function buscarNombreProved()
    {   

        $Proved=$_REQUEST["q"];
        if(isset($Proved)){
            $result=$this->compras->obtenerDatosProvedor($Proved);
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
        $idProveedor=$_REQUEST["idProve"];
        //echo "entra articulo $articuloN idprovedor $idProveedor";
        if(isset($idProveedor)){
            $result=$this->compras->obtenerDatosArtoProvedor($idProveedor,$articuloN);
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


    function agregaCompra()
    {
        $OrdeComp = $this->input->post('OrdeComp');
        if ($OrdeComp=="") {
          $OrdeComp=".";
        }
        $data = array(  
            'fechaCompra' => $this->input->post('fechaSoliCom'),//
            'ncompra' => $this->input->post('noCompra'),//
            'fechaPedido' => $this->input->post('HoyFec'),//
            'idAlmacenista' => $this->input->post('idUser'),//
            'factura' => $this->input->post('FactC'),//
            'nota' => $this->input->post('NotaC'),//
            'orden' => $OrdeComp,//
            'idProveedor' => $this->input->post('idProve'),//
            'tipo_pago' => $this->input->post('tiPago'),//
            'forma_de_pago' => $this->input->post('formPago'),//
            'cantidadPagos' => $this->input->post('cantidadPagos'),//
            'dias' => $this->input->post('diasPago'),//
            'fechaLimitePago' => $this->input->post('fechaLimiteDos'),//
            //'descuento' => $this->input->post('horaFinal'),
            'subtotal' => $this->input->post('subtotal'),//
            'totalDes' => $this->input->post('descuentoTotal'),//
            'subtotalito' => $this->input->post('subtotalitoDos'),//
            'iva' => $this->input->post('ivacantidad'),//
            'total' => $this->input->post('total')//
            );
        $this->compras->insertaDatos($data);

          $fechaSoliCom = $this->input->post('fechaSoliCom');
          $noCompra = $this->input->post('noCompra');
          $cantidadPagos = $this->input->post('cantidadPagos');
          $diasPago = $this->input->post('diasPago');

          $prueba=$this->compras->idCompr($fechaSoliCom,$noCompra);  

          foreach ($prueba as $key) {
            $idCompra= $key['idCompra'];
          }

          $arregloDatos = $this->input->post('arreglo');
          $arregloDatos2= json_encode($arregloDatos);
          foreach ($arregloDatos as $key => $value) {
            foreach ($value as $key => $value) {
                 $data2 = array(  
                  'idArticulo' => $value['idArticulo'],//
                  'nombreArticulo' => $value['nomArt'],//
                  'unidad' => $value['unidadA'],//
                  'idCompra' => $idCompra,//
                  'descuento' => $value['descuentoAr'],//
                  'cantidadArt' => $value['cantidadA'],//
                  'costoArticulo' => $value['costoAr'],//
                  'iva' => $value['ivvv'],//
                  'totalArticulo' => $value['costoArDes'],//
                  'fechaCaducidad' => $value['caducidadA'],//
                  'existenciaAnterior' => $value['cantidadA']//
                  );
              $this->compras->insertaDatosPuente($data2);
              $idA=$value['idArticulo'];

              $sacarEx=$this->compras->cantidadSuma($idA);  
                  foreach ($sacarEx as $key) {
                    $existen= $key['existencia'];
                  }
              

              $exis=$existen+$value['cantidadA'];
                  $dataupd = array(  
                    'costo_unitario' => $value['costoAr'],
                    'existencia' => $exis
                    
                    );
                $this->compras->updateArt($dataupd,$idA);
              
            }
          }
                $diaC=substr($fechaSoliCom, 8, 2);
                $mesC=substr($fechaSoliCom, 5, 2);
                $anoC=substr($fechaSoliCom, 0, 4); 
                $fechaCP=$anoC.'-'.$mesC.'-'.$diaC;
                for ($z=0; $z <$cantidadPagos ; $z++) { 
                   $dias=intval($diasPago);
                    $fechapago = date('Y-m-d',strtotime('+'.intval($diasPago).'days', strtotime($fechaCP)));
                    $fechaCP=$fechapago;
                    $dataP = array(  
                      'idCompra' => $idCompra,
                      'fechasPago' => $fechapago,
                      'estado' => 0
                      );
                  $this->compras->insertaDatosPago($dataP);
                }
              echo "existen $existen cantidad sacada ".$value['cantidadA']." da igual a ".$exis;  
       
    
    }

    function traerIdCompra()
  {
      $prueba= $this->compras->obteneridcompra();
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function CompararClave($clave)
  {
      $prueba= $this->compras->comparaClave($clave);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function verificarI($idArt)
  {
      $prueba= $this->compras->obtenerImport($idArt);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
    
function validOrd($nuOrden)
  {
      $prueba= $this->compras->obtenerOrden($nuOrden);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }


	}


?>