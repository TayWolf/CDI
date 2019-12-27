<?php 
  include "header.php";
   $contador=0;
 ?>
 
<style type="text/css">

.degrado{
    background-color: #293a4ab5;
    color: #fff;
   
}
.input-group.input-group-lg .form-control {
    font-size: 14px;
   
}

.input-group{
  margin-bottom: 0px;
}
.card .body .col-xs-4, .card .body .col-sm-4, .card .body .col-md-4, .card .body .col-lg-4{
  margin-bottom: 0px;
}

#table-wrapper {
  position:relative;
}
#table-scroll {
  height:230px;
  overflow:auto;  
  /*margin-top:20px;*/
}
#table-wrapper table {
  width:100%;

}
#table-wrapper table * {
  /*background:yellow;*/
  color:black;
}
#table-wrapper table thead th .text {
  position:absolute;   
  top:-20px;
  z-index:2;
  height:20px;
  width:35%;
  border:1px solid red;
}



.disabled {
  /*pointer-events: none;*/
  cursor: default;
  opacity: 0.6;
}

.table tr{

        white-space:nowrap;
       }

</style>

<style>
    table.estiloPer {
        border-collapse: separate;
        border-spacing: 10px;      }
    table.estiloPer > th, table.estiloPer > td {
        padding: 2px;
    }
    table.estiloPer > tbody> tr
    {
        vertical-align: top;
    }
     
     

</style>
<script src="http://localhost/CDI/Panel/content/js/jquery-1.12.4.js"></script>
  <script src="http://localhost/CDI/Panel/content/js/jquery-ui.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>

<link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
 <link rel="stylesheet" href="http://localhost/CDI/Panel/content/css/jquery-ui.css">
<script src="http://localhost/CDI/Panel/content/js/ConcurrentThread-full.js"></script>

<div class="modal fade" id="myModalModificHor" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Horarios disponibles</h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered estiloPer">
                    <tbody id="contenidoDispone">
                      
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

<form id="formaltaPac"  method="post"></form>
<form id="form" method="post" ></form> 

