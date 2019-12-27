<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPacienteEspera extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
        $this->load->model("PacienteEspera"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=24;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos

    }

    public function index($index = 1)
    {
        $data['page'] = $this->PacienteEspera->data_pagination("/Crudcitas/index/",
            $this->PacienteEspera->getTotalRowAllData(), 3);
        $data['areas'] = $this->PacienteEspera->getAreas();
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=24;
        $data['permisosEspecificos']=$this->Permisos->getPermisosEspecificosUsuarioModulo($idTipoUsuario, $idModulo);

        //Este código sirve para completar el arreglo, hay ciertas columnas que no existen en la base de datos y
        //Y lo que hace es que rellena el arreglo con las columnas que hacen falta
        $arregloColumnas=array ('salioCita', 'recepcion', 'pasarCita', 'interpretacion', 'resultados', 'limpiar');
        for($i=0; $i<sizeof($arregloColumnas);$i++)
        {
            $existe=0;
            foreach ($data['permisosEspecificos'] as $datum)
            {
                if($datum['nombreColumna']==$arregloColumnas[$i])
                {
                    $existe=1;
                    break;
                }
            }
            if(!$existe)
            {
               array_push($data['permisosEspecificos'], array(
                   'idTipoUsuario' => $idTipoUsuario,
                   'idModulo' => $idModulo,
                   'nombreColumna' => $arregloColumnas[$i],
                   'acceso' => 0

               ));
            }
        }
        //$data['Estudios'] = $this->PacienteEspera->getEstudios();

        $this->load->view('gridpacienteespera', $data);
    }

    public function entrega()
    {
        $data['page'] = $this->PacienteEspera->data_pagination("/Crudcitas/gridpacienteespera/",
            $this->PacienteEspera->getTotalRowAllData(), 3);
        $data['areas'] = $this->PacienteEspera->getAreas();
        //$data['Estudios'] = $this->PacienteEspera->getEstudios();
        //ASDAS
        $this->load->view('gridpacienteespera', $data);
    }

    function traeLista($idSala, $fechaconsu, $fechaconsuFinal, $doctor)
    {
        $doctor=rawurldecode($doctor);
        $contadorAND = -1;
        $condicionGeneral = "";
        $condicionArea = "";
        $condicionFecha = "";
        $condicionDoctor = "";
        if ($idSala != "0") {
            $condicionArea = " citas.idSala=$idSala ";
            $contadorAND++;
        }
        if ($fechaconsu != "0" && $fechaconsuFinal != "0")
        {
            if ($contadorAND >= 0) {
                $condicionFecha .= "AND";
                $contadorAND--;
            }
            $condicionFecha .= " citas.fechaCita BETWEEN '$fechaconsu' AND '$fechaconsuFinal' ";
            $contadorAND++;
        }
        if ($doctor != "0") {
            if ($contadorAND >= 0) {
                $condicionDoctor .= "AND";
            }
            $condicionDoctor .= " Doctores.nombreDoc LIKE '%$doctor%' ";
            $contadorAND++;
        }
        if ($contadorAND != -1) {
            $condicionGeneral = "WHERE " . $condicionArea . $condicionFecha . $condicionDoctor;

        }


        $prueba = $this->PacienteEspera->traerLista($condicionGeneral);
        echo json_encode($prueba);
        //echo json_encode("hola");
    }

    function traeListaEntrega($idSala, $fechaconsu, $fechaconsuFinal, $folioCita, $doctor, $paciente)
    {
        $paciente=str_replace("%20", " ", $paciente);
        $doctor=rawurldecode($doctor);
        $paciente=rawurldecode($paciente);
        $contadorAND = -1;
        $condicionGeneral = "WHERE citas.cancelar!=1 AND citas.statusProceso<=6 AND citas.statusProceso>=1";
        $condicionArea = "";
        $condicionFecha = "";
        $condicionDoctor = "";
        $condicionPaciente = "";
        $condicionCita = "";
        if ($idSala != "0") {
            $condicionArea = " citas.idSala=$idSala ";
            $contadorAND++;
        }
        if ($fechaconsu != "0" && $fechaconsuFinal != "0") {
            if ($contadorAND >= 0) {
                $condicionFecha .= "AND";
                $contadorAND--;
            }
            $condicionFecha .= " citas.fechaCita BETWEEN '$fechaconsu' AND '$fechaconsuFinal' ";
            $contadorAND++;
        }
        else if($fechaconsu!="0")
        {
            if ($contadorAND >= 0)
            {
                $condicionFecha .= "AND";
                $contadorAND--;
            }
            $condicionFecha .= " citas.fechaCita >= '$fechaconsu' ";
            $contadorAND++;
        }
        else if($fechaconsuFinal!="0")
        {
            if ($contadorAND >= 0)
            {
                $condicionFecha .= "AND";
                $contadorAND--;
            }
            $condicionFecha .= " citas.fechaCita <= '$fechaconsuFinal' ";
            $contadorAND++;
        }
        if ($doctor != "0") {
            if ($contadorAND >= 0) {
                $condicionDoctor .= "AND";
                $contadorAND--;
            }
            $condicionDoctor .= " Doctores.nombreDoc LIKE '%$doctor%' ";
            $contadorAND++;
        }
        if ($paciente != "0") {
            if ($contadorAND >= 0) {
                $condicionPaciente .= "AND";
            }
            $condicionPaciente .= " Pacientes.nombrePaci LIKE '%$paciente%' ";
            $contadorAND++;
        }
        if ($folioCita != "0") {
            if ($contadorAND >= 0) {
                $condicionCita.= "AND";
            }
            $condicionCita .= " citas.folioCita LIKE '%$folioCita%' ";
            $contadorAND++;
        }
        if ($contadorAND != -1) {
            $condicionGeneral = "WHERE " . $condicionArea . $condicionFecha . $condicionDoctor . $condicionPaciente . $condicionCita . " AND citas.cancelar!=1 AND citas.statusProceso<=6 AND citas.statusProceso>=0";
        }


        $prueba = $this->PacienteEspera->traerListaEntrega($condicionGeneral);
        echo json_encode($prueba);
        //echo json_encode("hola");
    }

    function traeListaTodo()
    {

        $prueba = $this->PacienteEspera->traerListaTodo();
        echo json_encode($prueba);
        //echo json_encode("hola");
    }

    function traeListaTodoEntrega()
    {

        $prueba = $this->PacienteEspera->traerListaTodoEntrega();
        echo json_encode($prueba);
        //echo json_encode("hola");
    }

    function comprobarExiste($idCita)
    {
        $prueba = $this->PacienteEspera->traerExistenc($idCita);
        echo json_encode($prueba);
        /**/
    }

    function insertardatos($idCita, $idUser)
    {
        $hora = date('H:i:s');
        $fechaEntrega = date('Y-m-d');
        $data = array(
            'idCita' => $idCita,
            'fechacaptura' => $fechaEntrega,
            'horaEntrega' => $hora,
            'idUser' => $idUser
        );
        $this->PacienteEspera->insertaDatosEnte($data);
    }

    function deleteCita($idCit)
    {
        $this->PacienteEspera->borrarDatosEntr($idCit);

        //redirect('http://localhost/CDI/Panel/index.php/Crudestudiosporsala/entrega');
    }
    //Al parecer, esta función es llamada desde el CrudCitas, al dar click al checkbox de recepcion
    function cambiarStatusProceso()
    {
        $statusProceso=$this->input->post('statusProceso');
        echo $statusProceso;
        $idCita=$this->input->post('idCita');
        $fecActual=$this->input->post('fecActual');
        $HoraActual=$this->input->post('HoraActual');
        $folio=$this->input->post('folio');
        $data = array(
            'horallegada' => $HoraActual,
            'fechallegada' => $fecActual,
            'statusProceso' => $statusProceso
        );
        //echo "statusProceso $statusProceso idCita $idCita fecActual $fecActual HoraActual $HoraActual ";
        $this->PacienteEspera->cambiarStatusProceso($data, $idCita);

        //COMIENZO de Guardar el status,idCita, usuario y fecha en la que se cambio

        $idUsuario=$this->session->userdata("idUser");
        //Esto verifica en la base de datos si ya existe un historial con el status y la cita pasadas que sea valid
        //Si no hay ninguno, inserta un historico. De lo contrario no pasa nada
        $existe=$this->PacienteEspera->borrarPosteriores($idCita, $statusProceso);
        if(!$existe)
        {
            $historico=array('idCita' => $idCita, 'status' => $statusProceso, 'fecha' => date('Y-m-d'), 'hora' => date('H:i:s'), 'idUsuario' => $idUsuario, 'validez' => 1);
            $this->PacienteEspera->insertarHistoricoStatus($historico);
        }


        //FIN de Guardar el status,idCita, usuario y fecha en la que se cambio
    }
    //esta función se llama desde el CrudPacienteEspera, al dar clic en un radiobutton de proceso
    function cambiarStatusProcesoOr()
    {

        $statusProceso=$this->input->post('statusProceso');
        $idCita=$this->input->post('idCita');

        $data = array(
            'statusProceso' => $statusProceso
        );

        //COMIENZO de Guardar el status,idCita, usuario y fecha en la que se cambio

        $idUsuario=$this->session->userdata("idUser");
        //Esto verifica en la base de datos si ya existe un historial con el status y la cita pasadas que sea valid
        //Si no hay ninguno, inserta un historico. De lo contrario no pasa nada
        $existe=$this->PacienteEspera->borrarPosteriores($idCita, $statusProceso);
        if(!$existe)
        {
            $historico=array('idCita' => $idCita, 'status' => $statusProceso, 'fecha' => date('Y-m-d'), 'hora' => date('H:i:s'), 'idUsuario' => $idUsuario, 'validez' => 1);
            $this->PacienteEspera->insertarHistoricoStatus($historico);
        }
        //Si el status del proceso es menor a interpretacion, entonces borra lo que esta en la tabla de entregaResultados
        if($statusProceso<5)
            $this->PacienteEspera->deleteEntregaResultado($idCita);


        //FIN de Guardar el status,idCita, usuario y fecha en la que se cambio


        //echo "statusProceso $statusProceso idCita $idCita fecActual $fecActual HoraActual $HoraActual ";
        $this->PacienteEspera->cambiarStatusProceso($data, $idCita);
    }
    function traerHorariosCambios($idSala, $fechaconsu, $fechaconsuFinal, $folioCita, $doctor, $paciente)
    {
        $paciente=str_replace("%20", " ", $paciente);
        $contadorAND = -1;
        $condicionGeneral = "WHERE citas.cancelar!=1 AND citas.statusProceso<=6 AND citas.statusProceso>=1";
        $condicionArea = "";
        $condicionFecha = "";
        $condicionDoctor = "";
        $condicionPaciente = "";
        $condicionCita = "";
        if ($idSala != "0") {
            $condicionArea = " citas.idSala=$idSala ";
            $contadorAND++;
        }
        if ($fechaconsu != "0" && $fechaconsuFinal != "0") {
            if ($contadorAND >= 0) {
                $condicionFecha .= "AND";
                $contadorAND--;
            }
            $condicionFecha .= " citas.fechaCita BETWEEN '$fechaconsu' AND '$fechaconsuFinal' ";
            $contadorAND++;
        }
        else if($fechaconsu!="0")
        {
            if ($contadorAND >= 0)
            {
                $condicionFecha .= "AND";
                $contadorAND--;
            }
            $condicionFecha .= " citas.fechaCita >= '$fechaconsu' ";
            $contadorAND++;
        }
        else if($fechaconsuFinal!="0")
        {
            if ($contadorAND >= 0)
            {
                $condicionFecha .= "AND";
                $contadorAND--;
            }
            $condicionFecha .= " citas.fechaCita <= '$fechaconsuFinal' ";
            $contadorAND++;
        }
        if ($doctor != "0") {
            if ($contadorAND >= 0) {
                $condicionDoctor .= "AND";
                $contadorAND--;
            }
            $condicionDoctor .= " Doctores.nombreDoc LIKE '%$doctor%' ";
            $contadorAND++;
        }
        if ($paciente != "0") {
            if ($contadorAND >= 0) {
                $condicionPaciente .= "AND";
            }
            $condicionPaciente .= " Pacientes.nombrePaci LIKE '%$paciente%' ";
            $contadorAND++;
        }
        if ($folioCita != "0") {
            if ($contadorAND >= 0) {
                $condicionCita.= "AND";
            }
            $condicionCita .= " citas.folioCita LIKE '%$folioCita%' ";
            $contadorAND++;
        }
        if ($contadorAND != -1) {
            $condicionGeneral = "WHERE " . $condicionArea . $condicionFecha . $condicionDoctor . $condicionPaciente . $condicionCita . " AND citas.cancelar!=1 AND citas.statusProceso<=6 AND citas.statusProceso>=0";
        }
        $prueba = $this->PacienteEspera->traerHorariosCambiosCitas($condicionGeneral);
        echo json_encode($prueba);
    }
    function limpiarHistorialCambios($idCita)
    {
        $this->PacienteEspera->limpiarHistorialCambios($idCita);
    }
    function mandarCitaInterpretacion($idCita)
    {
        $fechaCaptura=date("Y-m-d");
        $horaEntrega=date("H:i:s");
        $idUser=$this->session->userdata("idusuariobase");
        $interpretacion=1;
        $recibeEstudio="";
        $existeCitaEnInterpretacion=$this->PacienteEspera->verificarExistenciaInterpretacion($idCita);
        if(!$existeCitaEnInterpretacion)
            $this->PacienteEspera->insertEntregaResultado(array(
                'idCita' => $idCita,
                'fechaCaptura' => $fechaCaptura,
                'horaEntrega' => $horaEntrega,
                'idUser' => $idUser,
                'recibeEstudio' => $recibeEstudio,
                'interpretacion' => $interpretacion,
                'elaborado' => 0,
                'entrega' => 0
            ));
        else
            echo "No se insertó duplicado";
    }

    function verificarContrasena()
    {   
        
        $pass = $this->PacienteEspera->verificarPassword($this->input->post("password"));
        echo $pass;
    }


}


?>