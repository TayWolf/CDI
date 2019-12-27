<?php
include "header.php";
$idUser=$this->session->userdata('idUser');
?>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tableditCompras.js"></script>
<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" href="http://localhost/CDI/Panel/content/css/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
<!--  <script src="http://localhost/CDI/Panel/content/js/jquery-1.12.4.js"></script>temporal-->
<script src="http://localhost/CDI/Panel/content/js/jquery-ui.js"></script>
<style type="text/css">

    .unselectable{
        cursor: not-allowed !important;
    }
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

    .backInputs{
        background-color: #eee;
    }

    .table tr{

        white-space:nowrap;
        height: 25px;   }


</style>

<style>



    [type="radio"]:not(:checked) + span, [type="radio"]:checked + span {

        position: relative;

        padding-left: 35px;


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

        window.scrollTo(0,document.body.scrollHeight);
        var url = window.location.href;
        if (url == 'http://localhost/CDI/Panel/index.php/menus') {
            $("#menunav").css('display','none');
        }
        cambiainput();
    }</script>


<section style="margin-left: 15px;" class="content no-print"></section>
<section id="menunav"></section>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">

                    <div class="header" style="background-color: #293a4a;">
                        <div class="row">
                            <div class="col-md-4">
                                <h2 style="margin-top: 10px;color:#fff;">
                                    Resumen del sistema
                                </h2>
                            </div>
                        </div>
                    </div>

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
                                        <option value="">Seleccione un opción</option>
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
                            <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                <div class="">
                                    <input type="text" id="doctorName" name="doctorName" onchange="getlistado();" class="form-control backInputs" placeholder="Búsqueda por doctor" >
                                </div>
                            </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Paciente</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                    <div class="">
                                        <input type="text" id="pacienteName" name="pacienteName" onchange="getlistado();" class="form-control backInputs" placeholder="Búsqueda por paciente">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Folio de cita</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <input type="text" id="folioCitaFiltro" name="folioCitaFiltro" onchange="getlistado();" class="form-control backInputs" placeholder="Búsqueda por folio">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div style="width: 100%; height: 390px; overflow-y: scroll;">
                            <div class="table-responsive" >
                            <table class="table table-bordered table-striped table-hover js-exportable" id="example">
                                <thead>
                                <tr>
                                    <th class="columnaPequena" >Folio</th>
                                    <th>Paciente</th>
                                    <th>Estudio</th>
                                    <th>Importe</th>
                                    <th>Sala</th>
                                    <th>Cliente</th>
                                    <th>Horario de cita</th>
                                    <th>Doctor</th>
                                    <th class="columnaMediana">Recepción</th>
                                    <th class="columnaMediana">Pagado</th>
                                    <th class="columnaMediana">Pasar a cita</th>
                                    <th class="columnaMediana">Salió de cita</th>
                                    <th class="columnaMediana">Interpretación</th>
                                    <th class="columnaMediana">Resultados</th>
                                    <th class="columnaMediana">Limpiar</th>
                                    <th>Entregar</th>
                                    <th>Prioridad</th>
                                    <th>Pago</th>
                                </tr>
                                </thead>
                                <tbody id="listado">
                                </tbody>
                            </table>
                        </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-md-offset-4 col-md-4" align="center">
                                <input type="button" style="margin-top: 30px;" class="btn btn-danger waves-effect" onclick="exportarExcel('example','Hoja de entrega de estudios')" value="Exportar tabla a excel">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php
$arregloPermisosColumnas=array();
foreach ($permisosEspecificos as $permisoEspecifico)
{
    $arregloPermisosColumnas[$permisoEspecifico['nombreColumna']]=$permisoEspecifico['acceso'];
}
?>
<script type="text/javascript">
    //variable para saber los permisos en las columnas de un usuario
    var arregloPermisosColumnas=JSON.parse('<?=json_encode($arregloPermisosColumnas);?>');

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



