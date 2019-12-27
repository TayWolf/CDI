<?php
class Citas extends CI_Model
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



    function getDatos()
    {
        return $this->db->query("SELECT * FROM Doctores ")->result_array();
    }

    function getCiMod($idCo)
    {
        //echo "dayi $idCo";
        return $this->db->query("SELECT Salas.nombre,Estudio.nombreEstudio,controlCambiosCitas.fechaCita,controlCambiosCitas.horarioCita,Pacientes.nombrePaci,Doctores.nombreDoc,controlCambiosCitas.urgencia,controlCambiosCitas.orden_medica,controlCambiosCitas.factura,clientes.nombreCliente as tipoCitaa,controlCambiosCitas.fEntrega,usuarios.nombreUser,controlCambiosCitas.fechaMod,controlCambiosCitas.horaMod,controlCambiosCitas.prioridad,controlCambiosCitas.observacionesPaciente FROM Salas join controlCambiosCitas on controlCambiosCitas.idSala=Salas.idSala join Estudio on Estudio.IdEstudio=controlCambiosCitas.idEstudio join Pacientes on Pacientes.idPaciente=controlCambiosCitas.idPaciente join Doctores on Doctores.idDoctor=controlCambiosCitas.idMedico join usuarios on usuarios.idUser=controlCambiosCitas.idUser JOIN clientes on clientes.idCliente=controlCambiosCitas.tipoCitaa where controlCambiosCitas.idontrol=$idCo")->result_array();
    }

    function getCiAc($idCo)
    {
        //echo "dayi $idCo";
        return $this->db->query("SELECT Salas.nombre,Estudio.nombreEstudio,citas.fechaCita,citas.horarioCita,Pacientes.nombrePaci,Doctores.nombreDoc,citas.urgencia,citas.orden_medica,citas.factura,clientes.nombreCliente as tipoCitaa,citas.fEntrega,usuarios.nombreUser,controlCambiosCitas.fechaMod,controlCambiosCitas.horaMod,citas.fechaCaptura,citas.hourRegistro,citas.prioridad,citas.observacionesPaciente FROM Salas join citas on citas.idSala=Salas.idSala join Estudio on Estudio.IdEstudio=citas.idEstudio join Pacientes on Pacientes.idPaciente=citas.idPaciente join Doctores on Doctores.idDoctor=citas.idMedico join controlCambiosCitas on controlCambiosCitas.idCita=citas.idCita join clientes on clientes.idCliente=Pacientes.cliente join usuarios on usuarios.idUser=controlCambiosCitas.idUser where controlCambiosCitas.idontrol=$idCo")->result_array();
    }

    function historialCambios($condicion)
    {
        // return $this->db->query("SELECT usuarios.nombreUser as usuario, citas.idCita as cita, s1.nombre as salaAnterior, c1.fechaAnt as fechaAnterior, c1.horaAnt as horaAnterior, s2.nombre as nuevaSala, c1.fechaNueva, c1.horaNueva, c1.fechaCambio, c1.horaCambio FROM controlCambio c1 JOIN usuarios ON usuarios.idUser=c1.idUser JOIN citas ON citas.idCita = c1.idCita JOIN Salas s1 ON s1.idSala=c1.idSalaAnt JOIN Salas s2 ON s2.idSala=c1.idSalaNueva $condicion ORDER BY c1.fechaCambio ASC")->result_array();
        return $this->db->query("SELECT controlCambiosCitas.idontrol,controlCambiosCitas.horaMod,controlCambiosCitas.idCita,controlCambiosCitas.fechaMod,usuarios.nombreUser from controlCambiosCitas join usuarios on usuarios.idUser=controlCambiosCitas.idUser JOIN citas on citas.idCita=controlCambiosCitas.idCita $condicion ORDER BY `controlCambiosCitas`.`fechaMod` DESC,controlCambiosCitas.horaMod DESC")->result_array();

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

    function quitarCita($idCit)
    {
        $this->db->where('idCita', $idCit);
        $this->db->delete('citas');
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

    function getPreci($llavePrimaria,$tipoCi,$Estud)

    {
        return $this->db->query("SELECT citas.tipoCitaa,Estudio.IdEstudio, (SELECT CASE WHEN citas.tipoCitaa!=8 THEN (SELECT CASE WHEN clientes.precioEspecial=1 THEN (SELECT (CASE WHEN COUNT(precio)=0 THEN (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio) ELSE (SELECT precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente) 
END) as precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio) END) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio) END) as precio FROM citas JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente LEFT JOIN entregaResultado ON citas.idCita  = entregaResultado.idCita       JOIN clientes ON Pacientes.cliente=clientes.idCliente JOIN Estudio ON citas.idEstudio=Estudio.idEstudio JOIN Doctores ON citas.idMedico=Doctores.idDoctor JOIN Salas ON Salas.idSala=citas.idSala where Estudio.IdEstudio=$Estud and citas.idCita=$llavePrimaria and citas.tipoCitaa=$tipoCi")->result_array(); // WHERE idEntrega IS NULL || IS NOT NULL

    }


    function insertaDatos($data)
    {
        $this->db->insert('citas', $data);
        return $this->db->insert_id();
    }

    function insertControlCmab($data)
    {
        $this->db->insert('controlCambiosCitas', $data);
    }

    function modifcPacie($data,$idPacien)
    {
        $this->db->where('idPaciente', $idPacien);
        $this->db->update('Pacientes', $data);
    }

    function mode($data,$idCita)
    {
        $this->db->where('idCita', $idCita);
        $this->db->update('citas', $data);
    }

    function updatecitas($data,$idcita)
    {
        $this->db->where('idCita', $idcita);
        $this->db->update('citas', $data);
    }

    function canceCita($data,$idcita)
    {
        $this->db->where('idCita', $idcita);
        $this->db->update('citas', $data);
    }

    function obtenerDatosCliente($nombre)

    {
        $limit=10;
        $this-> db ->like('nombrePaci',$nombre,'both ');
        $this-> db ->limit($limit);
        return $this-> db ->get('Pacientes')->result();
        // return $this->db->query("SELECT * FROM `Pacientes` WHERE `nombrePaci` like '%$nombre%' ")->result_array();
    }

    function obtenerDatosEstudio($Estudio)

    {
        $limit=10;
        $this->db->like('nombreEstudio',$Estudio,'both');
        $this-> db ->limit($limit);
        return $this->db->get('Estudio')->result();

        //return $this->db->query("SELECT * FROM `Estudio` WHERE `nombreEstudio` like '%$Estudio%' ")->row();
    }

    function getListaCitas($fecha)

    {
        return $this->db->query("SELECT usuarios.nombreUser,citas.idCita,citas.fechaCita, Pacientes.nombrePaci,Salas.nombre,Estudio.duracion,Estudio.nombreEstudio,citas.horarioCita, citas.horaTerminada, citas.orden_medica, citas.urgencia FROM `citas` join Pacientes on Pacientes.idPaciente=citas.idPaciente join Salas on Salas.idSala=citas.idSala  join Estudio on Estudio.IdEstudio=citas.idEstudio join usuarios on usuarios.idUser=citas.idUser WHERE  citas.fechaCita='$fecha' and citas.cancelar=0  order by citas.horarioCita asc")->result_array();
    }

    function getListaTodoCitas($fecha)
    {

      //echo "desmadre $fecha";
      return $this->db->query("SELECT citas.observacionesPaciente,citas.folioCita,Salas.idSala,Estudio.IdEstudio,usuarios.nombreUser,citas.idCita,citas.fechaCita,Pacientes.idPaciente, Pacientes.nombrePaci,Salas.nombre,Estudio.duracion,Estudio.nombreEstudio,citas.horarioCita, citas.horaTerminada, citas.orden_medica, citas.urgencia,citas.horallegada,citas.cancelar,citas.statusProceso,clientes.nombreCliente,Remitente.nombreRem FROM `citas` join Pacientes on Pacientes.idPaciente=citas.idPaciente join Salas on Salas.idSala=citas.idSala  join Estudio on Estudio.IdEstudio=citas.idEstudio join usuarios on usuarios.idUser=citas.idUser join clientes on clientes.idCliente=citas.tipoCitaa join Remitente on Remitente.idRemitente=Pacientes.remitente WHERE citas.fechaCita = '$fecha' GROUP by citas.folioCita order by citas.fechaCita asc,citas.horarioCita ASC")->result_array();


    }//aqui mero
    function getListaTodoCitasGral()
    {
        //echo "desmadre $fecha";
        return $this->db->query("SELECT Salas.idSala,Estudio.IdEstudio,usuarios.nombreUser,citas.idCita,citas.fechaCita,Pacientes.idPaciente, Pacientes.nombrePaci,Salas.nombre,Estudio.duracion,Estudio.nombreEstudio,citas.horarioCita, citas.horaTerminada, citas.orden_medica, citas.urgencia,citas.horallegada,citas.cancelar,citas.statusProceso, confirmarCita.idConfirmacion FROM `citas` join Pacientes on Pacientes.idPaciente=citas.idPaciente join Salas on Salas.idSala=citas.idSala join Estudio on Estudio.IdEstudio=citas.idEstudio join usuarios on usuarios.idUser=citas.idUser LEFT JOIN confirmarCita ON confirmarCita.idCita=citas.idCita order by citas.fechaCita DESC,citas.horarioCita ASC")->result_array();

    }

    function getListaTodoCitasGralCitas($condicionGeneral="")
    {
        //echo "desmadre $fecha";
        return $this->db->query("SELECT citas.folioCita, Salas.idSala,Estudio.IdEstudio,usuarios.nombreUser,citas.idCita,citas.fechaCita,Pacientes.idPaciente, Pacientes.nombrePaci,Salas.nombre,Estudio.duracion,Estudio.nombreEstudio,citas.horarioCita, citas.horaTerminada, citas.orden_medica, citas.urgencia,citas.horallegada,citas.cancelar,citas.statusProceso, confirmarCita.idConfirmacion, Doctores.nombreDoc FROM `citas` join Pacientes on Pacientes.idPaciente=citas.idPaciente join Salas on Salas.idSala=citas.idSala join Estudio on Estudio.IdEstudio=citas.idEstudio join usuarios on usuarios.idUser=citas.idUser LEFT JOIN confirmarCita ON confirmarCita.idCita=citas.idCita JOIN Doctores ON Doctores.idDoctor=citas.idMedico $condicionGeneral order by citas.fechaCita DESC,citas.horarioCita ASC")->result_array();

    }

    function estuPac($idPacie,$fech)
    {
        return $this->db->query("SELECT Estudio.nombreEstudio,Pacientes.nombrePaci FROM `citas` JOIN Pacientes on citas.idPaciente=Pacientes.idPaciente JOIN Estudio on Estudio.IdEstudio=citas.idEstudio WHERE Pacientes.idPaciente=$idPacie and citas.fechaCita ='$fech'")->result_array();

    }
    function eliminarCitaPorFolio($idFolio)
    {
        $this->db->where("citas.folioCita", $idFolio);
        $this->db->delete("citas");
    }

    function verificaPassword($password)
    {
        return $this->db->query("SELECT * FROM `Contrasenas` WHERE `contrasena` = '$password' and permiso = 1 ")->result_array();
    }

    function insertarCambios($datos)
    {
        $this->db->insert('controlCambio', $datos);
    }

    function getListaTodoCitasXpeticion($valor,$fecha)
    {

      return $this->db->query("SELECT citas.folioCita,usuarios.nombreUser,citas.idCita,citas.fechaCita, Pacientes.nombrePaci,Salas.nombre,Estudio.duracion,Estudio.nombreEstudio,citas.horarioCita, citas.horaTerminada, citas.orden_medica, citas.urgencia,citas.horallegada,citas.cancelar,citas.statusProceso,citas.observacionesPaciente,clientes.nombreCliente,Remitente.nombreRem FROM `citas` join Pacientes on Pacientes.idPaciente=citas.idPaciente join Salas on Salas.idSala=citas.idSala  join Estudio on Estudio.IdEstudio=citas.idEstudio join usuarios on usuarios.idUser=citas.idUser join clientes on clientes.idCliente=citas.tipoCitaa join Remitente on Remitente.idRemitente=Pacientes.remitente WHERE citas.fechaCita >= '$fecha' and (citas.fechaCita like '%$valor%' or Pacientes.nombrePaci like '%$valor%' or Estudio.nombreEstudio like '%$valor%' or Salas.nombre like '%$valor%' or citas.orden_medica like '%$valor%' or citas.horarioCita like '%$valor%' or citas.horaTerminada like '%$valor%' or usuarios.nombreUser like '%$valor%') order by citas.fechaCita asc")->result_array();

    }

    function getPaciente($idPacie)
    {
        return $this->db->query("SELECT * FROM `Pacientes` where idPaciente =$idPacie  ")->row();
    }

    function getEstudios($idSala)
    {
        return $this->db->query("SELECT Estudio.nombreEstudio,Estudio.IdEstudio FROM `salaEstudio` join Estudio on Estudio.IdEstudio=salaEstudio.idEstudio WHERE salaEstudio.idSala=$idSala ")->result_array();
    }

    function getEst($foli){
        return $this->db->query("SELECT citas.idCita,citas.fechaCita,citas.horarioCita,Salas.nombre,Estudio.nombreEstudio FROM `citas` join Salas on Salas.idSala=citas.idSala join Estudio on Estudio.IdEstudio=citas.idEstudio WHERE folioCita=$foli")->result_array();
    }

    function getTodoMedico($sala)
    {
        return $this->db->query("SELECT Doctores.* FROM `Doctores` join salaMedico on salaMedico.idMedico = Doctores.idDoctor where salaMedico.idSala = $sala")->result_array();
    }

    function traeDiasLaborales($dia,$medico)
    {
        return $this->db->query("SELECT horarioSalaMedico.* FROM horarioSalaMedico join salaMedico on horarioSalaMedico.idsalaMedico = salaMedico.idsalaMedico where horarioSalaMedico.dia = $dia AND salaMedico.idMedico = $medico")->result_array();
    }


    function getDuracion($idE)
    {
        return $this->db->query("SELECT Estudio.duracion FROM Estudio where Estudio.IdEstudio = $idE")->result_array();
    }

    function getnoDispo($idS,$fecha)
    {
        return $this->db->query("SELECT * from citas where  idSala = $idS and fechaCita = '$fecha' and cancelar=0 ORDER BY horarioCita  ASC")->result_array();
    }

    function getCitaGral($idCit,$fech)
    {
        return $this->db->query("SELECT citas.*,Estudio.IdEstudio,Estudio.nombreEstudio,Estudio.duracion,Pacientes.nombrePaci,Pacientes.idPaciente from citas join Estudio on Estudio.IdEstudio=citas.idEstudio JOIN Pacientes on Pacientes.idPaciente=citas.idPaciente where  citas.idCita=$idCit and citas.fechaCita = '$fech'")->row();
    }

    function getCitaGralHour($idCit)
    {
        return $this->db->query("SELECT citas.*,Estudio.IdEstudio,Estudio.nombreEstudio,Estudio.duracion,Estudio.diasResultado,Pacientes.nombrePaci,Pacientes.idPaciente,Estudio.indicacionesPaciente from citas join Estudio on Estudio.IdEstudio=citas.idEstudio JOIN Pacientes on Pacientes.idPaciente=citas.idPaciente where  citas.idCita=$idCit ")->row();
    }

    function veOcu($idMe,$fecha)
    {
        return $this->db->query("SELECT * from citas where   fechaCita = '$fecha' and idMedico=$idMe and cancelar=0 and idMedico != 9 ORDER BY horarioCita  ASC")->result_array();
    }

    function veOcuP($idP,$fecha)
    {
        return $this->db->query("SELECT * from citas where   fechaCita = '$fecha' and idPaciente=$idP and cancelar=0 ORDER BY horarioCita  ASC")->result_array();
    }

    function veDis($idMe,$fecha)
    {
        return $this->db->query("SELECT * from citas where   fechaCita = '$fecha' and idMedico=$idMe and cancelar=1 ORDER BY horarioCita  ASC")->result_array();
    }

    function getProxnoDispo($idE,$idS,$fecha,$hora)
    {
        return $this->db->query("SELECT * from citas where idEstudio = $idE and idSala = $idS and fechaCita = '$fecha' and horarioCita like '$hora%' ORDER BY horarioCita  ASC")->result_array();
    }

    function getsalasocupadas($idsa)
    {
        return $this->db->query("SELECT * FROM `citas` WHERE `idSala` = $idsa")->result_array();
    }

    function detInfocitas($idCita)
    {
        return $this->db->query("SELECT * FROM `citas` WHERE `idCita` = $idCita")->result_array();
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

    function listasSalas()
    {
        return $this->db->query("SELECT * FROM `Salas` ")->result_array();
    }

    function getTablaStatusCita()
    {
        $hoy=date("Y-m-d");
        return $this->db->query("SELECT citas.horallegada, Pacientes.nombrePaci, Salas.nombre, Estudio.nombreEstudio, citas.fechaCita, citas.horarioCita, citas.horaTerminada, citas.statusProceso FROM citas JOIN Pacientes ON Pacientes.idPaciente=citas.idPaciente JOIN Salas ON Salas.idSala=citas.idSala JOIN Estudio ON Estudio.IdEstudio=citas.idEstudio WHERE citas.fechaCita >='$hoy' and citas.cancelar=0")->result_array();
    }

    function getSalaxEstudio($idEstudio)
    {
        return $this->db->query("SELECT Salas.* FROM `Salas` JOIN salaEstudio on salaEstudio.idSala = Salas.idSala where salaEstudio.idEstudio = $idEstudio")->result_array();
    }

    function getDatoCitaMod($idCita)
    {
        return $this->db->query("SELECT citas.fechaCita,Salas.nombre,Doctores.nombreDoc,Pacientes.nombrePaci,Estudio.nombreEstudio,citas.horarioCita,citas.horaTerminada,Estudio.duracion,citas.folioCita FROM `citas` join Salas on Salas.idSala=citas.idSala join Doctores on Doctores.idDoctor=citas.idMedico join Pacientes on Pacientes.idPaciente=citas.idPaciente join Estudio on Estudio.IdEstudio=citas.idEstudio where citas.idCita=$idCita")->row();
    }

    function remitente()
    {
        return $this->db->query("SELECT * FROM Remitente")->result_array();
    }

    function cliente()
    {
        return $this->db->query("SELECT * FROM clientes")->result_array();
    }

    function getCliente($idPc)
    {
        return $this->db->query("SELECT clientes.idCliente,clientes.nombreCliente FROM `clientes` join Pacientes on Pacientes.cliente=clientes.idCliente WHERE Pacientes.idPaciente=$idPc")->row();
    }
    function getAreas()
    {
        return $this->db->query("SELECT * FROM Salas")->result_array();
    }


}


?>