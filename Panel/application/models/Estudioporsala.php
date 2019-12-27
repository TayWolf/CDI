<?php
class Estudioporsala extends CI_Model
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

    function traerLista($condicion)
    {

        return $this->db->query("SELECT citas.observacionesPaciente,Doctores.nombreDoc,Remitente.nombreRem,citas.idCita,citas.fechaCita, citas.horarioCita,citas.horaTerminada,Salas.nombre as Sala, Estudio.nombreEstudio,Pacientes.nombrePaci,Pacientes.edadPaci,usuarios.nombreUser FROM `citas` join Pacientes on Pacientes.idPaciente=citas.idPaciente join usuarios on usuarios.idUser=citas.idUser JOIN Estudio on Estudio.IdEstudio=citas.idEstudio JOIN Doctores on Doctores.idDoctor=citas.idMedico join Remitente on Remitente.idRemitente=Pacientes.remitente JOIN Salas ON citas.idSala=Salas.idSala $condicion ORDER BY `citas`.`fechaCita` DESC, citas.horarioCita ASC")->result_array();
    }
    function traerListaEntrega($condicion)
    {
     // echo "entra cond $condicion";
        return $this->db->query("SELECT citas.folioCita, citas.observacionesPaciente, entregaResultado.idEntrega, entregaResultado.fechacaptura, entregaResultado.horaEntrega, entregaResultado.recibeEstudio, entregaResultado.interpretacion, entregaResultado.elaborado, entregaResultado.entrega,citas.idCita, Pacientes.nombrePaci, Estudio.nombreEstudio, citas.idEstudio, clientes.idCliente,(SELECT CASE WHEN citas.tipoCitaa!=8
                                    THEN
                                      (SELECT CASE WHEN clientes.precioEspecial=1
                                        THEN (SELECT (CASE WHEN COUNT(precio)=0
                                          THEN
                                            (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)
                                          ELSE
                                            (SELECT precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)
                                          END) as precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)
                                        ELSE
                                          (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)
                                        END)
                                    ELSE
                                      (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)
                                        END)
                                   as precio,
                                citas.tipoCitaa, clientes.nombreCliente,citas.horarioCita, Doctores.nombreDoc, citas.prioridad, Salas.nombre, citas.statusPago 
                                FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente
                                LEFT JOIN entregaResultado ON citas.idCita  = entregaResultado.idCita
                                JOIN clientes ON Pacientes.cliente=clientes.idCliente
                                JOIN Estudio ON citas.idEstudio=Estudio.idEstudio
                                JOIN Doctores ON citas.idMedico=Doctores.idDoctor
                                JOIN Salas ON Salas.idSala=citas.idSala 
                                $condicion
                                GROUP BY citas.idCita ORDER by citas.prioridad desc, citas.fechaCita desc")->result_array(); // WHERE idEntrega IS NULL || IS NOT NULL 
    }

    function insertaDatosEnte($data)
    {
        $this->db->insert('entregaResultado', $data);
        //echo json_encode($data);
    }

    function insertarDatoConfirma($data)
    {
        $this->db->insert('confirmarCita', $data);
        //echo json_encode($data);
    }

    function updateStatusCita($array, $idCita)
    {
        $this->db->where("idCita", $idCita);
        $this->db->update("citas", $array);
    }

    function borrarDatosEntr($idCi,$tip)
    {   
        $this->db->where('idCita', $idCi);
        $this->db->where('tipo', $tip);
        $this->db->delete('entregaResultado'); 
    }

    function eliminarCon($idCi)
    {
      $this->db->where('idCita', $idCi);
        $this->db->delete('confirmarCita'); 
    }

    function traerListaTodo()
    {   
        // $this->db->select("Doctores.nombreDoc,Remitente.nombreRem,citas.idCita,citas.fechaCita, citas.horarioCita,citas.horaTerminada,Salas.nombre as Sala, Estudio.nombreEstudio,Pacientes.nombrePaci,Pacientes.edadPaci,usuarios.nombreUser, citas.statusProceso");
        // $this->db->from("citas");
        // $this->db->join("Pacientes", "Pacientes.idPaciente=citas.idPaciente");
        // $this->db->join("usuarios", "usuarios.idUser=citas.idUser");
        // $this->db->join("Estudio", "Estudio.IdEstudio=citas.idEstudio");
        // $this->db->join("Doctores", "Doctores.idDoctor=citas.idMedico");
        // $this->db->join("Remitente", "Remitente.idRemitente=Pacientes.remitente");
        // $this->db->join("Salas", "citas.idSala=Salas.idSala");
        // return $this->db->get()->result_array();
        
        return $this->db->query("SELECT citas.observacionesPaciente, Doctores.nombreDoc,Remitente.nombreRem,citas.idCita,citas.fechaCita, citas.horarioCita,citas.horaTerminada,Salas.nombre as Sala, Estudio.nombreEstudio,Pacientes.nombrePaci,Pacientes.edadPaci,usuarios.nombreUser, citas.statusProceso from citas join Pacientes on Pacientes.idPaciente=citas.idPaciente join usuarios on usuarios.idUser=citas.idUser join Estudio on Estudio.IdEstudio=citas.idEstudio join Doctores on Doctores.idDoctor=citas.idMedico join Remitente on Remitente.idRemitente=Pacientes.remitente join Salas on citas.idSala=Salas.idSala ORDER BY `citas`.`fechaCita` DESC, citas.horarioCita ASC ")->result_array();
    }

    function traerListaTodoComplementaria($array)
    {   
        $this->db->select("Doctores.nombreDoc,Remitente.nombreRem,citas.idCita,citas.fechaCita, citas.horarioCita,citas.horaTerminada,Salas.nombre as Sala, Estudio.nombreEstudio,Pacientes.nombrePaci,Pacientes.edadPaci,usuarios.nombreUser");
        $this->db->from("citas");
        $this->db->join("Pacientes", "Pacientes.idPaciente=citas.idPaciente");
        $this->db->join("usuarios", "usuarios.idUser=citas.idUser");
        $this->db->join("Estudio", "Estudio.IdEstudio=citas.idEstudio");
        $this->db->join("Doctores", "Doctores.idDoctor=citas.idMedico");
        $this->db->join("Remitente", "Remitente.idRemitente=Pacientes.remitente");
        $this->db->join("Salas", "citas.idSala=Salas.idSala");
        $this->db->where_in("Estudio.idCat", $array);
        return $this->db->get()->result_array();
    }

    function getConfirma($idCita)
    {
      return $this->db->query("select * from confirmarCita where idCita=$idCita")->row();
    }

    function traerExistenc($idCita,$tip)
    {
        return $this->db->query("select entregaResultado.*, usuarios.nombreUser from entregaResultado JOIN usuarios on usuarios.idUser=entregaResultado.idUser where idCita=$idCita and tipo = $tip")->row();
    }

    function traerListaTodoEntrega()
    {
        return $this->db->query("SELECT citas.idCita, Pacientes.nombrePaci, Estudio.nombreEstudio, citas.idEstudio, clientes.idCliente,
                                  (SELECT CASE WHEN citas.tipoCitaa!=8
                                    THEN
                                      (SELECT CASE WHEN clientes.precioEspecial=1
                                        THEN (SELECT (CASE WHEN COUNT(precio)=0
                                          THEN
                                            (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)
                                          ELSE
                                            (SELECT precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)
                                          END) as precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)
                                        ELSE
                                          (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)
                                        END)
                                    ELSE
                                      (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)
                                        END)
                                   as precio,
                                citas.tipoCitaa, Doctores.nombreDoc, citas.prioridad, Salas.nombre
                                FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente
                                JOIN clientes ON Pacientes.cliente=clientes.idCliente
                                JOIN Estudio ON citas.idEstudio=Estudio.idEstudio
                                JOIN Doctores ON citas.idMedico=Doctores.idDoctor
                                JOIN Salas ON Salas.idSala=citas.idSala 
                                ORDER by citas.prioridad DESC, citas.fechaCita DESC, statusProceso ASC")->result_array();
    }

  function getAreas($array)
  {
    return $this->db->query("SELECT * FROM `Salas` ")->result_array();
  }

   function verificAPassword($password)
  {
    return $this->db->query("SELECT * FROM `Contrasenas` WHERE `contrasena` = '$password' and permiso = 1 ")->result_array();
  }


  function getAreasComplementaria($array)
  { 
      $this->db->select("Salas.*");
      $this->db->from("citas");
      $this->db->join("Estudio", "citas.idEstudio = Estudio.IdEstudio");
      $this->db->join("Salas", "citas.idSala = Salas.idSala");
      $this->db->where_in("Estudio.idCat", $array);
      $this->db->group_by("Salas.idSala");
      return $this->db->get()->result_array();
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
	function updatePrioridad($idCita, $valorPrioridad)
    {
        $this->db->where('idCita', $idCita);
        $this->db->update("citas",array('prioridad' => $valorPrioridad));
    }
    function actualizarEntregaResultado($idCita,$arreglo){
        $this->db->where('idCita',$idCita);
        $this->db->update('entregaResultado',$arreglo);
    }
    function verificarEntregaResultado($idCita)
    {
        return $this->db->query("SELECT * FROM entregaResultado WHERE idCita=$idCita")->row_array();
    }
    function insertarEntregaResultado($idCita, $data)
    {
        $query=$this->db->query("SELECT * FROM entregaResultado WHERE idCita=$idCita")->num_rows();
        if($query==0)
        {
            $this->db->insert("entregaResultado", $data);
        }
    }
    function borrarPosteriores($idCita, $statusProceso)
    {
        //invalida los status que no son necesarios
        $this->db->where("idCita", $idCita);
        $this->db->where("status>", $statusProceso);
        $this->db->update("CambioStatusCita", array('validez' => 0));
        return $this->db->query("SELECT * FROM CambioStatusCita WHERE validez=1 AND idCita=$idCita AND status=$statusProceso")->row_array();
    }
    function insertarHistoricoStatus($historico)
    {
        $this->db->insert("CambioStatusCita", $historico);
    }
    function cambiarStatusProceso($data, $idCita)
    {
        $this->db->where("idCita", $idCita);
        $this->db->update("citas", $data);
    }
}


?>