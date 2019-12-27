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

    .table tr{

        white-space:nowrap;
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
                                    Estudio por sala
                                  </h2>
                                </div>     
                              </div>
                            </div>
                            
                            <!-- <form method="post" action="" id="form"> -->
                            <div class="body">
                              <div class="row clearfix">
                                <div class="col-md-3" style="margin-bottom: 0px;">
                                    <p>
                                        <b>Área</b>
                                    </p>
                                    <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                        <span class="input-group-addon">
                                          <i class="material-icons">credit_card</i>
                                        </span>
                                        <div class="form-line">
                                            <select class="form-control" onchange="getlistado();" id="areaSele" name="areaSele" required>
                                              <option value="">Seleccione un opción</option>
                                              <?php 
                                              foreach ($areas as $row) {
                                                $idArea=$row["idSala"];
                                                $nombreArea=$row["nombre"];
                                                echo "<option value='$idArea'>$nombreArea</option>";
                                              }
                                               ?>
                                            </select>
                                            
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3" style="margin-bottom: 0px;">
                                    <p>
                                        <b>Fecha Inicial</b>
                                    </p>
                                    <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="date" id="fechaconsu" name="fechaconsu" onchange="getlistado();" class="form-control">
                                            
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3" style="margin-bottom: 0px;">
                                    <p>
                                        <b>Fecha Final</b>
                                    </p>
                                    <div class="input-group input-group-lg" style="margin-bottom: 0px;">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="date" id="fechaconsuFinal" name="fechaconsuFinal" onchange="getlistado();" class="form-control">
                                            
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3" style="margin-bottom: 0px;">
                                    <p>
                                        <b>Doctor</b>
                                    </p>
                                    <div class="input-group input-group-lg" style="margin-bottom: 0px;">

                                        <div class="form-line">
                                            <input type="text" id="doctorName" onkeyup="myFunction()" name="doctorName"  onchange="getlistado();" class="form-control"  >
                                            
                                        </div>
                                    </div>
                                  </div>
                              </div>  
                            
                      <!--   </form>  -->
                        
                        
                        
                        
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Hora</th>
                                            <th>Fecha</th>
                                            <th>Sala</th>
                                            <th>Estudio</th>
                                            <th>Paciente</th>
                                            <th>Edad</th>
                                            <th>Comentario</th>
                                            <th>Confirmado</th>
                                            <th>Doctor</th>
                                            <th>Atendido</th>
                                            <th>Hora</th>
                                            <th>Diagnostico</th>
                                            <th>Salio</th>
                                            <th>Doctor Envia</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Hora</th>
                                            <th>Fecha</th>
                                            <th>Sala</th>
                                            <th>Estudio</th>
                                            <th>Paciente</th>
                                            <th>Edad</th>
                                            <th>Comentario</th>
                                            <th>Confirmado</th>
                                            <th>Doctor</th>
                                            <th>Atendido</th>
                                            <th>Hora</th>
                                            <th>Diagnostico</th>
                                            <th>Salio</th>
                                            <th>Doctor Envia</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="listado">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
 
 <!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->

  <script src="http://localhost/CDI/Panel/content/js/funcionesestudioporsala.js"></script>
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
    
     <script type="text/javascript">
   function myFunction() {
 // var str = "ssss";
 var str =$("#doctorName").val();
  var res = str.toUpperCase();
  //document.getElementById("datos").innerHTML = res;
  $("#doctorName").val(res);
}

  </script>
    
<!-- <?php 
  //include "footer.php";
 ?> -->