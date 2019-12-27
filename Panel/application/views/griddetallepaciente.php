<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/detallepaciente.js"></script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <a href="http://localhost/CDI/Panel/index.php/Crudpacientes">
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
                               Detalle del Paciente
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="http://localhost/CDI/Panel/index.php/Crudpacientes/altaPacientes">Registrar nuevo paciente</a></li>
                                        
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
                                            <label>Clave</label>
                                            <input type="hidden" id="idP" name="idP" value="<?php $idP=$_REQUEST['id']; echo "$idP"; ?>">
                                            <input type="text" name="clave" id="clave" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Nombre del Paciente</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row clearfix">
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Género</label>
                                            <input type="text" name="genero" id="genero"  class="form-control" readonly />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Correo</label>
                                            <input type="text" class="form-control" name="correo" id="correo" readonly />
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Teléfono</label>
                                            <input type="text" class="form-control" name="telefono" id="telefono" readonly />
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line focused">
                                            <label>Fecha de Nacimiento</label>
                                            <input type="text" name="fecha" id="fecha" class="form-control"  readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line focused">
                                            <label>Edad</label>
                                            <input type="text" name="edad" id="edad" class="form-control"  readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line focused ">
                                            <label>Médico Remitente</label>
                                            <input type="text" class="form-control" name="remitente" id="remitente" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Cliente</label>
                                            <input type="text" name="cliente" id="cliente" class="form-control" readonly  />
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