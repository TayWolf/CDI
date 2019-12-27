<?php 
  include "header.php";
 ?>
    <script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/altaremitente.js"></script>
    <link rel="stylesheet" type="text/css" href="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.css"/>

    <style type="text/css">
        .form-control
        {
            background-color: #eee;   
        }
        .table tr
        {
            white-space:nowrap;
            height: 25px;
        }
    </style>

    <script type="text/javascript" src="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.js"></script>
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
                                <div class="col-md-5">
                                    <h2 style="margin-top: 10px;">
                                        Médicos Remitentes Registrados
                                    </h2>
                                </div>
                                <div class="col-md-5">
                                    <!--<form class="app-search" onsubmit="buscarremitente();return false;">
                                        <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
                                            <div class="form-group form-float" style="margin-bottom: 0px;">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="busqueda" name="busqueda">
                                                    <label class="form-label">Buscar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;">
                                            <a href="#" onclick="buscarremitente();return false;"><i class="material-icons">search</i></a>     
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
                                                 <li><a href="#" data-toggle="modal" data-target="#myModal">Agregar nuevo Medico Remitente</a></li>
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
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaremitente">
                                    <thead>
                                        <tr >
                                            <th style='display:none;'></th>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Clave</th>
                                            <th>Calle</th>
                                            <th>Télefono</th>
                                            <th >Otro<br>Télefono</th>
                                            <th>Email</th>
                                            <th>Especialidad</th>
                                            <th >Fecha<br>Nacimiento</th>
                                            <!-- <th>Estado</th> -->
                                            <th>Ciudad</th>
                                            <th>Colonia</th>
                                            <th >Ordenes<br>Médicas</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    foreach ($Remitente as $row) 
                                    {
                                        $idRemitente = $row['idRemitente'];
                                    }
                                     ?>
                                </table>
                                <div id="sinresultados"></div>
                            </div>
                        </div>
                    </div>
                    <div align="center">
                        <div  id="resultadoGeneral"></div>
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
          <h4 class="modal-title">REGISTRO DE NUEVO MÉDICO REMITENTE</h4>
        </div>
        <div class="modal-body">
          <div class="body">
                <form id="form_validation" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.nombre.value=form.nombre.value.toUpperCase();" name="nombre" required>
                                                <label class="form-label">Nombre Médico Remitente</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.especialidad.value=form.especialidad.value.toUpperCase();" name="especialidad" required>
                                                <label class="form-label">Especialidad</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.clave.value=form.clave.value.toUpperCase();" name="clave" required>
                                                <label class="form-label">Clave</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="fecha" required>
                                                <label class="form-label">Fecha Nacimiento</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="teluno" >
                                                <label class="form-label">Teléfono 1</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" class="form-control" name="teldos" >
                                                <label class="form-label">Teléfono 2</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email" class="form-control" name="correo" >
                                                <label class="form-label">Correo</label>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <!-- <div class="col-md-4">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="Estado" required>
                                                <label class="form-label">Estado</label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.ciudad.value=form.ciudad.value.toUpperCase();" name="ciudad" >
                                                <label class="form-label">Ciudad/Municipio</label>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.colonia.value=form.colonia.value.toUpperCase();" name="colonia" >
                                                <label class="form-label">Colonia/Región</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" onkeyup="form.calle.value=form.calle.value.toUpperCase();" name="calle" >
                                                <label class="form-label">Calle</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="checkbox" id="md_checkbox_23" class="filled-in chk-col-purple" name="control" onchange="cambiacheck();" value="2" />
                                        <label for="md_checkbox_23">Control Ordenes Médicas</label>
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
    <script type="text/javascript">
      window.onload=load;
      function load()
      {
            $('#tablaremitente').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": "<?php echo base_url('index.php/Crudremitentes/getListadoRemitentes/') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
                    "complete": function () {
                        $('#tablaremitente').Tabledit({
                            url: "<?php echo base_url('index.php/Crudremitentes/modificarDatos/') ?>",
                            // eventType: 'dblclick',
                            editButton: false,
                            deleteButton:false,
                            columns: {
                                identifier: [0, 'idRemitente'],
                                editable: [[1, 'nombreRem'], [2, 'claveRem'], [3, 'calleRem'],[4, ' telefonoRemuno'], [5, 'telefonoRemdos'], [6, 'EmailRem'], [7, 'especialidadRem'], [8, 'fechanaciRem'], [9, 'ciudadRem'], [10, 'coloniaRem'], [11, 'controlRem'] ]
                            }
                        });
                    }
                },
                "columns": [
                    { "data": "idRemitente" },
                    { "data": "nombreRem" },
                    { "data": "claveRem" },
                    { "data": "calleRem" },
                    { "data": "telefonoRemuno" },
                    { "data": "telefonoRemdos" },
                    { "data": "EmailRem" },
                    { "data": "especialidadRem" },
                    { "data": "fechanaciRem" },
                    { "data": "ciudadRem" },
                    { "data": "coloniaRem" },
                    { "data": "controlRem" },
                    { "data": "Eliminar" }
                ],
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                }

            });
       }
    // function cambiainput(){
    //     $("input[name*='fecha']").attr("type",'date');
    // }
    // function cambiaEstado($idRem){
    //     var id = $idRem;
    //     // alert("Entra Onclick con valor de ID "+id);
    //     $("#estado"+id).css('display','none');
    //     $("#muestraselectestado"+id).show();
    //     traeEstados(id);

    // }

    // function cambiaMuni($idRem){
    //     var id = $idRem;
    //     // alert("Entra Onclick con valor de ID "+id);
    //     $("#municipio"+id).css('display','none');
    //     $("#muestraselectmuni"+id).show();
    //     traeMuni(id);

    // }

    // function cambiaColo($idRem){
    //     var id = $idRem;
    //     // alert("Entra Onclick con valor de ID "+id);
    //     $("#colonia"+id).css('display','none');
    //     $("#muestraselectcolo"+id).show();
    //     traeCol(id);

    // }

    // function traeEstados(id){
    //   var id = id;
    //   // alert(id);
    //   $.ajax({
    //   url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getEstado",
    //   type: "post",
    //   dataType: "JSON",
    //   success: function(data)
    //     {
    //       if(data.length>0)
    //       {
    //         for (i=0; i<data.length; i++)
    //           {
    //             $("#selectestado"+id).append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']));
    //             // $("#selectestado"+id).append("<option value='"+data[i]['id_Estado']+"' onclick='modificarDatosE("+data[i]['id_Estado']+","+id+")'>"+data[i]['nombreEstado']+"</option>");
    //           }
    //       }
    //     },
    //   error: function (jqXHR, textStatus, errorThrown)
    //     {
    //       alert('Error get data from ajax');
    //     }
    //   });
    // }

    // function modificarDatosE(id){
     
    //  var id = id;
    //  var idestado = $("#selectestado"+id).val();
    //  if (idestado == null) {
    //     idestado =$("#valorestado"+id).val();
    //  }
    //  var idciudad = $("#selectmuni"+id).val();
    //  if (idciudad == null) {
    //     idciudad = $("#valorciudad"+id).val();
    //  }
    //  var idcolonia = $("#selectcolo"+id).val();
    //  var parametros = {"idestado":idestado,"idciudad": idciudad,"idcolonia":idcolonia,"id":id}
    //   //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
    //  $.ajax({
    // url : "http://localhost/CDI/Panel/index.php/Crudremitentes/editaestado/",
    // type: "post",
    // data: parametros,
    // dataType: "HTML",
    //   success: function(data)
    //     {
    //         //alert("dato modificado");
    //     },
    //   error: function (jqXHR, textStatus, errorThrown)
    //     {
    //       alert('ERROR AL GUARDAR ESTADO');
    //     }
    // });
    // }


