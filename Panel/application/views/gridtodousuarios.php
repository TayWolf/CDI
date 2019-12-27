<?php

include "header.php";
?>
<script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<!-- <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script> -->
<script src="http://localhost/CDI/Panel/content/js/altausuario.js"></script>

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
                                    Usuarios Registrados
                                </h2>
                            </div>
                            <div class="col-md-5">
<!--                                <form class="app-search" onsubmit="buscarusuario();return false;">
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
                                </form>
-->                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                        <li><a href="#" data-toggle="modal" data-target="#myModal">Agregar nuevo usuario</a></li>
                                        <li><a href="http://localhost/CDI/Panel/index.php/Crudimportarusuario">Importar Excel</a></li>
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
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaUsuarios">
                                <thead>
                                <tr>
                                    <!-- <th>Foto</th> -->
                                    <th style='display:none;'></th>
                                    <th>Nombre</th>
                                    <th>Tipo Usuario</th>
                                    <th>Nickname</th>
                                    <th>Contraseña</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody id="tabla" >
                                <?php
                                $idconteo=0;
                                foreach ($Usuario as $row) {
                                    $idUser=$row['idUser'];
                                    $nombre= $row['nombreUser'];


                                    $tipo=$row['tipoUser'];
                                    $correo=$row['correoUser'];
                                    $password=$row['password'];
                                    if ($tipo==1) {
                                        $tipo='Administrador';
                                    }
                                    if ($tipo == 2){
                                        $tipo='Empleado';
                                    } 
                                    if ($tipo == 3){
                                        $tipo='Almacen';
                                    }
                                    if ($tipo == 4){
                                        $tipo='Recepcionista';
                                    }

                                    if ($tipo == 5){
                                        $tipo='Cajera';
                                    }

                                    if ($tipo == 6){
                                        $tipo='Área complementaria';
                                    }

                                    if ($tipo == 7){
                                        $tipo='Compras';
                                    }

                                    $idconteo++;
                                    echo " <tr>
	                                                   <td style='display:none;'>$idUser</td>
                                                        
                                                        <td>$nombre</td>
                                                        <td>$tipo</td>
                                                        <td>$correo</td>
                                                        <td>$password</td>
                                                        <td>
                                                            <a href='#' onclick='confirmaDeleteUser($idUser);'>Eliminar</a>
                                                        </td>
                                                        
                                                    </tr>
                                                    ";
                                    // CODIGO FOTO USUARIO
                                    // <td><a href='#' onclick='asignavalores($idUser);' data-activates='dr-users' data-toggle='modal' data-target='#myModalimg'><input type='hidden' id='imguser$idUser' value='$foto'><img src='http://localhost/CDI/Panel/content/images/usuarios/$foto' alt='' width='50px' height='50px'></a></td>

                                    // CODIGO BOTON ELIMINAR
                                    // <button type='button' class='btn btn-circle-lg waves-effect waves-circle waves-float' onclick='confirmaDeleteUser($idUser);' style='color:white;background:#293a4a;'>
                                    //             <i class='material-icons'>delete</i>
                                    //         </button>
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
                <h4 class="modal-title">REGISTRO DE NUEVO USUARIO</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <form id="form" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="nombre"  onkeyup="form.nombre.value=form.nombre.value.toUpperCase();" name="nombre" required>
                                        <label class="form-label" >Nombre completo</label>
                                    </div>
                                </div>
                            </div>

                           

                            <div class="col-md-6">
                                <div class="form-group form-float" style="margin-top: 13px;">
                                    <div class="form-line">
                                        <select id="tipo" name="tipo" style="width: 100%; border: none;">
                                            <option value="">Tipo de usuario</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Empleado</option>
                                            <option value="3">Almacén</option>
                                            <option value="4">Recepcionista</option>
                                            <option value="5">Cajera</option>
                                            <option value="6">Área complementaria</option>
                                            <option value="7">Compras</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div id="linea" class="form-line" onclick="darcolor();">
                                        <input type="text" class="form-control" name="correo" id="correo" required>
                                        <label class="form-label">Nickname</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-float">
                                    <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0px;padding-right: 0px;">
                                        <div class="form-line">
                                            <input type="password"  class="form-control" id="password" name="password" required>
                                            <label class="form-label">Contraseña</label>
                                        </div>
                                    </div>
                                    <a id="mostrar" style="cursor: pointer;" onmouseover="muestrapass();" onmouseout="ocultapass();">
                                        <i class="material-icons">visibility</i>
                                    </a>
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
<!-- Modal -->
<!--    <div class="modal fade" id="myModalimg" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px;">
    
      <!- Modal content->
     <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">Editar imagen de Usuario</h4>
        </div>
        <div class="modal-body">
          <div class="body">  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="hidden" name="iduser" id="iduser">
                                    <input type="hidden" name="fotobase" id="fotobase">
                                    <input type="file" class="form-control" name="fotoUser">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div align="center">
                            <button class="btn btn-primary m-t-15 waves-effect" style="background: #293a4a;" onclick="editaimg();">GUARDAR</button>
                        </div>
                    </div>
            </div>
        </div>
      </div>
    </div>
  </div> -->
<script type="text/javascript"  > 


    $('#tablaUsuarios').Tabledit({
        url: 'Crudusuarios/modificarDatos/',
        eventType: 'dblclick',
        editButton: false,
        deleteButton:false,
        columns: {
            identifier: [0, 'iduser'],
            editable: [[1, 'nombre'], [2, 'tipo', '{"0": "Elija una opción", "1": "Administrador", "2": "Empleado","3": "Almacen","4":"Recepcionista", "5": "Cajera", "6": "Área complementaria", "7": "Compras" }'],[3, 'correo'],[4, 'password']]
        }
    });
    $('#tablaUsuarios').DataTable({
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

    
  //function myFunction() {
  //var str = "ssss";
 //var str =$("#nombre").val();
//var res = str.toUpperCase();
  //document.getElementById("datos").innerHTML = res;
  //$("#tablaprue").val(res);

 

</script>
<!-- <script src="http://localhost/CDI/Panel/content/js/altausuario.js"></script> -->

<!-- <?php
//include "footer.php";
?> -->