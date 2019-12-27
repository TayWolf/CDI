<?php
include "header.php";
$idUser=$this->session->userdata('idUser');
?>


<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tableditCompras.js"></script>

<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" href="http://localhost/CDI/Panel/content/css/jquery-ui.css">

<!--  <script src="http://localhost/CDI/Panel/content/js/jquery-1.12.4.js"></script>temporal-->
<script src="http://localhost/CDI/Panel/content/js/jquery-ui.js"></script>
<style type="text/css">
    .mainfooter {
        bottom: 0px;
        left: 94%;
        box-shadow: none;
    }
    @media screen and (max-width: 681px){
        .mainfooter {
            bottom: 0px;
            left: 90%;
            box-shadow: none;
        }
    }
    @media screen and (max-width: 525px){
        .mainfooter {
            bottom: 0px;
            left: 85%;
            box-shadow: none;
        }
    }
    @media screen and (max-width: 385px){
        .mainfooter {
            bottom: 0px;
            left: 85%;
            box-shadow: none;
        }
    }
    .erroresss{
        -webkit-box-shadow: 0 0 10px rgba(0,0,0.3);
        -moz-box-shadow: 0 0 10px rgba(0,0,0.3);
        -o-box-shadow: 0 0 10px rgba(0,0,0.3);
        background: red;
        box-shadow: 0 0 10px rgba(0,0,0.3);
        color: #fff;
        display: none;
        font-size: 14px;
        margin-top: -100px;
        margin-left: 400px;
        padding: 25px;
        position: absolute;
        z-index: 100;
    }

     

</style>
<style>

    [type="radio"]:not(:checked) + span, [type="radio"]:checked + span {
        position: relative;
        padding-left: 35px;
        cursor: pointer;
        display: inline-block;
        height: 25px;
        line-height: 25px;
        font-size: 1rem;
        -webkit-transition: .28s ease;
        transition: .28s ease;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none
    }


    [type="radio"] + span:before, [type="radio"] + span:after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        margin: 4px;
        width: 16px;
        height: 16px;
        z-index: 0;
        -webkit-transition: .28s ease;
        transition: .28s ease
    }

    [type="radio"]:not(:checked) + span:before, [type="radio"]:not(:checked) + span:after,
    [type="radio"]:checked + span:before, [type="radio"]:checked + span:after,
    [type="radio"].with-gap:checked + span:before, [type="radio"].with-gap:checked + span:after {
        border-radius: 50%
    }

    [type="radio"]:not(:checked) + span:before, [type="radio"]:not(:checked) + span:after {
        border: 2px solid #5a5a5a
    }

    [type="radio"]:not(:checked) + span:after {
        -webkit-transform: scale(0);
        transform: scale(0)
    }

    [type="radio"]:checked + span:before {
        border: 2px solid transparent
    }

    [type="radio"]:checked + span:after, [type="radio"].with-gap:checked + span:before,
    [type="radio"].with-gap:checked + span:after {
        border: 2px solid #26a69a
    }

    [type="radio"]:checked + span:after, [type="radio"].with-gap:checked + span:after {
        background-color: #26a69a
    }

    [type="radio"]:checked + span:after {
        -webkit-transform: scale(1.02);
        transform: scale(1.02)
    }

    [type="radio"].with-gap:checked + span:after {
        -webkit-transform: scale(0.5);
        transform: scale(0.5)
    }

    [type="radio"].tabbed:focus + span:before {
        -webkit-box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.1);
        box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.1)
    }

    [type="radio"].with-gap:disabled:checked + span:before {
        border: 2px solid rgba(0, 0, 0, 0.42)
    }

    [type="radio"].with-gap:disabled:checked + span:after {
        border: none;
        background-color: rgba(0, 0, 0, 0.42)
    }

    [type="radio"]:disabled:not(:checked) + span:before, [type="radio"]:disabled:checked + span:before {
        background-color: transparent;
        border-color: rgba(0, 0, 0, 0.42)
    }

    [type="radio"]:disabled + span {
        color: rgba(0, 0, 0, 0.42)
    }

    [type="radio"]:disabled:not(:checked) + span:before {
        border-color: rgba(0, 0, 0, 0.42)
    }

    [type="radio"]:disabled:checked + span:after {
        background-color: rgba(0, 0, 0, 0.42);
        border-color: #949494
    }
    .backInputs{
        background-color: #eee;
    }

