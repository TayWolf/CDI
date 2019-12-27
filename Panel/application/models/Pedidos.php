<?php
class Pedidos extends CI_Model
{
  public $variable;
  function __construct(){
    parent::__construct();
  }
  

  function getTotalRowAllData()
  {
    $query = $this->db->query("SELECT count(*) as row FROM Salas")->row_array();
    return $query['row'];
  }

    function traerListaOFiltro($feIni,$feFin)// si se ocupa
    { 
  
        return $this->db->query("SELECT * FROM `controlPedidos` WHERE `fechaPedido` BETWEEN '2018-06-02' and '2018-06-26' ORDER BY `controlPedidos`.`fechaPedido` DESC")->result_array();
    }


    function getListadoPedidos($array)// si se ocupa
    { 
        $this->db->select("controlPedidos.*,areaInterna.nombreArea");
        $this->db->from("controlPedidos");
        $this->db->join("areaInterna", "areaInterna.idInterno=controlPedidos.AreaPedido");
        $this->db->order_by("controlPedidos.fechaPedido", "DESC");
        $this->db->where($array);
        return $this->db->get()->result_array();
        //return $this->db->query("SELECT controlPedidos.*,areaInterna.nombreArea FROM controlPedidos JOIN areaInterna on areaInterna.idInterno=controlPedidos.AreaPedido ORDER BY controlPedidos.fechaPedido DESC")->result_array();
    }

    function modificaCategoria($data,$idPedido){
    $this->db->where('idSolicitud', $idPedido);
    $this->db->update('controlPedidos', $data); 
    }

     function filtroCh($pagadasC,$creditoC,$pagosC,$feIni,$feFin)
    { 
        if ($pagadasC=="on" && $creditoC !="on") {
           return $this->db->query("SELECT * FROM `compra` WHERE `fechaCompra` BETWEEN '$feIni' and '$feFin' and `tipo_pago` = 2 ORDER BY `compra`.`fechaCompra` DESC")->result_array();
        }
        if ($creditoC=="on" && $pagadasC !="on") {
           return $this->db->query("SELECT * FROM `compra` WHERE `fechaCompra` BETWEEN '$feIni' and '$feFin' and  `tipo_pago` = 1 ORDER BY `compra`.`fechaCompra` DESC")->result_array();
        }

        if ($creditoC=="on" && $pagadasC =="on" ) {
           return $this->db->query("SELECT * FROM `compra` where `fechaCompra` BETWEEN '$feIni' and '$feFin' ORDER BY `compra`.`fechaCompra` DESC")->result_array();
        }
       
    }


    function obtenerOrden($NumOrde)
    { 
  
        return $this->db->query("SELECT orden FROM `compra` WHERE `orden` = '$NumOrde'")->row();
    }


function getDetallado($idPedido)// si se ocupa 
    { 
        return $this->db->query("SELECT usuarios.nombreUser,controlPedidos.* FROM `controlPedidos` join usuarios on controlPedidos.idUser=usuarios.idUser  where controlPedidos.idSolicitud=$idPedido ")->result_array();
    }

    function getDetalladoArray($idPedido)// si se ocupa 
    { 
        return $this->db->query("SELECT * from pedidoArticulo where idPedido=$idPedido ")->result_array();
    }

    function getDetalleart($idComp)
    { 
        return $this->db->query("SELECT articulos.existencia,articulos.idArticulo,articulosOrdencompra.cantidad,articulos.medida,articulos.nombre,articulos.costo_unitario FROM `articulosOrdencompra` join articulos on articulos.idArticulo=articulosOrdencompra.idArticulo join ordenCompra on ordenCompra.idCompra=articulosOrdencompra.idCompra WHERE ordenCompra.idCompra='$idComp' ")->result_array();
    }

    function getDetalladofolio($OrdeComp)
    { 
      $fac=str_replace("%20","",$OrdeComp);
        return $this->db->query("SELECT ordenCompra.*,articulosOrdencompra.*, Proveedores.nombreP FROM `ordenCompra` JOIN articulosOrdencompra on ordenCompra.idCompra=articulosOrdencompra.idCompra  join Proveedores on Proveedores.idProveedor=ordenCompra.idProveedor where ordenCompra.nOrden ='$fac' ")->row();
    }

  function getDatos()
  {
    return $this->db->query("SELECT * FROM Salas ")->result_array();
  }

  function getNombreA($idAre)
  {
    return $this->db->query("SELECT * FROM areaInterna where idInterno = $idAre ")->row();
  }


function getArea()
  {
    return $this->db->query("SELECT * FROM areaInterna ")->result_array();   
  }


