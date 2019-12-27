<?php 
  include "header.php";
  $id = $_REQUEST['id'];
 ?>

<script src="http://localhost/CDI/Panel/content/js/traecondiciones.js"></script>

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
                               Condiciones del Cliente
                            </h2>
                            
                        </div>
                            
                            <form id="form"  method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo "$id" ?>"> 
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                            
                                            <div class="body">
                                            <?php
                                                foreach($condicion as $row)
                                                {
                                                    $descuento=$row['descuento'];
                                                    $diasCredito=$row['diasCredito'];
                                                    $creditos=$row['creditos'];
                                                    $estadoCuenta=$row['estadoCuenta'];
                                                    $controldeVales=$row['controldeVales'];
                                                    $catalogo=$row['Catalogo'];
                                                    $formaPago=$row['formaPago'];
                                                    $cuenta=$row['cuenta'];
                                                    $cliente=$row['cliente'];
                                                    break;
                                                }

                                            ?>   
                                                <h2 class="card-inside-title"></h2>
                                                 <div class="row clearfix">
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="number" class="form-control" id="descuento" name="descuento" value=<?php echo "\"$descuento\"";?> required>
                                                                <label class="form-label">Porcentaje de descuento  </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="number" class="form-control" id="diascredito" name="diascredito" value=<?php
                                                                echo "\"$diasCredito\"";?> required>
                                                                <label class="form-label">Días de Crédito </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control" name="credito" id="credito" value=<?php
                                                                echo "\"$creditos\"";?> required>
                                                                <label class="form-label">Créditos</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">                                                      
                                                        <input type="checkbox" name="estadoc" id="estadoc" class="filled-in chk-col-light-blue" <?php
                                                            if($estadoCuenta==1)
                                                            {
                                                                echo "checked";
                                                            }
                                                        ?>/>
                                                        <label for="estadoc">Generar Estado de Cuenta</label>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control" name="vales" id="vales" value=<?php
                                                                echo "\"$controldeVales\"";?> required>
                                                                <label class="form-label">Control de Vales</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control" name="catalogo" id="catalogo" value=<?php
                                                                echo "\"$catalogo\"";?> required>
                                                                <label class="form-label">Catálogo</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <select class="form-control" name="fpago" id="fpago" required>    <option value="">Seleccione una Forma de Pago</option>
                                                                    
                                                                    <option value="1" <?php if($formaPago==1) echo "selected";?>>Tarjeta</option>
                                                                    <option value="2" <?php if($formaPago==2) echo "selected";?>>Efectivo</option>
                                                                    <option value="3" <?php if($formaPago==3) echo "selected";?>>Vales</option>';
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
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control" name="cuenta" id="cuenta" value=<?php echo "\"$cuenta\"";?> required>
                                                                <label class="form-label">Cuenta</label>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </div>
                                                 
                                                <div class="row clearfix">
                                                    <div align="center">
                                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Modificar</button>
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