<section style="margin-left: 15px;" class="content no-print">

    <div class="container-fluid">
      
        <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            
                            <div class="body">
                              <input form="form" type="hidden" id="inputduracion" name="inputduracion">
                           <div class="content" style="border-bottom: 1px solid #ccc">
                              <div class="center" align="center" style="margin-bottom: 20px;">
                                    <h3 style="margin: 0px;">Datos de la cita</h3>
                              </div>
                            <div class="row clearfix">
                              <div class="col-md-2" id="divfecha">
                                    <p>
                                        <b>Fecha</b>
                                    </p>
                                      <?php $hoy=date("Y-m-d");
                                     $hora = date('H:i:s');
                                     
                                      ?>
                                    <div class="input-group input-group-lg">
                                        <div class="form-line">
                                            <input form="form" type="date" id="fecha" name="fecha" class="form-control degrado" style="border-radius: 8px;" value="<?php echo $fech; ?>" required onchange="diaSemana(1);limpiamodal(); traedisponibilidad(); traecitaPropuesta(); traerCitas()">
                                            <input form="form" type="hidden" id="idDiainput" name="idDiainput" >
                                            <input form="form" type="hidden" id="fechaOcuta" name="fechaOcuta" value="<?php echo $hoy; ?>">
                                            <input form="form" type="hidden" id="horaActual" name="horaActual" value="<?php echo $hora; ?>">
                                        </div>
                                    </div>  
                                </div>
                                <div class="col-md-2">
                                    <p>
                                        <b>Sala</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                      <div class="form-line">
                                        <select form="form" id="Salas" name="Salas" class="form-control show-tick degrado" data-live-search="true" required onchange="traeMedico();limpiainputshora();limpiamodal(); traedisponibilidad(); traecitaPropuesta(); traerCitas()" style="border-radius: 8px;"> 
                                          <option value="">Seleccione Sala</option>
                                          <?php 
                                          foreach ($salas as $row ) {
                                            $idSala=$row["idSala"];
                                            $nombreSala=$row["nombre"];
                                            echo "<option value='$idSala'>$nombreSala</option>";
                                          }
                                           ?>

                                        </select>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-4" id="divmedico" style="display: none;">
                                    <p>
                                        <b>Médico</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                      <div class="form-line">
                                        <select form="form" id="medico" name="medico" class="form-control show-tick degrado" style="border-radius: 8px;" required onchange="diaSemana(1);limpiainputshora();limpiamodal();traedisponibilidad();traecitaPropuesta(); traerCitas()" >
                                        </select>
                                      </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <p>
                                        <b>Estudio</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        
                                        <div class="form-line">
                                            <input form="form" type="text" id="nombreEstudio" name="nombreEstudio" onkeyup="form.nombreEstudio.value=form.nombreEstudio.value.toUpperCase();"  class="form-control degrado" placeholder="Nombre del Estudio" onchange="limpiainputshora();" style="border-radius: 8px;" required >
                                            <input form="form" type="hidden" name="Estud" id="Estud">
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-md-2">
                                      <p>
                                          <b>Entrega resultado</b>
                                          <span><button class="btn btn-secondary btn-lg" id="colorRes" type="button" ></button><!-- <input type="checkbox" name="gsss" id="gsss" class="filled-in chk-col-light-blue"  value="0" /><label for="gsss"></label> --></span>
                                      </p>
                                      <div class="input-group input-group-lg">
                                          
                                          <div class="form-line">
                                            <input type="hidden" form="form" id="Priorid" name="Priorid">
                                              <input  type="date" form="form" id="fechaEntre" onchange="validarColor()" name="fechaEntre" class="form-control degrado"  style="border-radius: 8px;" required >
                                               
                                          </div>
                                      </div>                    
                                </div>
                               
                            </div>
                            <div class="row">
                                <div id="visualDisponibilidad" style="display: block;">
                                  <div class="modal-header col-md-12" style="background: #e8e8e8;margin-bottom: 0px;padding-bottom: 0px;">
                                    
                                    <div style="display: none;">
                                      <div class="col-md-2 col-sm-2 col-xs-2" style="margin-bottom: 0px;">
                                        <div class="input-group input-group-lg" style="margin: 0px;">
                                          <div class="form-line">
                                              <input type="date" id="fechamodal" name="fechamodal" class="form-control" onchange="traedisponibilidad(); traerCitas();diaSemana(0)">
                                              <input type="hidden" id="inputduracion" name="inputduracion">
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-2 col-sm-2 col-xs-2" id="duracionEstudio" align="center" style="margin-bottom: 0px;"></div>
                                      
                                            <input type="checkbox" name="estadourgencia" id="estadourgencia" class="filled-in chk-col-light-blue" onchange="cambiaCheck();" value="0" />
                                            <label for="estadourgencia">Urgencia</label>
                                     
                                    

                                      <div class="col-md-2 col-sm-2 col-xs-2" style="margin-bottom: 0px; width: 15%"  >
                                           <button class="btn btn-secondary btn-lg" type="button" style=" background: #ffca00;"></button>
                                                    <span>No diponible</span>
                                      </div> 
                                      <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0; padding:0;width: 15%" >
                                          <button class="btn btn-secondary btn-lg" type="button" style=" background: #293a4ab5;"></button>
                                                    <span>Hora Principal</span>
                                      </div>  
                                     <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0; padding:0; width: 15%">
                                           <button class="btn btn-secondary btn-lg" type="button" style=" background: #a2e9b0;"></button>
                                                   <!--  <span>Horario para cita</span> -->
                                                    <span>Horas seleccionadas</span>
                                    </div>  

                                    <!--  <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0; padding:0; width: 15%">
                                           <button class="btn btn-secondary btn-lg" type="button" style=" background: #FFFF00; "></button>
                                                    <span>Horas seleccionadas</span>
                                    </div> -->
                                    
                                    </div> 
                                  </div>
                                  <div class="col-md-8 col-md-offset-2" align="center" style="margin-top: 10px;margin-bottom: 0px;">
                                    <p>Por favor seleccione el horario en que deseas asignar la cita.</p>
                                  </div>
                                  
                                    <div class="col-md-12">
                                        <div class="col-md-8 col-sm-8">
                                            <div align="center" class="table-responsive">
                                                <table class="estiloPer">
                                                    <thead>
                                                    </thead>
                                                    <tbody id="modal-body" style="font-family: Tahoma"></tbody>
                                                </table>
                                            </div>
                                            <!--AQUI-->
                                  
                                    <div class="row" style="padding: 20px; text-align: left;">
                                      
                                    </div>
                                    
                                    <div class="col-md-12" align="center">
                                      <div class="col-md-2" id="divhorainicio" style="display: none;">
                                                  <p>
                                                      <b>Hora Inicio</b>
                                                  </p>
                                                  <div class="input-group input-group-lg">
                                                      <div class="form-line">
                                                          <input form="form" type="time" id="horainicio" name="horainicio" class="form-control" required readonly onclick="alertadisponibilidad();">
                                                      </div>
                                                  </div>  
                                              </div>
                                              <div class="col-md-2" id="divhoratermino" style="display: none;">
                                                  <p>
                                                      <b>Termina</b>
                                                  </p>
                                                  <div class="input-group input-group-lg">
                                                      <div class="form-line">
                                                          <input form="form" type="time" id="horatermino" name="horatermino" class="form-control" required readonly onclick="alertadisponibilidad();">
                                                      </div>
                                                  </div>  
                                              </div>
                                      <button form="form" type="button" class="btn btn-primary" onclick="AsignahorasEstablecidas();" style=" text-align: left;">Apartar horario</button> 
                                       <button form="form" id="botonaltapaciente"type="button" class="btn btn-primary" onclick="mostrarRegistro()"data-toggle="modal">Registrar Paciente</button>
                                  
                                    </div>
                                    <div class="row clearfix" id="horasSeleccionadas">
                                              
                                                <div id="datosPacien" style="display:block;">
                                                   <div class="col-md-5">
                                                        <p>
                                                            <b>Nombre del Paciente</b>
                                                        </p>
                                                        <div class="input-group input-group-lg">
                                                            <span class="input-group-addon" style="cursor:pointer;"><a id="editModal" onclick="visualModalEdit()" style="display: none">Editar</a>
                                                                <i class="material-icons">person</i>
                                                            </span>
                                                            <div class="form-line">
                                                                <input form="form" type="text" id="paciente" onkeyup="form.paciente.value=form.paciente.value.toUpperCase();"  style="border-radius: 8px;" onkeypress="tre();" name="paciente" class="form-control degrado" placeholder="Nombre del paciente" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="col-md-3">
                                                      <p>
                                                          <b>Orden Médica</b>
                                                      </p>
                                                      <div class="input-group input-group-lg">
                                                          <span class="input-group-addon">
                                                              <i class="material-icons">assignment</i>
                                                          </span>
                                                          <div class="form-line">
                                                            <input form="form" type="hidden" id="idUser" name="idUser" value="<?=$this->session->userdata('idUser'); ?>">
                                                             
                                                            <input form="form" type="hidden" name="fechaAct" id="fechaAct" value="<?php echo date('Y-m-d'); ?>">
                                                              <input form="form" type="text" id="orden" name="orden" style="border-radius: 8px;" class="form-control degrado">
                                                          </div>
                                                      </div>
                                                    </div>
                                                    <div id="tipoCit" style="display: none;">
                                                      <div class="col-md-4">
                                                          <p>
                                                              <b>Tipo Cita</b>
                                                          </p>
                                                          <div class="input-group input-group-lg">
                                                            <div class="form-line">
                                                              <select form="form" id="tipoCi" name="tipoCi" class="form-control show-tick degrado" data-live-search="true" required style="border-radius: 8px;"> 
                                                              </select>
                                                            </div>
                                                          </div>
                                                      </div>
                                                    </div>
                                                                  
                                                     <div class="col-md-12" style="display: inline-block;margin-bottom: 0px;">
                                                      <div id="modal-alert-div" class="col-md-12">
                                                      <div id="modal-alert" class="col-md-12" align="center" style="margin-bottom: 20px;"></div>
                                                      </div>
                                                    </div>        
                                     </div>
                                    </div>
                                    <div class="row" >
                                      <div id="visualFavt" style="display: none;">
                                        <div class="col-md-4">
                                          <p>
                                            <b>Factura</b>
                                          </p>
                                          <div class="input-group input-group-lg">
                                              <div class="form-line">
                                                  <select form="form" id="FactSn" name="FactSn" class="form-control show-tick degrado" data-live-search="true" style="border-radius: 8px;"> 
                                                      <option value="">Selecciones una opcion</option>
                                                      <option value="1">Si</option>
                                                      <option value="2">No</option>
                                                  </select>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                        
                                        <div class="col-md-2">
                                          <input type="checkbox" form="form" name="cortesiaCit" id="cortesiaCit" class="filled-in chk-col-light-blue" value="0" onclick="corteVisual()" />
                                              <label for="cortesiaCit"><b>Cortesía</b></label>
                                        </div>
                                        <div class="col-md-4" id="visualCortes" style="display: none;">
                                            <p>
                                              <b>Tipo cortesía</b>
                                            </p>
                                            <div class="input-group input-group-lg">
                                                <div class="form-line">
                                                    <select form="form" id="tipCortes" name="tipCortes" class="form-control show-tick degrado" data-live-search="true" required style="border-radius: 8px;"> 
                                                        <option value="0">Selecciones una opcion</option>
                                                        <option value="1">Socios</option>
                                                        <option value="2">Enviado por médico</option>
                                                        <option value="3">Familiares socios</option>
                                                        <option value="4">Pacientes observaciones</option>
                                                        <option value="5">Especiales</option>
                                                        <option value="6">Requisiciones</option>
                                                    </select>
                                                </div>
                                            </div>
                                          </div> 
                                      </div>     
                                        <div class="row clearfix">
                                           <div id="autorizaBoton" style="display: none;" align="center">
                                              <div class="button-demo">
                                                <input form="form" type="submit" class="btn bg-black waves-effect waves-light" value="Modificar Cita">
                                              </div>
                                            </div>
                                        </div>
                                        <input form="form" type="hidden" id="idCiMod" name="idCiMod" value="<?php echo $idCi;?>">
                                        <input form="form" type="hidden" id="horacita" name="horacita">
                                        
                                      
                                  <!--otra vez aqui-->
                                  </div>
                                      <div class="col-md-4 col-sm-4" style="padding-right: 70px; padding-left:70px; ">
                                        <div id="registroPacientes" style="display: none;">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                             <div class="modal-header" style="padding-top: 0px; padding-bottom: 0px;">
                                             
                                             <!-- <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button> -->
                                                <h4 class="modal-title">REGISTRO DE NUEVO PACIENTE</h4>
                                              </div>
                                              <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px;">
                                                <div class="body" style="padding-bottom: 0px;" >
                                                    <div class="row clearfix">
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                                       
                                                        <div class="body" style="padding-top: 0px; padding-bottom: 0px;">
                                                          
                                                           <div class="row clearfix">
                                                             <div class="col-md-12" style="padding-left: 0px; margin-bottom: 0px;">
                                                               <div class="form-group form-float">
                                                                  <div class="form-line focused">
                                                                    <input form="formaltaPac" type="text" class="form-control" id="clave" name="clave" required="" readonly="">
                                                                    <label class="form-label">Clave</label>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              </div>
                                                           </div> 
                                                    <div class="row">
                                                      <div class="col-md-12" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div class="form-line">
                                                              <input form="formaltaPac" type="text" class="form-control" style="" id="nombre" name="nombre" onkeyup="form.nombre.value=form.nombre.value.toUpperCase();"  required>
                                                              <label class="form-label">Nombre del paciente</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                   <div class="row clearfix">
                                                      <div class="col-md-12" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div class="form-line">
                                                              <select id="genero" form="formaltaPac" class="form-control" class="form-control" name="genero" required>    
                                                                    <option value="">Seleccione un género</option>
                                                                    <option value="1">Masculino</option>
                                                                    <option value="2">Femenino</option>
                                                              </select>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-sm-12" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div class="form-line">
                                                            <input id="correo" form="formaltaPac" type="text" class="form-control" name="correo" required>
                                                            <label class="form-label">Correo</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-sm-12" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div class="form-line">
                                                            <input id="telefono" form="formaltaPac" type="text" class="form-control" name="telefono" onkeyup="form.telefono.value=form.telefono.value.toUpperCase();"required>
                                                            <label class="form-label">Teléfono</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-sm-8" style="margin-bottom: 0px;">
                                                          <div class="form-group form-float">
                                                            <div  class="form-line">
                                                              <input id="fechanacimiento" form="formaltaPac" type="date" class="form-control" name="fechanaci" id="fechanaci"  required onchange="calcularEdad();">
                                                              <label class="form-label">Fecha de Nacimiento</label>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-4" style="margin-bottom: 0px;">
                                                          <div class="form-group form-float">
                                                            <div  class="form-line">
                                                              <input form="formaltaPac" type="number" class="form-control" name="edad" id="edad" required>
                                                              <label class="form-label" id="edadLabel">Edad</label>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-sm-12" style="margin-bottom: 0px;">
                                                          <p><b>Médico Remitente</b></p>
                                                         <div class="form-group form-float">
                                                            <div class="form-line">
                                                              <select  id="medicoremitente"form="formaltaPac" class="form-control" class="form-control" name="remitente" id="remitente"  required>    
                                                                    <option value="">Seleccione un Médico Remitente</option>
                                                                    <?php   
                                                                      $idconteo=0;
                                                                      foreach ($medicoRem as $row) {
                                                                        $idRemitente=$row['idRemitente'];
                                                                        $nombreRem=$row['nombreRem'];
                                                                       //$idconteo++; .
                                                                          echo "
                                                                                 <option value='$idRemitente'>$nombreRem</option>
                                                                                             ";
                                                                                            }
                                                                    ?>
                                                              </select>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="col-sm-12" style="margin-bottom: 0px;">
                                                          <p><b>Cliente</b></p>
                                                          <div class="form-group form-float">
                                                            <div class="form-line">
                                                              <select id="cliente" form="formaltaPac" class="form-control" class="form-control" name="cliente" id="cliente" required>    
                                                              <option value="">Seleccione un Cliente</option>
                                                                <?php   
                                                                  $idconteo=0;
                                                                    foreach ($cliente as $row) {
                                                                      $idCliente=$row['idCliente'];
                                                                      $nombreCliente=$row['nombreCliente'];
                                                                       //$idconteo++; .
                                                                      echo "
                                                                          <option value='$idCliente'>$nombreCliente</option>
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
                                                          <button form="formaltaPac"  type="submit" class="btn btn-primary m-t-15 waves-effect">Aceptar</button>
                                                         <div id="cargando" style="display: none;"></div>
                                                        </div>
                                                      </div>
                                                    
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div id="visualVentanaEdi" style="display: none;">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                             <div class="modal-header" style="padding-top: 0px; padding-bottom: 0px;">
                                             
                                             <!-- <button type="button" class="close" data-dismiss="modal" title="Cancelar">&times;</button> -->
                                                <h4 class="modal-title">Editar datos de paciente</h4>
                                              </div>
                                              <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px;">
                                                <div class="body" style="padding-bottom: 0px;" >
                                                   <form method="post" action="" id="formPc">
                                                    <div class="row clearfix">
                                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                                        <div class="body" style="padding-top: 0px; padding-bottom: 0px;">
                                                          
                                                           <div class="row clearfix">
                                                             <div class="col-md-12" style="padding-left: 0px; margin-bottom: 0px;">
                                                               <div class="form-group form-float">
                                                                  <div class="form-line focused">
                                                                    <input  type="text" class="form-control" id="claveEdi" name="claveEdi" required="" readonly="">
                                                                    <label class="form-label">Clave</label>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              </div>
                                                           </div> 
                                                    <div class="row">
                                                      <div class="col-md-12" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div class="form-line">
                                                              <input  type="text" class="form-control" style="" id="nombreEdit" name="nombreEdit"   value=" " required>
                                                              <label class="form-label">Nombre del paciente</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                   <div class="row clearfix">
                                                      <div class="col-md-12" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div class="form-line">
                                                              <select id="generoEdi"  class="form-control" class="form-control" name="generoEdi" required>    
                                                                    <option value="">Seleccione un género</option>
                                                                    <option value="1">Masculino</option>
                                                                    <option value="2">Femenino</option>
                                                              </select>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-sm-12" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div class="form-line">
                                                            <input id="correoEd"  type="text" class="form-control" name="correoEd" value=" " required>
                                                            <label class="form-label">Correo</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-sm-12" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div class="form-line">
                                                            <input id="telefonoEdi" type="text"  class="form-control" name="telefonoEdi"  value=" " required>
                                                            <label class="form-label">Teléfono</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                      <div class="col-sm-8" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div id="liff" class="form-line focused">
                                                            <input  type="date" class="form-control" name="fechanaciEdi" id="fechanaciEdi" value=" " required onchange="calcularEdad();">
                                                            <label class="form-label">Fecha de Nacimiento</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-4" style="margin-bottom: 0px;">
                                                        <div class="form-group form-float">
                                                          <div  class="form-line focused">
                                                            <input type="number" class="form-control" name="edadEdi" id="edadEdi" value=" " required>
                                                            <label class="form-label" id="edadLabel">Edad</label>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                      <div class="col-sm-12" style="margin-bottom: 0px;">
                                                        <p><b>Médico Remitente</b></p>
                                                       <div class="form-group form-float">
                                                          <div class="form-line">
                                                            <select  id="medicoremitenteEdi" class="form-control" class="form-control" name="medicoremitenteEdi"  required>    
                                                                  <option value="">Seleccione un Médico Remitente</option>
                                                                  <?php   
                                                                    $idconteo=0;
                                                                    foreach ($medicoRem as $row) {
                                                                      $idRemitente=$row['idRemitente'];
                                                                      $nombreRem=$row['nombreRem'];
                                                                     //$idconteo++; .
                                                                        echo "
                                                                               <option value='$idRemitente'>$nombreRem</option>
                                                                                           ";
                                                                                          }
                                                                  ?>
                                                            </select>
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div class="col-sm-12" style="margin-bottom: 0px;">
                                                        <p><b>Cliente</b></p>
                                                        <div class="form-group form-float">
                                                          <div class="form-line">
                                                            <select  class="form-control" class="form-control" name="clienteEdit" id="clienteEdit" required>    
                                                            <option value="">Seleccione un Cliente</option>
                                                              <?php   
                                                                $idconteo=0;
                                                                  foreach ($cliente as $row) {
                                                                    $idCliente=$row['idCliente'];
                                                                    $nombreCliente=$row['nombreCliente'];
                                                                     //$idconteo++; .
                                                                    echo "
                                                                        <option value='$idCliente'>$nombreCliente</option>
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
                                                        <button   type="submit" class="btn btn-primary m-t-15 waves-effect">Modificar</button>
                                                       <div id="cargando" style="display: none;"></div>
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
                                    </div>
                              <!--<div class="col-md-12" style="display: inline-block;margin-bottom: 0px;">
                                    <div id="modal-alert-div" class="col-md-12">
                                      <div id="modal-alert" class="col-md-12" align="center" style="margin-bottom: 20px;">
                                      </div>
                                    </div>
                                  </div> -->
                                </div>
                            </div>
                          </div>
                        </div>
                        <input form="form" type="hidden" name="HoraTerminada" id="HoraTerminada">
                        <input form="form" type="hidden" name="emergencia" id="emergencia" value="0">
                        <input form="form" type="hidden" name="idPaciente" id="idPaciente">
                        <input form="form" type="hidden" name="valorDuracionEstudio" id="valorDuracionEstudio">
                        <input form="form" type="hidden" name="PropuestahoraCita" id="PropuestahoraCita">
                        <input form="form" type="hidden" name="PropuestaminCita" id="PropuestaminCita">
                        <input form="form" type="hidden" name="idCitarecorrida" id="idCitarecorrida">
                        <input form="form" type="hidden" name="varSalidaAnterior" id="varSalidaAnterior">
                        <input type="hidden" id="durE" name="durE">
                        </div>
                       
                    </div>

                </div>

    </div>
</section>



<style type="text/css">
  .dropdown-item:hover{
    background: #ccc;
  }
</style>

<style type="text/css" media="print">
    .no-print { display: none; }
</style>

 <script type="text/javascript">
  function mostrarRegistro(){
          //  $("#registroPacientes").removeAttr('style');
          var esVisible = $("#registroPacientes").is(":visible");
          if (esVisible)
           {
            $("#registroPacientes").hide();
          }else{
            $("#registroPacientes").show();
            $("#visualVentanaEdi").hide();
            }
        }
        
      function imprimir()
    {


        if($("#fechaInicialHistorial").val()=="")
        {
            $("#groupFechaInicial").addClass('no-print');
        }
        else
        {
            $("#groupFechaInicial").removeClass('no-print');
        }
        if($("#fechaFinalHistorial").val()=="")
        {
            $("#groupFechaFinal").addClass('no-print');
        }
        else
        {
            $("#groupFechaFinal").removeClass('no-print');
        }

        print();

    }

  

function diaSemana(val) {

var idDia;
var medico = $("#medico").val();
if (val ==1) {
  var x = document.getElementById("fecha");
}else{
  var x = document.getElementById("fechamodal");
}
  let date = new Date(x.value.replace(/-+/g, '/'));
  let options = {
    weekday: 'long'
  };
  var dia = date.toLocaleDateString('es-MX', options);
  if (dia == "lunes") {
    idDia = 1;
  }else if (dia == "martes") {
    idDia = 2;
  }else if (dia == "miércoles") {
    idDia = 3;
  }else if (dia == "jueves") {
    idDia = 4;
  }else if (dia == "viernes") {
    idDia = 5;
  }else if (dia == "sábado") {
    idDia = 6;
  }else if (dia == "domingo") {
    idDia = 7;
  }
  
  if (medico!=null) {
    $.ajax({
      url:"http://localhost/CDI/Panel/index.php/Crudcitas/compruebaDiasLaborales/"+idDia+"/"+medico,
      dataType:"json",
      success:function(data) {
        if (data != "") {
            // alert("si hay registros");
            $("#divdispo").show();
            $("#visualDisponibilidad").show();
            $("#idDiainput").val(idDia);
            $("#datosPacien").show();
            $("#horasSeleccionadas").show();
        }else{
            // alert("no hay registros");
            swal("Lo sentimos...","El médico que seleccionaste no labora los días "+dia+" ","warning");
            $("#divdispo").hide();
            $("#visualDisponibilidad").hide();
            $("#autorizaBoton").hide();
            limpiainputshora();
            $("#horasSeleccionadas").hide();
            $("#idDiainput").val("");
             $("#datosPacien").hide();
             $("#horasSeleccionadas").hide();
        }
      } 
    }); 
  }
}

 function alertadisponibilidad() {
   swal("Espera...", "Para cambiar estos valores debes volver a dar clic sobre el botón de 'Ver disponibilidad' ", "warning");
 }
 
 function limpiainputshora() {
  $("#horainicio").val("");
  $("#horatermino").val("");
 }
 function limpiahorainicio() {
  $("#horacita").val("");
  $("#horainicio").val("");
  $("#horatermino").val("");
  $("#divhorainicio").hide();
  $("#divhoratermino").hide();
  $("#emergencia").val("0");
  $("#estadourgencia").attr("checked",false);
  $("#idCitarecorrida").val("");
  $("#listaArticulo").html("");
  $("#idCitarecorrida").val("");
}

    function tre(){

      $('#paciente').autocomplete({
        
       source: function(request,response){
          $.ajax({
          
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/buscarNombre/",
            dataType:"json",
            data:{q:request.term},
            success:function(data) {
              response(data);
              //$("#botonaltapaciente").hide();
              //alert("res")
            },
            error:function(data){
              // alert("Sin Resultados");
              swal("Oops...","Al parecer el paciente que buscas no esta registrado, por favor da clic al boton de 'Registrar paciente', llena el formulario y luego vuelve a intentarlo ","warning");
              //$("#botonaltapaciente").show();
            }
          });
       },

       minLength:1,

       select:function(event,ui) {
            //alert("nombre "+ ui.item.value+"id "+ui.item.correoPersonal)
            var gen = ui.item.generoPaci;
            if (gen==1) 
              {
                gen = "Masculino";
              }
              if (gen==2) 
              {
                gen ="Femenino";
              }
             $("#idPaciente").val(ui.item.idPaciente);
             getClie();
             var idOcu=$("#idPaciente").val();
             if (idOcu!="")
              {
                $("#editModal").show();
              }else{
                $("#editModal").hide();
              }
              
            //$("#sexo").val(gen);
            //$("#correo").val(ui.item.correoPaci);
            //$("#feNa").val(ui.item.fechanaciPaci);
            //$("#edadP").val(ui.item.edadPaci+" Años");
            //$("#telefono").val(ui.item.telefonoPaci);
          }
      });
  }


  /*function traeNombreEstudio() {
       $('#nombreEstudio').autocomplete({
       source: function(request,response){
          $.ajax({
          
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/buscarNombreEstudio/",
            dataType:"json",
            data:{q:request.term},
            success:function(data) {
              response(data);
          }    
          });
       },
       minLength:1,
       select:function(event,ui) {
            $("#Estud").val(ui.item.IdEstudio);
            // pintaestudios(ui.item.IdEstudio);
            //pintaSalas(ui.item.IdEstudio)
          }
      });
   } */


$(document).ready(function() {
  
  $('#nombreEstudio').autocomplete({
       source: function(request,response){
          $.ajax({
          
            url:"http://localhost/CDI/Panel/index.php/Crudcitas/buscarNombreEstudio/",
            dataType:"json",
            data:{q:request.term},
            success:function(data) {
              response(data);
          }    
          });
       },
       minLength:1,
       select:function(event,ui) {
            $("#Estud").val(ui.item.IdEstudio);
             
            //alert(Resultado)
            traedisponibilidad();
            resulFech(ui.item.diasResultado);
            // pintaestudios(ui.item.IdEstudio);
            //pintaSalas(ui.item.IdEstudio)
          }
      });

  });
  
  function addDays(startDate, numberOfDays) {
  return new Date(startDate.getTime() + (numberOfDays * 24 *60* 60 * 1000)).toISOString().slice(0,10);
  }

  function resulFech(dias)
  {
    //var TuFecha = new Date($('#fecha').val());
    var resultado=addDays(new Date($('#fecha').val()), dias);
    $("#fechaEntre").val(resultado);
    $("#colorRes").css("background","#4CAF50"); 
     $("#Priorid").val(1);
    
  }

  function validarColor(){
    var fchiCi=$('#fecha').val();
    var resultado=$("#fechaEntre").val();
    if (fchiCi==resultado)
     {
        $("#colorRes").css("background","#ffeb3b");
        $("#Priorid").val(2);
     }
   
    
  }
function traeMedico() {
  $("#medico").html("");
  var sala = $("#Salas").val();
  // alert("la sala seleccionada es "+sala);
  $("#divmedico").show();
  

  $.ajax({
    url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeDatosMedico/"+sala,
    dataType:"json",
    success:function(data) {
      $("#medico").append(new Option("Selecciona un Médico", ""));
      if (data.length > 0) {
        for (var i = 0; i <= data.length; i++) {
          $("#medico").append(new Option(data[i]['nombreDoc'], data[i]['idDoctor']));
        }
      }
    }    
  });  
}

function traecitaPropuesta() {
  var hora = $("#PropuestahoraCita").val();
  var min = $("#PropuestaminCita").val();
  var asignada = $("#horainicio").val();
  if (asignada != "") {
    asignahoracita(hora,min);
  }
}

function traedisponibilidad() {

  $("#duracionEstudio").html("");
  $("#modal-alert").html("");
  $("#modal-alert-div").css("background","#fff");
  var idsala = $("#Salas").val();
  var Estudio = $("#Estud").val();
  if ($("#fechamodal").val() != "") {
    var fecha = $("#fechamodal").val();
    $('#myModal').modal('show');
    //$("#visualDisponibilidad").show();
    var duracion = traeduracion(Estudio); // definimos una variable que va a valer lo que traiga la funcion "traeduracion"
    noDisponibles(Estudio,idsala,fecha,duracion);
    $("#duracionEstudio").append('<span>Duración: <b> '+duracion+'</b> hr(s)</span>');
    $("#inputduracion").val(duracion);
  }else{
    var fecha = $("#fecha").val();
    $("#fechamodal").val(fecha);
    $('#myModal').modal('show');
   // $("#visualDisponibilidad").show();
    var duracion = traeduracion(Estudio); // definimos una variable que va a valer lo que traiga la funcion "traeduracion"
    noDisponibles(Estudio,idsala,fecha,duracion);
    $("#duracionEstudio").append('<span>Duración: <b> '+duracion+'</b> hr(s)</span>');
    $("#inputduracion").val(duracion);
  }
  
}
function traerDi()
{
  var medico = $("#medico").val();
  var fecha = $("#fecha").val();
  $.ajax({
    url:"http://localhost/CDI/Panel/index.php/Crudcitas/verificarOcupado/"+medico+"/"+fecha,
    dataType:"json",
   // async: false, // esta funcion debe cpmpletarse antes de continuar con la lectura del código
    success:function(data) {
      // return data;
      //alert(data.length)
      if(data.length > 0)
           {
             for(i=0; i<data.length; i++)
             {
                var nume=data[i]['horarioCita'];
                 
                var res = nume.substr(0, 2);
                var minudiv = nume.substr(3, 2);

                 var aTermi=data[i]['horaTerminada'];
                var HourT = aTermi.substr(0, 2);
                var minT = aTermi.substr(3, 2);
                
                //var min=data[i]['horarioCita'];
                //var minn = str.substr(3,2);
               if (res=="08")
                {
                  res=8;
                }
                 if (res=="09")
                {
                  res=9;
                }
                var ni=res+minudiv;
                var f=HourT+minT;
              // alert("ni "+ni+" f "+f)
                for (var ir = ni; ir < f ; ir++) {
                  // alert("td.desbloc" + ir)
                    $( "td.desbloc"+ir).addClass( "disabled" );
                }
                  //$("#botonhora"+res).prop('disabled', true);
                  //alert("td.desbloc"+res+minudiv)
                 
             }  
           }

           //desbloque(medico,fecha)
          
    }    
  });
}

function desbloque(medico,fecha)
{
  var medico=medico;
  var fecha=fecha;
  $.ajax({
                url:"http://localhost/CDI/Panel/index.php/Crudcitas/verificarDispo/"+medico+"/"+fecha,
                dataType:"json",
               // async: false, // esta funcion debe cpmpletarse antes de continuar con la lectura del código
                success:function(data) {
                  // return data;
                  
                  if(data.length > 0)
                       {
                         for(i=0; i<data.length; i++)
                         {
                            var nume=data[i]['horarioCita'];
                            var res = nume.substr(0, 2);
                            var minudiv = nume.substr(3, 2);
                           if (res=="08")
                            {
                              res=8;
                            }
                             if (res=="09")
                            {
                              res=9;
                            }
                              //$("#botonhora"+res).prop('disabled', false);
                             
                              $( "td.desbloc"+res+minudiv ).addClass( "" );
                                 // alert("res "+res)
                         }  
                       }

                }   
              });
}

function traeduracion(idE) {
  var idE = idE;
  var uno = false; //definimos una variable en blanco
    $.ajax({
    url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeduracion/"+idE,
    dataType:"json",
    async: false, // esta funcion debe cpmpletarse antes de continuar con la lectura del código
    success:function(data) {
      // return data;
      if(data.length > 0)
           {
             for(i=0; i<data.length; i++)
             {
                uno = data[i]['duracion']; //le asignamos el valor que trae la funcion ajax
                $("#valorDuracionEstudio").val(data[i]['duracion']);
             }
           }
    }    
  });
  return uno; //retornamos a la funcion inicial "traedisponibilidad"
}

function noDisponibles(est,sala,fecha,duracion) {

    $("#modal-body").html("");
    pintatodashoras();
    var idEst = est;
    var idSala = sala;
    var fecha = fecha;
    // var fecha = fecha.replace(/-/g, "");
  // alert(fecha)
    //var fecha=""+fecha+"";
    var dayC = fecha.substr(-2);
    var yearC = fecha.substr(0,4);
    var MesC = fecha.substr(4,2);
    //var fecha=""+yearC+"-"+MesC+"-"+dayC+"";
 //alert("fecha "+fecha)
    var duracion = duracion;
    var urgencia = $("#emergencia").val();
   // alert("entra"+fecha)
    if (urgencia != 1) {
      $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcitas/traenoDispo/"+idSala+"/"+fecha,
        dataType:"json",
        success:function(data) {
          //alert("entraH")
          if(data.length > 0)
               {
                 for(i=0; i<data.length; i++)
                 {
                 // alert("entra"+data[i]['horarioCita'])
                   // identificainactivos(data[i]['horarioCita'],duracion);
                    calcT3s(data[i]['horarioCita'],data[i]['horaTerminada'])
                    //deshabilitaBtnsModal(data[i]['idMedico']);
                 }
               }
               deshabilitaBtns();
               
          }    
      });
    }
}

