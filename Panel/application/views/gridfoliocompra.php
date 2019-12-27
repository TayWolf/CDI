<?php 
  include "header.php";
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



  .form-control{
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
                            <div class="header" style="background-color: #293a4a;" >
                              <div class="row">
                                <div class="col-md-4">
                                  <a href="http://localhost/CDI/Panel/index.php/Crudcompras"><h2 style="margin-top: 10px;color:#fff;">
                                    Registro de compras
                                  </h2></a>
                                </div>
                                
                                <div class="col-md-2 col-md-offset-5">
                                 <a href="#" data-toggle="modal" data-target="#defaultModal"><h2 style="color:#fff;"><i class="material-icons">search</i>  Buscar compras</h2></a>
                                </div>
                               
                              </div>
                            </div>
                            
                            <!-- <form method="post" action="" id="form"> -->
                            <div class="body">
                            <div class="row clearfix">
                              <div class="col-md-2">
                                  <p>
                                      <b>Nu. de Orden</b>
                                  </p>
                                  <div class="input-group input-group-lg">
                                      <span class="input-group-addon">
                                          <i class="material-icons">exit_to_app</i>
                                      </span>
                                      <div class="form-line">
                                          <input type="text" id="OrdeComp" onchange="validaOrden();" onkeyup="myFunction();"  name="OrdeComp" class="form-control">
                                          
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <p>
                                      <b>Nota</b>
                                  </p>
                                  <div class="input-group input-group-lg">
                                      <span class="input-group-addon">
                                          <i class="material-icons">featured_play_list</i>
                                      </span>
                                      <div class="form-line">
                                          <input type="text" id="NotaC" onchange="muestradatosProve();" onkeyup="myFunction();" name="NotaC" class="form-control">
                                          
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <p>
                                      <b>Factura</b>
                                  </p>
                                  <div class="input-group input-group-lg">
                                      <span class="input-group-addon">
                                          <i class="material-icons">note</i>
                                      </span>
                                      <div class="form-line">
                                          <input type="text" id="FactC" name="FactC" onchange="muestradatosProve()" onkeyup="myFunction();" class="form-control">
                                          
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <p>
                                      <b>Forma de Pago</b>
                                  </p>
                                  <div class="input-group input-group-lg">
                                      <span class="input-group-addon">
                                          <i class="material-icons">credit_card</i>
                                      </span>
                                      <div class="form-line">
                                          <select class="form-control" id="formPago" name="formPago" onchange="muestradatosProve()" required>
                                            <option value="">Seleccione un opción</option>
                                            <option value="1">Transferencia</option>
                                            <option value="2">Efectivo</option>
                                            <option value="3">Deposito bancario</option>
                                          </select>
                                          
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <p>
                                      <b>Tipo de Pago</b>
                                  </p>
                                  <div class="input-group input-group-lg">
                                      <span class="input-group-addon">
                                          <i class="material-icons">attach_money</i>
                                      </span>
                                      <div class="form-line">
                                          <select class="form-control" id="tiPago" name="tiPago" onchange="muestradatosProve();muestraDCre();" required="">
                                            <option value="">Seleccione un opción</option>
                                            <option value="1">Crédito</option>
                                            <option value="2">Contado</option>
                                           
                                          </select>
                                          
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div id="muestraDaCredito" style="display:none;">
                                <div class="row clearfix">
                                    <div class="col-md-6 col-md-offset-6">
                                      <div class="col-md-3">
                                            <p>
                                                <b>Cantidad de pagos:</b>
                                            </p>
                                            <div class="input-group input-group-lg">
                                               <!--  <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span> -->
                                                <div class="form-line">
                                                    <input type="text" onchange="calculoFecha()" id="cantidadPagos" max="31" step="1" name="cantidadPagos" class="form-control" value="0" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <p>
                                                <b>Dias de pago:</b>
                                            </p>
                                            <div class="input-group input-group-lg">
                                               <!--  <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span> -->
                                                <div class="form-line">
                                                    <input type="text" id="diasPago" onchange="calculoFecha()" name="diasPago" class="form-control" value="0" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <p>
                                                <b>Fecha limite:</b>
                                            </p>
                                            <div class="input-group input-group-lg">
                                               <!--  <span class="input-group-addon">
                                                    <i class="material-icons">person</i>
                                                </span> -->
                                                <div class="form-line">
                                                    <input type="text" id="fechaLimiteDos"  name="fechaLimiteDos" class="form-control" readonly>
                                                    <input type="hidden" name="fechaLimitePago" id="fechaLimitePago">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <!-- <div class="col-md-2">
                                  <p>
                                    <b>IVA</b>
                                  </p>
                                  <div class="form-group">
                                      <input type="radio" name="gender" id="ivaSi" class="with-gap" checked="checked" value="1">
                                      <label for="ivaSi">SI</label>

                                      <input type="radio" name="gender" id="ivaNo" class="with-gap" value="2">
                                      <label for="ivaNo" class="m-l-20">NO</label>
                                  </div>
                                </div> -->
                                
                                <div id="es" >
                                  <div class="col-md-5">
                                    <p>
                                        <b>Autoriza</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="respons2"  name="respons2" class="form-control" readonly>
                                            <input type="hidden" id="idUser" name="idUser" value="<?php echo "$idUsuarioBase"; ?>">
                                        </div>
                                    </div>
                                      
                                    <!-- <select id="Estud" name="Estud" onchange="traersutimepo();" class="form-control show-tick" data-live-search="true" required>
                                        
                                      
                                    </select> -->
                                  </div>
                                  
                                  <div class="col-md-2">
                                      <div class="input-group">
                                          <p>
                                            <b>Fecha de compra</b>
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
                                          <b>No. Compra</b>
                                        </p>
                                        
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">format_list_numbered</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="noCompra" name="noCompra" class="form-control"  readonly>
                                                <input type="hidden" id="noPedido" name="noPedido">
                                                 
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                            <div id="muestraProve" style="display: block;">
                                <div class="row clearfix">
                                       <div class="header" style="background-color: #293a4a;padding-bottom: 30px;">
                                            <div class="col-md-5">
                                              <h2 style=";color:#fff;">
                                                Proveedor
                                              </h2>
                                            </div>
                                        </div>
                                </div>
                                <div class="row clearfix">
                                   <div class="col-md-4">
                                        <p>
                                            <b>Proveedor</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="ProveNombre" onkeypress="provGetBu();" onkeyup="myFunction();" name="ProveNombre" class="form-control" placeholder="Nombre del proveedor" required>
                                                <input type="hidden" name="idProve" id="idProve">
                                            </div>
                                        </div>
                                    </div>
                            
                                   
                                </div>
                            </div>
                            <div id="datosArtmuestra" style="display: block;">
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
                                                <input type="text" id="NombreArt" name="NombreArt" onkeyup="myFunction();" class="form-control">
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
                                                <input type="text" id="UnidadArt" name="UnidadArt" onkeyup="myFunction();" class="form-control">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>Descuento</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">keyboard_arrow_right</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" id="DescuentoArt" name="DescuentoArt" class="form-control">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>Fecha Caducidad</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="date" id="fechaCad" name="fechaCad" class="form-control">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-2">
                                        <p>
                                            <b>Costo</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">keyboard_arrow_right</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" id="costoArt" name="costoArt" class="form-control" >
                                                <input type="hidden" name="costoArOculto" id="costoArOculto" >
                                                 <input type="hidden" name="existencia" id="existencia" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>
                                            <b>Cantidad del artículo</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">keyboard_arrow_right</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" onchange="calImporte();" id="cantidadArt" name="cantidadArt" class="form-control"  >
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>
                                            <b>Importe del Artículo</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">keyboard_arrow_right</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="importeArt" name="importeArt" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                      <p>
                                        <b>IVA</b>
                                      </p>
                                      <div class="form-group">
                                          <input type="radio" name="subiva" id="subivaSi" class="with-gap" checked="checked" value="1">
                                          <label for="subivaSi">SI</label>

                                          <input type="radio" name="subiva" id="subivaNo" class="with-gap" value="2">
                                          <label for="subivaNo" class="m-l-20">NO</label>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="button-demo">
                                          <input type="button" onClick="verificarImpor();" class="btn bg-black waves-effect waves-light" value="Agregar">
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tablaAgregar" style="display: block;">
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
                                                <table id="tablapedidos" class="table">
                                                    <thead>
                                                      <tr>
                                                        <th>Cantidad</th>
                                                        <th>Unidad</th>
                                                        <th>Caducidad</th>
                                                        <th>Artículos</th>
                                                        <th>Descuento</th>
                                                        <th>Costo</th>
                                                        <th>Importe</th>
                                                         <th>IVA</th>
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
                                                Cantidad a pagar:
                                              </h2>
                                            </div>
                                        </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-2">
                                        <p>
                                            <b>Importe:</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="subtotalDos" name="subtotalDos" class="form-control" readonly>
                                                <input type="hidden" id="subtotal" name="subtotal">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>
                                            <b>Descuento:</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="descuentoTotalDos" name="descuentoTotalDos" class="form-control" readonly>
                                                <input type="hidden" id="descuentoTotal" name="descuentoTotal">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>
                                            <b>Subtotal:</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="subtotalitoDos" name="subtotalitoDos" class="form-control" readonly>
                                                <input type="hidden" id="subtotalito" name="subtotalito">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>I.V.A.:</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="ivacantidadDos" name="ivacantidadDos" class="form-control" readonly>
                                                <input type="hidden" id="ivacantidad" name="ivacantidad">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>TOTAL:</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="totalDos" name="totalDos" class="form-control" readonly>
                                                <input type="hidden" id="total" name="total" >

                                                
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
                    <div class="modal-content"  style="border-radius: 50px;">
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
                                    <th>Fecha Compras</th>
                                    <th>Detalle</th>
                                    <th>Tipo</th>
                                    <th>PDF</th>
                                  </tr>
                                    <div class="input-group" id="subfiltros" style="display: block;">
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
                                    </div>
                                    
                                </thead>
                                <tbody id="listaCompras">
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
                                            <th>Nombre de quien lo autoriza</th>
                                            <th>Nombre del proveedor</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalleRespo">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-header" style="padding-top: 0px;background-color: #293a4a;">
                           <h4 class="modal-title" id="defaultModalLabel" style="color:#fff;">Detalle de la compra</h4>
                        </div>
                        <div class="modal-body" >
                            <div class="body table-responsive">
                                <table class="table">
                                    <thead >
                                        <tr>
                                            <th>F. Compra</th>
                                            <th>decuento</th>
                                            <th>Forma de pago</th>
                                            <th>Factura</th>
                                            <th>Nota</th>
                                            <th>tipo Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalleTip">
                                       
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th>Días</th>
                                            <th>Cantidad pagos</th>
                                            <th>Fecha limite</th>
                                            <th>Descuento</th>
                                            <th>Subtotal</th>
                                            <th>Iva</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalleImpor">
                                        
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
                                            <th>caducidad</th>
                                            <th>Cantidad</th>
                                            <th>Unidad</th>
                                            <th>Artículo</th>
                                            <th>$ Unitario</th>
                                            <th>%</th>
                                            <th>Importe</th>
                                            <th>IVA</th>
                                            <th>Total</th>
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
    function provGetBu(){
      $('#ProveNombre').autocomplete({
       source: function(request,response){
          $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcompras/buscarNombreProved/",
            dataType:"json",
            data:{q:request.term},
            success:function(data) {
              response(data);
          }    
          });
       },
       minLength:1,
       select:function(event,ui) {
             $("#idProve").val(ui.item.idProveedor);
            muestraarrt();
          }
      });

  } 


function myFunction() {
 var str =$("#OrdeComp").val();
 var res = str.toUpperCase();
  $("#OrdeComp").val(res);

var str =$("#NotaC").val();
 var res = str.toUpperCase();
  $("#NotaC").val(res);

  var str =$("#FactC").val();
 var res = str.toUpperCase();
  $("#FactC").val(res);

  var str =$("#ProveNombre").val();
 var res = str.toUpperCase();
  $("#ProveNombre").val(res);

  var str =$("#NombreArt").val();
 var res = str.toUpperCase();
  $("#NombreArt").val(res);

  var str =$("#UnidadArt").val();
 var res = str.toUpperCase();
  $("#UnidadArt").val(res);


}




  </script>
 <!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->
  <script src="http://localhost/CDI/Panel/content/js/funcionesCompra.js"></script>
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