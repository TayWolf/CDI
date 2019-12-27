<?php
class Deudores extends CI_Model
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
    

    function getToti()
    {
        return $this->db->query("SELECT COUNT(idCita) AS tot FROM `citas` WHERE `statusPago` = 0 ")->result_array();
    }

    function getNombrePaci($idDeudo)
    {
        return $this->db->query("SELECT Pacientes.nombrePaci FROM `deudores` join Pacientes on Pacientes.idPaciente=deudores.idPaciente WHERE deudores.idDeudor=$idDeudo")->result_array();
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
        return $this->db->query("SELECT citas.folioCita,citaAdeudo.idControl,Pacientes.idPaciente,citas.idEstudio,citaAdeudo.*,citas.fechaCita,Pacientes.nombrePaci,Estudio.nombreEstudio,citas.tipoCitaa,citaAdeudo.faltaPago  FROM citas join citaAdeudo on citas.idCita=citaAdeudo.idCita join Pacientes on Pacientes.idPaciente=citas.idPaciente join Estudio on Estudio.IdEstudio=citas.idEstudio  join deudores on deudores.idDeudor=citaAdeudo.idAdeudo where deudores.idDeudor=$idAdeudo and citas.statusPago=2")->result_array();
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

    ////////
    function generarAdeudoListado($idAdeudaCita, $fecha, $aPagar, $idUser)
    {
        
        $this->db->insert('pagos', array('idAdeudacita' => $idAdeudaCita, 'abono' => $aPagar, 'fechaPago'=> $fecha,'idUser'=> $idUser));
        //return $this->db->insert_id();
    }
    ///////

   

    

    function getDatF($idEst)
    {
        return $this->db->query("SELECT * from Estudio where IdEstudio=$idEst")->row();
    }

    
    function getPrecioClien($idEst,$idCliente)
    {
        //return $this->db->query("SELECT precio as precioPublico from preciocliente where IdEstudio=$idEst and Idcliente = $idCliente")->row();

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
                                   as precioPublico,
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

     function getDeudores()
    {
        return $this->db->query("SELECT deudores.*, P.nombrePaci,
 (SELECT SUM(citaAdeudo.faltaPago) FROM citaAdeudo JOIN deudores d on citaAdeudo.idAdeudo = d.idDeudor
  WHERE d.idDeudor = deudores.idDeudor) as deudaTotal,(SELECT SUM(pagos.abono) FROM pagos JOIN citaAdeudo Adeudo on pagos.idAdeudacita = Adeudo.idControl JOIN deudores d2 on Adeudo.idAdeudo = d2.idDeudor WHERE d2.idDeudor=deudores.idDeudor
    ) as pagoTotal,c.precioEstudio,c.folioCita FROM deudores
 JOIN citaAdeudo cA on deudores.idDeudor = cA.idAdeudo
 JOIN citas c on cA.idCita = c.idCita
 JOIN Pacientes P on deudores.idPaciente = P.idPaciente
 LEFT JOIN pagos p2 on cA.idControl = p2.idAdeudacita
WHERE c.statusPago = 2 GROUP BY idDeudor;")->result_array();
    }

    function sacarId()
    {
       return $this->db->query("SELECT citas.idCita,citas.folioCita FROM `citaAdeudo` join citas on citas.idCita=citaAdeudo.idCita GROUP BY citas.folioCita")->result_array(); 
    }
    function getTotalesPrecio($Folio)
    {

       return $this->db->query("SELECT SUM(citas.precioEstudio) as totalEstudio,citas.folioCita from citas where folioCita=$Folio")->result_array(); 
    }

    function getDeudoreGrales()
    {
       return $this->db->query("select deudores.*,Pacientes.nombrePaci FROM deudores join Pacientes on Pacientes.idPaciente=deudores.idPaciente")->result_array(); 
    }

    function getpagosListado($idD)
    {
        return $this->db->query("SELECT pagos.abono,usuarios.nombreUser,pagos.fechaPago,citaAdeudo.idControl FROM `pagos` join citaAdeudo on citaAdeudo.idControl=pagos.idAdeudacita join usuarios on usuarios.idUser=pagos.idUser where citaAdeudo.idAdeudo=$idD")->result_array();
    }

    function sumaTotalPagos($idD)
    {
         return $this->db->query("SELECT SUM(pagos.abono) as TotalPa FROM `pagos` join citaAdeudo on citaAdeudo.idControl=pagos.idAdeudacita  where citaAdeudo.idAdeudo=$idD")->row();
    }

     function getestudiosGrales($idDeudor)
    {
       return $this->db->query("SELECT Estudio.nombreEstudio,citas.precioEstudio,citaAdeudo.faltaPago,citaAdeudo.idControl FROM deudores join citaAdeudo on citaAdeudo.idAdeudo=deudores.idDeudor join citas on citas.idCita=citaAdeudo.idCita join Estudio on Estudio.IdEstudio=citas.idEstudio where deudores.idDeudor=$idDeudor")->result_array(); 
    }

    function getNombreDeudor($deudore)
    {
       return $this->db->query("select deudores.*,Pacientes.nombrePaci FROM deudores join Pacientes on Pacientes.idPaciente=deudores.idPaciente where deudores.idDeudor=$deudore")->result_array(); 
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
    function insertDatosFacturaPuente($data)
    {
        $this->db->insert('FacturacionCita', $data);
    }

}


?>