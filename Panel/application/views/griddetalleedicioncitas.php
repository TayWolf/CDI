<?php
include "header.php";
?>
<script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
<script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
<script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
<script src="http://localhost/CDI/Panel/content/js/altausuario.js"></script>
<script type="text/javascript">
    // $(document).on("ready",inicio);
    // function inicio(){
    //     var idc = $("#idCont").val();
       
    //       $.ajax({
    //         url : "<?php echo site_url('Crudcitas/datosGetCitas/')?>" + idc,
    //         type: "GET",
    //         dataType: "JSON",
    //         success: function(data)
    //         {
                
    //         },
    //         error: function (jqXHR, textStatus, errorThrown)
    //         {
    //             alert('Error get data from ajax');
    //         }
    //     });
    // }
</script>
<section class="content" style="margin-left: 15px;">
    <div class="container-fluid">
        <div class="block-header">
            <a href="http://localhost/CDI/Panel/index.php/menus">
                <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
           
            <?php
            include "footer.php";
            ?>
        </div>
                                <?php 
                                //este es la consulta de datos nuevos
                                        foreach ($datosActuale as $rowA) {
                                           $nombresalaOrAct=$rowA["nombre"];
                                           $nombreEstudioAct=$rowA["nombreEstudio"];
                                           $fechaCitaAct=$rowA["fechaCita"];
                                           $horarioCitaAct=$rowA["horarioCita"];
                                           $nombrePaciAct=$rowA["nombrePaci"];
                                           $nombreDoctorAct=$rowA["nombreDoc"];
                                           $urgenciaAct=$rowA["urgencia"];
                                           $orden_medicaAct=$rowA["orden_medica"];
                                           $facturaAct=$rowA["factura"];
                                           $tipoCitaaAct=$rowA["tipoCitaa"];
                                           $observacionesPacienteAct=$rowA["observacionesPaciente"];
                                           $prioridadAct=$rowA["prioridad"];
                                           $fEntregaAct=$rowA["fEntrega"];
                                           $nombreUserAct=$rowA["nombreUser"];
                                           $fechaModAct=$rowA["fechaMod"];
                                           $horaModAct=$rowA["horaMod"];
                                            $hourRegistro=$rowA["hourRegistro"];
                                            $fechaCaptura=$rowA["fechaCaptura"];
                                        }

                                        //fin de consulta de datos nuevo
                                        //inicia datos anteriores

                                         foreach ($datosOri as $row) {
                                           $nombresalaOr=$row["nombre"];
                                           $nombreEstudio=$row["nombreEstudio"];
                                           $fechaCita=$row["fechaCita"];
                                           $horarioCita=$row["horarioCita"];
                                           $nombrePaci=$row["nombrePaci"];
                                           $nombreDoctor=$row["nombreDoc"];
                                           $urgencia=$row["urgencia"];
                                           $orden_medica=$row["orden_medica"];
                                           $factura=$row["factura"];
                                           $tipoCitaa=$row["tipoCitaa"];
                                           $observacionesPaciente=$row["observacionesPaciente"];
                                           $fEntrega=$row["fEntrega"];
                                           $priorid=$row["prioridad"];
                                           $nombreUser=$row["nombreUser"];
                                           $fechaMod=$row["fechaMod"];
                                          
                                           
                                        }
                                        if ($priorid==1) {
                                         $priorid="Normal";
                                        }
                                        if ($priorid==2) {
                                          $priorid="Mismo día";
                                        }
                                        if ($priorid==3) {
                                          $priorid="Urgente";
                                        }
                                        if ($prioridadAct==1) {
                                         $prioridadAct="Normal";
                                        }
                                        if ($prioridadAct==2) {
                                          $prioridadAct="Mismo día";
                                        }
                                        if ($prioridadAct==3) {
                                          $prioridadAct="Urgente";
                                        }
                                        // fin de consulta de datos anteriores
                                        if ($nombresalaOrAct==$nombresalaOr) {
                                                $ident="";
                                           }else{
                                                $ident="background-color: #cba7a7;";
                                           }
                                           ///////

                                           if ($nombreEstudioAct==$nombreEstudio) {
                                                $identNombrEst="";
                                           }else{
                                                $identNombrEst="background-color: #cba7a7;";
                                           }
                                           ////////
                                           if ($fechaCita==$fechaCitaAct) {
                                                $identFeci="";
                                           }else{
                                                $identFeci="background-color: #cba7a7;";
                                           }
                                           ////////
                                           if ($nombrePaci==$nombrePaciAct) {
                                                $identNomPaci="";
                                           }else{
                                                $identNomPaci="background-color: #cba7a7;";
                                           }
                                           ////////
                                           if ($nombreDoctor==$nombreDoctorAct) {
                                                $identnomDoc="";
                                           }else{
                                                $identnomDoc="background-color: #cba7a7;";
                                           }
                                           ////////
                                           
                                           if ($horarioCitaAct==$horarioCita) {
                                                $identci="";
                                           }else{
                                                $identci="background-color: #cba7a7;";
                                           }
                                           ////////
                                           if ($urgencia==$urgenciaAct) {
                                                $identhorUrge="";
                                           }else{
                                                $identhorUrge="background-color: #cba7a7;";
                                           }
                                           ////////
                                           if ($orden_medica==$orden_medicaAct) {
                                                $identOmed="";
                                           }else{
                                                $identOmed="background-color: #cba7a7;";
                                           }
                                           ////////
                                           if ($factura==$facturaAct) {
                                                $identfaCi="";
                                           }else{
                                                $identfaCi="background-color: #cba7a7;";
                                           }
                                           ////////
                                           if ($tipoCitaa==$tipoCitaaAct) {
                                                $identTP="";
                                           }else{
                                                $identTP="background-color: #cba7a7;";
                                           }
                                           ////////
                                           if ($fEntrega==$fEntregaAct) {
                                                $identfEaa="";
                                           }else{
                                                $identfEaa="background-color: #cba7a7;";
                                           }
                                           ////////
                                           if ($prioridadAct==$priorid) {
                                                $identpriorid="";
                                           }else{
                                                $identpriorid="background-color: #cba7a7;";
                                           }
                                           //
                                            if ($observacionesPaciente==$observacionesPacienteAct) {
                                                $identObse="";
                                           }else{
                                                $identObse="background-color: #cba7a7;";
                                           }
                                            
                                           ////////
                                        
                                     ?>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 style="margin-top: 10px;">
                                    Campos modificados en la cita
                                </h2>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
         </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-5">
                                <h2 style="margin-top: 10px;">
                                    <?php echo "$nombrePaciAct"; ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" >
                                <input type="hidden" id="idCont" name="idCont" value="<?php echo $idontrol; ?>">
                                <thead>
                                <tr>
                                    <th>Sala</th>
                                    <th>Estudio</th>
                                    <th>Fecha cita</th>
                                    <th>Hora Inicio</th>
                                    <th>Paciente</th>
                                    <th>Médico</th>
                                    <th>Urgencia</th>
                                    <th>Orden M.</th>
                                    <th>Tipo</th>
                                    <th>Observaciones</th>
                                    <th>Entrega</th>
                                    <th>Prioridad</th>
                                    <th>Responsable</th>
                                    <th>Registrado el</th>
                                    <th>Hora registro</th>
                                </tr>
                                </thead>
                                <tbody >
                                  <?php 
                                    if ($urgencia==1) {
                                                $urgencia="Si";
                                            }
                                             if ($urgencia==0) {
                                                $urgencia="No";
                                            }
                                            if ($factura==1) {
                                                $factura="Si";
                                            }
                                             if ($factura==2) {
                                                $factura="No";
                                            }
                                       
                                           echo "
                                           <tr>
                                                <td style='$ident'>$nombresalaOr</td>
                                                <td style='$identNombrEst'>$nombreEstudio</td>
                                                <td style='$identFeci'>$fechaCita</td>
                                                <td  style='$identci'>$horarioCita</td>
                                                <td style='$identNomPaci'>$nombrePaci</td>
                                                <td style='$identnomDoc'>$nombreDoctor</td>
                                                <td style='$identhorUrge'>$urgencia</td>
                                                <td style='$identOmed'>$orden_medica</td>
                                                
                                                <td style='$identTP'>$tipoCitaa</td>
                                                <td style='$identObse'>$observacionesPaciente</td>
                                                <td style='$identfEaa'>$fEntrega</td>
                                                <td style='$identpriorid'>$priorid</td>
                                                <td >$nombreUser</td>
                                                <td >$fechaCaptura</td>
                                                <td >$hourRegistro</td>
                                           </tr>";
                                        
                                     ?>

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row header" style="padding-bottom: 0px;padding-top: 0px;">
                            <div class="col-md-5">
                                <h2 style="margin-top: 10px;">
                                    Datos finales
                                </h2>
                            </div>
                        </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" >
                                <input type="hidden" id="idCont" name="idCont" value="<?php echo $idontrol; ?>">
                                <thead>
                                <tr>
                                    <th>Sala</th>
                                    <th>Estudio</th>
                                    <th>Fecha cita</th>
                                    <th>Hora Inicio</th>
                                    <th>Paciente</th>
                                    <th>Médico</th>
                                    <th>Urgencia</th>
                                    <th>Orden M.</th>
                                    <th>Tipo</th>
                                    <th>Observaciones</th>
                                    <th>Entrega</th>
                                    <th>Prioridad</th>
                                    <th>Responsable</th>
                                    <th>Modificado el</th>
                                    <th>Modificado a las</th>
                                </tr>
                                </thead>
                                <tbody >
                                  <?php 
                                            if ($urgenciaAct==1) {
                                                $urgenciaAct="Si";
                                            }
                                             if ($urgenciaAct==0) {
                                                $urgenciaAct="No";
                                            }
                                            if ($facturaAct==1) {
                                                $facturaAct="Si";
                                            }
                                             if ($facturaAct==2) {
                                                $facturaAct="No";
                                            }

                                           echo "

                                           <tr>
                                                <td style='$ident'>$nombresalaOrAct</td>
                                                <td style='$identNombrEst'>$nombreEstudioAct</td>
                                                <td style='$identFeci'>$fechaCitaAct</td>
                                                <td style='$identci'>$horarioCitaAct</td>
                                                <td style='$identNomPaci'>$nombrePaciAct</td>
                                                <td style='$identnomDoc'>$nombreDoctorAct</td>
                                                <td style='$identhorUrge'>$urgenciaAct</td>
                                                <td style='$identOmed'>$orden_medicaAct</td>
                                                <td style='$identTP'>$tipoCitaaAct</td>
                                                <td style='$identObse'>$observacionesPacienteAct</td>
                                                <td style='$identfEaa'>$fEntregaAct</td>
                                                <td style='$identpriorid'>$prioridadAct</td>
                                                <td >$nombreUserAct</td>
                                                <td >$fechaModAct</td>
                                                <td >$horaModAct</td>
                                           </tr>";
                                        
                                     ?>

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>