function padNmbs(nStr, nLen){ 
var sRes = String(nStr); 
var sCeros = "0000000000"; 
return sCeros.substr(0, nLen - sRes.length) + sRes; 
} 

function stringToSecondss(tiempo){ 
var sep1 = tiempo.indexOf(":"); 
var sep2 = tiempo.lastIndexOf(":"); 
var hor = tiempo.substr(0, sep1); 
var min = tiempo.substr(sep1 + 1, sep2 - sep1 - 1); 
var sec = tiempo.substr(sep2 + 1); 
return (Number(sec) + (Number(min) * 60) + (Number(hor) * 3600)); 
} 

function secondsToTimes(secs){ 
var hor = Math.floor(secs / 3600); 
var min = Math.floor((secs - (hor * 3600)) / 60); 
var sec = secs - (hor * 3600) - (min * 60); 
return padNmbs(hor, 2) + ":" + padNmbs(min, 2) + ":" + padNmbs(sec, 2); 
} 

function substractTimess(t1,   t2){ 
var secs1 = stringToSeconds(t1);  
var secs2 = stringToSeconds(t2); 
var secsDif = secs1 - secs2; 
return secondsToTimes(secsDif); 
} 

function calcT3s(x,y){ 
var x=x;
var y=y;
var t3 = substractTimess(y, x); 
//alert("x "+x+" t3 "+t3)
identificainactivos(x,t3)
} 

