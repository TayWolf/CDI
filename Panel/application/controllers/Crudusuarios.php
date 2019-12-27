<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudUsuarios extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model("user"); //cargamos el modelo de User

    }

    public function index($index = 1)
    {
        if ($this->session->userdata("idUser")!= "") {
   
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }

        $data['Usuario'] = $this->user->getDatos($index);
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=0;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        $this->load->view('gridtodousuarios',$data);



    }

    function logout(){
        $this->session->sess_destroy();
        redirect('http://localhost/CDI/Panel/');
    }

    public function formAltaUsuario()
    {
        $this->load->view('gridaltausuario');
    }


    public function formDetalleUsuario()
    {
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=0;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        if(isset($_REQUEST['id']))
        {
            $idUser=$_REQUEST['id'];
            $this->session->set_userdata("idusuario",$idUser);
        }
        else
        {
            $idUser=$this->session->userdata('idusuario');
        }
        $this->load->view('griddetalleusuario',$idUser);
    }

    public function formEditarUsuario()

    {
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=0;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        if(isset($_REQUEST['id']))
        {
            $idUser=$_REQUEST['id'];
            $this->session->set_userdata("idusuario",$idUser);
        }
        else
        {
            $idUser=$this->session->userdata('idusuario');
        }

        $this->load->view('grideditarusuario',$idUser);
    }

    function obtenerDatos($idu)
    {
        $prueba= $this->user->obtenerFicha($idu);
        echo json_encode ($prueba);
    }
    function obtenerDatosbase($idubase)
    {
        $prueba= $this->user->obtenerFichabase($idubase);
        echo json_encode ($prueba);
    }
    function pintarMenus($idT)
    {
        $prueba= $this->user->obtenerMenusInternos($idT);
        echo json_encode ($prueba);
    }


    function altaUsuario()
    {
        $data = array(
            'nombreUser' => $this->input->post('nombre'),
            'tipoUser' => $this->input->post('tipo'),
            'correoUser' => $this->input->post('correo'),
            'password' => $this->input->post('password')
        );
        $this->user->insertaDatos($data);
        echo "1";
    }

    function modificarDatos(){
        $idUser=$this->input->post('iduser');
        $nombre=$this->input->post('nombre');
        $nombre=mb_strtoupper ($nombre);

        $tipo=$this->input->post('tipo');
        $correo=$this->input->post('correo');
        $password=$this->input->post('password');

        if (!empty($nombre)) {
            $data = array(
                'nombreUser' => $nombre
            );

            //echo "datos ".$nombre;
            $this->user->modificaDatos($data,$idUser);
        }else{}
        if (!empty($tipo)) {
            $data = array(
                'tipoUser' => $this->input->post('tipo')
            );
            $this->user->modificaDatos($data,$idUser);
        }else{}
        if (!empty($correo)) {
            $data = array(
                'correoUser' => $this->input->post('correo')
            );
            $this->user->modificaDatos($data,$idUser);
        }else{}
        if (!empty($password)) {
            $data = array(
                'password' => $this->input->post('password')
            );
            $this->user->modificaDatos($data,$idUser);
        }else{}
    }

    function deleteUser($idUser){

        $this->user->borrarDatos($idUser);
        redirect('http://localhost/CDI/Panel/index.php/Crudusuarios');

    }


}

?>