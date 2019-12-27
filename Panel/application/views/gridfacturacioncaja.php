<?php
include "header.php";

$idUseSesio=$_SESSION['idusuariobase'];
?>

<script src="http://localhost/CDI/Panel/content/js/jquery-ui.js"></script>

<script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
<!--  <script src="http://localhost/CDI/Panel/content/js/modificarsala.js"></script> -->
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altasalaestudio.js"></script>
<script src="http://localhost/CDI/Panel/content/js/traerId.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altaestudio.js"></script>
<script src="http://localhost/CDI/Panel/content/js/numeroALetras.js"></script>
<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link rel="stylesheet" href="http://localhost/CDI/Panel/content/css/jquery-ui.css">
<style type="text/css">


#table-scroll {
  height:430px;
 
}

 .form-control{
        background-color: #eee;   

    }
 .form-control[readonly]{
        background-color: #eee;   

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

<style type="text/css" media="print">
    .no-print { display: none; }
</style>


<section style="margin-left: 15px;" class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" >
                        <div class="row">
                            <div class="col-md-5">
                                <h2 style="margin-top: 10px; ">
                                    Datos generales
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">

                        <div class="row">
                            <div class="col-md-4" style="margin-bottom: 0px;">
                                <div class="form-group form-float" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <label for="cliente">Empresa facturadora</label>
                                        <select class="form-control" form="formPagos" name="empresa" id="empresa">
                                            <option value="">Seleccione una empresa</option>
                                            <?php
                                            foreach($empresas as $empresa)
                                                echo "<option value='".$empresa['idEmpresa']."'>".$empresa['nombreEmpresa']."</option>";
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin-bottom: 0px;">
                                <div class="form-group form-float" style="margin-bottom: 5px;">
                                    <div class="form-line">
                                        <label for="pacientes">Pacientes</label>
                                        <!--<input type="text" class="form-control" name="pacientes" id="pacientes"  oninput="filtrar();">-->
                                        <input type="text" id="pacientes" onkeyup="myFunction();" oninput="buscarPacientes();" name="pacientes" class="form-control ui-autocomplete-input" autocomplete="off">

                                        <input type="hidden" id="idPaciente" name="idPaciente" onchange="traerCitasPaciente(this)" form="formAdeudos">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2" style="margin-bottom: 0px;">
                                <div class="form-group form-float" style="margin-bottom: 5px;">
                                    <div class="form-line">
                                        <label for="cliente">Fecha Factura</label>
                                        <input class="form-control" form="formPagos"  type="date" name="fechaFa" value="<?php echo date('Y-m-d'); ?>" id="fechaFa" readonly required>
                                        <input type="hidden" id="fechaFacturada" name="fechaFacturada" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-bottom: 0px;">
                                <div class="form-group form-float" style="margin-bottom: 5px;">
                                    <div class="form-line">
                                        <label for="cliente">¿Requiere factura?</label>
                                        <select class="form-control" id="requiereFactura" onchange="validarCliente()" name="requiereFactura" form="formPagos">
                                            <option value="1">Si</option>
                                            <option value="2">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4" >
                                <h4>Datos de la cita</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2" style="margin-bottom: 0px;">
                                <div class="form-group form-float" style="margin-bottom: 0px;">
                                    <div class="form-line" >
                                        <label for="fechaInicial">Fecha</label>
                                        <input class="form-control" type="date" name="fechaInicial" id="fechaInicial" onChange="filtrar();" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-bottom: 0px;">
                                <div class="form-group form-float" style="margin-bottom: 0px;">
                                    <div class="form-line" >
                                        <label for="fechaFinal">Fecha Final</label>
                                        <input class="form-control" type="date" name="fechaFinal" id="fechaFinal" onChange="filtrar();" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-bottom: 0px;">
                                <div class="form-group form-float" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <label for="numeroCita">Número de cita a facturar</label>
                                        <input class="form-control" type="number" min="1" placeholder="No. de cita" name="numeroCita" id="numeroCita" oninput="filtrar();" >
                                    </div>
                                </div>
                            </div>


                            <!--<div class="col-md-3" style="margin-bottom: 0px;">
                                <div class="form-group form-float" style="margin-bottom: 5px;">
                                    <div class="form-line">
                                        <label for="citas">Estudios</label>
                                        <select class="form-control" name="estuReali" id="estuReali" onchange="filtroEstudio()" >
                                        </select>
                                    </div>
                                </div>
                            </div>-->
                        </div>
  

                        <div class="row">
                            <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="body table-responsive">
                                    <div class="responsive-table table-status-sheet">
                                        <form id="formularioTablaPago">
                                             <div id="table-wrapper">
                                            <div id="table-scroll">
                                            <table class="table table-bordered table-striped table-hover dataTable js-exportable"  >

                                            <thead>
                                                <tr >
                                                    <input type="hidden" id="xxc" name="xxc" form="formPagos">
                                                    <input type="hidden" name="folioPaga" id="folioPaga">
                                                    <th ><input class="check" type="checkbox" id="todosCheckBox" onChange="selectTodosCheckbox()" ><label  for="todosCheckBox"></label></th>
                                                    <th >Cita</th>
                                                    <th >Fecha</th>
                                                    <th >Paciente</th>
                                                    <th >Descripción</th>
                                                    <th >Comentarios</th>
                                                    <th >Adeudo</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tabla">
                                                   
                                                    
                                                <tr>
                                                </tr>
                                                </tbody>

                                            </table>
                                           </div> 
                                       </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Información de pago</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div id="infomacionCliente" style="display: block">
                                    <div class="col-md-9">
                                        <form id="formActuFis" method="post" action="">
                                            <div class="row">
                                                <div class="col-md-6" style="margin-bottom: 0px;">
                                                    <div class="form-group form-float" style="margin-bottom: 0px;">
                                                        <div class="form-line">
                                                            <input type="hidden" name="idPaciMod" id="idPaciMod">
                                                            <label for="montoPago">Cliente</label>
                                                            <input class="form-control" type="text" onkeyup="form.clienteFactura.value=form.clienteFactura.value.toUpperCase();" name="clienteFactura" id="clienteFactura" style="background-color: #eee;" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="margin-bottom: 0px;">
                                                    <div class="form-group form-float" style="margin-bottom: 0px;">
                                                        <div class="form-line">
                                                            <label for="montoPago">RFC</label>
                                                            <input class="form-control" style="background-color: #eee;" type="text" onkeyup="form.rfcFac.value=form.rfcFac.value.toUpperCase();" name="rfcFac" id="rfcFac" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-bottom: 5px;">
                                                    <div class="form-group form-float" style="margin-bottom: 0px;">
                                                        <div class="form-line">
                                                            <label for="montoPago">Domicilio </label>
                                                            <input class="form-control" style="background-color: #eee;" type="text" onkeyup="form.domiFa.value=form.domiFa.value.toUpperCase();" name="domiFa" id="domiFa" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4"style="margin-bottom: 0px;">
                                                    <div class="form-group form-float" style="margin-bottom: 0px;">
                                                        <div class="form-line">
                                                            <label for="montoPago">Colonia</label>
                                                            <input class="form-control" style="background-color: #eee;" type="text" onkeyup="form.coloniaFa.value=form.coloniaFa.value.toUpperCase();" name="coloniaFa" id="coloniaFa" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin-bottom: 0px;">
                                                    <div class="form-group form-float" style="margin-bottom: 0px;">
                                                        <div class="form-line">
                                                            <label for="montoPago">Delegación</label>
                                                            <input class="form-control" style="background-color: #eee;" type="text" onkeyup="form.deleFact.value=form.deleFact.value.toUpperCase();" name="deleFact" id="deleFact" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-bottom: 0px;">
                                                    <div class="form-group form-float" style="margin-bottom: 0px;">
                                                        <div class="form-line">
                                                            <label for="montoPago">Estado  </label>
                                                            <input class="form-control" style="background-color: #eee;" type="text" onkeyup="form.edoFact.value=form.edoFact.value.toUpperCase();" name="edoFact" id="edoFact" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin-bottom: 0px;">
                                                    <div class="form-group form-float" style="margin-bottom: 0px;">
                                                        <div class="form-line">
                                                            <label for="montoPago">Teléfono</label>
                                                            <input class="form-control" style="background-color: #eee;" type="text" onkeyup="form.telFact.value=form.telFact.value.toUpperCase();" name="telFact" id="telFact" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="margin-bottom: 0px;margin-top: 20px;">
                                                    <input type="submit" class="btn btn-primary" value="Actualizar">
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>    
                                <div class="col-md-3">
                                    <p style="font-size: 15px;margin-bottom: 0px;height: 20px;"><b>Subtotal:</b> $<label style="font-weight: unset" id="subtotal">0</label></p>
                                    <p style="font-size: 15px;margin-bottom: 0px;height: 20px;"><b>Descuento:</b> $<label style="font-weight: unset" id="descuento">0</label></p>
                                    <p style="font-size: 15px;margin-bottom: 0px;height: 20px;"><b>IVA:</b> $<label style="font-weight: unset" id="iva">0</label></p>
                                    <p style="font-size: 15px;margin-bottom: 0px;height: 20px;"><b>Total:</b> $<label style="font-weight: unset" id="total">0</label></p>
                                </div>
                            </div>
                       
                        <form id="formPagos" method="post" action="">
                            <div class="row">

                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label for="formaPago">Forma de pago</label>
                                            <select class="form-control" name="formaPago" id="formaPago" required>
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">Tranferencia</option>
                                                <option value="2">Efectivo</option>
                                                <option value="3">Deposito bancario</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label for="metodoPago">Método de pago</label>
                                            <select class="form-control" name="metodoPago" id="metodoPago" required>
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">Crédito</option>
                                                <option value="2">Contado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label for="cuentaPago">Cuenta de pago</label>
                                            <input class="form-control" onkeyup="form.cuentaPago.value=form.cuentaPago.value.toUpperCase();" name="cuentaPago" id="cuentaPago">
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label for="usoCFDI">Uso CFDI</label>
                                            <select class="form-control" name="usoCFDI" id="usoCFDI" required>
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">Gastos Generales</option>
                                                <option value="2">Honorarios médicos</option>
                                                <option value="3">Por definir</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php foreach ($ContaTo as $kr) {
                                        $totalito=$kr["tot"];
                                        echo "<input type='hidden' id='totali' name='totali' value='$totalito'>";
                                    } ?>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label for="montoPago">Acuenta</label>
                                            <input type="hidden" id="totalBD" name="totalBD">
                                            <input type="hidden" id="idSesion" name="idSesion" value="<?php echo $idUseSesio; ?>">
                                            <input class="form-control" type="number" step="0.01" name="montoPago" id="montoPago" min="0.01" readonly onchange="calcularResto()" value="0" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label for="">Recibido</label>
                                            <input class="form-control" type="number" step="0.01" name="recibido" id="recibido" min="0.01" onchange="calcularResto()" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-md-offset-8">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label for="">Resta</label>
                                            <input class="form-control" type="number" step="0.01" name="resta" id="resta" required readonly disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label for="">Cambio</label>
                                            <input class="form-control" type="number" step="0.01" name="cambio" id="cambio" required readonly disabled>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row" >

                                <div class="col-md-2 col-md-offset-4">
                                    <div class="form-group">
                                        <input type="button" onclick="llenadoDato()" data-toggle="modal" data-target="#mymodalVisualPago" style="width: 100%"  class="btn btn-success waves-effect"  value="Verificar">
                                    </div>
                                </div>
                                <div id="botonazoVisual" style="display: none;">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="submit" style="width: 100%"  class="btn btn-success waves-effect"  value="Generar">
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
    <div class="modal fade" id="mymodalVisualPago" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Datos del Pago</h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-md-3 col-md-offset-6 form-control-label">
                            <label for="nuFactr">Factura</label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <div class="form-line">
                                    <input type="text" id="nuFactr" name="nuFactr" class="form-control">
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
                                <div class="form-line">
                                    <input type="text" id="ClientFa" class="form-control" placeholder="Nombre cliente">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 form-control-label">
                            <label for="rfcC">RFC:</label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <div class="form-line">
                                    <input type="text" id="rfcC" class="form-control" placeholder="RFC cliente">
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
                                <div class="form-line">
                                    <input type="text" id="DirecC" class="form-control" placeholder="Domicilio cliente">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 form-control-label">
                            <label for="rfcC">Citas:</label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="margin-bottom: 0px;">
                                <div class="form-line">
                                    <input type="text" id="ciNum" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <!-- <div class="col-md-3">
                                <label for="rfcC">Cuenta de pago:</label>
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <input type="text" id="cuentaPagoFactModal" class="form-control" >
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-3 col-md-offset-2">
                                <label for="rfcC">Uso CFDI:</label>
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <input type="text" id="cfdiFactModal" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="rfcC">F. Pago:</label>
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <input type="text" id="pagoFormaModal" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="rfcC">M. Pago:</label>
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <input type="text" id="metoPagoFModal" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row header">
                        <b>Estudios realizados</b>
                        <div class="row clearfix">
                            <div class="col-sm-10">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <textarea rows="4" id="listadoEst" class="form-control no-resize" placeholder="Listado de estudios realizados"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <textarea rows="4" id="listadoPrise" class="form-control no-resize" ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <b>Importe con letra</b>
                                <p id="letraImpor"> 00/100 M.N.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 form-control-label">
                                    <label for="rfcC">S. Médicos:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <div class="form-line">
                                            <input type="number" id="serMedi" class="form-control" readonly>
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
                                        <div class="form-line">
                                            <input type="number" id="ivit" class="form-control" readonly>
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
                                        <div class="form-line">
                                            <input type="number" id="toti" class="form-control" readonly >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-control-label">
                                    <label for="">Monto a facturar:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom: 0px;">
                                        <div class="form-line">
                                            <input type="number" id="montoFacturar" class="form-control" name="montoFacturar" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="text-align: center;">
                    <button type="button" onclick="visualBotonazo()" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <form id="formAdeudos">
        <div class="modal fade" id="modalSeleccion" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Seleccione las citas que fueron pagadas</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-sm-2 col-sm-offset-10" id="restante">
                            </div>
                            <div class="col-sm-12">
                                <div class="table table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre del estudio</th>
                                            <th>Adeudo</th>
                                            <th>A pagar</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tablaSeleccion">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center;">
                        <button type="button" id="botonAceptarPago"  disabled class="btn btn-default" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<script>
    totalAdeudos=0;
    var peticion = $.ajax();
    var peticionE = $.ajax();
    var peticionFE = $.ajax();
    var empresaFacturadoraSeleccionada=0;
    var empresaFacturadoraPorSeleccionar;
    var inicioEmpresaFacturadora=1;
    var numeroCheckboxSeleccionados=0;
    //window.onload=filtrar;
    function filtrar()
    {
       // GetEstudio();
        idCliente=$("#cliente").val();
        peticion.abort();
       
        var fechaInicial, fechaFinal, idCita, idPaciente, filtradoCitas;
        fechaInicial=$("#fechaInicial").val();
        fechaFinal=$("#fechaFinal").val();
        //idCita=$("#cita"+$("#numeroCita").val()).val();
        idCita=$("#numeroCita").val();
        idPaciente=$("#idPaciente").val();

        // if(idPaciente==0)
        // {
        //     $("#tabla").empty();
        //     return;
        // }
        //TODO: CAMBIAR EL SIGUIENTE
         
        filtradoCitas=$("#fechaInicial").val();

        var parametros={'idCliente':idCliente,'fechaInicial': fechaInicial, 'fechaFinal':fechaFinal, 'folioCita': idCita, 'idPaciente': idPaciente};
        peticion= $.ajax({
            url:"http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/filtrarTablaCaja",
            type: 'POST',
            data: parametros,
            dataType: 'JSON',
            success: function (data)
            {
                
                $("#tabla").empty();
                $("#subtotal").html(0).change();
                totalAdeudos=0;
                i=0;
                for (i; i < data.length; i++)
                {
                    //TODO: CAMBIAR EL 1200 POR EL ADEUDO DE LA TABLA (data[i]['adeudo'])
                    //totalAdeudos+=parseFloat(1200);

                    // $("#estuReali").append(new Option(data[i]["nombreEstudio"], data[i]["nombreEstudio"]));

                    $("#tabla").append('<tr><td><input form="formPagos" class="checkboxAdeudo '+data[i]['empresaFacturadora']+'" idEmpresaFacturadora="'+data[i]['empresaFacturadora']+'" type="checkbox" id="estudioSeleccionado'+i+'" name="estudioSeleccionado'+i+'" onChange="validarEmpresa('+i+', '+data[i]['idEstudio']+','+data[i]['idPaciente']+', '+data[i]['folioCita']+');"  value="'+data[i]['idCita']+'">  <label for="estudioSeleccionado'+i+'"></label></td><td>' + data[i]['folioCita'] + '<input type="hidden" form="formPagos" name="cita'+(i + 1)+'" id="cita'+(i + 1)+'" value="'+data[i]['idCita']+'"><input type="hidden" form="formPagos" name="estuId'+(i + 1)+'" id="estuId'+(i + 1)+'" value="'+data[i]['idEstudio']+'"></td><td>' + data[i]['fechaCita'] + '</td><td>' + data[i]['nombrePaci'] + '</td><td>' + data[i]['nombreEstudio'] + '<input type="hidden" id="nombrEss'+i+'" value="'+data[i]['nombreEstudio']+'"></td><td>' + data[i]['indicacionesPaciente'] + '</td><td>$<data id="adeudo'+(i)+'"></data></td></tr>');

                    sacarPrecioEstudio(i,data[i]['idEstudio'],data[i]['tipoCitaa'],data[i]['tipoCitaa']);

                }
                $("#xxc").val(i);
            }
        });


    }

    function sacarPrecioEstudio(i,idEstudio,tipC,idCli)
    {
        // var parametros={'idCita':idCita,'tipC': tipC};
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/getPrecio/"+idEstudio+"/"+tipC+"/"+idCli,
            type: 'POST',
            //data: parametros,
            dataType: 'JSON',
            success: function (data)
            {
                //alert("Aqui")
                totalAdeudos+=parseFloat(data.precioPublico);
                $("#adeudo"+i).append(data.precioPublico+'<input form="formPagos" type="hidden" id="precioEst'+i+'" name="precioEst'+i+'" value="'+data.precioPublico+'">');
            }
        });
    }

    function datosEstu(i,idEst,idPa)
    {
        $("#idPaciente").val(idPa);
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/getfac/"+idEst,
            type: 'POST',
            // data: parametros,
            dataType: 'JSON',
            success: function (data)
            {
                //alert("Aqui")

                $("#empresa").val(data.idEmpresa);
            }
        });
        getdatFact(idPa,i);
    }

    function getdatFact(idPa,i)
    {
        $.ajax({
            url:"http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/getDatoFa/"+idPa,
            type: 'POST',
            // data: parametros,
            dataType: 'JSON',
            success: function (data)
            {
                var chec=$("#estudioSeleccionado"+i).val();

                if ($('#estudioSeleccionado'+i).prop('checked'))
                {
                    $("#clienteFactura").val(data.razonSocial);
                    $("#domiFa").val(data.domFiscal);
                    $("#rfcFac").val(data.RFC);
                    $("#telFact").val(data.telefono);
                    $("#coloniaFa").val(data.colonia);
                    $("#edoFact").val(data.estado);
                    $("#deleFact").val(data.municipio);
                    $("#idPaciMod").val(data.idPaciente);
                }
            }
        });
    }

    function GetEstudio(){
        idCliente=$("#cliente").val();
        peticionE.abort();
        var fechaInicial, fechaFinal, idCita, idPaciente, filtradoCitas;
        fechaInicial=$("#fechaInicial").val();
        fechaFinal=$("#fechaFinal").val();
        idCita=$("#cita"+$("#numeroCita").val()).val();
        idPaciente=$("#idPaciente").val();
        //TODO: CAMBIAR EL SIGUIENTE
        filtradoCitas=$("#fechaInicial").val();

        var parametros={'idCliente':idCliente,'fechaInicial': fechaInicial, 'fechaFinal':fechaFinal, 'idCita': idCita, 'idPaciente': idPaciente};
        peticionE= $.ajax({
            url:"http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/GetEs",
            type: 'POST',
            data: parametros,
            dataType: 'JSON',
            success: function (data)
            {
                //alert("Aqui")

                $("#estuReali").empty();
                $("#estuReali").append('<option value="">Todos los estudios</option>');
                for (i = 0; i < data.length; i++)
                {
                    $("#estuReali").append(new Option(data[i]["nombreEstudio"], data[i]["IdEstudio"]));

                }
            }
        });

    }

    function filtroEstudio()
    {

        idCliente=$("#cliente").val();
        peticionFE.abort();
        var fechaInicial, fechaFinal, idCita, idPaciente, filtradoCitas;
        fechaInicial=$("#fechaInicial").val();
        fechaFinal=$("#fechaFinal").val();
        //idCita=$("#cita"+$("#numeroCita").val()).val();
        idPaciente=$("#idPaciente").val();
        idEst=$("#estuReali").val();
        //TODO: CAMBIAR EL SIGUIENTE
        filtradoCitas=$("#fechaInicial").val();

        var parametros={'idCliente':idCliente,'fechaInicial': fechaInicial, 'fechaFinal':fechaFinal, 'idPaciente': idPaciente,'idEst':idEst};
        peticionFE= $.ajax({
            url:"http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/GetEsFCa",
            type: 'POST',
            data: parametros,
            dataType: 'JSON',
            success: function (data)
            {
                //alert("Aqui")

                $("#tabla").empty();
                i=0;
                for (i; i < data.length; i++)
                {
                    $("#tabla").append('<tr><td><input  form="formPagos" class="checkboxAdeudo '+data[i]['empresaFacturadora']+'" idEmpresaFacturadora="'+data[i]['empresaFacturadora']+'" type="checkbox" id="estudioSeleccionado'+i+'" name="estudioSeleccionado'+i+'" onChange="validarEmpresa('+i+', '+data[i]['idEstudio']+','+data[i]['idPaciente']+', '+data[i]['folioCita']+');" value="'+data[i]['idCita']+'"><label for="estudioSeleccionado'+i+'"></label></td><td>' + data[i]['idCita'] + '<input type="hidden" form="formPagos" name="cita'+(i + 1)+'" id="cita'+(i + 1)+'" value="'+data[i]['idCita']+'"><input type="hidden" form="formPagos" name="estuId'+(i + 1)+'" id="estuId'+(i + 1)+'" value="'+data[i]['idEstudio']+'"></td><td>' + data[i]['fechaCita'] + '</td><td>' + data[i]['nombrePaci'] + '</td><td>' + data[i]['nombreEstudio'] + '<input type="hidden" id="nombrEss'+i+'" value="'+data[i]['nombreEstudio']+'"></td><td>' + data[i]['indicacionesPaciente'] + '</td><td>$<data id="adeudo'+(i)+'"></data></td></tr>');
                    sacarPrecioEstudio(i,data[i]['idEstudio'],data[i]['tipoCitaa'],data[i]['tipoCitaa']);
                }
                $("#xxc").val(i);
            }
        });

    }
    function selectTodosCheckbox()
    {
        var checkbox=document.getElementById("todosCheckBox");
        $(".checkboxAdeudo").prop("checked",checkbox.checked);
        if(checkbox.checked){
            $("#total").html(totalAdeudos);
            $("#montoPago").val(totalAdeudos);
        }

        // $("#subtotal").html(totalAdeudos);
        //alert("Totales "+totalAdeudos)
            
        else
        //$("#subtotal").html(0);
        {
            $("#total").html(0);
            $("#montoPago").val(0);
        }
            
        $("#toti").html(0);
        //$("#subtotal").change();
        $("#total").change();
        $("#toti").change();
    }
    function validarEmpresa(numeroI,idEstudio, idPaciente, folioCita)
    {
        empresaFacturadoraPorSeleccionar=$("#estudioSeleccionado"+numeroI).attr("idEmpresaFacturadora");
        if(numeroCheckboxSeleccionados==0)
        {
            inicioEmpresaFacturadora=1;
                empresaFacturadoraSeleccionada=0;
                $("input[type='checkbox']").removeAttr("disabled");
        }
        if($("#estudioSeleccionado"+numeroI).prop("checked"))
        {
            numeroCheckboxSeleccionados++;
            $("input[type='checkbox']").not("."+empresaFacturadoraPorSeleccionar).attr("disabled", true);
        }
        else
        {
            numeroCheckboxSeleccionados--;
            if(numeroCheckboxSeleccionados==0)
            {
                inicioEmpresaFacturadora=1;
                empresaFacturadoraSeleccionada=0;
                $("input[type='checkbox']").removeAttr("disabled");
                
            }

        }
        
        
        if(empresaFacturadoraSeleccionada!=empresaFacturadoraPorSeleccionar)
        {

            if(inicioEmpresaFacturadora==1)
            {
                inicioEmpresaFacturadora=0;
                empresaFacturadoraSeleccionada=empresaFacturadoraPorSeleccionar;
                sumarAdeudo(numeroI);
                datosEstu(numeroI, idEstudio, idPaciente);
                ponerCita(folioCita);
            }
            else
            {
                swal("Error", "Las empresas que facturan los estudios no coinciden", "error");
            $("#estudioSeleccionado"+numeroI).attr("checked", !$("#estudioSeleccionado"+numeroI).prop("checked"));
            }
            
        }
        else
        {
            sumarAdeudo(numeroI);
            datosEstu(numeroI, idEstudio, idPaciente);
            ponerCita(folioCita);

        }
    }
    function sumarAdeudo(adeudo)
    {
    
            //adeudoActual=parseFloat($("#subtotal").html());
            adeudoActual=parseFloat($("#total").html());
            var checkbox=document.getElementById("estudioSeleccionado"+adeudo);
            // alert(adeudo)
            if (checkbox.checked==true)
                adeudoActual=adeudoActual+parseFloat($("#adeudo"+adeudo).html());
            else
                adeudoActual=adeudoActual-parseFloat($("#adeudo"+adeudo).html());
            //$("#subtotal").html(adeudoActual);
            $("#total").html(adeudoActual);
            $("#montoPago").val(adeudoActual);
            //$("#subtotal").change();
            $("#total").change();

            $("#toti").html(adeudoActual);
            $("#toti").change();
        



    }
    //$("#subtotal").change( function()
    $("#total").change( function()
    {
        //subtotal=parseFloat($("#subtotal").html());
        var totalito=parseFloat($("#total").html());
        subtotal=totalito/1.16;
        iva=subtotal*.16;
        $("#subtotal").html((subtotal).toFixed(2));
        $("#iva").html((iva).toFixed(2));
        $("#total").html((totalito).toFixed(2));
        $("#montoPago").html((totalito).toFixed(2));
        $("#totalBD").val((totalito).toFixed(2));

        $("#serMedi").val((subtotal).toFixed(2));
        $("#ivit").val((iva).toFixed(2));
        $("#toti").val((totalito).toFixed(2));
    });

    $(function(){
        $("#formActuFis").on("submit", function(e){
            var url;
            $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
            url= "<?php echo 'http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/modificFiscal/';?>";
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formActuFis"));

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
                    swal("HECHO", "Datos actualizados correctamente!", "success")

                });

        });
    });

    $(function(){
        $("#formPagos").on("submit", function(e){
            var url;
            $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
            url= "<?php echo 'http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/insertaPago/';?>";
            e.preventDefault();
            var f = $(this);

            $("#clienteFactura").attr("form", "formPagos");
            $("#rfcFac").attr("form", "formPagos");
            $("#domiFa").attr("form", "formPagos");
            $("#coloniaFa").attr("form", "formPagos");
            $("#deleFact").attr("form", "formPagos");
            $("#edoFact").attr("form", "formPagos");
            $("#telFact").attr("form", "formPagos");
            var formData = new FormData(document.getElementById("formPagos"));
            console.log($("#formPagos").serialize());
            fechaInsertada="";
            $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(res)
                {
                    fechaInsertada=res;
                },
                complete: function()
                {
                    var formularioAdeudos=new FormData(document.getElementById("formAdeudos"));
                    console.log($("#formAdeudos").serialize());
                    $.ajax({
                        url:'http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/insertaAdeudo/'+$("#xxc").val()+"/"+encodeURIComponent(fechaInsertada),
                        type: "post",
                        dataType: "html",
                        data: formularioAdeudos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data)
                        {
                            swal({
                                    title: "Pagado",
                                    text: "Se ha registrado con éxito .",
                                    type: "success",
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Aceptar",
                                    closeOnConfirm: false
                                },
                                function(){
                                    location.reload();
                                });
                        }
                    })
                }
            });

        });

    });
    var citasSeleccionadas;
    function llenadoDato()
    {
        $("#botonazoVisual").hide();
        citasSeleccionadas=[];
        $("#listadoEst").html('');
        $("#listadoPrise").html('');
        var cant=$("#xxc").val();

        $("#pagoFormaModal").val($("#formaPago option:selected").text());
        $("#metoPagoFModal").val($("#metodoPago option:selected").text());
        $("#cuentaPagoFactModal").val($("#cuentaPago").val());
        $("#cfdiFactModal").val($("#usoCFDI option:selected").text());

        $("#ClientFa").val($("#clienteFactura").val())
        $("#rfcC").val($("#rfcFac").val())
        $("#DirecC").val($("#domiFa").val() +" "+$("#deleFact").val()+" "+$("#edoFact").val())
        var numerototal=$("#totalBD").val();
        for ( xx = 0; xx < cant; xx++) {
            if ($('#estudioSeleccionado'+xx).prop('checked'))
            {
                citasSeleccionadas.push($("#estudioSeleccionado"+xx).val());
                //$("#ciNum").val($("#estudioSeleccionado"+xx).val());
                $("#ciNum").val($("#folioPaga").val());
                $("#ciNum").attr("disabled","disabled");
                $("#listadoEst").append($("#nombrEss"+xx).val()+"\r\n");
                $("#listadoPrise").append("Precio: "+$("#precioEst"+xx).val()+"\r\n");
                //alert($("#estudioSeleccionado"+xx).val())
            }
        }
        console.log(JSON.stringify(citasSeleccionadas, null, 4));
        //st(numerototal);
        st($("#montoFacturar").val())
    }

     function ponerCita(folio){
        $("#folioPaga").val(folio);
    }