function deshabilitaBtns() {

  var diaBuscado = $("#idDiainput").val();
    var medicoSolicitado = $("#medico").val();
    // alert("diaBuscado"+diaBuscado+" medicoSolicitado"+medicoSolicitado);
    $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcitas/compruebaDiasLaborales/"+diaBuscado+"/"+medicoSolicitado,
        dataType:"json",
        success:function(data) {
          if(data.length > 0)
               {
                 for(i=0; i<data.length; i++)
                 {

                    DesactivaBtn(data[i]['horaEntrada'],data[i]['horaSalida']);
                    // var y = parseInt(i)-1;
                    // $("#varSalidaAnterior").val(data[y]['horaSalida']); 
                 }
               }
          }    
      });
 }


function DesactivaBtn(entrada,salida) {
  //alert("Entrsas")
 //alert("minEn "+entrada+" minSal "+minSal)
  var ent = entrada.substr(0,2);
  var minEn=entrada.substr(3,2);
  var sal = salida.substr(0,2);
  var minSal=salida.substr(3,2);
   
  if (ent == "08") {
    ent = 8;
  }
  if (ent == "09") {
    ent = 9;
  }
var tope=ent+minEn;
 
  for (var i = 8; i <= 19; i++) {
   //alert(i+" >= "+ent)
    if (i >= ent) {
      //alert("td.desbloc"+i+minSal)

      $( "td.desbloc"+i+minEn ).addClass( "" );
    }else{
     for (var xx = 800; xx < tope ; xx++) {
        $( "td.desbloc"+xx ).addClass( "disabled" );
     }
    
    }
    
  }
  compurbeSalida(sal,minSal);
 }

 function compurbeSalida(sal,minSal) {
var topeS=sal+minSal;
  for (var i = sal; i <= 19; i++) {
    if (i > sal) {
     // alert("td.desbloc"+xxw+" topes "+topeS)
       for (var xxw = topeS; xxw < 2000 ; xxw++) {
        //alert("bloquear "+xxw)
         $( "td.desbloc"+xxw ).addClass( "disabled" );
     }
     
    }else{
       for (var xxw = topeS; xxw < 2000 ; xxw++) {
        //alert("bloquear "+xxw)
         $( "td.desbloc"+xxw ).addClass( "disabled" );
     }
     
    }
  }
  traerDi()
 }


