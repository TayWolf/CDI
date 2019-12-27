<?php
class PacienteEspera extends CI_Model
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

        return $this->db->query("SELECT Doctores.nombreDoc,Remitente.nombreRem,citas.idCita,citas.fechaCita, citas.horarioCita,citas.horaTerminada,Salas.nombre as Sala, Estudio.nombreEstudio,Pacientes.nombrePaci,Pacientes.edadPaci,usuarios.nombreUser FROM `citas` join Pacientes on Pacientes.idPaciente=citas.idPaciente join usuarios on usuarios.idUser=citas.idUser JOIN Estudio on Estudio.IdEstudio=citas.idEstudio JOIN Doctores on Doctores.idDoctor=citas.idMedico join Remitente on Remitente.idRemitente=Pacientes.remitente JOIN Salas ON citas.idSala=Salas.idSala $condicion")->result_array();
    }
    function traerListaEntrega($condicion)
    {

        return $this->db->query("SELECT citas.folioCita, citas.idCita, Pacientes.nombrePaci, Estudio.nombreEstudio, citas.idEstudio, clientes.idCliente,
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
                                citas.tipoCitaa, Doctores.nombreDoc, citas.prioridad,citas.urgencia,citas.horarioCita, Salas.nombre, citas.statusProceso, citas.statusPago
                                FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente
                                JOIN clientes ON Pacientes.cliente=clientes.idCliente
                                JOIN Estudio ON citas.idEstudio=Estudio.idEstudio
                                JOIN Doctores ON citas.idMedico=Doctores.idDoctor
                                JOIN Salas ON Salas.idSala=citas.idSala $condicion
                                ORDER by citas.urgencia desc, citas.fechaCita desc, citas.horarioCita asc, citas.prioridad desc ")->result_array();
    }
    function traerHorariosCambiosCitas($condicion)
    {

        return $this->db->query("SELECT CambioStatusCita.*
                                FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente
                                JOIN clientes ON Pacientes.cliente=clientes.idCliente
                                JOIN Estudio ON citas.idEstudio=Estudio.idEstudio
                                JOIN Doctores ON citas.idMedico=Doctores.idDoctor
                                JOIN Salas ON Salas.idSala=citas.idSala
                                JOIN CambioStatusCita ON CambioStatusCita.idCita=citas.idCita
                                 $condicion 
                                GROUP BY CambioStatusCita.idCita, CambioStatusCita.status, CambioStatusCita.validez
                                ORDER BY CambioStatusCita.validez
                                 ")->result_array();
    }

    function insertaDatosEnte($data)
    {
        $this->db->insert('entregaResultado', $data);
        //echo json_encode($data);
    }

    function borrarDatosEntr($idCi)
    {
        $this->db->where('idCita', $idCi);
        $this->db->delete('entregaResultado');
    }

    function traerListaTodo()
    {

        return $this->db->query("SELECT Doctores.nombreDoc,Remitente.nombreRem,citas.idCita,citas.fechaCita, citas.horarioCita,citas.horaTerminada,Salas.nombre as Sala, Estudio.nombreEstudio,Pacientes.nombrePaci,Pacientes.edadPaci,usuarios.nombreUser FROM `citas` join Pacientes on Pacientes.idPaciente=citas.idPaciente join usuarios on usuarios.idUser=citas.idUser JOIN Estudio on Estudio.IdEstudio=citas.idEstudio JOIN Doctores on Doctores.idDoctor=citas.idMedico join Remitente on Remitente.idRemitente=Pacientes.remitente JOIN Salas ON citas.idSala=Salas.idSala")->result_array();
    }

    function traerExistenc($idCita)
    {

        return $this->db->query("select * from entregaResultado where idCita=$idCita")->row();
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
                                citas.tipoCitaa, Doctores.nombreDoc, citas.prioridad, Salas.nombre, citas.statusProceso
                                FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente
                                JOIN clientes ON Pacientes.cliente=clientes.idCliente
                                JOIN Estudio ON citas.idEstudio=Estudio.idEstudio
                                JOIN Doctores ON citas.idMedico=Doctores.idDoctor
                                JOIN Salas ON Salas.idSala=citas.idSala 
                                ORDER by citas.prioridad desc, citas.fechaCita desc")->result_array();
    }

    function getAreas()
    {

        //return $this->db->query("SELECT * FROM `Salas` ")->result_array();
        return $this->db->query("SELECT * FROM `Salas` ")->result_array();
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
    function cambiarStatusProceso($data, $idCita)
    {
        $this->db->where("idCita", $idCita);
        $this->db->update("citas", $data);
    }
    function insertarHistoricoStatus($historico)
    {
        $this->db->insert("CambioStatusCita", $historico);
    }
    function limpiarHistorialCambios($idCita)
    {
        $this->db->where("idCita", $idCita);
        $this->db->delete("CambioStatusCita");
    }
    function borrarPosteriores($idCita, $statusProceso)
    {
        //invalida los status que no son necesarios
        $this->db->where("idCita", $idCita);
        $this->db->where("status>", $statusProceso);
        $this->db->update("CambioStatusCita", array('validez' => 0));
        return $this->db->query("SELECT * FROM CambioStatusCita WHERE validez=1 AND idCita=$idCita AND status=$statusProceso")->row_array();
    }
    function insertEntregaResultado($data)
    {
        $this->db->insert("entregaResultado", $data);
    }
    function deleteEntregaResultado($idCita)
    {
        $this->db->where("idCita", $idCita);
        $this->db->delete("entregaResultado");
    }
    function verificarExistenciaInterpretacion($idCita)
    {
        return $this->db->query("SELECT * FROM entregaResultado WHERE idCita=$idCita")->row_array();
    }
    function verificarPassword($pass)
    {
        $this->db->select("Contrasenas.contrasena, Contrasenas.permiso");
        $this->db->from("Contrasenas");
        $this->db->where("contrasena", $pass);
        $this->db->where("permiso = 1");
        $verpass = $this->db->get()->result_array();
        
        foreach ($verpass as $password) 
        {
           $contrasena = $password['contrasena'];
           if ($contrasena == $pass) {
               return 1;
           }
        }
        return 0;
    }
}


?>