<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/detallecliente.js"></script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <a href="http://localhost/CDI/Panel/index.php/Crudclientes">
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
                               Detalle del cliente
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="http://localhost/CDI/Panel/index.php/Crudclientes/altaClientes">Registrar nuevo cliente</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                           
                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Nombre del cliente</label>
                                            <input type="hidden" id="idC" name="idC" value="<?php $idC=$_REQUEST['id']; echo "$idC"; ?>">
                                            <input type="text" name="nombreCliente" id="nombreCliente" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="row clearfix">
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Clave</label>
                                            <input type="text" name="claveCl" id="claveCl"  class="form-control" readonly />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>RFC</label>
                                            <input type="text" class="form-control" name="rfcCliente" id="rfcCliente" readonly />
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Teléfono</label>
                                            <input type="text" class="form-control" name="telClien" id="telClien" readonly />
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="row clearfix">
                                 <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line focused">
                                            <label>Dirección</label>
                                            <input type="text" name="direccionCli" id="direccionCli" class="form-control"  readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line focused ">
                                            <label>Estado</label>
                                            <input type="text" class="form-control" name="estadoClien" id="estadoClien" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Municipio</label>
                                            <input type="text" name="municipioCli" id="municipioCli" class="form-control" readonly  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>Colonia</label>
                                            <input type="text" name="coloniaClien" id="coloniaClien" class="form-control"  readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line disabled focused">
                                            <label>C.P</label>
                                            <input type="text" name="codigoPo" id="codigoPo" class="form-control"  readonly />
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