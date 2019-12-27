<?php 
  include "header.php";
 ?>
<script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<!-- <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script> -->
<script src="http://localhost/CDI/Panel/content/js/altaarticulo.js"></script>
<script src="http://localhost/CDI/Panel/content/js/asignalinea.js"></script>
<style type="text/css">
 .form-control{
        background-color: #eee;   

    }
</style>

    <section style="margin-left: 15px;" class="content">
        <div class="container-fluid">
            <div class="block-header">
<!--                 <a href="http://localhost/CDI/Panel/index.php/menus">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a> -->
                <!-- <h2>
                    JQUERY DATATABLES
                    <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>
                </h2> -->
                <?php 
                  include "footer.php";
                 ?>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-4">
                                    <h2 style="margin-top: 10px;">
                                        Artículos Registrados
                                    </h2>
                                </div>
                                
                                <div class="col-md-5">
                                    <form class="app-search" onsubmit="buscarArticulo();return false;">
                                        <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                            <div class="form-group form-float" style="margin-bottom: 0px;">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                    <label class="form-label">Buscar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                            <a href="#" onclick="buscarArticulo();return false;"><i class="material-icons">search</i></a>     
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-1">
                                   <a href="http://localhost/CDI/Panel/laboratoriocdi.php" target="popup" onclick="javascript:window.open('','popup','resizable=yes, top='+parseInt(((screen.height) / 8) - 150)+',  width=740 ,height=640, left='+parseInt(((screen.width) / 3) - 150)+', menubar=no, scrollbars=no, status=no, titlebar=no, toolbar=no,directories=no');"><div class="demo-google-material-icon"> <i class="material-icons">picture_as_pdf</i> <span class="icon-name">Resurtir</span></div>
                                    </a>
                                </div>
                                <div class="col-md-1">
                                   <a href="http://localhost/CDI/Panel/articuloExcel.php"><div class="demo-google-material-icon"> <i class="material-icons">cloud_download</i> <span class="icon-name">Reporte</span></div>
                                    </a>
                                </div>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                 <li><a href="#" data-toggle="modal" data-target="#myModal">Agregar nuevo Artículo</a></li>
                                            </li>
                                            <!-- <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li> -->
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="row" style="margin-top: 30px;"><!--  style="display: -webkit-inline-box;" -->
                                <div class="col-md-4">
                                    <a href="#" class="btn" style="background-color: #7d0000;"></a><p>Existencia por debajo del mínimo</p>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" class="btn" style="background-color: orange;"></a><p>Existencia proxima a estar por debajo del mínimo</p>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" class="btn" style="background-color: #fff;"></a><p>Producto con un rango de existencia normal</p>
                                </div>
                            </div>
                        </div>
                      
                        <div class="body">
                            <div class="table-responsive" >

                                <table class="table table-bordered table-striped table-hover dataTable js-exportable claseIndetifica" >
                                    <thead>
                                        <tr>
                                            <th>Existencia</th>
                                            <th>Nombre</th>
                                            <th>Presentación</th>
                                            <th>Medida</th>
                                            <th>Ubicación</th>
                                            <th>Costo Unitario</th>
                                            
                                            <th>Máximo</th>
                                            <th>Minimo</th>
                                             <th>Línea</th>
                                             <th>Proveedor</th>
                                             <th>F.Caducidad</th>
                                             <th>H. de Compras</th>
                                             <th>H. de Entradas</th>
                                             <th>H. de Salidas</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="tabla">    
                                        <?php 
                                            $idconteo=0;
                                                foreach ($Articulo as $row) {
                                                   $idArticulo=$row['idArticulo'];
                                                   $nombre=$row['nombre'];
                                                   $presentacion=$row['presentacion'];
                                                   $medida=$row['medida'];
                                                   $ubicacion=$row['ubicacion'];
                                                   $costoUni=$row['costo_unitario'];
                                                   $existec=$row['existencia'];
                                                   $maximo=$row['maximo'];
                                                   $minimo=$row['minimo'];
                                                   
                                                   $idconteo++;

                                                   echo " <tr>
                                                   <td style='display:none'>$idArticulo</td>
                                                        <td class='whiteSpace claseIndetificador' onclick='permiso();' style='-moz-user-select: none;'>$existec</td>
                                                        <td id='1$idArticulo' class='whiteSpace claseIndetificador' onchange='colorear($idArticulo,$existec,$minimo);' onclick='permiso();'>$nombre</td>
                                                        <td class='whiteSpace claseIndetificador' onclick='permiso();'>$presentacion</td>
                                                        <td class='whiteSpace claseIndetificador' onclick='permiso();'>$medida</td>
                                                        <td class='whiteSpace claseIndetificador' onclick='permiso();'>$ubicacion</td>
                                                        <td class='whiteSpace claseIndetificador' onclick='permiso();'>$costoUni</td>
                                                       
                                                        <td class='whiteSpace claseIndetificador' onclick='permiso();'>$maximo</td>
                                                        <td class='whiteSpace claseIndetificador' onclick='permiso();'>$minimo</td>
                                                        <td> <a href='#' id='linea$idArticulo' onclick='traerIdarticulo($idArticulo);identificaLineaAsignados()' data-toggle='modal' data-target='#myModal3'>Asignar </a></td>

                                                        <td> <a href='#' id='provee$idArticulo' onclick='traerIdarticulo($idArticulo);identificaProveAsignadosProve()' data-toggle='modal' data-target='#myModal2'>Asignar </a></td>
                                                        <td> <a href='#' id='caduci$idArticulo' onclick='listaCaduca($idArticulo);listaCaducaEntr($idArticulo);' title='Fecha de caducidad$idArticulo'  data-toggle='modal' data-target='#myModal4'>Ver </a></td>
                                                        <td> <a href='#' id='compra$idArticulo' title='Historial de compras' onclick='popupHcompra($idArticulo);'>PDF</a></td>
                                                        <td> <a href='#' id='entrada$idArticulo' title='Historial de entradas' onclick='popupHentrada($idArticulo);'>PDF </a></td>
                                                        <td> <a href='#' id='salida$idArticulo' title='Historial de salidas' onclick='popupHsalida($idArticulo);'>PDF </a></td>
                                                        <td> <a href='#' id='elimina$idArticulo' onclick='confirmaDeleteArticulo($idArticulo);'>Eliminar </a></td>
                                                    </tr>
                                                    <script type='text/javascript'>setTimeout(function(){colorear($idArticulo,$existec,$minimo);},1000);</script>
                                                    ";
                                                }
                                                echo "<input type='hidden' id='idArticuloactual' name='idArticuloactual'>";

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
            <!-- #END# Exportable Table -->
        </div>
    </section>
      <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">REGISTRO DE NUEVO ARTÍCULO</h4>
        </div>
        <div class="modal-body">
          <div class="body">
                <form id="form_validation" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.nombre.value=form.nombre.value.toUpperCase();" name="nombre" required>
                                                <label class="form-label">Nombre Artículo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.presentacion.value=form.presentacion.value.toUpperCase();" name="presentacion" required>
                                                <label class="form-label">Presentacion</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.medida.value=form.medida.value.toUpperCase();" name="medida" required>
                                                <label class="form-label">Medida</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.ubicacion.value=form.ubicacion.value.toUpperCase();" name="ubicacion" required>
                                                <label class="form-label">Ubicación</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.costouni.value=form.costouni.value.toUpperCase();" name="costouni" required>
                                                <label class="form-label">Costo Unitario</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.existencia.value=form.existencia.value.toUpperCase();" name="existencia" required>
                                                <label class="form-label">Existencia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.maximo.value=form.maximo.value.toUpperCase();" name="maximo" required>
                                                <label class="form-label">Máximo</label>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.minimo.value=form.minimo.value.toUpperCase();" name="minimo" required>
                                                <label class="form-label">Minimo</label>
                                            </div>
                                        </div>
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
  </div>
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog" style="margin-top: 50px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">Línea perteneciente <b id="nombresaladoc"></b></h4>
        </div>
        <div class="modal-body">
            <div class="body">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tabladoctores">
                    <thead>
                        <tr>
                            <th>Líneas</th>
                            <th>Lineas asignadas</th>
                            
                        </tr>
                    </thead>
                       <?php
                       $idLine=""; 
                    foreach ($linea as $row) {
                        $idLine=$row["idLinea"];
                         $nombreLinea=$row["nombre"];

                    }
                     echo "<input type='hidden' name='totalLin' id='totalLin'  value='$idLine'>";
                     ?>  
                    <tbody id="pintaLineas">
                   
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog" style="margin-top: 50px;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">Compras <b></b></h4>
        </div>
        <div class="modal-body">
            <div class="body">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tabladoctores">
                    <thead>
                        <tr>
                            <th>Caducidad</th>
                            <th>Cantidad Compras</th>
                            <th>Cantidad Actual</th>
                        </tr>
                    </thead>
                       
                    <tbody id="pintaListaCa">
                   
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-header">
          
          <h4 class="modal-title">Entradas <b></b></h4>
        </div>
        <div class="modal-body">
            <div class="body">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tabladoctores">
                    <thead>
                        <tr>
                            <th>Caducidad</th>
                            <th>Cantidad Entradas</th>
                            <th>Cantidad Actual</th>
                        </tr>
                    </thead>
                       
                    <tbody id="listaCaducaE" >
                   
                    </tbody>
                </table>
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
          <h4 class="modal-title">Proveedor perteneciente <b id="nombresaladoc"></b></h4>
        </div>
        <div class="modal-body">
            <div class="body">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tabladoctores">
                    <thead>
                        <tr>
                            <th>Proveedor</th>
                            <th>Proveedores asignados</th>
                            
                        </tr>
                    </thead>
                       <?php 
                       $idProveedor="";
                    foreach ($prove as $row) {
                        $idProveedor=$row["idProveedor"];
                    }
                     echo "<input type='hidden' name='totalidProveedor' id='totalidProveedor'  value='$idProveedor'>";
                     ?>  
                    <tbody id="pintaProvedores">
                   
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
    <script type="text/javascript">
    

