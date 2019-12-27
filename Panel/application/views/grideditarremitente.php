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
                                EDICIÓN DEL MÉDICO REMITENTE
                            </h2>
                        </div>
                        
                        <form id="form" method="post" enctype="multipart/form-data">
                            <div class="body">
                                <input type="hidden" name="idR" id="idR" value="<?php echo "$idRem"; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label>Nombre Médico Remitente</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label>Especialidad</label>
                                                <input type="text" class="form-control" name="especialidad" id="especialidad" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label>Clave</label>
                                                <input type="text" class="form-control" name="clave" id="clave" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label>Fecha Nacimiento</label>
                                                <input type="date" class="form-control" name="fecha" id="fecha" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label>Teléfono 1</label>
                                                <input type="number" class="form-control" name="teluno" id="teluno" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label>Teléfono 2</label>
                                                <input type="number" class="form-control" name="teldos" id="teldos" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label>Correo</label>
                                                <input type="email" class="form-control" name="correo" id="correo" required>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label class="col-md-12" style="margin-bottom: 5px; padding: 0px">Estado</label>
                                                <select id="estado" name="estado" onchange="traeMunicipio();" style="width: 100%; border: none;">
                                                    <option value="">Estado</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="hidden" name="ciudadhidden" id="ciudadhidden">
                                        <input type="hidden" name="coloniahidden" id="coloniahidden">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label class="col-md-12" style="margin-bottom: 5px; padding: 0px">Ciudad / Municipio</label>
                                                <select id="ciudad" name="ciudad" onchange="traeRegion();" style="width: 100%; border: none;">
                                                    <option value="">Ciudad/Municipio</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label class="col-md-12" style="margin-bottom: 5px; padding: 0px">Colonia / Región</label>
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
                                            <div class="form-line focused">
                                                <label>Calle</label>
                                                <input type="text" class="form-control" name="calle" id="calle" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="checkbox" id="md_checkbox_23" class="filled-in chk-col-purple" name="control" value="2" onchange="cambiacheck();" />
                                        <label for="md_checkbox_23">Control Ordenes Médicas</label>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div align="center">
                                        <button class="btn btn-primary m-t-15 waves-effect">GUARDAR</button>
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

<!-- <script src="http://localhost/CDI/Panel/content/js/traedatosusuario.js"></script> -->
<script src="http://localhost/CDI/Panel/content/js/modificaremitente.js"></script>

<?php 
  include "footer.php";
?>