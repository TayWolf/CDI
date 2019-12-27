<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(isset($_POST['password'])) //si la variable contiene algún valor
		{
			$this->load->model("user"); //cargamos el controlador de User
			$result=$this->user->login($_POST['correo'],$_POST['password']);
			if($result)//si es verdadero el dato ver el modelo User
			{	
				$name= $result->nombreUser;
				$tipo=$result->tipoUser;
				$iduser=$result->idUser;
				//$foto=$result->fotoUser;

				$this->session->set_userdata("idUser",$iduser);
				$this->session->set_userdata("correoUser",$_POST['correo']);//Generamos la variable de usuario
				$this->session->set_userdata("nombreUser",$name);//Generamos la variable de usuario
				$this->session->set_userdata("idUser",$iduser);//Generamos la variable de usuario
				//$this->session->set_userdata("fotoUser",$foto);
				$this->session->set_userdata("tipoUser",$tipo);
				//echo "datos entrantes  $iduser ";
				// session_start();
				$_SESSION['idusuariobase']=$iduser;
				$_SESSION['tipoUser']=$tipo;
				redirect('menus');
			}
			else
			{	
				$this->session->set_flashdata('mensaje','true');
				echo "<script>
				var r =confirm('El usuario o Contraseña es incorrecta.');
          if (r == true){
          	location.href='http://localhost/CDI/Panel';
             
          }else{
          	location.href='http://localhost/CDI/Panel/';}</script>";

			}
		}
		else
		{
			$this->load->view('viewloginPropuesta1');
		}
		
	}
}