function pintatodashoras() {
  $("#modal-body").html("");
    momentoActual = new Date();
    momentoActual.setHours(0,0);
    hora = momentoActual.getHours(); 
    minuto = momentoActual.getMinutes();
    horaImprimible = hora + " : " + minuto;
  for (var i = 8; i <= 19; i++) {
    horasuma = parseInt(hora) + parseInt(i);
    $("#modal-body").append('<tr id="minutos'+i+'"><th class="disponible" id="botonhora'+horasuma+'">'+horasuma+':00</th></tr>');
        despliegaminutos(horasuma,minuto,i);
  }
}

function despliegaminutos(hora,min,i) {
  
  var hora  = hora;
  var minuto  = min;
  var botoni  = i;
  //$("#minutos"+botoni).html("");
  for (var i = 0; i <= 5; i++) {
    var minutosuma = parseInt(minuto) + parseInt(i) * 10;
    if (minutosuma == "0") {
      minutosuma = "00";
    }
   //alert("#minutos"+botoni+"  "+hora+":"+minutosuma)
   $("#minutos"+botoni).append('<td id="botonminuto'+minutosuma+'-'+hora+'" onclick="asignahoracita('+hora+','+minutosuma+')" class="tdDisponible desbloc'+hora+minutosuma+'">'+'<div id="div'+minutosuma+'-'+hora+'">'+hora+':'+minutosuma+'</div></td>');
   
  }
}

function asignahoracita(hora,min) {
  $("#modal-alert").html("");

  var emergencia = $("#emergencia").val();
  if (emergencia == 1) {
    traedisponibilidad();
    //alert("vamos a comprobar el choque de horas");
    validadisponibilidad(hora,min);
  }else{
    traedisponibilidad();
    validadisponibilidad(hora,min);
  }
  
  
}

