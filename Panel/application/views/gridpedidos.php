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
<style type="text/css">
.redMes{
    background-color: #ce0000 !important;
    color: #fff !important;
}  

 .form-control{
        background-color: #eee;   

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
                    <div class="header" style="background-color: #293a4a;">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 style="margin-top: 10px;color:#fff;">
                                    Solicitud de Pedido
                                </h2>
                            </div>

                            <div class="col-md-5">
                                <a href="#" data-toggle="modal" data-target="#defaultModal"><h2 style="color:#fff;"><i class="material-icons">search</i>  Buscar pedidos</h2></a>
                            </div>

                            <div class="col-md-1">
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                            <li><a href="http://localhost/CDI/Panel/index.php/Crudpedidos/listaPedido">Ver lista de Pedidos</a></li>
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
                        <div class="row clearfix">
                            <div id="es" >
                                <div class="col-md-3">
                                    <p>
                                        <b>Autoriza</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                        <div class="form-line">
                                            <input type="text" id="respons"  name="respons" class="form-control" readonly>
                                            <input type="hidden" id="idUser" name="idUser" value="<?=$this->session->userdata('idUser'); ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-2">
                                    <div class="input-group">
                                        <p>
                                            <b>Fecha de pedido</b>
                                        </p>
                                        <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>

                                            <div class="form-line">
                                                <input type="date" name="fechaSoliCom"  class="form-control date" id="fechaSoliCom" value="<?php echo date('Y-m-d'); ?>">
                                                <input type="hidden" name="HoyFec" id="HoyFec" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <p>
                                        <b>No. de pedido</b>
                                    </p>
                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">format_list_numbered</i>
                                    </span>
                                        <div class="form-line">
                                            <input type="text" id="noPedi" name="noPedi" class="form-control"  readonly>
                                            <input type="hidden" id="noPedido" name="noPedido">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <p>
                                        <b>Área solicitante</b>
                                    </p>
                                    <div class="input-group input-group-lg">

                                        <div class="form-line" style="padding-top: 15px;">
                                            <select id="areaSolicita" name="areaSolicita" style="width: 100%; border: none;">
                                                <option value="">Seleccione una área</option>
                                                <?php
                                                foreach ($areaSol as $row) {
                                                    $idInterno=$row["idInterno"];
                                                    $nombreArea=$row["nombreArea"];
                                                    echo "<option value='$idInterno'>$nombreArea</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Solicitado por:</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                  <span class="input-group-addon">
                                      <i class="material-icons">person</i>
                                  </span>
                                        <div class="form-line">
                                            <input type="text" id="solicitadoPor" onkeyup="myFunction();" onchange="reci();"  name="solicitadoPor" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix">
                            <div class="header" style="background-color: #293a4a;padding-bottom: 30px;">
                                <div class="col-md-5">
                                    <h2 style=";color:#fff;">
                                        Datos del Artículo
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <p>
                                    <b>Artículo</b>
                                </p>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="material-icons">keyboard_arrow_right</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" id="NombreArt"  onkeyup="myFunction();" onkeypress="articulo();" name="NombreArt" class="form-control">
                                        <input type="hidden" id="idArt" name="idArt">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <p>
                                    <b>Unidad</b>
                                </p>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="material-icons">keyboard_arrow_right</i>

                                    </span>
                                    <div class="form-line">
                                        <input type="text" id="UnidadArt" name="UnidadArt" onkeyup="myFunction();"  class="form-control">

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-3">
                                <p>
                                    <b>Fecha Caducidad</b>
                                </p>
                                <div class="input-group input-group-lg">
                                  <span class="input-group-addon">
                                      <i class="material-icons">date_range</i>
                                  </span>
                                    <div class="form-line">
                                        <select class="form-control" id="fechaCaudUnica" name="fechaCaudUnica">
                                        </select>

                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <p>
                                    <b>Fecha Caducidad</b>
                                </p>
                                <div class="input-group input-group-lg">
                                  <span class="input-group-addon">
                                      <i class="material-icons">date_range</i>
                                  </span>
                                    <div class="form-line">
                                        <select class="form-control" onchange="limpiMensajesGra()" id="fCaducidad" name="fCaducidad">
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <p>
                                    <b>Fecha caducidad</b>
                                </p>
                                <div class="input-group input-group-lg">
                                  <span class="input-group-addon">
                                      <i class="material-icons">date_range</i>
                                  </span>
                                    <div class="form-line">
                                        <select class="form-control" onchange="limpiMensajesGra()" id="fCaducidadEntrada" name="fCaducidadEntrada">
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-2">
                                <p>
                                    <b>Cantidad del artículo</b>
                                </p>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="material-icons">keyboard_arrow_right</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="number" onchange="limpiMensajesGra()"  id="cantidadArt" name="cantidadArt" class="form-control"  >
                                    </div>
                                </div>
                                <input type="hidden" name="existencia" id="existencia">
                            </div>

                            <!-- <div class="col-md-3">
                                <p>
                                    <b>Área de uso</b>
                                </p>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="material-icons">keyboard_arrow_right</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text"  id="AreaUso" name="AreaUso" class="form-control"  >
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-2">
                                <p>
                                    <b>Área de uso</b>
                                </p>
                                <div class="input-group input-group-lg">

                                    <div class="form-line" style="padding-top: 15px;">
                                        <select id="AreaUso" name="AreaUso" style="width: 100%; border: none;">
                                            <option value="">Seleccione una área</option>
                                            <?php
                                            foreach ($areaSol as $row) {
                                                $idInterno=$row["idInterno"];
                                                $nombreArea=$row["nombreArea"];
                                                echo "<option value='$idInterno'>$nombreArea</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <div id="mensajeUno"></div>
                        
                            <div class="col-md-5">
                                <p>
                                    <b>Observaciones</b>
                                </p>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="material-icons">keyboard_arrow_right</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text"  id="Observacion" onkeyup="myFunction();" name="Observacion" class="form-control"  >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" align="center" style="padding-top: 20px;">
                                <div class="button-demo">
                                    <input type="button" onClick="traerMinimo();" class="btn bg-black waves-effect waves-light" value="Agregar">
                                    
                                   
                                </div>
                            </div>
                        </div>

                        <div id="tablaAgregar" style="display: none;">
                            <div class="row clearfix">
                                <div class="header" style="background-color: #293a4a;padding-bottom: 30px;">
                                    <div class="col-md-5">
                                        <h2 style=";color:#fff;">
                                            Artículos agregados a la compra
                                        </h2>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="body table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Cantidad</th>
                                                    <th>Unidad</th>
                                                    <th>Artículos</th>
                                                    <th>Área de uso</th>
                                                    <th>Observaciones</th>
                                                    <th>Caducidad</th>
                                                    <th>Eliminar</th>
                                                </tr>
                                                </thead>
                                                <tbody id="listaArticulo">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="header" style="background-color: #293a4a;padding-bottom: 30px;">
                                    <div class="col-md-5">
                                        <h2 style=";color:#fff;">
                                            Confirmar
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">

                                <div class="col-md-5">
                                    <p>
                                        <b>Entrego:</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person</i>
                                    </span>
                                        <div class="form-line">
                                            <input type="text" id="entregoPedi" name="entregoPedi" class="form-control" value="<?=$this->session->userdata('idUser'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <p>
                                        <b>Recibió:</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <i class="material-icons">person</i>
                                    </span>
                                        <div class="form-line">
                                            <input type="text" id="reciboPedido" name="reciboPedido" class="form-control" readonly>


                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row clearfix">
                                <div class="col-md-offset-5">
                                    <div class="button-demo">
                                        <input type="submit" onclick="SaveSol();" class="btn bg-black waves-effect waves-light" value="Aceptar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--   </form>  -->

                </div>

            </div>

        </div>

    </div>
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-radius: 50px;">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <b>Fecha Inicial</b>
                            </p>
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="date" class="form-control date"  id="feIniC" name="feIniC" onchange="filtroListoCompra();">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <b>Fecha Inicial</b>
                            </p>
                            <div class="input-group">
                                <div class="form-line">
                                    <input type="date" class="form-control date"  id="feFinC" name="feFinC" onchange="filtroListoCompra();">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <h4 class="modal-title" id="defaultModalLabel">Modal title</h4> -->
                </div>
                <div class="modal-body">
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Fecha Pedido</th>
                                <th>Detalle</th>
                                <th>PDF</th>
                            </tr>
                            <!-- <div class="input-group" id="subfiltros" style="display: none">
                                <span class="input-group-addon">
                                    <input type="checkbox" class="filled-in" onclick="filtroBuscador()" name="pagadasC" id="pagadasC">
                                    <label for="pagadasC">Pagadas</label>
                                </span>
                                <span class="input-group-addon">
                                    <input type="checkbox" class="filled-in" onclick="filtroBuscador()" name="creditoC" id="creditoC">
                                    <label for="creditoC">Crédito</label>
                                </span>
                                <span class="input-group-addon" style="display: none">
                                    <input type="checkbox" class="filled-in" onclick="filtroBuscador()" name="pagosC" id="pagosC">
                                    <label for="pagosC">Pagos</label>
                                </span>
                            </div> -->

                            </thead>
                            <tbody id="listaPedidos">
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
<script type="text/javascript">
    function limpiMensajesGra()
    {
        $("#mensajeUno").html('');
    }


function myFunction() {
 var str =$("#solicitadoPor").val();
 var res = str.toUpperCase();
  $("#solicitadoPor").val(res);

  var str =$("#NombreArt").val();
 var res = str.toUpperCase();
  $("#NombreArt").val(res);

  var str =$("#UnidadArt").val();
 var res = str.toUpperCase();
  $("#UnidadArt").val(res);

  var str =$("#Observacion").val();
 var res = str.toUpperCase();
  $("#Observacion").val(res);

  
}


</script>
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
