<?php
class DeudoresClientes extends CI_Model
{
    public $variable;
    function __construct()
    {
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM Estudio")->row_array();
        return $query['row'];
    }


    function getDatos($no_page)
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
    function getClientesPorNombre($like)
    {
        return $this->db->query("SELECT * FROM clientes WHERE nombreCliente LIKE \"%$like%\" LIMIT 10")->result();
    }
    function getToti()
    {
        return $this->db->query("SELECT COUNT(idCita) AS tot FROM `citas` WHERE `statusPago` = 0 ")->result_array();
    }
    function getNombreCliente($idDeudo)
    {
        return $this->db->query("SELECT clientes.idCliente, clientes.nombreCliente FROM `deudoresClientes` JOIN clientes ON clientes.idCliente=deudoresClientes.idCliente WHERE deudoresClientes.idDeudorCliente = $idDeudo;")->result_array();
    }
    function getFechaAdeudo($idDeudor)
    {
        return $this->db->query("SELECT * FROM deudoresClientes WHERE idDeudorCliente=$idDeudor;")->row_array();
    }
    function getEmpresas()
    {
        return $this->db->query("SELECT idEmpresa, nombreEmpresa FROM Empresas")->result_array();
    }
    function filtrar($condicion)
    {
        return $this->db->query("SELECT citas.idCita, citas.fechaCita, Pacientes.nombrePaci, Estudio.nombreEstudio, Estudio.indicacionesPaciente, citas.idEstudio,citas.factura,citas.tipoCitaa,clientes.idCliente,citas.idPaciente FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente 
 JOIN Estudio ON citas.idEstudio = Estudio.IdEstudio JOIN clientes ON Pacientes.cliente = clientes.idCliente $condicion")->result_array();
    }
    function filtrarCaja($condicion)
    {
        return $this->db->query("SELECT Pacientes.idPaciente ,citas.idCita, citas.fechaCita, Pacientes.nombrePaci, Estudio.nombreEstudio, Estudio.indicacionesPaciente, citas.idEstudio,citas.factura,citas.tipoCitaa,clientes.idCliente,citas.idPaciente FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente 
 JOIN Estudio ON citas.idEstudio = Estudio.IdEstudio JOIN clientes ON Pacientes.cliente = clientes.idCliente $condicion and citas.tipoCitaa=8 and citas.statusPago=0")->result_array();
    }
    function getDeudita($idAdeudo)
    {
        return $this->db->query("SELECT citaAdeudo.idControl,Pacientes.idPaciente,citas.idEstudio,citaAdeudo.*,citas.fechaCita,Pacientes.nombrePaci,Estudio.nombreEstudio,citas.tipoCitaa,citaAdeudo.faltaPago  FROM citas join citaAdeudo on citas.idCita=citaAdeudo.idCita join Pacientes on Pacientes.idPaciente=citas.idPaciente join Estudio on Estudio.IdEstudio=citas.idEstudio  join deudores on deudores.idDeudor=citaAdeudo.idAdeudo where deudores.idDeudor=$idAdeudo and citas.statusPago=2")->result_array();
    }
    function getDatFactudeudor($idCo)
    {
        return $this->db->query("SELECT SUM(abono) as sumado from pagos where idAdeudacita=$idCo")->result_array();
//         return $this->db->query("SELECT citaAdeudo.idControl
// FROM citaAdeudo
// WHERE  EXISTS (SELECT pagos.idAdeudacita FROM pagos WHERE pagos.idAdeudacita=citaAdeudo.idControl and citaAdeudo.idControl=$idCo)")->row();
    }
    function modDatosFiscales($dataP, $idPaciMod)
    {
        $this->db->where('idPaciente', $idPaciMod);
        $this->db->update('Pacientes', $dataP);
    }
    function generarAdeudoListado($idAdeudaCita, $fecha, $aPagar, $idUser)
    {

        $this->db->insert('pagos', array('idAdeudacita' => $idAdeudaCita, 'abono' => $aPagar, 'fechaPago'=> $fecha,'idUser'=> $idUser));
        //return $this->db->insert_id();
    }
    function obtenerAdeudoCliente($idCliente, $fecha, $numeroCita, $faltaPagar)
    {
        $adeudo=$this->db->query("SELECT cAC.* FROM deudoresClientes JOIN citaAdeudoCliente cAC on deudoresClientes.idDeudorCliente = cAC.idAdeudo JOIN citas c on cAC.idCita = c.idCita WHERE YEAR(fechaPago)=YEAR('$fecha') AND 
        MONTH(fechaPago)=MONTH('$fecha') AND DAY(fechaPago)=DAY('$fecha') AND idCliente='$idCliente' AND cAC.idCita=$numeroCita")->row_array();

        return $adeudo['idControl'];
    }
    function getDatF($idEst)
    {
        return $this->db->query("SELECT * from Estudio where IdEstudio=$idEst")->row();
    }
    function getPrecioClien($idCita,$idCliente)
    {
        //return $this->db->query("SELECT precio as precioPublico from preciocliente where IdEstudio=$idEst and Idcliente = $idCliente")->row();

        return $this->db->query("SELECT citas.idCita, Pacientes.nombrePaci, Estudio.nombreEstudio, citas.idEstudio, clientes.idCliente, (C2.faltaPago - COALESCE(SUM(pC.abono), 0)) as precioPublico, citas.tipoCitaa, Doctores.nombreDoc, citas.prioridad, Salas.nombre, citas.statusProceso, citas.statusPago FROM citas JOIN Pacientes ON citas.idPaciente = Pacientes.idPaciente JOIN clientes ON Pacientes.cliente = clientes.idCliente JOIN Estudio ON citas.idEstudio = Estudio.idEstudio JOIN Doctores ON citas.idMedico = Doctores.idDoctor JOIN Salas ON Salas.idSala = citas.idSala JOIN citaAdeudoCliente C2 on citas.idCita = C2.idCita JOIN deudoresClientes C on C2.idAdeudo = C.idDeudorCliente LEFT JOIN pagosClientes pC on C2.idControl = pC.idAdeudacita where citas.idCita = $idCita and citas.tipoCitaa = $idCliente ORDER by citas.prioridad desc, citas.fechaCita desc;")->row();
    }
    function filtrarEstF($condicion)//
    {
        return $this->db->query("SELECT citas.idCita, citas.fechaCita, Pacientes.nombrePaci, Estudio.nombreEstudio, Estudio.indicacionesPaciente, citas.idEstudio,citas.factura,citas.tipoCitaa,clientes.idCliente,citas.idPaciente FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente 
 JOIN Estudio ON citas.idEstudio = Estudio.IdEstudio JOIN clientes ON Pacientes.cliente = clientes.idCliente $condicion")->result_array();
    }
    function getDatFactu($idPac)
    {
        return $this->db->query("SELECT * from Pacientes where idPaciente=$idPac")->row();
    }
    function getDeudores()
    {
        return $this->db->query("SELECT deudoresClientes.*, clientes.nombreCliente, (SELECT SUM(citaAdeudoCliente.faltaPago) FROM citaAdeudoCliente JOIN deudoresClientes d on citaAdeudoCliente.idAdeudo = d.idDeudorCliente JOIN citas c2 on citaAdeudoCliente.idCita = c2.idCita WHERE d.idDeudorCliente = deudoresClientes.idDeudorCliente AND c2.statusPago=2 ) as deudaTotal, (SELECT SUM(pagosClientes.abono) FROM pagosClientes JOIN citaAdeudoCliente Adeudo on pagosClientes.idAdeudacita = Adeudo.idControl JOIN deudoresClientes dC ON Adeudo.idAdeudo = dC.idDeudorCliente JOIN citas c3 on Adeudo.idCita = c3.idCita WHERE dC.idDeudorCliente = deudoresClientes.idDeudorCliente AND Adeudo.idControl=cA.idControl)       as pagoTotal FROM deudoresClientes JOIN citaAdeudoCliente cA on deudoresClientes.idDeudorCliente = cA.idAdeudo JOIN citas c on cA.idCita = c.idCita JOIN clientes on deudoresClientes.idCliente = clientes.idCliente LEFT JOIN pagosClientes p2 on cA.idControl = p2.idAdeudacita WHERE c.statusPago = 2 GROUP BY idDeudorCliente;")->result_array();
    }
    function insertarPago($data)
    {
        $this->db->insert('facturacionCaja', $data);
    }
    function insertarAbono($data)
    {
        $this->db->insert('pagosClientes', $data);
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
    function insertDatosFacturaPuente($data)
    {
        $this->db->insert('FacturacionCita', $data);
    }
    function getDatoCliente($idCliente)
    {
        return $this->db->query("SELECT clientes.nombreCliente, clientes.direccionCliente, clientes.rfc, clientes.telefono, regiones.nombreRegion as colonia, municipios.nombreMunicipio as municipio, estados.nombreEstado as estado FROM clientes JOIN regiones ON regiones.idRegiones = clientes.Colonia JOIN municipios ON clientes.municipio=municipios.idMunicipio JOIN estados ON estados.id_Estado=municipios.estado WHERE clientes.idCliente=$idCliente;")->row_array();
    }


}


?>