function validadisponibilidad(hora,min) {
  var horazzz = hora;
  var min = min;
  //alert("entra "+min)
  var emergencia = $("#emergencia").val();
  // alert(min);
  var coinciden = 0;
  for (var j =  0; j <= 1; j++) {
    var horamasuno = parseInt(horazzz)+j;
    if (horamasuno == 8) {
        horamasuno = "08";
    }
    if (horamasuno == 9) {
      horamasuno = "09";
    }
  // alert("vamos a validar que las horas no choquen");
  var fechabase = $("#fechamodal").val();
  var estudiosolic = $("#Estud").val();
  var salasolic = $("#Salas").val();
  $.ajax({
    url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeProximonoDispo/"+estudiosolic+"/"+salasolic+"/"+fechabase+"/"+horamasuno,
    dataType:"json",
    success:function(data) {
      if(data.length > 0)
           {
             for(i=0; i<data.length; i++)
             {
                var duracion = $("#valorDuracionEstudio").val();
                var separa = duracion.replace(":", ",");
                  var arrayduracion = separa.split(",").map(Number);
                  tiempoduracion = new Date();
                  tiempoduracion.setHours(arrayduracion[0],arrayduracion[1]);
                  horadur = tiempoduracion.getHours(); 
                  minutodur = tiempoduracion.getMinutes();
                  var minutostotalduracion = (parseInt(horadur)*60) + parseInt(minutodur);
                  var minutostotalduracion1 = parseInt(minutostotalduracion)-1;
 
                  for (var x = 0; x <= minutostotalduracion1; x++) {
                    var horaselec = new Date();
                   // alert("horazzz "+horazzz+" min "+min)
                    horaselec.setHours(horazzz,min,0);
                   // alert("horazzz2 "+horazzz+" min2 "+min)
                    horaselec.setMinutes(horaselec.getMinutes() + x);
                    var horaciclo = horaselec.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit', second:'2-digit'});
                     // alert("recorrido: "+horaciclo+" - cita: "+data[i]['horarioCita']+" -Termina: "+data[i]['horaTerminada']);
                     if (horaciclo == data[i]['horarioCita'] || horaciclo == data[i]['horaTerminada']) {
                      if (emergencia == 1) {
                        // ALERTA Y FUNCION QUE RECORRERIAN LAS HORAS YA ASIGNADAS
                          // swal("Recuerda que...", "Algunas citas ya agendadas se recorrerán para poder atender las urgencias", "warning");
                        // recorrehorario(data[i]['idCita']);
                        break;
                      }
                     }
                    if (horaciclo == data[i]['horarioCita']) {
                        // alert("no puedes agendar en este horario");
                        swal("No puedes agendar en este horario", "La cita se empalma con otra ya agendada. \n Por favor selecciona otro horario", "warning");
              $("#horacita").val("horainicio");
                        traedisponibilidad();
                        coinciden = 1;
                        break;
                    }
                  }
                  // alert(coinciden);

                  if (coinciden == 0) {
                    $("#modal-alert").html("");
                    // var hora = hora;
                    // var minuto = min;
                    var Estudio = $("#Estud").val();
                    var duracion = traeduracion(Estudio);
                    var construyehora = new Date();
                    construyehora.setHours(horazzz,min,0);
                   // var horainicio = construyehora.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
                      var horainicio=construyehora.toLocaleTimeString();
                     var horainicio = horainicio.substr(0, 5);
                    var res = horainicio.replace(" ", "");
                    var totalito=res.length;
                    if (totalito==4)
                     {
                       var horainicio = "0"+res;
                     }
                     if (totalito==5)
                     {
                       var horainicio = res;
                     }
                    $("#modal-alert").append('<span style="background: #e3f1e0; text-align: center;">La cita quedaría agendada a las <b>'+horainicio+'</b> hr(s) y terminaría a las <b id="horatotal"> </b> hr(s)</span><br>');
                    $("#modal-alert-div").css("background","#e3f1e0");
                    if (min == "0") {
                     min = "00";
                    }
                    $("#botonhora"+horazzz).css("background", "#a2e9b0");
                    $("#botonminuto"+min+"-"+horazzz+"").css("background", "#a2e9b0");
                    $("#div"+min+"-"+horazzz+"").css("background", "#a2e9b0");
                    // alert("si puedes agendar en este horario");
                    pintahorasCita(horazzz,min);
                  //  alert("1 : "+horainicio)
                    //$("#horacita").val(horainicio);
                    calcT3();
                    break;
                  }
                  if (coinciden == 1) {
                    break;
                  }
             } //aqui cierra for
           }else{
            if (coinciden == 1) {
              // alert("ya hay coincidencia");
            }else{
                traedisponibilidad();
                $("#modal-alert").html("");
                var Estudio = $("#Estud").val();
                    var duracion = traeduracion(Estudio);
                    var construyehora = new Date();
                    construyehora.setHours(horazzz,min,0);
                   // var horainicio = construyehora.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});

                    var horainicio=construyehora.toLocaleTimeString();

                    //alert("entrada "+ horainicio.length)
                    if (horainicio.length==7) { var horainicio = horainicio.substr(0, 4);}
                    if (horainicio.length==8) { var horainicio = horainicio.substr(0, 5);}
                   
                   //alert(horainicio)
                    var res = horainicio.replace(" ", "");
                    var totalito=res.length;
                    if (totalito==4)
                     {
                       var horainicio = "0"+res;
                     }
                     if (totalito==5)
                     {
                       var horainicio = res;
                     }
                     //alert(horainicio)
                    $("#modal-alert").append('<span style="background: #e3f1e0; text-align: center;">La cita quedaría agendada a las <b>'+horainicio+'</b> hr(s) y terminaría a las <b id="horatotal"> </b> hr(s)</span><br>');
                    $("#modal-alert-div").css("background","#e3f1e0");
                    if (min == "0") {
                     min = "00";
                    }
                    $("#botonhora"+horazzz).css("background", "#a2e9b0");
                    $("#botonminuto"+min+"-"+horazzz+"").css("background", "#a2e9b0");
                    $("#div"+min+"-"+horazzz+"").css("background", "#a2e9b0");
                    // alert("si puedes agendar en este horarioooo");
                    pintahorasCita(horazzz,min);
                    // alert("2 : "+horainicio)
                    $("#horacita").val(horainicio);
                    calcT3();
            }
            
           }
    }    
   });
  }
}


function validachoque(horaurgencia, minutourgencia) {
  var horaDosdigitos = horaurgencia;
  var minDosdigitos = minutourgencia;
  var fechaurgencia = $("#fechamodal").val();
  var estudiourgencia = $("#Estud").val();
  var salaurgencia = $("#Salas").val();
  if (horaDosdigitos == "8") {
    horaDosdigitos = "08";
  }
  if (horaDosdigitos == "9") {
    horaDosdigitos = "09";
  }
  if (minDosdigitos == "0") {
    minDosdigitos = "00";
  }
  var horapropuesta = horaDosdigitos+":"+minDosdigitos+":00";
  alert("entra la hora: "+horapropuesta);
  $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeProximonoDispoParaUrgencia/"+estudiourgencia+"/"+salaurgencia+"/"+fechaurgencia+"/"+horapropuesta,
        dataType:"json",
        success:function(data) {
          if(data.length > 0)
               {
                 for(i=0; i<data.length; i++)
                 {

                    // identificainactivos(data[i]['horarioCita'],duracion);     
                 }
               }
          }    
      });
}




function pintahorasCita(hora,min){
  // alert(min);
  $("#PropuestahoraCita").val(hora);
  $("#PropuestaminCita").val(min);
  var duracion = $("#valorDuracionEstudio").val();
  var separa = duracion.replace(":", ",");
    var arrayduracion = separa.split(",").map(Number);
    tiempoduracion = new Date();
    tiempoduracion.setHours(arrayduracion[0],arrayduracion[1]);
    horadur = tiempoduracion.getHours(); 
    minutodur = tiempoduracion.getMinutes();
    var minutostotalduracion = (parseInt(horadur)*60) + parseInt(minutodur);
    // alert(minutostotalduracion);
    var nuevominutosduraciontotal = parseInt(min)+parseInt(minutostotalduracion);
    // alert("el for llegara hasta "+nuevominutosduraciontotal);
    for (var i = min; i < nuevominutosduraciontotal; i++) {
      // alert(i);
      $("#botonminuto"+i+"-"+hora).css("background","#a2e9b0");
      $("#div"+i+"-"+hora).css("background","#a2e9b0");
      if (i > 60) {
        break;
      }
    }
    var minutoscomplemento = parseInt(min)+parseInt(minutostotalduracion);
    // alert("minutos complemento:"+minutoscomplemento);
    if (minutoscomplemento > 60)
    {
      var ejecutarfuncion = parseInt(minutoscomplemento)/60;
      var ejecfuncion = parseInt(ejecutarfuncion);
      // alert("la funcion de complemento se ejecutara "+ejecfuncion+" veces");

      for (var i = 1; i <= ejecfuncion; i++) {
        // alert("la funcion entra por "+i+"° vez");
        var parametro = 60*i;
        var mincomplemento = parseInt(minutoscomplemento)-parseInt(parametro);
        // alert("El parametro cambiante del ciclo vale:"+mincomplemento);
        var color = "#a2e9b0";
        complemento(mincomplemento,hora,i,color);
      }
      
    }
}

function identificainactivos(hora,duracions){
  //alert("hora "+hora+" duracions "+duracions)
  var hora = hora;
  var duracions = duracions;
  var duracion = duracions.substr(1, 4);

  var res = hora.replace(/:/g, ",");
 var array = res.split(",").map(Number);
    horadiv = new Date();
    horadiv.setHours(array[0],array[1],array[2]);
    horadi = horadiv.getHours(); 
    minutodiv = horadiv.getMinutes();
    //alert("la cita agendada empieza en el minuto:"+minutodiv);
    // $("#botonhora"+horadi).css("background-color","#ffca00");
    

  var separa = duracion.replace(":", ",");
  var arrayduracion = separa.split(",").map(Number);
    tiempoduracion = new Date();
    tiempoduracion.setHours(arrayduracion[0],arrayduracion[1]);
    horadur = tiempoduracion.getHours(); 
    minutodur = tiempoduracion.getMinutes();
    var minutostotalduracion = (parseInt(horadur)*60) + parseInt(minutodur);
    var rec=parseInt(minutodiv)+parseInt(minutostotalduracion);
    for (var i = minutodiv; i < rec; i++) 
    {
      //var resta= minutostotalduracion - minutodiv;
      if (i == 0) {
        i = "00";
      }
      //alert(" i "+i+" horadi "+horadi+" miDura "+minutostotalduracion)
      $("#botonminuto"+i+"-"+horadi).css("background-color","#ffca00");
      $("#botonminuto"+i+"-"+horadi).css("color","#fff");
      $("#div"+i+"-"+horadi).css("background-color","#ffca00");
      $("#botonminuto"+i+"-"+horadi).prop("onclick", null);

    }
    //alert("horadi "+horadi)
    compruebacolor(horadi);
    // setTimeout(function () { compruebacolor(horadi) },2000);

    var minutoscomplemento = parseInt(minutodiv)+parseInt(minutostotalduracion);
    var partida = parseInt(minutoscomplemento)-parseInt(minutostotalduracion);
    // alert("El minuto del que parte la cita es el: "+partida);
    if (minutoscomplemento > 60)
    {

      var ejecutarfuncion = parseInt(minutoscomplemento)/60;
      var ejecfuncion = parseInt(ejecutarfuncion);
      // alert("la funcion de complemento se ejecutara "+ejecfuncion+" veces");

      for (var i = 1; i <= ejecfuncion; i++) {
        //alert("la funcion entra por "+i+"° vez");
        var parametro = 60*i;
        var mincomplemento = parseInt(minutoscomplemento)-parseInt(parametro);
        //alert("El parametro cambiante del ciclo vale:"+mincomplemento);
        var color = "#ffca00";
        complemento(mincomplemento,horadi,i,color);
      }
      
    }
    
}

