<?php 
  include "header.php";
  $usuario=$this->session->userdata('idusuariobase');
  // echo($usuario);
 ?>
 
<style type="text/css">
.input-group.input-group-lg .form-control {
    font-size: 14px;
}
td{
	padding: 0px;
}
th{
	color: black;
}

 .form-control{
        background-color: #eee;   

    }

</style>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
 <link rel="stylesheet" href="../content/css/jquery-ui.css">
  
  <script src="../content/js/jquery-1.12.4.js"></script>
  <script src="../content/js/jquery-ui.js"></script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="width: 90%; margin-top: 2%;">
    <div class="modal-content">
      <div class="modal-header col-md-12" style="background: #293a4a">
        <div class="col-md-11">
          <h4 class="modal-title" style="color: #fff">Buscar estudios</h4>
        </div> 
        <div class="col-md-1">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
      </div>
      <div class="modal-body col-md-12">
        <div class="row">
          <div class="col-md-4 col-md-offset-8">
            <div class="input-group input-group-lg">
                <div class="form-line">
                    <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Busqueda de estudios" onkeydown="EjecutaBusqueda(event); tre();" oninput="buscar();">
                    <input type="hidden" name="idEstudio" id="idEstudio">
                </div>
                 <span class="input-group-addon">
                    <i class="material-icons" onclick="buscar();" style="cursor: pointer;">search</i>
                </span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-hover">
                <thead style="background: #ccc;">
                    <tr>
                        <th>ESTUDIO</th>
                        <th>INDICACIONES</th>
                        <th>DESCUENTO</th>
                        <th>P. UNITARIO</th>
                        <th>CANTIDAD</th>
                        <th>COTIZAR</th>
                    </tr>
                </thead>
                <tbody id="listaEstudios">
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<section style="margin-left: 15px;" class="content">

    <div class="container-fluid">
      
        <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header" style="background: #293a4a;">
                              <div class="row">
                                <div class="col-md-5">
                                  <h2 style="margin-top: 10px;color:  #fff;">
                                    Cotizaciones
                                  </h2>
                                </div>
                               
                              </div>
                            </div>
                            
                            <form method="post" action="" id="form">
                            <div class="body">
                            <input type="hidden" id="idusuario" name="idusuario" value="<?php echo "$usuario" ?>">
                            <div class="content">
                              <div class="center" align="center" style="margin-bottom: 30px;">
                                <div class="row clearfix">
                                  <div class="col-md-3">
                                    <p>
                                      <b>No. Control</b>
                                    </p>
                                    
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">chevron_right</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="controlOrden"  name="controlOrden" class="form-control" readonly>
                                            
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <h3>Registro de Cotizaciones</h3>
                                  </div>

                                 
                                  <div id="botonaltapaciente" class="col-md-2">
                                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModalAlta">Registrar Paciente</a>
                                  </div>
                                  
                                  <div id="limpiador" class="col-md-2" style="display: none;">
                                    <a href="#" class="btn btn-danger" onclick="window.location.reload()">Limpiar ventana</a>
                                  </div>
                                </div>    
                              </div>
                              <div class="row clearfix" align="center">
                                 <div class="col-md-3">
                                      <p>
                                          <b>Nombre del paciente</b>
                                      </p>
                                      <div class="input-group input-group-lg">
                                          <span class="input-group-addon">
                                              <i class="material-icons">chevron_right</i>
                                          </span>
                                          <div class="form-line">
                                              <input type="text" id="paciente" onkeyup="form.paciente.value=form.paciente.value.toUpperCase();" onchange="datoControl();" onkeypress="traepacientes();" name="paciente" class="form-control" required>
                                              <input type="hidden" name="idPaciente" id="idPaciente">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <p>
                                          <b>Correo</b>
                                      </p>
                                      <div class="input-group input-group-lg">
                                          <span class="input-group-addon">
                                              <i class="material-icons">chevron_right</i>
                                          </span>
                                          <div class="form-line">
                                              <input type="text" id="correo" name="correo" class="form-control" required>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <p>
                                          <b>Pertenece a algún Cliente</b>
                                      </p>
                                      <input name="cliente" type="radio" id="radio_31" class="with-gap radio-col-pink" value="si" onchange="validaCliente();" />
                                      <label for="radio_31">SI</label>
                                      <input name="cliente" type="radio" id="radio_32" class="with-gap radio-col-pink" value="no" onchange="validaCliente();" />
                                      <label for="radio_32">NO</label>
                                  </div>
                                  <div id="selectcliente" class="col-md-3" style="display: none;">
                                      <p>
                                          <b>Seleccione el Cliente</b>
                                      </p>
                                      <div class="input-group input-group-lg">
                                          <span class="input-group-addon">
                                              <i class="material-icons">chevron_right</i>
                                          </span>
                                          <div class="form-line">
                                              <!-- <input type="text" id="feNa" name="feNa" class="form-control"> -->
                                              <select id="selectcli" name="selectcli" class="form-control">
                                                
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div id="seccionSelecEstudios" class="row clearfix" align="center" style="margin-bottom: 30px;display: none;">
                                <div class="col-md-4 col-md-offset-4">
                                    <h5>Por favor seleccione los estudios que desea cotizar</h5>
                                </div>
                                <div class="col-md-12" align="center">
                                  <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="traetodosEstudios();">Seleccionar Estudios</a>
                                </div>
                              </div>
                            </div>
                            <div id="cotizacionestabla" style="display: none;">
                            <div class="content" style="margin-bottom: 30px;">
                              <table class="table table-hover">
                                  <thead style="background: #ccc;">
                                      <tr>
                                          <th>ESTUDIO</th>
                                          <th>CANTIDAD</th>
                                          <th>P. UNITARIO</th>
                                          <th>DESCUENTO</th>
                                          <th>IMPORTE</th>
                                          <th>ELIMINAR</th>
