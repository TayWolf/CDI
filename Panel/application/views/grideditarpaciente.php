<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/modificarpaciente.js"></script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <a href="http://localhost/CDI/Panel/index.php/Crudpacientes">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                    <div class="header">
                            <h2>
                               Modificar paciente
                            </h2>
                            
                        </div>
                        
                            <form id="form"  method="post">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="body">
                                            <h2 class="card-inside-title"></h2>
                                                <div class="row clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control" id="clave" name="clave" required readonly>
                                                                <input type="hidden" id="idP" name="idP" value="<?php $idP=$_REQUEST['id']; echo "$idP"; ?>">
                                                                <label class="form-label">Clave</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                                                <label class="form-label">Nombre del paciente</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-md-4">
<!--                                                         <p> 
                                                           <b>Género</b>
                                                        </p> -->
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <select class="form-control" class="form-control" name="genero" id="genero" required>    
                                                                        <option value="">Seleccione un género</option>
                                                                        <option value="1">Masculino</option>
                                                                        <option value="2">Femenino</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control" id="correo" name="correo" required>
                                                                <label class="form-label">Correo</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                                                                <label class="form-label">Teléfono</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="date" class="form-control" name="fechanaci" id="fechanaci"  required>
                                                                <label class="form-label">Fecha de Nacimiento</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="number" class="form-control" name="edad" id="edad" required>
                                                                <label class="form-label">Edad</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <p> 
                                                           <b>Médico Remitente</b>
                                                        </p>
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <select class="form-control" class="form-control" name="remitente" id="remitente"  required>    
                                                                        <option value="">Seleccione un Médico Remitente</option>
                                                                         <?php   
                                                                            $idconteo=0;
                                                                            foreach ($medico as $row) {
                                                                                 
                                                                                  $idRemitente=$row['idRemitente'];
                                                                                  $nombreRem=$row['nombreRem'];
                                                                                  //$idconteo++; .
                                                                                 echo "
                                                                                 <option value='$idRemitente'>$nombreRem</option>
                                                                                 ";
                                                                            }
                                                                         ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p> 
                                                           <b>Cliente</b>
                                                        </p>
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <select class="form-control" class="form-control" name="cliente" id="cliente" required>    
                                                                        <option value="">Seleccione un Cliente</option>
                                                                         <?php   
                                                                            $idconteo=0;
                                                                            foreach ($cliente as $row) {
                                                                                 
                                                                                  $idCliente=$row['idCliente'];
                                                                                  $nombreCliente=$row['nombreCliente'];
                                                                                  //$idconteo++; .
                                                                                 echo "
                                                                                 <option value='$idCliente'>$nombreCliente</option>
                                                                                 ";
                                                                            }
                                                                         ?>
                                                                </select>
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