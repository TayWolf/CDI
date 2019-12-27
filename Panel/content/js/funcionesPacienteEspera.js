window.onload = getlistado;

function getlistado ()
{

    $("#listado").html("");
    var idSala=$("#areaSele").val();
    var fechaconsu=$("#fechaconsu").val();
    var fechaconsuFinal=$("#fechaconsuFinal").val();
    var doctorName=$("#doctorName").val();
    var pacienteName=$("#pacienteName").val();
    var folioCita=$("#folioCitaFiltro").val();
    if(!idSala.length>0)
    {
        idSala="0";
    }
    if(!fechaconsu.length>0)
    {
        fechaconsu="0";
    }
    if(!fechaconsuFinal.length>0)
    {
        fechaconsuFinal="0";
    }
    if(!doctorName.length>0)
    {
        doctorName="0";
    }
    if(!pacienteName.length>0)
    {
        pacienteName="0";
    }
    if(!folioCita.length>0)
    {
        folioCita="0";
    }
    var direccion="http://localhost/CDI/Panel/index.php/CrudPacienteEspera/traeListaEntrega/"+idSala+"/"+fechaconsu+"/"+fechaconsuFinal+"/"+folioCita+"/"+encodeURIComponent(doctorName)+"/"+encodeURIComponent(pacienteName);

    $.ajax({
        url : direccion,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if(data.length > 0)
            {
                for(i=0; i<data.length; i++)
                {
                    var idFolio = data[i]["folioCita"];
                    var idCita = data[i]["idCita"];
                    var folioCita = data[i]["idCita"];
                    var radioButtons="";
                    var prioridadEstudio="";
                    var prioridad=data[i]["prioridad"];
                    var urgencia=data[i]["urgencia"];
                    if (data[i]["statusPago"]==1)
                    {
                        var checked="checked";
                    }else{
                        var checked="";
                    }
                    if (data[i]["statusPago"]==4)
                    {
                        var checked="checked";
                    }
                    var statusPago=data[i]["statusPago"];
                    if(statusPago==0)
                    {
                        statusPago="Adeudo";
                        var checkedd="";
                    }
                    else if(statusPago==1)
                    {
                        statusPago="Pagado";
                        var checkedd="checked";
                    }
                    else if(statusPago==2)
                    {
                        statusPago="Adeudo";
                        var checkedd="";
                    }
                    else if(statusPago==4)
                    {
                        statusPago="Cortesia";
                        var checkedd="checked";
                    }
                    if(prioridad==1||prioridad==0||!prioridad)
                    {
                        prioridadEstudio="<button  class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: white; padding-bottom: 0px;padding-top: 0px; width: 100%; background: rgb(76, 175, 80);\">Normal ("+statusPago+")</button>";
                    }
                    else if(prioridad==2)
                    {
                        prioridadEstudio="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: black; padding-bottom: 0px;padding-top: 0px; width: 100%; background: rgb(255, 235, 59);\">Entregar hoy ("+statusPago+")</button>";
                    }
                    else if(prioridad==3)
                    {
                        prioridadEstudio="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: white; padding-bottom: 0px;padding-top: 0px; width: 100%; background: rgb(253, 11, 19);\">Urgente! ("+statusPago+")</button>";
                    }
                    ///
                    if(urgencia==0)
                    {
                        prioridadurgencia="<button  class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: white; padding-bottom: 0px;padding-top: 0px; width: 100%; background: rgb(76, 175, 80);\">Normal</button>";
                    }
                    else if(urgencia==1)
                    {
                        prioridadurgencia="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: black; padding-bottom: 0px;padding-top: 0px; width: 100%; background: rgb(253, 11, 19);\">Urgencia</button>";
                    }

                    //

                    if(data[i]['statusProceso']==1)
                    {
                        // alert(data[i]['statusProceso'])
                        radioButtons=' ' +
                            '<td><label><input class="radio-col-cyan recepcion" checked type="radio" name="radio'+idCita+'"   id="valor1Radio'+idCita+'" value="1" onClick="cambiarStatusProceso(1, '+idCita+')"><span></span></label></td>' +
                            '<td><input        class="radio-col-cyan pagado" type="checkbox" '+checkedd+' id="radio'+idCita+'" name="radio'+idCita+'" value="2" '+checked+' disabled ><label for="radio'+idCita+'"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan pasarCita" type="radio" name="radio'+idCita+'" value="3" id="valor3Radio'+idCita+'" onClick="cambiarStatusProceso(3, '+idCita+')"><span></span></label></td>' +
                            '<td><label><input class="radio-col-cyan salioCita" type="radio" value="4" id="valor4Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(4, '+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan interpretacion" type="radio" value="5" id="valor5Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(5, '+idCita+'); mandarInterpretacion('+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan resultados" type="radio" value="6" id="valor6Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(6, '+idCita+')"><span></span></label></td>';
                    }
                    else if(data[i]['statusProceso']==2)
                    {
                        radioButtons=' ' +
                            '<td><label><input class="radio-col-cyan recepcion" type="radio" name="radio'+idCita+'" value="1"  id="valor1Radio'+idCita+'" onClick="cambiarStatusProceso(1, '+idCita+')"><span></span></label></td>' +
                            '<td><input        class="radio-col-cyan pagado" type="checkbox" '+checkedd+' id="radio'+idCita+'" name="radio'+idCita+'" value="2" '+checked+' disabled ><label for="radio'+idCita+'"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan pasarCita" type="radio" name="radio'+idCita+'" value="3" id="valor3Radio'+idCita+'"  onClick="cambiarStatusProceso(3, '+idCita+')"><span></span></label></td>' +
                            '<td><label><input class="radio-col-cyan salioCita" type="radio" value="4"  id="valor4Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(4, '+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan interpretacion" type="radio" value="5"  id="valor5Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(5, '+idCita+'); mandarInterpretacion('+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan resultados" type="radio" value="6"  id="valor6Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(6, '+idCita+')"><span></span></label></td>';
                    }
                    else if(data[i]['statusProceso']==3)
                    {
                        radioButtons=' ' +
                            '<td><label><input class="radio-col-cyan recepcion" type="radio" name="radio'+idCita+'" value="1" id="valor1Radio'+idCita+'"  onClick="cambiarStatusProceso(1, '+idCita+')"><span></span></label></td>' +
                            '<td><input        class="radio-col-cyan pagado" type="checkbox" '+checkedd+' id="radio'+idCita+'" name="radio'+idCita+'" value="2" '+checked+' disabled ><label for="radio'+idCita+'"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan pasarCita" type="radio" name="radio'+idCita+'" checked   id="valor3Radio'+idCita+'" value="3" onClick="cambiarStatusProceso(3, '+idCita+')"><span></span></label></td>' +
                            '<td><label><input class="radio-col-cyan salioCita" type="radio" value="4"  id="valor4Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(4, '+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan interpretacion" type="radio" value="5"  id="valor5Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(5, '+idCita+'); mandarInterpretacion('+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan resultados" type="radio" value="6"  id="valor6Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(6, '+idCita+')"><span></span></label></td>';
                    }
                    else if(data[i]['statusProceso']==4)
                    {
                        radioButtons=' ' +
                            '<td><label><input class="radio-col-cyan recepcion" type="radio" name="radio'+idCita+'" value="1" id="valor1Radio'+idCita+'" onClick="cambiarStatusProceso(1, '+idCita+')"><span></span></label></td>' +
                             '<td><input       class="radio-col-cyan pagado" type="checkbox" '+checkedd+' id="radio'+idCita+'" name="radio'+idCita+'" value="2" '+checked+' disabled ><label for="radio'+idCita+'"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan pasarCita" type="radio" name="radio'+idCita+'" value="3"  id="valor3Radio'+idCita+'" onClick="cambiarStatusProceso(3, '+idCita+')"><span></span></label></td>' +
                            '<td><label><input class="radio-col-cyan salioCita" type="radio" value="4"  id="valor4Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(4, '+idCita+')" checked><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan interpretacion" type="radio" value="5"  id="valor5Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(5, '+idCita+'); mandarInterpretacion('+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan resultados" type="radio" value="6"  id="valor6Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(6, '+idCita+')"><span></span></label></td>';
                    }
                    else if(data[i]['statusProceso']==5)
                    {
                        radioButtons=' ' +
                            '<td><label><input class="radio-col-cyan recepcion" type="radio" name="radio'+idCita+'"  id="valor1Radio'+idCita+'" value="1" onClick="cambiarStatusProceso(1, '+idCita+')"><span></span></label></td>' +
                             '<td><input       class="radio-col-cyan pagado" type="checkbox" '+checkedd+' id="radio'+idCita+'" name="radio'+idCita+'" value="2" '+checked+' disabled ><label for="radio'+idCita+'"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan pasarCita" type="radio" name="radio'+idCita+'" value="3"  id="valor3Radio'+idCita+'" onClick="cambiarStatusProceso(3, '+idCita+')"><span></span></label></td>' +
                            '<td><label><input class="radio-col-cyan salioCita" type="radio" value="4"  id="valor4Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(4, '+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan interpretacion" type="radio" value="5"  id="valor5Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(5, '+idCita+'); mandarInterpretacion('+idCita+')" checked><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan resultados" type="radio" value="6"  id="valor6Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(6, '+idCita+')"><span></span></label></td>';
                    }
                    else if(data[i]['statusProceso']==6)
                    {
                        radioButtons=' ' +
                            '<td><label><input class="radio-col-cyan recepcion" type="radio" name="radio'+idCita+'" value="1" id="valor1Radio'+idCita+'" onClick="cambiarStatusProceso(1, '+idCita+')"><span></span></label></td>' +
                             '<td><input       class="radio-col-cyan pagado" type="checkbox" '+checkedd+' id="radio'+idCita+'" name="radio'+idCita+'" value="2" '+checked+' disabled ><label for="radio'+idCita+'"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan pasarCita" type="radio" name="radio'+idCita+'" value="3"  id="valor3Radio'+idCita+'" onClick="cambiarStatusProceso(3, '+idCita+')"><span></span></label></td>' +
                            '<td><label><input class="radio-col-cyan salioCita" type="radio" value="4"  id="valor4Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(4, '+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan interpretacion" type="radio" value="5"  id="valor5Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(5, '+idCita+'); mandarInterpretacion('+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan resultados" type="radio" value="6"  id="valor6Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(6, '+idCita+')" checked><span></span></label></td>';
                    }
                    else {
                        //no encuentra valor por lo tanto no hace checks a nada
                        radioButtons=' ' +
                            '<td><label><input class="radio-col-cyan recepcion" type="radio" name="radio'+idCita+'" value="1" id="valor1Radio'+idCita+'"  onClick="cambiarStatusProceso(1, '+idCita+')"><span></span></label></td>' +
                             '<td><input       class="radio-col-cyan pagado" type="checkbox" '+checkedd+' id="radio'+idCita+'" name="radio'+idCita+'" value="2" '+checked+' disabled ><label for="radio'+idCita+'"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan pasarCita" type="radio" name="radio'+idCita+'" value="3"  id="valor3Radio'+idCita+'" onClick="cambiarStatusProceso(3, '+idCita+')"><span></span></label></td>' +
                            '<td><label><input class="radio-col-cyan salioCita" type="radio" value="4"  id="valor4Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(4, '+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan interpretacion" type="radio" value="5"  id="valor5Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(5, '+idCita+'); mandarInterpretacion('+idCita+')"><span></span></label></td>'+
                            '<td><label><input class="radio-col-cyan resultados" type="radio" value="6"  id="valor6Radio'+idCita+'" name="radio'+idCita+'" onClick="cambiarStatusProceso(6, '+idCita+')"><span></span></label></td>';
                    }
                    $("#listado").append('<tr><form><td>'+idFolio+'</td><td>'+data[i]["nombrePaci"]+'</td><td>'+data[i]["nombreEstudio"]+'</td><td>'+data[i]['nombre']+'</td><td>'+data[i]["horarioCita"]+'</td><td>'+data[i]["nombreDoc"]+'</td>'+radioButtons+'<td><a class="limpiar" onClick="resetRadioButtons('+idCita+')" style="cursor: pointer;">Limpiar</a></td><td>'+prioridadurgencia+'</td><td>'+statusPago+'</td></form></tr>');

                    // $("#listado").append('<tr><td>'+data[i]["horarioCita"]+'</td><td>'+data[i]["fechaCita"]+'</td><td>'+data[i]["Sala"]+'</td><td>'+data[i]["nombreEstudio"]+'</td><td>'+data[i]["nombrePaci"]+'</td><td>'+data[i]["edadPaci"]+'</td><td></td><td><input type="checkbox" id="cr'+idCita+'" name ="cr'+idCita+'" class="filled-in"><label for="cr'+idCita+'"></label></td><td>'+data[i]["nombreDoc"]+'</td><td><input type="checkbox" id="Ate'+idCita+'" name ="Ate'+idCita+'" class="filled-in"><label for="Ate'+idCita+'"></label></td><td>'+data[i]["horaTerminada"]+'</td><td></td><td></td><td>'+data[i]["nombreRem"]+'</td></tr>');
                }
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(textStatus+"\n"+ errorThrown);
        },
        complete: function () {
            colocarHistorialHorarios(idSala,fechaconsu,fechaconsuFinal,folioCita,doctorName,pacienteName);
        }
    });

}
function validacionPermisos() {
    /*
    TODO:
    traer el arreglo de permisos. Buscar la clase de la columna y ponerle un disbled
    en el caso de limpiar, quitar u ocultar el enlace
    */
    var llaves=Object.keys(arregloPermisosColumnas);

    for(var i=0; i<llaves.length; i++)
    {

        if(arregloPermisosColumnas[llaves[i]]==0)
        {
            $("."+llaves[i]).prop("disabled", true);
            $("."+llaves[i]).attr("onClick", "");
            $("."+llaves[i]).css("cursor", "not-allowed;");
            $("."+llaves[i]).addClass("unselectable");

            $("."+llaves[i]).closest('span').addClass("unselectable");
            $("."+llaves[i]).closest('label').addClass("unselectable");
            $("."+llaves[i]).closest('td').addClass("unselectable");

            $("."+llaves[i]+" input[type='radio']").parent().children("span").addClass("unselectable");
        }

    }

}
function colocarHistorialHorarios(idSala,fechaconsu,fechaconsuFinal,folioCita,doctorName,pacienteName)
{
    $.ajax({
        url: 'http://localhost/CDI/Panel/index.php/CrudPacienteEspera/traerHorariosCambios/'+idSala+"/"+fechaconsu+"/"+fechaconsuFinal+"/"+folioCita+"/"+doctorName+"/"+pacienteName,
        dataType: 'JSON',
        success: function (data) {
            if (data.length>0) {
                //console.table(data)
                for (var i = 0; i < data.length; i++) {
                    if (data[i]['validez'] == 1)
                        $("#valor" + data[i]['status'] + "Radio" + data[i]['idCita']).parent().children("span").html(data[i]['hora']);
                    else
                        $("#valor" + data[i]['status'] + "Radio" + data[i]['idCita']).parent().children("span").html('');
                }
            }
            else
            {
                $("input[type='radio']").parent().children("span").html('');
            }
        },complete: function () {
            validacionPermisos();
        }


    });
}
function compruebaExis(idCita)
{
    var idCita=idCita;
    var idUser=$("#idUser").val();
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/CrudPacienteEspera/comprobarExiste/"+idCita,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            if (data!=null)
            {
                // alert("existe")
                eliminarRegistro(idCita);
            }else{
                //alert("No existe")
                insertarEntrega(idCita,idUser);
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

function insertarEntrega(idCita,idUser)
{
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/CrudPacienteEspera/insertardatos/"+idCita+"/"+idUser,
        type: "POST",
        dataType: "html",
        success: function(data)
        {
            //alert("echo")
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

function eliminarRegistro(idCita)
{

    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/CrudPacienteEspera/deleteCita/"+idCita,
        type: "POST",
        dataType: "html",
        success: function(data)
        {
            //  alert("echo")
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

function getlistadoTodos ()
{
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/CrudPacienteEspera/traeListaTodoEntrega/",
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if(data.length > 0)
            {
                for(i=0; i<data.length; i++)
                {
                    var idCita = data[i]["idCita"];

                    $("#listado").append('<tr><form><td>'+(i+1)+'</td><td>'+data[i]["nombrePaci"]+'</td><td>'+data[i]["nombreEstudio"]+'</td><td>'+data[i]['nombre']+'</td><td>'+data[i]["precio"]+'</td><td>'+data[i]["nombreDoc"]+'</td><td><input type="radio" onClick="cambiarStatusProceso(3, '+idCita+')"></td><td><input type="radio" onClick="cambiarStatusProceso(4, '+idCita+')"></td></form></tr>');
                    getCheck(idCita)
                }
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}

function cambiarStatusProceso(statusProceso, idCita)
{
    var parametros={
        "statusProceso" : statusProceso,
        "idCita" : idCita}
    // alert(statusProceso+" - "+idCita)
    $.ajax({
        url: "http://localhost/CDI/Panel/index.php/CrudPacienteEspera/cambiarStatusProcesoOr/",
        type: "POST",
        data:parametros,
        dataType: "html",
        complete: function () {
            var idSala=$("#areaSele").val();
            var fechaconsu=$("#fechaconsu").val();
            var fechaconsuFinal=$("#fechaconsuFinal").val();
            var doctorName=$("#doctorName").val();
            var pacienteName=$("#pacienteName").val();
            var folioCita=$("#folioCitaFiltro").val();
            if(!idSala.length>0)
            {
                idSala="0";
            }
            if(!fechaconsu.length>0)
            {
                fechaconsu="0";
            }
            if(!fechaconsuFinal.length>0)
            {
                fechaconsuFinal="0";
            }
            if(!doctorName.length>0)
            {
                doctorName="0";
            }
            if(!pacienteName.length>0)
            {
                pacienteName="0";
            }
            if(!folioCita.length>0)
            {
                folioCita="0";
            }
            colocarHistorialHorarios(idSala,fechaconsu,fechaconsuFinal,folioCita,doctorName,pacienteName);
        }
    });
}
function getCheck(idCita)
{
    //alert(idCita)
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/CrudPacienteEspera/comprobarExiste/"+idCita,
        type: "POST",
        dataType: "json",
        success: function(data)
        {

            if (data!="")
            {
                //alert(data.idCita)
                var x = document.getElementById("cr"+data.idCita);
                x.checked = true;
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });

}
function mandarInterpretacion(idCita)
{
    $.ajax({
        url: 'http://localhost/CDI/Panel/index.php/CrudPacienteEspera/mandarCitaInterpretacion/'+idCita,
    });
}