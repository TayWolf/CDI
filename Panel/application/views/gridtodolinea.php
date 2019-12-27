<?php 
  include "header.php";
?>
<script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script> 
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altalinea.js"></script>
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

    <section class="content" style="margin-left: 15px;">
        <div class="container-fluid">
            <div class="block-header">
               <!--  <a href="http://localhost/CDI/Panel/index.php/menus">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a> -->
                <!-- <h2>
                    JQUERY DATATABLES
                    <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>
                </h2> -->
                <?php 
                  include "footer.php";
                 ?>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-5">
                                    <h2 style="margin-top: 10px;">
                                        Líneas Registradas
                                    </h2>
                                </div>
                                <div class="col-md-5">
                                    <!--<form class="app-search" onsubmit="buscarlinea();return false;">
                                        <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                            <div class="form-group form-float" style="margin-bottom: 0px;">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                    <label class="form-label">Buscar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                            <a href="#" onclick="buscarlinea();return false;"><i class="material-icons">search</i></a>     
                                        </div>
                                    </form>-->
                                </div>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                 <li><a href="#" data-toggle="modal" data-target="#myModal">Agregar nueva línea</a></li>
                                            </li>
                                            <!-- <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li> -->
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaLinea">
                                    <thead>
                                        <tr>
                                            <!-- <th>Foto</th> -->
                                            <th style='display:none;'></th>
                                            <th>Linea</th>
                                             <th>Control de caducidad</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla">
                                        <?php 
                                            $idconteo=0;
                                                foreach ($Linea as $row) {
                                                   $idlinea=$row['idLinea'];
                                                   $nombreLin=$row['nombre'];
                                                   $controlCad=$row['controla_caducidad'];
                                                     if ($controlCad==1) {
                                                        $tipo='SI';
                                                    }
                                                    if ($controlCad == 2){
                                                        $tipo='NO';
                                                    }
                                                   $idconteo++;
                                                   echo " <tr>
	                                                   <td style='display:none;'>$idlinea</td>
                                                        
                                                        <td>$nombreLin</td>
                                                        <td>$tipo</td>
                                                        <td>
                                                            <a href='#' onclick='confirmaDeleteLinea($idlinea);'>Eliminar</a>
                                                        </td>
                                                        
                                                    </tr>
                                                    ";
                                                    
                                                }
                                        ?>
                                    </tbody>
                                </table>
                                <div id="sinresultados"></div>
                            </div>
                        </div>
                    </div>
                    <div align="center">
                        <div  id="resultadoGeneral" >
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
      <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">REGISTRAR NUEVA LÍNEA</h4>
        </div>
        <div class="modal-body">
          <div class="body">
                <form id="form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" onkeyup="form.nombreLine.value=form.nombreLine.value.toUpperCase();" name="nombreLine" required>
                                    <label class="form-label">Nombre de la línea</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float" style="margin-top: 13px;">
                                <div class="form-line">
                                    <select id="Caduci" name="Caduci" style="width: 100%;  border: none;  " required>
                                        <option value="" >Control de Caducidad</option>
                                        <option value="1">SI</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row clearfix">
                        <div align="center">
                            <input type="submit" class="btn btn-primary m-t-15 waves-effect"  value="GUARDAR">
                            <!-- <button class="btn btn-primary m-t-15 waves-effect" style="background: #293a4a;">GUARDAR</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  	$('#tablaLinea').Tabledit({
    url: 'Crudlinea/modificarDatos/',
    eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
        identifier: [0, 'idLinea'],
        editable: [[1, 'nombre'],[2,'tipo', '{"": "Control de Caducidad", "1": "SI", "2": "NO"}']]
    }
	});
    $('#tablaLinea').DataTable({
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
<!-- <script src="http://localhost/CDI/Panel/content/js/altausuario.js"></script> -->

<!-- <?php 
  //include "footer.php";
 ?> -->