<!--                                           <th>PRECIO TOTAL</th> -->
                                      </tr>
                                  </thead>
                                  <tbody id="listaArrayEstudio">

                                  </tbody>
                              </table>
                              <div class="row" id="importetotal" style="display: none;">
                              	<div class="col-md-4 col-md-offset-4">
		                              <p>
		                                  <b>Importe total</b>
		                              </p>
		                              <div class="input-group input-group-lg">
		                                  <span class="input-group-addon">
		                                      <i class="material-icons">chevron_right</i>
		                                  </span>
		                                  <div class="form-line">
		                                      <input type="text" id="importetot" name="importetot" class="form-control" readonly>
		                                  </div>
		                              </div>	
	                              </div>
                              </div>
                              
                            </div>
                            <div id="botoncotizar" class="row clearfix">
                               <div align="center">
                                  <div class="button-demo">
                                    <input type="button" class="btn bg-black waves-effect waves-light" value="Cotizar" onclick="altarCotizacion();">
                                  </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        </form> 

                        
                        </div>
                       
                    </div>

                </div>
        <!-- <div class="row clearfix">        
          <input type="button" name="bdcotizaciones" id="bdcotizaciones" value="Ver todas la cotizaciones" class="btn btn-default" onclick="traetodasCotizaciones();" data-toggle="modal" data-target="#myModalcotizaciones">
        </div> -->
    </div>
</section>

<div class="modal fade" id="myModalcotizaciones" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cotizaciones Recientes</h4>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
            <thead style="background: #ccc;">
                <tr>
                    <th>ESTUDIO</th>
                    <th>DESCUENTO</th>
                    <th>PRECIO</th>
                    <th>PRECIO DESCUENTO</th>
                    <th>CANTIDAD</th>
                </tr>
            </thead>
            <tbody id="listamodal">
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    
  </div>
</div>