</script>
<script>

    function buscarPacientes()
    {
        if($("#pacientes").val().length<1)
        {
            $("#idPaciente").val(0);
            $("#idPaciente").change();
        }
        var nombrePaciente=$("#pacientes").val();
        $("#pacientes").autocomplete({
            source:function(request,response)
            {
                $.ajax({
                    url : "http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/traerPacientes/"+nombrePaciente.replace(" ", "%20"),
                    dataType:"json",
                    data:{q:request.term},
                    success:function(data) {
                        response(data);
                    }
                });
            },
            minLength:1,
            select:function(event,ui)
            {
                $("#idPaciente").val(ui.item.idPaciente);
                filtrar();
            }
        });
    }
    function traerCitasPaciente(elemento)
    {
        filtrar();

    }
</script>
<script>

    $(window).load(function ()
    {
        $('#cliente').autocomplete({
            source: function(request,response){
                $.ajax({

                    url:"http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/getClientes/",
                    dataType:"json",
                    data:{q:request.term},
                    success:function(data)
                    {
                        response(data);
                    }
                });
            },

            minLength:1,

            select:function(event,ui) {


                $("#cliente").val(ui.item.nombreCliente);
                $("#RFC").val(ui.item.RFC);
                $("#calle").val(ui.item.direccionCliente);
                $("#codigoPostal").val(ui.item.CP);
                $("#colonia").val(ui.item.Colonia);
                $("#municipio").val(ui.item.municipio);
                filtrar();
            }
        });
    });

    function visualBotonazo()
    {
        //CODIGO QUE ESTABLECE QUE CITAS SE VAN A FACTURAR
        $.ajax(
            {

                type: 'POST',
                data: {citas: citasSeleccionadas},
                url: 'http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/establecerFacturas/'+$("#requiereFactura").val(),
                success: function (resultado)
                {
                    $("#botonazoVisual").show();
                }

            }
        );
        //Cuanto va a dejar -100
        var total=parseFloat(document.getElementById("total").innerHTML);
        var montoPagar=$("#montoPago").val();
        //Con cuanto pagó -200
        var recibido=$("#recibido").val();
        if(montoPagar-recibido>=0)
        {
            document.getElementById("restante").innerHTML="<p>Restante: <input class='form-control' disabled id='saldoRestante' value='"+recibido+"'><input type='hidden' disabled id='saldoInicial' value='"+recibido+"'></p>";
        }
        else
        {
            document.getElementById("restante").innerHTML="<p>Restante: <input class='form-control' disabled id='saldoRestante' value='"+montoPagar+"'><input type='hidden' disabled id='saldoInicial' value='"+montoPagar+"'></p>";
        }
        //Código que llena la tablaSeleccion
        var totalEstudios=$("#xxc").val();
        var j=1;
        $("#tablaSeleccion").empty();
        for(i=0; i<totalEstudios; i++)
        {
            if($("#estudioSeleccionado"+i).is(":checked"))
            {
                if(montoPagar<total)
                $("#tablaSeleccion").append(
                    "<tr>" +
                    "<td><input type='hidden' name='numeroCitaAdeudo"+(i)+"' id='numeroCitaAdeudo"+(i)+"' value='"+$("#cita"+(i+1)).val()+"'>"+(j++)+"</td>" +
                    "<td>"+$("#nombrEss"+i).val()+"</td>" +
                    "<td><input type='number' class='form-control' step='0.01' id='estudioAdeudado"+i+"' name='estudioAdeudado"+i+"' placeholder='Adeudo' readonly value='"+$("#precioEst"+i).val()+"'></td>" +
                    "<td><input type='number' class='form-control clase-a-pagar' step='0.01' id='estudioSaldoPagado"+i+"' name='estudioSaldoPagado"+i+"' placeholder='¿A pagar?' onChange='verificarSaldoRestante("+i+")'></td>" +
                    "</tr>");
                else
                    $("#tablaSeleccion").append(
                        "<tr>" +
                        "<td><input type='hidden' name='numeroCitaAdeudo"+(i)+"' id='numeroCitaAdeudo"+(i)+"' value='"+$("#cita"+(i+1)).val()+"'>"+(j++)+"</td>" +
                        "<td>"+$("#nombrEss"+i).val()+"</td>" +
                        "<td><input type='number' class='form-control' step='0.01' id='estudioAdeudado"+i+"' name='estudioAdeudado"+i+"' placeholder='Adeudo' readonly value='"+$("#precioEst"+i).val()+"'></td>" +
                        "<td><input type='number' class='form-control clase-a-pagar' step='0.01' id='estudioSaldoPagado"+i+"' name='estudioSaldoPagado"+i+"' placeholder='¿A pagar?' value='"+$("#precioEst"+i).val()+"' onChange='verificarSaldoRestante("+i+")'></td>" +
                        "</tr>");
            }
        }
        //FIN

        $("#botonAceptarPago").attr("disabled", true);
        if(montoPagar<total)
            $("#modalSeleccion").modal({
                backdrop: 'static',
                keyboard: false
            });
        //FIN DEL CODIGO DE CITAS A FACTURAR

    }

