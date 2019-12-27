<?php
class CrudAdministracion extends CI_Controller
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
        $this->load->model("Administracion");
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=25;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
    }
    function index()
    {
        $data['areas'] = $this->Administracion->getAreas();
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=25;
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
        $this->load->view("viewResumenSistema", $data);
    }
    function traeListaEntrega($idSala, $fechaconsu, $fechaconsuFinal, $folioCita, $doctor, $paciente)
    {
        $doctor=rawurldecode($doctor);
        $paciente=rawurldecode($paciente);
        $paciente=str_replace("%20", " ", $paciente);
        $contadorAND=-1;
        $condicionGeneral="WHERE citas.cancelar!=1 ";
        $condicionArea="";
        $condicionFecha="";
        $condicionDoctor="";
        $condicionPaciente="";
        $condicionCita = "";
        if($idSala!="0")
        {
            $condicionArea=" citas.idSala=$idSala ";
            $contadorAND++;
        }
        if($fechaconsu!="0" && $fechaconsuFinal!="0")
        {
            if($contadorAND>=0)
            {
                $condicionFecha.="AND";
                $contadorAND--;
            }
            $condicionFecha.=" citas.fechaCita BETWEEN '$fechaconsu' AND '$fechaconsuFinal' ";
            $contadorAND++;
        }

        if($doctor!="0")
        {
            if($contadorAND>=0)
            {
                $condicionDoctor.="AND";
                $contadorAND--;
            }
            $condicionDoctor.=" Doctores.nombreDoc LIKE '%$doctor%' ";
            $contadorAND++;
        }
        if($paciente!="0")
        {
            if($contadorAND>=0)
            {
                $condicionPaciente.="AND";
            }
            $condicionPaciente.=" Pacientes.nombrePaci LIKE '%$paciente%' ";
            $contadorAND++;
        }
        if ($folioCita != "0") {
            if ($contadorAND >= 0) {
                $condicionCita.= "AND";
            }
            $condicionCita .= " citas.folioCita LIKE '%$folioCita%' ";
            $contadorAND++;
        }
        if($contadorAND!=-1)
        {
            $condicionGeneral= "WHERE ".$condicionArea.$condicionFecha.$condicionDoctor.$condicionPaciente.$condicionCita." AND  citas.cancelar!=1 AND citas.statusProceso<=6 ";
        }
        $prueba= $this->Administracion->traerListaEntrega($condicionGeneral);
        
        echo json_encode($prueba);
    }
    function comprobarExiste($idCita)
    {
        $prueba= $this->Administracion->traerExistenc($idCita);
        echo json_encode ($prueba);
        /**/
    }
    function insertardatos($idCita,$idUser)
    {
        $hora=date('H:i:s');
        $fechaEntrega=date('Y-m-d');
        $data = array(
            'idCita' => $idCita,
            'fechacaptura' => $fechaEntrega,
            'horaEntrega' => $hora,
            'idUser' => $idUser
        );
        $this->Administracion->insertaDatosEnte($data);
        $array = array(
            "statusProceso" => 5
        );
        $this->Administracion->updateStatusCita($array, $idCita);
    }
    function cambiarPrioridadEstudio($idCita, $valorPrioridad)
    {
        $this->Administracion->updatePrioridad($idCita, $valorPrioridad);
    }
    function traerHorariosCambios($idSala, $fechaconsu, $fechaconsuFinal, $folioCita, $doctor, $paciente)
    {
        $paciente=str_replace("%20", " ", $paciente);
        $contadorAND=-1;
        $condicionGeneral="WHERE citas.cancelar!=1 ";
        $condicionArea="";
        $condicionFecha="";
        $condicionDoctor="";
        $condicionPaciente="";
        $condicionCita = "";
        if($idSala!="0")
        {
            $condicionArea=" citas.idSala=$idSala ";
            $contadorAND++;
        }
        if($fechaconsu!="0" && $fechaconsuFinal!="0")
        {
            if($contadorAND>=0)
            {
                $condicionFecha.="AND";
                $contadorAND--;
            }
            $condicionFecha.=" citas.fechaCita BETWEEN '$fechaconsu' AND '$fechaconsuFinal' ";
            $contadorAND++;
        }

        if($doctor!="0")
        {
            if($contadorAND>=0)
            {
                $condicionDoctor.="AND";
                $contadorAND--;
            }
            $condicionDoctor.=" Doctores.nombreDoc LIKE '%$doctor%' ";
            $contadorAND++;
        }
        if($paciente!="0")
        {
            if($contadorAND>=0)
            {
                $condicionPaciente.="AND";
            }
            $condicionPaciente.=" Pacientes.nombrePaci LIKE '%$paciente%' ";
            $contadorAND++;
        }
        if ($folioCita != "0") {
            if ($contadorAND >= 0) {
                $condicionCita.= "AND";
            }
            $condicionCita .= " citas.folioCita LIKE '%$folioCita%' ";
            $contadorAND++;
        }
        if($contadorAND!=-1)
        {
            $condicionGeneral= "WHERE ".$condicionArea.$condicionFecha.$condicionDoctor.$condicionPaciente.$condicionCita." AND  citas.cancelar!=1 AND citas.statusProceso<=6 ";
        }
        $prueba= $this->Administracion->traerHorariosCambiosCitas($condicionGeneral);
        echo json_encode($prueba);
    }
    function cambiarStatusProceso()
    {
        $statusProceso=$this->input->post('statusProceso');
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
        $this->Administracion->cambiarStatusProceso($data, $idCita);
    }

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
        $existe=$this->Administracion->borrarPosteriores($idCita, $statusProceso);
        if(!$existe)
        {
            $historico=array('idCita' => $idCita, 'status' => $statusProceso, 'fecha' => date('Y-m-d'), 'hora' => date('H:i:s'), 'idUsuario' => $idUsuario, 'validez' => 1);
            $this->Administracion->insertarHistoricoStatus($historico);
        }


        //FIN de Guardar el status,idCita, usuario y fecha en la que se cambio


        //echo "statusProceso $statusProceso idCita $idCita fecActual $fecActual HoraActual $HoraActual ";
        $this->Administracion->cambiarStatusProceso($data, $idCita);
    }
    function deleteCita($idCit)
    {
        $this->Administracion->borrarDatosEntr($idCit);

        //redirect('http://localhost/CDI/Panel/index.php/Crudestudiosporsala/entrega');
    }
    function limpiarHistorialCambios($idCita)
    {
        $this->Administracion->limpiarHistorialCambios($idCita);
    }
    function mandarCitaInterpretacion($idCita)
    {
        $fechaCaptura=date("Y-m-d");
        $horaEntrega=date("H:i:s");
        $idUser=$this->session->userdata("idusuariobase");
        $interpretacion=1;
        $recibeEstudio="";
        $existeCitaEnInterpretacion=$this->Administracion->verificarExistenciaInterpretacion($idCita);
        if(!$existeCitaEnInterpretacion)
            $this->Administracion->insertEntregaResultado(array(
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
        
        $pass = $this->Administracion->verificarPassword($this->input->post("password"));
        echo $pass;
    }

}