function complemento(minutoscomplemento,hora,i,color)
{
  var minutosRest = minutoscomplemento;
  //alert("restan"+minutosRest);
  var horasx = i;
  var horasuma = parseInt(hora)+parseInt(horasx);
  if (color != "#a2e9b0") {
    setTimeout(function () { compruebacolor(horasuma) },0);
  }
  
  if (horasuma == 24) {
    horasuma = "0";
  }
  $("#botonhora"+horasuma).css("background-color",color);
 
  for (var i = 0; i < minutosRest; i++) {
    if (i == 0) {
      i = "00";
    }
    $("#botonminuto"+i+"-"+horasuma).css("background-color",color);
    $("#botonminuto"+i+"-"+horasuma).css("color","#fff");
    //$( "td.desbloc"+horasuma ).addClass( "disabled" );
    $("#div"+i+"-"+horasuma).css("background-color",color);
    if (color == "#ffca00") {
      // alert("entra el color rojo");
      $("#botonminuto"+i+"-"+horasuma).prop("onclick", null);
    }
  } 
}

function compruebacolor(hora) {
  //alert("entra comprobacion de color con hora: "+hora);
  var elemento = $("div#minutos"+hora+" > a").css("background-color");
      //alert(elemento);
      if (elemento == "rgb(171, 60, 60)") {

        $("#botonhora"+hora).css("background-color","#ffca00");
         $("#botonminuto"+i+"-"+horadi).css("color","#fff");
      }else{
        $("#botonhora"+hora).css("background-color","#4f5d6a");
      }
}

function limpiamodal() {
  $("#fechamodal").val("");
}


function AsignahorasEstablecidas() {
  var inicio = $("#horacita").val();
  
  var fin =$("#HoraTerminada").val()
  var fechamodal = $("#fechamodal").val();
  var idPaciente=$("#idPaciente").val();
  //alert(inicio+" "+fin);
  if (inicio != "" ) {
   //alert("dentro "+inicio);
    $('#myModal').modal('hide');
    $("#horainicio").val(inicio);
    $("#horatermino").val(fin);
    $("#divhorainicio").show();
    $("#divhoratermino").show();
   $("#autorizaBoton").show();
    $("#fecha").val(fechamodal);
  }
  else{
    alert('debes selecionar una hora');
  }
  
}

function cambiaCheck() {
  //alert("entra alert");
  if ($("#estadourgencia").is(':checked')) {
    //alert("entra Si");
    $("#emergencia").val("1");
    traedisponibilidad();
    $("#modal-alert").html("");
    $("#modal-alert-div").css("background","#fff");
    $("#horacita").val("");
    $("#horainicio").val("");
  $("#horatermino").val("");
  $("#divhorainicio").hide();
  $("#divhoratermino").hide();
  }else{
    //alert("entra No");
    $("#emergencia").val("0");
    $("#horacita").val("");
    $("#horainicio").val("");
  $("#horatermino").val("");
  $("#divhorainicio").hide();
  $("#divhoratermino").hide();
  $("#listaArticulo").html("");
  $("#idCitarecorrida").val("");
    traedisponibilidad();
  }
}



/////////////////////////////////////// NEW FUNCTION BUSCADOR ///////////////////////////////////////
function buscarxPeticion() {
  $("#listadocitasProx").html("");
  var fActa=$("#fechaAct").val();
  var res = $("#busqueda").val();
  var rightNow = new Date();
    var fecha = rightNow.toISOString().slice(0,10).replace(/-/g,"-");
  if (res != "") {
          $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcitas/traerListaTodoCitasxPeticion/"+res+"/"+fecha,
            type: "post",
            dataType: "JSON",
            success: function(data)
            {
               if (data.length>0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        if (data[i]['urgencia'] == 1) {
                          urgencia = "SI";
                        }else{
                          urgencia = "NO";
                        }

                        var Horal=data[i]['horallegada'];
                        if (Horal!="00:00:00")
                         {
                            Horal=Horal;
                            var classs="disabled";
                         }else{
                           
                             Horal="Hora de llegada";
                             var classs="";
                         }
                        var srt=data[i]['fechaCita'];
                         var cancel=data[i]['cancelar'];
                          if (cancel==1)
                           {
                              var clas="disabled";
                              var fuent="background-color: #f00;color: #fff;";
                              Horal="CANCELADO";
                           }else{
                              var clas="";
                              var fuent="";
                              
                           }
                          // alert("entra")
                            var res = srt.replace(/-/g, "");
                        var salidasala = data[i]['horarioCita']
                        $("#listadocitasProx").append('<tr class="'+clas+'">'+
                                                    '<td style="display:none;">'+data[i]['idCita']+'</td>'+
                                                     '<td style="'+fuent+'">'+Horal+'</td>'+
                                                    '<td scope="row">'+data[i]['orden_medica']+'</td>'+
                                                    '<td><a onclick="GetTdodoEstudio('+data[i]['idPaciente']+','+data[i]['idCita']+','+idUser+')">'+data[i]['nombrePaci']+'</a></td>'+
                                                    '<td>'+data[i]['nombre']+'</td>'+
                                                    '<td>'+data[i]['nombreEstudio']+'</td>'+
                                                    '<td onChange="insertarCambios(1,'+data[i]['idCita']+','+data[i]['idSala']+',\''+data[i]['fechaCita']+'\',\''+data[i]['horarioCita']+'\','+data[i]['idSala']+',\'2018-09-20\',\''+data[i]['horarioCita']+'\');">'+data[i]['fechaCita']+'</td>'+
                                                    '<td onclick="pintatodashorasModal('+data[i]['idSala']+','+data[i]['IdEstudio']+','+res+');pruebaModific('+i+')" >'+data[i]['horarioCita']+'</td>'+
                                                    '<td>'+data[i]['horaTerminada']+'</td>'+
                                                    '<td>'+data[i]['nombreUser']+'  <input type="hidden" name="fechOculto'+data[i]['idPaciente']+'" id="fechOculto'+data[i]['idPaciente']+'" value="'+data[i]['fechaCita']+'"></td>'+
                                                    '<td class="'+classs+'"><a onclick="cancelarCita('+data[i]['idCita']+')">Cancelar</a></td>'+
                                                '</tr>');
                    }
                }else{
                $("#listadocitasProx").append('<td colspan="9" align="center" style="padding-top: 20px;">NO HAY CITAS PROGAMADAS</td>');
              }
              $('#tableProx').Tabledit({
                      url: 'http://localhost/CDI/Panel/index.php/Crudcitas/editaDatos/'+fActa,
                      editButton: false,
                      deleteButton:false,
                      columns: {
                          identifier: [0, 'idCita'],
                          editable: [[1, 'horaLlega']]
                      }
                    });
               $("input[name*='horaLlega']").attr("type",'time');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
  }else{
    prueba();
  }

}

 function visualModalEdit()
 {
   
    var esVisibleM = $("#visualVentanaEdi").is(":visible");
          if (esVisibleM)
           {
            $("#visualVentanaEdi").hide();
          }else{
            $("#visualVentanaEdi").show();
            $("#registroPacientes").hide();
            }
            var idPacie=$("#idPaciente").val()
   $.ajax({
        url : "<?php echo site_url('Crudcitas/obtenerDatos/')?>" + idPacie,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //alert(data);
        $("#claveEdi").val(data.clavePaci);
        $("#nombreEdit").val(data.nombrePaci);
        $("#generoEdi").val(data.generoPaci);
        $("#correoEd").val(data.correoPaci);
        $("#edadEdi").val(data.edadPaci);
        $("#fechanaciEdi").val(data.fechanaciPaci);
        $("#telefonoEdi").val(data.telefonoPaci);
        $("#medicoremitenteEdi").val(data.remitente);
        $("#clienteEdit").val(data.cliente);
        //alert(data.cliente)
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

 }

 function monitorearEstado()
    {
        while(true)
        {
            var fechaActual, fecha, horaInicio, horaTermino, fechaTabla, fechaTablaTermino;
            for (i = 0; i <<?php echo $contador;?>; i++) {
                fecha = $("#fecha" + i).html().split("-");
                horaInicio = $("#horaInicio" + i).html().split(":");
                horaTermino = $("#horaTermino" + i).html().split(":");

                fechaActual = new Date();
                fechaTabla = new Date(fecha[0], fecha[1] - 1, fecha[2], horaInicio[0], horaInicio[1], horaInicio[2], 0);
                fechaTablaTermino = new Date(fecha[0], fecha[1] - 1, fecha[2], horaTermino[0], horaTermino[1], horaTermino[2], 0);


                //SI LA FECHA ACTUAL ES MAYOR A LA FECHA DE LA TABLA ENTONCES
                //CAMBIAR EL ESTADO A EN PROCESO SI ES QUE SE ENCUENTRA EN RECEPCION
                //TODO: AGREGAR LA CONDICION DE PAGO
                if (fechaActual >= fechaTabla && $("#estado" + i).val() == 1) {
                    $("#status" + i).html("<input type='hidden' value='2' id='estado" + i + "'><button class='btn btn-secondary btn-sm' type='button' style='background: #FF8000;'></button>");
                }

                //SI LA FECHA ACTUAL ES MAYOR A LA FECHA DE TERMINO DE LA TABLA Y EL ESTADO ACTUAL ES EN PROCESO:
                if (fechaActual >= fechaTablaTermino && $("#estado" + i).val() == 2) {
                    $("#status" + i).html("<input type='hidden' value='3' id='estado" + i + "'><button class='btn btn-secondary btn-sm' type='button' style='background: #F2F91C;'></button>");
                }
            }
        }
    }

    Concurrent.Thread.create(monitorearEstado);

    $(function(){
  $("#formPc").on("submit", function(e){
    var idPacien=$("#idPaciente").val()
    var url;
    $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
    url= "<?php echo 'http://localhost/CDI/Panel/index.php/Crudcitas/modificPaciente/';?>"+idPacien;
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("formPc"));
    
    $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                 processData: false
            })
                .done(function(res){
                  swal("HECHO", "Datos modificados.", "success")  
                  var nombreMod=$("#nombreEdit").val();           
                  $("#paciente").val(nombreMod);
                  $("#visualVentanaEdi").hide();
                });

    });
 });

    function getClie()
    {
      $("#tipoCi").html("");
      var idPacien=$("#idPaciente").val();
      //alert("idpac "+idPacien)
      $.ajax({
        url : "<?php echo site_url('Crudcitas/obtenerDatosClientess/')?>" + idPacien,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
              $("#tipoCit").show();
            if (data.idCliente==8) 
            {
              $("#tipoCi").append(new Option(data.nombreCliente,data.idCliente));  
            }else{

              $("#tipoCi").append(new Option(data.nombreCliente,data.idCliente));  
              $("#tipoCi").append('<option value ="8">PARTICULAR</option>');
            }
             //visualF(); 
        },
        error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });

    }

    // function visualF(){
    //   var idCl=$("#tipoCi").val();
    //   if (idCl!=8)
    //    {
    //     $("#visualFavt").hide();
    //     $("#FactSn").val(1);
    //   }else{
    //     $("#visualFavt").show();
    //      $("#FactSn").val("");
    //   }
      
    // }
