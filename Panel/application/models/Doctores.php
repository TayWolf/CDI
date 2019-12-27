<?php
class Doctores extends CI_Model
{
	public $variable;
	function __construct(){
		parent::__construct();
	}
	

	function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM Doctores")->row_array();
 		return $query['row'];
	}

    

	function getDatos($no_page)
	{
		return $this->db->query("SELECT * FROM Doctores")->result_array();
     	
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
    function borrarDatos($estudio,$idDoc)
  { 
    $this->db->where('idDoctor', $idDoc);
    $this->db->where('idEstudio', $estudio);
    $this->db->delete('doctorEstudio'); 
    }

  function obtenerFicha($idD)
    { 
      //apePaterno, apeMaterno, 
      $this -> db -> select('*');
      $this->db->from('Doctores');      
      $this->db->where('idDoctor',$idD);
      $query = $this->db->get();
      return $query->row();

    }

    function modificaDatos($data,$idD)
    { 
      $this->db->where('idDoctor', $idD);
      $this->db->update('Doctores', $data); 
      
    }

    function insertaDatos($data)
    {
      $this->db->insert('Doctores', $data);
    }

    function insertaEstudiosDoctor($data)
    {
    	$this->db->insert('doctorEstudio', $data);
    }

    function desac($data,$id)
  	{ 
	    $this->db->where('idDoctor', $id);
	    $this->db->update('Doctores', $data); 
    }

     function act($data,$id)
  { 
    $this->db->where('idDoctor', $id);
    $this->db->update('Doctores', $data); 
    
    }

  function obtenerSalas($id)
    { 
      return $this->db->query("SELECT salaMedico.idsalaMedico, Salas.nombre FROM salaMedico JOIN Salas on salaMedico.idSala = Salas.idSala WHERE salaMedico.idMedico = $id")->result_array();
    }

  function obtenerEstudiosDoc($idDoc)
    { 
      return $this->db->query("SELECT doctorEstudio.*, Estudio.nombreEstudio FROM doctorEstudio join Estudio on Estudio.IdEstudio = doctorEstudio.idEstudio WHERE idDoctor = $idDoc ORDER BY doctorEstudio.idEstudio ASC")->result_array();
    }

  function obtenerEstudios($clave)
    { 
    	// $clavesinespacios = str_replace('%20', ' ', $clave);
      	return $this->db->query("SELECT * FROM Estudio where nombreEstudio like '%$clave%' ")->result_array();
    }

  function obtenerHorarios($id)
    { 
      return $this->db->query("SELECT * FROM `horarioSalaMedico` where idsalaMedico = $id GROUP by dia")->result_array();
    }

    function obtenerHorariosporDia($dia,$id)
    { 
      return $this->db->query("SELECT * FROM `horarioSalaMedico` where idsalaMedico = $id and dia =$dia")->result_array();
    }

}


?>