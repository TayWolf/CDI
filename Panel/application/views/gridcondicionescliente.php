<?php 
  include "header.php";
  $id = $_REQUEST['id'];
 ?>

<script src="http://localhost/CDI/Panel/content/js/altacondiciones.js"></script>

<section style="margin-left: 15px;" id="alta" class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <a href="http://localhost/CDI/Panel/index.php/Crudclientes">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                            <input type="hidden" name="idu" id="idu" value="1">
                            <h2>
                               Registra las condiciones pertenecientes al cliente
                            </h2>
                            
                        </div>
                        
                            <form id="form"  method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo "$id" ?>">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                            
                                            <div class="body">
                                               
                                                <h2 class="card-inside-title"></h2>
                                                 <div class="row clearfix">
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="number" class="form-control" id="descuento" name="descuento" required>
                                                                <label class="form-label">Porcentaje de descuento  </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="number" class="form-control" id="diascredito" name="diascredito" required>
                                                                <label class="form-label">Días de Crédito </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="credito" id="credito"  required>
                                                                <label class="form-label">Creditos</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">                                                      
                                                        <input type="checkbox" name="estadoc" id="estadoc" class="filled-in chk-col-light-blue" onchange="cambiaCheck();" value="2" />
                                                        <label for="estadoc">Generar Estado de Cuenta</label>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="vales" id="vales"  required>
                                                                <label class="form-label">Control de Vales</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="catalogo" id="catalogo"  required>
                                                                <label class="form-label">Catálogo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <select class="form-control" name="fpago" id="fpago" required>    <option value="">Seleccione una Forma de Pago</option>
                                                                    <option value="1">Tarjeta</option>
                                                                    <option value="2">Efectivo</option>
                                                                    <option value="3">Vales</option>
                                                                         <!-- <?php   
                                                                            // $idconteo=0;
                                                                            // foreach ($estado as $row) {
                                                                            //       $idEdo=$row['id_Estado'];
                                                                            //       $nombreEstado=$row['nombreEstado'];
                                                                            //       //$idconteo++; .
                                                                            //      echo "
                                                                            //      <option value='$idEdo'>$nombreEstado</option>
                                                                            //      ";
                                                                            // }
                                                                         ?> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="cuenta" id="cuenta"  required>
                                                                <label class="form-label">Cuenta</label>
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
            <!-- Input -->
            
        </div>
</section>



<?php 
  include "footer.php";
 ?>