<div class="modal fade" id="myModalAlta" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px;">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button>
              <h4 class="modal-title">REGISTRO DE NUEVO PACIENTE</h4>
          </div>
          <div class="modal-body">
              <div class="body">
                  <form id="formaltaPac"  method="post">
                      <div class="row clearfix">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="body">
                                  <h2 class="card-inside-title"></h2>
                                  <div class="row clearfix">
                                      <div class="col-md-6">
                                          <div class="form-group form-float">
                                              <div class="form-line focused">
                                                  <input type="text" class="form-control" id="clave" name="clave" required readonly>
                                                  <label class="form-label">Clave</label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group form-float">
                                              <div class="form-line">
                                                  <input type="text" class="form-control" id="nombre" name="nombre" onkeyup="form.nombre.value=form.nombre.value.toUpperCase();" required>
                                                  <label class="form-label">Nombre del paciente</label>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row clearfix">
                                      <div class="col-md-4">

                                          <div class="form-group form-float">
                                              <div class="form-line">
                                                  <select class="form-control" class="form-control" name="genero" required>
                                                      <option value="">Seleccione un género</option>
                                                      <option value="1">Masculino</option>
                                                      <option value="2">Femenino</option>
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-4">
                                          <div class="form-group form-float">
                                              <div class="form-line">
                                                  <input type="text" class="form-control" name="correo-modal" id="correo-modal" required>
                                                  <label class="form-label">Correo</label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-4">
                                          <div class="form-group form-float">
                                              <div class="form-line">
                                                  <input type="text" class="form-control" name="telefono" onkeyup="form.telefono.value=form.telefono.value.toUpperCase();" required>
                                                  <label class="form-label">Teléfono</label>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row clearfix">
                                      <div class="col-sm-4">
                                          <div class="form-group form-float">
                                              <div class="form-line">
                                                  <input type="date" class="form-control" name="fechanaci" id="fechanaci"  required onchange="calcularEdad(this);">
                                                  <label class="form-label">Fecha de Nacimiento</label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-4">
                                          <div class="form-group form-float">
                                              <div id="linea" class="form-line">
                                                  <input type="number" class="form-control" name="edad" id="edad"  required>
                                                  <label class="form-label">Edad</label>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row clearfix">
                                      <div class="col-sm-6">
                                          <p>
                                              <b>Médico Remitente</b>
                                          </p>
                                          <div class="form-group form-float">
                                              <div class="form-line">
                                                  <select class="form-control" class="form-control" name="remitente" id="remitente"  required>
                                                      <option value="">Seleccione un Médico Remitente</option>
                                                      <?php
                                                      foreach ($medicoRem as $row) 
                                                      {
                                                          $idRemitente=$row['idRemitente'];
                                                          $nombreRem=$row['nombreRem'];
                                                          echo "<option value='$idRemitente'>$nombreRem</option>";
                                                      }
                                                      ?>
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-6">
                                          <p>
                                              <b>Cliente</b>
                                          </p>
                                          <div class="form-group form-float">
                                              <div class="form-line">
                                                  <select class="form-control" class="form-control" name="cliente-modal" id="cliente-modal" required>
                                                      <option value="">Seleccione un Cliente</option>
                                                      <?php
                                                      foreach ($cliente as $row) 
                                                      {
                                                          $idCliente=$row['idCliente'];
                                                          $nombreCliente=$row['nombreCliente'];
                                                          echo "<option value='$idCliente'>$nombreCliente</option>";
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

<script type="text/javascript">

  window.addEventListener("load", function(event) {
    //ASIGNAR CLAVE PACIENTE - REGISTRO
    $("#linea").addClass( "focused" );
      $("#liff").addClass( "focused" );
      $.ajax({
          url : "http://localhost/CDI/Panel/index.php/Crudpacientes/traeclave/",
          type: "POST",
          dataType: "json",
          success: function(data)
          {
              var id = data.idPaciente;
              var clave = parseInt(id) + 1;
              $("#clave").val("1000"+clave);
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  });

  function calcularEdad(element)
  {
    var birthday = new Date(element.value);
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs);
    var edadCalculada = Math.abs(ageDate.getUTCFullYear() - 1970);
    $("#edad").val(edadCalculada);
  }
                                            
 $(function(){
    $("#formaltaPac").on("submit", function(e){ 
      e.preventDefault();
      var nombreN = $("#nombre").val();
      var correoN = $("#correo-modal").val();
      var clienteN = $("#cliente-modal").val();

      if(clienteN)
      {
          $("#radio_31").prop("checked", true);
          validaCliente(clienteN);
          console.log(clienteN);
      }

      $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
      var page = $(this).attr('data');        
      var dataString = 'page='+page;
      var formData = new FormData(document.getElementById("formaltaPac"));
      formData.append("cliente", clienteN);
      formData.append("correo", correoN);
        $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudpacientes/agregaPaciente/",
              type: "post",
              data: formData,
              dataType: "HTML",
              cache: false,
              contentType: false,
                processData: false,
              success: function(data)
              {
                  var URLactual = window.location;
                  if (URLactual == "http://localhost/CDI/Panel/index.php/Crudcotizaciones" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcotizaciones#" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcotizaciones/") {
                      $("#myModalAlta").modal();
                      $("#idPaciente").val(data);
                      $("#paciente").val(nombreN);
                      $("#correo").val(correoN);
                      $('#cargando').fadeOut();
                  }else{
                      $('#cargando').fadeIn(1000).html(data);
                      location.href='http://localhost/CDI/Panel/index.php/Crudpacientes'; 
                  }
              }
      });
      // FORMATEAR FORM
      $("#nombre").val("");
      $("#genero").val("");
      $("#correo-modal").val("");
      $("#telefono").val("");
      $("#fechanaci").val("");
      $("#edad").val("");
      $("#remitente").val("");
      $("#cliente-modal").val("");
    });
});


window.onload=datoControl;
function  datoControl()
{
  $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcotizaciones/getId/",
        dataType:"json",
        success:function(data) {
          //alert(data.idcotizacion);
          var f = new Date();
        var cod=(f.getDate() + "" + (f.getMonth() +1) + "" + f.getFullYear());
         
         $("#controlOrden").val("Ocdi-"+cod+"-"+data.idcotizacion);
        }
    });
}
function validaCliente(valClienteRegistro = null) {
 var cliente = $('input[name=cliente]:checked').val();
 // alert(cliente);
 if (cliente == "si") {
  $("#selectcliente").show();
  traeClientes(valClienteRegistro);
 }else{
  $("#selectcliente").hide();
  $("#selectcli").val("");
  seleccionadorEstudio();
 }
}

