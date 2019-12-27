<?php
include "header.php";
?>
    <script src="http://localhost/CDI/Panel/content/js/eliminar.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/buscador.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/jquery.tabledit.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/altausuario.js"></script>
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
        td{
            padding-left: 10px !important;
        }
        .centrado{
            padding-left: 0px !important;
            text-align: center;
        }
        a{
            cursor: pointer;
        }
        p{
            margin-bottom: 0px;
        }
    </style>

    <section class="content" style="margin-left: 15px;">
        <div class="container-fluid">
            <div class="block-header">
                <a href="http://localhost/CDI/Panel/index.php/CrudPermisos">
                    <button class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>

            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-md-5">
                                    <h2 style="margin-top: 10px;">
                                        Tipos de usuarios
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="tablaUsuarios">
                                            <thead>
                                            <tr>
                                                <th>Módulo</th>
                                                <th style="text-align: center;">Acceso</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tabla" >
                                            <tr>
                                                <td>Usuarios</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo0" name="mostrarModulo0" onChange="mostrar(0);" />
                                                        <label for="mostrarModulo0">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Contraseñas</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo1" name="mostrarModulo1" onChange="mostrar(1);" />
                                                        <label for="mostrarModulo1">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Empresas</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo2" name="mostrarModulo2" onChange="mostrar(2);" />
                                                        <label for="mostrarModulo2">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Médicos</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo3" name="mostrarModulo3" onChange="mostrar(3);" />
                                                        <label for="mostrarModulo3">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Salas</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo4" name="mostrarModulo4" onChange="mostrar(4);" />
                                                        <label for="mostrarModulo4">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Áreas internas</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo5" name="mostrarModulo5" onChange="mostrar(5);" />
                                                        <label for="mostrarModulo5">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Estudios</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo6" name="mostrarModulo6" onChange="mostrar(6);" />
                                                        <label for="mostrarModulo6">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Médicos remitentes</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo7" name="mostrarModulo7" onChange="mostrar(7);" />
                                                        <label for="mostrarModulo7">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Clientes</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo8" name="mostrarModulo8" onChange="mostrar(8);" />
                                                        <label for="mostrarModulo8">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pacientes</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo9" name="mostrarModulo9" onChange="mostrar(9);" />
                                                        <label for="mostrarModulo9">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Categorias</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo10" name="mostrarModulo10" onChange="mostrar(10);" />
                                                        <label for="mostrarModulo10">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Proveedor</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo11" name="mostrarModulo11" onChange="mostrar(11);" />
                                                        <label for="mostrarModulo11">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Artículos</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo12" name="mostrarModulo12" onChange="mostrar(12);" />
                                                        <label for="mostrarModulo12">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Línea</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo13" name="mostrarModulo13" onChange="mostrar(13);" />
                                                        <label for="mostrarModulo13">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ingreso compras</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo14" name="mostrarModulo14" onChange="mostrar(14);" />
                                                        <label for="mostrarModulo14">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Entrada</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo15" name="mostrarModulo15" onChange="mostrar(15);" />
                                                        <label for="mostrarModulo15">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Salida</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo16" name="mostrarModulo16" onChange="mostrar(16);" />
                                                        <label for="mostrarModulo16">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Orden compra</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo17" name="mostrarModulo17" onChange="mostrar(17);" />
                                                        <label for="mostrarModulo17">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Citas</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo18" name="mostrarModulo18" onChange="mostrar(18);" />
                                                        <label for="mostrarModulo18">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Todas las citas</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo19" name="mostrarModulo19" onChange="mostrar(19);" />
                                                        <label for="mostrarModulo19">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cotizaciones</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo20" name="mostrarModulo20" onChange="mostrar(20);" />
                                                        <label for="mostrarModulo20">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pedir artículos</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo21" name="mostrarModulo21" onChange="mostrar(21);" />
                                                        <label for="mostrarModulo21">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Estudios por sala</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo22" name="mostrarModulo22" onChange="mostrar(22);" />
                                                        <label for="mostrarModulo22">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Entrega de resultados</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo23" name="mostrarModulo23" onChange="mostrar(23);" />
                                                        <label for="mostrarModulo23">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Pacientes en espera
                                                    <div class="row" style="margin: 0 0 0 0 !important;" >
                                                        <div class="col-sm-12" id="tablaInterna24" style="display: none;">
                                                            <table class="table" style="margin-bottom: 0; ">
                                                                <thead>
                                                                <tr>
                                                                    <th>Recepción</th>
                                                                    <th>Pasar a cita</th>
                                                                    <th>Salió de cita</th>
                                                                    <th>Interpretación</th>
                                                                    <th>Resultados</th>
                                                                    <th>Limpiar</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td><input type="checkbox" id="recepcionPE" class="24-recepcion" value="recepcion" onchange="darPermisoEspecifico(24, 'recepcionPE')"><label for="recepcionPE"></label></td>
                                                                    <td><input type="checkbox" id="pasarCitaPE" class="24-pasarCita" value="pasarCita" onchange="darPermisoEspecifico(24, 'pasarCitaPE')"><label for="pasarCitaPE"></label></td>
                                                                    <td><input type="checkbox" id="salioCitaPE" class="24-salioCita" value="salioCita" onchange="darPermisoEspecifico(24, 'salioCitaPE')"><label for="salioCitaPE"></label></td>
                                                                    <td><input type="checkbox" id="interpretacionPE" class="24-interpretacion" value="interpretacion" onchange="darPermisoEspecifico(24, 'interpretacionPE')"><label for="interpretacionPE"></label></td>
                                                                    <td><input type="checkbox" id="resultadosPE" class="24-resultados" value="resultados" onchange="darPermisoEspecifico(24, 'resultadosPE')"><label for="resultadosPE"></label></td>
                                                                    <td><input type="checkbox" id="limpiarPE" class="24-limpiar" value="limpiar" onchange="darPermisoEspecifico(24, 'limpiarPE')"><label for="limpiarPE"></label></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo24" name="mostrarModulo24" onChange="mostrar(24);verTablaInterna(24);" />
                                                        <label for="mostrarModulo24">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Resumen del sístema
                                                    <div class="row" style="margin: 0 0 0 0 !important;" >
                                                        <div class="col-sm-12" id="tablaInterna25" style="display: none;">
                                                            <table class="table" style="margin-bottom: 0; ">
                                                                <thead>
                                                                <tr>
                                                                    <th>Recepción</th>
                                                                    <th>Pasar a cita</th>
                                                                    <th>Salió de cita</th>
                                                                    <th>Interpretación</th>
                                                                    <th>Resultados</th>
                                                                    <th>Limpiar</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td><input type="checkbox" id="recepcionRS" class="25-recepcion" value="recepcion" onchange="darPermisoEspecifico(25, 'recepcionRS')"><label for="recepcionRS"></label></td>
                                                                    <td><input type="checkbox" id="pasarCitaRS" class="25-pasarCita" value="pasarCita" onchange="darPermisoEspecifico(25, 'pasarCitaRS')"><label for="pasarCitaRS"></label></td>
                                                                    <td><input type="checkbox" id="salioCitaRS" class="25-salioCita" value="salioCita" onchange="darPermisoEspecifico(25, 'salioCitaRS')"><label for="salioCitaRS"></label></td>
                                                                    <td><input type="checkbox" id="interpretacionRS" class="25-interpretacion" value="interpretacion" onchange="darPermisoEspecifico(25, 'interpretacionRS')"><label for="interpretacionRS"></label></td>
                                                                    <td><input type="checkbox" id="resultadosRS" class="25-resultados" value="resultados" onchange="darPermisoEspecifico(25, 'resultadosRS')"><label for="resultadosRS"></label></td>
                                                                    <td><input type="checkbox" id="limpiarRS" class="25-limpiar" value="limpiar" onchange="darPermisoEspecifico(25, 'limpiarRS')"><label for="limpiarRS"></label></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo25" name="mostrarModulo25" onChange="mostrar(25);verTablaInterna(25);" />
                                                        <label for="mostrarModulo25">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Facturación de clientes</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo26" name="mostrarModulo26" onChange="mostrar(26);" />
                                                        <label for="mostrarModulo26">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Facturación</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo27" name="mostrarModulo27" onChange="mostrar(27);" />
                                                        <label for="mostrarModulo27">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Facturas del sistema</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo28" name="mostrarModulo28" onChange="mostrar(28);" />
                                                        <label for="mostrarModulo28">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Facturas de clientes</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo29" name="mostrarModulo29" onChange="mostrar(29);" />
                                                        <label for="mostrarModulo29">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Deudores</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo30" name="mostrarModulo30" onChange="mostrar(30);" />
                                                        <label for="mostrarModulo30">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Permisos</td>
                                                <td class='centrado'>
                                                    <p>
                                                        <input type="checkbox" id="mostrarModulo31" name="mostrarModulo31" onChange="mostrar(31);" />
                                                        <label for="mostrarModulo31">Dar acceso</label>
                                                    </p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>

        $(document).ready( function (){

            $.ajax({
                url: '<?=base_url('/index.php/CrudPermisos/getPermisosUsuario/'.$idTipo)?>',
                type:'POST',
                dataType: 'JSON',
                success: function (data)
                {
                    var tipoUsuario=<?=$idTipo?>;
                    for(i=0; i<data.length; i++)
                    {
                        $("#mostrarModulo"+data[i]['idModulo']).attr("checked",data[i]['mostrar']!="0");
                        if(data[i]['mostrar']=="1")
                        {
                            verTablaInterna(data[i]['idModulo']);
                        }
                    }

                    if(tipoUsuario==1)
                    {
                        //$('input').attr("disabled", "disabled");
                    }
                },
                complete: function () {
                    $.ajax({
                        url: '<?=base_url('/index.php/CrudPermisos/getPermisosEspecificos/'.$idTipo)?>',
                        type: 'POST',
                        dataType: 'JSON',
                        success: function (data)
                        {
                            for(var i=0; i<data.length; i++)
                            {
                                console.log(data[i]['acceso']);
                                if(data[i]['acceso']==1)
                                {
                                    $("."+data[i]['idModulo']+"-"+data[i]['nombreColumna']).prop("checked",true);
                                    console.log("."+data[i]['idModulo']+"-"+data[i]['nombreColumna']);
                                }
                            }
                        },complete: function () {
                            tabla=$('#tablaUsuarios').DataTable({
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
                        }
                    });


                }
            });


        });
        function mostrar(idModulo)
        {
            var url;
            if($("#mostrarModulo"+idModulo).prop("checked"))
                url="<?=base_url('/index.php/CrudPermisos/asignarPermiso/'.$idTipo)?>/1/mostrar/"+idModulo;
            else
                url="<?=base_url('/index.php/CrudPermisos/asignarPermiso/'.$idTipo)?>/0/mostrar/"+idModulo;
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'JSON',
                success: function (data)
                {
                    console.log("Ahora el usuario tiene permisos de visualizar: "+data+" -> en el modulo"+idModulo)
                }
            });
        }
        function darPermisoEspecifico(idModulo, columna)
        {

            var url;
            if($("#"+columna).prop("checked"))
                url="<?=base_url('/index.php/CrudPermisos/asignarPermisoEspecifico/'.$idTipo)?>/1/"+$("#"+columna).val()+"/"+idModulo;
            else
                url="<?=base_url('/index.php/CrudPermisos/asignarPermisoEspecifico/'.$idTipo)?>/0/"+$("#"+columna).val()+"/"+idModulo;
            $.ajax
            ({
                url: url,
                type: 'post',
                dataType: 'JSON',
                success: function (data)
                {
                    console.log("Ahora el usuario tiene permisos de visualizar: "+data+" -> en el modulo"+idModulo)
                }
            });
        }
        function verTablaInterna(idModulo) {
            $("#tablaInterna"+idModulo).toggle(1000);
        }


    </script>
<?php
include "footer.php";
?>