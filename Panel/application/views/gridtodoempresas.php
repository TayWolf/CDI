<?php 
  include "header.php";
 ?>
 <script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
 <script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
 <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altaempresa.js"></script>
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
                <a href="http://localhost/CDI/Panel/index.php/menus">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
                <?php 
                  include "footer.php";
                 ?>
        </div>
        <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h2 style="margin-top: 10px;">
                                           Empresas Registradas
                                        </h2>
                                    </div>
                                    <div class="col-md-5">
                                        <!--<form class="app-search" onsubmit="buscarempresa();return false;">
                                            <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                                <div class="form-group form-float" style="margin-bottom: 0px;">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                        <label class="form-label">Buscar</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                                <a href="#" onclick="buscarempresa();return false;"><i class="material-icons">search</i></a>     
                                            </div>
                                        </form>-->
                                    </div>
                                    <ul class="header-dropdown m-r--5">
                                        <li class="dropdown" >
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#"  data-toggle="modal" data-target="#myModal">Registrar nueva empresa</a></li>
                                                
                                            </ul>
                                        </li>
                                    </ul>    
                                </div>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaEmpresas">

                                        <thead>
                                            <tr  style="margin-top: 10px;">
                                                <th style='display:none;' ></th>
                                                <th>Empresa</th>
                                                <th>RFC</th>
                                                <th>Dirección</th>
                                                <th>Colonia</th>
                                                <th>Estado</th>
                                                <th>Teléfono</th>
                                                <th>Contacto</th>
                                                <th>Eliminar</th>
                                               
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="tabla">
                                            <?php 
                                             $idconteo=0;
                                                foreach ($empresas as $row) {
                                                    $idEmpresa=$row['idEmpresa'];
                                                    $nombreEmpresa=$row['nombreEmpresa'];
                                                    $RFC = $row['RFC'];
                                                    $direccion = $row['direccionEmpresa'];
                                                    $colonia = $row['coloniaEmpresa'];
                                                    $estado = $row['EstadoEmpresa'];
                                                    $tel = $row['telefonoEmpresa'];
                                                    $contacto = $row['nombreContacto'];
                                                  $idconteo++; 
                                            echo "
                                            <tr>


                                                <td style='display:none;'>$idEmpresa</td>
                                                <td>$nombreEmpresa</td>
                                                <td>$RFC</td>
                                                <td>$direccion</td>
                                                <td>$colonia</td>
                                                <td>$estado</td>
                                                <td>$tel</td>
                                                <td>$contacto</td>
                                                <td><a href='#' onclick='deleteEmpresa($idEmpresa);'>Eliminar</a></td>
                                               
                                            </tr>";
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
    </div>
</section>
      <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">REGISTRO DE NUEVA EMPRESA</h4>
        </div>
        <div class="modal-body">
          <div class="body">
                <form id="form" method="post">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                            
                                            <div class="body">
                                               
                                                <h2 class="card-inside-title"></h2>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" id="nombre"  onkeyup="myFunction()" name="nombre" required>
                                                                <label class="form-label">Nombre de la empresa</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.rfcEmpresa.value=form.rfcEmpresa.value.toUpperCase();" name="rfcEmpresa" id="rfcEmpresa"  required>
                                                                <label class="form-label">RFC</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.direccionE.value=form.direccionE.value.toUpperCase();" name="direccionE" id="direccionE"  required>
                                                                <label class="form-label">Dirección</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.coloniaempre.value=form.coloniaempre.value.toUpperCase();" name="coloniaempre" id="coloniaempre"  required>
                                                                <label class="form-label">Colonia</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                   
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.estadoEm.value=form.estadoEm.value.toUpperCase();" name="estadoEm" id="estadoEm"  required>
                                                                <label class="form-label">Estado</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.telefonoEmp.value=form.telefonoEmp.value.toUpperCase();" name="telefonoEmp" id="telefonoEmp"  required>
                                                                <label class="form-label">Teléfono </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.nombreContact.value=form.nombreContact.value.toUpperCase();" name="nombreContact" id="nombreContact"  required>
                                                                <label class="form-label">Nombre del Contacto</label>
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
    $('#tablaEmpresas').Tabledit({
    url: 'Crudempresas/modificarDatos/',
    eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
        identifier: [0, 'idempresa'],
        editable: [[1, 'nombre'], [2, 'RFC'],[3, 'direccion'],[4, 'colonia'],[5, 'estado'],[6, 'telefono'],[7, 'contacto']]
        }
    });
    $('#tablaEmpresas').DataTable({
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


function myFunction() {
 // var str = "ssss";
 var str =$("#nombre").val();
  var res = str.toUpperCase();
  //document.getElementById("datos").innerHTML = res;
  $("#nombre").val(res);
}



  </script>
  

<!-- <?php 
  //include "footer.php";
 ?> -->