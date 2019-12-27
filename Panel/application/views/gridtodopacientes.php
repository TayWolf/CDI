<?php
include "header.php";
?>
    <script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/altapaciente.js"></script>
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
            <div class="block-header">
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-5">
                                    <h2 style="margin-top: 10px;">
                                        Pacientes Registrados
                                    </h2>
                                </div>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown" >
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" onclick="asignaClave()" data-toggle="modal" data-target="#myModal">Registrar nuevo Paciente</a></li>


                                        </ul>
                                    </li>
                                </ul>
                            </div>


                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="tablapacientes">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Paciente</th>
                                        <th>Genero<br>Paciente</th>
                                        <th>Correo<br>Paciente</th>
                                        <th>Edad<br>Paciente</th>
                                        <th>Fecha<br>Nacimiento<br>Paciente</th>
                                        <th>Teléfono<br>Paciente</th>
                                        <th>Cliente</th>
                                        <th>Remitente</th>
                                        <th>Razón<br>Social</th>
                                        <th>Domicilio<br>Fiscal</th>
                                        <th>RFC</th>
                                        <th>Teléfono</th>
                                        <th>Colonia</th>
                                        <th>Municipio</th>
                                        <th>Estado</th>
                                        <th>Eliminar</th>


                                    </tr>
                                    </thead>
                                    <?php 
                                    foreach ($pacientes as $row) {
                                        $idPaciente=$row['idPaciente'];
                                        $idCliente=$row['idCliente'];
                                        $idRemitente=$row['idRemitente'];
                                        echo "<input type='hidden' id='ident$idPaciente' name='ident$idPaciente' value='$idCliente'>
                                        <input type='hidden' id='identDos$idPaciente' name='identDos$idPaciente' value='$idRemitente'>";
                                    }
                                     ?>
                                 
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="myModal" role="dialog">
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
                                                        <input type="text" class="form-control" id="clave" name="clave" required >
                                                        <label class="form-label">Clave</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"  onkeyup="form.nombre.value=form.nombre.value.toUpperCase();" id="nombre" name="nombre" required>



                                                        <label class="form-label">Nombre del paciente</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-md-4">
                                                <!--                                                         <p>
                                                                                                           <b>Género</b>
                                                                                                        </p> -->
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
                                                        <input type="text" class="form-control" name="correo" >
                                                        <label class="form-label">Correo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" onkeyup="form.telefono.value=form.telefono.value.toUpperCase();" name="telefono" >
                                                        <label class="form-label">Teléfono</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="date" class="form-control" name="fechanaci" id="fechanaci"   onchange="calcularEdad();" required>
                                                        <label class="form-label">Fecha de Nacimiento</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group form-float">
                                                    <div id="linea" class="form-line">
                                                        <input type="hidden" name="edad-paciente" value="">
                                                        <input type="number" class="form-control" name="edad" id="edad"  >
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
                                                        <select class="form-control" class="form-control"  name="remitente" id="remitente"  required>
                                                            <option value="">Seleccione un Médico Remitente</option>
                                                            <?php
                                                            $idconteo=0;
                                                            foreach ($medico as $row) {

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
                                            <div class="col-sm-6">
                                                <p>
                                                    <b>Cliente</b>
                                                </p>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select class="form-control" class="form-control" name="cliente" id="cliente" required>
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
                                            <div class="col-md-8">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" onkeyup="form.razonSocial.value=form.razonSocial.value.toUpperCase();" id="razonSocial" name="razonSocial">
                                                        <label class="form-label">Razón Social</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" onkeyup="form.RFC.value=form.RFC.value.toUpperCase();" id="RFC" name="RFC">
                                                        <label class="form-label">RFC</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" onkeyup="form.domfiscal.value=form.domfiscal.value.toUpperCase();" id="domfiscal" name="domfiscal">
                                                        <label class="form-label">Domicilio Fiscal</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" onkeyup="form.estado.value=form.estado.value.toUpperCase();" id="estado" name="estado">
                                                        <label class="form-label">Estado</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" onkeyup="form.municipio.value=form.municipio.value.toUpperCase();" id="municipio" name="municipio">
                                                    <label class="form-label">Municipio</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-md-6">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" onkeyup="form.colonia.value=form.colonia.value.toUpperCase();"id="colonia" name="colonia">
                                                        <label class="form-label">Colonia</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" onkeyup="form.telefonopaciente.value=form.telefonopaciente.value.toUpperCase();" id="telefonopaciente" name="telefonopaciente">
                                                    <label class="form-label">Telefono</label>
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


    <script type="text/javascript">
        //window.onload=cambiainput;
        $(document).ready(function () {
            $('#tablapacientes').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": "<?php echo base_url('index.php/Crudpacientes/getListadoPacientes/') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
                    "complete": function () {
                        $('#tablapacientes').Tabledit({
                            url: 'http://localhost/CDI/Panel/index.php/Crudpacientes/modificarDatos/',
                            // eventType: 'dblclick',
                            editButton: false,
                            deleteButton:false,
                            columns: {
                                identifier: [0, 'idPaciente'],
                                editable: [[1, 'nombre'], [2, 'genero', '{"0": "Elija una opción", "1": "Masculino", "2": "Femenino"}'], [3, 'correo'],[4, 'edad'], [5, 'fecha'], [6, 'telefono'], [9, 'razonSocial'], [10, 'domFiscal'], [11, 'RFC'], [12, 'telefono'], [13, 'colonia'], [14, 'municipio'], [15, 'estado'] ]
                            }
                        });
                    }
                },
                "columns": [
                    { "data": "idPaciente" },
                    { "data": "Paciente" },
                    { "data": "Genero_Paciente" },
                    { "data": "Correo_Paciente" },
                    { "data": "Edad_Paciente" },
                    { "data": "Fecha_Nacimiento_Paciente" },
                    { "data": "Telefono_Paciente" },
                    { "data": "Cliente" },
                    { "data": "Remitente" },
                    { "data": "Razon_Social" },
                    { "data": "Domicilio_Fiscal" },
                    { "data": "RFC" },
                    { "data": "Telefono" },
                    { "data": "Colonia" },
                    { "data": "Municipio" },
                    { "data": "Estado" },
                    { "data": "Eliminar" }
                ],
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                }

            });
        });


        function cambiainput(){
            $("input[name*='fecha']").attr("type",'date');
        }

        $('body').toUpperCase();
    </script>
<?php
include "footer.php";
?>