</style>



<script type="text/javascript"> window.onload=menu;
    function menu() {
        var url = window.location.href;
        if (url == 'http://localhost/CDI/Panel/index.php/menus') {
            $("#menunav").css('display','none');
        }
        cambiainput();
    }</script>
<section style="margin-left: 15px;" class="content">
    <section id="menunav">

    </section>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="background-color: #293a4a;">
                        <div class="row">
                            <div class="col-md-4">
                                <h2 style="margin-top: 10px;color:#fff;">
                                    Entrega de resultados
                                </h2>
                            </div>
                        </div>
                    </div>

                    <!-- <form method="post" action="" id="form"> -->
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Área</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                        <span class="input-group-addon">
                                          <i class="material-icons">credit_card</i>
                                        </span>
                                    <div class="">
                                        <input type="hidden" id="idUser" name="idUser" value="<?php echo $idUser; ?>">
                                        <select class="form-control backInputs" onchange="getlistado();" id="areaSele" name="areaSele" required>
                                            <option value="">Seleccione un área</option>
                                            <?php
                                            foreach ($areas as $row)
                                            {
                                                $idArea=$row["idSala"];
                                                $nombreArea=$row["nombre"];
                                                echo "<option value='$idArea'>$nombreArea</option>";
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Fecha Inicial</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                    <div class="">
                                        <input type="date" id="fechaconsu" name="fechaconsu" onchange="getlistado();" class="form-control backInputs">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Fecha Final</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                    <div class="">
                                        <input type="date" id="fechaconsuFinal" name="fechaconsuFinal" onchange="getlistado();" class="form-control backInputs">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Doctor</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 10px;">

                                    <div class="">
                                        <input type="text" id="doctorName" placeholder="Búsqueda por doctor" name="doctorName" onchange="getlistado();" class="form-control backInputs">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Paciente</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 10px;">

                                    <div class="">
                                        <input type="text" id="pacienteName" placeholder="Búsqueda por paciente" name="pacienteName" onchange="getlistado();" class="form-control backInputs">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Folio de cita</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <input type="text" id="folioCitaFiltro" name="folioCitaFiltro" onchange="getlistado();" class="form-control backInputs" placeholder="Busqueda por folio">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--   </form>  -->

                        <div style="width: 100%; height: 390px; overflow-y: auto;">
                            <div  >
                                <table style="width: 1650px;" class="table table-bordered table-striped table-hover js-exportable" id="example">
                                    <thead>
                                    <tr>
                                        <th style="display:none;">Cita</th>
                                        <th>Folio</th>
                                        <th>Paciente</th>
                                        <th>Estudio</th>
                                        <th>Interpretación</th>
                                        <th>Elaborado</th>
                                        <th>Entrega</th>
                                        <th>Prioridad</th>
                                        <th>Pago</th>
                                        <th>Responsable</th>
                                        <th>Recibió Resultado</th>
                                        <th>Doctor</th>
                                        <th>Sala</th>
                                        <th>Cliente</th>
                                        <th>Observaciones</th>
                                        <th>Horario de cita</th>
                                    </tr>
                                    </thead>
                                    <tbody id="listado">
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-offset-4 col-md-4" align="center">
                                <input type="button" onclick="exportarExcel('example','Hoja de entrega de estudios')" value="Exportar tabla a excel">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var exportarExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
            window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>
<script src="http://localhost/CDI/Panel/content/js/funcionesresultados.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/bootstrap/js/bootstrap.js"></script>

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