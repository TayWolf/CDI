<?php
include "header.php";
$idUser=$this->session->userdata('idUser');
?>
<style>
    .unselectable{
        cursor: not-allowed !important;
    }
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

    ::placeholder{
        color: red;
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

    .table tr{

        white-space:nowrap;
        height: 25px;   }



</style>

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
                                    Pacientes en espera
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
                                    <div class="form-line">
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
                                    <div class="form-line">
                                        <input type="date" id="fechaconsu" name="fechaconsu" onchange="getlistado();" class="form-control backInputs" value="<?=date("Y-m-d")?>">

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
                                    <div class="form-line">
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
                                    <div class="form-line">
                                        <input type="text" id="doctorName" name="doctorName" onchange="getlistado();" class="form-control backInputs" placeholder="busqueda por doctor" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Paciente</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <input type="text" id="pacienteName" name="pacienteName" onchange="getlistado();" class="form-control backInputs" placeholder="Busqueda por paciente">
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
                        <div style=" overflow-y: scroll;">
                            <div class="table-responsive" >
                                <table class="table table-bordered table-striped table-hover js-exportable" id="example" >
                                    <thead>
                                    <tr>
                                        <th class='whiteSpace'>Folio</th>
                                        <th class='whiteSpace'>Paciente</th>
                                        <th class='whiteSpace'>Estudio</th>
                                        <th class='whiteSpace'>Sala</th>
                                        <th class='whiteSpace'>Horario</th>
                                        <th class='whiteSpace'>Doctor</th>
                                        <th class='whiteSpace'>Recepción</th>
                                        <th class='whiteSpace'>Pagado</th>
                                        <th class='whiteSpace'>Pasar a cita</th>
                                        <th class='whiteSpace'>Salió de cita</th>
                                        <th class='whiteSpace'>Interpretación</th>
                                        <th class='whiteSpace'>Resultados</th>
                                        <th class='whiteSpace'>Limpiar</th>
                                        <th class='whiteSpace'>Urgencia</th>
                                        <th class='whiteSpace'>Pago</th>
                                    </tr>
                                    </thead>
                                    <tbody id="listado">
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
<?php
$arregloPermisosColumnas=array();
foreach ($permisosEspecificos as $permisoEspecifico)
{
    $arregloPermisosColumnas[$permisoEspecifico['nombreColumna']]=$permisoEspecifico['acceso'];
}
?>
<script type="text/javascript">
    //Esta variable se ocupa en getListado
    var arregloPermisosColumnas=JSON.parse('<?=json_encode($arregloPermisosColumnas);?>');
    /*$(document).ready(function() {
    $('#example').DataTable( {
        "scrollY":        "200px",
       
    } );
} );*/

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

                    url : "<?=base_url('index.php/CrudPacienteEspera/verificarContrasena/')?>",
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
            url: "http://localhost/CDI/Panel/index.php/CrudPacienteEspera/cambiarStatusProceso/",
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
            url: "http://localhost/CDI/Panel/index.php/CrudPacienteEspera/limpiarHistorialCambios/"+idCita,
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

<script src="http://localhost/CDI/Panel/content/js/funcionesPacienteEspera.js"></script>
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