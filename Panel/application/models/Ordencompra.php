<?php
class Ordencompra extends CI_Model
{
	public $variable;
	function __construct(){
		parent::__construct();
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
 

    
     function obtenerid()
    { 
  
        return $this->db->query("SELECT * FROM `ordenCompra`")->result_array();
    }

    function getTotal()
    { 
  
        return $this->db->query("SELECT * FROM `articulos`")->result_array();
    }

    function traerminArt($idPr, $idCom)
    { 
        /*
         return $this->db->query("SELECT articulos.nombre,articulos.idArticulo FROM `articuloproveedores` join articulos on articulos.idArticulo=articuloproveedores.idarticulo WHERE articuloproveedores.idProveedor=$idPr and articulos.existencia<=articulos.minimo")->result_array();
         
        return $this->db->query("SELECT compraarticulo.nombreArticulo AS nombre,compraarticulo.idArticulo FROM compraarticulo 
        join compra on compra.idCompra=compraarticulo.idCompra
        WHERE compra.orden='$idOrden'")->result_array();*/

        return $this->db->query("SELECT articulos.nombre, articulosOrdencompra.idArticulo FROM articulos, articulosOrdencompra WHERE articulos.idArticulo=articulosOrdencompra.idArticulo AND idCompra=$idCom")->result_array();
    }


     function traerminArticulo($idPr)
    { 
      
          return $this->db->query("SELECT articulos.nombre,articulos.idArticulo FROM `articuloproveedores` join articulos on articulos.idArticulo=articuloproveedores.idarticulo WHERE articuloproveedores.idProveedor=$idPr and articulos.existencia<=articulos.minimo")->result_array();
    }


    function traerCompr($idCompr)
    { 
  
        return $this->db->query("SELECT articulos.nombre,articulosOrdencompra.idArticulo,articulosOrdencompra.cantidad FROM `articulosOrdencompra` join ordenCompra on ordenCompra.idCompra=articulosOrdencompra.idCompra join articulos on articulos.idArticulo=articulosOrdencompra.idArticulo where ordenCompra.idCompra=$idCompr")->result_array();
    }

    function traerListaO($idPr)
    { 
  
        return $this->db->query("SELECT * FROM `ordenCompra` WHERE `idProveedor` = $idPr")->result_array();
    }

     function traerListaOFiltro($feIni,$feFin,$idP)
    { 
  
        return $this->db->query("SELECT * FROM `ordenCompra` WHERE `fechaEmitida` BETWEEN '$feIni' and '$feFin' and `idProveedor` = $idP")->result_array();
    }

    function traerCalcul($idArt)
    { 
  
        return $this->db->query("SELECT * FROM `articulos` WHERE `idArticulo` = $idArt")->result_array();
    }

    function idOrden($fechaSoliMos,$nOrden)
    { 
  
        $this -> db -> select('*'); 
      $this -> db -> from('ordenCompra');
      $this->db->where('fechaPedido',$fechaSoliMos);
      $this->db->where('nOrden',$nOrden);
      $query = $this -> db -> get();
      return $query->result_array();      
    }


     function insertaDatos($data)
    {
      $this->db->insert('ordenCompra', $data);
    }


    function insertaDatosPuente($data2)
    {
      $this->db->insert('articulosOrdencompra', $data2);
    }

    function eliminarTodo($idCompr)
  { 
    $this->db->where('idCompra', $idCompr);
    $this->db->delete('articulosOrdencompra'); 
    }

       function obtenerDatosProvedor($nombre)

    { 
        $this-> db ->like('nombreP',$nombre,'both');
        return $this-> db ->get('Proveedores')->result();
       // return $this->db->query("SELECT * FROM `Pacientes` WHERE `nombrePaci` like '%$nombre%' ")->result_array();
    }


}


?>