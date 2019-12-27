<?php 
  include "header.php";
 ?>
 <script type="text/javascript">
   $(function(){
  $("#form").on("submit", function(e){
    var qq = $('#form').serialize()
    //var formData = new FormData(document.getElementById("form"));
  // alert("datos"+qq);
    var url;
    var total = $("#tot").val();
    $('#cargando').html('<img src="https://cointic.com.mx/IntraNet/Admin/assets/images/loading.gif"/>');
   //url : "http://localhost/CDI/Panel/index.php/Crudordencompra/agregaOrdenc/"+total;
   url= "<?php echo 'http://localhost/CDI/Panel/index.php/Crudordencompra/agregaOrdenc/';?>"+total;
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("form"));
    
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
                  
                    swal({
                  title: "Éxito",
                  text: "Orden de compra registrada exitosamente.",
                  type: "success",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Imprimir PDF",
                  cancelButtonText: "Cerrar",
                  closeOnConfirm: false,
                  closeOnCancel: false
                },
                function(isConfirm) {
                  if (isConfirm) {
                    //swal("Desea imprimir PDF!","", "success");
                    mipopup=window.open("http://localhost/CDI/Panel/gridpdfpedidos.php?idCompra="+res," neo","width=900,height=600,menubar=si");

                  } else {
                    //swal("Cancelled", "Your imaginary file is safe :)", "error");
                    location.href='http://localhost/CDI/Panel/index.php/Crudordencompra';
                  }
                });
                 
                });

    });
 });
  
 </script>

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

