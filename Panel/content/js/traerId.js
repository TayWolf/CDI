
///////////////////////////////////////////// FUNCIONES PARA APARTADO DE ESTUDIOS ///////////////////////////////////////////

function traerId(idEstudio)
{
    var idEstudio=idEstudio;
    $("#idactual").val(idEstudio);

}

function traeNombre(idEstudio){
    $.ajax({
        url: 'http://localhost/CDI/Panel/index.php/Crudestudios/traeNombreEstudio/'+idEstudio,
        dataType: 'HTML',
        success: function (data)
        {
            $("#nombreStudio").html(data);

        }
    });

}

function traeclientes(){
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudestudios/traeclientes/",
        type: "GET",
        dataType: "json",
        success: function(data)
        {
            if (data.length>0) {
                for (var i = 0; i <= data.length; i++) {
                    $("#pintaClientes").append('<tr id="pintaPrecios'+data[i]["idCliente"]+'"><td>'+data[i]["nombreCliente"]+'</td></tr>');
                    // <td><div class="form-group form-float" style="margin-bottom: 0px;"><div class="form-line"><input type="text" class="form-control" id="preciocliente'+data[i]["idCliente"]+'" name="preciocliente'+data[i]["idCliente"]+'" pattern="[0-9,.]{1,100}"></div></div></td>
                    traepreciocliente(data[i]["idCliente"]);
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function traepreciocliente(idcli){
    var idCli = idcli;
    var idEstudio = $("#idactual").val();
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudestudios/traeprecios/"+idCli+"/"+idEstudio,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
            // alert(data);
            if (data != null) {
                $("#pintaPrecios"+idCli).append('<td style="display:none;">'+data.IdprecioCliente+'</td><td>'+data.precio+'</td>');
                $('#tablaPrecios').Tabledit({
                    url: 'Crudestudios/modificarPrecios/',
                    eventType: 'dblclick',
                    editButton: false,
                    deleteButton:false,
                    columns: {
                        identifier: [1, 'idpreciocliente'],
                        editable: [[2, 'precio']]
                    }
                });
            }
            else{
                $("#pintaPrecios"+idCli).append('<a id="asigna'+idCli+'" href="#" onclick="asignarprecio('+idCli+','+idEstudio+')">Asignar Precio</a>');
                //$("#pintaPrecios"+idCli).append('<td><div class="form-group form-float" style="margin-bottom: 0px;"><div class="form-line"><input type="text" class="form-control" id="preciocliente'+idCli+'" name="preciocliente'+idCli+'" pattern="[0-9,.]{1,100}" value="'+data.precio+'"></div></div></td>');
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}

function asignarprecio(idC,idE){
    var idC = idC;
    var idE = idE;
    //alert(idC+" "+idE)
    $("#asigna"+idC).hide();
    $("#pintaPrecios"+idC).append('<input type="text" id="preciocli'+idC+'" name="preciocli'+idC+'" pattern="[0-9,.]{1,100}"/><button type="button" onclick="insertaprecio('+idC+','+idE+')">OK</button>');
    //$("#pintaPrecios"+idC).append('<form id="form'+idC+'"><input type="text" id="preciocli'+idC+'" name="preciocli'+idC+'" pattern="[0-9,.]{1,100}"/><button type="button" onclick="insertaprecio('+idC+','+idE+')">OK</button></form>');
}

function insertaprecio(idC,idE){
    var idC = idC;
    var idE = idE;
    var precio = $("#preciocli"+idC).val();
    var parametros = {"idC":idC,"idE":idE,"precio":precio}
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudestudios/guardaprecio/",
        type: "post",
        data: parametros,
        dataType: "HTML",
        success: function(data)
        {
            $("#pintaClientes").html("");
            traeclientes();
            // $('#cargando').fadeIn(1000).html(data);
            // location.href='http://localhost/CDI/Panel/index.php/Crudestudios';
        }

    });
}


///////////////////////////////////////////// FUNCIONES PARA APARTADO DE SALAS ///////////////////////////////////////////

function traerIdSala(idSala)
{
    var idSala=idSala;
    $("#idsalaactual").val(idSala);

}

function traeNombreSala(nombre){
    $("#nombresaladoc").html("");
    $("#nombresala").html("");
    var nombre=nombre;
    $("#nombresala").append(nombre);
    $("#nombresaladoc").append(nombre);
}

function allowDropp(ev) {
    ev.preventDefault();
    // alert("entra ALLOWDROP");
}

function dragg(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
// alert("ENTRA DRAG");
}

function dropp(ev,ids) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));

    var id=ids;
// alert("ENTRA DROP"+id);
    altaEstudios(id);
}

