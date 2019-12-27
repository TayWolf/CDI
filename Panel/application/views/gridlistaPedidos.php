<?php
include "header.php";
?>


<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" href="../content/css/jquery-ui.css">

<script src="../content/js/jquery-1.12.4.js"></script>
<script src="../content/js/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.css"/>

<script type="text/javascript" src="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.js"></script>

<style type="text/css">
 .form-control{
        background-color: #eee;   

    }

    .table tr{

        white-space:nowrap;
       }

</style>

<script type="text/javascript"> window.onload=menu;
    function menu() {
        var url = window.location.href;
        var idGogleado=$("#idUsuarioG").val();
        if (url == 'http://localhost/CDI/Panel/index.php/menus') {
            $("#menunav").css('display','none');
        }

        cambiainput();
    }</script>
<section style="margin-left: 15px;" class="content">

    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 style="margin-top: 10px;">
                                    Pedidos registrados
                                </h2>
                            </div>
                            <div class="col-md-5">
                                <!--<form class="app-search" onsubmit="buscarpedido();return false;">
                                    <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                        <div class="form-group form-float" style="margin-bottom: 0px;">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                <label class="form-label">Buscar</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                        <a href="#" onclick="buscarpedido();return false;"><i class="material-icons">search</i></a>
                                    </div>
                                </form>-->
                            </div>

                            <div class="col-md-1">
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                            <li><a href="http://localhost/CDI/Panel/index.php/Crudpedidos">Agregar nuevo Pedido</a></li>
                                            </li>
                                            <!-- <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li> -->
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <!-- <form method="post" action="" id="form"> -->
                    <div class="body">


                        <?php
                        $contador=1;

                        echo '<div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaPedidos">
                                <thead>
                                        <tr>
                                        <th style=\'display:none;\'></th>
                                          <th>Fecha del pedido</th>
                                          <th>Solicitado por</th>
                                          <th>Area solicitante</th>
                                          <th style=\'display:none;\'></th>
                                          <th>Detalle</th>
                                          <th>PDF</th>
                                          <th>Eliminar</th>
                                        </tr>
                                </thead>
                                <tbody id="tabla">';
                        foreach ($listaPedido as $row) {
                            $idPedido=$row["idSolicitud"];
                            $FechaPedido=$row["fechaPedido"];
                            $nombreSolicitante=$row["personaPedido"];
                            $areaSolicitante=$row["nombreArea"];
                            echo "<tr>
                                        <td style='display:none'>$idPedido</td>
                                        <td>$FechaPedido</td>
                                        <td>$nombreSolicitante</td>



                                        <td id='nombreAre$idPedido' onclick=traerAreaNombre($idPedido);>$areaSolicitante</td>
                                        <td id='muestraselectcarea$idPedido' style='display: none;'>
                                            <select id='selectarea$idPedido' name='selectarea$idPedido' onchange='modificarDatosAree($idPedido);'> </select>
                                        </td>



                                        <td><a href='#' data-toggle='modal' data-target='#defaultModalDetalle' onclick='abrirVentanaDetalle($idPedido)'>Ver</a></td>
                                        <td><a href='#' onClick='pdfDetalle($idPedido)'>PDF</a></td>
                                        <td><a href='#' onClick='eliminarPedido($idPedido)'>Eliminar</a></td>

                                      </tr>";
                            $contador++;
                        }
                        echo '</tbody>
                                </table>';
                        ?>

                    </div>
                    <!--   </form>  -->

                </div>

            </div>

        </div>


    </div>

    <div class="modal fade" id="defaultModalDetalle" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #293a4a;">
                    <h4 class="modal-title" id="defaultModalLabel" style="color:#fff;">Datos de la solicitud de la compra</h4>
                </div>
                <div class="modal-body" style="padding-bottom: 0px;">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Autorizo:</th>
                                <th>Solicitado Por: </th>
                                <th>F. Pedido</th>
                                <th>Área Solicitante:</th>
                            </tr>
                            </thead>
                            <tbody id="detalleRespo">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-header" style="padding-bottom: 0px;background-color: #293a4a;">
                    <h4 class="modal-title" id="defaultModalLabel" style="color:#fff;">Artículos de la compra</h4>
                </div>
                <div class="modal-body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>

                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Artículo</th>
                                <th>Área uso</th>
                                <th>Observaciones</th>

                            </tr>
                            </thead>
                            <tbody id="listCart">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="http://localhost/CDI/Panel/content/js/funcionesPedido.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="http://localhost/CDI/Panel/content/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="http://localhost/CDI/Panel/content/plugins/node-waves/waves.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="http://localhost/CDI/Panel/content/plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Morris Plugin Js -->
<script src="http://localhost/CDI/Panel/content/plugins/raphael/raphael.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/morrisjs/morris.js"></script>

<!-- ChartJs -->
<script src="http://localhost/CDI/Panel/content/plugins/chartjs/Chart.bundle.js"></script>

<!-- Flot Charts Plugin Js -->
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.time.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="http://localhost/CDI/Panel/content/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Custom Js -->
<script src="http://localhost/CDI/Panel/content/js/admin.js"></script>
<script src="http://localhost/CDI/Panel/content/js/pages/index.js"></script>

<!-- Demo Js -->
<script src="http://localhost/CDI/Panel/content/js/demo.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="http://localhost/CDI/Panel/content/js/pages/tables/jquery-datatable.js"></script>




<!-- Jquery Validation Plugin Css -->
<script src="http://localhost/CDI/Panel/content/plugins/jquery-validation/jquery.validate.js"></script>

<!-- JQuery Steps Plugin Js -->
<script src="http://localhost/CDI/Panel/content/plugins/jquery-steps/jquery.steps.js"></script>

<!-- Sweet Alert Plugin Js -->
<script src="http://localhost/CDI/Panel/content/plugins/sweetalert/sweetalert.min.js"></script>

<script src="http://localhost/CDI/Panel/content/js/pages/forms/form-validation.js"></script>

<script src="http://localhost/CDI/Panel/content/js/pages/forms/basic-form-elements.js"></script>


<script>
    function eliminarPedido(x)
    {
        eliminar=x;
        //$( "tr" ).remove('#'+eliminar+'');
        swal({
                title: "¿Está seguro de eliminar este pedido?",
                text: "No se podra recuperar nunca más!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Si quiero borrarlo",
                closeOnConfirm: false
            },
            function(){
                location.href="http://localhost/CDI/Panel/index.php/Crudpedidos/deletePedido/"+eliminar;
            });
    }
    $('#tablaPedidos').Tabledit({
        url: 'http://localhost/CDI/Panel/index.php/Crudpedidos/modificarDatos/',

        editButton: false,
        deleteButton:false,
        columns: {
            identifier: [0, 'idSolicitud'],
            editable: [[1, 'fechaPedido'], [2, 'personaPedido']]
        }
    });
    $('#tablaPedidos').DataTable({
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
    $("input[name*='fechaPedido']").attr("type",'date');
</script>
                                    