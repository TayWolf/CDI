<?php 
    include "header.php"
?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="http://localhost/CDI/Panel/index.php/Crudremitentes">
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
                            <h2>REGISTRO DE NUEVO MÉDICO REMITENTE</h2>
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
                                                <label class="form-label">Nombre Médico Remitente</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="especialidad" required>
                                                <label class="form-label">Especialidad</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="clave" required>
                                                <label class="form-label">Clave</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="fecha" required>
                                                <label class="form-label">Fecha Nacimiento</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="teluno" required>
                                                <label class="form-label">Teléfono 1</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="teldos" required>
                                                <label class="form-label">Teléfono 2</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email" class="form-control" name="correo" required>
                                                <label class="form-label">Correo</label>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select id="estado" name="estado" onchange="traeMunicipio();" style="width: 100%; border: none;">
                                                    <option value="">Estado</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select id="ciudad" name="ciudad" onchange="traeRegion();" style="width: 100%; border: none;">
                                                    <option value="">Ciudad/Municipio</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select id="colonia" name="colonia" style="width: 100%; border: none;">
                                                    <option value="">Colonia/Región</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="calle" required>
                                                <label class="form-label">Calle</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="checkbox" id="md_checkbox_23" class="filled-in chk-col-purple" name="control" onchange="cambiacheck();" value="2" />
                                        <label for="md_checkbox_23">Control Ordenes Médicas</label>
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
<script src="http://localhost/CDI/Panel/content/js/altaremitente.js"></script>
<?php
  include "footer.php";
?>