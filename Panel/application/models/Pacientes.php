<?php
class Pacientes extends CI_Model
{
    public $variable;
    function __construct(){
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM Pacientes")->row_array();
        return $query['row'];
    }



    function getDatos($no_page)
    {
        $perpage = 20; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{

            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        return $this->db->query("SELECT Pacientes.*,clientes.idCliente,clientes.nombreCliente,Remitente.idRemitente,Remitente.nombreRem FROM Pacientes join clientes on clientes.idCliente=Pacientes.cliente join Remitente on Remitente.idRemitente=Pacientes.remitente limit 20 offset $first")->result_array();
    }

    function data_pagination($url, $rows = 5, $uri = 3)
    {
        $this->load->library('pagination');
        $config['per_page']   = 20;
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

    function borrarDatos($id)
    {
        $this->db->where('idPaciente', $id);
        $this->db->delete('Pacientes');
    }

    function obtenerFicha($idP)
    {
        $this->db-> select('Pacientes.*,Remitente.*,clientes.*');
        $this->db->from('Pacientes');
        $this->db->join('Remitente','Pacientes.remitente=Remitente.idRemitente');
        $this->db->join('clientes','Pacientes.cliente=clientes.idCliente');
        $this->db->where('Pacientes.idPaciente',$idP);
        $query = $this->db->get();
        return $query->row();
    }

    function obtenerClave()
    {
        $this->db-> select('idPaciente');
        $this->db->from('Pacientes');
        $this->db->order_by('idPaciente','desc');
        $query = $this->db->get();
        return $query->row();
    }

    function modificaDatos($data,$idP)
    {
        $this->db->where('idPaciente', $idP);
        $this->db->update('Pacientes', $data);

    }

    function insertaDatos($data)
    {
        $this->db->insert('Pacientes', $data);
        return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
    }

    function remitente()
    {
        return $this->db->query("SELECT * FROM Remitente")->result_array();
    }
    function cliente()
    {
        return $this->db->query("SELECT * FROM clientes")->result_array();
    }
    function cuentaTodosPacientes()
    {
        return $this->db->get('Pacientes')->num_rows();
    }
    function allPacientes($limit,$start,$col,$dir)
    {
        $query=$this->db->select("Pacientes.*,clientes.nombreCliente,Remitente.nombreRem")
            ->from("Pacientes")
            ->join("clientes", "clientes.idCliente=Pacientes.cliente")
            ->join("Remitente", "Remitente.idRemitente=Pacientes.remitente")
            ->limit($limit,$start)
            ->order_by($col,$dir)
            ->get();

        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }
    function busquedaPaciente($limit,$start,$search,$col,$dir)
    {
        $query = $this->db->select("Pacientes.*,clientes.nombreCliente,Remitente.nombreRem")
            ->from("Pacientes")
            ->join("clientes", "clientes.idCliente=Pacientes.cliente")
            ->join("Remitente", "Remitente.idRemitente=Pacientes.remitente")
            ->like('correoPaci',$search)
            ->or_like('nombrePaci',$search)
            ->or_like('razonSocial',$search)
            ->or_like('domFiscal',$search)
            ->or_like('Pacientes.RFC',$search)
            ->limit($limit,$start)
            ->order_by($col,$dir)
            ->get();


        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }
    function cuentaPacientesFiltrados($search)
    {
        $query = $this
            ->db
            ->like('correoPaci',$search)
            ->or_like('nombrePaci',$search)
            ->or_like('razonSocial',$search)
            ->or_like('domFiscal',$search)
            ->or_like('Pacientes.RFC',$search)
            ->get('Pacientes');

        return $query->num_rows();
    }

}


?>