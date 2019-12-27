<?php
class Salida extends CI_Model
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
 

      
      function idSali($fechaSoliCom,$nSalida)
    { 
      $this -> db -> select('*'); 
      $this -> db -> from('salida');
      $this->db->where('fechaSalida',$fechaSoliCom);
      $this->db->where('nSalida',$nSalida);
      $query = $this -> db -> get();
      return $query->result_array();      
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
    
     function obteneridSali()
    { 
  
        return $this->db->query("SELECT * FROM `salida`")->result_array();
    }

    function getUnicosFechacadu($idArt)
    {
       return $this->db->query("SELECT compraarticulo.idcompraArticulo,compraarticulo.fechaCaducidad, articulos.existencia,compraarticulo.existenciaAnterior FROM compraarticulo join articulos on articulos.idArticulo=compraarticulo.idArticulo WHERE compraarticulo.idArticulo=$idArt and  compraarticulo.existenciaAnterior >0 UNION all SELECT entradaArticulo.idEntradaArticulo, entradaArticulo.fechaCaducidad,articulos.existencia,entradaArticulo.cantidadActual
FROM entradaArticulo join articulos on articulos.idArticulo=entradaArticulo.idArticulo WHERE  entradaArticulo.idArticulo=$idArt  and cantidadActual >0")->result_array();
    }

    function getFeC($idArt)//de
    { 
  
        return $this->db->query("SELECT compraarticulo.idcompraArticulo,compraarticulo.cantidadArt,compraarticulo.fechaCaducidad, articulos.existencia,compraarticulo.existenciaAnterior FROM compraarticulo join articulos on articulos.idArticulo=compraarticulo.idArticulo WHERE compraarticulo.idArticulo=$idArt and  compraarticulo.existenciaAnterior >0 ")->result_array();
    }

    function getFeCEntrada($idArt)
    { 
  
        return $this->db->query("SELECT entradaArticulo.idEntradaArticulo, entradaArticulo.cantidadArt,entradaArticulo.fechaCaducidad,entradaArticulo.cantidadActual
FROM entradaArticulo WHERE  idArticulo=$idArt  and cantidadActual >0")->result_array();
    }

    function getValidacionMinimo($idArticulo,$fCaducidad,$fCaducidadEntrada,$cantidadAr)
    { 
      if ($fCaducidad!="no")
       {
          return $this->db->query("SELECT
      articulos.*, compraarticulo.idCompra,compraarticulo.fechaCaducidad,compraarticulo.existenciaAnterior,compraarticulo.idcompraArticulo
      FROM
      articulos join compraarticulo on compraarticulo.idArticulo=articulos.idArticulo
      WHERE  articulos.idArticulo  =$idArticulo and compraarticulo.idcompraArticulo=$fCaducidad")->result_array();
       }else if ($fCaducidadEntrada!="no") {
          return $this->db->query("SELECT articulos. * , entradaArticulo.fechaCaducidad, entradaArticulo.cantidadActual as existenciaAnterior , entradaArticulo.idEntradaArticulo
            FROM articulos
            JOIN entradaArticulo ON entradaArticulo.idArticulo = articulos.idArticulo
            WHERE articulos.idArticulo =$idArticulo and entradaArticulo.idEntradaArticulo=$fCaducidadEntrada")->result_array();

       }

  
        
    }

     function insertaDatos($data)
    {
      $this->db->insert('salida', $data);
    }


    function insertaDatosPuente($data2)
    {
      $this->db->insert('salidaArticulo', $data2);
    }

       function obtenerDatosProvedor($nombre)

    { 
        $this-> db ->like('nombreP',$nombre,'both');
        return $this-> db ->get('Proveedores')->result();
       // return $this->db->query("SELECT * FROM `Pacientes` WHERE `nombrePaci` like '%$nombre%' ")->result_array();
    }

    function obtenerDatosArto($articuloN)

    { 
        //$this-> db ->like('nombre',$articuloN,'both');
        //return $this-> db ->get('articulos')->result();

         $this ->db-> select('*');
        $this->db->from('articulos');
        //$this->db->where('articuloproveedores.idProveedor',$idProveedor);
        $this->db->like('nombre',$articuloN,'both');
        $query = $this->db->get();
        return $query->result();

        //return $this->db->query("SELECT articulos.* FROM `articulos` join articuloproveedores on articulos.idArticulo=articuloproveedores.idarticulo where articuloproveedores.idProveedor=$idProveedor and articulos.nombre like '%$articuloN%' ")->row();
    }



    function updateArt($dataupd,$idA)
    {
      $this->db->where('idArticulo', $idA);
      $this->db->update('articulos', $dataupd); 
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