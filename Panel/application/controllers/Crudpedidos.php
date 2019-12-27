<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPedidos extends CI_Controller {
  function __construct(){
    parent::__construct();
    if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
    $this->load->model("pedidos"); //cargamos el modelo de User
      //código de permisos
      $this->load->model("Permisos");
      $idTipoUsuario=$this->session->userdata('tipoUser');
      $idModulo=21;
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
    $data['page'] = $this->pedidos->data_pagination("/Crudcitas/index/", 
        $this->pedidos->getTotalRowAllData(), 3);
      $data['salas'] = $this->pedidos->getDatos();
      $data['areaSol'] = $this->pedidos->getArea();
     
    $this->load->view('gridpedidos',$data);  

    
  }

  public function listaPedido()
  {   
    $tipoUser = $this->session->userdata('tipoUser');
    $idUser = $this->session->userdata('idUser');

    if( $tipoUser == 1 ){
        $listaPedido = $this->pedidos->getListadoPedidos(array());
    }else{
        $listaPedido =  $this->pedidos->getListadoPedidos(array("idUser" => $idUser));
    }

    $data['listaPedido'] = $listaPedido;
    $this->load->view('gridlistaPedidos',$data);  
  }

  function deletePedido($idPedido){
        $this->pedidos->borrarDatosPedido($idPedido);
        redirect('http://localhost/CDI/Panel/index.php/Crudpedidos/listaPedido');
    }

  public function Folio()
  {
    $this->load->view('gridfoliocompra');  
  }
  
 function traerlistaPedidoFilt($feIni,$feFin)//si se ocupa 
  {
      $prueba= $this->pedidos->traerListaOFiltro($feIni,$feFin);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function traerAre()//si se ocupa 
  {
      $prueba= $this->pedidos->getArea();
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function editaAr(){
    $idAreaI = $this->input->post('idAreaI');
    $idPedido = $this->input->post('id');
    //echo "dataa $ruta";
    $data = array(
          'AreaPedido' => $idAreaI
         );
    $this->pedidos->modificaCategoria($data,$idPedido);
    
  }

   function sacarNombreA($idAre)//si se ocupa 
  {
      $prueba= $this->pedidos->getNombreA($idAre);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
  
  function getDetalle($idPedi)// si se ocupa
  {
      $prueba= $this->pedidos->getDetallado($idPedi);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function getDetalleArray($idPedido)// si se ocupa
  {
      $prueba= $this->pedidos->getDetalladoArray($idPedido);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function getfiltroCheck($pagadasC,$creditoC,$pagosC,$feIniC,$feFinC)
  {
      $prueba= $this->pedidos->filtroCh($pagadasC,$creditoC,$pagosC,$feIniC,$feFinC);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function getDetalleFolio($OrdeComp)
  {
      $prueba= $this->pedidos->getDetalladofolio($OrdeComp);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

   function traerLisAr($idCom)
  {
      $prueba= $this->pedidos->getDetalleart($idCom);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
   
    function buscarNombreProved()
    {   

        $Proved=$_REQUEST["q"];
        if(isset($Proved)){
            $result=$this->pedidos->obtenerDatosProvedor($Proved);
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

    function traerArt()//ocupo

    {   
        $articuloN=$_REQUEST["q"];
            $result=$this->pedidos->obtenerDatosArtoProvedor($articuloN);
            if(count($result)>0)
                foreach($result as $pr)

                    $arrResult[]=array("value"=>$pr->nombre,
                      "idArticulo"=>$pr->idArticulo,
                      "medida"=>$pr->medida,
                      "existencia"=>$pr->existencia,
                      "maximo"=>$pr->maximo,
                      "minimo"=>$pr->minimo
                        );
                echo json_encode($arrResult);
    }


    function agregaCompra()// si se ocupa
    {
        $noPedi = $this->input->post('noPedi');
        if ($noPedi=="") {
          $noPedi=".";
        }
       
        $data = array(  
            'fechaPedido' => $this->input->post('HoyFec'),//
            'noPedido' => $this->input->post('noPedi'),//
            'idUser' => $this->input->post('idUser'),//
            'AreaPedido' => $this->input->post('areaSolicita'),//
            'personaPedido' => $this->input->post('solicitadoPor')
            );
        $this->pedidos->insertaDatos($data);

          $HoyFec = $this->input->post('HoyFec');
          $noPedi = $this->input->post('noPedi');
          

          $prueba=$this->pedidos->idPedido($HoyFec,$noPedi);  

          foreach ($prueba as $key) {
            $idSolicitud= $key['idSolicitud'];
          }

          $arregloDatos = $this->input->post('arreglo');
          $arregloDatos2= json_encode($arregloDatos);

          foreach ($arregloDatos as $key => $value) {
            foreach ($value as $key => $value) {
                 $data2 = array(  
                  'idPedido' => $idSolicitud,//
                  'idArticulo' => $value['idArticulo'],//
                  'nombreArt' => $value['nomArt'],//
                  'unidadPedido' => $value['unidadA'],//
                  'cantidadPedido' => $value['cantidadA'],//
                  'observacionesPedido' => $value['observaciones'],//
                  'areaUso' => $value['areaUso'],
                  'fechaCaducidad' => $value['fechaC']
                  );
                 //CONSULTAR LA EXISTENCIA DEL ARTICULO
                 
                 //echo "nopedido $noPedi y id solici $idSolicitud ".$value['unidadA'];
              $this->pedidos->insertaDatosPuente($data2);

                 $idA=$value['idArticulo'];
                 $exis=$value['existencia']-$value['cantidadA'];

                  $dataupd = array(  
                    'existencia' => $exis
                    );
                //$this->pedidos->updateArt($dataupd,$idA);

                $fechId=$value['fechId'];
                 $Ident=$value['Ident'];

                 $pruebaCE=$this->pedidos->idEC($fechId,$Ident);  
                foreach ($pruebaCE as $key) {
                  $ee= $key['existenciaAnterior'];
                }
                //echo "trae $ee";
                 $exiss=$ee-$value['cantidadA'];
                 if ($Ident==1) {
                    $dataPuenteUpdate = array(  
                    'existenciaAnterior' => $exiss
                    );
                //$this->pedidos->updatePuenteC($dataPuenteUpdate,$Ident,$fechId);
                 } if ($Ident==2) {
                    $dataPuenteUpdate = array(  
                    'cantidadActual' => $exiss
                    );
                //$this->pedidos->updatePuenteC($dataPuenteUpdate,$Ident,$fechId);
                 }
              
            }
          }
         echo "$idSolicitud";      
      }
       


    function traerIdCompra()// si se ocupa
  {
      $prueba= $this->pedidos->obteneridcompra();
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
    
function validOrd($nuOrden)
  {
      $prueba= $this->pedidos->obtenerOrden($nuOrden);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
  function modificarDatos(){

        $idSolicitud=$this->input->post('idSolicitud');
        $fechaPedido=$this->input->post('fechaPedido');
        $AreaPedido=$this->input->post('AreaPedido'); 

        $personaPedido=$this->input->post('personaPedido'); 
        $personaPedido=mb_strtoupper($personaPedido); 


        if (!empty($fechaPedido)) {
          $data = array(
            'fechaPedido' => $this->input->post('fechaPedido')
          );
          $this->pedidos->modificaCategoria($data,$idSolicitud);
        }else{}
        if (!empty($AreaPedido)) {
          $data = array(
            'AreaPedido' => $this->input->post('AreaPedido')
          );
          $this->pedidos->modificaCategoria($data,$idSolicitud);
        }else{}
        if (!empty($personaPedido)) {
          $data = array(
            'personaPedido' => $personaPedido
          );
          $this->pedidos->modificaCategoria($data,$idSolicitud);
        }else{}
        
  } 


  }




?>