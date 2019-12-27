<?php
include "header.php";
?>
    <script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
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
        a{
            cursor: pointer;
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

            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-5">
                                    <h2 style="margin-top: 10px;">
                                        Tipos de usuarios
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="tablaUsuarios">
                                    <thead>
                                    <tr>

                                        <th>Tipo de usuario</th>
                                        <th style="text-align: center;">Permisos</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tabla" >
                                    <?php
                                    foreach ($tiposUsuario as $row) {
                                        $tipo=$row['tipoUser'];
                                        $idTipo=$row['tipoUser'];
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

                                        echo " <tr>
                                                    <td style='padding-left: 10px;'>$tipo</td>    
                                                    <td style='text-align: center;'>
                                                        <a href='http://localhost/CDI/Panel/index.php/CrudPermisos/verPermisos/$idTipo'>Gestionar</a>
                                                    </td>
                                                </tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript"  >

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
    </script>
<?php
include "footer.php";
?>