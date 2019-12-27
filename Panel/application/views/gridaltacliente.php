<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/altacliente.js"></script>
<section class="content">
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
                               Registrar nuevo cliente
                            </h2>
                            
                        </div>
                        
                            <form id="form"  method="post">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                            
                                            <div class="body">
                                               
                                                <h2 class="card-inside-title"></h2>
                                                 <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" id="nombrecliente" name="nombrecliente" required>
                                                                <label class="form-label">Nombre del cliente  </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" id="clave" name="clave" required>
                                                                <label class="form-label">Clave  </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="rfcCliente" id="rfcCliente"  required>
                                                                <label class="form-label">RFC</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="teleCliente" id="teleCliente"  required>
                                                                <label class="form-label">Teléfono</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="direccionC" id="direccionC"  required>
                                                                <label class="form-label">Dirección</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                                                                     
                                                                                                       
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-3">
                                                        <p> 
                                                           <b>Estado</b>
                                                        </p>
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <select class="form-control" class="form-control" onchange="trarMunicipio();" name="estado" id="estado"  required>    
                                                                        <option value="">Seleccione un estado</option>
                                                                         <?php   
                                                                            $idconteo=0;
                                                                            foreach ($estado as $row) {
                                                                                 
                                                                                  $idEdo=$row['id_Estado'];
                                                                                  $nombreEstado=$row['nombreEstado'];
                                                                                  //$idconteo++; .
                                                                                 echo "
                                                                                 <option value='$idEdo'>$nombreEstado</option>
                                                                                 ";
                                                                            }
                                                                         ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="datos" style="display: none">
 
                                                        <div class="col-sm-3">
                                                            <p> 
                                                               <b> Municipio</b>
                                                            </p>
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    
                                                                    <select class="form-control" onchange="traerColonia();" class="form-control" name="municipio" id="municipio"  required>    
                                                                                                                                                   
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <p> 
                                                               <b> Colonia</b>
                                                            </p>
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select class="form-control" onchange="traerPostal();" name="coloniaCl" id="coloniaCl"  required> 
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="col-sm-3">
                                                             <p> 
                                                               <b> C.P</b>
                                                            </p>
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select class="form-control" name="codigoP" id="codigoP"  required>    
                                                                    </select>
                                                                    
                                                                     
                                                                </div>
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