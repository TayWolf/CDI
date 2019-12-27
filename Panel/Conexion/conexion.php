<?php
class conexion
{
	var $servidor="localhost"; //Se determina el atributo servidor
	var $usuario="root"; //Se determina el atributo usuario
	var $contra=""; //Se determina el atributo de contraseña
	var $mysqli;
	var $link;
	function conecta() //se declara el método conecta sin atributos o valores de entrada
	 {
	$this->link =$this->mysqli = new mysqli($this->servidor,$this->usuario,$this->contra); // se realiza la conexión

		 if(!$this->link) // se valida que la conexión sea exitosa
		 {
		 	 die('Connection failed: ' . $this->link->error());
		 }


 }
}
/*$servidor="localhost"; //Se determina el atributo servidor
$usuario="cobraaut_comment"; //Se determina el atributo usuario
$contrasenha="cobra12345"; //Se determina el atributo de contraseña
$BD = "cobraaut_auto";

$conexion = @mysql_connect($servidor, $usuario, $contrasenha);
 
if (!$conexion) {
    die('<strong>No pudo conectarse:</strong> ' . mysql_error());
}else{

}

mysql_select_db($BD, $conexion) or die(mysql_error($conexion));*/

?> 
