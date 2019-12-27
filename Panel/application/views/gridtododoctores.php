<?php 
  include "header.php";
 ?>

<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/traesalashorarios.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altadoctor.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.css"/>
<script type="text/javascript" src="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.js"></script>

<style type="text/css">
 .form-control{
        background-color: #eee;   

    }
</style>

<!-- <script src="http://localhost/CDI/Panel/content/js/status.js"></script> -->
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
                                           Doctores Registrados
                                        </h2>
                                    </div>
                                    <div class="col-md-5">
                                        <!--<form class="app-search" onsubmit="buscardoctor();return false;">
                                            <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                                <div class="form-group form-float" style="margin-bottom: 0px;">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                        <label class="form-label">Buscar</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                                <a href="#" onclick="buscardoctor();return false;"><i class="material-icons">search</i></a>     
                                            </div>
                                        </form>-->
                                    </div>
                                    <ul class="header-dropdown m-r--5">
                                        <li class="dropdown" >
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">more_vert</i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" data-toggle="modal" data-target="#myModal">Registrar nuevo doctor</a></li>
                                                
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaDoctores">
                                        <thead>
                                            <tr>
                                                <th style='display:none;'></th>
                                                <th>Clave</th>
                                                <th>Nombre</th>
                                                <th class='whiteSpace'>Fecha<br>Nacimiento</th>
                                                <th>Cédula</th>
                                                <th>Telefono</th>
                                                <th>Correo</th>
                                                <th>Universidad</th>
                                                <th>Horario</th>
                                                <th class='whiteSpace'>Salas y<br>Horarios Asignados</th>
                                                <th>Asignar<br> estudios</th>
                                                <th style=" width: 120px;">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla">
                                            <?php 
                                             $idconteo=0;
                                                foreach ($doctores as $row) {
                                                    $idDoctor=$row['idDoctor'];
                                                    $clave = $row['claveDoc'];
                                                    $nombreDoc=$row['nombreDoc'];
                                                    $fecha = $row['fechanaciDoc'];
                                                    $cedula = $row['cedulaDoc'];
                                                    $telefono = $row['telefono'];
                                                    $correo = $row['correo'];
                                                    $uni = $row['universidadDoc'];
                                                    $horario = $row['horarioDoc'];
                                                    $status = $row['status'];
                                                  $idconteo++;
                                                  if ($status == 1) {
                                                      $status = "checked";
                                                  }else{
                                                    $status = "";
                                                  }
                                            echo "
                                            <tr>
                                                    <td style='display:none;'>$idDoctor</td>
                                                    <td class='whiteSpace'>$clave</td>
                                                    <td class='whiteSpace'>$nombreDoc</td>
                                                    <td class='whiteSpace'>$fecha</td>
                                                    <td class='whiteSpace'>$cedula</td>
                                                    <td class='whiteSpace'>$telefono</td>
                                                    <td class='whiteSpace'>$correo</td>
                                                    <td class='whiteSpace'>$uni</td>
                                                    <td class='whiteSpace'>$horario</td>
                                                    <td><a href='#' onclick='traesalashoras($idDoctor);' data-toggle='modal' data-target='#myModal1'>Ver Salas asignadas</a></td>
                                                    <td><a href='#' onclick='asignaid($idDoctor)' data-toggle='modal' data-target='#myModal2'>Asignar</a></td>
                                                    <td>
                                                        <div class='col-sm-3' style='margin-bottom:0px;'>
                                                            <div class='switch'>
                                                                <label><input id='status$idDoctor' onclick='modifica($idDoctor);' type='checkbox' $status><span class='lever switch-col-deep-purple'></span></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                               
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
          <h4 class="modal-title">REGISTRO DE NUEVO DOCTOR</h4>
        </div>
        <div class="modal-body">
          <div class="body">
                <form id="form"  method="post">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                            
                                            <div class="body">
                                               
                                                <h2 class="card-inside-title"></h2>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control"  onkeyup="form.nombre.value=form.nombre.value.toUpperCase();" id="nombre" name="nombre" required>
                                                                <label class="form-label">Nombre del Doctor</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control"  onkeyup="form.clave.value=form.clave.value.toUpperCase();" name="clave" id="clave"  required>
                                                                <label class="form-label">Clave</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="date" class="form-control" name="fecha" id="fecha"  required>
                                                                <label class="form-label">Fecha de Nacimiento</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control"  onkeyup="form.cedula.value=form.cedula.value.toUpperCase();" name="cedula" id="cedula">
                                                                <label class="form-label">Cedula</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control"  onkeyup="form.telefono.value=form.telefono.value.toUpperCase();" name="telefono" id="telefono">
                                                                <label class="form-label">Telefono</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="email" class="form-control" name="correo" id="correo">
                                                                <label class="form-label">Correo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                   
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control"  onkeyup="form.universidad.value=form.universidad.value.toUpperCase();" name="universidad" id="universidad"  required>
                                                                <label class="form-label">Universidad</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control"  onkeyup="form.horario.value=form.horario.value.toUpperCase();" name="horario" id="horario"  required>
                                                                <label class="form-label">Horario</label>
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


      <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">Horarios Asignados</h4>
        </div>
        <div class="modal-body">
          <div class="body">
            <div id="pintahorariosDoctor">
                
            </div>
<!--             <div class="row text-center" id="sala">
                <h5>SALA DE EMERGENCIAS</h5>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="row text-center" id="dia">
                       LUNES 
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row text-center">
                                Entrada
                            </div>
                            <div class="row" id="horaentrada">
                                <div class="col-md-12">
                                    12:30
                                </div>
                                <div class="col-md-12">
                                    12:30
                                </div>
                                <div class="col-md-12">
                                    12:30
                                </div>
                                <div class="col-md-12">
                                    12:30
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row text-center">
                                Salida
                            </div>
                            <div class="row" id="horasalida">
                                <div class="col-md-12">
                                    22:30
                                </div>
                                <div class="col-md-12">
                                    22:30
                                </div>
                                <div class="col-md-12">
                                    22:30
                                </div>
                                <div class="col-md-12">
                                    22:30
                                </div>
                            </div>
                        </div> 
                    </div>
                    
                </div>
                <div class="col-md-3">
                    MARTES
                </div>
                <div class="col-md-3">
                    MIERCOLES
                </div>
                <div class="col-md-3">
                    JUEVES
                </div>
            </div> -->
          </div>
          
        </div>
      </div>
    </div>
  </div>

      <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px; width: 80%;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          
          <form class="app-search" onsubmit="traeestudio();return false;">
                <div class="col-md-5 col-sm-12 col-xs-12" style="padding: 0px;">
                    <h4 class="modal-title">Asignar Estudios</h4>
                    <span>Busque y seleccione los estudios que desea asignar al doctor</span>
                </div>
                <div class="col-md-5 col-sm-10 col-xs-10" style="padding: 0px;">
                    <div class="form-group form-float" style="margin-bottom: 0px;">
                        <div class="form-line">
                            <input type="text" class="form-control" id="buscaestudio" name="buscaestudio">
                            <label class="form-label">Buscar</label>

                        </div>
                    </div>
                    <div id="alerta"></div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1" style="padding: 0px;">
                    <a href="#" onclick="traeestudio();return false;"><i class="material-icons">search</i></a>     
                </div>
            </form>

        </div>
        <div class="modal-body">
          <div id="modalestudios" class="body">
            <div class="row" style="padding: 5px; margin: 0px; background: #eef4fb; margin-bottom:  10px;">
                <h5 id="headerAsignados"></h5>
                <div id="pintaestudiosAsig" style="display: inline-block;width: 100%;">
                    
                </div>
            </div>
            <div id="rowresultados" class="row" style="padding: 5px; margin: 0px; background: #fff4f4; margin-bottom:  10px;">
                <h5 id="headerDisponibles"></h5>
                <div id="pintaestudiosDispo" style="display: inline-block;width: 100%;">
                    
                </div>
            </div>
            
            <div align="right"><input type="button" name="guardar" id="guardar" value="Guardar" onclick="guardaestudios();"></div>
          </div>
          
        </div>
        <input type="hidden" name="ultimoidEstudio" id="ultimoidEstudio">
        <input type="hidden" name="doctorActual" id="doctorActual">
      </div>
    </div>
  </div>

  

  <script type="text/javascript">
      $('#tablaDoctores').Tabledit({
        url: 'Cruddoctores/modificarDatos/',
        eventType: 'dblclick',
        editButton: false,
        deleteButton:false,
        columns: {
            identifier: [0, 'idD'],
            //editable: [[1, 'nombre'], [2, 'claveDoc'],[3, 'nombreDoc'],[4, 'fechanaciDoc'],[5, 'cedulaDoc'],[6, 'universidadDoc'], [7, 'horarioDoc']]
            editable: [[1, 'claveDoc'], [2, 'nombre'],[3, 'fecha'],[4, 'cedulaDoc'], [5, 'telefono'], [6, 'correo'],[7, 'universidadDoc'],[8, 'horarioDoc'] ]
        }
        });
      $('#tablaDoctores').DataTable({
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

<!-- <?php 
  //include "footer.php";
 ?> -->