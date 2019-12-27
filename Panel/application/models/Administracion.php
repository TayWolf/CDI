<?php
class Administracion extends CI_Model
{
    function getAreas()
    {
        return $this->db->query("SELECT * FROM Salas")->result_array();
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

                                citas.tipoCitaa, clientes.nombreCliente,citas.horarioCita, Doctores.nombreDoc, citas.prioridad, Salas.nombre, citas.statusPago, entregaResultado.idEntrega,citas.urgencia, citas.statusProceso

                                FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente

                                LEFT JOIN entregaResultado ON citas.idCita  = entregaResultado.idCita

                                JOIN clientes ON Pacientes.cliente=clientes.idCliente

                                JOIN Estudio ON citas.idEstudio=Estudio.idEstudio

                                JOIN Doctores ON citas.idMedico=Doctores.idDoctor

                                JOIN Salas ON Salas.idSala=citas.idSala $condicion

                                ORDER by citas.prioridad desc, citas.fechaCita desc")->result_array(); // WHERE idEntrega IS NULL || IS NOT NULL
    }
    function traerExistenc($idCita)
    {
        return $this->db->query("select * from entregaResultado where idCita=$idCita")->row();

    }
    function insertaDatosEnte($data)
    {
        $this->db->insert('entregaResultado', $data);
        //echo json_encode($data);
    }
    function updateStatusCita($array, $idCita)
    {
        $this->db->where("idCita", $idCita);
        $this->db->update("citas", $array);
    }
    function updatePrioridad($idCita, $valorPrioridad)
    {
        $this->db->where('idCita', $idCita);
        $this->db->update("citas",array('prioridad' => $valorPrioridad));
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
    function borrarDatosEntr($idCi)
    {
        $this->db->where('idCita', $idCi);
        $this->db->delete('entregaResultado');
    }
    function insertEntregaResultado($data)
    {
        $this->db->insert("entregaResultado", $data);
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