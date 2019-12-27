<?php
class Clientes extends CI_Model
{
	public $variable;
	function __construct(){
		parent::__construct();
	}
	

	function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM clientes")->row_array();
 		return $query['row'];
	}

    

	function getDatos($no_page)
	{

		return $this->db->query("SELECT * FROM clientes ORDER BY nombreCliente ASC")->result_array();
     	
	}

  function getCompletos(){
    return $this->db->query("SELECT * FROM clientes ")->result_array();
  }

  function Edo()
  {
    return $this->db->query("SELECT * FROM estados")->result_array();
  }

  function obtenerMuni($idEdo)
  {
    return $this->db->query("SELECT * FROM municipios where estado=$idEdo ")->result_array();
  }

  function obtenerColo($idMuni)
  {
    return $this->db->query("SELECT * FROM regiones where municipio=$idMuni ORDER BY `regiones`.`nombreRegion` ASC")->result_array();
  }

  function obtenerPostal($coloniaCl)
  {
    return $this->db->query("SELECT * FROM regiones where idRegiones=$coloniaCl ")->result_array();
  }


	function data_pagination($url, $rows = 5, $uri = 3)
	{
 		$this->load->library('pagination');
   	$config['per_page']   = 20;
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
    function borrarDatos($id)
  { 
    $this->db->where('idCliente', $id);
    $this->db->delete('clientes'); 
    }

  function obtenerFicha($idC)
    { 
      //apePaterno, apeMaterno, 
      $this -> db -> select('clientes.*,estados.nombreEstado,municipios.nombreMunicipio,regiones.nombreRegion');
      $this->db->from('clientes');
      $this->db->join('estados','clientes.Estado=estados.id_Estado');
      $this->db->join('municipios','municipios.idMunicipio=clientes.municipio');
      $this->db->join('regiones','regiones.idRegiones=clientes.Colonia');
        $this->db->where('clientes.idCliente',$idC);
        $query = $this->db->get();
        return $query->row();
    }

  function obtenerCondicion($id)
    { 
      //apePaterno, apeMaterno, 
      $this -> db -> select('CondicionesCliente.*');
      $this->db->from('CondicionesCliente');
      $this->db->join('clientes','clientes.idCliente=CondicionesCliente.cliente');
        $this->db->where('CondicionesCliente.cliente',$id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function modificaDatos($data,$idC)
    { 
      $this->db->where('idCliente', $idC);
      $this->db->update('clientes', $data);
      
    }

    function modificaCondicion($data,$id)
    { 
      $this->db->where('cliente', $id);
      $this->db->update('CondicionesCliente', $data);
      
    }

     function insertaDatos($data)
    {
      $this->db->insert('clientes', $data);
    }

      function insertaCondicion($data)
    {
      $this->db->insert('CondicionesCliente', $data);
    }


}


?>