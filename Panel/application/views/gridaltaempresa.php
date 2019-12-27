<?php 
  include "header.php";
 ?>
<script type="text/javascript">
     $(function(){
  $("#form").on("submit", function(e){ 
alert("entra");      
            });
   });
</script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <a href="http://localhost/CDI/Panel/index.php/Crudempresas">
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
                               Registrar nueva Empresa
                            </h2>
                            
                        </div>
                        
                            <form id="form"  method="post">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                            
                                            <div class="body">
                                               
                                                <h2 class="card-inside-title"></h2>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                                                <label class="form-label">Nombre de la empresa</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="rfcEmpresa" id="rfcEmpresa"  required>
                                                                <label class="form-label">RFC</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="direccionE" id="direccionE"  required>
                                                                <label class="form-label">Dirección</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="coloniaempre" id="coloniaempre"  required>
                                                                <label class="form-label">Colonia</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                   
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="estadoEm" id="estadoEm"  required>
                                                                <label class="form-label">Estado</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="telefonoEmp" id="telefonoEmp"  required>
                                                                <label class="form-label">teléfono </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="nombreContact" id="nombreContact"  required>
                                                                <label class="form-label">Nombre del Contacto</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                 
                                                <div class="row clearfix">
                                                    <div align="center">
                                                        <input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Aceptar">
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