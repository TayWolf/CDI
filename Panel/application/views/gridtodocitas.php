<?php
include "header.php";
?>

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
</style>
<script src="../content/js/jquery-1.12.4.js"></script>
<script src="../content/js/jquery-ui.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>

<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" href="../content/css/jquery-ui.css">


<div class="modal fade" id="myModalModificHor" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Horarios disponibles</h4>
            </div>
            <div class="modal-body">
                <p>This is a large modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalAlta" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
                <h4 class="modal-title">REGISTRO DE NUEVO PACIENTE</h4>
            </div>
            <div class="modal-body">
                <div class="body">
                    <form id="formaltaPac"  method="post">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="body">
                                    <h2 class="card-inside-title"></h2>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line focused">
                                                    <input type="text" class="form-control" id="clave" name="clave" required readonly>
                                                    <label class="form-label">Clave</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                                    <label class="form-label">Nombre del paciente</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-4">

                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control" class="form-control" name="genero" required>
                                                        <option value="">Seleccione un género</option>
                                                        <option value="1">Masculino</option>
                                                        <option value="2">Femenino</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="correo" required>
                                                    <label class="form-label">Correo</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="telefono" required>
                                                    <label class="form-label">Teléfono</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="date" class="form-control" name="fechanaci" id="fechanaci"  required onchange="calcularEdad();">
                                                    <label class="form-label">Fecha de Nacimiento</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div id="linea" class="form-line">
                                                    <input type="number" class="form-control" name="edad" id="edad"  required>
                                                    <label class="form-label">Edad</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <p>
                                                <b>Médico Remitente</b>
                                            </p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control" class="form-control" name="remitente" id="remitente"  required>
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
                                        <div class="col-sm-6">
                                            <p>
                                                <b>Cliente</b>
                                            </p>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <select class="form-control" class="form-control" name="cliente" id="cliente" required>
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
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Aceptar</button>
                                            <div id="cargando"></div>
                                        </div>
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

