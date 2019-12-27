<?php
class Estudio extends CI_Model
{
    public $variable;
    function __construct(){
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM Estudio")->row_array();
        return $query['row'];
    }

    function cuentaTodosEstudio()
    {
        return $this->db->get('Estudio')->num_rows();
    }

    function allEstudio($limit,$start,$col,$dir)
    {
        $query=$this->db->select("Estudio.*, categoriaEstudio.nombreCat,Empresas.nombreEmpresa")
            ->from("Estudio")
            ->join("categoriaEstudio", "categoriaEstudio.idCat = Estudio.idCat")
            ->join("Empresas", "Empresas.idEmpresa=Estudio.idEmpresa")
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

    function busquedaEstudio($limit,$start,$search,$col,$dir)
    {
        $query = $this->db->select("Estudio.*, categoriaEstudio.nombreCat,Empresas.nombreEmpresa")
            ->from("Estudio")
            ->join("categoriaEstudio", "categoriaEstudio.idCat = Estudio.idCat")
            ->join("Empresas", "Empresas.idEmpresa=Estudio.idEmpresa")
            ->like('nombreEstudio',$search)
            ->or_like('indicacionesPaciente',$search)
            ->or_like('claveSat',$search)
            ->or_like('precioPublico',$search)
            ->or_like('Empresas.RFC',$search)
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

    function cuentaEstudioFiltrados($search)
    {
        $query = $this
            ->db->select("Estudio.idEstudio")
            ->from("Estudio")
            ->join("categoriaEstudio", "categoriaEstudio.idCat = Estudio.idCat")
            ->join("Empresas", "Empresas.idEmpresa=Estudio.idEmpresa")
            ->like('nombreEstudio',$search)
            ->or_like('indicacionesPaciente',$search)
            ->or_like('claveSat',$search)
            ->or_like('precioPublico',$search)
            ->or_like('Empresas.RFC',$search)
            ->get();

        return $query->num_rows();
    }


    function getDatos($no_page)
    {

        return $this->db->query("SELECT Estudio.*, categoriaEstudio.nombreCat,Empresas.nombreEmpresa FROM Estudio join categoriaEstudio on categoriaEstudio.idCat = Estudio.idCat join Empresas on Empresas.idEmpresa=Estudio.idEmpresa")->result_array();

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
    function borrarDatos($idEstudio)
    {
        $this->db->where('idEstudio', $idEstudio);
        $this->db->delete('Estudio');
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

    function obtenerClientes()
    {
        return $this->db->query("SELECT * FROM clientes WHERE precioEspecial=1 ")->result_array();
    }

    function getEmpresariales()
    {
        return $this->db->query("SELECT * FROM Empresas ")->result_array();
    }

    function obtenerStatus($idSala)
    {
        return $this->db->query("SELECT horarios FROM Salas  where idSala=$idSala")->row();
    }

    function obtenerPreciosClientes($idCli,$idEst)
    {
        return $this->db->query("SELECT * FROM preciocliente WHERE IdEstudio = $idEst and Idcliente = $idCli")->row();
    }

    function obtenerdisponibles($i,$actual)
    {
        return $this->db->query("SELECT * FROM Salas WHERE NOT EXISTS (SELECT idSala FROM salaEstudio where idSala = $i and idEstudio = $actual) and idSala = $i")->row();
        // $this->db->select('idSala,nombre');
        // $this->db->from('Salas');
        // $this->db->where('NOT EXISTS (SELECT idSala FROM salaEstudio where idSala = $i and idEstudio = $actual)');
        // $this->db->where('idSala = $i');
        // $query = $this->db->get();
        // $idSala = 0;
        // $nombre = 0;
        // foreach ($query -> result() as $row) {
        //   $idSala = $row->idSala;
        //   $nombre = $row->nombre;
        // }
        // return $arrayname = array('idSala'=> $idSala, 'nombre'=>$nombre);
    }
    function obtenerasignadas($sala,$actual)
    {
        return $this->db->query("SELECT * FROM Salas WHERE EXISTS (SELECT idSala FROM salaEstudio where idSala = $sala and idEstudio = $actual) and idSala = $sala")->row();
    }

    function getSalas()
    {
        return $this->db->query("SELECT * FROM Salas ")->result_array();
    }

    function getClientes()
    {
        return $this->db->query("SELECT * FROM clientes")->result_array();
    }

    function getCategorias()
    {
        return $this->db->query("SELECT * FROM categoriaEstudio")->result_array();
    }

    function getEmpresas()
    {
        return $this->db->query("SELECT * FROM Empresas")->result_array();
    }

    function modificaCategoria($data,$idEstudio){
        $this->db->where('IdEstudio', $idEstudio);
        $this->db->update('Estudio', $data);
    }

    function modificaEmpre($data,$idEstudio){
        $this->db->where('IdEstudio', $idEstudio);
        $this->db->update('Estudio', $data);
    }

    function modificaDatos($data,$idEstudio)
    {
        $this->db->where('IdEstudio', $idEstudio);
        $this->db->update('Estudio', $data);

    }

    function modificaPrecios($data,$idpreciocliente)
    {
        $this->db->where('idpreciocliente', $idpreciocliente);
        $this->db->update('preciocliente', $data);

    }

    function modifcaStatus($data,$idSala)
    {
        $this->db->where('idSala', $idSala);
        $this->db->update('Salas', $data);
    }

    function insertaDatos($data)
    {
        $this->db->insert('Estudio', $data);
    }

    function insertaPrecio($data)
    {
        $this->db->insert('preciocliente', $data);
    }

    function insertaDatosPuente($data)
    {
        $this->db->insert('salaEstudio', $data);
    }

    function quitarDatosPuente($idS,$total,$idactual)
    {
        $this->db->where('idEstudio', $idactual);
        $this->db->where('idSala', $idS);
        $this->db->delete('salaEstudio');
    }

    function getNombreEstudio($idEstudio)
    {
        $this->db->select("nombreEstudio");
        $this->db->from("Estudio");
        $this->db->where("Estudio.idEstudio", $idEstudio);
        $nombre=$this->db->get()->row_array();
        return $nombre['nombreEstudio'];
    }
}


?>