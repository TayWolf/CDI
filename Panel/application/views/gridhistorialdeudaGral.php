<?php
include "header.php";
?>
<link rel="stylesheet" type="text/css" href="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.css"/>
<script type="text/javascript" src="http://localhost/CDI/Panel/content/plugins/DataTables/datatables.min.js"></script>

<section class="content" style="margin-left: 15px;">
    <div class="container-fluid">
        <div class="block-header">
            <a href="javascript:history.back();">
                <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
           
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
                                    Historial de pagos de <?php foreach ($nombreTipo as $key) {
                                       $nombreTi=$key["nombrePaci"];
                                       echo $nombreTi;
                                    } ?>
                                </h2>
                            </div>

                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablaUsuarios">
                                <thead>
                                <tr>
                                    <!-- <th>Foto</th> -->
                                    <th style='display:none;'></th>
                                    <th>Estudio</th>
                                    <th>Precio Estudio </th>
                                    <th>Debe</th>
                                    <th>Historial de pagos</th>
                                    <th>Día de pago</th>
                                    <th>Recibio</th>
                                </tr>
                                </thead>
                                <tbody id="tabla">
                                <?php
                                $idconteo=0;
                                $deudaT=0;
                                foreach ($historiaEtudios as $row) {
                                    $nombreEstudio=$row['nombreEstudio'];
                                    $precioEstudio=$row['precioEstudio'];
                                    $faltaPago=$row['faltaPago'];
                                    $idControl=$row['idControl'];

                                    $idconteo++;
                                    echo " <tr>
	                                            <td style='display:none;'></td>
                                                <td>$nombreEstudio</td>
                                                <td>$ $precioEstudio</td>
                                                <td>$ $faltaPago</td>
                                                <td id='listadoPagos$idControl'></td>
                                                <td id='fechaRecibo$idControl'></td>
                                                <td id='datosRecibe$idControl'></td>
                                            </tr>
                                            ";
                                            $deudaT+=$faltaPago;
                                } 
                                echo "<tr>
                                        <td></td>
                                        <td align='right' style='font-size: 16px;'><strong>Total: </strong></td>
                                        <td id='totalDeudas'   style='font-size: 16px;'><strong>$ $deudaT </strong></td>
                                        <td id='totalPagos' colspan='3' style='font-size: 16px;'></td>
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
<script type="text/javascript">
    window.onload=cargardatosP;
    function cargardatosP()
    {
        $.ajax({
            url : "<?php echo site_url('Cruddeudores/getListadoPagos/')?>" + <?php echo $idDeudor; ?>,
            type: "post",
            dataType: "JSON",
            success: function(data)
                {
                    // $("#listadoPagos"+<?php echo $idDeudor; ?>).html('');
                    //  $("#datosRecibe"+<?php echo $idDeudor; ?>).html('');
                    //   $("#fechaRecibo"+<?php echo $idDeudor; ?>).html('');
                    if (data.length>0)
                        {
                            for (i=0; i< data.length; i++) {      
                                $("#listadoPagos"+data[i]['idControl']).append("$ "+data[i]['abono']+' ' + '</br>' );
                                $("#datosRecibe"+data[i]['idControl']).append("Recibio: "+data[i]['nombreUser']+' ' + '</br>' );
                                $("#fechaRecibo"+data[i]['idControl']).append("día: "+data[i]['fechaPago']+' ' + '</br>' );
                            }  
                        }
                },complete: function(){
                    $.ajax({
                        url : "<?php echo site_url('Cruddeudores/sumaDeuda/')?>" + <?php echo $idDeudor; ?>,
                        type: "post",
                        dataType: "JSON",
                        success: function(datad)
                            {
                                $("#totalPagos").html(""); 
                               $("#totalPagos").append("<strong>$ "+datad.TotalPa+"</strong>" ); 
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Error get data from ajax');
                            }
                    });    
            
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
        });    
    }
</script>

<!-- <?php
//include "footer.php";
?> -->