<?php 
  include "header.php";
?>
<script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
<script src="http://localhost/CDI/Panel/content/js/condiciones.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altacliente.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.css"/>
<script type="text/javascript" src="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.js"></script>

<style type="text/css">
 .form-control{
        background-color: #eee;      
        

    }

     .table tr{
        white-space:nowrap; 
        height: 25px;

    }

    </style>

 
<section class="content" style="margin-left: 15px" >
    <div class="container-fluid">
        <div class="block-header">
            <a href="http://localhost/CDI/Panel/index.php/menus">
                <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        
            
        </div>
        <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header" >
                                <div class="row">
                                    <div class="col-md-5 ">
                                        <h2 style="margin-top: 10px;">
                                           Clientes Registrados
                                        </h2>
                                    </div>
                                    <div class="col-md-5 ">
                                        <!--<form class="app-search" onsubmit="buscarcliente();return false;">
                                            <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                                <div class="form-group form-float" style="margin-bottom: 0px;">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                        <label class="form-label">Buscar</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                                <a href="#" onclick="buscarcliente();return false;"><i class="material-icons">search</i></a>     
                                            </div>
                                        </form>-->
                                    </div>
                                   <ul class="header-dropdown m-r--5">
                                        <li class="dropdown" >
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#myModal">Registrar nuevo cliente</a></li>
                                                
                                                
                                            </ul>
                                        </li>
                                    </ul> 
                                </div> 
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                <!-- <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"> -->
                                        <!-- <div class="dt-buttons">
                                            <a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_1">
                                                <span>Excel</span>
                                            </a>
                                        </div> -->
                                    <table  WIDTH="1" class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaclientes">
                                        <thead>
                                            <tr style="margin-top: 10px;">
                                                <th style='display:none;'></th>
                                                <th>Empresa</th>
                                                <th>Clave</th>
                                                <th>RFC</th>
                                                <th>Dirección</th>
                                                <th>Estado</th>
                                                <th>Municipio</th>
                                                <th >Colonia</th>
                                                <th>CP</th>
                                                <th>Teléfono</th>
												<th>Precio especial</th>
                                                <th>Condiciones</th>
                                                <th>Eliminar</th>
                                               
                                            </tr>
                                        </thead>
                                        <input type="hidden" name="ruta" id="ruta" value="1">
                                        <tbody id="tabla">
                                            <?php 
                                             $idconteo=0;
                                                foreach ($clientes as $row) {
                                                    $idCliente=$row['idCliente'];
                                                    $nombreCliente=$row['nombreCliente'];
                                                    $Clave=$row['Clave'];
                                                    $RFC=$row['RFC'];
                                                    $direccionCliente=$row['direccionCliente'];
                                                    $CP=$row['CP'];
                                                    $Colonia=$row['Colonia'];
                                                    $Municipio=$row['municipio'];
													$PrecioEspecial=$row['precioEspecial'];
													$Estado=$row['Estado'];
                                                   // $Coloniaclave=$row['Colonia'];
                                                   // $Municipioclave=$row['municipio'];
                                                   
                                                    $telefono=$row['telefono'];
													
													if($PrecioEspecial==1){
														$PrecioEspecial="Si";
													} 
											    
													else if($PrecioEspecial==2 || $PrecioEspecial==0){
														$PrecioEspecial="No";
													}
												
												

                                                  $idconteo++; 
                                            echo "
                                                <tr>
                                                
                                                    <td style=display:none;>$idCliente</td>
                                                    <td >$nombreCliente</td>
                                                    <td >$Clave</td>
                                                    <td >$RFC</td>
                                                    <td >$direccionCliente</td>
                                                    <td >$Estado</td>
                                                    <td >$Municipio</td>
                                                    <td >$Colonia</td>
                                                    <td >$CP</td>
                                                    <td >$telefono</td>
													<td >$PrecioEspecial</td>
                                                    
													<td>
                                                        <a onclick='diferenciador($idCliente);' style='cursor:pointer;'>Ver / Editar</a>
                                                    </td>
                                                    
                                                    <td><a href='#' onclick='deleteCliente($idCliente);'>Eliminar</a>
                                                        
                                                </td>
                                               
                                            </tr>";
                                                        // <a href='http://localhost/CDI/Panel/index.php/Crudclientes/Condiciones?id=$idCliente'><button type='button' class='btn bg-red btn-circle-lg waves-effect waves-circle waves-float'  >
                                                        // <i class='material-icons'>settings</i>
                                                        // </button></a>
                                                }

                                             ?>

                                        </tbody>
                                    </table>
                                    <div id="sinresultados"></div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <div align="center">
                            <div  id="resultadoGeneral" >

                            </div>
                        </div>
                    </div>
                </div>
    </div>
