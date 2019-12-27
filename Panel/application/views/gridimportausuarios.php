<?php 
    include "header.php"
?>
    <section class="content" style="margin-left: 15px;">
        <div class="container-fluid">
            <div class="block-header">
                <a href="http://localhost/CDI/Panel/index.php/Crudusuarios">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
                <!-- <h2>
                    FORM VALIDATION
                    <small>Taken from <a href="https://jqueryvalidation.org/" target="_blank">jqueryvalidation.org</a></small>
                </h2> -->
            </div>
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>ESTRUCTURA GENERAL DEL ARCHIVO EXCEL A IMPORTAR</h2>
                        </div>
                        <div class="body">
                                <div class="row">
                                    <div class="col-md-6" style="text-align: justify;">
                                      <span>Antes de importar tu archivo Excel ten en cuenta lo siguiente:<br>
                                        Las columnas de tu documento Excel deberán estructurarse como se indica a continuación
                                        <ul>
                                          <li>Columna A - Nombre del Usuario</li>
                                          <li>Columna B - Correo del Usuario</li>
                                          <li>Columna C - Contraseña del Usuario</li>
                                          <li>Columna D - Tipo de Usuario</li>
                                        </ul>
                                      </span>
                                    </div>
                                    <div class="col-md-6" style="text-align: justify;">
                                      <span>Indica el tipo de usuario que deseas registrar <br>
                                        En la columna D perteneciente al "Tipo de usuario" deberás...
                                        <ul>
                                          <li>Usar un 1 para dar permisos de Administrador</li>
                                          <li>Usar un 2 para dar permisos de Empleado</li>
                                        </ul>
                                      </span>
                                    </div>
                                    <div class="col-md-12" align="center">
                                      <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal" style="background: #293a4a; color:white;">Ver ejemplo</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>







        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>IMPORTAR USUARIOS</h2>
                            <!-- <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body">
                            <?php echo form_open_multipart('Crudimportarusuario/to_mysql'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                              <input type="file" class="form-control" name="excel" size="20" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="table" value="usuarios" />
                                    <input type="hidden" class="form-control" name="fields" value="nombreUser,correoUser,password,tipoUser" />
                                </div>
                                


                                <div class="row clearfix">
                                    <div align="center">
                                        <button class="btn btn-primary m-t-15 waves-effect" style="background: #293a4a;">IMPORTAR</button>
                                    </div>
                                </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Estructura básica del archivo</h4>
        </div>
        <div class="modal-body">
          <img src="http://localhost/CDI/Panel/content/images/ejemplo.png" style="width: 100%;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

<script src="http://localhost/CDI/Panel/content/js/altausuario.js"></script>
<?php
  include "footer.php";
?>