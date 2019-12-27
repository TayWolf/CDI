<?php
class Facturacion extends CI_Model
{
	public $variable;
	function __construct(){
		parent::__construct();
	}
	

	function getTotalRowAllData()//
	{
 		$query = $this->db->query("SELECT count(*) as row FROM Estudio")->row_array();
 		return $query['row'];
	}
    

	function getDatos($no_page)//
	{
		 $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage; 
        }else{
      
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
		
		return $this->db->query("SELECT Estudio.*, categoriaEstudio.nombreCat FROM Estudio join categoriaEstudio on categoriaEstudio.idCat = Estudio.idCat limit 10 offset $first")->result_array();
     	
	}


	function data_pagination($url, $rows = 5, $uri = 3)//
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


    function getSalas()//
    {
      return $this->db->query("SELECT * FROM Salas ")->result_array();
    }

    function getClientes()//
    {
      return $this->db->query("SELECT * FROM clientes")->result_array();
    }

    function getEmpresas()//
    {
      return $this->db->query("SELECT * FROM Empresas")->result_array();
    }

    

    

}


?>