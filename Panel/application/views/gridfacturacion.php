<?php 
  include "header.php";
 ?>
 <script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
<!--  <script src="http://localhost/CDI/Panel/content/js/modificarsala.js"></script> -->
 <script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
 <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altasalaestudio.js"></script>
<script src="http://localhost/CDI/Panel/content/js/traerId.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altaestudio.js"></script>
<section style="margin-left: 15px;" class="content">
    <div class="container-fluid">
        <div class="block-header">
                <?php 
                  include "footer.php";
                 ?>
        </div>
        <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                              <div class="row">
                                <div class="col-md-5">
                                  <h2 style="margin-top: 10px;">
                                    Facturación
                                  </h2>
                                  
                                </div>
                                
                              </div>
                            </div>

                            <div class="body">
                                <div class="row">
                                    <div class="col-sm-4">
                                         <p>
                                            <b>Empresa</b>
                                        </p>
                                        <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                                <select class="form-control" name="idEmpre" id="idEmpre" required>    
                                                    <option value="">Seleccione Empresa</option>
                                                        <?php   
                                                             $idconteo=0;
                                                            foreach ($empresas as $row) {
                                                                $idEmpresa=$row['ididEmpresaCat'];
                                                                $nombreEmpresa=$row['nombreEmpresa'];
                                                                echo "<option value='$idEmpresa'>$nombreEmpresa</option>";
                                                                            }
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>
                                            <b>Monto a pagar</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="totalPago" name="totalPago" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-2">
                                        <p>
                                            <b>Cita a facturar</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">assignment</i>
                                            </span>
                                            <div class="form-line">
                                                <?php 
                                                $fecha=date('Y-m-d');
                                                    setlocale(LC_ALL,"es_ES");
                                                    $fecha4=strftime("%d-%B-%Y",strtotime($fecha));
                                                 ?>
                                                <input type="text" id="CitaFa" name="CitaFa" value="<?php echo $fecha4;?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <p>
                                            <b>Fecha Factura</b>
                                        </p>
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-addon">
                                                <i class="material-icons">date_range</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="text" id="fecha" name="fecha" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaEstudio">
                                        <thead>
                                            <tr>
                                                <th>Nombre del Estudio</th>
                                                <th>Indicaciones para el estudio</th>
                                                <th>clave SAT</th>
                                                <th>Duración</th>
                                                <th>Precio Público</th>
                                                <th>Categoría</th>
                                                <th>Sala Asignada</th>
                                                <th>Precio Clientes</th>
                                                <th>Eliminar</th>
                                               
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="tabla">

                                            <?php 
                                             $idconteo=0;
                                                foreach ($estudio as $row) {
                                                    $IdEstudio=$row['IdEstudio'];
                                                    $nombreEstudio=$row['nombreEstudio'];
                                                    $indicacionesPaciente=$row['indicacionesPaciente'];
                                                    $claveSat=$row['claveSat'];
                                                    $duracion=$row['duracion'];
                                                    $precioPublico=$row['precioPublico'];
                                                    $idCat=$row['idCat'];
                                                    $nombreCat=$row['nombreCat'];

                                                  $idconteo++; 
                                                  
                                            echo "
                                            <tr>
                                            <td style='display:none'>$IdEstudio</td>
                                                <td>$nombreEstudio</td>
                                                     
                                                       <td>$indicacionesPaciente</td>      
                                                       <td>$claveSat</td>  
                                                       <td>$duracion</td>  
                                                       <td>$precioPublico</td> 
                                                       <td id='nombreCategoria$IdEstudio' ondblclick=traerCategoria($IdEstudio);>$nombreCat</td>
                                                       <td id='muestraselectcategoria$IdEstudio' style='display: none;'>
                                                       <select id='selectcategoria$IdEstudio' name='selectcategoria$IdEstudio' onchange='modificarDatosCate($IdEstudio);'> </select>
                                                       </td>
                                                        <td>  <a href='#' onclick='traerId($IdEstudio);identificaSalasAsignadas();' data-toggle='modal' data-target='#myModal2'>Asignar Salas</a> 
                                                    	</td>
                                                    	<td><a href='#' onclick='traerId($IdEstudio); traeNombre(".'"'.$nombreEstudio.'"'.");traeclientes();' data-toggle='modal' data-target='#myModal3'>Asignar/Modificar Precios</a>
                                                    	</td>
                                                    	<td>
                                                        	<a href='#' onclick='confirmaDeleteEstudio($IdEstudio);'>Eliminar</a>
                                                        </td>
                                                </td>
                                               
                                            </tr>";
                                                }
                                             ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                    <div id="sinresultados"></div>
                                </div>
                            </div>
                        </div>
                        <div align="center">
                            <div  id="resultadoGeneral" >
                                <div class="paginacion">
                                    <ul class="pagination"><?php echo $page; ?></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</section>
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">REGISTRO DE NUEVO ESTUDIO</h4>
        </div>
        <div class="modal-body">
          <div class="body">
                <form id="form"  method="post">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
                                            
                                            <div  class="body">
                                               
                                                <h2 class="card-inside-title"></h2>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="nombreEstudio" id="nombreEstudio"  required>
                                                                <label class="form-label">Nombre del Estudio</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <textarea class="form-control" name="indicaciones" id="indicaciones" required> </textarea>
                                                                
                                                                <label class="form-label">Indicaciones para el estudio</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="claveSat" id="claveSat"  required>
                                                                <label class="form-label">Clave Sat</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control" name="duracion" id="duracion"  required placeholder="HH:MM" maxlength="5" minlength="5" pattern="^([01]?[0-9]|2[0-3]):[0-5][0-9]$">
                                                                <label class="form-label">Duración</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" name="precioP" id="precioP"  required>
                                                                <label class="form-label">Precio Público</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float" style="margin-top: 13px;">
                                                            <div class="form-line">
                                                                <select class="form-control" name="idCat" id="idCat" required>    
                                                                        <option value="">Categorías</option>
                                                                         <?php   
                                                                            $idconteo=0;
                                                                            foreach ($Categoria as $row) {
                                                                                 
                                                                                 $idCat=$row['idCat'];
                                                   								 $nombreCat=$row['nombreCat'];
                                                                                  //$idconteo++; .
                                                                                 echo "
                                                                                 <option value='$idCat'>$nombreCat</option>
                                                                                 ";
                                                                            }
                                                                         ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                <div class="row clearfix">
                                                    <div align="center">
                                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Aceptar</button>
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
    </div>
  </div>

  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog" style="margin-top: 50px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">Salas Asignadas Actualmente</h4>
        </div>
        <div class="modal-body">
            <div class="body">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaSalas">
                    <thead>
                        <tr>
                            <th>Salas Disponibles</th>
                            <th>Salas Asignadas</th>
                        </tr>
                    </thead>
                        <?php 
                            foreach ($salas as $row) {
                                $idSal=$row['idSala'];
                            }
                            echo "<input type='hidden' name='total' id='total'  value='$idSal'>
                                  <input type='hidden' name='idactual' id='idactual'>";
                        ?>
                    <tbody id="pintasalas">
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
      <!-- Modal -->

  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog" style="margin-top: 50px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">Asignar Precio cliente para <b id="nombreStudio"></b></h4>
        </div>
        <div class="modal-body">
            <div class="body">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaPrecios">
                    <thead>
                        <tr>
                            <th>Clientes</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody id="pintaClientes">
                    	
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>

 <script type="text/javascript">
    $('#tablaEstudio').Tabledit({
    url: 'Crudestudios/modificarDatos/',
    eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
        identifier: [0, 'IdEstudio'],
        editable: [[1, 'nombreEstudio'], [2, 'indicacionesPaciente'],[3, 'claveSat'], [4, 'duracion'], [5, 'precioPublico']]
    }
  });
    $(".modal").on("hidden.bs.modal", function(){
        $("#pintasalas").html("");
        $("#nombreStudio").html("");
        $("#pintaClientes").html("");
    });
  </script>
<!-- <?php 
  //include "footer.php";
 ?> -->