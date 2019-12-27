<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPacientes extends CI_Controller {
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
        $this->load->model("pacientes"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=9;
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
        $data['pacientes'] = $this->pacientes->getDatos($index);
        $data['medico'] = $this->pacientes->remitente();
        $data['cliente'] = $this->pacientes->cliente();
        $this->load->view('gridtodopacientes',$data);


    }

    public function altaPacientes()
    {
        $data['medico'] = $this->pacientes->remitente();
        $data['cliente'] = $this->pacientes->cliente();
        $this->load->view('gridaltapaciente',$data);
    }
    // function getMuni($idEdo)
    // {
    // 	 $prueba= $this->clientes->obtenerMuni($idEdo);
    //       echo json_encode ($prueba);
    // }

    // function getColo($idMuni)
    // {
    // 	 $prueba= $this->clientes->obtenerColo($idMuni);
    //       echo json_encode ($prueba);
    // }

    // function getPostal($coloniaCl)
    // {
    // 	 $prueba= $this->clientes->obtenerPostal($coloniaCl);
    //       echo json_encode ($prueba);
    // }

    public function detallePaciente()
    {
        $idP=$_REQUEST['id'];
        $this->load->view('griddetallepaciente',$idP);
    }

    public function ModificarPaciente()
    {
        $idP=$_REQUEST['id'];
        $data['medico'] = $this->pacientes->remitente();
        $data['cliente'] = $this->pacientes->cliente();
        $this->load->view('grideditarpaciente',$data,$idP);
    }


    function obtenerDatos($idP)
    {
        $prueba= $this->pacientes->obtenerFicha($idP);
        echo json_encode ($prueba);
    }
    function traeclave(){
        $prueba= $this->pacientes->obtenerClave();
        echo json_encode ($prueba);
    }

    function eliminarPaciente($id)
    {
        $this->pacientes->borrarDatos($id);
        redirect('http://localhost/CDI/Panel/index.php/Crudpacientes');
    }

    function agregaPaciente()
    {

        $data = array(
            'nombrePaci' => $this->input->post('nombre'),
            'clavePaci' => $this->input->post('clave'),
            'generoPaci' => $this->input->post('genero'),
            'correoPaci' => $this->input->post('correo'),
            'edadPaci' => $this->input->post('edad'),
            'fechanaciPaci' => $this->input->post('fechanaci'),
            'telefonoPaci' => $this->input->post('telefono'),
            'remitente' => $this->input->post('remitente'),
            'cliente' => $this->input->post('cliente'),
            //Cambios
            'razonSocial' => $this->input->post('razonSocial'),
            'domFiscal' => $this->input->post('domfiscal'),
            'RFC' => $this->input->post('RFC'),
            'telefono' => $this->input->post('telefonopaciente'),
            'colonia' => $this->input->post('colonia'),
            'municipio' => $this->input->post('municipio'),
            'estado' => $this->input->post('estado')
        );
        $idPrimaria=$this->pacientes->insertaDatos($data);
        foreach ($idPrimaria as $key3 =>$val)
            echo($val['LAST_INSERT_ID()']);
    }

    function modificarDatos(){
        //echo "datos entra";
        $idPaci=$this->input->post('idPaciente');
        $nombre=$this->input->post('nombre');
        $nombre=mb_strtoupper($nombre);

        $genero=$this->input->post('genero');
        $correo=$this->input->post('correo');
        $edad=$this->input->post('edad-paciente');
        $fecha=$this->input->post('fecha');
        $telefono=$this->input->post('telefono');
        $telefono=mb_strtoupper($telefono);

        $razonSocial=$this->input->post('razonSocial');
        $razonSocial=mb_strtoupper($razonSocial);

        $domFiscal=$this->input->post('domFiscal');
        $domFiscal=mb_strtoupper($domFiscal);

        $RFC=$this->input->post('RFC');
        $RFC=mb_strtoupper($RFC);

        $telefono=$this->input->post('telefono');
        $colonia=$this->input->post('colonia');
        $colonia=mb_strtoupper($colonia);

        $municipio=$this->input->post('municipio');
        $municipio=mb_strtoupper($municipio);

        $estado=$this->input->post('estado');
        $estado=mb_strtoupper($estado);


        if (!empty($nombre)) {
            $data = array(
                'nombrePaci' => $nombre
            );
            $this->pacientes->modificaDatos($data,$idPaci);
            //echo "entra ".this->input->post('nombre');
        }else{}

        if (!empty($genero)) {
            $data = array(
                'generoPaci' => $this->input->post('genero')
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($correo)) {
            $data = array(
                'correoPaci' => $this->input->post('correo')
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($edad)) {
            $data = array(
                'edadPaci' => $this->input->post('edad')
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}


        if (!empty($fecha)) {
            $data = array(
                'fechanaciPaci' => $this->input->post('fecha')
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($telefono)) {
            $data = array(
                'telefonoPaci' => $telefono
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($razonSocial)) {
            $data = array(
                'razonSocial' => $razonSocial
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($domFiscal)) {
            $data = array(
                'domFiscal' => $domFiscal
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($RFC)) {
            $data = array(
                'RFC' => $RFC
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($telefono)) {
            $data = array(
                'telefono' => $telefono
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($colonia)) {
            $data = array(
                'colonia' => $colonia
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($estado)) {
            $data = array(
                'estado' => $estado
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}

        if (!empty($municipio)) {
            $data = array(
                'municipio' => $municipio
            );
            $this->pacientes->modificaDatos($data,$idPaci);
        }else{}


        // { $idP = $this->input->post('idP');
        //         $data = array(
        //             'nombrePaci' => $this->input->post('nombre'),
        // 	            'clavePaci' => $this->input->post('clave'),
        // 	            'generoPaci' => $this->input->post('genero'),
        // 	            'correoPaci' => $this->input->post('correo'),
        // 	            'edadPaci' => $this->input->post('edad'),
        // 	            'fechanaciPaci' => $this->input->post('fechanaci'),
        // 	            'telefonoPaci' => $this->input->post('telefono'),
        // 	            'remitente' => $this->input->post('remitente'),
        // 	            'cliente' => $this->input->post('cliente')
        //             );
        //         $this->pacientes->modificaDatos($data,$idP);}
    }
    function editaCliente(){
        $idClie = $this->input->post('idCliente');
        $idPac = $this->input->post('id');
        //echo "idClie $idClie idPac $idPac";
        $data = array(
            'cliente' => $idClie
        );
        $this->pacientes->modificaDatos($data,$idPac);

    }



    function traerClie(){
        $prueba= $this->pacientes->cliente();
        echo json_encode ($prueba);
    }

    function editaRemite(){
        $idRemi = $this->input->post('idRemi');
        $idPac = $this->input->post('id');
        //echo "idClie $idClie idPac $idPac";
        $data = array(
            'remitente' => $idRemi
        );
        $this->pacientes->modificaDatos($data,$idPac);

    }

    function traerRemite(){
        $prueba= $this->pacientes->remitente();
        echo json_encode ($prueba);
    }

    //Funcion del lado de servidor que provee el listado de los pacientes a un DataTable
    function getListadoPacientes()
    {
        $columnas=array(
            0 => 'idPaciente',
            1 => 'Paciente',
            2 => 'Genero_Paciente',
            3 => 'Correo_Paciente',
            4 => 'Edad_Paciente',
            5 => 'Fecha_Nacimiento_Paciente',
            6 => 'Telefono_Paciente',
            7 => 'Cliente',
            8 => 'Remitente',
            9 => 'Razon_Social',
            10 => 'Domicilio_Fiscal',
            11 => 'RFC',
            12 => 'Telefono',
            13 => 'Colonia',
            14 => 'Municipio',
            15 => 'Estado',
            16 => 'Eliminar'
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columnas[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->pacientes->cuentaTodosPacientes();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value']))
        {
            $pacientes = $this->pacientes->allPacientes($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $pacientes =  $this->pacientes->busquedaPaciente($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->pacientes->cuentaPacientesFiltrados($search);
        }
        $data = array();
        if(!empty($pacientes))
        {
            foreach ($pacientes as $paciente)
            {


                $nestedData['idPaciente']=$paciente['idPaciente'];
               // $nestedData['Cliente']=$paciente['nombreCliente'];
                $nestedData['Cliente']="<div id='nombreCliente".$paciente['idPaciente']."' ondblclick=traerCliente(".$paciente['idPaciente'].");>".$paciente['nombreCliente']."</div>
                                                           <td id='muestraselectCliente".$paciente['idPaciente']."' style='display: none;'>
                                                                <select style='display: none;' id='selectCliente".$paciente['idPaciente']."' name='selectCliente".$paciente['idPaciente']."' onchange='modificarDatosClien(".$paciente['idPaciente'].");'></select>
                                                           </td>";
                //$nestedData['Remitente']=$paciente['nombreRem'];
                $nestedData['Remitente']="<div id='nombreRemite".$paciente['idPaciente']."' ondblclick=traerRemite(".$paciente['idPaciente'].");>".$paciente['nombreRem']."</div>
                                                             <td id='muestraselectRemite".$paciente['idPaciente']."' style='display: none;'>
                                                                <select style='display: none;' id='selectRemite".$paciente['idPaciente']."' name='selectRemite".$paciente['idPaciente']."' onchange='modificarDatosRemite(".$paciente['idPaciente'].");'></select>
                                                           </td>";


                $nestedData['Paciente']=$paciente['nombrePaci'];
                if ($paciente['generoPaci']==1) {
                    $genero="Masculino";
                } else {
                    $genero="Femenino";
                }
                $nestedData['Genero_Paciente']=$genero;

                $nestedData['Correo_Paciente']=$paciente['correoPaci'];
                $nestedData['Edad_Paciente']=$paciente['edadPaci'];
                $nestedData['Fecha_Nacimiento_Paciente']=$paciente['fechanaciPaci'];
                $nestedData['Telefono_Paciente']=$paciente['telefonoPaci'];
                $nestedData['Razon_Social']=$paciente['razonSocial'];
                $nestedData['Domicilio_Fiscal']=$paciente['domFiscal'];
                $nestedData['RFC']=$paciente['RFC'];
                $nestedData['Telefono']=$paciente['telefono'];
                $nestedData['Colonia']=$paciente['colonia'];
                $nestedData['Municipio']=$paciente['municipio'];
                $nestedData['Estado']=$paciente['estado'];
                $nestedData['Eliminar']="<a href='#' onclick='deletePaciente(".$paciente['idPaciente'].");'>Eliminar</a>";

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);

    }
}

?>