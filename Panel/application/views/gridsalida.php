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

    <div class="container-fluid">
      
        <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header" style="background-color: #293a4a;">
                              <div class="row">
                                <div class="col-md-5">
                                  <h2 style="margin-top: 10px;color:#fff;">
                                    Registro de salida
                                  </h2>
                                </div>
                               
                              </div>
                            </div>
                            
                            <!-- <form method="post" action="" id="form"> -->
                            <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-2">
                                  <p>
                                    <b>IVA</b>
                                  </p>
                                  <div class="form-group">
                                      <input type="radio" name="gender" id="ivaSi" class="with-gap" checked="checked" value="1">
                                      <label for="ivaSi">SI</label>

                                      <input type="radio" name="gender" id="ivaNo" class="with-gap" value="2">
                                      <label for="ivaNo" class="m-l-20">NO</label>
                                  </div>
                                </div>
                                
                                
                                <!--<div class="col-md-2">
                                     <p>
                                      <b>Descuento</b>
                                    </p> 
                                    <div class="form-group">
                                        <input type="checkbox" id="descAc" name="descAc" onclick="vDescuento();" >
                                        <label for="descAc">%</label>
                                       
                                            <input type="number" style="display: none" id="cantidadDes" name="cantidadDes">
                                        
                                        
                                    </div> 
                     
                                    
                                </div>-->
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
                                            <input type="text" id="respons"  name="respons" class="form-control" readonly>
                                            <input type="hidden" id="idUser" name="idUser" value="<?=$this->session->userdata('idUser'); ?>">
                                        </div>
                                    </div>
                                      
                                    <!-- <select id="Estud" name="Estud" onchange="traersutimepo();" class="form-control show-tick" data-live-search="true" required>
                                        
                                      
                                    </select> -->
                                  </div>
                                  
                                  <div class="col-md-2">
                                      <div class="input-group">
                                          <p>
                                            <b>Fecha de Entrada</b>
                                          </p>
                                          <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                          
                                            <div class="form-line">
                                                <input type="date" name="fechaSoliMos"  class="form-control date" id="fechaSoliMos" value="<?php echo date('Y-m-d'); ?>">
                                                <input type="hidden" name="Solifec" id="Solifec" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                    <div class="col-md-2">
                                        <p>
                                          <b>No. Salida</b>
                                        </p>
                                        
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">format_list_numbered</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="noSal" name="noSal" class="form-control"  readonly>
                                                <input type="hidden" id="noSalida" name="noSalida">
                                                 
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
                                                Datos de la salida
                                              </h2>
                                            </div>
                                        </div>
                                </div>
                                <div class="row clearfix">
                                   <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea name="motivo" id="motivo" onkeyup="myFunction();" cols="30" rows="5" class="form-control no-resize"  onkeypress="visualArt();" required></textarea>
                                                <label class="form-label">Motivo:</label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                   
                                </div>
                            </div>
                            <div id="datosArtmuestra" style="display: none;">
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
                                                <input type="text" id="NombreArt" name="NombreArt" onkeyup="myFunction();" class="form-control" oninput="articuloSSS();">
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
                                           <b>F.Compra</b>
                                      </p>
                                      <div class="input-group input-group-lg">
                                          <span class="input-group-addon">
                                              <i class="material-icons">credit_card</i>
                                          </span>
                                          <div class="form-line">
                                              <select class="form-control" id="fCaducidad" name="fCaducidad">
                                              </select>
                                              
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <p>
                                           <b>F.Entrada</b>
                                      </p>
                                      <div class="input-group input-group-lg">
                                          <span class="input-group-addon">
                                              <i class="material-icons">credit_card</i>
                                          </span>
                                          <div class="form-line">
                                              <select class="form-control" id="fCaducidadEntrada" name="fCaducidadEntrada">
                                              </select>
                                              
                                          </div>
                                      </div>
                                    </div>
                                    
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-3">
                                        <p>
                                            <b>Costo</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">keyboard_arrow_right</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" id="costoArt" name="costoArt" class="form-control">
                                                <input type="hidden" name="costoArOculto" id="costoArOculto" >
                                                 <input type="hidden" name="existencia" id="existencia" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>Cantidad del artículo</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">keyboard_arrow_right</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="number" id="cantidadArt" name="cantidadArt" class="form-control">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <p>
                                            <b>Importe del Artículo</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">keyboard_arrow_right</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="importeArt" name="importeArt" onkeyup="myFunction();" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="button-demo">
                                          <!-- <input type="button" onClick="agregarArticuloLista();" class="btn bg-black waves-effect waves-light" value="Agregar"> -->
                                          <input type="button" onClick="traerMinimo();" class="btn bg-black waves-effect waves-light" value="Agregar">
                                          <div id="mensajeUno"></div>
                                      </div>
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
                                                        <th>Caducidad</th>
                                                        <th>Artículos</th>
                                                        <th>Costo</th>
                                                        <th>Importe</th>
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
                                    <div class="col-md-4">
                                        <p>
                                            <b>Subtotal:</b>
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
                                    
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                        <input type="submit" onclick="SaveSalida();" class="btn bg-black waves-effect waves-light" value="Aceptar">
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
</section>

 <script type="text/javascript">
    /*$('#tablaSalas').Tabledit({
    url: 'Crudcompras/modificarDatos/',
    eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
        identifier: [0, 'idSala'],
        editable: [[1, 'nombre'], [3, 'tipo'],[4, 'clave']]
    }
  });*/

/*$('#tablaHours').Tabledit({
    url: 'Crudsalas/modificarDatos/',
    eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
              identifier: [0, 'idcontrol'],
              editable: [[1, 'dia'], [2, 'horaEntrada'],[3, 'horaSalida']]
             }
    });*/
        
   /* $(".modal").on("hidden.bs.modal", function(){
        $("#pintaestudios").html("");
        $("#nombresala").html("");
        $("#nombresaladoc").html("");
        $("#pintdoctores").html("");
    });*/
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
            //alert("nombre "+ ui.item.value+"id "+ui.item.correoPersonal)
            
             $("#idProve").val(ui.item.idProveedor);
            /*$("#DirecP").val(ui.item.direccion);
            $("#poblaP").val(ui.item.poblacion);
            $("#coloniaP").val(ui.item.colonia);
            $("#coPotal").val(ui.item.codigo_postal);
            $("#rfcP").val(ui.item.reg_fed_cau);
            $("#contactoP").val(ui.item.nombreContacto);
            $("#telefonoP").val(ui.item.telefonoUno);*/
            muestraarrt();
          }
      });
  }

function myFunction() {
 var str =$("#motivo").val();
 var res = str.toUpperCase();
  $("#motivo").val(res);

  var str =$("#NombreArt").val();
 var res = str.toUpperCase();
  $("#NombreArt").val(res);

  var str =$("#UnidadArt").val();
 var res = str.toUpperCase();
  $("#UnidadArt").val(res);

  var str =$("#importeArt").val();
 var res = str.toUpperCase();
  $("#importeArt").val(res);
}

  
    
  </script>
 <!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->
  <script src="http://localhost/CDI/Panel/content/js/funcionesSalida.js"></script>
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