<?php
class Salas extends CI_Model
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

    

	function getDatos($no_page)
	{
		return $this->db->query("SELECT * FROM Salas")->result_array();
     	
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
    function obtenerStatus($idSala)
    {
      return $this->db->query("SELECT horarios FROM Salas  where idSala=$idSala")->row();
    }

    function modificaDatos($data,$idS)
    { 
      $this->db->where('idSala', $idS);
      $this->db->update('Salas', $data); 
      
    }
    function modifcaStatus($data,$idSala)
      {
        $this->db->where('idSala', $idSala);
        $this->db->update('Salas', $data);
      }

     function insertaDatos($data)
    {
      $this->db->insert('Salas', $data);
    }

    function insertaDatosPuent($data)
    {
      $this->db->insert('horarioSalaMedico', $data);
    }

    function getEstudios()
    {
      return $this->db->query("SELECT * FROM Estudio ")->result_array();
    }
    function getDoctores()
    {
      return $this->db->query("SELECT * FROM Doctores ")->result_array();
    }
    function obtenerdisponibles($estudio,$actual)
    { 
      return $this->db->query("SELECT * FROM Estudio WHERE NOT EXISTS (SELECT idEstudio FROM salaEstudio where idEstudio = $estudio and idSala = $actual) and IdEstudio = $estudio")->row_array();
    }
    function obtenerasignadas($i,$actual)
    {
      return $this->db->query("SELECT * FROM Estudio WHERE EXISTS (SELECT idEstudio FROM salaEstudio where idEstudio = $i and idSala = $actual) and IdEstudio = $i")->row_array();
    }

    function obtenerdocsdisponibles($i,$actual)
    { 
      return $this->db->query("SELECT * FROM Doctores WHERE NOT EXISTS (SELECT idMedico FROM salaMedico where idMedico = $i and idSala = $actual) and idDoctor = $i")->row();
    }

    function obtenerdocsasignados($i,$actual)
    {
      return $this->db->query("SELECT * FROM Doctores WHERE EXISTS (SELECT idMedico FROM salaMedico where idMedico = $i and idSala = $actual) and idDoctor = $i")->row();
    }

    function insertaDatosPuente($data)
    {
      $this->db->insert('salaEstudio', $data);
    }

    function insertaDatosPuenteDoc($data)
    {
      $this->db->insert('salaMedico', $data);
    }

    function quitarDatosPuente($idE,$total,$idactual)
    { 
      $this->db->where('idEstudio', $idE);
      $this->db->where('idSala', $idactual);
      $this->db->delete('salaEstudio'); 
    }

    function quitarDatosPuenteDoc($idD,$total,$idactual)
    { 
      $this->db->where('idMedico', $idD);
      $this->db->where('idSala', $idactual);
      $this->db->delete('salaMedico'); 
    }
    function obtenerIdDocSala($idD,$idS)
    {
      return $this->db->query("SELECT * FROM salaMedico  where idMedico=$idD and idSala = $idS")->row();
    }

    function traeidhorasalamedi($sala,$doc)
    {
      return $this->db->query("SELECT idsalaMedico FROM salaMedico  where idMedico=$doc and idSala = $sala")->row();
    }
    function traehoras($id)
    {
      return $this->db->query("SELECT * FROM horarioSalaMedico where idsalaMedico = $id ORDER BY `horarioSalaMedico`.`dia` ASC")->result_array();
    }
    function borrarHora($id)
    { 
      $this->db->where('idcontrol', $id);
      $this->db->delete('horarioSalaMedico'); 
    }

    function traerHorariosMedico($idSalaMedico, $dia)
    {
        return $this->db->query("SELECT horarioSalaMedico.*
FROM horarioSalaMedico
WHERE idsalaMedico IN (SELECT idsalaMedico
                       FROM salaMedico
                       WHERE idMedico = (SELECT idMedico
                                         FROM salaMedico
                                         WHERE idsalaMedico = '$idSalaMedico')) AND horarioSalaMedico.dia='$dia'")->result_array();
    }

}


?>