// function traeMuni(id){
//     var id=id;
//     $("#selectmuni"+id).html("");
//     $("#municipio"+id).css('display','none');
//     $("#muestraselectmuni"+id).show();
      
//     var idestado = $("#selectestado"+id).val();
    
//     if (idestado == "" || idestado == null) {
//         idestado = $("#valorestado"+id).val();
//     }
//     //alert(idestado);
//     $.ajax({
//     url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getMunicipio/"+ idestado,
//     type: "post",
//     dataType: "JSON",
//       success: function(data)
//         {
//           if(data.length>0)
//           {
//             for (i=0; i<data.length; i++)
//               {
//                 $("#selectmuni"+id).append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']));
//               }
//           }
//           traeCol(id);
//         },
//       error: function (jqXHR, textStatus, errorThrown)
//         {
//           alert('ERROR DE TRAER MUNICIPIO');
//         }
//     });
// }


// function traeCol(id){
//     var id=id;
//     $("#selectcolo"+id).html("");
//     $("#colonia"+id).css('display','none');
//     $("#muestraselectcolo"+id).show();
//     var idMunic = $("#selectmuni"+id).val();
//     if (idMunic == null) {
//         idMunic = $("#valorciudad"+id).val();
//     }
//     $.ajax({
//     url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getColonia/"+ idMunic,
//     type: "post",
//     dataType: "JSON",
//         success: function(data)
//         {
//           if(data.length>0)
//           {
//             for (i=0; i<data.length; i++)
//               {
//                 $("#selectcolo"+id).append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']));
//               }
//           }
//           modificarDatosE(id);
//           // location.reload();
//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//           alert('Error get data from ajax');
//         }
//     });
// }


    </script>
<!--  /*[9,'estado', '{}'], [10,'ciudad', '{}'], [11,'colonia', '{}'],*/  -->
<!-- <?php 
  //include "footer.php";
 ?> -->