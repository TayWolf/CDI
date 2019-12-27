<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudSalas extends CI_Controller {
    function __construct(){
        parent::__construct();
        if ($this->session->userdata("idUser")!= "") {
        }
        else
        {
            header("Location: http://localhost/CDI/Panel/");
            die();
        }
        $this->load->model("salas"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=4;
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
        $data['page'] = $this->salas->data_pagination("/Crudsalas/index/",
            $this->salas->getTotalRowAllData(), 3);
        $data['salas'] = $this->salas->getDatos($index);
        $data['Estudios'] = $this->salas->getEstudios();
        $data['Doctores'] = $this->salas->getDoctores();
        $this->load->view('gridtodosalas',$data);


    }
    public function detalleSala()
    {
        $idS=$_REQUEST['id'];
        $this->load->view('griddetallesala',$idS);
    }

    public function ModificarSala()
    {
        $idS=$_REQUEST['id'];
        $this->load->view('grideditarsala',$idS);
    }
    public function altaSala()
    {

        $this->load->view('gridaltasala');
    }

    function obtenerDatos($idS)
    {
        $prueba= $this->salas->obtenerFicha($idS);
        echo json_encode ($prueba);
    }

    function logout(){
        $this->session->sess_destroy();
        redirect('http://localhost/CDI/Panel/');
    }

    function eliminarSala($idSal){
        $this->salas->borrarDatos($idSal);
        redirect('http://localhost/CDI/Panel/index.php/Crudsalas');
    }

    function agregaSala()
    {
        $horario=1;
        $data = array(
            'nombre' => $this->input->post('nombreSala'),
            'tipo' => $this->input->post('tipoSala'),
            'horarios' => $horario,
            'clave' => $this->input->post('claveSala')
        );
        $this->salas->insertaDatos($data);
        // echo "1";
    }


    function modificarDatos(){
        $idS = $this->input->post('idSala');
        $nombre =$this->input->post('nombre');
        $nombre =mb_strtoupper ($nombre);

        $tipo = $this->input->post('tipo');
        $tipo = mb_strtoupper ($tipo);


        $clave= $this->input->post('clave');

        if (!empty($nombre)) {
            $data = array(
                'nombre' => $nombre
            );
            $this->salas->modificaDatos($data,$idS);
        }else{}

        if (!empty($tipo)) {
            $data = array(
                'tipo' => $tipo
            );
            $this->salas->modificaDatos($data,$idS);
        }else{}

        if (!empty($clave)) {
            $data = array(
                'clave' => $this->input->post('clave')
            );
            $this->salas->modificaDatos($data,$idS);
        }else{}
    }
    function modHorario($idSala)
    {
        $prueba= $this->salas->obtenerStatus($idSala);
        foreach ($prueba as $row)	{
            $hora=$row;
        }
        if ($hora==1) {
            $status=2;
        }if ($hora==2) {
        $status=1;
    }


        $data = array(
            'horarios' => $status
        );
        $this->salas->modifcaStatus($data,$idSala);
        echo "1";
    }


    function buscadisponibles($actual)
    {

        $estudios=$this->salas->getEstudios();
        $JSON=array();
        foreach ($estudios as $estudio) {
            $prueba = $this->salas->obtenerdisponibles($estudio['IdEstudio'], $actual);
            if(!empty($prueba))
                array_push($JSON, $prueba);
        }
        echo json_encode($JSON);
    }
    function buscaasignadas($actual)
    {
        $estudios=$this->salas->getEstudios();
        $JSON=array();
        foreach ($estudios as $estudio)
        {
            $prueba= $this->salas->obtenerasignadas($estudio['IdEstudio'],$actual);
            if(!empty($prueba))
                array_push($JSON, $prueba);
        }
        echo json_encode($JSON);
    }

    function buscaDocsasignados($i,$actual)
    {
        $prueba= $this->salas->obtenerdocsasignados($i,$actual);
        echo json_encode ($prueba);
    }

    function buscaDocsdisponibles($i,$actual)
    {
        $prueba= $this->salas->obtenerdocsdisponibles($i,$actual);
        echo json_encode ($prueba);
    }

    function agregarPuente($idE,$total,$idactual)
    {
        $idub = $idE;
        $data = array(
            'idEstudio' => $idub,
            'idSala' => $idactual
        );
        $this->salas->insertaDatosPuente($data);
        echo "entra".$idub;
    }
    function altahora()
    {
        $idPuente = $this->input->post('idPuente');
        //$dia = $this->input->post('dia');
        $prueba	= $this->input->post('arreglo');

        foreach ($prueba as $key => $value) {
            foreach ($value as $key => $value) {
                $dataPue =array(
                    'idsalaMedico' => $idPuente,
                    'dia' => $value['dia'],
                    'horaEntrada' => $value['entrada'],
                    'horaSalida' => $value['salida']
                );
                $this->salas->insertaDatosPuent($dataPue);

            }
        }
    }

    function quitarpuente($idE,$total,$idactual){
        $this->salas->quitarDatosPuente($idE,$total,$idactual);
    }


    function agregarPuenteDocs($idD,$total,$idactual)
    {
        $idub = $idD;
        $data = array(
            'idMedico' => $idub,
            'idSala' => $idactual
        );
        $this->salas->insertaDatosPuenteDoc($data);
        echo "entra".$idub;
    }

    function quitarpuenteDocs($idD,$total,$idactual){
        $this->salas->quitarDatosPuenteDoc($idD,$total,$idactual);
    }

    function treaiddoctorsala($idD,$idS)
    {
        $prueba= $this->salas->obtenerIdDocSala($idD,$idS);
        echo json_encode ($prueba);
    }

    function traeidhorarioSM($sala,$doc)
    {
        $prueba= $this->salas->traeidhorasalamedi($sala,$doc);
        echo json_encode ($prueba);
    }

    function traehorarios($id)
    {
        $prueba= $this->salas->traehoras($id);
        echo json_encode ($prueba);
    }


    function eliminahora($id){
        $this->salas->borrarHora($id);
        // redirect('http://localhost/CDI/Panel/index.php/Crudsalas);
    }
    function validarEmpalmeHorarioMedico()
    {
        $dia=$this->input->post("dia");
        $entrada=$this->input->post("entrada");
        $salida=$this->input->post("salida");
        $idSalaMedico=$this->input->post("idSalaMedico");
        $horarios=$this->salas->traerHorariosMedico($idSalaMedico, $dia);
        foreach ($horarios as $horario)
        {
            $horarioInicio=$horario['horaEntrada'];
            $horarioSalida=$horario['horaSalida'];
            if(strtotime($entrada)>=strtotime($horarioInicio)&&strtotime($entrada)<=strtotime($horarioSalida))
            {
                return;
            }
            else if(strtotime($salida)>=strtotime($horarioInicio)&&strtotime($salida)<=strtotime($horarioSalida))
            {
                return;
            }


        }
        echo "OK!";
    }


}


?>