<script type="text/javascript">

    function resetRadioButtons(id)

    {
        Swal.fire({
            title: 'Ingrese la contraseña de un administrador si desea limpiar este paciente',
            input: 'text',
            inputAttributes:
                {
                    autocapitalize: 'off'
                },
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return fetch(`//api.github.com/users/${login}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Ingrese Contraseña`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                var parametros={
                    "password" : result.value.login }
                $.ajax({

                    url : "<?=base_url('index.php/CrudAdministracion/verificarContrasena/')?>",
                    type: "POST",
                    data:parametros,
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data>0)
                        {
                            var arRadioBtn = document.getElementsByName("radio"+id);
                            for (var ii = 0; ii < arRadioBtn.length; ii++) {
                                var radButton = arRadioBtn[ii];
                                radButton.checked = false;
                            }
                            $("input[type='radio']").parent(id).children("span").html('');
                            cambiarStatusProcesosss(0, id)
                        }
                        else
                            Swal.fire('ERROR', 'Contraseña incorrecta', 'error');
                    }
                });

            }
        });
        $(".swal2-input").attr("type", "password");
    }
    function cambiarStatusProcesosss(statusProceso, idCita)
    {


        var inpuCi=$("#llego"+idCita).val();

        $("#horaLL"+idCita).html('');
        if (statusProceso=="0")
        {

            var HoraActual="00:00:00";
            var fecActual="0000-00-00";
        }
        if (statusProceso=="1")
        {
            var hoy = new Date();
            var dd = hoy.getDate();
            var mm = hoy.getMonth()+1;
            var yyyy = hoy.getFullYear();

            dd = addZero(dd);
            mm = addZero(mm);
            var fecActual =yyyy+'-'+mm+'-'+dd;
            var d = new Date();
            var HoraActual=d.getHours()+':'+d.getMinutes()+':00';

        }
        var parametros={
            "statusProceso" : statusProceso,
            "idCita" : idCita,
            "fecActual" : fecActual,
            "HoraActual" : HoraActual}
        $.ajax({
            url: "http://localhost/CDI/Panel/index.php/CrudAdministracion/cambiarStatusProceso/",
            type: "POST",
            data:parametros,
            dataType: "html",
            success: function(data)
            {
                if (HoraActual=="00:00:00")
                {
                    HoraActual="Hora de llegada";
                }
                $("#horaLL"+idCita).append(HoraActual);
            }
        });
        $.ajax({
            url: "http://localhost/CDI/Panel/index.php/CrudAdministracion/limpiarHistorialCambios/"+idCita,
            type: "POST",
            complete: function () {
                var idSala=$("#areaSele").val();
                var fechaconsu=$("#fechaconsu").val();
                var fechaconsuFinal=$("#fechaconsuFinal").val();
                var doctorName=$("#doctorName").val();
                var pacienteName=$("#pacienteName").val();
                var folioCita=$("#folioCitaFiltro").val();
                if(!idSala.length>0)
                {
                    idSala="0";
                }
                if(!fechaconsu.length>0)
                {
                    fechaconsu="0";
                }
                if(!fechaconsuFinal.length>0)
                {
                    fechaconsuFinal="0";
                }
                if(!doctorName.length>0)
                {
                    doctorName="0";
                }
                if(!pacienteName.length>0)
                {
                    pacienteName="0";
                }
                if(!folioCita.length>0)
                {
                    folioCita="0";
                }
                colocarHistorialHorarios(idSala,fechaconsu,fechaconsuFinal,folioCita,doctorName,pacienteName);
            }
        });

    }
</script>

<!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->



<script src="http://localhost/CDI/Panel/content/js/funcionesResumenSistema.js"></script>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>



<script src="http://localhost/CDI/Panel/content/js/pages/forms/form-validation.js"></script>



<script src="http://localhost/CDI/Panel/content/js/pages/forms/basic-form-elements.js"></script>



<!-- <?php

//include "footer.php";

?> -->