<?php
class Buscador extends CI_Model
{
	public $variable;

	function __construct(){
		parent::__construct();
	}

  function traerdatosusuario($valor)
    { 
      if ($valor == "todo") {
        return $this->db->query("SELECT * FROM usuarios")->result_array();
      }
      else if ($valor == "1" || $valor == "Administrador" || $valor == "administradores" || $valor == "Administradores" || $valor == "ADMINISTRADOR" || $valor == "ADMINISTRADORES" || $valor == "admin" || $valor == "Admin" || $valor == "ADMIN") {
        return $this->db->query("SELECT * FROM usuarios WHERE tipoUser = 1")->result_array();
      }
      else if ($valor == "2" || $valor == "Empleado" || $valor == "empleados" || $valor == "Empleados" || $valor == "EMPLEADO" || $valor == "EMPLEADOS") {
        return $this->db->query("SELECT * FROM usuarios WHERE tipoUser = 2")->result_array();
      }
      else{
        return $this->db->query("SELECT * FROM usuarios where nombreUser like '%$valor%' or correoUser like '%$valor%'")->result_array();
      }
    }

  function traerdatoscategoria($valor)
    { 
      if ($valor == "todo") {
        return $this->db->query("SELECT * FROM categoriaEstudio")->result_array();
      }else{
        return $this->db->query("SELECT * FROM categoriaEstudio where nombreCat like '%$valor%'")->result_array();
      }
    }

  function traerdatoslinea($valor)
    { 
      if ($valor == "todo") {
        return $this->db->query("SELECT * FROM linea")->result_array();
      }else{
        return $this->db->query("SELECT * FROM linea where nombre like '%$valor%'")->result_array();
      }
    }

  function traerdatosproveedor($valor)
    { 
      if ($valor == "todo") {
        return $this->db->query("SELECT * FROM Proveedores")->result_array();
      }else{
        return $this->db->query("SELECT * FROM Proveedores where nombreP like '%$valor%'")->result_array();
      }
    }
  function traerdatosarea($valor)
    { 
      if ($valor == "todo") {
        return $this->db->query("SELECT * FROM Areas")->result_array();
      }else{
        return $this->db->query("SELECT * FROM Areas where nombreArea like '%$valor%'")->result_array();
      }
    }
  function traerdatospedido($valor)
    { 
      if ($valor == "todo"||$valor=="todos") {
        return $this->db->query("SELECT * FROM controlPedidos ORDER BY fechaPedido DESC")->result_array();
      }else{
        return $this->db->query("SELECT * FROM controlPedidos where fechaPedido like '%$valor%' OR personaPedido like '%$valor%' OR AreaPedido like '%$valor%' ORDER BY fechaPedido DESC")->result_array();
      }
    }
  function traerdatosempresa($valor)
    { 
      if ($valor == "todo" || $valor == "TODO" || $valor == "Todo" || $valor == "todos" || $valor == "TODOS" || $valor == "Todos" ) {
        return $this->db->query("SELECT * FROM Empresas")->result_array();
      }else{
      return $this->db->query("SELECT * FROM Empresas where nombreEmpresa like '%$valor%'")->result_array();
      }
    }

  function traerdatosdoctor($valor)
    { 
      if ($valor == "todo" || $valor == "TODO" || $valor == "Todo" || $valor == "todos" || $valor == "TODOS" || $valor == "Todos" ) {
        return $this->db->query("SELECT * FROM Doctores")->result_array();
      }
      else if($valor == "1" || $valor == "activos" || $valor == "Activos" || $valor == "ACTIVOS") {
        return $this->db->query("SELECT * FROM Doctores where status = 1")->result_array();
      }
      else if($valor == "2" || $valor == "inactivos" || $valor == "Inactivos" || $valor == "INACTIVOS") {
        return $this->db->query("SELECT * FROM Doctores where status = 2")->result_array();
      }
      else{
      return $this->db->query("SELECT * FROM Doctores where nombreDoc like '%$valor%'")->result_array();
      }
    }