</section>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">REGISTRO DE NUEVO USUARIO</h4>
        </div>
        <div class="modal-body">
          <div class="body">
               <form id="form"  method="post">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                            
                                            <div class="body">
                                               
                                                <h2 class="card-inside-title"></h2>
                                                 <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.nombrecliente.value=form.nombrecliente.value.toUpperCase();" id="nombrecliente" name="nombrecliente" required>
                                                                <label class="form-label">Nombre del cliente  </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.clave.value=form.clave.value.toUpperCase();" id="clave" name="clave" required>
                                                                <label class="form-label">Clave  </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.rfcCliente.value=form.rfcCliente.value.toUpperCase();" name="rfcCliente" id="rfcCliente"  required>
                                                                <label class="form-label">RFC</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.teleCliente.value=form.teleCliente.value.toUpperCase();" name="teleCliente" id="teleCliente"  required>
                                                                <label class="form-label">Teléfono</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.direccionC.value=form.direccionC.value.toUpperCase();" name="direccionC" id="direccionC"  required>
                                                                <label class="form-label">Dirección</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                     
                                                                                                       
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-3">
                                                        <!-- <p> 
                                                           <b>Estado</b>
                                                        </p> -->
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.estado.value=form.estado.value.toUpperCase();" name="estado" id="estado"  required>
                                                                <label class="form-label">Estado</label>
                                                                <!-- <select class="form-control" class="form-control" onchange="trarMunicipio();" name="estado" id="estado"  required>    
                                                                        <option value="">Seleccione un estado</option>
                                                                         <?php   
                                                                            $idconteo=0;
                                                                            foreach ($estado as $row) {
                                                                                 
                                                                                  $idEdo=$row['id_Estado'];
                                                                                  $nombreEstado=$row['nombreEstado'];
                                                                                  //$idconteo++; .
                                                                                 echo "
                                                                                 <option value='$idEdo'>$nombreEstado</option>
                                                                                 ";
                                                                            }
                                                                         ?>
                                                                </select> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div id="datos" style="display: none"> -->
                                                     <div>
                                                        <div class="col-sm-3">
                                                            <!-- <p> 
                                                               <b> Municipio</b>
                                                            </p> -->
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" onkeyup="form.municipio.value=form.municipio.value.toUpperCase();" name="municipio" id="municipio"  required>
                                                                    <label class="form-label">Municipio</label>
                                                                    <!-- <select class="form-control" onchange="traerColonia();" class="form-control" name="municipio" id="municipio"  required>    
                                                                                                                                                   
                                                                    </select> -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <!-- <p> 
                                                               <b> Colonia</b>
                                                            </p> -->
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" onkeyup="form.coloniaCl.value=form.coloniaCl.value.toUpperCase();" name="coloniaCl" id="coloniaCl"  >
                                                                    <label class="form-label">Colonia</label>
                                                                    <!-- <select class="form-control" onchange="traerPostal();" name="coloniaCl" id="coloniaCl"  required> 
                                                                    </select> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-sm-3">
                                                            <!--  <p> 
                                                               <b> C.P</b>
                                                            </p> -->
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" onkeyup="form.codigoP.value=form.codigoP.value.toUpperCase();" name="codigoP" id="codigoP"  >
                                                                    <label class="form-label">Codigo Postal</label>
                                                                    <!-- <select class="form-control" name="codigoP" id="codigoP"  required>    
                                                                    </select> -->
                                                                    
                                                                     
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-md-12">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select type="text" class="form-control" name="precioEspecial" id="precioEspecial"  required>
                                                                        <option value=0>Elige una opcion por favor</option>
                                                                        <option value=1>Si quiero que tenga precio especial</option>
                                                                        <option value=2>No quiero que tenga precio especial</option>
                                                                    </select>
                                                                    <label class="form-label">Precio Especial</label>
                                                                     
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                <div class="row clearfix">
                                                    <div align="center">
                                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Aceptar</button>
                                                        <div id="cargando"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                            </form>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
      $('#tablaclientes').Tabledit({
    url: 'http://localhost/CDI/Panel/index.php/Crudclientes/modificarDatos/',
    //eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
        identifier: [0, 'idCliente'],
        editable: [[1, 'nombre'], [2, 'clave' ],[3, 'rfc'],[4, 'direccion'],[5, 'Estado'],[6, 'municipio'],[7, 'colonia'],[8, 'CP'],[9, 'telefono'],[10, 'PrecioEspecial','{"0": "Elige una opcion", "2": "NO", "1": "SI"}']]
    }
    });
      $('#tablaclientes').DataTable({
          "language": {
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
          }
      });
  </script> 

   <?php 
  include "footer.php";
 ?> 