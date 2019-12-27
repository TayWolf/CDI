<?php 
  include "header.php";
  $idUser=$this->session->userdata('idusuario');
 ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="http://localhost/CDI/Panel/index.php/Crudusuarios">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
                <!-- <h2>FORM EXAMPLES</h2> -->
            </div>
            <!-- Multi Column -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            
                            <h2>
                                EDICIÓN DEL USUARIO
                            </h2>
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
                        
                        <form id="form" method="post" enctype="multipart/form-data">
                            <div class="body">
                                <input type="hidden" name="fotoInicial" id="fotoInicial">
                                <input type="hidden" name="idu" id="idu" value="<?php echo "$idUser"; ?>">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <h6>Nombre</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="nombre" name="nombre" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h6>Tipo de Usuario</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <select id="tipo" name="tipo" style="width: 100%;border: none;margin-top: 14px;">
                                                    <option value="">Elija una opcion</option>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Empleado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <h6>Correo</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="correo" name="correo" type="email" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Contraseña</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <div class="col-md-10">
                                                    <input id="password" name="password" type="password" class="form-control">
                                                </div>
                                                <a style="cursor: pointer;" onmouseover="muestrapass();" onmouseout="ocultapass();">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Foto de Usuario</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input name="foto" type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div align="center">
                                            <button class="btn btn-primary m-t-15 waves-effect">MODIFICAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Multi Column -->
        </div>
    </section>

<script src="http://localhost/CDI/Panel/content/js/traedatosusuario.js"></script>
<script src="http://localhost/CDI/Panel/content/js/editausuario.js"></script>

<?php 
  include "footer.php";
?>