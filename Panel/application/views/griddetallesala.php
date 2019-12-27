<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/detallesala.js"></script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                 <a href="http://localhost/CDI/Panel/index.php/Crudsalas">
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
                               Detalle de la sala
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="http://localhost/CDI/Panel/index.php/Crudsalas/altaSala">Registrar nueva sala</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                           
                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-line focused ">
                                                                <label>Nombre de la sala</label>
                                                                <input type="text" class="form-control" name="nombreSala" id="nombreSala"  />
                                                                <input type="hidden" id="idS" name="idS" value="<?php $idS=$_REQUEST['id']; echo "$idS"; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-line disabled focused">
                                                                <label>Tipo</label>
                                                                <input type="text" name="tipoSala" id="tipoSala" class="form-control"   />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-line disabled focused">
                                                                <label>Clave</label>
                                                                <input type="text" name="claveSala" id="claveSala" class="form-control"   />
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