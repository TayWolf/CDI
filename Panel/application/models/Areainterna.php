<?php
class Areainterna extends CI_Model
{
	public $variable;
	function __construct(){
		parent::__construct();
	}
	

	function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM areaInterna")->row_array();
 		return $query['row'];
	}


	function getDatos($no_page)
	{
		
		return $this->db->query("SELECT * FROM areaInterna")->result_array();
     	
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

	function obtenerFicha($idu)
    { 
      $this->db->select('*');
      $this->db->from('usuarios');
      $this->db->where('idUser',$idu);
      $query = $this->db->get();
      return $query->row();

    }

    

	function insertaDatos($data)
	{
		$this->db->insert('areaInterna', $data);
  }

  function modificaDatos($data,$idAreaI)
  { 
    $this->db->where('idInterno', $idAreaI);
    $this->db->update('areaInterna', $data); 
  }

  function borrarDatos($idArea)
  { 
    $this->db->where('idInterno', $idArea);
    $this->db->delete('areaInterna'); 
  }

 


}


?>