function corteVisual()
    {
       if ($("#cortesiaCit").is(':checked')) {
        $("#visualCortes").show();
         $("#cortesiaCit").val('1');
       }else{
          $("#visualCortes").hide();
           $("#tipCortes").val('0');
           $("#cortesiaCit").val('');
       }
    }
    
  </script>
  <script src="http://localhost/CDI/Panel/content/js/altapaciente.js"></script>
 <!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script>  -->
  <script src="http://localhost/CDI/Panel/content/js/modificarCita.js"></script>
 <!--  <script src="http://localhost/CDI/Panel/content/js/funcionesmodalC.js"></script> -->
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
    <script type="text/javascript">
      window.onload=getDaCita;
  function getDaCita()
  {
    var idCiMod=$("#idCiMod").val();
    var fecha=$("#fecha").val();
    $.ajax({
        url : "<?php echo site_url('Crudcitas/obtenerInfoGraCitas/')?>" + idCiMod+"/"+fecha,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          
          var Hor = data.horarioCita.substr(0,2);
          var minuts = data.horarioCita.substr(3,2);

          var HorFIN = data.horaTerminada.substr(0,2);
          var minutsFIN = data.horaTerminada.substr(3,2);

          
          //$("#fecha").val(data.fechaCita);
          $("#Salas").val(data.idSala);
          $("#Estud").val(data.IdEstudio);
          $("#nombreEstudio").val(data.nombreEstudio);
           $("#fechaEntre").val(data.fEntrega);
           $("#Priorid").val(data.prioridad);
          $("#paciente").val(data.nombrePaci);
           $("#idPaciente").val(data.idPaciente);
           $("#durE").val(data.duracion);
           $("#cortesiaCit").val(data.cortesia);
          
          
          limpiamodal();
          
          traecitaPropuesta();
          traerCitas();
          

           if (data.cortesia==1)
            {
              document.getElementById("cortesiaCit").checked = true;
            }
          if ($("#cortesiaCit").is(':checked'))
           {
             corteVisual()
              $("#tipCortes").val(data.tipocortesia);
           }
          tre();
          getClieOtro(data.tipoCitaa,Hor,minuts,HorFIN,minutsFIN);
          otro(data.idMedico)
          resulFech(data.diasResultado);
         // 
           
        },
        error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
   
  }
  function otro(idM)
  {
    $("#medico").html("");
  var sala = $("#Salas").val();
  // alert("la sala seleccionada es "+sala);
  $("#divmedico").show();

  $.ajax({
    url:"http://localhost/CDI/Panel/index.php/Crudcitas/traeDatosMedico/"+sala,
     type: "post",
    dataType:"json",
    success:function(data) {
      $("#medico").append(new Option("Selecciona un Médico", ""));
      if (data.length > 0) {
        for (var i = 0; i <= data.length; i++) {
          $("#medico").append(new Option(data[i]['nombreDoc'], data[i]['idDoctor']));
          $("#medico").val(idM);
          validarColor();
          diaSemana(1);
          traedisponibilidad();
        }
         
      }
    }    
  }); 
  
}

function getClieOtro(tip,huu,muu,hFIn,MFin)
    {
      $("#tipoCi").html("");
      var idPacien=$("#idPaciente").val();
      //alert("idpac "+idPacien)
      $.ajax({
        url : "<?php echo site_url('Crudcitas/obtenerDatosClientess/')?>" + idPacien,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
              $("#tipoCit").show();
            if (data.idCliente==8) 
            {
              $("#tipoCi").append(new Option(data.nombreCliente,data.idCliente));  
            }else{

              $("#tipoCi").append(new Option(data.nombreCliente,data.idCliente));  
              $("#tipoCi").append('<option value ="8">PARTICULAR</option>');
              $("#tipoCi").val(tip);
            }
              indetifHorMod (huu,muu,hFIn,MFin)
             //visualF(); 
        },
        error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });

    }

    function indetifHorMod (Ho,Mi,hFIn,MFin)
    {
      var Hop = Ho.substr(0,1);

      var hFInp = hFIn.substr(0,1);
      if (Hop==0)
       { Ho = Ho.substr(1); }
      if (hFInp==0)
       { hFIn = hFIn.substr(1); }
     var durE=$("#durE").val();
    var duH=durE.substr(0, 2);
    var minuD=durE.substr(-2);
      var minutostotalduracion = (parseInt(duH)*60) + parseInt(minuD);
      var nuevominutosduraciontotal = parseInt(Mi)+parseInt(minutostotalduracion);
    // alert(minutostotalduracion+" + "+Mi)
    var ii=Mi;
      for (var i = Mi; i <= nuevominutosduraciontotal; i++) {{}
         if (ii == 60) {
         Ho=parseInt(Ho)+1;
         ii = "00";
        }
        $("#botonminuto"+ii+"-"+Ho+"").css("background", "#a2e9b0");
        $("#div"+ii+"-"+Ho+"").css("background", "#a2e9b0");
       
       // alert(Ho+":"+ii)
        ii++;
      }

      
      // for (var i = Ho; i <= hFIn; i++) {
      //   for (var ix = Mi; ix <= MFin; ix++) {
      //     //alert(i + " : "+ix)
      //      $("#botonminuto"+ix+"-"+i+"").css("background", "#a2e9b0");
      //      $("#div"+ix+"-"+i+"").css("background", "#a2e9b0");
      //   } 
      // }
    }



    </script>
<!-- <?php 
  //include "footer.php";
 ?> -->