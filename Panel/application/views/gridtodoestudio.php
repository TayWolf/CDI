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
<link rel="stylesheet" type="text/css" href="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.css"/>

<script type="text/javascript" src="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.js"></script>

<style type="text/css">
 .form-control{
        background-color: #eee;   

    }

    .table tr{

        white-space:nowrap;
        height: 25px;


    }
</style>


<section style="margin-left: 15px;" class="content">
    <div class="container-fluid">
        <!-- <div class="block-header">
                <?php 
                  //include "footer.php";
                 ?>
        </div> -->
        <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                              <div class="row">
                                <div class="col-md-5">
                                  <h2 style="margin-top: 10px;">
                                    Estudios Registrados
                                  </h2>
                                  
                                </div>
                                <div class="col-md-5">
                                  <!--<form class="app-search" onsubmit="buscarEstudio();return false;">
                                        <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                            <div class="form-group form-float" style="margin-bottom: 0px;">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                    <label class="form-label">Buscar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                            <a href="#" onclick="buscarEstudio();return false;"><i class="material-icons">search</i></a>     
                                        </div>
                                    </form>-->
                                </div>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown" >
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" data-toggle="modal" data-target="#myModal">Registrar nuevo estudio</a></li>
                                            
                                        </ul>
                                    </li>
                                </ul>
                              </div>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaEstudio">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre del Estudio</th>
                                                <th>Indicaciones para el estudio</th>
                                                <th >C. SAT</th>
                                                <th>Duración</th>
                                                <th>Precio Público</th>
                                                <th>Categoría</th>
                                                <th style='display:none;'></th>
                                                <th>Empresa</th>
                                                <th>Placas</th>
                                                <th style='display:none;'></th>
                                                <th>Sala Asignada</th>
                                                <th>Precio Clientes</th>
                                                <th>D / Entrega</th>
                                                <th>Eliminar</th>
                                               
                                            </tr>
                                        </thead>
                                        
                                        <!-- <tbody id="tabla">

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
                                                    $nombreEmp=$row['nombreEmpresa'];
                                                    $diasResultado=$row['diasResultado'];
                                                    $numeroPlacas=$row['numeroPlacas'];

                                                  $idconteo++; 
                                                  
                                            echo "
                                            <tr>
                                            <td style='display:none'>$IdEstudio</td>
                                                <td>$nombreEstudio</td>
                                                     
                                                       <td>$indicacionesPaciente</td>      
                                                       <td >$claveSat</td>  
                                                       <td>$duracion</td>  
                                                       <td>$precioPublico</td> 
                                                       <td id='nombreCategoria$IdEstudio' ondblclick=traerCategoria($IdEstudio);>$nombreCat</td>
                                                       <td id='muestraselectcategoria$IdEstudio' style='display: none;'>
                                                       <select id='selectcategoria$IdEstudio' name='selectcategoria$IdEstudio' onchange='modificarDatosCate($IdEstudio);'> </select>
                                                       </td>
                                                       
                                                       <td id='nombreEmpresa$IdEstudio' ondblclick=traerEmpresa($IdEstudio);>$nombreEmp</td>
                                                       <td id='muestraselectempresas$IdEstudio' style='display: none;'>
                                                       <select id='selectempresa$IdEstudio' name='selectempresa$IdEstudio' onchange='modificarDatosEmpre($IdEstudio);'> </select>
                                                       </td>
                                                        <td style='text-align: center;'>$numeroPlacas
                                                       </td>
                                                        <td>  <a href='#' onclick='traerId($IdEstudio);identificaSalasAsignadas();' data-toggle='modal' data-target='#myModal2'>Asignar Salas</a> 
                                                    	</td>
                                                    	<td><a href='#' onclick='traerId($IdEstudio); traeNombre($IdEstudio);traeclientes();' data-toggle='modal' data-target='#myModal3'>Asignar/Modificar Precios</a>
                                                    	</td>
                                                        <td style='text-align: center;'>$diasResultado</td>
                                                    	<td>
                                                        	<a href='#' onclick='confirmaDeleteEstudio($IdEstudio);'>Eliminar</a>
                                                        </td>
                                                
                                               
                                            </tr>";
                                                }
                                             ?>
                                            
                                            
                                        </tbody > -->
                                    </table>
                                    <div id="sinresultados"></div>
                                </div>
                            </div>
                        </div>
                        <div align="center">
                            <div  id="resultadoGeneral" >
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
                                                                <input type="text" class="form-control" onkeyup="form.nombreEstudio.value=form.nombreEstudio.value.toUpperCase();" name="nombreEstudio" id="nombreEstudio"  required>
                                                                <label class="form-label">Nombre del Estudio</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <textarea class="form-control" onkeyup="form.indicaciones.value=form.indicaciones.value.toUpperCase();" name="indicaciones" id="indicaciones" required> </textarea>
                                                                
                                                                <label class="form-label">Indicaciones para el estudio</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.claveSat.value=form.claveSat.value.toUpperCase();" name="claveSat" id="claveSat"  required>
                                                                <label class="form-label">Clave Sat</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line focused">
                                                                <input type="text" class="form-control"  name="duracion" id="duracion"  required placeholder="HH:MM" maxlength="5" minlength="5" pattern="^([01]?[0-9]|2[0-3]):[0-5][0-9]$">
                                                                <label class="form-label">Duración</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" onkeyup="form.precioP.value=form.precioP.value.toUpperCase();" name="precioP" id="precioP"  required>
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
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float" style="margin-top: 13px;">
                                                            <div class="form-line">
                                                                <select class="form-control" name="idEmpre" id="idEmpre" required>    
                                                                        <option value="">Empresa a facturar</option>
                                                                         <?php   
                                                                            $idconteo=0;
                                                                            foreach ($empresa as $row) {
                                                                                 
                                                                                 $idEmpresa=$row['idEmpresa'];
                                                                                 $nombreEmpresa=$row['nombreEmpresa'];
                                                                                  //$idconteo++; .
                                                                                 echo "
                                                                                 <option value='$idEmpresa'>$nombreEmpresa</option>
                                                                                 ";
                                                                            }
                                                                         ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float" style="margin-top: 13px;">
                                                            <b>Dias de entrega de resultados</b>
                                                            <div class="form-line">
                                                                <input type="number" class="form-control" name="diasEntrega" id="diasEntrega"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-float" style="margin-top: 13px;">
                                                            <b>Número de placas (Opcional)</b>
                                                            <div class="form-line">
                                                                <input type="number" class="form-control" name="numeroPlacas" id="numeroPlacas" value="0" required>
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
                    	<!-- <?php 
                            // foreach ($Clientes as $row) {
                            //     $idCli=$row['idCliente'];
                            //     $nombreCli=$row['nombreCliente'];
                            //     echo "<tr>
                            //     		<td>$nombreCli</td>
                            //     		<td>
                            //     			<div class='form-group form-float' style='margin-bottom: 0px;'>
                            //                     <div class='form-line'>
                            //                         <input type='text' class='form-control' id='preciocli$idCli' name='preciocli$idCli'>
                            //                     </div>
                            //                 </div>
                            //     		</td>
                            //     	</tr>";
                            // }
                            // echo "<input type='hidden' name='total' id='total'  value='$idCli'>";
                        ?> -->
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>

 <script type="text/javascript">
    
     $(document).ready(function () {
       /// alert("entra")
    $('#tablaEstudio').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
                    "url": "<?php echo base_url('index.php/Crudestudios/getListadoEstudios/') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
                    "complete": function () {
                        $('#tablaEstudio').Tabledit({
                            url: 'Crudestudios/modificarDatos/',
                            //eventType: 'dblclick',
                            editButton: false,
                            deleteButton:false,
                            columns: {
                                identifier: [0, 'IdEstudio'],
                                editable: [[1, 'nombreEstudio'], [2, 'indicacionesPaciente'],[3, 'claveSat'], [4, 'duracion'], [5, 'precioPublico'],[8, 'numeroPlacas'],[11, 'resultad']]
                            }
                           
                          });
                        $("input[name*='resultad']").attr("type",'number');
                        $("input[name*='numeroPlacas']").attr("type",'number');
                    }
                },
                "columns": [
                    { "data": "IdEstudio" },
                    { "data": "nombreEstudio" },
                    { "data": "indicacionesPaciente" },
                    { "data": "claveSat" },
                    { "data": "duracion" },
                    { "data": "precioPublico" },
                    { "data": "categoria" },
                    { "data": "empresa" },
                    { "data": "numeroPlacas" },
                    { "data": "asigSala" },
                    { "data": "asigaPreci" },
                    { "data": "resultad" },
                    { "data": "Eliminar" }
                ],
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                }
    });

});
    $(".modal").on("hidden.bs.modal", function(){
        $("#pintasalas").html("");
        $("#nombreStudio").html("");
        $("#pintaClientes").html("");
    });
  </script>
 <?php 
  include "footer.php";
 ?>