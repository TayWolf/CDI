<?php 
  include "header.php";
 ?>
 <script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
 <script src="http://localhost/CDI/Panel/content/js/modificarsala.js"></script>
 <script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
 <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altasala.js"></script>
<script src="http://localhost/CDI/Panel/content/js/traerId.js"></script>
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

<section class="content" style="margin-left: 15px;" >
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
                                    Salas Registradas
                                  </h2>
                                </div>
                                <div class="col-md-5">
                                  <!--<form class="app-search" onsubmit="buscarsala();return false;">
                                        <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                            <div class="form-group form-float" style="margin-bottom: 0px;">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                    <label class="form-label">Buscar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                            <a href="#" onclick="buscarsala();return false;"><i class="material-icons">search</i></a>     
                                        </div>
                                    </form>-->
                                </div>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown" >
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" data-toggle="modal" data-target="#myModal">Registrar nueva sala</a></li>
                                            
                                        </ul>
                                    </li>
                                </ul>
                              </div>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaSalas">
                                        <thead>
                                            <tr style="margin-top: 10px;">
                                                <th style='display:none;'></th>
                                                <th>Sala</th>
                                                <th>Horarios</th>
                                                <th>Tipo</th>
                                                <th>Clave</th>
                                                <th style="display: none">Estudios<br>Asignados</th>
                                                <th>Doctores <br> Asignados</th>
                                                <th>Eliminar</th>
                                               
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="tabla">
                                            <?php 
                                             $idconteo=0;
                                                foreach ($salas as $row) {
                                                    $idSala=$row['idSala'];
                                                    $nombre=$row['nombre'];
                                                     $horarios=$row['horarios'];
                                                     if ($horarios==1) {
                                                       $checked="checked";
                                                     } if ($horarios==2) {
                                                       $checked="";
                                                     }
                                                     $tipo=$row['tipo'];
                                                     $clave=$row['clave'];

                                                  $idconteo++; 
                                                  
                                            echo "
                                            <tr>
                                            <td style='display:none'>$idSala</td>
                                                <td>$nombre</td>
                                                     <td>
                                                      <input type='checkbox' onclick='horario($idSala)'  id='horass$idSala' name='horass$idSala' class='filled-in chk-col-purple' $checked>
                                                       <label for='horass$idSala'></label> 
                                                     </td>
                                                     <td>$tipo</td>
                                                     <td>$clave</td>        
                                                    <td style='display: none'>  
                                                      <a href='#' onclick='traerIdSala($idSala);traeNombreSala(".'"'.$nombre.'"'.");identificaEstudiosAsignados();' data-toggle='modal' data-target='#myModal2'>Asignar Estudios</a> 
                                                    </td>
                                                    <td>  
                                                      <a href='#' onclick='traerIdSala($idSala);traeNombreSala(".'"'.$nombre.'"'.");identificaMedicosAsignados();' data-toggle='modal' data-target='#myModal3'>Asignar Médicos</a> 
                                                    </td>
                                                    <td>
                                                        <a href='#' onclick='deleteSala($idSala);'>Eliminar</a>
                                                    </td>
                                               
                                            </tr>";
                                                }
                                                echo "<input type='hidden' id='idsalaactual' name='idsalaactual'>";
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
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.nombreSala.value=form.nombreSala.value.toUpperCase();" name="nombreSala" id="nombreSala"  required>
                                                                <label class="form-label">Nombre de la sala</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.tipoSala.value=form.tipoSala.value.toUpperCase();" name="tipoSala" id="tipoSala"  required>
                                                                <label class="form-label">Tipo </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.claveSala.value=form.claveSala.value.toUpperCase();" name="claveSala" id="claveSala"  required>
                                                                <label class="form-label">Clave</label>
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
    <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-top: 50px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">Doctores Asignados actualmente a <b id="nombresaladoc"></b></h4>
        </div>
        <div class="modal-body">
            <div class="body">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tabladoctores">
                    <thead>
                        <tr>
                            <th>Doctores</th>
                            <th>Doctores Asignados</th>
                            <th>Horarios</th>
                        </tr>
                    </thead>
                        <?php 
                            foreach ($Doctores as $row) {
                                $idDoc=$row['idDoctor'];
                            }
                            echo "<input type='hidden' name='totaldoc' id='totaldoc'  value='$idDoc'>";
                        ?>
                    <tbody id="pintdoctores">
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>

      <!-- Modal -->
    <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg" style="margin-top: 50px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">Estudios Asignados a <b id="nombresala"></b> Actualmente</h4>
        </div>
        <div class="modal-body">
            <div class="body">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaEstudios">
                    <thead>
                        <tr>
                            <th>Estudios</th>
                            <th>Estudios Asignados</th>
                        </tr>
                    </thead>
                        <?php 
                            foreach ($Estudios as $row) {
                                $idEstudio=$row['IdEstudio'];
                            }
                            echo "<input type='hidden' name='total' id='total'  value='$idEstudio'>
                                  <input type='hidden' name='idsalaactual' id='idsalaactual'>";
                        ?>
                    <tbody id="pintaestudios">
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>


      <!-- Modal -->
      <div class="modal fade" id="myModal4" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Asigne un horario en la sala</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <select class="form-control show-tick" id="dia" name="dia" onchange="limpiaCampos();">
                    <option value="1">LUNES</option>
                    <option value="2">MARTES</option>
                    <option value="3">MIERCOLES</option>
                    <option value="4">JUEVES</option>
                    <option value="5">VIERNES</option>
                    <option value="6">SABADO</option>
                    <option value="7">DOMINGO</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="time" class="form-control" name="entrada" id="entrada" required>
                   <input type="hidden" name="idPuente" id="idPuente" >
                </div>
                <div class="col-md-4">
                  <input type="time" class="form-control" name="salida" id="salida" required>
                </div>
               </div>
               <div class="row">
                  <div class="col-md-12 col-md-offset-4 modal-body">
                    <button type="button" onclick="agregarHora();" class="btn waves-effect">
                        <i class="material-icons">get_app</i>
                        <span>Agregar Horario</span>
                    </button>
                   
                  </div>
               </div>
               <div class="row">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>      
                              <th>Día</th>    
                              <th>Horario entrada</th>
                              <th>Horario salida</th>
                              <th>Eliminar Horario</th>
                            </tr>
                          </thead>
                          <tbody id="listaHorarios">
                            
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
                <button type="button" align="center" onclick="altaHorario();" class="btn btn-default" >Registrar</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="myModal5" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Asigne un horario en la sala</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <select id="diamod5" class="form-control show-tick" name="diamod5" onchange="limpiaCamposMod5();">
                    <option value="1">LUNES</option>
                    <option value="2">MARTES</option>
                    <option value="3">MIERCOLES</option>
                    <option value="4">JUEVES</option>
                    <option value="5">VIERNES</option>
                    <option value="6">SABADO</option>
                    <option value="7">DOMINGO</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="time" class="form-control" name="entradamod5" id="entradamod5" required>
                   <input type="hidden" name="idSalaMedico" id="idSalaMedico" >
                </div>
                <div class="col-md-4">
                  <input type="time" class="form-control" name="salidamod5" id="salidamod5" required>
                </div>
               </div>
               <div class="row">
                   <div class="col-md-12 col-md-offset-4 modal-body">
                    <button type="button" onclick="agregarHoraMod5();" class="btn waves-effect">
                        <i class="material-icons">get_app</i>
                        <span>Agregar Horario</span>
                    </button>
                   
                  </div>
                 <!--  <div class="col-md-12">
                    <button type="submit" onclick="agregarHoraMod5();">Agregar</button>
                  </div> -->
               </div>
               <div class="row">
                    <div class="table-responsive">          
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaHours">
                          <thead>
                            <tr">      
                              <th>Día</th>    
                              <th>Horario entrada</th>
                              <th>Horario salida</th>
                              <th>Eliminar Horario</th>
                            </tr>
                          </thead>
                          <tbody id="listaHorarios1">
                              
                          </tbody>
                          <tbody id="listaHorarios2">
                            
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> -->
                <button type="button" align="center" onclick="altaHorariomod5();" class="btn btn-default" >Registrar</button>
            </div>
          </div>
        </div>
      </div>