function  popupHcompra(idAr) {
    
mipopup=window.open("http://localhost/CDI/Panel/historialcompra.php?idAr="+idAr,"neo","width=900,height=600,menubar=si");
  
    }
    function  popupHentrada(idAr) {
    
mipopup=window.open("http://localhost/CDI/Panel/historialentradas.php?idAr="+idAr,"neo","width=900,height=600,menubar=si");
  
    }
    function  popupHsalida(idAr) {
    
mipopup=window.open("http://localhost/CDI/Panel/historialsalidas.php?idAr="+idAr,"neo","width=900,height=600,menubar=si");
  
    }

function permiso()
{
    swal({
          title: "AVISO",
          text: "Ingrese contraseña:",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          inputPlaceholder: "Password"
        }, function (inputValue) {
          if (inputValue === false) return false;
          if (inputValue === "") {
            swal.showInputError("Permiso denegado");
            return false
          }
          var parametros={inputValue : inputValue};
             $.ajax({
                    url : "<?php echo site_url('Crudarticulos/obtenerDatosPassword/')?>",
                    data: parametros,
                    type: "post",
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data!=null)
                         {
                            swal("Autorizado", "Puedes modificar los campos del registro", "success");
                               $(".claseIndetifica").attr("id","tablaarticulo");
                                $(".claseIndetificador").removeAttr("onclick");
                                $('#tablaarticulo').Tabledit({
                                    url: 'http://localhost/CDI/Panel/index.php/Crudarticulos/modificarDatos/',
                                    //eventType: 'dblclick',
                                    editButton: false,
                                    deleteButton:false,
                                    columns: {
                                        identifier: [0, 'idArticulo'],
                                        editable: [[1, 'existec'],[2, 'nombre'], [3, 'presentacion'], [4, 'medida'],[5, 'ubicacion'], [6, 'costoUni'],  [7, 'maximo'], [8, 'minimo']]
                                    }
                                    
                                    });
                        }else{
                             swal.showInputError("Contraseña incorrecta");
                        }
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
          
        });
}

                            function colorear(idArticulo,existencia, minimo) {
                                    var idArticulo = idArticulo;

                                    // alert("entra funcion para colorear el articulo "+idArticulo+" existen-> "+existencia+" el minimo es -> "+minimo);
                                    if (existencia < minimo) {
                                        
                                        $("#1"+idArticulo).css("background-color","#7d0000");
                                        $("#1"+idArticulo).css("color","#fff");
                                        // $("#linea"+idArticulo).css("color","#fff");
                                        // $("#provee"+idArticulo).css("color","#fff");
                                        // $("#caduci"+idArticulo).css("color","#fff");
                                        // $("#compra"+idArticulo).css("color","#fff");
                                        // $("#entrada"+idArticulo).css("color","#fff");
                                        // $("#salida"+idArticulo).css("color","#fff");
                                        // $("#elimina"+idArticulo).css("color","#fff");
                                        // $("#"+idArticulo).style.backgroundColor = "red";
                                    }
                                    for (var i = 0; i <= 5; i++) {
                                        var RangoMinimo = parseInt(minimo) + parseInt(i);
                                        if (RangoMinimo == existencia) {
                                            $("#1"+idArticulo).css("background-color","orange");
                                            $("#1"+idArticulo).css("color","#000");
                                            // $("#linea"+idArticulo).css("color","#000");
                                            // $("#provee"+idArticulo).css("color","#000");
                                            // $("#caduci"+idArticulo).css("color","#000");
                                            // $("#compra"+idArticulo).css("color","#000");
                                            // $("#entrada"+idArticulo).css("color","#000");
                                            // $("#salida"+idArticulo).css("color","#000");
                                            // $("#elimina"+idArticulo).css("color","#000");
                                            // $("#"+idArticulo).style.backgroundColor = "coral";
                                        }
                                    }
                                }
 </script>
<!--  /*[9,'estado', '{}'], [10,'ciudad', '{}'], [11,'colonia', '{}'],*/  -->
<!-- <?php 
  //include "footer.php";
 ?> -->
 