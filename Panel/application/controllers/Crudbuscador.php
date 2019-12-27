<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crudbuscador extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("buscador"); //cargamos el modelo de User
		
	}
	function buscadorusuario($datos)
	{
		$valor = str_replace("%20"," ",$datos);
    	$prueba= $this->buscador->traerdatosusuario($valor);
    	echo json_encode ($prueba);
	}
	function buscadorcategoria($datos)
	{
		$valor = str_replace("%20"," ",$datos);
    	$prueba= $this->buscador->traerdatoscategoria($valor);
    	echo json_encode ($prueba);
	}
	function buscadorlinea($datos)
	{
		$valor = str_replace("%20"," ",$datos);
    	$prueba= $this->buscador->traerdatoslinea($valor);
    	echo json_encode ($prueba);
	}
	function buscadorproveedor($datos)
	{
		$valor = str_replace("%20"," ",$datos);
    	$prueba= $this->buscador->traerdatosproveedor($valor);
    	echo json_encode ($prueba);
	}
	function buscadorarea($datos)
	{
		$valor = str_replace("%20"," ",$datos);
    	$prueba= $this->buscador->traerdatosarea($valor);
    	echo json_encode ($prueba);
	}
	function buscadorpedido($datos)
	{
		$valor = str_replace("%20"," ",$datos);
    	$prueba= $this->buscador->traerdatospedido($valor);
    	echo json_encode ($prueba);
	}

	function buscadorEmpresa($datos)
	{
		$valor = str_replace("%20"," ",$datos);
		$prueba= $this->buscador->traerdatosempresa($valor);
    	echo json_encode ($prueba);
	}
	function buscadordoctor($datos)
	{
		$valor = str_replace("%20"," ",$datos);
		$prueba= $this->buscador->traerdatosdoctor($valor);
    	echo json_encode ($prueba);
	}
	function buscadorsala($datos)
	{
		$valor = str_replace("%20"," ",$datos);
		$prueba= $this->buscador->traerdatossala($valor);
    	echo json_encode ($prueba);
	}
	function buscadorEstudio($datos)
	{
		$valor = str_replace("%20"," ",$datos);
		$prueba= $this->buscador->traerdatosEstudio($valor);
    	echo json_encode ($prueba);
	}
	function buscadorremitente($datos)
	{
		$valor = str_replace("%20"," ",$datos);
		$prueba= $this->buscador->traerdatosremitente($valor);
    	echo json_encode ($prueba);
	}

	function buscadorArticulo($datos)
	{
		$valor = str_replace("%20"," ",$datos);
		$prueba= $this->buscador->traerdatosArticulo($valor);
    	echo json_encode ($prueba);
	}

	function buscadorcliente($datos)
	{
		$valor = str_replace("%20"," ",$datos);
		$prueba= $this->buscador->traerdatoscliente($valor);
    	echo json_encode ($prueba);
	}
	function buscadorpaciente($datos)
	{
		$valor = str_replace("%20"," ",$datos);
		$prueba= $this->buscador->traerdatospaciente($valor);
    	echo json_encode ($prueba);
	}

	}

?>