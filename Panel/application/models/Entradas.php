<?php
class Entradas extends CI_Model
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
 

      
      function idEntra($fechaSoliCom,$nEntrada)
    { 
      $this -> db -> select('*'); 
      $this -> db -> from('entrada');
      $this->db->where('fechaEntrada',$fechaSoliCom);
      $this->db->where('nEntrada',$nEntrada);
      $query = $this -> db -> get();
      return $query->result_array();      
    }
    
     function obteneridcompra()
    { 
  
        return $this->db->query("SELECT * FROM `entrada`")->result_array();
    }

     function insertaDatos($data)
    {
      $this->db->insert('entrada', $data);
    }


    function insertaDatosPuente($data2)
    {
      $this->db->insert('entradaArticulo', $data2);
    }

       function obtenerDatosProvedor($nombre)

    { 
        $this-> db ->like('nombreP',$nombre,'both');
        return $this-> db ->get('Proveedores')->result();
       // return $this->db->query("SELECT * FROM `Pacientes` WHERE `nombrePaci` like '%$nombre%' ")->result_array();
    }

    function obtenerDatosArto($articuloN,$idProveedor)

    { 
        
         /*$this ->db-> select('*');
        $this->db->from('articulos');
        $this->db->like('nombre',$articuloN,'both');
        $query = $this->db->get();
        return $query->result();*/

        $this ->db-> select('*');
        $this->db->from('articulos');
       $this->db->like('articulos.nombre',$articuloN,'both');
        $query = $this->db->get();
        return $query->result();


        //return $this->db->query("SELECT articulos.* FROM `articulos` join articuloproveedores on articulos.idArticulo=articuloproveedores.idarticulo where articuloproveedores.idProveedor=$idProveedor and articulos.nombre like '%$articuloN%' ")->row();
    }



    function updateArt($dataupd,$idA)
    {
      $this->db->where('idArticulo', $idA);
      $this->db->update('articulos', $dataupd); 
    }
     

}


?>