function myFunction() {
 var str =$("#pacientes").val();
 var res = str.toUpperCase();
  $("#pacientes").val(res);
}


</script>

<script>
    function calcularResto()
    {
        var montoPagar=parseFloat($("#montoPago").val());
        var recibido=parseFloat($("#recibido").val());
        if(recibido||recibido==0)
        {
            if(recibido<montoPagar)
            {
                alert("El dinero recibido no puede ser menor que el monto a pagar")
                $("#recibido").val(montoPagar);
            }

        }
        var total=parseFloat(document.getElementById("total").innerHTML);
        if(montoPagar>total)
        {
            alert("El monto a pagar no puede ser mayor que el total")
            $("#montoPago").val(""+total);
        }
        else
        {
            $("#resta").val(total-montoPagar);
            if(recibido-montoPagar>=0)
            {
                $("#cambio").val(recibido-montoPagar);
                $("#montoFacturar").val(montoPagar);
            }
            else
            {
                $("#montoFacturar").val(recibido);
                $("#cambio").val(0);
            }
        }






    }
</script>

<script>
    function verificarSaldoRestante(numeroEstudio)
    {

        //Si lo que va a pagar es mayor que el estudio que adeuda
        if(parseFloat($("#estudioAdeudado"+numeroEstudio).val())<=parseFloat($("#estudioSaldoPagado"+numeroEstudio).val()))
        {
            console.log($("#estudioAdeudado"+numeroEstudio).val()+" - "+$("#estudioSaldoPagado"+numeroEstudio).val());
            $("#estudioSaldoPagado"+numeroEstudio).val($("#estudioAdeudado"+numeroEstudio).val());

        }


        var saldoRestante=$("#saldoInicial").val();
        var sumaTotal=0;
        $('.clase-a-pagar').each(function()
        {
            if(this.value)
            {
                sumaTotal+= parseFloat(this.value);
            }



        });
        saldoRestante-=sumaTotal;
        $("#saldoRestante").val(saldoRestante);
        //Se pasó de dinero ó Aún tiene dinero
        $("#botonAceptarPago").attr("disabled", saldoRestante<0||saldoRestante>0);

    }

    function validarCliente()
    {
        if ($("#requiereFactura").val()==1)
         {
            $("#infomacionCliente").show();
         }
         if ($("#requiereFactura").val()==2)
         {
            $("#infomacionCliente").hide();
         }
        
    }
</script>

<!-- <?php
include "footer.php";
?> -->