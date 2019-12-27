<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crudordencompra extends CI_Controller {
	function __construct(){
		parent::__construct();
    if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("ordencompra"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=17;
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
		
     	$data['total'] = $this->ordencompra->getTotal();
     
		$this->load->view('gridordencompra',$data);  

		
	}
	function traerId()
  {
      $prueba= $this->ordencompra->obtenerid();
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

function traerMin($idPr, $idCom)
  {
      $prueba= $this->ordencompra->traerminArt($idPr, $idCom);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function traerMinimo($idPr)
  {
      $prueba= $this->ordencompra->traerminArticulo($idPr);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function traerListaEditBase($idComp)
  {
      $prueba= $this->ordencompra->traerCompr($idComp);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }
function traerlistaOrden($idPr)
  {
      $prueba= $this->ordencompra->traerListaO($idPr);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function traerlistaOrdenFilt($feIni,$feFin,$idP)
  {
      $prueba= $this->ordencompra->traerListaOFiltro($feIni,$feFin,$idP);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function deleteArrayArt($idComp)
  {
      $prueba= $this->ordencompra->eliminarTodo($idComp);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

  function calculaMini($idA)
  {
      $prueba= $this->ordencompra->traerCalcul($idA);
      echo json_encode ($prueba);
      //echo json_encode("hola");
  }

   
    function buscarNombreProved()
    {   

        $Proved=$_REQUEST["q"];
        if(isset($Proved)){
            $result=$this->ordencompra->obtenerDatosProvedor($Proved);
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

    function guardarArreglo($idCom,$remeArt,$canti)
    {
     // echo "idCompra $idCom remeArt $remeArt canti $canti";

        $data = array(  
            'idCompra' => $idCom,//
            'idArticulo' => $remeArt,//
            'cantidad' => $canti
            );
        $this->ordencompra->insertaDatosPuente($data);

    }

    function agregaOrdenc($tot)
    {
        
        $data = array(  
            'idProveedor' => $this->input->post('idProve'),//
            'fechaPedido' => $this->input->post('fechaSoliMos'),//
            'fechaEntrega' => $this->input->post('fechaEntrega'),//
            'fechaEmitida' => $this->input->post('fechaemi'),//
            'nOrden' => $this->input->post('noEmisi'),
            'subtotal' => 0,//
            'iva' => 1,//
            'total' =>1//
            );
        $this->ordencompra->insertaDatos($data);

          $nOrden = $this->input->post('noEmisi');
          $fechaSoliMos = $this->input->post('fechaSoliMos');
         // $tot = $this->input->post('tot');
         // echo "fechaSoliMos $fechaSoliMos nOrden $nOrden";
          $prueba=$this->ordencompra->idOrden($fechaSoliMos,$nOrden);  
          foreach ($prueba as $key) {
            $idCompra= $key['idCompra'];
          }
//echo "fechaSoliMos $fechaSoliMos nOrden $nOrden idCompra $idCompra total $tot";
          for ($i=1; $i <= $tot ; $i++) { 
            $idub = $this->input->post('remeArt'.$i);
            $canti = $this->input->post('canti'.$i);
          
            if ($idub != "") {
                $data2 = array(
                'idCompra' =>$idCompra ,    
                'idArticulo' => $idub,
                'cantidad' => $canti  
                );
                $this->ordencompra->insertaDatosPuente($data2);
                
            }
        }
      echo "$idCompra";
    }


	}


?>