<section style="margin-left: 15px;" class="content">

    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="background: #293a4a;">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 style="margin-top: 10px;color:  #fff;">
                                    Control de Citas
                                </h2>
                            </div>

                        </div>
                    </div>

                    <form method="post" action="" id="form">
                        <div class="body">
                            <input type="hidden" id="inputduracion" name="inputduracion">
                            <div class="content" style="border-bottom: 1px solid #ccc">
                                <div class="center" align="center" style="margin-bottom: 20px;">
                                    <h3 style="margin: 0px;">Datos de la cita</h3>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-2" id="divfecha">
                                        <p>
                                            <b>Fecha</b>
                                        </p>
                                        <?php $hoy=date("Y-m-d"); ?>
                                        <div class="input-group input-group-lg">
                                            <div class="form-line">
                                                <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo $hoy; ?>" required onchange="limpiamodal(); traedisponibilidad(); traecitaPropuesta(); traerCitas()">
                                                <input type="hidden" id="idDiainput" name="idDiainput">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>
                                            <b>Sala</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <div class="form-line">
                                                <!-- <select id="Salas" name="Salas" class="form-control show-tick" data-live-search="true" required onchange="traeMedico();limpiainputshora();limpiamodal(); traedisponibilidad(); traecitaPropuesta(); traerCitas()">  -->
                                                <select id="Salas" name="Salas" class="form-control show-tick" data-live-search="true" required onchange="traeMedico();limpiainputshora();limpiamodal(); traedisponibilidad(); traecitaPropuesta(); traerCitas()">
                                                    <option value="">Selecciones Sala</option>
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
                                                <select id="medico" name="medico" class="form-control show-tick" required onchange="diaSemana(1);limpiainputshora();limpiamodal();traedisponibilidad();traecitaPropuesta(); traerCitas()" >
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
                                                <input type="text" id="nombreEstudio" onkeypress="traeNombreEstudio();" name="nombreEstudio" class="form-control" placeholder="Nombre del Estudio" onchange="limpiainputshora();traedisponibilidad();" required >
                                                <input type="hidden" name="Estud" id="Estud">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>
                                            <b>Historial de cambios</b>
                                        </p>
                                        <div class="input-group input-group-lg">

                                            <button type="button" class="btn btn-primary" onClick="historialCambios();">Historial</button>

                                        </div>
                                    </div>




                                </div>
                                <div class="row">
                                    <div id="visualDisponibilidad" style="display: block;">
                                        <div class="modal-header col-md-12" style="background: #e8e8e8;margin-bottom: 0px;padding-bottom: 0px;">
                                            <div class="col-md-3 col-sm-3 col-xs-6" style="padding-top:  10px;margin-bottom: 0px;">
                                                <h4 class="modal-title">Horarios de la sala para el día:</h4>
                                            </div>
                                            <div style="display: none;">
                                                <div class="col-md-3 col-sm-3 col-xs-6" style="margin-bottom: 0px;">
                                                    <div class="input-group input-group-lg" style="margin: 0px;">
                                                        <div class="form-line">
                                                            <input type="date" id="fechamodal" name="fechamodal" class="form-control" onchange="traedisponibilidad(); traerCitas();diaSemana(0)">
                                                            <input type="hidden" id="inputduracion" name="inputduracion">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3" id="duracionEstudio" align="center" style="margin-bottom: 0px;"></div>
                                            <div class="col-sm-2" align="center" style="margin-bottom: 0px;">
                                                <input type="checkbox" name="estadourgencia" id="estadourgencia" class="filled-in chk-col-light-blue" onchange="cambiaCheck();" value="0" />
                                                <label for="estadourgencia">Urgencia</label>
                                            </div>



                                        </div>
                                        <div class="col-md-8 col-md-offset-2" align="center" style="margin-top: 10px;margin-bottom: 0px;">
                                            <p>Por favor seleccione el horario en que deseas asignar la cita.</p>
                                        </div>
                                        <div id="modal-body" class="modal-body col-md-12" style="margin-bottom: 0px;">

                                        </div>
                                        <div class="col-md-12" style="display: inline-block;margin-bottom: 0px;">
                                            <div id="modal-alert-div" class="col-md-12">
                                                <div id="modal-alert" class="col-md-12" align="center" style="margin-bottom: 20px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row" style="padding: 20px; text-align: left;">
                                                <div class="col-md-3" style="padding-top: 0px;">
                                                    <button class="btn btn-secondary btn-lg" type="button" style=" background: #53b72b;"></button>
                                                    <span>Hora completa Disponible</span>
                                                </div>
                                                <div class="col-md-3" style="padding-top: 0px;">
                                                    <button class="btn btn-secondary btn-lg" type="button" style=" background: #ab3c3c;"></button>
                                                    <span>Hora completa Ocupada</span>
                                                </div>
                                                <div class="col-md-3" style="padding-top: 0px;">
                                                    <button class="btn btn-secondary btn-lg" type="button" style=" background: #ff7800;"></button>
                                                    <span>Hora con minutos Disponibles</span>
                                                </div>
                                                <div class="col-md-3" style="padding-top: 0px;">
                                                    <button class="btn btn-secondary btn-lg" type="button" style=" background: #ffca00;"></button>
                                                    <span>Horario seleccionado para Cita</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12" align="center">

                                                <button type="button" class="btn btn-primary" onclick="AsignahorasEstablecidas();">Apartar horario</button>
                                            </div>
                                            <div class="row clearfix" id="horasSeleccionadas">
                                                <div class="col-md-2" id="divhorainicio" style="display: none;">
                                                    <p>
                                                        <b>Hora Inicio</b>
                                                    </p>
                                                    <div class="input-group input-group-lg">
                                                        <div class="form-line">
                                                            <input type="time" id="horainicio" name="horainicio" class="form-control" required readonly onclick="alertadisponibilidad();">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" id="divhoratermino" style="display: none;">
                                                    <p>
                                                        <b>Hora Termino</b>
                                                    </p>
                                                    <div class="input-group input-group-lg">
                                                        <div class="form-line">
                                                            <input type="time" id="horatermino" name="horatermino" class="form-control" required readonly onclick="alertadisponibilidad();">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <p>
                                                        <b>Nombre del Paciente</b>
                                                    </p>
                                                    <div class="input-group input-group-lg">
                                                      <span class="input-group-addon">
                                                          <i class="material-icons">person</i>
                                                      </span>
                                                        <div class="form-line">
                                                            <input type="text" id="paciente" onkeypress="tre();" name="paciente" class="form-control" placeholder="Nombre del paciente" required>
                                                        </div>
                                                    </div>
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
                                                            <input type="hidden" id="idUser" name="idUser" value="<?=$this->session->userdata('idUser'); ?>">

                                                            <input type="hidden" name="fechaAct" id="fechaAct" value="<?php echo date('Y-m-d'); ?>">
                                                            <input type="text" id="orden" name="orden" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="botonaltapaciente" class="col-md-2" style="display: none;">
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModalAlta">Registrar Paciente</a>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div id="autorizaBoton" style="display: none;" align="center">
                                                    <div class="button-demo">
                                                        <input type="submit" class="btn bg-black waves-effect waves-light" value="Crear Cita">
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="horacita" name="horacita">

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <input type="hidden" name="HoraTerminada" id="HoraTerminada">
                        <input type="hidden" name="emergencia" id="emergencia" value="0">
                        <input type="hidden" name="idPaciente" id="idPaciente">
                        <input type="hidden" name="valorDuracionEstudio" id="valorDuracionEstudio">
                        <input type="hidden" name="PropuestahoraCita" id="PropuestahoraCita">
                        <input type="hidden" name="PropuestaminCita" id="PropuestaminCita">
                        <input type="hidden" name="idCitarecorrida" id="idCitarecorrida">
                        <input type="hidden" name="varSalidaAnterior" id="varSalidaAnterior">
                    </form>
                    <div class="row clearfix">
                        <div class="col-md-10 col-md-offset-1" align="left" style="margin-bottom: 15px;">
                            <div class="header" style="background-color: #0000003b;">
                                <h4>
                                    Citas programadas para la fecha seleccionada
                                </h4>
                            </div>
                            <div class="body table-responsive" style="background-color: #ececec; font-size: 11px;">
                                <table class="table table-hover" id="citasAldia">
                                    <thead>
                                    <tr>
                                        <th>ORDEN MÉDICA</th>
                                        <th>PACIENTE</th>
                                        <th>SALA</th>
                                        <th>ESTUDIO</th>
                                        <th>FECHA</th>
                                        <th>HORA INICIO</th>
                                        <th>HORA TERMINO</th>
                                        <th>RESPONSABLE</th>
                                        <th>URGENCIA</th>
                                        <th>CANCELAR</th>
                                    </tr>
                                    </thead>
                                    <tbody id="listado">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- ///// ESTA TABLA PINTA A MANERA DE ARREGLO LOS VALORES QUE SE RECORRERAN CON LA FUNCION 'recorrehorario' ///// -->
                    <!-- <table class="table table-hover" style="display: none;">
                        <thead>
                            <tr>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody id="listaArticulo">


                        </tbody>
                    </table> -->
                </div>

            </div>

        </div>

    </div>