function traeClientes() {
  $("#selectcli").html("");
    $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcotizaciones/traetodoClientes/",
        dataType:"json",
        success:function(data) {

          data.forEach(function(element) {
            $("#selectcli").append(new Option(element.nombreCliente, element.idCliente) );
          });

        }, 
        complete: function(){
          if(valClienteRegistro){
             $('#selectcli').val(valClienteRegistro);
          }
        }
    });
}

function traetodasCotizaciones() {
  $("#listamodal").html("");
  // alert("cotizaciones");
  $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcotizaciones/traetodasCot/",
        dataType:"json",
        success:function(data) {
          if (data.length > 0) {
              for (var i = 0; i <= data.length; i++) {
                $("#listamodal").append('<tr>'+
                                                '<td style="padding:0px">'+data[i]['nombreEstudio']+'</td>'+
                                                '<td style="padding:0px">'+data[i]['descuento']+' %</td>'+
                                                '<td style="padding:0px">$ '+data[i]['precioNormal']+'</td>'+
                                                '<td style="padding:0px">$ '+data[i]['precioDescuento']+'</td>'+
                                                '<td style="padding:0px">'+data[i]['cantidad']+'</td>'+
                                            '</tr>'
                                          );
              }
          }
        }
    });
}

    function traepacientes(){
      $('#paciente').autocomplete({
       source: function(request,response){
          $.ajax({
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/buscarNombre/",
            dataType:"json",
            data:{q:request.term},
            success:function(data) {
              response(data);
          }    
          });
       },
       minLength:1,
       select:function(event,ui) {
             $("#idPaciente").val(ui.item.idPaciente);
             $("#correo").val(ui.item.correoPaci);
             asignacionCliente(ui.item.idPaciente);
             $("#radio_31").prop("checked", true);
             validaCliente();
             seleccionadorEstudio();
          }
      });
  }

