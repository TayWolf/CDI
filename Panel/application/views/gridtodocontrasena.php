<?php 
  include "header.php";
?>
<script src="http://localhost/CDI/Panel/content/js/eliminardos.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altaContrasena.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.css"/>

<style type="text/css">
 .form-control{
        background-color: #eee;   

    }
</style>

<script type="text/javascript" src="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.js"></script>
    <section class="content" style="margin-left: 15px;">
        <div class="container-fluid">
            <div class="block-header">
                <a href="http://localhost/CDI/Panel/index.php/menus">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
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
                                        Contraseñas Registradas
                                    </h2>
                                </div>
                                <div class="col-md-5">
                                    <!--<form class="app-search" onsubmit="buscarusuario();return false;">
                                        <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                            <div class="form-group form-float" style="margin-bottom: 0px;">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                    <label class="form-label">Buscar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                            <a href="#" onclick="buscarusuario();return false;"><i class="material-icons">search</i></a>     
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
                                                 <li><a href="#" data-toggle="modal" data-target="#myModal">Agregar </a></li>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaContraseña">
                                    <thead>
                                        <tr>
                                            <!-- <th>Foto</th> -->
                                            <th style='display:none;'></th>
                                            <th>Contraseña</th>
                                            <th>Permiso</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla">
                                        <?php 
                                            $idconteo=0;
                                                foreach ($contrasena as $row) {
                                                   $idContrasena=$row['idContrasena'];
                                                   $contrasena=$row['contrasena'];
                                                   $permiso=$row['permiso'];
                                                   if ($permiso==1) {
                                                        $tipo='SI';
                                                    }
                                                    if ($permiso == 2){
                                                        $tipo='NO';
                                                    }
                                                   $idconteo++;
                                                   echo " <tr>
                                                       <td style='display:none;'>$idContrasena</td>
                                                        
                                                        <td>$contrasena</td>

                                                        <td>$tipo</td>
                                                        
                                                        <td>
                                                            <a href='#' onclick='confirmaDeleteCont($idContrasena);'>Eliminar</a>
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
          <h4 class="modal-title">REGISTRA NUEVA CONTRASEÑA</h4>
        </div>
        <div class="modal-body">
          <div class="body">
                <form id="form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="contrasena" required>
                                    <label class="form-label">Contraseña</label>
                                </div>
                            </div>
                        </div>

                           <div class="col-md-6">
                            <div class="form-group form-float" style="margin-top: 13px;">
                                <div class="form-line">
                                    <select id="permiso" name="permiso" style="width: 100%; border: none;" required>
                                        <option value="">permiso</option>
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
    $('#tablaContraseña').Tabledit({
    url: 'CrudContrasena/modificarDatos/',
    eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
        identifier: [0, 'idContrasena'],
        editable: [[1, 'contrasena'],[2,'tipo', '{ "1": "SI", "2": "NO"}']]
    }
    });
    $('#tablaContraseña').DataTable({
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