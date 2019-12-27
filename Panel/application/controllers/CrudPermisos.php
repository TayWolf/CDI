<?php

class CrudPermisos extends CI_Controller
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
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=31;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
    }
    function index()
    {

        $data['tiposUsuario']=$this->Permisos->getTiposUsuario();
        $this->load->view("viewTiposUsuario", $data);
    }
    function verPermisos($idTipoUsuario)
    {
        $data['idTipo']=$idTipoUsuario;
        $this->load->view("viewPermisosUsuario", $data);
    }

    function asignarPermiso($idTipoUsuario, $permiso, $campo, $idModulo)
    {
        $this->validarExistencia($idTipoUsuario, $idModulo);
        $this->Permisos->actualizarPermiso($idTipoUsuario, $idModulo, array($campo => $permiso));
        echo json_encode($permiso);
    }
    function asignarPermisoEspecifico($idTipoUsuario, $acceso, $columna, $idModulo)
    {
        $this->validarExistenciaPermisoEspecifico($idTipoUsuario, $idModulo, $columna);
        $this->Permisos->actualizarPermisoEspecifico($idTipoUsuario, $idModulo, $columna, array('acceso'=> $acceso));
        echo json_encode($acceso);
    }
    function validarExistencia($idTipoUsuario,$idModulo)
    {
        $this->Permisos->validacionExistencia($idTipoUsuario, $idModulo);
    }
    function validarExistenciaPermisoEspecifico($idTipoUsuario,$idModulo, $columna)
    {
        $this->Permisos->validacionExistenciaPermisoEspecifico($idTipoUsuario, $idModulo, $columna);
    }
    function getPermisosUsuario($idTipoUsuario)
    {
        echo json_encode($this->Permisos->getPermisosUsuario($idTipoUsuario));
    }
    function getPermisosEspecificos($idTipoUsuario)
    {
        echo json_encode($this->Permisos->getPermisosEspecificosUsuario($idTipoUsuario));
    }
}