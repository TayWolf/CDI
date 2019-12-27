<?php

class Permisos extends CI_Model
{
    function getTiposUsuario()
    {
        return $this->db->query("SELECT * FROM usuarios GROUP BY usuarios.tipoUser")->result_array();
    }

    function validacionExistencia($idTipoUsuario, $idModulo)
    {

        $existencia=$this->db->query("SELECT * FROM Permiso WHERE idTipoUsuario=$idTipoUsuario AND idModulo=$idModulo")->row_array();

        if(empty($existencia))
        {
            $this->db->insert("Permiso", array('idTipoUsuario' => $idTipoUsuario, 'idModulo' => $idModulo));
        }

    }
    function validacionExistenciaPermisoEspecifico($idTipoUsuario, $idModulo, $columna)
    {

        $existencia=$this->db->query("SELECT * FROM PermisoEspecifico WHERE idTipoUsuario=$idTipoUsuario AND idModulo=$idModulo AND nombreColumna='$columna'")->row_array();
        if(empty($existencia))
        {
            $this->db->insert("PermisoEspecifico", array('idTipoUsuario' => $idTipoUsuario, 'idModulo' => $idModulo, 'nombreColumna' => $columna));
        }

    }

    function actualizarPermiso($idTipoUsuario, $idModulo, $data)
    {
        $this->db->where("idTipoUsuario", $idTipoUsuario);
        $this->db->where("idModulo", $idModulo);
        $this->db->update("Permiso", $data);
    }
    function actualizarPermisoEspecifico($idTipoUsuario, $idModulo, $columna, $data)
    {
        $this->db->where("idTipoUsuario", $idTipoUsuario);
        $this->db->where("idModulo", $idModulo);
        $this->db->where("nombreColumna", $columna);
        $this->db->update("PermisoEspecifico", $data);
    }


    function getPermisosUsuario($idTipoUsuario)
    {
        return $this->db->query("SELECT * FROM Permiso WHERE idTipoUsuario=$idTipoUsuario")->result_array();
    }

    function getPermisosEspecificosUsuario($idTipoUsuario)
    {
        return $this->db->query("SELECT * FROM PermisoEspecifico WHERE idTipoUsuario=$idTipoUsuario")->result_array();
    }

    // Saca permisos de un usuario en un modulo
    function getPermisosUsuarioModulo($idTipoUsuario, $idModulo){
        return $this->db->query("SELECT * FROM Permiso WHERE idTipoUsuario=$idTipoUsuario AND idModulo=$idModulo")->row_array();
        //$arreglo['permiso']
    }
    // Saca permisos especificos de un usuario en un modulo
    function getPermisosEspecificosUsuarioModulo($idTipoUsuario, $idModulo)
    {
        return $this->db->query("SELECT * FROM PermisoEspecifico WHERE idTipoUsuario=$idTipoUsuario AND idModulo=$idModulo")->result_array();
    }

}