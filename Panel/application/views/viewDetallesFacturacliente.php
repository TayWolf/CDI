<?php

include "header.php";

$idUser=$this->session->userdata('idUser');

?>

<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<link rel="stylesheet" href="http://localhost/CDI/Panel/content/css/jquery-ui.css">

<script src="http://localhost/CDI/Panel/content/js/jquery-ui.js"></script>

<script src="http://localhost/CDI/Panel/content/js/numeroALetras.js"></script>



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

    tbody {

        /*display:block;*/

        height:290px;

        overflow-y:auto;

    }



    .columnaPequena

    {





    }

    .columnaMediana

    {

        /*width: 80px;

        text-align: center;*/

    }
    input{
        background-color: #eee !important;
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

<style>

    tr{ cursor: pointer;}

</style>

<script type="text/javascript"> window.onload=menu;

    function menu() {

        var url = window.location.href;

        if (url == 'http://localhost/CDI/Panel/index.php/menus') {

            $("#menunav").css('display','none');

        }

        cambiainput();

    }

</script>
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
                                    Facturas del sistema
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Datos de la factura</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row clearfix">
                                            <div class="col-md-3 col-md-offset-6 form-control-label">
                                                <label for="nuFactr">Factura</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="">
                                                        <input type="text" id="nuFactr" name="nuFactr" class="form-control" value="<?=$idFactura?>" disabled>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="ClientFa">Cliente:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group" style="margin-bottom: 0px;">
                                                    <div class="">

                                                        <input type="text" id="ClientFa" class="form-control" placeholder="Nombre cliente" value="<?=$datosGenerales['nombreCliente']?>" disabled>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-1 form-control-label">

                                                <label for="rfcC">RFC:</label>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group" style="margin-bottom: 0px;">

                                                    <div class="">

                                                        <input type="text" id="rfcC" class="form-control" placeholder="RFC cliente" value="<?=$datosCliente['RFC']?>" disabled>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-2 form-control-label">

                                                <label for="rfcC">Domicilio:</label>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group" style="margin-bottom: 0px;">

                                                    <div class="">

                                                        <input type="text" id="DirecC" class="form-control" placeholder="Domicilio cliente" value="<?=strtoupper($datosCliente['direccionCliente'].", ".$datosCliente['Colonia'].", ".$datosCliente['nombreMunicipio'].", ".$datosCliente['Estado'])?>" disabled>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-1 form-control-label">

                                                <label for="rfcC">Citas:</label>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group" style="margin-bottom: 0px;">

                                                    <div class="">

                                                        <input type="text" id="ciNum" class="form-control" value="<?php

                                                        for($i=0; $i<sizeof($detalles); $i++)

                                                        {

                                                            echo $detalles[$i]['idCita'];

                                                            if($i<sizeof($detalles)-1)

                                                                echo ", ";



                                                        }

                                                        ?>" disabled>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row header">

                                            <b>Estudios realizados</b>

                                            <div class="row clearfix">

                                                <div class="col-sm-10">

                                                    <div class="form-group" style="margin-bottom: 0px;">

                                                        <div class="">

                                                            <textarea rows="4" id="listadoEst" class="form-control no-resize" placeholder="Listado de estudios realizados" disabled><?php

                                                                for($i=0; $i<sizeof($detalles); $i++)

                                                                {

                                                                    echo $detalles[$i]['nombreEstudio']."\n";

                                                                }

                                                                ?></textarea>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-sm-2">

                                                    <div class="form-group" style="margin-bottom: 0px;">

                                                        <div class="">

                                                            <textarea rows="4" id="listadoPrise" class="form-control no-resize" disabled><?php

                                                                for($i=0; $i<sizeof($detalles); $i++)

                                                                    echo "$ ".($detalles[$i]['precio'])."\n";

                                                                ?></textarea>

                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="col-md-4" style="margin: 0px">
                                                    <div class="form-group" style="margin: 0px;">
                                                        <div class="">
                                                            <b class="form-control-label">Forma de pago</b>
                                                            <input disabled class="form-control" value="<?=($datosGenerales['formaPago']==1)?"Transferencia":($datosGenerales['formaPago']==2)?"Efectivo":"Deposito bancario"?>" style="margin: 0px;">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin: 0px">
                                                    <div class="form-group" style="margin: 0px;">
                                                        <div class="">
                                                            <b class="form-control-label">Uso CFDI</b>
                                                            <input disabled class="form-control" value="<?=($datosGenerales['usoCFDI']==1)?"Gastos generales":($datosGenerales['usoCFDI']==2)?"Honorarios médicos":"Por definir"?>" style="margin: 0px;">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin: 0px">
                                                    <div class="form-group" style="margin: 0px;">
                                                        <div class="">
                                                            <b class="form-control-label">Método de pago</b>
                                                            <input disabled class="form-control" value="<?=($datosGenerales['metodoPago']==1)?"Crédito":"Contado"?>" style="margin: 0px;">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="col-md-12">

                                                    <b>Importe con letra</b>

                                                    <p id="letraImpor"> <?php

                                                        setlocale(LC_ALL, "es_MX");

                                                        echo $datosGenerales['montoPago'];

                                                        ?>/100 M.N.</p>

                                                </div>



                                            </div>

                                            <div class="col-md-6">

                                                <div class="row">

                                                    <div class="col-md-6 form-control-label">

                                                        <label for="rfcC">S. Médicos:</label>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="form-group" style="margin-bottom: 0px;">

                                                            <div class="">

                                                                <input type="text" id="serMedi" class="form-control" disabled>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6 form-control-label">

                                                        <label for="ivit">I.V.A.:</label>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="form-group" style="margin-bottom: 0px;">

                                                            <div class="">

                                                                <input type="text" id="ivit" class="form-control" disabled>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6 form-control-label">

                                                        <label for="ivit">Total:</label>

                                                    </div>

                                                    <div class="col-md-6">

                                                        <div class="form-group" style="margin-bottom: 0px;">

                                                            <div class="">

                                                                <input type="text" id="total" class="form-control" value="<?=$datosGenerales['montoPago']?>" disabled>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>



                                        </div>

                                    </div>



                                    <div class="modal-footer" style="text-align: center;">

                                        <button type="button" class="btn btn-default" onclick="javascript:window.close()">Cerrar</button>

                                    </div>

                                </div>



                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script>

    $(document).ready(function () {

        var totalito=parseFloat($("#total").val());

        subtotal=totalito/1.16;

        iva=subtotal*.16;

        $("#totalBD").val((totalito).toFixed(2));

        $("#serMedi").val((subtotal).toFixed(2));

        $("#ivit").val((iva).toFixed(2));

        $("#toti").val((totalito).toFixed(2));

        st((totalito).toFixed(2));

    });

</script>

<!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->



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