<!--   <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog" style="margin-top: 50px;">
    
      <
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar" >&times;</button>
          <h4 class="modal-title">ASIGNAR HORAS</h4>
        </div>
        <div class="modal-body">
            <div class="body">
             
                <div class="col-md-4">
                  <select id="dia" name="dia">
                    <option value="1">LUNES</option>
                    <option value="2">MARTES</option>
                    <option value="3">MIERCOLES</option>
                    <option value="4">JUEVES</option>
                    <option value="5">VIERNES</option>
                    <option value="6">SABADO</option>
                    <option value="7">DOMINGO</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="time" name="entrada" required>
                   <input type="hidden" name="idPuente" id="idPuente" >
                </div>
                <div class="col-md-4">
                  <input type="time" name="salida" required>
                </div>
                <div class="col-md-12">
                  <button type="submit" onclick="agregarHora();">Agregar</button>
                </div>
                <div class="row">
                    <div class="table-responsive">          
                        <table class="table">
                          <thead>
                            <tr>          
                              <th>Horario entrada</th>
                              <th>horario salida</th>
                            </tr>
                          </thead>
                          <tbody id="listaHorarios">
                            
                          </tbody>
                        </table>
                    </div>
                </div>
               
             
            </div>

           
        </div>
      </div>
       
    </div>
  </div> -->


 <script type="text/javascript">
    $('#tablaSalas').Tabledit({
    url: 'Crudsalas/modificarDatos/',
    eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
        identifier: [0, 'idSala'],
        editable: [[1, 'nombre'], [3, 'tipo'],[4, 'clave']]
    }
  });
    $('#tablaSalas').DataTable({
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

/*$('#tablaHours').Tabledit({
    url: 'Crudsalas/modificarDatos/',
    eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
              identifier: [0, 'idcontrol'],
              editable: [[1, 'dia'], [2, 'horaEntrada'],[3, 'horaSalida']]
             }
    });*/
        
   /* $(".modal").on("hidden.bs.modal", function(){
        $("#pintaestudios").html("");
        $("#nombresala").html("");
        $("#nombresaladoc").html("");
        $("#pintdoctores").html("");
    });*/
  </script>
<!-- <?php 
  //include "footer.php";
 ?> -->