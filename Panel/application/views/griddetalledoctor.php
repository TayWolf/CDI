<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/detalledoctor.js"></script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <a href="http://localhost/CDI/Panel/index.php/Cruddoctores">
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
                               Detalle del Doctor
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="http://localhost/CDI/Panel/index.php/Cruddoctores/altaDoctor">Registrar nuevo Doctor</a></li>
                                        
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
                                            <label>Nombre Doctor</label>
                                            <input type="hidden" id="idD" name="idD" value="<?php $idD=$_REQUEST['id']; echo "$idD"; ?>">
                                            <input type="text" name="nombre" id="nombre" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Clave</label>
                                            <input type="text" name="clave" id="clave"  class="form-control" readonly />
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line focused">
                                            <label>Fecha de nacimiento</label>
                                            <input type="text" name="fecha" id="fecha" class="form-control"  readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Cedula</label>
                                            <input type="text" class="form-control" name="cedula" id="cedula" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line focused ">
                                            <label>Universidad</label>
                                            <input type="text" class="form-control" name="universidad" id="universidad" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Horario</label>
                                            <input type="text" name="horario" id="horario" class="form-control" readonly  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Status</label>
                                            <input type="text" name="status" id="status" class="form-control"  readonly />
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