<?php 
  include "header.php";
?>
<script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altacategoria.js"></script>

<style type="text/css">
 .form-control{
        background-color: #eee;   

    }

            .table tr{

        white-space:nowrap;
        height: 25px;

    }
</style>

    <section class="content" style="margin-left: 15px;">
        <div class="container-fluid">
            <div class="block-header">
                <a href="http://localhost/CDI/Panel/index.php/menus">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
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
                                <div class="col-md-5">
                                    <h2 style="margin-top: 10px;">
                                        Categorías Registradas
                                    </h2>
                                </div>
                                <div class="col-md-5">
                                    <!--<form class="app-search" onsubmit="buscarcategoria();return false;">
                                        <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                            <div class="form-group form-float" style="margin-bottom: 0px;">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                    <label class="form-label">Buscar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                            <a href="#" onclick="buscarcategoria();return false;"><i class="material-icons">search</i></a>     
                                        </div>
                                    </form>-->
                                </div>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                 <li><a href="#" data-toggle="modal" data-target="#myModal">Agregar nueva categoría</a></li>
                                            </li>
                                            <!-- <li><a href="javascript:void(0);">Another action</a></li>
                                            <li><a href="javascript:void(0);">Something else here</a></li> -->
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaCategorias">
                                    <thead>
                                        <tr>
                                            <!-- <th>Foto</th> -->
                                            <th style='display:none;'></th>
                                            <th>Nombre</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabla">
                                        <?php 
                                            $idconteo=0;
                                                foreach ($Categoria as $row) {
                                                   $idCat=$row['idCat'];
                                                   $nombreCat=$row['nombreCat'];
                                                    
                                                   
                                                   $idconteo++;
                                                   echo " <tr>
	                                                   <td style='display:none;'>$idCat</td>
                                                        
                                                        <td>$nombreCat</td>
                                                        <td>
                                                            <a href='#' onclick='confirmaDeleteCategoria($idCat);'>Eliminar</a>
                                                        </td>
                                                        
                                                    </tr>
                                                    ";
                                                    // CODIGO FOTO USUARIO
                                                    // <td><a href='#' onclick='asignavalores($idUser);' data-activates='dr-users' data-toggle='modal' data-target='#myModalimg'><input type='hidden' id='imguser$idUser' value='$foto'><img src='http://localhost/CDI/Panel/content/images/usuarios/$foto' alt='' width='50px' height='50px'></a></td>

                                                    // CODIGO BOTON ELIMINAR
                                                    // <button type='button' class='btn btn-circle-lg waves-effect waves-circle waves-float' onclick='confirmaDeleteUser($idUser);' style='color:white;background:#293a4a;'>
                                                    //             <i class='material-icons'>delete</i>
                                                    //         </button>
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
          <h4 class="modal-title">REGISTRO DE NUEVAS CATEGORÍAS</h4>
        </div>
        <div class="modal-body">
          <div class="body">
                <form id="form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control"  onkeyup="form.nombreCat.value=form.nombreCat.value.toUpperCase();" name="nombreCat" required>
                                    <label class="form-label">Nombre de la categoría</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div align="center">
                            <input type="submit" class="btn btn-primary m-t-15 waves-effect"  value="GUARDAR">
                            <!-- <button class="btn btn-primary m-t-15 waves-effect" style="background: #293a4a;">GUARDAR</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
      <!-- Modal -->
<!--    <div class="modal fade" id="myModalimg" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px;">
    
      <!- Modal content->
     <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
          <h4 class="modal-title">Editar imagen de Usuario</h4>
        </div>
        <div class="modal-body">
          <div class="body">  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="hidden" name="iduser" id="iduser">
                                    <input type="hidden" name="fotobase" id="fotobase">
                                    <input type="file" class="form-control" name="fotoUser">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div align="center">
                            <button class="btn btn-primary m-t-15 waves-effect" style="background: #293a4a;" onclick="editaimg();">GUARDAR</button>
                        </div>
                    </div>
            </div>
        </div>
      </div>
    </div>
  </div> -->
  <script type="text/javascript">
  	$('#tablaCategorias').Tabledit({
    url: 'Crudcategorias/modificarDatos/',
    eventType: 'dblclick',
    editButton: false,
    deleteButton:false,
    columns: {
        identifier: [0, 'idcategoria'],
        editable: [[1, 'nombreCat']]
    }
	});
    $('#tablaCategorias').DataTable({
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    // function asignavalores(idu)

    //  {
    //   var idu=idu;
    //   var img = $("#imguser"+idu).val();
    //   $("#fotobase").val(img);
    //   $("#iduser").val(idu);
    //  }

    //  function editaimg(){
    //   var idu = $("#iduser").val();
    //   var newfoto = $("#fotobase").val();
    //   var oldfoto = $("#fotoUser").val();
    //   // alert("nombre: "+nombreDepto);
    //   var parametro = {"idu":idu,"newfoto":newfoto,"oldfoto":oldfoto}
    //   $.ajax({
    //     url : "<?php echo site_url('Crudusuarios/editafoto/')?>",
    //     type: "post",
    //     data: parametro,
    //     dataType: "HTML",
      
    //     success: function(data)
    //     {
    //         // swal("Exito!", "Se ha editado el Departamento seleccionado!", "success");
    //     },
    //     error: function (jqXHR, textStatus, errorThrown)
    //     {
    //         alert('Error get data from ajax');
    //     }
    //   });
    //  }
  </script>
<!-- <script src="http://localhost/CDI/Panel/content/js/altausuario.js"></script> -->

<!-- <?php 
  //include "footer.php";
 ?> -->