function seleccionadorEstudio() {
  $("#seccionSelecEstudios").show();
  $("#limpiador").show();
}

function asignacionCliente(idP) {
  var idPaciente = idP;
    $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcotizaciones/traeClientesXidPaciente/"+idPaciente,
        dataType:"json",
        success:function(data) {
          // alert(data);
          if (data.length > 0) {
              for (var i = 0; i <= data.length; i++) {
                $("#selectcli").append(new Option(data[i]["nombreCliente"], data[i]["idCliente"]));
              }
          }
        }
    });
}

function traetodosEstudios() {
  $("#listaEstudios").html("");
  var cliente = $("#selectcli").val();
  // alert("el cliente es: "+cliente);
  if (cliente == "" || cliente == null) {
      $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcotizaciones/traetodosestudios/",
        dataType:"json",
        success:function(data) {
          if (data.length > 0) {
              for (var i = 0; i <= data.length; i++) {
                $("#listaEstudios").append('<tr>'+
                                                '<td style="padding:0px">'+data[i]['nombreEstudio']+'</td>'+
                                                '<td style="padding:0px">'+data[i]['indicacionesPaciente']+'</td>'+
                                                '<td style="padding:0px"><div class="input-group input-group-lg"  style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="number" id="descuento'+data[i]['IdEstudio']+'" name="descuento'+data[i]['IdEstudio']+'" class="form-control" value="0" onclick="this.select();" style="height: 20px;"></div></div></td>'+
                                                '<td style="padding:0px"><div class="input-group input-group-lg" style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="text" id="precio'+data[i]['IdEstudio']+'" name="precio'+data[i]['IdEstudio']+'" value="'+data[i]['precioPublico']+'" class="form-control"  style="height: 20px;"></div></div></td>'+
                                                '<td style="padding:0px"><div class="input-group input-group-lg" style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="number" id="cantidad'+data[i]['IdEstudio']+'" name="cantidad'+data[i]['IdEstudio']+'" value="1" class="form-control" onclick="this.select();"  style="height: 20px;"></div></div></td>'+
                                                '<td style="padding:0px">'+
                                                  '<a href="#" onclick="agregapCotizar('+data[i]['IdEstudio']+')">Agregar'+
                                                    
                                                  '</a>'+
                                                '</td>'+
                                            '</tr>'
                                          );
              }
          }
        }
    });
  }else{
    // alert("Tienes precios especiales");
      $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcotizaciones/traetodosestudiosXcliente/"+cliente,
        dataType:"json",
        success:function(data) {
          if (data.length > 0) {
              for (var i = 0; i <= data.length; i++) {
                $("#listaEstudios").append('<tr>'+
                                                '<td style="padding:0px">'+data[i]['nombreEstudio']+'</td>'+
                                                '<td style="padding:0px">'+data[i]['indicacionesPaciente']+'</td>'+
                                                '<td style="padding:0px"><div class="input-group input-group-lg"  style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="number" id="descuento'+data[i]['IdEstudio']+'" name="descuento'+data[i]['IdEstudio']+'" class="form-control" value="0" onclick="this.select();" style="height: 20px;"></div></div></td>'+
                                                '<td style="padding:0px"><div class="input-group input-group-lg" style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="text" id="precio'+data[i]['IdEstudio']+'" name="precio'+data[i]['IdEstudio']+'" value="'+data[i]['precio']+'" class="form-control"  style="height: 20px;"></div></div></td>'+
                                                '<td style="padding:0px"><div class="input-group input-group-lg" style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="number" id="cantidad'+data[i]['IdEstudio']+'" name="cantidad'+data[i]['IdEstudio']+'" value="1" class="form-control" onclick="this.select();"  style="height: 20px;"></div></div></td>'+
                                                '<td style="padding:0px">'+
                                                  '<a href="#" onclick="agregapCotizar('+data[i]['IdEstudio']+')">Agregar'+
                                                    
                                                  '</a>'+
                                                '</td>'+
                                            '</tr>'
                                          );
              }
          }else{
              swal('Lo sentimos','No hay precios especiales ni descuentos en ningun estudio para la Empresa en la que estas registrado','warning');
              $.ajax({
                url:"http://localhost/CDI/Panel/index.php/Crudcotizaciones/traetodosestudios/",
                dataType:"json",
                success:function(data) {
                  if (data.length > 0) {
                      for (var i = 0; i <= data.length; i++) {
                        $("#listaEstudios").append('<tr>'+
                                                        '<td style="padding:0px">'+data[i]['nombreEstudio']+'</td>'+
                                                        '<td style="padding:0px">'+data[i]['indicacionesPaciente']+'</td>'+
                                                        '<td style="padding:0px"><div class="input-group input-group-lg"  style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="number" id="descuento'+data[i]['IdEstudio']+'" name="descuento'+data[i]['IdEstudio']+'" class="form-control" value="0" onclick="this.select();" style="height: 20px;"></div></div></td>'+
                                                        '<td style="padding:0px"><div class="input-group input-group-lg" style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="text" id="precio'+data[i]['IdEstudio']+'" name="precio'+data[i]['IdEstudio']+'" value="'+data[i]['precioPublico']+'" class="form-control"  style="height: 20px;"></div></div></td>'+
                                                        '<td style="padding:0px"><div class="input-group input-group-lg" style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="number" id="cantidad'+data[i]['IdEstudio']+'" name="cantidad'+data[i]['IdEstudio']+'" value="1" class="form-control" onclick="this.select();"  style="height: 20px;"></div></div></td>'+
                                                        '<td style="padding:0px">'+
                                                          '<a href="#" onclick="agregapCotizar('+data[i]['IdEstudio']+')">Agregar'+
                                                            
                                                          '</a>'+
                                                        '</td>'+
                                                    '</tr>'
                                                  );
                        }
                    }
                  }
              });
          }
        }
    });
  }
  

}

 	var array = {
                'datosPermiso': []
              };
   var arregloJson;


  function EjecutaBusqueda(e){
   var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
        buscar();
    }
  }

