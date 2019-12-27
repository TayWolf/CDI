<?php 
    include "header.php"
?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="http://localhost/CDI/Panel/index.php/CrudContrasena">
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
                            <h2>REGISTRO DE NUEVA CONTRASEÑA</h2>
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
                            <form id="form_validation" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="nombre" required>
                                                <label class="form-label">Nombre completo</label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div id="linea" class="form-line" onclick="darcolor();">
                                                <input type="email" class="form-control" name="correo" id="correo" required>
                                                <label class="form-label">Correo electrónico</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                                <div class="col-md-11">
                                                    <div class="form-line">
                                                        <input type="password" class="form-control" id="password" name="password" required>
                                                        <label class="form-label">Contraseña</label>
                                                    </div>
                                                </div>
                                                <a id="mostrar" style="cursor: pointer;" onmouseover="muestrapass();" onmouseout="ocultapass();">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="file" class="form-control" name="foto" >
                                                <!-- <label class="form-label">Confimación de contraseña</label> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                


                                <div class="row clearfix">
                                    <div align="center">
                                        <button class="btn btn-primary m-t-15 waves-effect">GUARDAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>
<script src="http://localhost/CDI/Panel/content/js/altausuario.js"></script>
<?php
  include "footer.php";
?>