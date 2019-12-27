<?php 
  include "header.php";
  $idRem=$this->session->userdata('idRemitente');
 ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="http://localhost/CDI/Panel/index.php/Crudremitentes">
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
                                DETALLE DEL MÉDICO REMITENTE
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
                        <!-- <form id="form" method="post" enctype="multipart/form-data"> -->
                            <div class="body">
                                <input type="hidden" name="idR" id="idR" value="<?php echo "$idRem"; ?>">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <h6>Nombre del Médico Remitente</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="nombre" name="nombre" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h6>Especialidad</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input type="text" id="especialidad" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <h6>Clave</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="clave" name="clave" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Fecha Nacimiento</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="fecha" name="fecha" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <h6>Telefono Uno</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="teluno" name="teluno" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Telefono Dos</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="teldos" name="teldos" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Correo</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="correo" name="correo" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <h6>Estado</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="estado" name="estado" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Ciudad</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="ciudad" name="ciudad" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Colonia</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="colonia" name="colonia" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-md-4">
                                        <h6>Calle</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="calle" name="calle" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Código Postal</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="cp" name="cp" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Control Ordenes Médicas</h6>
                                        <div class="form-group">
                                            <div class="form-line focused">
                                                <input id="control" name="control" type="text" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
            <!-- #END# Multi Column -->
        </div>
    </section>



<script src="http://localhost/CDI/Panel/content/js/detalleremitente.js"></script>

<?php 
  include "footer.php";
?>