function buscar() {	
    $("#listaEstudios").html("");
    var estudio = $("#buscar").val();
    $.ajax({
      	url:"http://localhost/CDI/Panel/index.php/Crudcotizaciones/traeestudiosRelacionados/"+estudio,
      	dataType:"json",
      	success:function(data) {
        	if (data.length > 0) {
          		for (var i = 0; i <= data.length; i++) {
            		$("#listaEstudios").append('<tr>'+
		                                            '<td style="padding:0px">'+data[i]['nombreEstudio']+'</td>'+
		                                            '<td style="padding:0px">'+data[i]['indicacionesPaciente']+'</td>'+
		                                            '<td style="padding:0px"><div class="input-group input-group-lg"  style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="number" id="descuento'+data[i]['IdEstudio']+'" name="descuento'+data[i]['IdEstudio']+'" class="form-control" value="0" onclick="this.select();"  style="height: 20px;"></div></div></td>'+
		                                            '<td style="padding:0px"><div class="input-group input-group-lg" style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="text" id="precio'+data[i]['IdEstudio']+'" name="precio'+data[i]['IdEstudio']+'" value="'+data[i]['precioPublico']+'" class="form-control" style="height: 20px;"></div></div></td>'+
		                                            '<td style="padding:0px"><div class="input-group input-group-lg" style="margin: 0px;"><div class="form-line" style="width: 50%;"><input type="number" id="cantidad'+data[i]['IdEstudio']+'" name="cantidad'+data[i]['IdEstudio']+'" value="1" class="form-control" onclick="this.select();" style="height: 20px;"></div></div></td>'+
		                                            '<td style="padding:0px">'+
		                                              '<a href="#" onclick="agregapCotizar('+data[i]['IdEstudio']+')">Agregar'+
		                                                
		                                              '</a>'+
		                                            '</td>'+
		                                        '</tr>'
		                                      );
          		}
        	}
      	}
    });
}

  function agregapCotizar(idestudio) {
    var est = idestudio;
    var pu = $("#precio"+est).val();
    var desc = $("#descuento"+est).val();
    var uni = $("#cantidad"+est).val();
    // alert("se va a cotizar el estudio con id: "+pu+" "+desc+" "+uni);
        var parametros = {
      		"est":est
        };
        var impo = parseInt(uni)*parseFloat(pu);
        var calDesc = (parseFloat(impo)*parseInt(desc)) / 100;
        var totalfinal = impo-calDesc;
        //alert("Estudio agregado a cotización");
            $.ajax({
                url:"<?php echo site_url('Crudcotizaciones/traesInfo/'); ?>",
                type: "POST",
                data: parametros,
                dataType: "json",
                success:function(data) {
                //  alert(data)
                // paso 2 
                 array.datosPermiso.push({'idestudio': est, 'descuento':desc,'precio':pu, 'cantidad':uni, 'total': totalfinal});
                 //var importe += parseFloat(pu);
                // for (var i = 0; i < 30; i++) {
                // 	var importy += parseFloat(totalfinal);
                // 	alert(importy);
                // }
		         	// var indice=  $(this).closest('tr').index();
              //alert("i: "+data.nombreEstablec+" 2: "+nombrePues)
             $("#listaArrayEstudio").append('<tr><td>'+data.nombreEstudio+'</td><td>'+uni+'</td><td>$ '+pu+'</td><td>'+desc+' %</td><td>$ '+totalfinal+'<input type="hidden" id="estudio'+est+'" name="estudio'+est+'" value="'+totalfinal+'"></td><td style="cursor: pointer"  class="prueba"><a href="#" onclick="restarmonto('+est+');">Eliminar</a></td></tr>');
             $("#importetotal").show();
             calculatotal(totalfinal);
             $("#cotizacionestabla").show();
             // alert("entra"+arregloJson);
             // fin 2
           }
         });
  }

