<?php
include "header.php";
?>

<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<style type="text/css">

    .degrado{
        background-color: #777;

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

    .form-control{
        background-color: #eee;
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



    .disabled {
        /* pointer-events: none;*/
        cursor: default;
        opacity: 0.6;
    }

    .selectHours{
        /* border: 2px solid #4f5d6a;*/
    }

    .col-md-1,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-10,.col-md-11,.col-md-12 {
        margin-bottom: 2px !important;
    }
    .form-group {
        margin-bottom: 10px !important;
    }

</style>

<style>
    table.estiloPer {
        border-collapse: separate;
        border-spacing: 2px;     }
    table.estiloPer > th, table.estiloPer > td {
        padding: 2px;
    }
    table.estiloPer > tbody> tr
    {
        vertical-align: top;
    }

    .table tr{

        white-space:nowrap;
    }

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

<div class="modal fade" id="myModalModificHor" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Horarios disponibles</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered estiloPer">
                        <tbody id="contenidoDispone">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<form id="formaltaPac"  method="post"></form>
<form id="form" method="post" ></form>

<section style="margin-left: 15px;" class="content no-print">

    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="background: #293a4a;padding-bottom: 0px;padding-top: 0px;">
                        <div class="row">
                            <div class="col-md-8">
                                <h2 style="margin-top: 10px;color:  #fff;">
                                    Control de Citas
                                </h2>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2" style="padding-right: 0px; width: 150px;">

                                <div class="input-group input-group-lg">

                                    <button form="form" type="button" class="btn btn-primary" onClick="historialCambios();"  style="background: #9e9e9e;">Historial de cambios </button>

                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2">

                                <div class="input-group input-group-lg">

                                    <button form="form" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalstatus" style="background: #9e9e9e;">Status de citas</button>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="body">
                        <input form="form" type="hidden" id="inputduracion" name="inputduracion">
                        <div class="content" style="border-bottom: 1px solid #ccc">
                            <div class="row clearfix">
                                <div class="col-md-2" id="divfecha">
                                    <p>
                                        <b>Fecha</b>
                                    </p>
                                    <?php $hoy=date("Y-m-d"); ?>
                                    <div class="input-group input-group-lg">
                                        <div class="form-line">
                                            <input type="hidden" id="idCat" name="idCat" >
                                            <input form="form" type="date" id="fecha" name="fecha" class="form-control degrado" style="border-radius: 8px;" value="<?php echo $hoy; ?>" required onchange="limpiamodal(); traedisponibilidad(); traecitaPropuesta(); traerCitas()" oninput="diaSemana(1);">
                                            <input form="form" type="hidden" id="idDiainput" name="idDiainput">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <p>
                                        <b>Sala</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <div class="form-line">
                                            <select form="form" id="Salas" name="Salas" class="form-control show-tick degrado" data-live-search="true" required onchange="traeMedico();limpiainputshora();limpiamodal(); traedisponibilidad(); traecitaPropuesta(); traerCitas();traerDiPaciente();diaSemana(1);" style="border-radius: 8px;">
                                                <option value="">Seleccione Sala</option>
                                                <?php
                                                foreach ($salas as $row ) {
                                                    $idSala=$row["idSala"];
                                                    $nombreSala=$row["nombre"];
                                                    echo "<option value='$idSala'>$nombreSala</option>";
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" id="divmedico" style="display: none;">
                                    <p>
                                        <b>Médico</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <div class="form-line">
                                            <select form="form" id="medico" name="medico" class="form-control show-tick degrado" style="border-radius: 8px;" required onchange="diaSemana(1);limpiainputshora();limpiamodal();traedisponibilidad();traecitaPropuesta(); traerCitas();traerDiPaciente()" >
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <p>
                                        <b>Estudio</b>
                                    </p>
                                    <div class="input-group input-group-lg">

                                        <div class="form-line">
                                            <input form="form" type="text" id="nombreEstudio" name="nombreEstudio" onkeyup="form.nombreEstudio.value=form.nombreEstudio.value.toUpperCase();"  class="form-control degrado" placeholder="Nombre del Estudio" onchange="limpiainputshora();"  oninput="borrarDatosI(this);" style="border-radius: 8px;" required >
                                            <input form="form" type="hidden" name="Estud" id="Estud">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <p>
                                        <b>Entrega resultado</b>
                                        <span><button style="display: none" class="btn btn-secondary btn-lg" id="colorRes" type="button" ></button></span>
                                    </p>
                                    <div class="input-group input-group-lg">

                                        <div class="form-line">
                                            <input type="hidden" form="form" id="Priorid" name="Priorid">

                                            <div style="display: none">
                                                <input  type="date" form="form" id="fechaEntre" onchange="validarColor()" name="fechaEntre" class="form-control degrado"  style="border-radius: 8px;" required >
                                            </div>
                                            <select form="form" id="tipoEntrega" name="tipoEntrega" class="form-control show-tick degrado" onchange="validarColor()"  required style="border-radius: 8px;">
                                                <option value="1">Entrega normal</option>
                                                <option value="2">Entregar mismo día</option>
                                                <option value="3">Urgente</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row" id="horasSeleccionadas">
                                <div class="col-md-1" style="margin-bottom: 3px;">
                                    <div class="center" align="center" >
                                        <p>
                                            <b>Folio</b>
                                        </p>

                                        <div class="input-group input-group-lg">
                                            <div class="form-line">

                                                <input form="form" type="text" id="codigoCita" name="codigoCita" class="form-control degrado"  style="border-radius: 8px;" required >
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="datosPacien" style="display:block;">
                                    <div class="col-md-4">
                                        <p>
                                            <b>Nombre del Paciente</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                                            <span class="input-group-addon" style="cursor:pointer;"><a id="editModal" onclick="visualModalEdit()" style="display: none">Editar</a>
                                                                <i class="material-icons">person</i>
                                                            </span>
                                            <div class="form-line">
                                                <input form="form" type="text" id="paciente" style="border-radius: 8px;" onkeypress="tre();" name="paciente" onkeyup="form.paciente.value=form.paciente.value.toUpperCase();"  class="form-control degrado" placeholder="Nombre del paciente" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 30px;width: 165px;">
                                        <button form="form" id="botonaltapaciente"type="button" class="btn btn-primary" onclick="mostrarRegistro();asignaClave()"data-toggle="modal">Registrar Paciente</button>
                                    </div>


                                    <div class="col-md-2">
                                        <p>
                                            <b>Orden Médica</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                                          <span class="input-group-addon">
                                                              <i class="material-icons">assignment</i>
                                                          </span>
                                            <div class="form-line">
                                                <input form="form" type="hidden" id="idUser" name="idUser" value="<?=$this->session->userdata('idUser'); ?>">

                                                <input form="form" type="hidden" name="fechaAct" id="fechaAct" value="<?php echo date('Y-m-d'); ?>">
                                                <input form="form" type="text" id="orden" name="orden" style="border-radius: 8px;" class="form-control degrado">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tipoCit" style="display: none;">
                                        <div class="col-md-3">
                                            <p>
                                                <b>Tipo Cita</b>
                                            </p>
                                            <div class="input-group input-group-lg">
                                                <div class="form-line">
                                                    <!-- <select form="form" id="tipoCi" name="tipoCi" class="form-control show-tick degrado" onchange="visualF();" data-live-search="true" required style="border-radius: 8px;">
                                                    </select> -->
                                                    <select form="form" id="tipoCi" name="tipoCi" class="form-control show-tick degrado" data-live-search="true" required style="border-radius: 8px;" onchange="traerPrecio()">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div id="visualDisponibilidad" style="display: block;">
                                    <div class="modal-header col-md-12" style="background: #e8e8e8;margin-bottom: 0px;padding-bottom: 0px;">
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="padding-top:  10px;margin-bottom: 0px;">
                                            <h4 class="modal-title">Horarios del día:</h4>
                                        </div>
                                        <div style="display: none;">
                                            <div class="col-md-2 col-sm-2 col-xs-2" style="margin-bottom: 0px;">
                                                <div class="input-group input-group-lg" style="margin: 0px;">
                                                    <div class="form-line">
                                                        <input type="date" id="fechamodal" name="fechamodal" class="form-control" onchange="traedisponibilidad(); traerCitas();diaSemana(0)">
                                                        <input type="hidden" id="inputduracion" name="inputduracion">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-xs-2" id="duracionEstudio" align="center" style="margin-bottom: 0px;"></div>

                                        <input type="checkbox" name="estadourgencia" id="estadourgencia" class="filled-in chk-col-light-blue" onchange="cambiaCheck();" value="0" />
                                        <label for="estadourgencia">Urgencia</label>

                                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin-bottom: 0px; width: 15%"  >
                                            <button class="btn btn-secondary btn-lg" type="button" style=" background: #ffca00;"></button>
                                            <span>No diponible</span>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0; padding:0;width: 15%" >
                                            <button class="btn btn-secondary btn-lg" type="button" style=" background: #293a4ab5;"></button>
                                            <span>Hora Principal</span>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0; padding:0; width: 15%">
                                            <button class="btn btn-secondary btn-lg" type="button" style=" background: #a2e9b0;"></button>
                                            <span>Horas seleccionadas</span>
                                            <!-- <span>Horario para cita</span> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-md-offset-2" align="center" style="margin-top: 10px;margin-bottom: 0px;">
                                    <p>Por favor seleccione el horario en que deseas asignar la cita.</p>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-5" style="padding-left: 0px;padding-right: 0px;width: 480px;">
                                        <div class="table-responsive">
                                            <table class="estiloPer">
                                                <thead>
                                                </thead>
                                                <tbody id="modal-body" style="font-family: Tahoma"></tbody>
                                            </table>
                                        </div>
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="border-top-width: 10px;">
                                            <thead>
                                            <tr>
                                                <th>Fecha Hora</th>
                                                <th>Sala</th>
                                                <th>Estudio</th>
                                                <th>Quitar</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tablaListado" >

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;width: 455px;">
                                        <div class="col-md-6" id="visualIndica" style="padding-left: 0px;display: none;padding-right: 01px;">
                                            <div class="modal-content">
                                                <div class="modal-header" style="padding-top: 0px; padding-bottom: 0px;">
                                                    <b>Indicaciones para el paciente</b>
                                                </div>
                                                <div>
                                                    <textarea id="indicacionPaciente" class="form-control" style="height: 150px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="visualObservaciones" style="padding-left: 0px;display: none;padding-right: 0px;">
                                            <div class="modal-content">
                                                <div class="modal-header" style="padding-top: 0px; padding-bottom: 0px;">
                                                    <b>Observaciones del paciente</b>
                                                </div>
                                                <div>
                                                    <textarea form="form" id="observacionesPaciente" onkeyup="form.observacionesPaciente.value=form.observacionesPaciente.value.toUpperCase();" name="observacionesPaciente" class="form-control" style="height: 150px;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding-left: 0px;padding-right: 0px;width: 455px;display:none" id="observacionesCit" >
                                        <div class="modal-content">
                                            <div class="modal-header" style="padding-top: 0px; padding-bottom: 0px;">
                                                <b>Detalle de la cita</b>
                                                <button onclick="ocultarDetalle()" class="btn right">X</button>    
                                            </div>
                                            <div>
                                                <textarea form="form" id="conedd" onkeyup="form.conedd.value=form.conedd.value.toUpperCase();" name="conedd" class="form-control" style="height: 170px;"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="registroPacientes" style="display: none;" >

                                        <div class="col-md-3 col-sm-3">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header" style="padding-top: 0px; padding-bottom: 0px;">

                                                    <h4 class="modal-title">REGISTRO DE NUEVO PACIENTE</h4>
                                                </div>
                                                <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px;">
                                                    <div class="body" style="padding-bottom: 0px;" >
                                                        <div class="row clearfix">
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >

                                                                <div class="body" style="padding-top: 0px; padding-bottom: 0px;">

                                                                    <div class="row clearfix">
                                                                        <div class="col-md-12" style="padding-left: 0px; margin-bottom: 0px;">
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line focused">
                                                                                    <input form="formaltaPac" type="text" class="form-control" id="clave" name="clave" required="" readonly="">
                                                                                    <label class="form-label">Clave</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12" style="margin-bottom: 0px;">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input form="formaltaPac" type="text" onkeyup="form.nombre.value=form.nombre.value.toUpperCase();" class="form-control" style="" id="nombre" name="nombre" required>
                                                                                <label class="form-label">Nombre del paciente</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-md-12" style="margin-bottom: 0px;">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <select id="genero" form="formaltaPac" class="form-control" class="form-control" name="genero" required>
                                                                                    <option value="">Seleccione un género</option>
                                                                                    <option value="1">Masculino</option>
                                                                                    <option value="2">Femenino</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12" style="margin-bottom: 0px;">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input id="correo" form="formaltaPac" type="text" class="form-control" name="correo" required>
                                                                                <label class="form-label">Correo</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12" style="margin-bottom: 0px;">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <input id="telefono" onkeyup="form.telefono.value=form.telefono.value.toUpperCase();" form="formaltaPac" type="text" class="form-control" name="telefono" required>
                                                                                <label class="form-label">Teléfono</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-8" style="margin-bottom: 0px;">
                                                                        <div class="form-group form-float">
                                                                            <div  class="form-line">
                                                                                <input id="fechanacimiento" form="formaltaPac" type="date" class="form-control" name="fechanaci" id="fechanaci"  required onchange="calcularEdad();">
                                                                                <label class="form-label">Fecha de Nacimiento</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4" style="margin-bottom: 0px;">
                                                                        <div class="form-group form-float">
                                                                            <div  class="form-line">
                                                                                <input form="formaltaPac" type="number" class="form-control" name="edad" id="edad" required>
                                                                                <label class="form-label" id="edadLabel">Edad</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div class="col-sm-12" style="margin-bottom: 0px;">
                                                                        <p><b>Médico Remitente</b></p>
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <select  id="medicoremitente"form="formaltaPac" class="form-control" class="form-control" name="remitente" id="remitente"  required>
                                                                                    <option value="">Seleccione un Médico Remitente</option>
                                                                                    <?php
                                                                                    $idconteo=0;
                                                                                    foreach ($medicoRem as $row) {
                                                                                        $idRemitente=$row['idRemitente'];
                                                                                        $nombreRem=$row['nombreRem'];
                                                                                        //$idconteo++; .
                                                                                        echo "
                                                                                 <option value='$idRemitente'>$nombreRem</option>
                                                                                             ";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12" style="margin-bottom: 0px;">
                                                                        <p><b>Cliente</b></p>
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <select id="cliente" form="formaltaPac" class="form-control" class="form-control" name="cliente" id="cliente" required>
                                                                                    <option value="">Seleccione un Cliente</option>
                                                                                    <?php
                                                                                    $idconteo=0;
                                                                                    foreach ($cliente as $row) {
                                                                                        $idCliente=$row['idCliente'];
                                                                                        $nombreCliente=$row['nombreCliente'];
                                                                                        //$idconteo++; .
                                                                                        echo "
                                                                          <option value='$idCliente'>$nombreCliente</option>
                                                                           ";
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div align="center">
                                                                        <button form="formaltaPac"  type="submit" class="btn btn-primary m-t-15 waves-effect">Aceptar</button>
                                                                        <div id="cargando" style="display: none;"></div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="visualVentanaEdi" style="display: none;">
                                        <!-- Modal content-->
                                        <div class="col-md-3 col-sm-3">

                                            <div class="modal-content">
                                                <div class="modal-header" style="padding-top: 0px; padding-bottom: 0px;">

                                                    <!-- <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button> -->
                                                    <h4 class="modal-title">Editar datos de paciente</h4>
                                                </div>
                                                <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px;">
                                                    <div class="body" style="padding-bottom: 0px;" >
                                                        <form method="post" action="" id="formPc">
                                                            <div class="row clearfix">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                                                    <div class="body" style="padding-top: 0px; padding-bottom: 0px;">

                                                                        <div class="row clearfix">
                                                                            <div class="col-md-12" style="padding-left: 0px; margin-bottom: 0px;">
                                                                                <div class="form-group form-float">
                                                                                    <div class="form-line focused">
                                                                                        <input  type="text" class="form-control" id="claveEdi" name="claveEdi" required="" readonly="">
                                                                                        <label class="form-label">Clave</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12" style="margin-bottom: 0px;">
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <input  type="text" class="form-control" style="" id="nombreEdit" name="nombreEdit" value=" " required>
                                                                                    <label class="form-label">Nombre del paciente</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row clearfix">
                                                                        <div class="col-md-12" style="margin-bottom: 0px;">
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <select id="generoEdi"  class="form-control" class="form-control" name="generoEdi" required>
                                                                                        <option value="">Seleccione un género</option>
                                                                                        <option value="1">Masculino</option>
                                                                                        <option value="2">Femenino</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-12" style="margin-bottom: 0px;">
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <input id="correoEd"  type="text" class="form-control" name="correoEd" value=" " required>
                                                                                    <label class="form-label">Correo</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-12" style="margin-bottom: 0px;">
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <input id="telefonoEdi" type="text" class="form-control" name="telefonoEdi" value=" " required>
                                                                                    <label class="form-label">Teléfono</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-8" style="margin-bottom: 0px;">
                                                                            <div class="form-group form-float">
                                                                                <div id="liff" class="form-line focused">
                                                                                    <input  type="date" class="form-control" name="fechanaciEdi" id="fechanaciEdi" value=" " required onchange="calcularEdad();">
                                                                                    <label class="form-label">Fecha de Nacimiento</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4" style="margin-bottom: 0px;">
                                                                            <div class="form-group form-float">
                                                                                <div  class="form-line focused">
                                                                                    <input type="number" class="form-control" name="edadEdi" id="edadEdi" value=" " required>
                                                                                    <label class="form-label" id="edadLabel">Edad</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row clearfix">
                                                                        <div class="col-sm-12" style="margin-bottom: 0px;">
                                                                            <p><b>Médico Remitente</b></p>
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <select  id="medicoremitenteEdi" class="form-control" class="form-control" name="medicoremitenteEdi"  required>
                                                                                        <option value="">Seleccione un Médico Remitente</option>
                                                                                        <?php
                                                                                        $idconteo=0;
                                                                                        foreach ($medicoRem as $row) {
                                                                                            $idRemitente=$row['idRemitente'];
                                                                                            $nombreRem=$row['nombreRem'];
                                                                                            //$idconteo++; .
                                                                                            echo "
                                                                               <option value='$idRemitente'>$nombreRem</option>
                                                                                           ";
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-12" style="margin-bottom: 0px;">
                                                                            <p><b>Cliente</b></p>
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <select  class="form-control" class="form-control" name="clienteEdit" id="clienteEdit" required>
                                                                                        <option value="">Seleccione un Cliente</option>
                                                                                        <?php
                                                                                        $idconteo=0;
                                                                                        foreach ($cliente as $row) {
                                                                                            $idCliente=$row['idCliente'];
                                                                                            $nombreCliente=$row['nombreCliente'];
                                                                                            //$idconteo++; .
                                                                                            echo "
                                                                        <option value='$idCliente'>$nombreCliente</option>
                                                                         ";
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row clearfix">
                                                                        <div align="center">
                                                                            <button   type="submit" class="btn btn-primary m-t-15 waves-effect">Modificar</button>
                                                                            <div id="cargando" style="display: none;"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="padding: 20px; text-align: left;">

                                </div>

                                <div class="col-md-12" align="center">
                                    <div class="col-md-2" id="divhorainicio" style="display: none;">
                                        <p>
                                            <b>Hora Inicio</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <div class="form-line">
                                                <input form="form" type="time" id="horainicio" name="horainicio" class="form-control" required readonly onclick="alertadisponibilidad();">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="divhoratermino" style="display: none;">
                                        <p>
                                            <b>Hora Termino</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <div class="form-line">
                                                <input form="form" type="time" id="horatermino" name="horatermino" class="form-control" required readonly onclick="alertadisponibilidad();">
                                            </div>
                                        </div>
                                    </div>

                                    <button form="form" type="button" class="btn btn-primary" onclick="AsignahorasEstablecidas();"  style=" text-align: left;display: none;">Apartar horario</button>
                                    <input form="form"  type="submit" class="btn bg-black waves-effect waves-light" value="Agregar" onclick="establecerCitasSinGuardar(true);verificarHoraLab();">

                                </div>
                                <div class="col-md-12" style="display: inline-block;margin-bottom: 0px;">
                                    <div id="modal-alert-div" class="col-md-12">
                                        <div id="modal-alert" class="col-md-12" align="center" style="margin-bottom: 20px;"></div>
                                    </div>
                                </div>

                                <div class="row" >
                                    <div id="visualFavt" style="display: none;">
                                        <div class="col-md-4">
                                            <p>
                                                <b>Factura</b>
                                            </p>
                                            <div class="input-group input-group-lg">
                                                <div class="form-line">
                                                    <select form="form" id="FactSn" name="FactSn" class="form-control show-tick degrado" data-live-search="true" style="border-radius: 8px;">
                                                        <option value="">Selecciones una opcion</option>
                                                        <option value="1">Si</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="checkbox" form="form" name="cortesiaCit" id="cortesiaCit" class="filled-in chk-col-light-blue" value="0" onclick="corteVisual()" />
                                        <label for="cortesiaCit"><b>Cortesía</b></label>
                                    </div>
                                    <div class="col-md-4" id="visualCortes" style="display: none;">
                                        <p>
                                            <b>Tipo cortesía</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <div class="form-line">
                                                <select form="form" id="tipCortes" name="tipCortes" class="form-control show-tick degrado" data-live-search="true" required style="border-radius: 8px;">
                                                    <option value="0">Selecciones una opcion</option>
                                                    <option value="1">Socios</option>
                                                    <option value="2">Enviado por médico</option>
                                                    <option value="3">Familiares socios</option>
                                                    <option value="4">Pacientes observaciones</option>
                                                    <option value="5">Especiales</option>
                                                    <option value="6">Requisiciones</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div id="autorizaBoton" style="display: none;" align="center">
                                        <div class="button-demo">
                                            <button class="btn bg-black waves-effect waves-light" onclick="establecerCitasSinGuardar(false); finalizarCita();">Crear Cita</button>
                                            <!-- <input form="form" type="submit" class="btn bg-black waves-effect waves-light" value="Crear Cita"> -->
                                        </div>
                                    </div>
                                </div>

                                <input form="form" type="hidden" id="horacita" name="horacita">

                            </div>
                        </div>
                    </div>
                </div>
                <input form="form" type="hidden" name="HoraTerminada" id="HoraTerminada">
                <input form="form" type="hidden" name="emergencia" id="emergencia" value="0">
                <input form="form" type="hidden" name="idPaciente" id="idPaciente">
                <input form="form" type="hidden" name="valorDuracionEstudio" id="valorDuracionEstudio">
                <input form="form" type="hidden" name="PropuestahoraCita" id="PropuestahoraCita">
                <input form="form" type="hidden" name="PropuestaminCita" id="PropuestaminCita">
                <input form="form" type="hidden" name="idCitarecorrida" id="idCitarecorrida">
                <input form="form" type="hidden" name="varSalidaAnterior" id="varSalidaAnterior">

            </div>

        </div>

    </div>

    </div>
</section>
<section style="margin-left: 15px; margin-top: 10px;" class="content no-print">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="background-color: #293a4a; display: -webkit-box;">
                        <!-- <div class="col-md-6"> -->
                        <h2 style="color: #fff;margin-right: 60%;">
                            Citas programadas
                        </h2>
                        <!-- </div> -->
                        <div class="col-md-6">
                            <form class="app-search" onsubmit="buscarxPeticion();return false;">
                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding: 0px;">
                                    <div class="form-group form-float" style="margin-bottom: 0px;">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="busqueda" name="busqueda">
                                            <label class="form-label">Buscar</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1" style="padding: 0px;">
                                    <a href="#" onclick="buscarxPeticion();return false;"><i class="material-icons">search</i></a>
                                </div>
                            </form>
                        </div>
                    </div>

                <div class="body table-responsive">
                  <div id="table-wrapper">
                    <div id="table-scroll">
                        <table class="table table-bordered" id="tableProx" style="width: 1250px;">
                            <thead>
                                <tr>
                                    <th>USUARIO</th>
                                    <th>FOLIO</th>
                                    <th>HORA INICIO</th>
                                    <th>RECEPCIÓN</th>
                                    <th>IMPRIMIR</th>
                                    <th>HORA LLEGADA</th>
                                    <th>PACIENTE</th>
                                    <th>ESTUDIO</th>
                                    <th>COMENTARIOS</th>
                                    <th>CLIENTE</th>
                                    <th>DOCTOR ENVIA</th>
                                    <!-- <th>ORDEN MÉDICA</th>
                                    <th>SALA</th>
                                    <th>FECHA</th>   -->                              
                                    <th>CANCELAR</th>
                                </tr>
                            </thead>
                            <tbody id="listadocitasProx"> 
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


<!--MODAL-->
<div class="modal fade bd-example-modal-lg" id="modalCambios" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Historial de cambios</h4>
                <button form="form" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="no-print" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6" id="groupFechaInicial">
                            <div class="form-group">
                                <div class="form-line">
                                    <b>Fecha inicial</b>
                                    <input form="form" class="form-control" type="date" id="fechaInicialHistorial" onchange="historialCambios();">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6" id="groupFechaFinal">
                            <div class="form-group">
                                <div class="form-line">
                                    <b>Fecha final</b>
                                    <input form="form" class="form-control" type="date" id="fechaFinalHistorial" onchange="historialCambios();">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-hover" id="citasEdiListado">
                                <thead>
                                <tr>
                                    <th>Cita</th>
                                    <th>Usuario</th>
                                    <th>Hora</th>
                                    <th>Fecha del cambio</th>
                                    <th>Detalle</th>

                                </tr>
                                </thead>
                                <tbody id="tablaHistorial">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button form="form" type="button" class="btn btn-secondary no-print" data-dismiss="modal">Cerrar</button>
                <!-- <button form="form" id="BtnExportarPDF" type="button" class="btn btn-primary no-print" onClick="imprimir();">Exportar a PDF</button> -->

            </div>
        </div>
    </div>
</div>
<!--FIN MODAL CAMBIOS-->
<div class="modal fade" id="myModalstatus" role="dialog" >
    <div class="modal-dialog modal-lg" style="width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <button form="form" type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Codigo de colores</h4>
            </div>
            <section style="margin-left: 15px;">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <ul style="list-style: none; display: inline-flex;">
                                <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #ED130A;"></button>
                                    <span>Ausente</span>
                                </li>
                                <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #80C41C;"></button>
                                    <span>En recepción</span>
                                </li>
                                <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #F0047F;"></button>
                                    <span>Pagado</span>
                                </li>
                                <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #FF8000;"></button>
                                    <span>En proceso</span>
                                </li>
                                <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #F2F91C;"></button>
                                    <span>En espera de resultados</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--<div class="row clearfix">
                        <div class="col-md-10">
                            <ul style="list-style: none; display: inline-flex;">
                                <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #F2F91C;"></button>
                                    <span>En espera de resultados</span>
                                </li>
                                 <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #82027E;"></button>
                                    <span>Resultados en almacen</span>
                                </li>
                                <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #A0642F;"></button>
                                    <span>Despachado</span>
                                </li>
                                <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #19A7C4;"></button>
                                    <span>Reprogramación de cita</span>
                                </li>
                                <li style="padding: 10px">
                                    <button form="form" class="btn btn-secondary btn-lg" type="button" style=" background: #110B79;"></button>
                                    <span>Cancelación</span>
                                </li>
                            </ul>
                        </div>

                    </div> -->

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
                                            <table class="table  table-bordered table-striped table-hover" >
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

                                                    if($row['statusProceso']==0)
                                                    {
                                                        $bbbb="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #ED130A;\"></button>";
                                                    }
                                                    if ($row['statusProceso']==1) {
                                                        $bbbb="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #80C41C;\"></button>";
                                                    }
                                                    if ($row['statusProceso']==2) {
                                                        $bbbb="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #F0047F;\"></button>";
                                                    }
                                                    if ($row['statusProceso']==3) {
                                                        $bbbb="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #FF8000;\"></button>";
                                                    }

                                                    if ($row['statusProceso']==4) {
                                                        $bbbb="<input type='hidden' value='$estado' id='estado$contador'><button class=\"btn btn-secondary btn-sm\" type=\"button\" style=\" background: #F2F91C;\"></button>";
                                                    }


                                                    echo $row['statusProceso']."<tr>
                                                           <td>".$row['horallegada']."</td>
                                                           <td>".$row['nombrePaci']."</td>
                                                           <td>".$row['nombre']."</td>
                                                           <td>".$row['nombreEstudio']."</td>
                                                           <td id='fecha$contador'>".$row['fechaCita']."</td>
                                                           <td id='horaInicio$contador'>".$row['horarioCita']."</td>
                                                           <td id='horaTermino$contador'>".$row['horaTerminada']."</td>
                                                           <td id='status$contador'>".$bbbb."</td>
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
            <div class="modal-footer">
                <button form="form" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    .dropdown-item:hover{
        background: #ccc;
    }
</style>

<style type="text/css" media="print">
    .no-print { display: none; }
</style>

<script type="text/javascript">
    var hayCitasSinGuardar=false;
    $(window).on('beforeunload', function(){

        if(hayCitasSinGuardar)
        {
            $.ajax({
                url: 'http://localhost/CDI/Panel/index.php/Crudcitas/eliminarCitasPorFolio/'+$("#codigoCita").val(),
                async: false
            });
        }


    });
    function establecerCitasSinGuardar(valor)
    {
        hayCitasSinGuardar=valor;
        console.log(valor);
    }
</script>
<script type="text/javascript">

    function traerDatosmodalCita(idC,i,rec,ho)
    {
        if (i=="0")
        {
            i="00";
        }
        for (var i = i; i < rec; i++)
        {
            // alert(i+" - "+rec)
            $("#botonminuto"+i+"-"+ho).addClass('selectHours');
        }

        $("#infoCouid").val(idC);
        $.ajax
        ({
            url: "http://localhost/CDI/Panel/index.php/Crudcitas/obtenerDetallecitaModa/"+idC,
            type: 'POST',
            dataType: 'json' ,
            success: function (data)
            {
                
                 $("#conedd").empty();
                 // $("#conedd").append("<p style='margin-bottom: 0px;'><strong>Folio:</strong> "+data.folioCita+"</p>"+ '\n' +"<p style='margin-bottom: 0px;'><strong>Nombre del Paciente:</strong> "+data.nombrePaci+"</p>"+ '\n' +"<p style='margin-bottom: 0px;'><strong>Médico:</strong> "+data.nombreDoc+"</p>"+ '\n' +"<p style='margin-bottom: 0px;'><strong>Estudio:</strong> "+data.nombreEstudio+"</p>"+ '\n' +"<p style='margin-bottom: 0px;'><strong>Duración:</strong> "+data.duracion+"</p>"+ '\n' +"<p style='margin-bottom: 0px;'><strong>Sala:</strong> "+data.nombre+"</p>"+ '\n' +"<p style='margin-bottom: 0px;'><strong>Hora de cita:</strong> "+data.horarioCita+"</p>"+ '\n' +"<p style='margin-bottom: 0px;'><strong>Hora de salida:</strong> "+data.horaTerminada+"</p>");
                 $("#observacionesCit").show();
                 $("#conedd").append("Folio: "+data.folioCita+""+ '\n' +"Nombre del Paciente: "+data.nombrePaci+""+ '\n' +"Médico: "+data.nombreDoc+""+ '\n' +"Estudio: "+data.nombreEstudio+""+ '\n' +"Duración: "+data.duracion+""+ '\n' +"Sala: "+data.nombre+""+ '\n' +"Hora de cita: "+data.horarioCita+""+ '\n' +"Hora de salida: "+data.horaTerminada+"");

               
                //$("#botonminuto"+i+"-"+h).addClass('selectHours');
            }
        });
    }
    function mostrarRegistro(){
        //  $("#registroPacientes").removeAttr('style');
        var esVisible = $("#registroPacientes").is(":visible");
        if (esVisible)
        {
            $("#registroPacientes").hide();
        }else{
            $("#registroPacientes").show();
            $("#visualVentanaEdi").hide();
        }
    }

    function imprimir()
    {


        if($("#fechaInicialHistorial").val()=="")
        {
            $("#groupFechaInicial").addClass('no-print');
        }
        else
        {
            $("#groupFechaInicial").removeClass('no-print');
        }
        if($("#fechaFinalHistorial").val()=="")
        {
            $("#groupFechaFinal").addClass('no-print');
        }
        else
        {
            $("#groupFechaFinal").removeClass('no-print');
        }

        print();

    }

    function historialCambios()
    {
        $("#BtnExportarPDF").prop('disabled', true);
        var parametros={fechaInicial : $("#fechaInicialHistorial").val(), fechaFinal : $("#fechaFinalHistorial").val()};
        $.ajax
        ({
            url: "http://localhost/CDI/Panel/index.php/Crudcitas/obtenerHistorial",
            data: parametros,
            type: 'POST',
            dataType: 'JSON' ,
            success: function (data)
            {
                $("#tablaHistorial").empty();
                for(i=0; i<data.length; i++)
                {
                    $("#tablaHistorial").append("<tr><td>"+data[i]['idCita']+"</td><td>"+data[i]['nombreUser']+"</td><td>"+data[i]['horaMod']+"</td><td>"+data[i]['fechaMod']+"</td><td><a href='http://localhost/CDI/Panel/index.php/Crudcitas/detalleEdit/"+data[i]['idontrol']+"'  target='_blank'>Detalle</a></td></tr>");
                }
            }
        });

        $("#modalCambios").modal('show');
        $("#BtnExportarPDF").prop('disabled', false);

    }

    function diaSemana(val) {

        var idDia;
        var medico = $("#medico").val();
        if (val ==1) {
            var x = document.getElementById("fecha");
        }else{
            var x = document.getElementById("fechamodal");
        }
        let date = new Date(x.value.replace(/-+/g, '/'));
        let options = {
            weekday: 'long'
        };
        var dia = date.toLocaleDateString('es-MX', options);

        if (dia == "lunes") {
            idDia = 1;
        }else if (dia == "martes") {
            idDia = 2;
        }else if (dia == "miércoles") {
            idDia = 3;
        }else if (dia == "jueves") {
            idDia = 4;
        }else if (dia == "viernes") {
            idDia = 5;
        }else if (dia == "sábado") {
            idDia = 6;
        }else if (dia == "domingo") {
            idDia = 7;
        }
        //alert(idDia)
        if (medico!=null) {
            $.ajax({
                url:"http://localhost/CDI/Panel/index.php/Crudcitas/compruebaDiasLaborales/"+idDia+"/"+medico,
                dataType:"json",
                success:function(data) {
                    if (data != "") {
                        // alert("si hay registros");
                        $("#divdispo").show();
                        $("#visualDisponibilidad").show();
                        $("#idDiainput").val(idDia);
                        $("#datosPacien").show();
                        $("#horasSeleccionadas").show();
                    }else{
                        // alert("no hay registros");
                        swal("Lo sentimos...","El médico que seleccionaste no labora los días "+dia+" ","warning");
                        $("#divdispo").hide();
                        $("#visualDisponibilidad").hide();
                        $("#autorizaBoton").hide();
                        limpiainputshora();
                        $("#horasSeleccionadas").hide();
                        $("#idDiainput").val("");
                        $("#datosPacien").hide();
                        $("#horasSeleccionadas").hide();
                    }
                }
            });
        }
    }

    function alertadisponibilidad() {
        swal("Espera...", "Para cambiar estos valores debes volver a dar clic sobre el botón de 'Ver disponibilidad' ", "warning");
    }

    function limpiainputshora() {
        $("#horainicio").val("");
        $("#horatermino").val("");
    }
    function limpiahorainicio() {
        $("#horacita").val("");
        $("#horainicio").val("");
        $("#horatermino").val("");
        $("#divhorainicio").hide();
        $("#divhoratermino").hide();
        $("#emergencia").val("0");
        $("#estadourgencia").attr("checked",false);
        $("#idCitarecorrida").val("");
        $("#listaArticulo").html("");
        $("#idCitarecorrida").val("");
    }

    function tre(){

        $('#paciente').autocomplete({

            source: function(request,response){
                $.ajax({

                    url:"http://localhost/CDI/Panel/index.php/Crudcitas/buscarNombre/",
                    dataType:"json",
                    data:{q:request.term},
                    success:function(data) {
                        response(data);
                        //$("#botonaltapaciente").hide();
                        //alert("res")
                    },
                    error:function(data){
                        // alert("Sin Resultados");
                        swal("Oops...","Al parecer el paciente que buscas no esta registrado, por favor da clic al boton de 'Registrar paciente', llena el formulario y luego vuelve a intentarlo ","warning");
                        //$("#botonaltapaciente").show();
                    }
                });
            },

            minLength:1,

            select:function(event,ui) {
                //alert("nombre "+ ui.item.value+"id "+ui.item.correoPersonal)
                var gen = ui.item.generoPaci;
                if (gen==1)
                {
                    gen = "Masculino";
                }
                if (gen==2)
                {
                    gen ="Femenino";
                }
                $("#idPaciente").val(ui.item.idPaciente);
                getClie();
                var idOcu=$("#idPaciente").val();
                if (idOcu!="")
                {
                    $("#editModal").show();
                }else{
                    $("#editModal").hide();
                }

                //$("#sexo").val(gen);
                //$("#correo").val(ui.item.correoPaci);
                //$("#feNa").val(ui.item.fechanaciPaci);
                //$("#edadP").val(ui.item.edadPaci+" Años");
                //$("#telefono").val(ui.item.telefonoPaci);
            }
        });
    }
    $(document).ready(function() {

        $('#nombreEstudio').autocomplete({
            source: function(request,response){
                $.ajax({

                    url:"http://localhost/CDI/Panel/index.php/Crudcitas/buscarNombreEstudio/",
                    dataType:"json",
                    data:{q:request.term},
                    success:function(data) {
                        response(data);
                    }
                });
            },
            minLength:1,
            select:function(event,ui) {
                $("#Estud").val(ui.item.IdEstudio);

                $("#indicacionPaciente").val(ui.item.indicacionesPaciente)
                if ($("#Estud").val()=="")
                {

                }else{
                    $("#visualIndica").show();
                    $("#visualObservaciones").show();
                }

                if ($("#Estud").val()=="")
                {

                }else{
                    $("#visualObservaciones").show();
                }
                $("#idCat").val(ui.item.idCat);
                if (ui.item.idCat==10)
                 {
                    //traedisponibilidad();
                    $("#modal-body").html("");
                    $("#medico").val(9);
                    $("#divmedico").hide();
                    $("#observacionesCit").hide();
                    resulFech(ui.item.diasResultado);
                    traeduracion(ui.item.IdEstudio);
                    $("#valorDuracionEstudio").val(ui.item.duracion);
                    $("#duracionEstudio").html("");
                    $("#duracionEstudio").append('<span>Duración: <b> '+ui.item.duracion+'</b> hr(s)</span>');
                    traerDiPaciente();
                    diaSemana(1);
                    

                    
                 }else{
                    traedisponibilidad();
                    resulFech(ui.item.diasResultado);
                    traeduracion(ui.item.IdEstudio);
                    $("#valorDuracionEstudio").val(ui.item.duracion);
                    $("#duracionEstudio").html("");
                    $("#duracionEstudio").append('<span>Duración: <b> '+ui.item.duracion+'</b> hr(s)</span>');
                    traerDiPaciente();
                    diaSemana(1);
                 }
                
            }
        });

    });
    function addDays(startDate, numberOfDays) {
        return new Date(startDate.getTime() + (numberOfDays * 24 *60* 60 * 1000)).toISOString().slice(0,10);
    }

    function resulFech(dias)
    {
        //var TuFecha = new Date($('#fecha').val());
        var resultado=addDays(new Date($('#fecha').val()), dias);

        $("#fechaEntre").val(resultado);
        $("#tipoEntrega").val(1);
        $("#colorRes").css("background","#4CAF50");
        $("#Priorid").val(1);

        var fchiCi=$('#fecha').val();
        var resultado=$("#fechaEntre").val();
        if (fchiCi==resultado)
        {
            $("#colorRes").css("background","#ffeb3b");
            $("#tipoEntrega").val(2);
            $("#Priorid").val(2);
        }

    }

    function validarColor(){
        // var fchiCi=$('#fecha').val();
        // var resultado=$("#fechaEntre").val();
        // if (fchiCi==resultado)
        //  {
        //     $("#colorRes").css("background","#ffeb3b");
        //     $("#Priorid").val(2);
        //  }
        var tipoEntrega=$('#tipoEntrega').val();
        if (tipoEntrega==1)
        {
            $("#colorRes").css("background","#4caf50");
            $("#Priorid").val(1);
        }
        if (tipoEntrega==2)
        {
            $("#colorRes").css("background","#ffeb3b");
            $("#Priorid").val(2);
        }
        if (tipoEntrega==3)
        {
            $("#colorRes").css("background","#fd0b13");
            $("#Priorid").val(3);
        }


    }
    function traeMedico() {
        $("#medico").html("");
        var sala = $("#Salas").val();

        $("#divmedico").show();


        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeDatosMedico/"+sala,
            dataType:"json",
            success:function(data) {
                $("#medico").append(new Option("Selecciona un Médico", ""));
                if (data.length > 0) {
                    for (var i = 0; i <= data.length; i++) {
                        $("#medico").append(new Option(data[i]['nombreDoc'], data[i]['idDoctor']));
                         if ($("#idCat").val()==10)
                        {
                            $("#medico").val(9);
                            $("#divmedico").hide();
                        }
                    }

                   
                }
            }
        });
    }

    function traecitaPropuesta() {
        var hora = $("#PropuestahoraCita").val();
        var min = $("#PropuestaminCita").val();
        var asignada = $("#horainicio").val();
        if (asignada != "") {
            asignahoracita(hora,min);
        }
    }

    function traedisponibilidad() {

        $("#duracionEstudio").html("");
        $("#modal-alert").html("");
        $("#modal-alert-div").css("background","#fff");
        var idsala = $("#Salas").val();
        var Estudio = $("#Estud").val();
        if ($("#fechamodal").val() != "") {
            var fecha = $("#fechamodal").val();
            $('#myModal').modal('show');
            //$("#visualDisponibilidad").show();

            //var duracion = traeduracion(Estudio); // definimos una variable que va a valer lo que traiga la funcion "traeduracion"
            var duracion=$("#valorDuracionEstudio").val();
            //alert(duracion)
            if ($("#idCat").val()==10)
             {

             }else{
                noDisponibles(Estudio,idsala,fecha,duracion);
             }
            
            $("#duracionEstudio").append('<span>Duración: <b> '+duracion+'</b> hr(s)</span>');
            $("#inputduracion").val(duracion);
        }else{
            var fecha = $("#fecha").val();
            $("#fechamodal").val(fecha);
            $('#myModal').modal('show');
            // $("#visualDisponibilidad").show();
            //var duracion = traeduracion(Estudio); // definimos una variable que va a valer lo que traiga la funcion "traeduracion"
            var duracion=$("#valorDuracionEstudio").val();
            if ($("#idCat").val()==10)
             {

             }else{
                noDisponibles(Estudio,idsala,fecha,duracion);
             }
            
            $("#duracionEstudio").append('<span>Duración: <b> '+duracion+'</b> hr(s)</span>');
            $("#inputduracion").val(duracion);
        }

    }
    function traerDi()
    {
        var medico = $("#medico").val();
        var fecha = $("#fecha").val();
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/verificarOcupado/"+medico+"/"+fecha,
            dataType:"json",
            // async: false, // esta funcion debe cpmpletarse antes de continuar con la lectura del código
            success:function(data) {
                
                //alert(data.length)
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        var nume=data[i]['horarioCita'];

                        var res = nume.substr(0, 2);
                        var minudiv = nume.substr(3, 2);

                        var aTermi=data[i]['horaTerminada'];
                        var HourT = aTermi.substr(0, 2);
                        var minT = aTermi.substr(3, 2);

                        //var min=data[i]['horarioCita'];
                        //var minn = str.substr(3,2);
                        if (res=="08")
                        {
                            res=8;
                        }
                        if (res=="09")
                        {
                            res=9;
                        }
                        var ni=parseInt(res+minudiv);
                        var f=parseInt(HourT+minT);
                        // alert("ni "+ni+" f "+f)
                        for (var ir = ni; ir <= f ; ir++) {
                            // alert("td.desbloc" + ir)
                            $( "td.desbloc"+ir).addClass( "disabled" );
                        }

                    }

                    $(".disabled").removeAttr("onclick");
                }

                //desbloque(medico,fecha)

            }
        });
    }

    function traerDiPaciente()
    {
        var idPaciente = $("#idPaciente").val();
        var fecha = $("#fecha").val();
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/verificarOcupadoP/"+idPaciente+"/"+fecha,
            dataType:"json",
            success:function(data) {
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        var nume=data[i]['horarioCita'];
                        var res = nume.substr(0, 2);
                        var minudiv = nume.substr(3, 2);
                        var aTermi=data[i]['horaTerminada'];
                        var HourT = aTermi.substr(0, 2);
                        var minT = aTermi.substr(3, 2);
                        if (res=="08")
                        {
                            res=8;
                        }
                        if (res=="09")
                        {
                            res=9;
                        }
                        var ni=parseInt(res+minudiv);
                        var f=parseInt(HourT+minT);
                       // alert("ni "+ni+" f "+f)
                        for (ir = ni; ir <= f; ir++) {
                           //alert("ir") 
                            $( "td.desbloc"+ir).addClass( "disabled" );
                        }
                    }
                    $(".disabled").removeAttr("onclick");
                }
            }
        });
    }

    function desbloque(medico,fecha)
    {
        var medico=medico;
        var fecha=fecha;
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/verificarDispo/"+medico+"/"+fecha,
            dataType:"json",
            // async: false, // esta funcion debe cpmpletarse antes de continuar con la lectura del código
            success:function(data) {
                // return data;

                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        var nume=data[i]['horarioCita'];
                        var res = nume.substr(0, 2);
                        var minudiv = nume.substr(3, 2);
                        if (res=="08")
                        {
                            res=8;
                        }
                        if (res=="09")
                        {
                            res=9;
                        }
                        //$("#botonhora"+res).prop('disabled', false);

                        $( "td.desbloc"+res+minudiv ).addClass( "" );
                        // alert("res "+res)
                    }
                }

            }
        });
    }

    function traeduracion(idE) {
        var idE = idE;
        var uno = false; //definimos una variable en blanco
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeduracion/"+idE,
            dataType:"json",
            async: false, // esta funcion debe cpmpletarse antes de continuar con la lectura del código
            success:function(data) {
                // return data;
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {

                        uno = data[i]['duracion']; //le asignamos el valor que trae la funcion ajax
                        $("#valorDuracionEstudio").val(data[i]['duracion']);
                    }
                }
            }
        });
        return uno; //retornamos a la funcion inicial "traedisponibilidad"
    }

    function noDisponibles(est,sala,fecha,duracion) {

        $("#modal-body").html("");
        pintatodashoras();
        var idEst = est;
        var idSala = sala;
        var fecha = fecha;
        // var fecha = fecha.replace(/-/g, "");
        // alert(fecha)
        //var fecha=""+fecha+"";
        var dayC = fecha.substr(-2);
        var yearC = fecha.substr(0,4);
        var MesC = fecha.substr(4,2);
        //var fecha=""+yearC+"-"+MesC+"-"+dayC+"";
        //alert("fecha "+fecha)
        var duracion = duracion;
        var urgencia = $("#emergencia").val();

        if (urgencia != 1) {
            //alert("entra"+fecha)
            $.ajax({
                url:"http://localhost/CDI/Panel/index.php/Crudcitas/traenoDispo/"+idSala+"/"+fecha,
                dataType:"json",
                success:function(data) {
                    //alert("entraH")
                    if(data.length > 0)
                    {
                        for(i=0; i<data.length; i++)
                        {
                            //alert("vivel")
                            calcT3s(data[i]['horarioCita'],data[i]['horaTerminada'],data[i]['idCita'])
                        }
                    }

                    deshabilitaBtns();

                }
            });
        }
    }

    function padNmbs(nStr, nLen){
        var sRes = String(nStr);
        var sCeros = "0000000000";
        return sCeros.substr(0, nLen - sRes.length) + sRes;
    }

    function stringToSecondss(tiempo){
        var sep1 = tiempo.indexOf(":");
        var sep2 = tiempo.lastIndexOf(":");
        var hor = tiempo.substr(0, sep1);
        var min = tiempo.substr(sep1 + 1, sep2 - sep1 - 1);
        var sec = tiempo.substr(sep2 + 1);
        return (Number(sec) + (Number(min) * 60) + (Number(hor) * 3600));
    }

    function secondsToTimes(secs){
        var hor = Math.floor(secs / 3600);
        var min = Math.floor((secs - (hor * 3600)) / 60);
        var sec = secs - (hor * 3600) - (min * 60);
        return padNmbs(hor, 2) + ":" + padNmbs(min, 2) + ":" + padNmbs(sec, 2);
    }

    function substractTimess(t1,   t2){
        var secs1 = stringToSeconds(t1);
        var secs2 = stringToSeconds(t2);
        var secsDif = secs1 - secs2;
        return secondsToTimes(secsDif);
    }

    function calcT3s(x,y,idC){
        var x=x;
        var y=y;
        var t3 = substractTimess(y, x);
//alert("x "+x+" t3 "+t3)
        identificainactivos(x,t3,idC)
    }

    function deshabilitaBtns() {

        var x = document.getElementById("fecha");

        let date = new Date(x.value.replace(/-+/g, '/'));
        let options = {
            weekday: 'long'
        };
        var dia = date.toLocaleDateString('es-MX', options);
        var idDia;
        if (dia == "lunes") {
            idDia = 1;
        }else if (dia == "martes") {
            idDia = 2;
        }else if (dia == "miércoles") {
            idDia = 3;
        }else if (dia == "jueves") {
            idDia = 4;
        }else if (dia == "viernes") {
            idDia = 5;
        }else if (dia == "sábado") {
            idDia = 6;
        }else if (dia == "domingo") {
            idDia = 7;
        }
        var diaBuscado = idDia;
        var medicoSolicitado = $("#medico").val();
        //alert("diaBuscado "+diaBuscado+" medicoSolicitado "+medicoSolicitado);
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/compruebaDiasLaborales/"+diaBuscado+"/"+medicoSolicitado,
            dataType:"json",
            success:function(data) {
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        // alert(i)
                        DesactivaBtn(data[i]['horaEntrada'],data[i]['horaSalida']);

                    }
                }
            }
        });
    }


    function DesactivaBtn(entrada,salida) {

        var ent = entrada.substr(0,2);
        var minEn=entrada.substr(3,2);
        var sal = salida.substr(0,2);
        var minSal=salida.substr(3,2);

        if (ent == "08") {
            ent = 8;
        }
        if (ent == "09") {
            ent = 9;
        }
        var tope=ent+minEn;

        // for (var i = 8; i <= 19; i++) {

        //   if (i >= ent) {


        //     $( "td.desbloc"+i+minEn ).addClass( "" );
        //   }//else{


        //  // }

        // }
       // alert("bloqueo")
        traerDiPaciente()
        for (var xx = 800; xx <tope ; xx+=10) {
            //alert(tope)
            $( "td.desbloc"+xx ).addClass( "disabled" );
            $(".disabled").removeAttr("onclick");
        }
        compurbeSalida(sal,minSal);
    }

    function compurbeSalida(sal,minSal) {
        var topeS=sal+minSal;
        // for (var i = sal; i <= 19; i++) {
        //   if (i > sal) {
        //    // alert("td.desbloc"+xxw+" topes "+topeS)
        //      for (var xxw = topeS; xxw < 2000 ; xxw++) {
        //       //alert("bloquear "+xxw)
        //        $( "td.desbloc"+xxw ).addClass( "disabled" );
        //    }

        //   }else{
        //      for (var xxw = topeS; xxw < 2000 ; xxw++) {
        //       //alert("bloquear "+xxw)
        //        $( "td.desbloc"+xxw ).addClass( "disabled" );
        //    }

        //   }
        // }

        for (var xxw = topeS; xxw < 2000 ; xxw++) {
           // alert("td.desbloc"+xxw)
            $( "td.desbloc"+xxw ).addClass( "disabled" );
        }

        traerDi()
    }


    function pintatodashoras() {
        $("#modal-body").html("");
        momentoActual = new Date();
        momentoActual.setHours(0,0);
        hora = momentoActual.getHours();
        minuto = momentoActual.getMinutes();
        horaImprimible = hora + " : " + minuto;
        for (var i = 8; i <= 19; i++) {
            horasuma = parseInt(hora) + parseInt(i);
            $("#modal-body").append('<tr id="minutos'+i+'" ><th class="disponible" id="botonhora'+horasuma+'">'+horasuma+':00</th></tr>');
            despliegaminutos(horasuma,minuto,i);
        }
    }

    function despliegaminutos(hora,min,i) {

        var hora  = hora;
        var minuto  = min;
        var botoni  = i;
        //$("#minutos"+botoni).html("");
        for (var i = 0; i <= 5; i++) {
            var minutosuma = parseInt(minuto) + parseInt(i) * 10;
            if (minutosuma == "0") {
                minutosuma = "00";
            }
            //alert("#minutos"+botoni+"  "+hora+":"+minutosuma)
            $("#minutos"+botoni).append('<td id="botonminuto'+minutosuma+'-'+hora+'" onclick="asignahoracita('+hora+','+minutosuma+')" class="tdDisponible desbloc'+hora+minutosuma+'">'+'<div id="div'+minutosuma+'-'+hora+'">'+hora+':'+minutosuma+'</div></td>');

        }
    }

    function asignahoracita(hora,min) {

        $("#modal-alert").html("");

        var emergencia = $("#emergencia").val();
        if (emergencia == 1) {
            //traedisponibilidad();aqui desmadre
            //alert("vamos a comprobar el choque de horas");
            validadisponibilidad(hora,min);
        }else{
            //traedisponibilidad();aqui desmadre
            validadisponibilidad(hora,min);
        }


    }

    function validadisponibilidad(hora,min) {
        
        var horazzz = hora;
        var min = min;
        //alert("entra "+min)
        var emergencia = $("#emergencia").val();
        // alert(min);
        var coinciden = 0;
        for (var j =  0; j <= 1; j++) {
            var horamasuno = parseInt(horazzz)+j;
            if (horamasuno == 8) {
                horamasuno = "08";
            }
            if (horamasuno == 9) {
                horamasuno = "09";
            }
            // alert("vamos a validar que las horas no choquen");
            var fechabase = $("#fechamodal").val();
            var estudiosolic = $("#Estud").val();
            var salasolic = $("#Salas").val();
            $.ajax({
                url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeProximonoDispo/"+estudiosolic+"/"+salasolic+"/"+fechabase+"/"+horamasuno,
                dataType:"json",
                success:function(data) {
                    if(data.length > 0)
                    {
                        for(i=0; i<data.length; i++)
                        {
                            var duracion = $("#valorDuracionEstudio").val();
                            var separa = duracion.replace(":", ",");
                            var arrayduracion = separa.split(",").map(Number);
                            tiempoduracion = new Date();
                            tiempoduracion.setHours(arrayduracion[0],arrayduracion[1]);
                            horadur = tiempoduracion.getHours();
                            minutodur = tiempoduracion.getMinutes();
                            var minutostotalduracion = (parseInt(horadur)*60) + parseInt(minutodur);
                            var minutostotalduracion1 = parseInt(minutostotalduracion)-1;

                            for (var x = 0; x <= minutostotalduracion1; x++) {
                                var horaselec = new Date();
                                // alert("horazzz "+horazzz+" min "+min)
                                horaselec.setHours(horazzz,min,0);
                                // alert("horazzz2 "+horazzz+" min2 "+min)
                                horaselec.setMinutes(horaselec.getMinutes() + x);
                                var horaciclo = horaselec.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit', second:'2-digit'});
                                // alert("recorrido: "+horaciclo+" - cita: "+data[i]['horarioCita']+" -Termina: "+data[i]['horaTerminada']);
                                if (horaciclo == data[i]['horarioCita'] || horaciclo == data[i]['horaTerminada']) {
                                    if (emergencia == 1) {

                                        break;
                                    }
                                }
                                if (horaciclo == data[i]['horarioCita']) {
                                    // alert("no puedes agendar en este horario");
                                    swal("No puedes agendar en este horario", "La cita se empalma con otra ya agendada. \n Por favor selecciona otro horario", "warning");
                                    $("#horacita").val("horainicio");
                                    traedisponibilidad();
                                    coinciden = 1;
                                    break;
                                }
                            }
                            // alert(coinciden);

                            if (coinciden == 0) {
                                $("#modal-alert").html("");
                                // var hora = hora;
                                // var minuto = min;
                                var Estudio = $("#Estud").val();
                                // var duracion = traeduracion(Estudio);
                                var duracion=$("#valorDuracionEstudio").val();
                                var construyehora = new Date();
                                construyehora.setHours(horazzz,min,0);
                                // var horainicio = construyehora.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
                                var horainicio=construyehora.toLocaleTimeString();
                                var horainicio = horainicio.substr(0, 5);
                                var res = horainicio.replace(" ", "");
                                var totalito=res.length;
                                if (totalito==4)
                                {
                                    var horainicio = "0"+res;
                                }
                                if (totalito==5)
                                {
                                    var horainicio = res;
                                }
                                $("#modal-alert").append('<span style="background: #e3f1e0; text-align: center;">La cita quedaría agendada a las <b>'+horainicio+'</b> hr(s) y terminaría a las <b id="horatotal"> </b> hr(s)</span><br>');
                                $("#modal-alert-div").css("background","#e3f1e0");
                                if (min == "0") {
                                    min = "00";
                                }
                                $("#botonhora"+horazzz).css("background", "#68df87");
                                $("#botonminuto"+min+"-"+horazzz+"").css("background", "#68df87");
                                $("#div"+min+"-"+horazzz+"").css("background", "#68df87");
                                $("#div"+min+"-"+horazzz+"").css("color", "#000");
                                // alert("entra "+data[i]['idCita']);
                                pintahorasCita(horazzz,min);
                                //  alert("1 : "+horainicio)
                                $("#horacita").val(horainicio);
                                calcT3();
                                break;
                            }
                            if (coinciden == 1) {
                                break;
                            }
                        } //aqui cierra for
                    }else{
                        if (coinciden == 1) {
                            // alert("ya hay coincidencia");
                        }else{
                            traedisponibilidad();
                            $("#modal-alert").html("");
                            var Estudio = $("#Estud").val();
                            //var duracion = traeduracion(Estudio);
                            var duracion=$("#valorDuracionEstudio").val();
                            var construyehora = new Date();
                            construyehora.setHours(horazzz,min,0);
                            // var horainicio = construyehora.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

                            var horainicio=construyehora.toLocaleTimeString();

                            //alert("entrada "+ horainicio.length)
                            if (horainicio.length==7) { var horainicio = horainicio.substr(0, 4);}
                            if (horainicio.length==8) { var horainicio = horainicio.substr(0, 5);}

                            //alert(horainicio)
                            var res = horainicio.replace(" ", "");
                            var totalito=res.length;
                            if (totalito==4)
                            {
                                var horainicio = "0"+res;
                            }
                            if (totalito==5)
                            {
                                var horainicio = res;
                            }
                            //alert(horainicio)
                            $("#modal-alert").append('<span style="background: #e3f1e0; text-align: center;">La cita quedaría agendada a las <b>'+horainicio+'</b> hr(s) y terminaría a las <b id="horatotal"> </b> hr(s)</span><br>');
                            $("#modal-alert-div").css("background","#e3f1e0");
                            if (min == "0") {
                                min = "00";
                            }
                            $("#botonhora"+horazzz).css("background", "#68df87");
                            $("#botonminuto"+min+"-"+horazzz+"").css("background", "#68df87");
                            $("#div"+min+"-"+horazzz+"").css("background", "#68df87");
                            $("#div"+min+"-"+horazzz+"").css("color", "#000");
                            // alert("si puedes agendar en este horarioooo");
                            pintahorasCita(horazzz,min);
                            //alert("aqui llega: "+horainicio)
                            $("#horacita").val(horainicio);
                            calcT3();
                        }

                    }
                }
            });
        }
    }





    function validachoque(horaurgencia, minutourgencia) {
        var horaDosdigitos = horaurgencia;
        var minDosdigitos = minutourgencia;
        var fechaurgencia = $("#fechamodal").val();
        var estudiourgencia = $("#Estud").val();
        var salaurgencia = $("#Salas").val();
        if (horaDosdigitos == "8") {
            horaDosdigitos = "08";
        }
        if (horaDosdigitos == "9") {
            horaDosdigitos = "09";
        }
        if (minDosdigitos == "0") {
            minDosdigitos = "00";
        }
        var horapropuesta = horaDosdigitos+":"+minDosdigitos+":00";
        //alert("entra la hora: "+horapropuesta);
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeProximonoDispoParaUrgencia/"+estudiourgencia+"/"+salaurgencia+"/"+fechaurgencia+"/"+horapropuesta,
            dataType:"json",
            success:function(data) {
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {

                        // identificainactivos(data[i]['horarioCita'],duracion);
                    }
                }
            }
        });
    }




    function pintahorasCita(hora,min){
        // alert(min);
        $("#PropuestahoraCita").val(hora);
        $("#PropuestaminCita").val(min);
        var duracion = $("#valorDuracionEstudio").val();
        var separa = duracion.replace(":", ",");
        var arrayduracion = separa.split(",").map(Number);
        tiempoduracion = new Date();
        tiempoduracion.setHours(arrayduracion[0],arrayduracion[1]);
        horadur = tiempoduracion.getHours();
        minutodur = tiempoduracion.getMinutes();
        var minutostotalduracion = (parseInt(horadur)*60) + parseInt(minutodur);
        // alert(minutostotalduracion);
        var nuevominutosduraciontotal = parseInt(min)+parseInt(minutostotalduracion);
        // alert("el for llegara hasta "+nuevominutosduraciontotal);
        for (var i = min; i <= nuevominutosduraciontotal; i++) {
            // alert(i);
            $("#botonminuto"+i+"-"+hora).css("background","#68df87");

            $("#div"+i+"-"+hora).css("background","#68df87");
            $("#div"+i+"-"+hora).css("color","#000");
            if (i > 60) {
                break;
            }
        }
        var minutoscomplemento = parseInt(min)+parseInt(minutostotalduracion);
        // alert("minutos complemento:"+minutoscomplemento);
        if (minutoscomplemento >= 60)
        {

            var ejecutarfuncion = parseInt(minutoscomplemento)/60;
            var ejecfuncion = parseInt(ejecutarfuncion);
            // alert("la funcion de complemento se ejecutara "+ejecfuncion+" veces");

            for (var i = 1; i <= ejecfuncion; i++) {
                // alert("la funcion entra por "+i+"° vez");
                var parametro = 60*i;
                var mincomplemento = parseInt(minutoscomplemento)-parseInt(parametro);
                // alert("El parametro cambiante del ciclo vale:"+mincomplemento);
                var color = "#68df87";
                complemento(mincomplemento,hora,i,color);
            }

        }
    }

    function identificainactivos(hora,duracions,idC){
        //alert("hora "+hora+" duracions "+duracions)
        var hora = hora;
        var duracions = duracions;
        var duracion = duracions.substr(1, 4);

        var res = hora.replace(/:/g, ",");
        var array = res.split(",").map(Number);
        horadiv = new Date();
        horadiv.setHours(array[0],array[1],array[2]);
        horadi = horadiv.getHours();
        minutodiv = horadiv.getMinutes();
        //alert("la cita agendada empieza en el minuto:"+minutodiv);
        // $("#botonhora"+horadi).css("background-color","#ffca00");


        var separa = duracion.replace(":", ",");
        var arrayduracion = separa.split(",").map(Number);
        tiempoduracion = new Date();
        tiempoduracion.setHours(arrayduracion[0],arrayduracion[1]);
        horadur = tiempoduracion.getHours();
        minutodur = tiempoduracion.getMinutes();
        var minutostotalduracion = (parseInt(horadur)*60) + parseInt(minutodur);
        var rec=parseInt(minutodiv)+parseInt(minutostotalduracion);
        //alert(minutodiv+" - "+rec)
        for (var i = minutodiv; i <= rec; i++)
        {
            //var resta= minutostotalduracion - minutodiv;
            if (i == 0) {
                i = "00";
            }
            //alert("#ffca00")
            //alert(" i "+i+" horadi "+horadi+" miDura "+minutostotalduracion)
            $("#botonminuto"+i+"-"+horadi).css("background-color","#ffca00");
            $("#botonminuto"+i+"-"+horadi).css("color","#fff");
            $("#div"+i+"-"+horadi).css("background-color","#ffca00");
            $("#div"+i+"-"+horadi).css("color","#000");
            $("#botonminuto"+i+"-"+horadi).prop("onclick", null);
            //data-tooltip="Nombre del paciente" data-tooltip-animate-function="spin"
            $("#botonminuto"+i+"-"+horadi).attr("title","cita: "+idC);
            //$("#botonminuto"+i+"-"+horadi).attr("data-toggle","modal");
            //$("#botonminuto"+i+"-"+horadi).attr("data-target","#detalleCosultataocupaa");

            $("#botonminuto"+i+"-"+horadi).attr("onClick","traerDatosmodalCita("+idC+","+i+","+rec+","+horadi+")");//modificar este punto
            //alert("#traerDatosmodalCita")
            //alert("inicio  "+i+" duracion"+rec)
        }
        //alert("horadi "+horadi)
        compruebacolor(horadi);
        // setTimeout(function () { compruebacolor(horadi) },2000);

        var minutoscomplemento = parseInt(minutodiv)+parseInt(minutostotalduracion);
        var partida = parseInt(minutoscomplemento)-parseInt(minutostotalduracion);
        // alert("El minuto del que parte la cita es el: "+partida);
        if (minutoscomplemento > 60)
        {

            var ejecutarfuncion = parseInt(minutoscomplemento)/60;
            var ejecfuncion = parseInt(ejecutarfuncion);
            // alert("la funcion de complemento se ejecutara "+ejecfuncion+" veces");

            for (var i = 1; i <= ejecfuncion; i++) {
                //alert("la funcion entra por "+i+"° vez");
                var parametro = 60*i;
                var mincomplemento = parseInt(minutoscomplemento)-parseInt(parametro);
                //alert("El parametro cambiante del ciclo vale:"+mincomplemento);
                var color = "#ffca00";
                complemento(mincomplemento,horadi,i,color,idC);
            }

        }

    }

    function complemento(minutoscomplemento,hora,x,color,idC)
    {
        var minutosRest = minutoscomplemento;
        //alert("restan "+minutosRest);
        var horasx = x;
        var horasuma = parseInt(hora)+parseInt(horasx);
        if (color != "#68df87") {
            setTimeout(function () { compruebacolor(horasuma) },0);
        }

        if (horasuma == 24) {
            horasuma = "0";
        }
        $("#botonhora"+horasuma).css("background-color",color);
        //alert(x+" - "+minutosRest)
        for (var i = 0; i <= minutosRest; i++) {
            // alert(i)
            if (i == 0) {
                i = "00";
            }
            $("#botonminuto"+i+"-"+horasuma).css("background-color",color);
            $("#botonminuto"+i+"-"+horasuma).css("color","#fff");
            //$( "td.desbloc"+horasuma ).addClass( "disabled" );
            $("#div"+i+"-"+horasuma).css("background-color",color);
            $("#div"+i+"-"+horasuma).css("color","#000");
            if (color == "#ffca00") {

                $("#botonminuto"+i+"-"+horasuma).prop("onclick", null);

                $("#botonminuto"+i+"-"+horasuma).attr("title","cita: "+idC);
                //$("#botonminuto"+i+"-"+horasuma).attr("data-toggle","modal");
                //$("#botonminuto"+i+"-"+horasuma).attr("data-target","#detalleCosultataocupaa");
                $("#botonminuto"+i+"-"+horasuma).attr("onClick","traerDatosmodalCita("+idC+","+i+","+minutosRest+","+horasuma+")");
                //alert("#botonminuto"+i+"-"+horasuma)
            }
        }
    }

    function compruebacolor(hora) {
        //alert("entra comprobacion de color con hora: "+hora);
        var elemento = $("div#minutos"+hora+" > a").css("background-color");
        //alert(elemento);
        if (elemento == "rgb(255, 202, 0)") {

            $("#botonhora"+hora).css("background-color","#ffca00");
            $("#botonminuto"+i+"-"+horadi).css("color","#fff");

        }else{
            $("#botonhora"+hora).css("background-color","#4f5d6a");
        }
    }

    function limpiamodal() {
        $("#fechamodal").val("");
    }


    function AsignahorasEstablecidas() {
        var inicio = $("#horacita").val();

        var fin =$("#HoraTerminada").val()
        var fechamodal = $("#fechamodal").val();
        var idPaciente=$("#idPaciente").val();
        // alert(inicio+" - "+fin);
        if (inicio != "" ) {
            //alert("dentro "+inicio);
            $('#myModal').modal('hide');
            $("#horainicio").val(inicio);
            $("#horatermino").val(fin);
            $("#divhorainicio").show();
            $("#divhoratermino").show();
            $("#autorizaBoton").show();
            $("#fecha").val(fechamodal);
        }
        else{
            alert('debes selecionar una hora');
        }

    }

    function cambiaCheck() {
        //alert("entra alert");
        if ($("#estadourgencia").is(':checked')) {
            //alert("entra Si");
            $("#emergencia").val("1");
            traedisponibilidad();
            $("#modal-alert").html("");
            $("#modal-alert-div").css("background","#fff");
            $("#horacita").val("");
            $("#horainicio").val("");
            $("#horatermino").val("");
            $("#divhorainicio").hide();
            $("#divhoratermino").hide();
        }else{
            //alert("entra No");
            $("#emergencia").val("0");
            $("#horacita").val("");
            $("#horainicio").val("");
            $("#horatermino").val("");
            $("#divhorainicio").hide();
            $("#divhoratermino").hide();
            $("#listaArticulo").html("");
            $("#idCitarecorrida").val("");
            traedisponibilidad();
        }
    }



    /////////////////////////////////////// NEW FUNCTION BUSCADOR ///////////////////////////////////////
    function buscarxPeticion() {
        $("#listadocitasProx").html("");
        var fActa=$("#fechaAct").val();
        var res = $("#busqueda").val();
        var rightNow = new Date();
        var fecha = rightNow.toISOString().slice(0,10).replace(/-/g,"-");
        if (res != "") {
            $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudcitas/traerListaTodoCitasxPeticion/"+res+"/"+fecha,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    if (data.length>0)
                    {
                        for(i=0; i<data.length; i++)
                        {
                            if (data[i]['urgencia'] == 1) {
                                urgencia = "SI";
                            }else{
                                urgencia = "NO";
                            }

                            var Horal=data[i]['horallegada'];
                            if (Horal!="00:00:00")
                            {
                                Horal=Horal;
                                var classs="disabled";
                            }else{

                                Horal="Hora de llegada";
                                var classs="";
                            }
                            var srt=data[i]['fechaCita'];
                            var cancel=data[i]['cancelar'];
                            if (cancel==1)
                            {
                                var clas="disabled";
                                var fuent="background-color: #f00;color: #fff;";
                                Horal="CANCELADO";
                            }else{
                                var clas="";
                                var fuent="";

                            }

                            var statusProceso=data[i]['statusProceso'];
                            if (statusProceso==1)
                            {
                                var check="checked";
                                var valorSta=0;
                                var disabled="";
                            }else  if (statusProceso==0){
                                var check="";
                                var valorSta=1;
                                var disabled="";
                            }else{
                                var check="checked";
                                var valorSta=statusProceso;
                                var disabled="disabled";
                            }
                            // alert("entra")
                            var res = srt.replace(/-/g, "");

                        var salidasala = data[i]['horarioCita']
                        $("#listadocitasProx").append('<tr class="'+clas+'">'+
                                                    '<td style="display:none;">'+data[i]['idCita']+'</td>'+
                                                    '<td>'+data[i]['nombreUser']+'  <input type="hidden" name="fechOculto'+data[i]['idPaciente']+'" id="fechOculto'+data[i]['idPaciente']+'" value="'+data[i]['fechaCita']+'"></td>'+
                                                    '<td >'+data[i]['folioCita']+'</td>'+
                                                    '<td onclick="abrirPotHora('+data[i]['idCita']+');pruebaModific('+i+')" >'+data[i]['horarioCita']+'</td>'+
                                                    '<td  style="text-align: center;"><input  type="checkbox" onClick="cambiarStatusProceso('+valorSta+', '+data[i]['idCita']+')"  id="llego'+data[i]['idCita']+'" name ="llego'+data[i]['idCita']+'" class="filled-in" value="'+valorSta+'" '+check+' '+disabled+'><label style="margin-bottom: 0px;height: 15px;" for="llego'+data[i]['idCita']+'"></label></td>'+
                                                    '<td ><a style="cursor: pointer;" onclick="GetTdodoEstudio('+data[i]['idPaciente']+','+data[i]['folioCita']+','+idUser+')">Imprimir</a></td>'+
                                                    '<td style="'+fuent+'" id="horaLL'+data[i]['idCita']+'">'+Horal+'</td>'+

                                                    //'<td scope="row">'+data[i]['orden_medica']+'</td>'+
                                                    '<td><a style="cursor: pointer;" onclick="GetTdodoEstudio('+data[i]['idPaciente']+','+data[i]['folioCita']+','+idUser+')">'+data[i]['nombrePaci']+'</a></td>'+
                                                    '<td>'+data[i]['nombreEstudio']+'</td>'+
                                                    '<td>'+data[i]['observacionesPaciente']+'</td>'+
                                                    '<td>'+data[i]['nombreCliente']+'</td>'+
                                                    '<td>'+data[i]['nombreRem']+'</td>'+
                                                    //'<td>'+data[i]['nombre']+'</td>'+
                                                    //'<td>'+data[i]['nombreEstudio']+'</td>'+
                                                    //'<td onchange="abrirPot('+data[i]['idCita']+','+i+')">'+data[i]['fechaCita']+'</td>'+
                                                    
                                                    //'<td>'+data[i]['horaTerminada']+'</td>'+
                                                    
                                                    '<td class="'+classs+'"><a onclick="cancelarCita('+data[i]['idCita']+')">CANCELAR</a></td>'+
                                                '</tr>');
                                                    
                    }
                }else{
                $("#listadocitasProx").append('<td colspan="9" align="center" style="padding-top: 20px;">NO HAY CITAS PROGAMADAS</td>');
              }
              $('#tableProx').Tabledit({
                      url: 'http://localhost/CDI/Panel/index.php/Crudcitas/editaDatos/'+fActa,
                      editButton: false,
                      deleteButton:false,
                      columns: {
                          identifier: [0, 'idCita'],
                          editable: [[3, 'horaCit']]
                      }

                    });
                    $("input[name*='horaLlega']").attr("type",'time');
                    $("input[name*='fechaC']").attr("type",'date');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }else{
            prueba();
        }

    }

    function visualModalEdit()
    {

        var esVisibleM = $("#visualVentanaEdi").is(":visible");
        if (esVisibleM)
        {
            $("#visualVentanaEdi").hide();
        }else{
            $("#visualVentanaEdi").show();
            $("#registroPacientes").hide();
        }
        var idPacie=$("#idPaciente").val()
        $.ajax({
            url : "<?php echo site_url('Crudcitas/obtenerDatos/')?>" + idPacie,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert(data);
                $("#claveEdi").val(data.clavePaci);
                $("#nombreEdit").val(data.nombrePaci);
                $("#generoEdi").val(data.generoPaci);
                $("#correoEd").val(data.correoPaci);
                $("#edadEdi").val(data.edadPaci);
                $("#fechanaciEdi").val(data.fechanaciPaci);
                $("#telefonoEdi").val(data.telefonoPaci);
                $("#medicoremitenteEdi").val(data.remitente);
                $("#clienteEdit").val(data.cliente);
                //alert(data.cliente)
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    }

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
                    $("#status" + i).html("<input type='hidden' value='2' id='estado" + i + "'><button class='btn btn-secondary btn-sm' type='button' style='background: #FF8000;'></button>");
                }

                //SI LA FECHA ACTUAL ES MAYOR A LA FECHA DE TERMINO DE LA TABLA Y EL ESTADO ACTUAL ES EN PROCESO:
                if (fechaActual >= fechaTablaTermino && $("#estado" + i).val() == 2) {
                    $("#status" + i).html("<input type='hidden' value='3' id='estado" + i + "'><button class='btn btn-secondary btn-sm' type='button' style='background: #F2F91C;'></button>");
                }
            }
        }
    }

    //Concurrent.Thread.create(monitorearEstado);

    $(function(){
        $("#formPc").on("submit", function(e){
            var idPacien=$("#idPaciente").val()
            var url;
            $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
            url= "<?php echo 'http://localhost/CDI/Panel/index.php/Crudcitas/modificPaciente/';?>"+idPacien;
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formPc"));

            $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
                .done(function(res){
                    swal("HECHO", "Datos modificados.", "success")
                    var nombreMod=$("#nombreEdit").val();
                    $("#paciente").val(nombreMod);
                    $("#visualVentanaEdi").hide();
                });

        });
    });

    function ocultarDetalle()
    {
        $("#observacionesCit").hide();
    }

    function getClie()
    {
        $("#tipoCi").html("");
        var idPacien=$("#idPaciente").val();
        //alert("idpac "+idPacien)
        $.ajax({
            url : "<?php echo site_url('Crudcitas/obtenerDatosClientess/')?>" + idPacien,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $("#tipoCit").show();
                if (data.idCliente==8)
                {
                    $("#tipoCi").append(new Option(data.nombreCliente,data.idCliente));
                }else{

                    $("#tipoCi").append(new Option(data.nombreCliente,data.idCliente));
                    $("#tipoCi").append('<option value ="8">PARTICULAR</option>');
                }
                //visualF();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    }

    // function visualF(){
    //   var idCl=$("#tipoCi").val();
    //   if (idCl!=8)
    //    {
    //     $("#visualFavt").hide();
    //     $("#FactSn").val(1);
    //   }else{
    //     $("#visualFavt").show();
    //      $("#FactSn").val("");
    //   }

    // }

    function borrarDatosI(elemento)
    {
        if ($(elemento).val().length<1)
        {
            $("#indicacionPaciente").val('');
            $("#Estud").val('');
            $("#visualIndica").hide();
            $("#visualObservaciones").hide();
        }
    }

    function corteVisual()
    {
        if ($("#cortesiaCit").is(':checked')) {
            $("#visualCortes").show();
            $("#cortesiaCit").val('1');
        }else{
            $("#visualCortes").hide();
            $("#tipCortes").val('0');
            $("#cortesiaCit").val('');
        }
    }
    window.onload=getMilisegundos;
    function getMilisegundos()
    {
        prueba();
        var str = new Date().getTime();
        var str=""+str+"";
        var res = str.substr(-5);


        $("#codigoCita").val(parseInt((Math.random() * 100))+res);
    }


    function getEstudiosRealizados()
    {
        var folio=$("#codigoCita").val();;
        $("#tablaListado").html("");
        $.ajax({
            url : "<?php echo site_url('Crudcitas/getEstudioR/')?>" + folio,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        $("#tablaListado").append('<tr><td>'+data[i]['fechaCita']+'  '+data[i]['horarioCita']+'</td><td>'+data[i]['nombre']+'</td><td>'+data[i]['nombreEstudio']+'</td><td><a style="cursor:pointer;" onClick="quitarCita('+data[i]['idCita']+')">Quitar</a></td></tr>');
                        // identificainactivos(data[i]['horarioCita'],duracion);
                    }
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    // function myConfirmation() {
    //  return 'Are you sure you want to quit?';
    //     return swal({
    //       title: "AVISO",
    //       text: "Se perdera los datos al salir de la pagina",
    //       type: "warning",
    //       showCancelButton: true,
    //       confirmButtonClass: "btn-danger",
    //       confirmButtonText: "SALIR",
    //       closeOnConfirm: false
    //     },
    //     function(){
    //       swal("borrado!", "se fue a la mierda todo ", "success");
    //     });
    // var eliminar=0;;
    //  return  eliminar=confirm("\u00BFSe perderan los datos");
    //  if (eliminar)
    //   window.location.href = "test.php?id=";
    // else
    //   alert("Aguanta")

    // }


    //window.onbeforeunload = myConfirmation;
    function verificarHoraLab()
    {
        if ($("#idCat").val()==10)
         {
             getLogoffTime();
             $("#idCat").val('');         }
    }
    
var onHours=" ";var hourFinal=" ";var onMinutes=" ";var onSeconds=" ";var offHours=0;var offMinutes=0;var offSeconds=0;var logSeconds=0;var logMinutes=0;var logHours=0;var OnTimeValue=" ";var OffTimeValue=" ";var PageTimeValue=" ";function getLogonTime(){var now=new Date();var ampm=(now.getHours()>=12)?" P.M.":" A.M."
var Hours=now.getHours();Hours=((Hours>12)?Hours-12:Hours);var Minutes=((now.getMinutes()<10)?":0":":")+now.getMinutes();var Seconds=((now.getSeconds()<10)?":0":":")+now.getSeconds();OnTimeValue=(" "+Hours+Minutes+Seconds+" "+ampm);onHours=now.getHours();onMinutes=now.getMinutes();onSeconds=now.getSeconds();}
//function getLogoffTime(){var now=new Date();var ampm=(now.getHours()>=12)?" P.M.":" A.M."
function getLogoffTime(){var now=new Date();var ampm=now.getHours();
var Hours=now.getHours();Hours=((Hours>12)?Hours-12:Hours);var Minutes=((now.getMinutes()<10)?":0":":")+now.getMinutes();var Seconds=((now.getSeconds()<10)?":0":":")+now.getSeconds();hourFinal=ampm;OffTimeValue=(ampm+Minutes);offHours=now.getHours();offMinutes=now.getMinutes();offSeconds=now.getSeconds();timer();}
function timer(){if(offSeconds>=onSeconds){logSeconds=offSeconds-onSeconds;}
else{offMinutes-=1;logSeconds=(offSeconds+60)-onSeconds;}
if(offMinutes>=onMinutes){logMinutes=offMinutes-onMinutes;}
else{offHours-=1;logMinutes=(offMinutes+60)-onMinutes;}
logHours=offHours-onHours;logHours=((logHours<10)?"0":":")+logHours;logMinutes=((logMinutes<10)?":0":":")+logMinutes;logSeconds=((logSeconds<10)?":0":":")+logSeconds;PageTimeValue=(" "+logHours+logMinutes+logSeconds);displayTimes();}
function displayTimes()
{
    var totalM = hourFinal+":"+(parseInt(offMinutes)+parseInt(2));
    //alert("Ahora son las: "+totalM);
    $("#horainicio").val(OffTimeValue);
    $("#HoraTerminada").val(totalM);
}

</script>
<script src="http://localhost/CDI/Panel/content/js/altapaciente.js"></script>
<!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->
<script src="http://localhost/CDI/Panel/content/js/funcionescita.js"></script>
<!--  <script src="http://localhost/CDI/Panel/content/js/funcionesmodalC.js"></script> -->
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
<script src="http://localhost/CDI/Panel/content/tittles/html5tooltips.js"></script>
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