<?php
include "header.php";
?>
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet"/>
<style type="text/css">

    .degrado{
        background-color: #293a4ab5;
        color: #fff;

    }
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
        height:430px;
        /*overflow:auto;  */
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

    .form-control{
        background-color: #eee;

    }
    td{
        padding:0px !important;
        width: -10px;
    }

    table.dataTable thead th, table.dataTable thead td {
        padding: 10px 1px;
        border-bottom: 1px solid #111;
    }

</style>

<style type="text/css">
    .dropdown-item:hover{
        background: #ccc;
    }
</style>

<style type="text/css" media="print">
    .no-print { display: none; }
</style>
<link href="http://localhost/CDI/Panel/content/tittles/html5tooltips.css" rel="stylesheet">
<link href="http://localhost/CDI/Panel/content/tittles/html5tooltips.animation.css" rel="stylesheet">
<script src="http://localhost/CDI/Panel/content/js/jquery-1.12.4.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery-ui.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" href="http://localhost/CDI/Panel/content/css/jquery-ui.css">
<script src="http://localhost/CDI/Panel/content/js/ConcurrentThread-full.js"></script>

<section style="margin-left: 15px;" class="content no-print"> </section>
<section style="margin-left: 15px; margin-top: 10px;" class="content no-print">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <input id="idUser" type="hidden" value="<?=$this->session->userdata('idUser')?>" >
                <div class="card">
                    <div class="header" style="background-color: #293a4a; display: -webkit-box;">
                        <h2 style="color: #fff;margin-right: 60%;">
                            Citas programadas
                        </h2>
                    </div>

                    <div class="body">
                        <div class="row clearfix">

                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Doctor</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                    <div class="">
                                        <input type="text" id="doctorName" name="doctorName" onchange="datosTabbb();" class="form-control backInputs" placeholder="Búsqueda por doctor" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Paciente</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                    <div class="">
                                        <input type="text" id="pacienteName" name="pacienteName" onchange="datosTabbb();" class="form-control backInputs" placeholder="Búsqueda por paciente" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <p>
                                    <b>Sala</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                    <div class="">
                                        <select type="text" id="idSala" name="idSala" onchange="datosTabbb();" class="form-control backInputs">
                                            <option value="">Seleccione una sala</option>
                                            <?php
                                            foreach ($areas as $option)
                                            {
                                                print "<option value='".$option['idSala']."'>".$option['nombre']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-bottom: 0px; margin-top: 10px;">
                                <p>
                                    <b>Estudio</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                    <div class="">
                                        <input type="text" id="estudioName" name="estudioName" onchange="datosTabbb();" class="form-control backInputs" placeholder="Búsqueda por estudio" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 0px; margin-top: 10px;">
                                <p>
                                    <b>Folio de cita</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                    <div class="">
                                        <input type="text" id="folioCita" name="folioCita" onchange="datosTabbb();" class="form-control backInputs" placeholder="Búsqueda por folio" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-bottom: 0px; margin-top: 10px;">
                                <p>
                                    <b>Fecha Inicial</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                    <div class="">
                                        <input type="date" id="fechaconsu" name="fechaconsu" onchange="datosTabbb();" class="form-control backInputs">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3" style="margin-bottom: 0px; margin-top: 10px;">
                                <p>
                                    <b>Fecha Final</b>
                                </p>
                                <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                    <div class="">
                                        <input type="date" id="fechaconsuFinal" name="fechaconsuFinal" onchange="datosTabbb();" class="form-control backInputs">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="body table-responsive">
                            <div id="table-wrapper">
                                <div id="table-scroll">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tableProx" style="width: 1300px;">
                                        <thead>
                                        <tr>
                                            <th>FOLIO</th>
                                            <th style="display: none;">CITA</th>
                                            <th>CONFIRMADO</th>
                                            <th>PACIENTE</th>
                                            <th>DOCTOR</th>
                                            <th>SALA</th>
                                            <th>ESTUDIO</th>
                                            <th>FECHA</th>
                                            <th>INICIO</th>
                                            <th>TERMINO</th>
                                            <th>RESPONSABLE</th>
                                            <th style="width: 63px;">CANCELAR</th>
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

<script type="text/javascript">


    function getConfirmado(idCita)
    {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/getConfirmadoLista/"+idCita,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {

                // alert(data)
                if (data==null)
                {
                    //alert("no hay datos")
                    insertaConfirma(idCita)
                }else{
                    //alert("hay datos "+data.idCita)
                    eliminarConfirma(data.idCita)
                }

                //insertaConfirma(data.idCita)
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
    function eliminarConfirma(idCita)
    {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/eliminarCita/"+idCita,
            type: "POST",
            dataType: "html",
            success: function(data)
            {
                swal("Éxito", "Confirmación de cita eliminada", "success")
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function insertaConfirma(idCita)
    {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/insertaDato/"+idCita,
            type: "POST",
            dataType: "html",
            success: function(data)
            {

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    window.onload = datosTabbb();


    function datosTabbb() {
        //alert("inicial")
        var fActa=$("#fechaAct").val();
        var idUser=$("#idUser").val();
        //alert(idUser)
        var URLactual = window.location;
        // alert(URLactual)
        //alert("entr"+URLactual)
        if (URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas/citasProgramadas" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas/citasProgramadas#" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas/citasProgramadas/" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas/citasProgramadas/#") {

            $("#listado").html("");
            var rightNow = new Date();
            var res = rightNow.toISOString().slice(0,10).replace(/-/g,"-");
            $("#listado").html("");

            var idSala=$("#idSala").val();

            var fechaconsu=$("#fechaconsu").val();

            var fechaconsuFinal=$("#fechaconsuFinal").val();

            var doctorName=$("#doctorName").val();

            var pacienteName=$("#pacienteName").val();

            var estudioName=$("#estudioName").val();

            var folioCita=$("#folioCita").val();

            if(!idSala.length>0)
            {
                idSala="0";
            }


            if(!estudioName.length>0)
            {
                estudioName="0";
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

            var direccion="http://localhost/CDI/Panel/index.php/Crudcitas/traeListaEntregaCitas/"+idSala+"/"+fechaconsu+"/"+fechaconsuFinal+"/"+folioCita+"/"+doctorName.replace(" ", "%20")+"/"+pacienteName.replace(" ", "%20")+"/"+estudioName.replace(" ", "%20");

            $.ajax({
                url : direccion,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {

                    if (data.length>0)
                    {
                        for(i=0; i<data.length; i++)
                        {

                            var idCita=data[i]['idCita'];
                            var idFolio=data[i]['folioCita'];
                            var confirmado=(data[i]['idConfirmacion']!=null)?"checked='checked'":"";
                            if (data[i]['urgencia'] == 1) {
                                urgencia = "SI";
                            }else{
                                urgencia = "NO";
                            }

                            var srt=data[i]['fechaCita'];

                            var cancel=data[i]['cancelar'];
                            if (cancel==1)
                            {
                                var BotonC="CANCELADO";
                                var fuent="background-color: #f00;color: #fff; width: 80px;";
                                var BotonD="";


                            }else{
                                var clas="";
                                var fuent="";
                                var BotonC='<input '+confirmado+' type="checkbox" onclick="getConfirmado('+data[i]['idCita']+')"  id="llego'+data[i]['idCita']+'" name ="llego'+data[i]['idCita']+'" class="filled-in"   >';
                                var BotonD='<a style="cursor: pointer;" onClick="cancelarCita('+data[i]['idCita']+'); verificaContraPrioridad('+data[i]['idCita']+') ">Cancelar</a>';
                            }

                           
                            // alert(disabled+" - "+data[i]['idCita'])
                            $("#listado").append('<tr >'+

                                '<td style="text-align: center;">'+data[i]['folioCita']+'</td>'+
                                '<td style="text-align: center; display: none;">'+data[i]['idCita']+'</td>'+

                                '<td  style="text-align: center;'+fuent+'">'+BotonC+'<label style="margin-bottom: 0px;height: 15px;" for="llego'+data[i]['idCita']+'"></label></td>'+

                                //'<td style="'+fuent+'" id="horaLL'+data[i]['idCita']+'">'+Horal+'</td>'+
                                //'<td scope="row" style="text-align: center;">'+data[i]['orden_medica']+'</td>'+
                                '<td><a style="cursor: pointer;" onclick="GetTdodoEstudio('+data[i]['idPaciente']+','+data[i]['idCita']+','+idUser+')">'+data[i]['nombrePaci']+'</a></td>'+

                                '<td>'+data[i]['nombreDoc']+'</td>'+
                                '<td>'+data[i]['nombre']+'</td>'+
                                '<td>'+data[i]['nombreEstudio']+'</td>'+
                                '<td style="text-align: center;" onchange="abrirPot('+data[i]['idCita']+','+i+')">'+data[i]['fechaCita']+'</td>'+
                                '<td style="text-align: center;" onclick="abrirPotHora('+data[i]['idCita']+');pruebaModific('+i+')" >'+data[i]['horarioCita']+'</td>'+
                                '<td style="text-align: center;">'+data[i]['horaTerminada']+'</td>'+
                                '<td style="text-align: center;">'+data[i]['nombreUser']+'  <input type="hidden" name="fechOculto'+data[i]['idPaciente']+'" id="fechOculto'+data[i]['idPaciente']+'" value="'+data[i]['fechaCita']+'"></td>'+
                                '<td style="text-align: center;"><a style="cursor: pointer;"</a>'+BotonD+'</td>'+
                                '</tr>');
                        }

                    }else{
                        $("#listado").append('<td colspan="9" align="center" style="padding-top: 20px;">NO HAY CITAS PROGAMADAS</td>');
                    }

                    $('#tableProx').Tabledit({
                        url: 'Crudcitas/modificarDatostablaarray/',
                        editButton: false,
                        deleteButton:false,
                        columns: {
                            identifier: [1, 'idCita'],
                            editable: [[8, 'fechaCt'],[9, 'houraC']]
                        }
                    });
                    $("input[name*='fechaCt']").attr("type",'date');
                    $("input[name*='houraC']").attr("type",'time');
                }

            });
        }
    }


    function GetTdodoEstudio(idPac,idCi,idUs)
    {

        var idPac=idPac;
        var fecha=$("#fechOculto"+idPac).val();

        swal({
                title: "¿Está seguro de imprimir pase a sala del paciente?",
                text: "Se registrara como paciente en recepción",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Acepto",
                closeOnConfirm: false
            },
            function(){
                swal.close();
                var URL="http://localhost/CDI/Panel/Citapdfgrales.php?idPa="+idPac+"&fecha="+fecha+"&idCit="+idCi+"&idU="+idUs;
                window.open(URL,"ventana1","width=740 ,height=640,scrollbars=NO")
                datosTabbb()
            });
    }



    function abrirPot(idCi,i){
        var fec=$("#fechaCt"+i).val();
        ///alert(fec)
        var myWindow = window.open("http://localhost/CDI/Panel/index.php/Crudcitas/PoputEdit/"+idCi+"/"+fec, "", "width=1198,height=1191");
    }
    function abrirPotHora(idCi){
        // alert("fechaC"+i)
        var myWindow = window.open("http://localhost/CDI/Panel/index.php/Crudcitas/PoputEditHours/"+idCi, "", "width=1198,height=1191");
    }


    function addZero(i) {
        if (i < 10) {
            i = '0' + i;
        }
        return i;
    }
</script>
<script src="http://localhost/CDI/Panel/content/js/funcionescita.js"></script>

<script src="http://localhost/CDI/Panel/content/plugins/bootstrap/js/bootstrap.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/node-waves/waves.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-countto/jquery.countTo.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/raphael/raphael.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/morrisjs/morris.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/chartjs/Chart.bundle.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.time.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<script src="http://localhost/CDI/Panel/content/js/admin.js"></script>
<script src="http://localhost/CDI/Panel/content/js/pages/index.js"></script>
<script src="http://localhost/CDI/Panel/content/js/demo.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="http://localhost/CDI/Panel/content/tittles/html5tooltips.js"></script>
<script src="http://localhost/CDI/Panel/content/js/pages/tables/jquery-datatable.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-validation/jquery.validate.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/jquery-steps/jquery.steps.js"></script>
<script src="http://localhost/CDI/Panel/content/plugins/sweetalert/sweetalert.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/pages/forms/form-validation.js"></script>
<script src="http://localhost/CDI/Panel/content/js/pages/forms/basic-form-elements.js"></script>
  