var totaltotal = 0;
  function calculatotal(total) {
    var cero = $("#importetot").val();
    if (cero == 0) {
      totaltotal = 0;
    }
    var totalparcial = total;
    // alert(totalparcial);
    totaltotal = parseFloat(totalparcial) + parseFloat(totaltotal);
    // alert(totaltotal);
    $("#importetot").val(totaltotal);
    $("#botoncotizar").show();
  }

function restarmonto(idest) {
  var montoArestar = $("#estudio"+idest).val();
  // alert(montoArestar);
  var montototal = $("#importetot").val();
  var newmontototal = parseFloat(montototal) - parseFloat(montoArestar);
  $("#importetot").val(newmontototal);
  if (newmontototal == 0) {
    $("#botoncotizar").hide();
  }
}

 function altarCotizacion()
 {
  // alert("entra");
  // var url;
  //    url= " 'http://cointic.com.mx/IntraNet/Admin/index.php/Crudcomunicados/altamacivo/';";
    var idUser = $("#idusuario").val();
    var totaltotal = $("#importetot").val();
     var controlOrden = $("#controlOrden").val();
    // var descuento = $("#descuento").val();
    // var iva = $("#iva").val();
     arregloJson=JSON.stringify(array);
     arre = JSON.parse(arregloJson);

      var parametross = {
              "idUser":idUser,
              "totaltotal":totaltotal,
              "controlOrden":controlOrden,
              "arreglo":arre
          };

           $.ajax({
            url:"<?php echo site_url('Crudcotizaciones/altamacivo/'); ?>",
            type: "POST",
            data: parametross,
            dataType: "HTML",
            success: function(data)
           {
           	// alert(data);
            // swal({
            //               title: '¡Correcto!',
            //               text: "La cotizacion se ha pubicado Exitosamente.",
            //               type: 'success',
            //               showCancelButton: false,
            //               confirmButtonColor: '#3085d6',
            //               cancelButtonColor: '#d33',
            //               confirmButtonText: 'Ok',
            //               cancelButtonText: 'No, cancel!',
            //               confirmButtonClass: 'btn btn-success',
            //               cancelButtonClass: 'btn btn-danger',
            //               buttonsStyling: false
            //             }, function() {

            //               history.back();

            //             }, function (dismiss) {
            //               // dismiss can be 'cancel', 'overlay',
            //               // 'close', and 'timer'
            //               if (dismiss === 'cancel') {
            //                 swal(
            //                   'Cancelled',
            //                   'Your imaginary file is safe :)',
            //                   'error'
            //                 )
            //               }
            //             });

            enviarmail(data);
           },
           error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
            });
 }

