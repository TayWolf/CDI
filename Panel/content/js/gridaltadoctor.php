<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/altadoctor.js"></script>

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <a href="http://localhost/CDI/Panel/index.php/Cruddoctores">
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
                               Registrar nuevo Doctor
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
                                                                <label class="form-label">Nombre del Doctor</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="clave" id="clave"  required>
                                                                <label class="form-label">Clave</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="date" class="form-control" name="fecha" id="fecha"  required>
                                                                <label class="form-label">Fecha de Nacimiento</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="cedula" id="cedula">
                                                                <label class="form-label">Cedula</label>
                                                            </div>
                                                        </div>
                                                    </div>                                              
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="telefono" id="telefono">
                                                                <label class="form-label">Telefono</label>
                                                            </div>
                                                        </div>
                                                     <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="correo" id="correo">
                                                                <label class="form-label">Correo</label>
                                                            </div>
                                                        </div>
                                                    </div>                                              
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="universidad" id="universidad"  required>
                                                                <label class="form-label">Universidad</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="horario" id="horario"  required>
                                                                <label class="form-label">Horario</label>
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