</section>
<section style="margin-left: 15px; margin-top: 10px;" class="content">
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
                                <table class="table table-hover" id="tableProx">
                                    <thead>
                                    <tr>
                                        <th>HORA LLEGADA</th>
                                        <th>ORDEN MÉDICA</th>
                                        <th>PACIENTE</th>
                                        <th>SALA</th>
                                        <th>ESTUDIO</th>
                                        <th>FECHA</th>
                                        <th>HORA INICIO</th>
                                        <th>HORA TERMINO</th>
                                        <th>RESPONSABLE</th>

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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <b>Fecha inicial</b>
                                    <input class="form-control" type="date" id="fechaInicialHistorial" onchange="historialCambios();">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <b>Fecha final</b>
                                    <input class="form-control" type="date" id="fechaFinalHistorial" onchange="historialCambios();">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Cita</th>
                                        <th>Sala anterior</th>
                                        <th>Fecha anterior</th>
                                        <th>Nueva Sala</th>
                                        <th>Nueva fecha</th>
                                        <th>Fecha del cambio</th>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .dropdown-item:hover{
        background: #ccc;
    }
</style>

<script>
    function historialCambios()
    {
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
                    $("#tablaHistorial").append("<tr><td>"+data[i]['usuario']+"</td><td>"+data[i]['cita']+"</td><td>"+data[i]['salaAnterior']+"</td><td>"+data[i]['fechaAnterior']+" "+data[i]['horaAnterior']+"</td><td>"+data[i]['nuevaSala']+"</td><td>"+data[i]['fechaNueva']+" "+data[i]['horaNueva']+"</td><td>"+data[i]['fechaCambio']+" "+data[i]['horaCambio']+"</td></tr>");
                }

            }
        });

        $("#modalCambios").modal('show');
    }
