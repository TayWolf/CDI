<?php
include "header.php";
?>
<link rel="stylesheet" type="text/css" href="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.css"/>
<script type="text/javascript" src="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.js"></script>

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
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 style="margin-top: 10px;">
                                    Lista de clientes deudores
                                </h2>
                            </div>

                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    
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
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Resta</th>
                                    <th>Pago</th>
                                </tr>
                                </thead>
                                <tbody id="tabla">
                                <?php
                                $idconteo=0;
                                foreach ($deudores as $row) {
                                    $idDeudor=$row['idDeudorCliente'];
                                    $nombrePaci=$row['nombreCliente'];
                                    $deudaTotal=$row['deudaTotal'];
                                    $pagoTotal=$row['pagoTotal'];
                                    $fechaPago=$row['fechaPago'];
                                    $restante=$deudaTotal-$pagoTotal;
                                    $idconteo++;
                                    echo " <tr>
	                                            <td style='display:none;'>$idDeudor</td>
                                                <td>$fechaPago</td>
                                                <td>$nombrePaci</td>
                                                <td>$deudaTotal</td>
                                                <td>$restante</td>
                                                <td><a href='http://localhost/CDI/Panel/index.php/CrudDeudoresClientes/verDeudores/$idDeudor'>Pago</a></td>
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
        <!-- #END# Exportable Table -->
    </div>
</section>
<!-- Modal -->

<script type="text/javascript">
    
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
<!-- <script src="http://localhost/CDI/Panel/content/js/altausuario.js"></script> -->

<!-- <?php
//include "footer.php";
?> -->