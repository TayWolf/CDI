<?php
class Remitente extends CI_Model
{
	public $variable;
	function __construct(){
		parent::__construct();
	}

	function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM Remitente")->row_array();
 		return $query['row'];
	}
  public function total()
    {
      return $this->db->query("SELECT count(*) as row FROM Remitente")->result_array();
    }

	function getDatos($no_page)
	{
		return $this->db->query("SELECT * FROM Remitente")->result_array();
     	
	}

  function obtenerDatos()
  {
    return $this->db->query("SELECT * FROM Remitente")->result_array();
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
 
 		$this->pagination->initialize($config);
 		return $this->pagination->create_links();
	}

	function obtenerFicha($idR)
    { 
      $this->db->select('Remitente.*, regiones.*, municipios.*, estados.*');
      $this->db->from('Remitente');
      $this->db->join('regiones','regiones.idRegiones = Remitente.coloniaRem');
      $this->db->join('municipios','municipios.idMunicipio = Remitente.ciudadRem');
      $this->db->join('estados','estados.id_Estado = Remitente.estadoRem');
      $this->db->where('Remitente.idRemitente',$idR);
      $query = $this->db->get();
      return $query->row();

    }

    function obtenerFichadelete($id)
    { 
      $this->db->select('*');
      $this->db->from('Remitente');
      $this->db->where('idRemitente',$id);
      $query = $this->db->get();
      return $query->row();
    }

	function insertaDatos($data)
	{
		$this->db->insert('Remitente', $data);
  }

  function modificaDatos($data,$idRem)
  { 
    $this->db->where('idRemitente', $idRem);
    $this->db->update('Remitente', $data); 
  }

  function modificaestado($data,$idRem){
    $this->db->where('idRemitente', $idRem);
    $this->db->update('Remitente', $data); 
  }

  function modificaestadocliente($data,$idRem){
    $this->db->where('idCliente', $idRem);
    $this->db->update('clientes', $data); 
  }

  function borrarDatos($id)
  { 
    $this->db->where('idRemitente', $id);
    $this->db->delete('Remitente'); 
  }


  function traerEstado()
  {
    return $this->db->query("SELECT * FROM  estados ")->result_array();
  }

  function traerMnunipio($idEstado)
  {
    $this->db->select('municipios.nombreMunicipio,municipios.idMunicipio');
    $this->db->from('municipios');
    $this->db->join('estados','municipios.estado = estados.id_Estado');
    $this->db->where('municipios.estado',$idEstado);
    $query = $this->db->get();
    return $query->result();
  }

  function traerRegion($idMunic)
  {
    $this->db->select('regiones.nombreRegion,regiones.idRegiones');
    $this->db->from('regiones');
    $this->db->join('municipios','regiones.municipio = municipios.idMunicipio');
    $this->db->where('regiones.municipio',$idMunic);
    $query = $this->db->get();
    return $query->result();
  }

  function cuentaTodosRemitentes()
  {
      return $this->db->get('Remitente')->num_rows();
  }

  function allRemitentes($limit,$start,$col,$dir)
  {
      $query=$this->db->select("*")
          ->from("Remitente")
          ->limit($limit,$start)
          ->order_by($col,$dir)
          ->get();

      if($query->num_rows()>0)
      {
          return $query->result_array();
      }
      else
      {
          return null;
      }
  }

  function busquedaRemitente($limit,$start,$search,$col,$dir)
    {
        $query = $this->db->select("*")
            ->from("Remitente")
            ->like('nombreRem',$search)
            ->or_like('claveRem',$search)
            ->or_like('calleRem',$search)
            ->or_like('EmailRem',$search)
            ->or_like('especialidadRem',$search)
            ->limit($limit,$start)
            ->order_by($col,$dir)
            ->get();


        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    function cuentaRemitenteFiltrados($search)
    {
        $query = $this
            ->db
            ->like('nombreRem',$search)
            ->or_like('claveRem',$search)
            ->or_like('calleRem',$search)
            ->or_like('EmailRem',$search)
            ->or_like('especialidadRem',$search)
            ->get('Remitente');

        return $query->num_rows();
    }

    function remitente()
    {
        return $this->db->query("SELECT * FROM Remitente")->result_array();
    }
}


?>