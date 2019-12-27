<?php
include "header.php";
?>
<script src="http://localhost/CDI/Panel/content/js/ConcurrentThread-full.js"></script>


<style type="text/css">
    .input-group.input-group-lg .form-control {
        font-size: 14px;
    }
    .input-group{
        margin-bottom: 0px;
    }
    .card .body .col-xs-4, .card .body .col-sm-4, .card .body .col-md-4, .card .body .col-lg-4{
        margin-bottom: 0px;
    }

    #table-wrapper {
        position:relative;
    }
    #table-scroll {
        height:230px;
        overflow:auto;
        /*margin-top:20px;*/
    }
    #table-wrapper table {
        width:100%;

    }
    #table-wrapper table * {
        /*background:yellow;*/
        color:black;
    }
    #table-wrapper table thead th .text {
        position:absolute;
        top:-20px;
        z-index:2;
        height:20px;
        width:35%;
        border:1px solid red;
    }

    .table tr{

        white-space:nowrap;
       }

</style>
<style type="text/css">
    .dropdown-item:hover{
        background: #ccc;
    }
</style>
<script src="../content/js/jquery-1.12.4.js"></script>
<script src="../content/js/jquery-ui.js"></script>
<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" href="../content/css/jquery-ui.css">


<section style="margin-left: 15px;" class="content">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-offset-4 col-md-8">
                <ul style="list-style: none; display: inline-flex;">
        <li style="padding: 10px">
            <button class="btn btn-secondary btn-lg" type="button" style=" background: #AA0000;"></button>
            <span>Ausente</span>
        </li>
        <li style="padding: 10px">
            <button class="btn btn-secondary btn-lg" type="button" style=" background: #EE8800;"></button>
            <span>En recepción</span>
        </li>
        <li style="padding: 10px">
            <button class="btn btn-secondary btn-lg" type="button" style=" background: #D53774;"></button>
            <span>Pagado</span>
        </li>
        <li style="padding: 10px">
            <button class="btn btn-secondary btn-lg" type="button" style=" background: #EEEA26;"></button>
            <span>En proceso</span>
        </li>
    </ul>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-offset-2 col-md-10">
                <ul style="list-style: none; display: inline-flex;">
                    <li style="padding: 10px">
                        <button class="btn btn-secondary btn-lg" type="button" style=" background: #00d55b;"></button>
                        <span>En espera de resultados</span>
                    </li>
                    <li style="padding: 10px">
                        <button class="btn btn-secondary btn-lg" type="button" style=" background: #00AF55;"></button>
                        <span>Resultados en almacen</span>
                    </li>
                    <li style="padding: 10px">
                        <button class="btn btn-secondary btn-lg" type="button" style=" background: #56AF12;"></button>
                        <span>Despachado</span>
                    </li>
                    <li style="padding: 10px">
                        <button class="btn btn-secondary btn-lg" type="button" style=" background: #13B6D5;"></button>
                        <span>Reprogramación de cita</span>
                    </li>
                    <li style="padding: 10px">
                        <button class="btn btn-secondary btn-lg" type="button" style=" background: #694DD5;"></button>
                        <span>Cancelación</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="background-color: #293a4a; display: -webkit-box;">
                        <h2 style="color: #fff;margin-right: 60%;">
                            Estado de citas
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <div id="table-wrapper">
                            <div id="table-scroll">
                                <table class="table  table-bordered table-striped table-hover" id="tableProx">
                                    <thead>
                                    <tr>
                                        <th>HORA LLEGADA</th>
                                        <th>PACIENTE</th>
                                        <th>SALA</th>
                                        <th>ESTUDIO</th>
                                        <th>FECHA</th>
                                        <th>HORA INICIO</th>
                                        <th>HORA TERMINO</th>
                                        <th>STATUS</th>

                                    </tr>
                                    </thead>
                                    <tbody id="listaCitas">
                                        <?php
                                        $contador=0;
                                        foreach ($tablaCitas as $row)
                                        {
                                            $estado=$row['statusProceso'];
                                            switch($row['statusProceso'])
                                            {
                                                case 0:
                                                    $row['statusProceso']="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #AA0000;\"></button>";
                                                    break;
                                                case 1:
                                                    $row['statusProceso']="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #EE8800;\"></button>";
                                                    break;
                                                case 2:
                                                    $row['statusProceso']="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #D53774;\"></button>";
                                                    break;
                                                case 3:
                                                    $row['statusProceso']="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #EEEA26;\"></button>";
                                                    break;
                                                case 4:
                                                    $row['statusProceso']="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #00d55b;\"></button>";
                                                    break;
                                                case 5:
                                                    $row['statusProceso']="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #00AF55;\"></button>";
                                                    break;
                                                case 6:
                                                    $row['statusProceso']="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #56AF12;\"></button>";
                                                    break;
                                                case 7:
                                                    $row['statusProceso']="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #13B6D5;\"></button>";
                                                    break;
                                                case 8:
                                                    $row['statusProceso']="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #694DD5;\"></button>";
                                                    break;

                                            }
                                            echo "<tr>
                                                     <td>".$row['horallegada']."</td>
                                                     <td>".$row['nombrePaci']."</td>
                                                     <td>".$row['nombre']."</td>
                                                     <td>".$row['nombreEstudio']."</td>
                                                     <td id='fecha$contador'>".$row['fechaCita']."</td>
                                                     <td id='horaInicio$contador'>".$row['horarioCita']."</td>
                                                     <td id='horaTermino$contador'>".$row['horaTerminada']."</td>
                                                     <td id='status$contador'>".$row['statusProceso']."</td>
                                                  </tr>";
                                            $contador++;

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
    </div>
</section>

<script>
    function monitorearEstado()
    {
        while(true)
        {
            var fechaActual, fecha, horaInicio, horaTermino, fechaTabla, fechaTablaTermino;
            for (i = 0; i <<?php echo $contador;?>; i++) {
                fecha = $("#fecha" + i).html().split("-");
                horaInicio = $("#horaInicio" + i).html().split(":");
                horaTermino = $("#horaTermino" + i).html().split(":");

                fechaActual = new Date();
                fechaTabla = new Date(fecha[0], fecha[1] - 1, fecha[2], horaInicio[0], horaInicio[1], horaInicio[2], 0);
                fechaTablaTermino = new Date(fecha[0], fecha[1] - 1, fecha[2], horaTermino[0], horaTermino[1], horaTermino[2], 0);


                //SI LA FECHA ACTUAL ES MAYOR A LA FECHA DE LA TABLA ENTONCES
                //CAMBIAR EL ESTADO A EN PROCESO SI ES QUE SE ENCUENTRA EN RECEPCION
                //TODO: AGREGAR LA CONDICION DE PAGO
                if (fechaActual >= fechaTabla && $("#estado" + i).val() == 1) {
                    $("#status" + i).html("<input type='hidden' value='2' id='estado" + i + "'><button class='btn btn-secondary btn-sm' type='button' style='background: #EEEA26;'></button>");
                }

                //SI LA FECHA ACTUAL ES MAYOR A LA FECHA DE TERMINO DE LA TABLA Y EL ESTADO ACTUAL ES EN PROCESO:
                if (fechaActual >= fechaTablaTermino && $("#estado" + i).val() == 2) {
                    $("#status" + i).html("<input type='hidden' value='3' id='estado" + i + "'><button class='btn btn-secondary btn-sm' type='button' style='background: #00d55b;'></button>");
                }
            }
        }
    }

    Concurrent.Thread.create(monitorearEstado);
</script>



<script src="http://localhost/CDI/Panel/content/js/altapaciente.js"></script>
<!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->
<script src="http://localhost/CDI/Panel/content/js/funcionescita.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

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

<!-- <?php
//include "footer.php";
?> -->