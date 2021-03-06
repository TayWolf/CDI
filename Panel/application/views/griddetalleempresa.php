<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/detalleempresa.js"></script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <a href="http://localhost/CDI/Panel/index.php/Crudempresas">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Detalle de la empresa
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="http://localhost/CDI/Panel/index.php/Crudempresas/altaEmpresa">Registrar nueva empresa</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                           
                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Nombre Empresa</label>
                                            <input type="hidden" id="idE" name="idE" value="<?php $idE=$_REQUEST['id']; echo "$idE"; ?>">
                                            <input type="text" name="nombreEmp" id="nombreEmp" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>RFC</label>
                                            <input type="text" name="rfcEmpresa" id="rfcEmpresa"  class="form-control" readonly />
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line focused">
                                            <label>Dirección</label>
                                            <input type="text" name="direccionE" id="direccionE" class="form-control"  readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Colonia</label>
                                            <input type="text" class="form-control" name="coloniaempre" id="coloniaempre" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line focused ">
                                            <label>Estado</label>
                                            <input type="text" class="form-control" name="estadoEm" id="estadoEm" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Teléfono</label>
                                            <input type="text" name="telefonoEmp" id="telefonoEmp" class="form-control" readonly  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Nombre del Contacto</label>
                                            <input type="text" name="nombreContact" id="nombreContact" class="form-control"  readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<?php 
  include "footer.php";
 ?>