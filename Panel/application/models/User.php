<?php
class User extends CI_Model
{
    function __construct(){
        parent::__construct();
    }
    function login($correo,$password)
    {

        $this ->db-> select('*');
        $this ->db-> from('usuarios');
        $this ->db->where('correoUser', $correo);
        $this ->db->where('password', $password);
        $query = $this -> db -> get();

        if($query -> num_rows() >= 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM usuarios")->row_array();
        return $query['row'];
    }
    public function total()
    {
        return $this->db->query("SELECT count(*) as row FROM usuarios")->result_array();
    }

    function obtenerId($userCorreo)
    {

        $this->db->select('idusuario,correo,nombre');
        $this->db->from('usuarios');
        $this->db->where('correo',$userCorreo);
        $this->db->where('status!=1');
        $query = $this->db->get();
        $id=0;
        $correo=0;
        $nombre=0;
        foreach ($query->result() as $row) {

            $id=$row->idusuario;
            $correo=$row->correo;
            $nombre=$row->nombre;
        }

        return $arrayName = array('id' => $id, 'correo' => $correo,'nombre' => $nombre);
    }

    function getDatos($no_page)
    {

        return $this->db->query("SELECT * FROM usuarios")->result_array();

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

    function obtenerFicha($idu)
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('idUser',$idu);
        $query = $this->db->get();
        return $query->row();

    }

    function obtenerFichaDelete($idUser)
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('idUser',$idUser);
        $query = $this->db->get();
        return $query->row();

    }

    function obtenerFichabase($idubase)
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('idUser',$idubase);
        $query = $this->db->get();
        return $query->row();
        // return $this->db->query("SELECT permiso.*,usuarios.tipoUser FROM `permiso` join usuarios on permiso.idTipoUsuario=usuarios.tipoUser WHERE usuarios.idUser=$idubase")->result_array();
    }

    function obtenerMenusInternos($idT)
    {
        return $this->db->query("SELECT Permiso.*,usuarios.tipoUser FROM `Permiso` join usuarios on Permiso.idTipoUsuario=usuarios.tipoUser WHERE usuarios.tipoUser=$idT and mostrar=1 GROUP BY Permiso.idModulo;")->result_array();
    }

    function insertaDatos($data)
    {
        $this->db->insert('usuarios', $data);
    }

    function modificaDatos($data,$idUser)
    {
        $this->db->where('idUser', $idUser);
        $this->db->update('usuarios', $data);
    }

    function borrarDatos($idUser)
    {
        $this->db->where('idUser', $idUser);
        $this->db->delete('usuarios');
    }

    public function excel($table_name,$sql)
    {
        //si existe la tabla
        if ($this->db->table_exists("$table_name"))
        {
            //si es un array y no está vacio
            if(!empty($sql) && is_array($sql))
            {
                //si se lleva a cabo la inserción
                if($this->db->insert_batch("$table_name", $sql))
                {
                    return TRUE;
                }else{
                    return FALSE;
                }
            }
        }
    }


}


?>