<?php include "header.php"?>
    <script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/altapaciente.js"></script>
    <div  id="myModal" >
        <div >

            <!-- Modal content-->
            <div>
                <div class="modal-header">

                    <h4 class="modal-title">REGISTRO DE NUEVO PACIENTE</h4>
                </div>
                <div class="modal-body">
                    <div class="body">
                        <form id="formaltaPac"  method="post">
                            <div class="row clearfix">
                                <?php
                                $conexion=new PDO("mysql:host=localhost;dbname=cointic_CDI","cointic_morelos","g,t,fS{c_GZz");
                                $conexion->query("SET CHARACTER SET utf8");
                                $medico=$conexion->query("SELECT * FROM Remitente")->fetchAll(PDO::FETCH_ASSOC);

                                $cliente=$conexion->query("SELECT * FROM clientes")->fetchAll(PDO::FETCH_ASSOC);

                                $conexion=null;
                                ?>
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
                                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
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
                                                        <input type="text" class="form-control" name="telefono" >
                                                        <label class="form-label">Teléfono</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-4">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="date" class="form-control" name="fechanaci" id="fechanaci"   onchange="calcularEdad();">
                                                        <label class="form-label">Fecha de Nacimiento</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group form-float">
                                                    <div id="linea" class="form-line">
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
                                                        <select class="form-control" class="form-control" name="remitente" id="remitente"  required>
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
<?php include "footer.php"?>