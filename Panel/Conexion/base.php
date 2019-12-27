<?php

$objConex=new conexion;
$objConex->conecta();
$mysqli=$objConex->mysqli;
$mysqli->select_db("cointic_CDI");
$mysqli->set_charset('utf8');	
?>