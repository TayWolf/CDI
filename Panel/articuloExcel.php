<?php
header ('Content-Type: text/html; charset=ISO-8859-1');
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Articulos.xls");
header("Pragma: no-cache");
header("Expires: 0");
include "Conexion/conexion.php";
include "Conexion/base.php";

?>
<link rel="stylesheet" href="../../../estilos/estilotabla.css" type="text/css" media="screen" />
<table class="table" align=center width="800">
<thead class="head">
  <tr>
    <th height="100"><b>Nombre</b></th>
    <th height="80"><b>Linea</b></th>
    <th height="80"><b>Precentación</b></th>
    <th height="50"><b>Medida</b></th> 
    <th height="50"><b>Ubicacion</b></th>
    <th height="50"><b>Costo unitario</b></th>
    <th height="50"><b>Existencia</b></th>
    <th height="50"><b>Ex. maxima</b></th>
    <th height="50"><b>Ex. minima</b></th>  
    
  </tr>
</thead>

<?php

$query = "select 
*
from articulos 
ORDER BY `nombre` ASC"; // consulta

   $result = $mysqli->query($query); //ejecución de la cconsulta
   $color="1";
   while ($row = $result->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA DE LA COLUMNA
   {
   $Titulopqt=$row["nombre"];
    $idArticulo=$row["idArticulo"];

     echo "<tr bgcolor='#FFFFFF'>
           <td align='lefth'  width=100>".utf8_decode($row['nombre'])."</td>
           <td align='lefth'  width=100>";
            $queryl = "select 
                  linea.nombre as nombreLinea 
                  from articulos join articuloLinea on articulos.idArticulo=articuloLinea.idArticulo 
                  join linea on articuloLinea.idLinea = linea.idlinea where articulos.idArticulo=$idArticulo"; // consulta

                   $resultl = $mysqli->query($queryl); //ejecución de la cconsulta
                   $color="1";
                   while ($rowl = $resultl->fetch_array(MYSQLI_ASSOC)) //SE ACCESA AL DATO POR MEDIO DE LA REFERENCIA DE LA COLUMNA
                     {

                    
                echo " ".utf8_decode($rowl['nombreLinea'])." ";
                       
                     }
             echo "
             </td>
           <td align='lefth'  width=100>".utf8_decode($row['presentacion'])."</td>     
           <td align='lefth'  width=100>".utf8_decode($row['medida'])."</td>
           <td align='lefth'  width=100>".utf8_decode($row['ubicacion'])."</td>
           <td align='lefth'  width=100>".utf8_decode($row['costo_unitario'])."</td>
           <td align='lefth'  width=100>".utf8_decode($row['existencia'])."</td>
           <td align='lefth'  width=100>".utf8_decode($row['maximo'])."</td>
           <td align='lefth'  width=100>".utf8_decode($row['minimo'])."</td>

       "; 
    
   }
   //echo "pruebas $Titulopqt";
   echo "</table> <br><br>";
   ?>