<?php
class Articulos extends CI_Model
{
	public $variable;
	function __construct(){
		parent::__construct();
	}

	function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM articulos")->row_array();
 		return $query['row'];
	}
  public function total()
    {
      return $this->db->query("SELECT count(*) as row FROM articulos")->result_array();
    }

    public function obtenerListaCaduca($idArt)
    {
      return $this->db->query("SELECT * FROM `compraarticulo` WHERE `idArticulo` = $idArt and existenciaAnterior >0")->result_array();
    }

    public function getPassword($password)
    {
      return $this->db->query("SELECT * FROM `Contrasenas` WHERE `contrasena` ='$password' and permiso = 1")->row();
    }

    public function obtenerListaCaducaEntrada($idArt)
    {
      return $this->db->query("SELECT * FROM `entradaArticulo` WHERE `idArticulo` = $idArt and cantidadActual>0")->result_array();
    }

	function getDatos($no_page)
	{
		 $perpage = 20; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{

            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }

		return $this->db->query("SELECT * FROM articulos limit 20 offset $first")->result_array();
     	
	}

  function obtenerDatos()
  {
    return $this->db->query("SELECT * FROM articulos")->result_array();
  }
  function getLineas()
  {
    return $this->db->query("SELECT * FROM linea")->result_array();
  }

  function getProve()
  {
    return $this->db->query("SELECT * FROM Proveedores")->result_array();
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
 
 		$this->pagination->initialize($config);
 		return $this->pagination->create_links();
	}

	function obtenerFicha($idR)
    { 
      $this->db->select('*');
      $this->db->from('articulos');
      $this->db->where('idArticulo',$idR);
      $query = $this->db->get();
      return $query->row();

    }

    function obtenerFichadelete($id)
    { 
      $this->db->select('*');
      $this->db->from('articulos');
      $this->db->where('idArticulo',$id);
      $query = $this->db->get();
      return $query->row();
    }

	function insertaDatos($data)
	{
		$this->db->insert('articulos', $data);
  }

  function obtenerlinedisponibles($i,$actual)
    { 
      return $this->db->query("SELECT * FROM linea WHERE NOT EXISTS (SELECT idLinea FROM articuloLinea where idLinea = $i and idArticulo = $actual) and idLinea = $i")->row();
    }



   function obtenerlinsasignados($i,$actual)
    {
      return $this->db->query("SELECT * FROM linea WHERE EXISTS (SELECT idLinea FROM articuloLinea where idLinea = $i and idArticulo = $actual) and idLinea = $i")->row();
    }

    function obtenerprovedisponibles($i,$actual)
    { 
      return $this->db->query("SELECT * FROM Proveedores WHERE NOT EXISTS (SELECT idProveedor FROM articuloproveedores where idProveedor = $i and idarticulo = $actual) and idProveedor = $i")->row();
    }

    function obtenerProvsasignados($i,$actual)
    {
      return $this->db->query("SELECT * FROM Proveedores WHERE EXISTS (SELECT idProveedor FROM articuloproveedores where idProveedor = $i and idarticulo = $actual) and idProveedor = $i")->row();
    }
  function modificaDatos($data,$idRem)
  { 
    $this->db->where('idArticulo', $idRem);
    $this->db->update('articulos', $data); 
  }

  function borrarDatos($id)
  { 
    $this->db->where('idArticulo', $id);
    $this->db->delete('articulos'); 
  }

  function quitarDatosPuenteLin($idD,$total,$idactual)
    { 
      $this->db->where('idLinea', $idD);
      $this->db->where('idArticulo', $idactual);
      $this->db->delete('articuloLinea'); 
    }

   function insertaDatosPuenteLin($data)
    {
      $this->db->insert('articuloLinea', $data);
    }

    function insertaDatosPuenteProv($data)
    {
      $this->db->insert('articuloproveedores', $data);
    }

    function quitarDatosPuenteProv($idD,$total,$idactual)
    { 
      $this->db->where('idProveedor', $idD);
      $this->db->where('idarticulo', $idactual);
      $this->db->delete('articuloproveedores'); 
    }
}


?>