  function data_pagination($url, $rows = 5, $uri = 3)
  {
    $this->load->library('pagination');
    $config['per_page']   = 10;
    $config['base_url']   = site_url($url);
    $config['total_rows']   = $rows;
    $config['use_page_numbers'] = TRUE;
    $config['uri_segment']   = $uri;
    $config['num_links']   = 5;
    $config['next_link']   = '»';
    $config['prev_link']   = '«';
    $config['cur_tag_open']='<li class="actual activo"><a>';
    $config['cur_tag_close']='</a></li>';
    $config['full_tag_open']='<li>';
    $config['full_tag_close']='</li>';
 // untuk config class pagination yg lainnya optional (suka2 lu.. :D )
 
    $this->pagination->initialize($config);
    return $this->pagination->create_links();
  }
    function borrarDatos($idSala)
  { 
    $this->db->where('idSala', $idSala);
    $this->db->delete('Salas'); 
    }

    function borrarDatosPedido($idPedido)
  { 
    $this->db->where('idSolicitud', $idPedido);
    $this->db->delete('controlPedidos'); 
    }

  function obtenerFicha($idS)
    { 
      //apePaterno, apeMaterno, 
      $this -> db -> select('*');
      $this->db->from('Salas');
      //$this->db->join('area','usuario.idArea=area.idArea');
      
        $this->db->where('idSala',$idS);
        $query = $this->db->get();
        return $query->row();

    }
      
      function idPedido($HoyFec,$noPedi) // si se ocupa
    { 
      $this -> db -> select('*'); 
      $this -> db -> from('controlPedidos');
      $this->db->where('fechaPedido',$HoyFec);
      $this->db->where('noPedido',$noPedi);
      $query = $this -> db -> get();
      return $query->result_array();      
    }
    

    function cantidadSuma($idA)
    { 
      $this -> db -> select('*'); 
      $this -> db -> from('articulos');
      $this->db->where('idArticulo',$idA);
      //$this->db->where('ncompra',$noCompra);
      $query = $this -> db -> get();
      return $query->result_array();      
    }
  

     function insertaDatos($data)//este se ocupa
    {
      $this->db->insert('controlPedidos', $data);
    }

     function insertaDatosPago($dataP)
    {
      $this->db->insert('fechaspagocompra', $dataP);
    }

    function insertaDatosPuente($data2)
    {
      $this->db->insert('pedidoArticulo', $data2);
    }

       function obtenerDatosProvedor($nombre)

    { 
        $this-> db ->like('nombreP',$nombre,'both');
        return $this-> db ->get('Proveedores')->result();
       // return $this->db->query("SELECT * FROM `Pacientes` WHERE `nombrePaci` like '%$nombre%' ")->result_array();
    }

    function obtenerDatosArtoProvedor($articuloN)//si se ocupa
    { 
      $limit=10;
         $this-> db ->like('nombre',$articuloN,'both');
          $this-> db ->limit($limit);
        return $this-> db ->get('articulos')->result();
         
    }

    function obteneridcompra()// si se ocupa
    { 

        return $this->db->query("SELECT * FROM `controlPedidos`")->result_array();
    }

    function updateArt($dataupd,$idA)
    {
      $this->db->where('idArticulo', $idA);
      $this->db->update('articulos', $dataupd); 
    }

    function idEC($fechId,$Ident)
    { 
      if ($Ident==1) {
        $this -> db -> select('compraarticulo.existenciaAnterior'); 
        $this -> db -> from('compraarticulo');
        $this->db->where('idcompraArticulo',$fechId);
       
        $query = $this -> db -> get();
        return $query->result_array();
      }else if ($Ident==2) 
      {
        $this -> db -> select('entradaArticulo.`cantidadActual` as existenciaAnterior'); 
        $this -> db -> from('entradaArticulo');
        $this->db->where('idEntradaArticulo',$fechId);
       
        $query = $this -> db -> get();
        return $query->result_array();

      }
            
    }
   function updatePuenteC($dataPuenteUpdate,$Ident,$fechId)
    {
      if ($Ident==1) {
        $this->db->where('idcompraArticulo', $fechId);
        $this->db->update('compraarticulo', $dataPuenteUpdate); 
      }else if($Ident==2)
      {
        $this->db->where('idEntradaArticulo', $fechId);
        $this->db->update('entradaArticulo', $dataPuenteUpdate); 
      }
      
    }
     

}


?>