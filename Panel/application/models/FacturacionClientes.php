<?php
class FacturacionClientes extends CI_Model
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

    function getClientesPorNombre($like)
    {
        return $this->db->query("SELECT * FROM clientes WHERE nombreCliente LIKE \"%$like%\" LIMIT 10")->result();
    }
    function tablaCliente($idCliente)
    {
        return $this->db->query("SELECT citas.idCita, citas.fechaCita, Pacientes.nombrePaci, Estudio.nombreEstudio, Estudio.indicacionesPaciente
 FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente 
 JOIN Estudio ON citas.idEstudio = Estudio.IdEstudio JOIN clientes ON Pacientes.cliente = clientes.idCliente WHERE nombreCliente='$idCliente'")->result_array();
    }

    function getToti()
    {
        return $this->db->query("SELECT COUNT(idCita) AS tot FROM `citas` WHERE `statusPago` = 0 ")->result_array();
    }

    function getPacientes()
    {
        return $this->db->query("SELECT Pacientes.idPaciente, Pacientes.nombrePaci FROM Pacientes JOIN citas ON Pacientes.idPaciente=citas.idPaciente GROUP BY idPaciente")->result_array();
    }
    function getPacientesFiltrados($like)
    {
        return $this->db->query('SELECT Pacientes.idPaciente, Pacientes.nombrePaci FROM Pacientes JOIN citas ON Pacientes.idPaciente=citas.idPaciente WHERE Pacientes.nombrePaci LIKE "%'.$like.'%" GROUP BY idPaciente')->result_array();
    }
    function getEmpresas()
    {
        return $this->db->query("SELECT idEmpresa, nombreEmpresa FROM Empresas")->result_array();
    }
    function filtrar($condicion)
    {
        return $this->db->query("SELECT citas.idCita,citas.folioCita, citas.fechaCita, Pacientes.nombrePaci, Estudio.nombreEstudio, Estudio.indicacionesPaciente, Estudio.idEmpresa as empresaFacturadora, citas.idEstudio,citas.factura,citas.tipoCitaa,clientes.idCliente,citas.idPaciente, (SELECT CASE WHEN citas.tipoCitaa != 8 THEN (SELECT CASE WHEN clientes.precioEspecial = 1 THEN (SELECT (CASE WHEN COUNT(preciocliente.precio) = 0 THEN (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio = citas.idEstudio) ELSE (SELECT preciocliente.precio FROM preciocliente WHERE preciocliente.idEstudio = Estudio.IdEstudio AND preciocliente.Idcliente = clientes.idCliente) END) as precio FROM preciocliente WHERE preciocliente.idEstudio = Estudio.IdEstudio AND preciocliente.Idcliente = clientes.idCliente) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio = citas.idEstudio) END) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio = citas.idEstudio) END) as precioPublico FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente JOIN Estudio ON citas.idEstudio = Estudio.IdEstudio JOIN clientes ON Pacientes.cliente = clientes.idCliente $condicion and citas.cancelar!=1 ORDER BY citas.idCita DESC")->result_array();
    }
    function filtrarCaja($condicion)
    {
        return $this->db->query("SELECT citas.idCita,citas.folioCita, citas.fechaCita, Pacientes.nombrePaci, Estudio.nombreEstudio, Estudio.indicacionesPaciente, Estudio.idEmpresa as empresaFacturadora, citas.idEstudio,citas.factura,citas.tipoCitaa,clientes.idCliente,citas.idPaciente FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente 
 JOIN Estudio ON citas.idEstudio = Estudio.IdEstudio JOIN clientes ON Pacientes.cliente = clientes.idCliente $condicion and citas.tipoCitaa=8 and citas.statusPago=0 ORDER BY `citas`.`idCita` DESC")->result_array();
    }

    function modDatosFiscales($dataP, $idPaciMod)
    {
        $this->db->where('idPaciente', $idPaciMod);
        $this->db->update('Pacientes', $dataP);
    }

    function filtrarEst($condicion)
    {
        return $this->db->query("SELECT DISTINCT Estudio.nombreEstudio, Estudio.IdEstudio
 FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente 
 JOIN Estudio ON citas.idEstudio = Estudio.IdEstudio JOIN clientes ON Pacientes.cliente = clientes.idCliente $condicion")->result_array();
    }

    function filtrarEstF($condicion)//aqui
    {
        return $this->db->query("SELECT citas.idCita, citas.fechaCita,citas.folioCita, Pacientes.nombrePaci, Estudio.nombreEstudio, Estudio.indicacionesPaciente, Estudio.idEmpresa as empresaFacturadora, citas.idEstudio,citas.factura,citas.tipoCitaa,clientes.idCliente,citas.idPaciente, (SELECT CASE WHEN citas.tipoCitaa != 8 THEN (SELECT CASE WHEN clientes.precioEspecial = 1 THEN (SELECT (CASE WHEN COUNT(preciocliente.precio) = 0 THEN (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio = citas.idEstudio) ELSE (SELECT preciocliente.precio FROM preciocliente WHERE preciocliente.idEstudio = Estudio.IdEstudio AND preciocliente.Idcliente = clientes.idCliente) END) as precio FROM preciocliente WHERE preciocliente.idEstudio = Estudio.IdEstudio AND preciocliente.Idcliente = clientes.idCliente) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio = citas.idEstudio) END) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio = citas.idEstudio) END) as precioPublico FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente JOIN Estudio ON citas.idEstudio = Estudio.IdEstudio JOIN clientes ON Pacientes.cliente = clientes.idCliente $condicion and citas.cancelar!=1 ORDER BY citas.idCita DESC")->result_array();
    }

    function filtrarEstFCaja($condicion)//
    {
        return $this->db->query("SELECT citas.idCita, citas.fechaCita, Pacientes.nombrePaci, Estudio.nombreEstudio, Estudio.indicacionesPaciente, Estudio.idEmpresa as empresaFacturadora, citas.idEstudio,citas.factura,citas.tipoCitaa,clientes.idCliente,citas.idPaciente FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente 
 JOIN Estudio ON citas.idEstudio = Estudio.IdEstudio JOIN clientes ON Pacientes.cliente = clientes.idCliente $condicion and citas.tipoCitaa=8 and citas.statusPago=0")->result_array();
    }

    function getDatF($idEst)
    {
        return $this->db->query("SELECT * from Estudio where IdEstudio=$idEst")->row();
    }


    function getPrecioClien($idEst,$idCliente)
    {
        //return $this->db->query("SELECT precio as precioPublico from preciocliente where IdEstudio=$idEst and Idcliente = $idCliente")->row();

        return $this->db->query("SELECT citas.idCita, Pacientes.nombrePaci, Estudio.nombreEstudio, citas.idEstudio, clientes.idCliente,
                                  (SELECT CASE WHEN citas.tipoCitaa != 8 THEN (SELECT CASE WHEN clientes.precioEspecial = 1 THEN (SELECT (CASE WHEN COUNT(preciocliente.precio) = 0 THEN (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio = citas.idEstudio) ELSE (SELECT preciocliente.precio FROM preciocliente WHERE preciocliente.idEstudio = Estudio.IdEstudio AND preciocliente.Idcliente = clientes.idCliente) END) as precio FROM preciocliente WHERE preciocliente.idEstudio = Estudio.IdEstudio AND preciocliente.Idcliente = clientes.idCliente) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio = citas.idEstudio) END) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio = citas.idEstudio) END) as precioPublico, 
                                citas.tipoCitaa, Doctores.nombreDoc, citas.prioridad, Salas.nombre, citas.statusProceso, citas.statusPago
                                FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente
                                JOIN clientes ON Pacientes.cliente=clientes.idCliente
                                JOIN Estudio ON citas.idEstudio=Estudio.idEstudio
                                JOIN Doctores ON citas.idMedico=Doctores.idDoctor
                                JOIN Salas ON Salas.idSala=citas.idSala where citas.idEstudio=$idEst and citas.tipoCitaa = $idCliente
                                ORDER by citas.prioridad desc, citas.fechaCita desc")->row();
    }

    function getDatFactu($idPac)
    {
        return $this->db->query("SELECT * from Pacientes where idPaciente=$idPac")->row();
    }

    function insertarPago($data)
    {
        $this->db->insert('facturacionCaja', $data);
    }

    function UpdateCitas($data,$idCita)
    {
        $this->db->where('idCita', $idCita);
        $this->db->update('citas', $data);
    }
    function insertarDatosFactura($data)
    {
        $this->db->insert('facturacionCaja', $data);
        return $this->db->insert_id();
    }
    function insertarFactura($data)
    {
        $this->db->insert('Facturacion', $data);
        return $this->db->insert_id();
    }
    function insertarFacturaClientes($data)
    {
        $this->db->insert('FacturacionClientes', $data);
        return $this->db->insert_id();
    }
    function insertDatosFacturaPuente($data)
    {
        $this->db->insert('FacturacionCita', $data);
    }
    function insertDatosFacturaClientePuente($data)
    {
        $this->db->insert('FacturacionClientesCita', $data);
    }
    function generarAdeudo($idPaciente, $fecha, $numeroCita, $faltaPagar)
    {
        $adeudo=$this->db->query("SELECT * FROM deudores WHERE YEAR(fechaPago)=YEAR('$fecha') AND MONTH(fechaPago)=MONTH('$fecha') AND DAY(fechaPago)=DAY('$fecha') AND idPaciente='$idPaciente'")->row_array();
        $idAdeudo=0;
        if(empty($adeudo))
        {
            $this->db->insert('deudores', array('idPaciente' => $idPaciente, 'fechaPago' => $fecha));
            $idAdeudo=$this->db->insert_id();
        }
        else
            $idAdeudo=$adeudo["idDeudor"];
        $this->db->insert('citaAdeudo', array('idCita' => $numeroCita, 'idAdeudo' => $idAdeudo, 'faltaPago'=> $faltaPagar));
        return $this->db->insert_id();
    }
    function generarAdeudoCliente($idCliente, $fecha, $numeroCita, $faltaPagar)
    {
        $adeudo=$this->db->query("SELECT * FROM deudoresClientes WHERE YEAR(fechaPago)=YEAR('$fecha') AND 
        MONTH(fechaPago)=MONTH('$fecha') AND DAY(fechaPago)=DAY('$fecha') AND idCliente='$idCliente'")->row_array();
        $idAdeudo=0;
        if(empty($adeudo))
        {
            $this->db->insert('deudoresClientes', array('idCliente' => $idCliente, 'fechaPago' => $fecha));
            $idAdeudo=$this->db->insert_id();
        }
        else
            $idAdeudo=$adeudo["idDeudorCliente"];
        $this->db->insert('citaAdeudoCliente', array('idCita' => $numeroCita, 'idAdeudo' => $idAdeudo, 'faltaPago'=> $faltaPagar));
        return $this->db->insert_id();
    }
    function getDatoCliente($idCliente)
    {
        return $this->db->query("SELECT * FROM clientes WHERE idCliente=$idCliente")->row_array();
    }


}


?>