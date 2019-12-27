<?php
class Compras extends CI_Model
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

    function traerListaOFiltro($feIni,$feFin)
    { 
  
        return $this->db->query("SELECT * FROM `compra` WHERE `fechaCompra` BETWEEN '$feIni' and '$feFin' ORDER BY `compra`.`fechaCompra` DESC")->result_array();
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

    function obtenerImport($idArt)
    { 
  
        return $this->db->query("SELECT * FROM `articulos` WHERE `idArticulo` = '$idArt'")->row();
    }

    function comparaClave($clave)
    { 
  
        return $this->db->query("SELECT * FROM `usuarios` WHERE `password` = '$clave' and tipoUser =1")->result_array();
    }


function getDetallado($idComp)
    { 
        return $this->db->query("SELECT usuarios.nombreUser,Proveedores.nombreP,compra.* FROM `compra` join usuarios on compra.idAlmacenista=usuarios.idUser join Proveedores on Proveedores.idProveedor=compra.idProveedor where compra.idCompra=$idComp ")->result_array();
    }

    function getDetalladoArray($idComp)
    { 
        return $this->db->query("SELECT * from compraarticulo where idCompra=$idComp ")->result_array();
    }

    function getDetalleart($idComp)
    { 
        return $this->db->query("SELECT articulos.existencia,articulos.idArticulo,articulosOrdencompra.cantidad,articulos.medida,articulos.nombre,articulos.costo_unitario FROM `articulosOrdencompra` join articulos on articulos.idArticulo=articulosOrdencompra.idArticulo join ordenCompra on ordenCompra.idCompra=articulosOrdencompra.idCompra WHERE ordenCompra.idCompra='$idComp' ")->result_array();
    }

    function getDetalladofolio($OrdeComp)
    { 
      $fac=str_replace("%20","",$OrdeComp);
        return $this->db->query("SELECT ordenCompra.*,articulosOrdencompra.*, Proveedores.nombreP FROM `ordenCompra` JOIN articulosOrdencompra on ordenCompra.idCompra=articulosOrdencompra.idCompra  join Proveedores on Proveedores.idProveedor=ordenCompra.idProveedor where ordenCompra.nOrden ='$fac' ")->result_array();
    }

	function getDatos()
	{
		
		
		return $this->db->query("SELECT * FROM Salas ")->result_array();
     	
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
      
      function idCompr($fechaSoliCom,$noCompra)
    { 
      $this -> db -> select('*'); 
      $this -> db -> from('compra');
      $this->db->where('fechaCompra',$fechaSoliCom);
      $this->db->where('ncompra',$noCompra);
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
  

     function insertaDatos($data)
    {
      $this->db->insert('compra', $data);
    }

     function insertaDatosPago($dataP)
    {
      $this->db->insert('fechaspagocompra', $dataP);
    }

    function insertaDatosPuente($data2)
    {
      $this->db->insert('compraarticulo', $data2);
    }

       function obtenerDatosProvedor($nombre)

    { 
        $this-> db ->like('nombreP',$nombre,'both');
        return $this-> db ->get('Proveedores')->result();
       // return $this->db->query("SELECT * FROM `Pacientes` WHERE `nombrePaci` like '%$nombre%' ")->result_array();
    }

    function obtenerDatosArtoProvedor($idProveedor,$articuloN)

    { 
        //$this-> db ->like('nombre',$articuloN,'both');
        //return $this-> db ->get('articulos')->result();

         $this ->db-> select('articulos.*');
        $this->db->from('articulos');
      $this->db->join('articuloproveedores','articulos.idArticulo=articuloproveedores.idarticulo');
      
        $this->db->where('articuloproveedores.idProveedor',$idProveedor);
        $this->db->like('articulos.nombre',$articuloN,'both');
        $query = $this->db->get();
        return $query->result();

        //return $this->db->query("SELECT articulos.* FROM `articulos` join articuloproveedores on articulos.idArticulo=articuloproveedores.idarticulo where articuloproveedores.idProveedor=$idProveedor and articulos.nombre like '%$articuloN%' ")->row();
    }

    function obteneridcompra()
    { 
      //apePaterno, apeMaterno, 
     /* $this -> db -> select('*');
      $this->db->from('compra');
      //$this->db->join('area','usuario.idArea=area.idArea');
      
      //  $this->db->where('idSala',$idS);
        $query = $this->db->get();
        return $query->result_array();
*/
        return $this->db->query("SELECT * FROM `compra`")->result_array();
    }

    function updateArt($dataupd,$idA)
    {
      $this->db->where('idArticulo', $idA);
      $this->db->update('articulos', $dataupd); 
    }
     

}


?>