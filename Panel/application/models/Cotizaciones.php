<?php
class Cotizaciones extends CI_Model
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

  function getDatosRemitente()
  {
    return $this->db->get("Remitente")->result_array();
  }

	function getDatos()
	{
		return $this->db->query("SELECT * FROM Doctores ")->result_array();  	
	}

  function getIdCoti()
  {
    
    
    return $this->db->query("SELECT * FROM cotizaciones ORDER BY `cotizaciones`.`idcotizacion` DESC")->row();
      
  }

  
  function traerNombres($Estudio)
  {
    return $this->db->query("SELECT * FROM Estudio where IdEstudio = $Estudio")->row();
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

    function getNombreCliente($cli)
    {
      $this -> db -> select('nombreCliente');
      $this->db->from('clientes');
      $this->db->where('idCliente',$cli);
      $query = $this->db->get();
      return $query->result_array();
    }
    
  

     function insertaDatos($data)
    {
      $this->db->insert('citas', $data);
    }

    function updatecitas($data,$idcita)
    { 
      $this->db->where('idCita', $idcita);
      $this->db->update('citas', $data); 
    }

       function obtenerDatosCliente($nombre)

    { 
        $this-> db ->like('nombrePaci',$nombre,'both');
        return $this-> db ->get('Pacientes')->result();
       // return $this->db->query("SELECT * FROM `Pacientes` WHERE `nombrePaci` like '%$nombre%' ")->result_array();
    }

       function obtenerDatosEstudio($Estudio)

    { 
        $this->db->like('nombreEstudio',$Estudio,'both');
        return $this->db->get('Estudio')->result();
       // return $this->db->query("SELECT * FROM `Pacientes` WHERE `nombrePaci` like '%$nombre%' ")->result_array();
    }

     function getListaCitas($idsala,$fecha,$estudio)

    { 
        return $this->db->query("SELECT usuarios.nombreUser,citas.idCita,citas.fechaCita, Pacientes.nombrePaci,Salas.nombre,Estudio.duracion,Estudio.nombreEstudio,citas.horarioCita, citas.horaTerminada, citas.orden_medica, citas.urgencia FROM `citas` join Pacientes on Pacientes.idPaciente=citas.idPaciente join Salas on Salas.idSala=citas.idSala  join Estudio on Estudio.IdEstudio=citas.idEstudio join usuarios on usuarios.idUser=citas.idUser WHERE Salas.idSala=$idsala and citas.fechaCita='$fecha' and citas.idEstudio = $estudio order by citas.horarioCita asc")->result_array();
    }

   

    function gettodosEstudios()
    {
      return $this->db->query("SELECT * FROM Estudio ORDER BY rand() limit 10 ")->result_array();
    }

    ////////
    function getEstudiosXcliente($cliente)
    {
      return $this->db->query("SELECT Estudio.*, preciocliente.precio FROM Estudio JOIN preciocliente on preciocliente.IdEstudio = Estudio.IdEstudio JOIN clientes on clientes.idCliente = preciocliente.Idcliente where clientes.idCliente = $cliente")->result_array();
    }

    function gettodasCotizaciones()
    {
      return $this->db->query("SELECT cotizacionEstudio.*, Estudio.* FROM cotizacionEstudio join Estudio on cotizacionEstudio.idEstudio = Estudio.IdEstudio")->result_array();
    }

    function getSalas()
    {
      return $this->db->query("SELECT * FROM Salas")->result_array();
    }

    function getClientes()
    {
      return $this->db->query("SELECT * FROM clientes")->result_array();
    }
    
    function getClienteXidPaciente($idPac)
    {
      return $this->db->query("SELECT clientes.* FROM clientes JOIN Pacientes on Pacientes.cliente = clientes.idCliente where Pacientes.idPaciente = $idPac")->result_array();
    }

    function getDuracion($idE)
    {
      return $this->db->query("SELECT Estudio.duracion FROM Estudio where Estudio.IdEstudio = $idE")->result_array();
    }

    function getnoDispo($idE,$idS,$fecha)
    {
      return $this->db->query("SELECT * from citas where idEstudio = $idE and idSala = $idS and fechaCita = '$fecha' ORDER BY horarioCita  ASC")->result_array();
    }

    function getProxnoDispo($idE,$idS,$fecha,$hora)
    {
      return $this->db->query("SELECT * from citas where idEstudio = $idE and idSala = $idS and fechaCita = '$fecha' and horarioCita like '$hora%' ORDER BY horarioCita  ASC")->result_array();
    }

    function getProxnoDispoUrgencia($idE,$idS,$fecha,$hora)
    {
      return $this->db->query("SELECT * from citas where idEstudio = $idE and idSala = $idS and fechaCita = '$fecha' and horarioCita like '$hora%' ORDER BY horarioCita  ASC")->result_array();
    }

    function getUrgencianoDispo($idE,$idS,$fecha)
    {
      return $this->db->query("SELECT * from citas where idEstudio = $idE and idSala = $idS and fechaCita = '$fecha' and urgencia = 1 ORDER BY horarioCita  ASC")->result_array();
    }

    function getHora($idE)
    {
      return $this->db->query("SELECT * FROM Estudio where idEstudio=$idE ")->result_array();
    }
    
    

    function getEstudios($estudio)
    {
      return $this->db->query("SELECT * FROM Estudio WHERE nombreEstudio like  '%$estudio%' or indicacionesPaciente like '%$estudio%' limit 10 ")->result_array();
    }


    function insertaDatosR($datad)
    {
      $this->db->insert('cotizaciones', $datad);
    //echo json_encode($data);
    }

    function idComunicado()
    { 
      $this -> db -> select('*'); 
      $this -> db -> from('cotizaciones');
      $query = $this -> db -> get();
      return $query->result_array();      
    }

    function insertaDatosPuent($dataPue)
    {
      $this->db->insert('cotizacionEstudio', $dataPue);
      //echo json_encode($data);
    }

    function getCotizaciones($idcot)
    {
      return $this->db->query("SELECT Estudio.nombreEstudio, cotizacionEstudio.* FROM Estudio join cotizacionEstudio on Estudio.idEstudio = cotizacionEstudio.IdEstudio join cotizaciones on cotizacionEstudio.idcotizacion = cotizaciones.idcotizacion WHERE cotizacionEstudio.idcotizacion = $idcot")->result_array();
    }


}


?>