function tre(){
  $('#buscar').autocomplete({
   source: function(request,response){
      $.ajax({
      
        url:"http://localhost/CDI/Panel/index.php/Crudcotizaciones/AutocompletaEstudio/",
        dataType:"json",
        data:{q:request.term},
        success:function(data) {
          response(data);
        }    
      });
   },
   minLength:1,
   select:function(event,ui) {
        //alert("nombre "+ ui.item.value+"id "+ui.item.correoPersonal)
        $("#idEstudio").val(ui.item.IdEstudio);
      }
  });
}

function enviarmail(dato) {
  var idcot = dato;
  // alert("en breve se enviara un correo al Paciente, Cotización con id:"+idcot);
  var nombrePac = $("#paciente").val();
  var correoPac = $("#correo").val();
  var option = $('input[name=cliente]:checked').val();
  if (option == "si") {
    var cliente = $("#selectcli").val();
  }else{
    var cliente = "Paciente Particular";
  }
  var total = $("#importetot").val();

  arregloJson=JSON.stringify(array);
  arre = JSON.parse(arregloJson);
  
  var data = {nombrePac:nombrePac,correoPac:correoPac,cliente:cliente,total:total,idcot:idcot}//,arre:arre
      $.ajax({
                url: "http://localhost/CDI/Panel/index.php/Crudcotizaciones/sendMail/",
                type: "post",
                dataType: "json",
                data: data
                // cache: false,
                // contentType: false,
                //  processData: false
            })
                .done(function(res){
                   if(res==1)
                   {
                    swal({
                        title: "ÉXITO",
                        text: "La cotización se ha enviado correctamente al correo "+correoPac+".",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false
                      },
                      function(){
                        location.href='http://localhost/CDI/Panel/index.php/Crudcotizaciones';
                      });
                      
                   }
                   if (res==2)
                   {
                      swal("Aviso", "Hubo un error vuelva a intentarlo :)", "error");
                   }
                });
}

// Arreglo para almacenar cotizaciones

$(document).on('click', '.prueba', function (event) {
    event.preventDefault();
    var indice=  $(this).closest('tr').index(); //para eliminar el registro de la tabla y en el crud
                  $(this).closest('tr').remove();
                  //alert (event);
                  array.datosPermiso.splice(indice, 1);
                //  delete array.datosPermiso[indice]; //para eliminar el registro de la tabla y en el crud
                  // alert("indice"+indice+"precio2 "+precio2);
                  // alert("indice"+array.datosPermiso);
                  if(array.datosPermiso.length > 0)
                  {
                    for(i=0; i<array.datosPermiso.length; i++)
                    {
                      //alert (array.producto[i]);
                      jQuery.each(array.datosPermiso[i], function(i,val)
                      {
                         // alert("valor"+val+"indice"+i);
                       });
                    }
                  }
});

  </script>
 <!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->
  <script src="http://localhost/CDI/Panel/content/js/funcionescita.js"></script>
  <script src="http://localhost/CDI/Panel/content/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

    <!-- Slimscroll Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/raphael/raphael.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="http://localhost/CDI/Panel/content/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="http://localhost/CDI/Panel/content/js/admin.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="http://localhost/CDI/Panel/content/js/demo.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="http://localhost/CDI/Panel/content/js/pages/tables/jquery-datatable.js"></script>




    <!-- Jquery Validation Plugin Css -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="http://localhost/CDI/Panel/content/js/pages/forms/form-validation.js"></script>
    
    <script src="http://localhost/CDI/Panel/content/js/pages/forms/basic-form-elements.js"></script>
  
<!-- <?php 
  //include "footer.php";
 ?> -->