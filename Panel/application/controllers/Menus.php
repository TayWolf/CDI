<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menus extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("user");
    }
    public function index()
    {
        $tipo=$this->session->userdata('tipoUser');//Recibimos el tipo d ela variable de sessión
        $correo=$this->session->userdata('correoUser');//Recibimos el tipo d ela variable de sessión de correo
        //echo "tipo $tipo correo $correo ";
        if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
        $this->load->model("Permisos");
        $data['permisos']=$this->Permisos->getPermisosUsuario($tipo);
        $data['total'] = $this->user->total();
        if($tipo!='' && $_SESSION['idusuariobase'] != '')
        {
            /*if($tipo==1)
            {*/
            $this->load->view('header');
            $this->load->view('principal',$data);
            $this->load->view('footer');
            /*}
            if ($tipo==2) {
                $this->load->view('header');
                $this->load->view('principalEmpleado');
                $this->load->view('footerempleado');
            }
            if ($tipo==3) {
                $this->load->view('header');
                $this->load->view('principalalmacen');
                $this->load->view('footeralmacen');
            }
            if ($tipo==4) {
                $this->load->view('header');
                $this->load->view('principalrecepcionista');
                $this->load->view('footeralmacen');
            }
            if($tipo==5){
                $this->load->view("header");
                $this->load->view('principalCajera');
                $this->load->view('footerCajera');
            }
            if($tipo==6){
                $this->load->view("header");
                $this->load->view('principalComplementaria');
                $this->load->view('footerComplementaria');
            }
            if($tipo==7){
                $this->load->view("header");
                $this->load->view('principalCompras');
                $this->load->view('footerCompras');
            }	*/
        }
        else{
            header("location: http://localhost/CDI/Panel/");
        }
    }
}
	