function altaEstudios(id)
{
    var id=id;
    $("#idestudio"+id).val(id);
    var total=$("#total").val();
    var idactual=$("#idsalaactual").val();
    var idE=$("#idestudio"+id).val();
    //var idub = idS+i;

    var sala = $("#dragEst"+idE);
    var funcionaejecutar = sala.parent().attr('id');
    // alert(funcionaejecutar);

    if (idE!="") {
        if (funcionaejecutar == "asignarEstudio"+idE) {
            $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudsalas/agregarPuente/" + idE+"/"+total+"/"+idactual,
                type: "GET",
                dataType: "html",
                success: function(data)
                {
                    // alert("Dato insertado "+data);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }else if (funcionaejecutar == "quitarEstudio"+idE){
            $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudsalas/quitarPuente/" + idE+"/"+total+"/"+idactual,
                type: "GET",
                dataType: "html",
                success: function(data)
                {
                    // alert("Dato eliminado");

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    }
}

function identificaEstudiosAsignados(){
    $("#pintaestudios").html("");
    var total = $("#total").val();
    var actual = $("#idsalaactual").val();

    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudsalas/buscaasignadas/"+actual,
        type: "GET",
        dataType: "JSON",
        success: function(JSONResult)
        {
            var data;
            for(var i=0; i<JSONResult.length; i++)
            {
                data=JSONResult[i];
                if (data) {
                    $("#pintaestudios").append('<tr><td id="quitarEstudio'+data.IdEstudio+'" ondrop="dropp(event,'+data.IdEstudio+')" ondragover="allowDropp(event)"><input type="hidden" name="idestudio'+data.IdEstudio+'" id="idestudio'+data.IdEstudio+'" class="filled-in chk-col-purple"></td><td id="asignarEstudio'+data.IdEstudio+'" ondrop="dropp(event,'+data.IdEstudio+')" ondragover="allowDropp(event)"><p id="dragEst'+data.IdEstudio+'" draggable="true" ondragstart="dragg(event)">'+data.nombreEstudio+'</p></td></tr>');
                }
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        },complete: function () {
            identificaEstudiosDisponibles();
        }
    });


}

function identificaEstudiosDisponibles(){

    var total = $("#total").val();
    var actual = $("#idsalaactual").val();

    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudsalas/buscadisponibles/"+actual,
        type: "GET",
        dataType: "JSON",
        success: function(JSONResult)
        {
            var data;
            for(var i=0; i<JSONResult.length; i++)
            {
                data=JSONResult[i];
                if (data) {
                    $("#pintaestudios").append('<tr><td id="quitarEstudio'+data.IdEstudio+'" ondrop="dropp(event,'+data.IdEstudio+')" ondragover="allowDropp(event)"><p id="dragEst'+data.IdEstudio+'" draggable="true" ondragstart="dragg(event)">'+data.nombreEstudio+'</p><input type="hidden" name="idestudio'+data.IdEstudio+'" id="idestudio'+data.IdEstudio+'" class="filled-in chk-col-purple"></td><td id="asignarEstudio'+data.IdEstudio+'" ondrop="dropp(event,'+data.IdEstudio+')" ondragover="allowDropp(event)"></td></tr>');
                }
            }


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}

/////alta horarios
var array = {
    'datosPermiso': []
};
var arregloJson;
function agregarHora()
{
    var idPuente=$("#idPuente").val();
    var entrada=$("#entrada").val();
    var salida=$("#salida").val();
    if (entrada!="" && salida!="")
    {

        var dia=$("#dia").val();
        if (dia==1)
        {
            valorDia="Lunes";
        }else if (dia==2)
        {
            valorDia="Martes";
        }else if (dia==3)
        {
            valorDia="Miercoles";
        }
        else if (dia==4)
        {
            valorDia="Jueves";
        }
        else if (dia==5)
        {
            valorDia="Viernes";
        }else if (dia==6)
        {
            valorDia="Sabado";
        }else if (dia==7)
        {
            valorDia="Domingo";
        }

        array.datosPermiso.push({'dia':dia,'entrada': entrada, 'salida':salida });
        $("#listaHorarios").append('<tr><td>'+valorDia+'</td><td>'+entrada+'</td><td>'+salida+'</td><td><a href="#" class="btn-default">Elimina</a></tr>');
        limpiaCampos();

    }else
    {
        swal("Aviso!", "Selecciones los horarios por favor.", "warning")
    }
}
function limpiaCampos()
{
    $("#entrada").val('');
    $("#salida").val('');
}

function altaHorario()
{
    var url;
    url= "http://localhost/CDI/Panel/index.php/Crudsalas/altahora/";
    var idPuente = $("#idPuente").val();
    var dia = $("#dia").val();
    arregloJson=JSON.stringify(array);
    arre = JSON.parse(arregloJson);
    var parametross = {
        "idPuente":idPuente,
        "dia":dia,
        "arreglo":arre
    };
    if (arregloJson=='{"datosPermiso":[]}')
    {
        swal("Aviso!", "Por favor ingrese los horarios para el médico.", "warning")
    }
    if (arregloJson!='{"datosPermiso":[]}')
    {

        $.ajax({
            url : url,
            type: "POST",
            data: parametross,
            //data:formData,
            dataType: "HTML",
            success: function(data)
            {
                $("#listaHorarios").html("");
                array.datosPermiso=[];
                $('#myModal4').modal('hide');


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
}
////fin alta horarios

/////////////////////////////////////// FUNCIONES PARA APARTADO DE SALAS (DOCTORES ASIGNADOS) ///////////////////////////////////////

function identificaMedicosAsignados(){
    $("#pintdoctores").html("");
    var total = $("#totaldoc").val();
    var actual = $("#idsalaactual").val();
    for (var i = 1; i <= total; i++) {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudsalas/buscaDocsasignados/"+i+"/"+actual,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data != "null") {
                    $("#pintdoctores").append('<tr><td id="quitar'+data.idDoctor+'" ondrop="dropdoc(event,'+data.idDoctor+')" ondragover="allowDropdoc(event)"><input type="hidden" name="iddoctor'+data.idDoctor+'" id="iddoctor'+data.idDoctor+'" class="filled-in chk-col-purple"></td><td id="asignar'+data.idDoctor+'" ondrop="dropdoc(event,'+data.idDoctor+')" ondragover="allowDropdoc(event)"><p id="drag'+data.idDoctor+'" draggable="true" ondragstart="dragdoc(event)">'+data.nombreDoc+'</p></td><td id="ocultaverhorario'+data.idDoctor+'" style="text-align: center;"><a style="cursor:pointer;" data-toggle="modal" data-target="#myModal5" onclick="traeidHorariosSalaDoc('+actual+','+data.idDoctor+')">Ver</a></td></tr>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    identificaMedicosDisponibles();
}

function identificaMedicosDisponibles(){

    var total = $("#totaldoc").val();
    var actual = $("#idsalaactual").val();
    for (var i = 1; i <= total; i++) {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudsalas/buscaDocsdisponibles/" + i+"/"+actual,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                // alert(data);
                if (data != "null") {
                    $("#pintdoctores").append('<tr><td id="quitar'+data.idDoctor+'" ondrop="dropdoc(event,'+data.idDoctor+')" ondragover="allowDropdoc(event)"><p id="drag'+data.idDoctor+'" draggable="true" ondragstart="dragdoc(event)">'+data.nombreDoc+'</p><input type="hidden" name="iddoctor'+data.idDoctor+'" id="iddoctor'+data.idDoctor+'" class="filled-in chk-col-purple"></td><td id="asignar'+data.idDoctor+'" ondrop="dropdoc(event,'+data.idDoctor+')" ondragover="allowDropdoc(event)"></td></tr>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
}

function allowDropdoc(ev) {
    ev.preventDefault();
    // alert("entra ALLOWDROP");
}

function dragdoc(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
// alert("ENTRA DRAG");
}

function dropdoc(ev,ids) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));

    var id=ids;
// alert("ENTRA DROP"+id);
    altaDocs(id);
}

function altaDocs(id)
{
    var id=id;
    $("#iddoctor"+id).val(id);
    var total=$("#totaldoc").val();
    var idactual=$("#idsalaactual").val();
    var idD=$("#iddoctor"+id).val();
    //var idub = idS+i;
    var sala = $("#drag"+idD);
    var funcionaejecutar = sala.parent().attr('id');
    // alert(funcionaejecutar);

    if (idD!="") {
        if (funcionaejecutar == "asignar"+idD) {
            $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudsalas/agregarPuenteDocs/" + idD+"/"+total+"/"+idactual,
                type: "GET",
                dataType: "html",
                success: function(data)
                {
                    // alert("Dato insertado "+data);
                    horarios(idD,idactual);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }else{
            $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudsalas/quitarPuenteDocs/" + idD+"/"+total+"/"+idactual,
                type: "GET",
                dataType: "html",
                success: function(data)
                {
                    // alert("Dato eliminado");
                    $("#ocultaverhorario"+id).hide();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    }
}

function horarios(idD,idS){
    var idD = idD;
    var idS = idS;
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudsalas/treaiddoctorsala/" + idD+"/"+idS,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            // alert("id"+data.idsalaMedico);
            $("#idPuente").val(data.idsalaMedico);
            $("#myModal4").modal("show");
            identificaMedicosAsignados();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function cierramodalhoras(){
    $("#myModal4").modal("hide");
}

function traeidHorariosSalaDoc(sala,doc){
    var sala = sala;
    var doc = doc;
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudsalas/traeidhorarioSM/" + sala+"/"+doc,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //alert(data);
            $("#idSalaMedico").val(data.idsalaMedico);
            traeHorarios();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function traeHorarios(){
    $("#listaHorarios1").html("");
    var id=$("#idSalaMedico").val();
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudsalas/traehorarios/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            // alert(data);
            if (data.length>0) {
                for (var i = 0; i <= data.length; i++) {
                    var dia;
                    if (data[i]["dia"] == 1) {
                        dia = "Lunes";
                    }
                    else if (data[i]["dia"] == 2) {
                        dia = "Martes";
                    }
                    else if (data[i]["dia"] == 3) {
                        dia = "Miercoles";
                    }
                    else if (data[i]["dia"] == 4) {
                        dia = "Jueves";
                    }
                    else if (data[i]["dia"] == 5) {
                        dia = "Viernes";
                    }
                    else if (data[i]["dia"] == 6) {
                        dia = "Sábado";
                    }
                    else if (data[i]["dia"] == 7) {
                        dia = "Domingo";
                    }
                    $("#listaHorarios1").append('<tr><td style="display:none">'+data[i]["idcontrol"]+'</td><td>'+dia+'</td><td>'+data[i]["horaEntrada"]+'</td><td>'+data[i]["horaSalida"]+'</td><td><a href="#" onclick="eliminahora('+data[i]["idcontrol"]+')">Elimina</a></td></tr>');
                }
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}

function agregarHoraMod5()
{

    if(Date.parse('01/01/2019 '+$("#entradamod5").val()) >= Date.parse('01/01/2019 '+$("#salidamod5").val()))
    {
        swal("Aviso!", "El horario de inicio no puede ser mayor que el horario de fin.", "warning")
        return;
    }
    var idPuente=$("#idSalaMedico").val();
    var entrada=$("#entradamod5").val();
    var salida=$("#salidamod5").val();
    if (entrada!="" && salida!="")
    {
        $.ajax({
            url: 'http://localhost/CDI/Panel/index.php/Crudsalas/validarEmpalmeHorarioMedico/',
            data: {dia: $("#diamod5").val(), entrada:$("#entradamod5").val(), salida: $("#salidamod5").val(), idSalaMedico:$("#idSalaMedico").val()},
            type: 'POST',
            success: function (data)
            {
                if(data)
                {
                    var dia=$("#diamod5").val();
                    if (dia==1)
                    {
                        valorDia="Lunes";
                    }else if (dia==2)
                    {
                        valorDia="Martes";
                    }else if (dia==3)
                    {
                        valorDia="Miercoles";
                    }
                    else if (dia==4)
                    {
                        valorDia="Jueves";
                    }
                    else if (dia==5)
                    {
                        valorDia="Viernes";
                    }else if (dia==6)
                    {
                        valorDia="Sabado";
                    }else if (dia==7)
                    {
                        valorDia="Domingo";
                    }

                    array.datosPermiso.push({'dia':dia,'entrada': entrada, 'salida':salida });
                    $("#listaHorarios2").append('<tr><td>'+valorDia+'</td><td>'+entrada+'</td><td>'+salida+'</td><td><a href="#" class="btn-default">Elimina</a></tr>');
                    limpiaCamposMod5();

                }
                else
                {
                    swal("Aviso!", "Los horarios del medico se empalman con otra sala", "warning")
                }
            }
        });
    }else
    {
        swal("Aviso!", "Selecciones los horarios por favor.", "warning")
    }

}

function limpiaCamposMod5()
{
    $("#entradamod5").val('');
    $("#salidamod5").val('');
}

function altaHorariomod5()
{
    var url;
    url= "http://localhost/CDI/Panel/index.php/Crudsalas/altahora/";
    var idPuente = $("#idSalaMedico").val();
    var dia = $("#diamod5").val();
    arregloJson=JSON.stringify(array);
    arre = JSON.parse(arregloJson);
    var parametross = {
        "idPuente":idPuente,
        "dia":dia,
        "arreglo":arre
    };
    if (arregloJson=='{"datosPermiso":[]}')
    {
        swal("Aviso!", "Por favor ingrese los horarios para el médico.", "warning")
    }
    if (arregloJson!='{"datosPermiso":[]}')
    {

        $.ajax({
            url : url,
            type: "POST",
            data: parametross,
            //data:formData,
            dataType: "HTML",
            success: function(data)
            {
                $("#listaHorarios2").html("");
                array.datosPermiso=[];
                $('#myModal5').modal('hide');


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }
}

$(document).on('click', '.btn-default', function (event) {
    event.preventDefault();
    var indice= $(this).closest('tr').index(); //para eliminar el registro de la tabla y en el crud
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

function eliminahora(id){
    var id = id;
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudsalas/eliminahora/"+id,
        type: "POST",
        dataType: "HTML",
        success: function(data)
        {
            traeHorarios();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}