    function traerdatossala($valor)
    { 
      if ($valor == "todo" || $valor == "TODO" || $valor == "Todo" || $valor == "todos" || $valor == "TODOS" || $valor == "Todos" ) {
        return $this->db->query("SELECT * FROM Salas")->result_array();
      }else{
        return $this->db->query("SELECT * FROM Salas where nombre like '%$valor%'")->result_array();
      }
    }
    function traerdatosEstudio($valor)
    { 
      if ($valor == "todo" || $valor == "TODO" || $valor == "Todo" || $valor == "todos" || $valor == "TODOS" || $valor == "Todos" ) {
        return $this->db->query("SELECT * FROM Estudio")->result_array();
      }else{
        return $this->db->query("SELECT * FROM Estudio where nombreEstudio like '%$valor%'")->result_array();
      }
    }

    function traerdatosArticulo($valor)
    { 
      if ($valor == "todo" || $valor == "TODO" || $valor == "Todo" || $valor == "todos" || $valor == "TODOS" || $valor == "Todos" ) {
        return $this->db->query("SELECT * FROM articulos")->result_array();
      }else{
        return $this->db->query("SELECT * FROM articulos where nombre like '%$valor%'")->result_array();
      }
    }

    function traerdatosremitente($valor)
    { 
      if ($valor == "todo" || $valor == "TODO" || $valor == "Todo" || $valor == "todos" || $valor == "TODOS" || $valor == "Todos" ) {
        return $this->db->query("SELECT Remitente.*, estados.nombreEstado, municipios.nombreMunicipio, regiones.nombreRegion FROM Remitente join estados on estados.id_Estado = Remitente.estadoRem join municipios on municipios.idMunicipio = Remitente.ciudadRem join regiones on regiones.idRegiones = Remitente.coloniaRem")->result_array();
      
      }else{
        return $this->db->query("SELECT Remitente.*, estados.nombreEstado, municipios.nombreMunicipio, regiones.nombreRegion FROM Remitente join estados on estados.id_Estado = Remitente.estadoRem join municipios on municipios.idMunicipio = Remitente.ciudadRem join regiones on regiones.idRegiones = Remitente.coloniaRem WHERE nombreRem like '%$valor%'")->result_array();
      }
    }
    function traerdatoscliente($valor)
    { 
      if ($valor == "todo" || $valor == "TODO" || $valor == "Todo" || $valor == "todos" || $valor == "TODOS" || $valor == "Todos" ) {
        return $this->db->query("SELECT clientes.*,estados.nombreEstado,municipios.nombreMunicipio,regiones.nombreRegion,regiones.cp FROM clientes join estados on estados.id_Estado = clientes.Estado join municipios on municipios.idMunicipio = clientes.municipio join regiones on regiones.idRegiones = clientes.Colonia")->result_array();

      }else{
        return $this->db->query("SELECT * FROM clientes  where nombreCliente like '%$valor%' ")->result_array();
      }
    }
    
    
    function traerdatospaciente($valor)
    { 
      if ($valor == "todo" || $valor == "TODO" || $valor == "Todo" || $valor == "todos" || $valor == "TODOS" || $valor == "Todos" ) {
        return $this->db->query("SELECT Pacientes.*,clientes.nombreCliente,Remitente.nombreRem FROM Pacientes join clientes on clientes.idCliente=Pacientes.cliente join Remitente on Remitente.idRemitente=Pacientes.remitente")->result_array();

      }else{
        return $this->db->query("SELECT Pacientes.*,clientes.nombreCliente,Remitente.nombreRem FROM Pacientes join clientes on clientes.idCliente=Pacientes.cliente join Remitente on Remitente.idRemitente=Pacientes.remitente where Pacientes.nombrePaci like '%$valor%' ")->result_array();
      }
    }

}


?>