<form method="post" action="" id="form"   enctype="multipart/form-data">

    <div class="container-fluid">
      
        <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header" style="background-color: #293a4a;">
                              <div class="row">
                                <div class="col-md-5">
                                  <h2 style="margin-top: 10px;color:#fff;">
                                    Orden de compra
                                  </h2>
                                </div>
                               
                              </div>
                            </div>
                            
                            <!-- <form method="post" action="" id="form"> -->
                            <div class="body">
                            <div class="row clearfix">
                                  <div class="col-md-2">
                                      <div class="input-group">
                                          <p>
                                            <b>Fecha de Emisión</b>
                                          </p>
                                          <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                          
                                            <div class="form-line">
                                                <input type="date" name="fechaemi"  class="form-control date" id="fechaemi" value="<?php echo date('Y-m-d'); ?>">
                                                <input type="hidden" name="Solifecemi" id="Solifecemi" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                    <div class="col-md-2">
                                        <p>
                                          <b>No. orden de compra</b>
                                        </p>
                                        
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">format_list_numbered</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="noEm" name="noEm" class="form-control"  readonly>
                                                <input type="hidden" id="noEmisi" name="noEmisi">
                                                 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <p>
                                            <b>Proveedor</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="ProveNombre" onkeypress="provGetBu();" onkeyup="form.ProveNombre.value=form.ProveNombre.value.toUpperCase();"  name="ProveNombre" class="form-control" placeholder="Nombre del proveedor" required>
                                                <input type="hidden" name="idProve" id="idProve">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                          <p>
                                            <b>Fecha de Pedido</b>
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
                                      <div class="input-group">
                                          <p>
                                            <b>Fecha de Entrega</b>
                                          </p>
                                          <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                          
                                            <div class="form-line">
                                                <input type="date" name="fechaEntrega"  class="form-control date" id="fechaEntrega" value="<?php echo date('Y-m-d'); ?>">
                                                <input type="hidden" name="SolifecEntrega" id="SolifecEntrega" value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                          </div>
                                      </div>
                                      <?php foreach ($total as $row) {
                                        $totalRe=$row["idArticulo"];
                                      } 
                                      echo "
                                      <input type='hidden' id='tot' name='tot' value='$totalRe'>";
                                        ?>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-md-offset-4">
                                        <div class="button-demo">
                                          <!-- <input type="button" onClick="agregarArticuloLista();" class="btn bg-black waves-effect waves-light" value="Agregar"> -->
                                          <input type="button" data-toggle="modal" data-target="#myModal" class="btn bg-black waves-effect waves-light" onclick="listaArticu();" value="Generar Orden de compra">
                                          
                                      </div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="button-demo">
                                          <!-- <input type="button" onClick="agregarArticuloLista();" class="btn bg-black waves-effect waves-light" value="Agregar"> -->
                                          <input type="button" data-toggle="modal" data-target="#myModal2"  class="btn bg-black waves-effect waves-light" onclick="listaOrden();" value="Consultar Orden de Compra">
                                          
                                      </div>
                                    </div>
                            </div>
                           
                            
                            <div id="muestraProve" style="display: block;">
                                <!-- <div class="row clearfix">
                                       <div class="header" style="background-color: #293a4a;padding-bottom: 30px;">
                                            <div class="col-md-5">
                                              <h2 style=";color:#fff;">
                                                Datos de la salida
                                              </h2>
                                            </div>
                                        </div>
                                </div> -->
                                

                                

                                <div class="modal fade" id="myModal2" role="dialog">
                                  <div class="modal-dialog">
                                  
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                      </div>
                                      <div class="modal-body">
                                        
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h2>
                                                            Ordenes de compra
                                                        </h2>
                                                      
                                                    </div>
                                                    <div class="row" style="margin-left: 0px;margin-right: 0px;padding-top: 20px;">
                                                      <div class="col-md-6">
                                                        <p>
                                                          <b>Fecha Inicial</b>
                                                        </p>
                                                        <div class="input-group">
                                                            <div class="form-line">
                                                              <input type="date" class="form-control date"  id="feIni" name="feIni" onchange="filtroListorden();">
                                                            </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <p>
                                                            <b>Fecha Inicial</b>
                                                         </p>
                                                         <div class="input-group">
                                                            <div class="form-line">
                                                                <input type="date" class="form-control date"  id="feFin" name="feFin" onchange="filtroListorden();">
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>   
                                                    
                                                    <div class="body table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    
                                                                    <th>Fecha emitida</th>
                                                                    <th>Detalle</th>
                                                                    <th>Editar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="listaOrden">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      
                                          <div class="modal-footer">
                                            <input type="button"  class="btn btn-default"  data-dismiss="modal" value="Cerrar">
                                          </div>
                                     
                                      
                                    </div>
                                    
                                  </div>
                                </div>
                                <div class="modal fade" id="myModal" role="dialog">
                                  <div class="modal-dialog">
                                  
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                      </div>
                                      <div class="modal-body">
                                        
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h2>
                                                            Artículos agotados
                                                            <small>Selecciones los artículos para generar orden de compra</small>
                                                        </h2>
                                                        
                                                    </div>
                                                    <div class="body table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    
                                                                    <th>Artículo</th>
                                                                    <th>Seleccione</th>
                                                                    <th>Cantidad</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="listaAr">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div id="bot" style="display: none">
                                          <div class="modal-footer">
                                            <input type="submit"  class="btn btn-default"  value="Aceptar">
                                          </div>
                                      </div>
                                      
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
  </form>

  <div class="modal fade" id="myModal3" role="dialog">
                                  <div class="modal-dialog">
                                  
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        
                                      </div>
                                      <div class="modal-body">
                                        
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <h2>
                                                            Artículos agotados
                                                            <small>Selecciones los artículos para generar orden de compra</small>
                                                        </h2>
                                                        
                                                    </div>
                                                    <div class="body table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    
                                                                    <th>Artículo</th>
                                                                    <th>Seleccione</th>
                                                                    <th>Cantidad</th>
                                                                    <input type="hidden" id="idComprrr" name="idComprrr">
                                                                </tr>
                                                            </thead>
                                                            <tbody id="listaArEdit">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      
                                          <div class="modal-footer">
                                            <input type="button"  onclick="guardarCambios()" class="btn btn-default"  value="Aceptar">
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
          
            url:"http://localhost/CDI/Panel/index.php/Crudordencompra/buscarNombreProved/",
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
           // muestraarrt();
          }
      });
  }

  
    
  </script>
 <!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->
  <script src="http://localhost/CDI/Panel/content/js/funcionesordencompra.js"></script>
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