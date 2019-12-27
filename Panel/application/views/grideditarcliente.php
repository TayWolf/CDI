<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/modificarcliente.js"></script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
               <a href="http://localhost/CDI/Panel/index.php/Crudclientes">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                            <form id="form"  method="post">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                            <div class="header">
                                                 <h2>
                                                   Modifique los datos del cliente
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
                                                                <input type="text" name="nombreCliente" id="nombreCliente" class="form-control" >
                                                                <input type="hidden" id="idC" name="idC" value="<?php $idC=$_REQUEST['id']; echo "$idC"; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-line disabled focused">
                                                                <label>Clave</label>
                                                                <input type="text" name="claveCl" id="claveCl"  class="form-control"  />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-line focused">
                                                                <label>RFC</label>
                                                                <input type="text" name="rfcCliente" id="rfcCliente" class="form-control"   />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-line disabled focused">
                                                                <label>Teléfono</label>
                                                                <input type="text" class="form-control" name="telClien" id="telClien"  />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <div class="form-line focused ">
                                                                <label>Direccíon</label>
                                                                <input type="text" class="form-control" name="direccionCli" id="direccionCli"  />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-3">
                                                        <p> 
                                                           <b>Estado</b>
                                                        </p>
                                                        <div class="form-group">
                                                            <div class="form-line focused ">
                                                            <input type="hidden" name="hiddenedo" id="hiddenedo">
                                                            <input type="hidden" name="hiddenmuni" id="hiddenmuni">
                                                            <input type="hidden" name="hiddencolo" id="hiddencolo">
                                                                <select class="form-control" onchange="trarMunicipio();" name="estadoClien" id="estadoClien"  required>    
                                                                        <option value="">Seleccione un estado</option>
                                                                         <?php   
                                                                            $idconteo=0;
                                                                            foreach ($estado as $row) {
                                                                                 
                                                                                  $idEdo=$row['id_Estado'];
                                                                                  $nombreEstado=$row['nombreEstado'];
                                                                                  //$idconteo++; .
                                                                                 echo "
                                                                                 <option value='$idEdo'>$nombreEstado</option>
                                                                                 ";
                                                                            }
                                                                         ?>
                                                                </select>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <p> 
                                                            <b> Municipio</b>
                                                        </p>
                                                        <div class="form-group">
                                                            <div class="form-line disabled focused">
                                                               <select onchange="traerColonia();" class="form-control" name="municipioCli" id="municipioCli"  required>    
                                                                                                                                                   
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <p> 
                                                            <b> Colonia</b>
                                                        </p>
                                                        <div class="form-group">
                                                            <div class="form-line disabled focused">
                                                                <select class="form-control" onchange="traerPostal();" name="coloniaCl" id="coloniaCl"  required> 
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">

                                                        <div class="form-group">
                                                            <div class="form-line disabled focused">
                                                                <label>C.P</label>
                                                                <input type="text" name="codigoPo" id="codigoPo" class="form-control"   />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                <div class="row clearfix">
                                                    <div align="center">
                                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Modificar</button>
                                                        <div id="cargando"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                </div>
                            </form>
                        
                    </div>
                </div>
            </div>
            <!-- Input -->
            
        </div>
</section>

<?php 
  include "footer.php";
 ?>