</script>

<script type="text/javascript">

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

        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/compruebaDiasLaborales/"+idDia+"/"+medico,
            dataType:"json",
            success:function(data) {
                if (data != "") {
                    // alert("si hay registros");
                    $("#divdispo").show();
                    $("#visualDisponibilidad").show();
                    $("#idDiainput").val(idDia);
                }else{
                    // alert("no hay registros");
                    swal("Lo sentimos...","El médico que seleccionaste no labora los días "+dia+" ","warning");
                    $("#divdispo").hide();
                    $("#visualDisponibilidad").hide();
                    $("#autorizaBoton").hide();
                    limpiainputshora();
                    $("#horasSeleccionadas").hide();
                    $("#idDiainput").val("");
                }
            }
        });
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
                        $("#botonaltapaciente").hide();
                    },
                    error:function(data){
                        // alert("Sin Resultados");
                        swal("Oops...","Al parecer el paciente que buscas no esta registrado, por favor da clic al boton de 'Registrar paciente', llena el formulario y luego vuelve a intentarlo ","warning");
                        $("#botonaltapaciente").show();
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
                $("#sexo").val(gen);
                $("#correo").val(ui.item.correoPaci);
                $("#feNa").val(ui.item.fechanaciPaci);
                $("#edadP").val(ui.item.edadPaci+" Años");
                $("#telefono").val(ui.item.telefonoPaci);
            }
        });
    }


    function traeNombreEstudio() {
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
                // pintaestudios(ui.item.IdEstudio);
                //pintaSalas(ui.item.IdEstudio)
            }
        });
    }


    /*function pintaSalas(idEst) {
      $("#Salas").html("");
      var idEst = idEst;

      $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcitas/traetodoSalas/"+idEst,
        dataType:"json",
        success:function(data) {
          $("#Salas").append(new Option("Selecciona una Sala", ""));
          if (data.length > 0) {
            for (var i = 0; i <= data.length; i++) {
              $("#Salas").append(new Option(data[i]['nombre'], data[i]['idSala']));
            }
          }
        }
      });
    }*/

    function traeMedico() {
        $("#medico").html("");
        var sala = $("#Salas").val();
        // alert("la sala seleccionada es "+sala);
        $("#divmedico").show();


        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeDatosMedico/"+sala,
            dataType:"json",
            success:function(data) {
                $("#medico").append(new Option("Selecciona un Médico", ""));
                if (data.length > 0) {
                    for (var i = 0; i <= data.length; i++) {
                        $("#medico").append(new Option(data[i]['nombreDoc'], data[i]['idDoctor']));
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
            var duracion = traeduracion(Estudio); // definimos una variable que va a valer lo que traiga la funcion "traeduracion"
            noDisponibles(Estudio,idsala,fecha,duracion);
            $("#duracionEstudio").append('<span>Duración: <b> '+duracion+'</b> hr(s)</span>');
            $("#inputduracion").val(duracion);
        }else{
            var fecha = $("#fecha").val();
            $("#fechamodal").val(fecha);
            $('#myModal').modal('show');
            // $("#visualDisponibilidad").show();
            var duracion = traeduracion(Estudio); // definimos una variable que va a valer lo que traiga la funcion "traeduracion"
            noDisponibles(Estudio,idsala,fecha,duracion);
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
                // return data;
                //alert(data.length)
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        var nume=data[i]['horarioCita'];
                        var res = nume.substr(0, 2);
                        if (res=="08")
                        {
                            res=8;
                        }
                        if (res=="09")
                        {
                            res=9;
                        }

                        $("#botonhora"+res).prop('disabled', true);
                    }
                }

                //desbloque(medico,fecha)

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
                        if (res=="08")
                        {
                            res=8;
                        }
                        if (res=="09")
                        {
                            res=9;
                        }
                        $("#botonhora"+res).prop('disabled', false);
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
        var duracion = duracion;
        var urgencia = $("#emergencia").val();
        if (urgencia != 1) {
            $.ajax({
                url:"http://localhost/CDI/Panel/index.php/Crudcitas/traenoDispo/"+idSala+"/"+fecha,
                dataType:"json",
                success:function(data) {
                    //alert("entraH")
                    if(data.length > 0)
                    {
                        for(i=0; i<data.length; i++)
                        {
                            //identificainactivos(data[i]['horarioCita'],duracion);
                            calcT3s(data[i]['horarioCita'],data[i]['horaTerminada'])
                        }
                    }
                    deshabilitaBtns();
                }
            });
        }
//// CODIGO PARA PINTAR LAS CITAS URGENTES Y NO SE EMPALMEN URGENCIAS CON URGENCIAS (solo descomentar, no es necesario mover nada mas)
        // else{
        //   $.ajax({
        //     url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeUrgencianoDispo/"+idEst+"/"+idSala+"/"+fecha,
        //     dataType:"json",
        //     success:function(data) {
        //       if(data.length > 0)
        //            {
        //              for(i=0; i<data.length; i++)
        //              {
        //                 identificainactivos(data[i]['horarioCita'],duracion);
        //              }
        //            }
        //       }
        //   });
        // }

        ///// NUEVO CODIGO PARA DESHABILITAR LOS BOTONES POR DIAS LABORALES DEL MEDICO

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

    function calcT3s(x,y){
        var x=x;
        var y=y;
        var t3 = substractTimess(y, x);
        identificainactivos(x,t3)
    }

    function deshabilitaBtns() {
        //alert("entra");
        var diaBuscado = $("#idDiainput").val();
        var medicoSolicitado = $("#medico").val();
        // alert("diaBuscado"+diaBuscado+" medicoSolicitado"+medicoSolicitado);
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/compruebaDiasLaborales/"+diaBuscado+"/"+medicoSolicitado,
            dataType:"json",
            success:function(data) {
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        DesactivaBtn(data[i]['horaEntrada'],data[i]['horaSalida']);
                        // var y = parseInt(i)-1;
                        // $("#varSalidaAnterior").val(data[y]['horaSalida']);
                    }
                }
            }
        });
    }


    function DesactivaBtn(entrada,salida) {
        var ent = entrada.substr(0,2);
        var sal = salida.substr(0,2);

        if (ent == "08") {
            ent = 8;
        }
        if (ent == "09") {
            ent = 9;
        }


        for (var i = 8; i <= 19; i++) {
            //alert(i+" >= "+ent)
            if (i >= ent) {
                //alert("Desabilita Entrada " + i);
                $("#botonhora"+i).prop('disabled', false);
            }else{
                //alert("Habilita Entrada " + i);
                $("#botonhora"+i).prop('disabled', true);
            }

        }
        compurbeSalida(sal);
    }

    function compurbeSalida(sal) {
        for (var i = sal; i <= 19; i++) {
            if (i > sal) {
                // alert("Desabilita Salida " + i);
                $("#botonhora"+i).prop('disabled', true );
            }else{
                // alert("Habilita Salida " + sal+" >"+i);
                $("#botonhora"+i).prop('disabled', true);
            }
        }
        traerDi()
    }

    //codigo de sergio
    /*function DesactivaBtn(entrada,salida) {
     var ent = entrada.substr(0,2);
     var sal = salida.substr(0,2);
      alert(ent+" "+sal);
     if (ent == "08") {
       ent = 8;
     }
     if (ent == "09") {
       ent = 9;
     }
     for (var i = 8; i <= 19; i++) {
       if (i < ent) {
         // alert("Desabilita Entrada " + i);
        //$("#botonhora"+i).prop('disabled', true);
       }else{
          //alert("Habilita Entrada " + i);
         $("#botonhora"+i).prop('disabled', false);
       }
     }
     compurbeSalida(sal);
    }

    function compurbeSalida(sal) {
     for (var i = sal; i <= 19; i++) {
       if (i > sal) {
         // alert("Desabilita Salida " + i);
         $("#botonhora"+i).prop('disabled', false );
       }else{
         // alert("Habilita Salida " + i);
         $("#botonhora"+i).prop('disabled', true);
       }
     }
    }*/



    function pintatodashoras() {
        $("#modal-body").html("");
        // $("#modal-alert-div").html("");
        // $("#modal-alert-div").css("background","#fff");
        momentoActual = new Date();
        momentoActual.setHours(0,0);
        hora = momentoActual.getHours();
        minuto = momentoActual.getMinutes();
        horaImprimible = hora + " : " + minuto;
        for (var i = 8; i <= 19; i++) {
            horasuma = parseInt(hora) + parseInt(i);
            $("#modal-body").append('<div class="col-md-2  col-sm-4 col-xs-4" style="padding:  1px;">'+
                '<div class="col-md-12" style="padding:  0px;">'+
                '<div class="btn-group" style="margin: 2px;">'+
                '<button id="botonhora'+horasuma+'" class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 150px; background: #53b72b; color:#fff; padding: 10px;">'+
                horasuma+
                ':00</button>'+
                '<div id="minutos'+i+'" class="dropdown-menu" style="min-width: 150px;">'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>');
            despliegaminutos(horasuma,minuto,i);
        }
    }

    function despliegaminutos(hora,min,i) {

        var hora  = hora;
        var minuto  = min;
        var botoni  = i;
        $("#minutos"+botoni).html("");
        for (var i = 0; i <= 5; i++) {
            var minutosuma = parseInt(minuto) + parseInt(i) * 10;
            if (minutosuma == "0") {
                minutosuma = "00";
            }
            $("#minutos"+botoni).append('<a id="botonminuto'+minutosuma+'-'+hora+'" class="dropdown-item" style="display: block;width: 100%;padding: .25rem 1.5rem;font-weight: 400;color: #212529;text-align: inherit;border: 0; text-decoration: none;" onclick="asignahoracita('+hora+','+minutosuma+')">'+hora+':'+minutosuma+'</a><hr style="margin-top: 0px; margin-bottom: 0px; "/>');
        }
    }

    function asignahoracita(hora,min) {
        $("#modal-alert").html("");
        var emergencia = $("#emergencia").val();
        if (emergencia == 1) {
            traedisponibilidad();
            //alert("vamos a comprobar el choque de horas");
            validadisponibilidad(hora,min);
        }else{
            traedisponibilidad();
            validadisponibilidad(hora,min);
        }


    }

    function validadisponibilidad(hora,min) {
        var horazzz = hora;
        var min = min;
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
                            // compruebachoque(data[i]['horarioCita'],hora,min);

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
                                horaselec.setHours(horazzz,min,0);
                                horaselec.setMinutes(horaselec.getMinutes() + x);
                                var horaciclo = horaselec.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit', second:'2-digit'});
                                // alert("recorrido: "+horaciclo+" - cita: "+data[i]['horarioCita']+" -Termina: "+data[i]['horaTerminada']);
                                if (horaciclo == data[i]['horarioCita'] || horaciclo == data[i]['horaTerminada']) {
                                    if (emergencia == 1) {
                                        // ALERTA Y FUNCION QUE RECORRERIAN LAS HORAS YA ASIGNADAS
                                        // swal("Recuerda que...", "Algunas citas ya agendadas se recorrerán para poder atender las urgencias", "warning");
                                        // recorrehorario(data[i]['idCita']);
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
                                var duracion = traeduracion(Estudio);
                                var construyehora = new Date();
                                construyehora.setHours(horazzz,min,0);
                                var horainicio = construyehora.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
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
                                $("#botonhora"+horazzz).css("background", "#ffca00");
                                $("#botonminuto"+min+"-"+horazzz+"").css("background", "#ffca00");
                                // alert("si puedes agendar en este horario");
                                pintahorasCita(horazzz,min);
                                //  alert("1 : "+horainicio)
                                //$("#horacita").val(horainicio);
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
                            var duracion = traeduracion(Estudio);
                            var construyehora = new Date();
                            construyehora.setHours(horazzz,min,0);
                            var horainicio = construyehora.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
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
                            //alert(horainicio)
                            $("#modal-alert").append('<span style="background: #e3f1e0; text-align: center;">La cita quedaría agendada a las <b>'+horainicio+'</b> hr(s) y terminaría a las <b id="horatotal"> </b> hr(s)</span><br>');
                            $("#modal-alert-div").css("background","#e3f1e0");
                            if (min == "0") {
                                min = "00";
                            }
                            $("#botonhora"+horazzz).css("background", "#ffca00");
                            $("#botonminuto"+min+"-"+horazzz+"").css("background", "#ffca00");
                            // alert("si puedes agendar en este horarioooo");
                            pintahorasCita(horazzz,min);
                             alert("horacita 2 "+horainicio)
                            $("#horacita").val(horainicio);
                            calcT3();
                        }

                    }
                }
            });
        }
    }


    /////////////////// CODIGO QUE LOGRA RECORRER LOS HORARIOS QUE CHOCAN O SE EMPALMAN CON UNA CITA YA AGENDADA ///////////////////
    // var total = new Array(1);
    // for(var i=0; i<total.length; i++){
    //       total[i]='';
    // }

    // var ArtArreglo = new Array(1);
    // for(var b=0; b<ArtArreglo.length; b++){
    //       ArtArreglo[b]='';
    // }
    //  var array = {
    //     'listArt': []
    //   };
    //    // var arregloJson;
    // function recorrehorario(id){
    //  var idCita = id;
    //  //alert("vamos a editar el horario de la cita con id:"+id);

    //  var prueba=jQuery.inArray(idCita,ArtArreglo );
    //        $.each(total,function(index,value){

    //             if(value == ''){
    //                 x=index;
    //            array.listArt.push({ 'idCita': idCita});
    //            $("#listaArticulo").append('<tr id='+idCita+'><td><input type="hidden" id="idcita'+idCita+'" value="'+idCita+'"</td></tr>');
    //             // calculoTotal(costoArDos,x,descuentoTotalArt,idArticulo);
    //            // alert(idCita);
    //            $("#idCitarecorrida").val(idCita);
    //             }


    //       });
    // }


    ////////////////  TERMINO CODIGO QUE LOGRA RECORRER LOS HORARIOS QUE CHOCAN O SE EMPALMAN CON UNA CITA YA AGENDADA ///////////////




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

    // ========================================================================================================================
    // ========================================================================================================================


    // function compruebachoque(citaagenda, hora, min) {
    //   var minuto = min;
    //   var coinciden = 0;
    //  var duracion = $("#valorDuracionEstudio").val();
    //  var separa = duracion.replace(":", ",");
    //    var arrayduracion = separa.split(",").map(Number);
    //     tiempoduracion = new Date();
    //     tiempoduracion.setHours(arrayduracion[0],arrayduracion[1]);
    //     horadur = tiempoduracion.getHours();
    //     minutodur = tiempoduracion.getMinutes();
    //     var minutostotalduracion = (parseInt(horadur)*60) + parseInt(minutodur);
    //     var minutostotalduracion1 = parseInt(minutostotalduracion)-1;

    //     for (var i = 1; i <= minutostotalduracion1; i++) {
    //       var horaselec = new Date();
    //       horaselec.setHours(hora,min,0);
    //       horaselec.setMinutes(horaselec.getMinutes() + i);
    //       var horaciclo = horaselec.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit', second:'2-digit'});
    //       alert("recorrido: "+horaciclo+" - cita: "+citaagenda );
    //       if (horaciclo == citaagenda) {
    //         alert("no puedes agendar en este horario");
    //         coinciden = 1;
    //         break;
    //       }
    //     }
    //     alert(coinciden);
    //     if (coinciden != 1) {
    //       var hora = hora;
    //       var minuto = min;
    //       var Estudio = $("#Estud").val();
    //       var duracion = traeduracion(Estudio);
    //       var construyehora = new Date();
    //       construyehora.setHours(hora,minuto,0);
    //       var horainicio = construyehora.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

    //       $("#modal-alert").append('<span style="background: #e3f1e0; text-align: center;">La cita quedaría agendada a las <b>'+horainicio+'</b> hr(s) y terminaría a las <b id="horatotal"> </b> hr(s)</span><br>');
    //       $("#modal-alert-div").css("background","#e3f1e0");
    //       if (minuto == "0") {
    //        minuto = "00";
    //       }
    //       $("#botonhora"+hora).css("background", "#ffca00");
    //       $("#botonminuto"+minuto+"-"+hora+"").css("background", "#ffca00");
    //       alert("si puedes agendar en este horario");
    //       pintahorasCita(hora,min);
    //       $("#horacita").val(horainicio);
    //       calcT3();
    //     }
    // }

    // ========================================================================================================================
    // ========================================================================================================================



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
            $("#botonminuto"+i+"-"+hora).css("background","#ffca00");
            if (i > 60) {
                break;
            }
        }
        var minutoscomplemento = parseInt(min)+parseInt(minutostotalduracion);
        // alert("minutos complemento:"+minutoscomplemento);
        if (minutoscomplemento > 60)
        {
            var ejecutarfuncion = parseInt(minutoscomplemento)/60;
            var ejecfuncion = parseInt(ejecutarfuncion);
            // alert("la funcion de complemento se ejecutara "+ejecfuncion+" veces");

            for (var i = 1; i <= ejecfuncion; i++) {
                // alert("la funcion entra por "+i+"° vez");
                var parametro = 60*i;
                var mincomplemento = parseInt(minutoscomplemento)-parseInt(parametro);
                // alert("El parametro cambiante del ciclo vale:"+mincomplemento);
                var color = "#ffca00";
                complemento(mincomplemento,hora,i,color);
            }

        }
    }

    function identificainactivos(hora,duracions){

        var hora = hora;
        var duracions = duracions;
        var duracion = duracions.substr(1, 4);

        var res = hora.replace(/:/g, ",");
        var array = res.split(",").map(Number);
        horadiv = new Date();
        horadiv.setHours(array[0],array[1],array[2]);
        horadi = horadiv.getHours();
        minutodiv = horadiv.getMinutes();
        // alert("la cita agendada empieza en el minuto:"+minutodiv);
        // $("#botonhora"+horadi).css("background-color","#ab3c3c");


        var separa = duracion.replace(":", ",");
        var arrayduracion = separa.split(",").map(Number);
        tiempoduracion = new Date();
        tiempoduracion.setHours(arrayduracion[0],arrayduracion[1]);
        horadur = tiempoduracion.getHours();
        minutodur = tiempoduracion.getMinutes();
        var minutostotalduracion = (parseInt(horadur)*60) + parseInt(minutodur);

        for (var i = minutodiv; i <= minutostotalduracion; i++)
        {
            //var resta= minutostotalduracion - minutodiv;
            if (i == 0) {
                i = "00";
            }
            $("#botonminuto"+i+"-"+horadi).css("background-color","#ab3c3c");
            $("#botonminuto"+i+"-"+horadi).prop("onclick", null);

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
                var color = "#ab3c3c";
                complemento(mincomplemento,horadi,i,color);
            }

        }

    }

    function complemento(minutoscomplemento,hora,i,color)
    {
        var minutosRest = minutoscomplemento;
        //alert("restan"+minutosRest);
        var horasx = i;
        var horasuma = parseInt(hora)+parseInt(horasx);
        if (color != "#ffca00") {
            setTimeout(function () { compruebacolor(horasuma) },0);
        }

        if (horasuma == 24) {
            horasuma = "0";
        }
        $("#botonhora"+horasuma).css("background-color",color);
        for (var i = 0; i <= minutosRest; i++) {
            if (i == 0) {
                i = "00";
            }
            $("#botonminuto"+i+"-"+horasuma).css("background-color",color);
            if (color == "#ab3c3c") {
                // alert("entra el color rojo");
                $("#botonminuto"+i+"-"+horasuma).prop("onclick", null);
            }
        }
    }

    function compruebacolor(hora) {
        //alert("entra comprobacion de color con hora: "+hora);
        var elemento = $("div#minutos"+hora+" > a").css("background-color");
        //alert(elemento);
        if (elemento == "rgb(171, 60, 60)") {

            $("#botonhora"+hora).css("background-color","#ab3c3c");
        }else{
            $("#botonhora"+hora).css("background-color","#ff7800");
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
        //alert(inicio+" "+fin);
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
                            var salidasala = data[i]['horarioCita']
                            $("#listadocitasProx").append('<tr>'+
                                '<th scope="row">'+data[i]['orden_medica']+'</th>'+
                                '<td>'+data[i]['nombrePaci']+'</td>'+
                                '<td>'+data[i]['nombre']+'</td>'+
                                '<td>'+data[i]['nombreEstudio']+'</td>'+
                                '<td>'+data[i]['fechaCita']+'</td>'+
                                '<td>'+data[i]['horarioCita']+'</td>'+
                                '<td>'+data[i]['horaTerminada']+'</td>'+
                                '<td>'+data[i]['nombreUser']+'</td>'+
                                '<td>'+urgencia+'</td>'+
                                '</tr>');
                        }
                    }else{
                        $("#listadocitasProx").append('<td colspan="9" align="center" style="padding-top: 20px;">NO HAY CITAS PROGAMADAS</td>');
                    }
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