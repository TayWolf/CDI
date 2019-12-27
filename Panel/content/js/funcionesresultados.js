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
    var direccion="http://localhost/CDI/Panel/index.php/Crudestudiosporsala/traeListaEntrega/"+idSala+"/"+fechaconsu+"/"+fechaconsuFinal+"/"+folioCita+"/"+doctorName+"/"+pacienteName.replace(" ", "%20");

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
                    var idCita = data[i]["idCita"];
                    var folioCita = data[i]["folioCita"];
                    var prioridadEstudio="";
                    var prioridad=data[i]["prioridad"];

                    var enInterpretacion=(data[i]['interpretacion']==1)?"checked":"";
                    var enElaborado=(data[i]['elaborado']==1)?"checked":"";
                    var enEntrega=(data[i]['entrega']==1)?"checked":"";

                    var statusPago=data[i]["statusPago"];
                    if(statusPago==0)
                    {
                        statusPago="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: white; width: 100%; font-size:13; padding: 0px; background: #5F5A5A;\">ADEUDO</button>";
                    }
                    else if(statusPago==1)
                    {
                        statusPago="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: black; width: 100%; padding: 0px; background: #0AD50A;\">PAGADO</button>";
                    }
                    else if(statusPago==2)
                    {
                        statusPago="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: white; width: 100%; padding: 0px; background: #5F5A5A;\">ADEUDO</button>";
                    }
                    else if(statusPago==4)
                    {
                        statusPago="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: white; width: 100%; padding: 0px; background: #4B5BF8;\">CORTESÍA</button>";
                    }

                    if(prioridad==1||prioridad==0||!prioridad)//cambiarStatusCita("+prioridad+", "+idCita+")
                    {
                        prioridadEstudio="<button id='button"+idCita+"' onClick='verificarContraPrioridad("+prioridad+", "+idCita+")' class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: white; width: 100%; padding: 0px; background: rgb(76, 175, 80);\">Normal</button>";
                    }
                    else if(prioridad==2)
                    {
                        prioridadEstudio="<button id='button"+idCita+"' onClick='verificarContraPrioridad("+prioridad+", "+idCita+")' class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: black; width: 100%; padding: 0px; background: rgb(255, 235, 59);\">Entregar hoy</button>";
                    }
                    else if(prioridad==3)
                    {
                        prioridadEstudio="<button id='button"+idCita+"' onClick='verificarContraPrioridad("+prioridad+", "+idCita+")' class=\"btn btn-secondary btn-lg\" type=\"button\" style=\"color: white; width: 100%; padding: 0px; background: #D61D21;\">Urgente!</button>";
                    }

                    var tipoTT=data[i]["tipo"];

                    var obserPaci=data[i]['observacionesPaciente'];
                    if (obserPaci==null)
                    {
                        obserPaci="";
                    }

                    $("#listado").append('<tr><td style="display: none">'+idCita+'</td><td>'+(folioCita)+'</td>'+
                        '<td>'+data[i]["nombrePaci"]+'</td>'+
                        '<td>'+data[i]["nombreEstudio"]+'</td>'+
                        '<td><input onchange="verificarContra('+idCita+', 1)" '+enInterpretacion+' type="checkbox" id="cr'+idCita+'" name ="cr'+idCita+'" class="filled-in" value="Si" ><label for="cr'+idCita+'" style="margin-bottom: 0px;height: 15px;"></label></td>'+
                        '<td><input onchange="compruebaExis('+idCita+', 3)" '+enElaborado+' type="checkbox" id="elaborado'+idCita+'" name="elaborado'+idCita+'"  class="filled-in"><label for="elaborado'+idCita+'" style="margin-bottom: 0px;height: 15px;"></label></td>'+
                        '<td><input onclick="compruebaExis('+idCita+',2)" '+enEntrega+' type="checkbox" id="int'+idCita+'" name ="int'+idCita+'" class="filled-in"  ><label for="int'+idCita+'" style="margin-bottom: 0px;height: 15px;"></label></td>'+
                        '<td>'+prioridadEstudio+'</td>'+
                        '<td>'+statusPago+'</td>'+
                        '<td id="respon'+idCita+'"></td>'+
                        '<td>'+((data[i]['recibeEstudio'])?data[i]['recibeEstudio']:"")+'</td>'+
                        '<td>'+data[i]["nombreDoc"]+'</td>'+
                        '<td>'+data[i]['nombre']+'</td>'+
                        '<td>'+data[i]['nombreCliente']+'</td>'+
                        '<td>'+obserPaci+'</td>'+
                        '<td>'+data[i]['horarioCita']+'</td>'+
                        '</tr>');

                    $('#example').Tabledit({
                        url: 'http://localhost/CDI/Panel/index.php/Crudestudiosporsala/editarNombreQuienRecibe',
                        deleteButton: false,
                        saveButton: false,
                        autoFocus: false,
                        editButton: false,
                        columns: {
                            identifier: [0, 'idCita'],
                            editable: [[10, 'nombreRecibe']]
                        }
                    });
                    //$("#example").tabled
                    //Se comentó esta función porque manda muchas peticiones AJAX al controlador y alenta la carga del módulo
//                    checkBoxSegundo(idCita)
                }
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(textStatus+"\n"+ errorThrown);
        }
    });

}
/*

function checkBoxSegundo(idCita)
{
    var dos =2;
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/comprobarExiste/"+idCita+"/"+dos,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            //alert(data.idCita)
            if (data==null)
            {

            }else{
                $("#int"+idCita).attr("checked","checked");
                $("#respon"+idCita).html(data.nombreUser);
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
    var Uno=1;
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/comprobarExiste/"+idCita+"/"+Uno,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            ///alert(data.idCita)
            if (data==null)
            {

            }else{
                $("#cr"+idCita).attr("checked","checked");
                $("#respon"+idCita).append(data.nombreUser);
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
    $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/comprobarExiste/"+idCita+"/"+3,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                ///alert(data.idCita)
                if (data==null)
                {

                }else{
                    $("#elaborado"+idCita).attr("checked","checked");

                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
}
*/


function verificarContra(idCita, tip)
{
    if( $('#cr'+idCita).is(':checked') ) {
        compruebaExis(idCita,tip)
    }else{
        $("#cr"+idCita).prop("checked", true);
        swal({
            title: "Autorización",
            text: "Ingrese contraseña de un administrador",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            inputPlaceholder: "Password"
        }, function (inputValue) {
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("Por favor ingrese contraseña.");
                return false
            }
            var parametros={
                "password" : inputValue}
            $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/getContras/",
                type: "POST",
                data:parametros,
                dataType: "JSON",
                success: function(data)
                {
                    if (data.length>0)
                    {
                        for (i=0; i< data.length; i++) {data[i]['Razonsocial']
                            swal("Autorizado", "acción realizada " , "success");
                            $("#cr"+idCita).prop("checked", false);
                            compruebaExis(idCita,tip);
                        }
                    }else{
                        swal("ERROR", "Contraseña incorrecta", "error")
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
        });
    }
}

function verificarContraPrioridad(priorid,idCita)
{
    swal({
        title: "Autorización",
        text: "Ingrese contraseña de un administrador",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        inputPlaceholder: "Password"
    }, function (inputValue) {
        if (inputValue === false) return false;
        if (inputValue === "") {
            swal.showInputError("Por favor ingrese contraseña.");
            return false
        }
        var parametros={
            "password" : inputValue}
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/getContras/",
            type: "POST",
            data:parametros,
            dataType: "JSON",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i=0; i< data.length; i++) {data[i]['Razonsocial']
                        swal("Autorizado", "acción realizada " , "success");
                        cambiarStatusCita(priorid, idCita)
                    }
                }else{
                    swal("ERROR", "Contraseña incorrecta", "error")
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    });
}

function compruebaExis(idCita,tip)
{
    var valor=0;
    //interpretacion
    if(tip==1)
    {
        valor=($("#cr"+idCita).prop("checked"))?1:0;
    }
    //entrega
    else if(tip==2)
    {
        valor=($("#int"+idCita).prop("checked"))?1:0;
    }
    //elaborado
    else if(tip==3)
    {
        valor=($("#elaborado"+idCita).prop("checked"))?1:0;
    }
    $.ajax({
        url: "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/cambiarStatusEntregaResultado/"+idCita+"/"+tip+"/"+valor
    });

}

function insertarEntrega(idCita,idUser,tip)
{
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/insertardatos/"+idCita+"/"+idUser+"/"+tip,
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

function eliminarRegistro(idCita,tip)
{

    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/deleteCita/"+idCita+"/"+tip,
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
        url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/traeListaTodoEntrega/",
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if(data.length > 0)
            {
                for(i=0; i<data.length; i++)
                {
                    var idCita = data[i]["idCita"];
                    var prioridadEstudio="";
                    var prioridad=data[i]["prioridad"];
                    var statusPago=data[i]["statusPago"];
                    if(statusPago==0)
                    {
                        statusPago="Adeudo";
                    }
                    else if(statusPago==1)
                    {
                        statusPago="Pagado";
                    }
                    if(prioridad==1||prioridad==0||!prioridad)
                    {
                        prioridadEstudio="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\" background: rgb(76, 175, 80);\" value='Normal ("+statusPago+")'></button>";
                    }
                    else if(prioridad==2)
                    {
                        prioridadEstudio="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\" background: rgb(255, 235, 59);\" value='Entrega el mismo día ("+statusPago+")'></button>";
                    }
                    else if(prioridad==3)
                    {
                        prioridadEstudio="<button class=\"btn btn-secondary btn-lg\" type=\"button\" style=\" background: rgb(253, 11, 19);\" value='Urgente! ("+statusPago+")'></button>";
                    }

                    $("#listado").append('<tr><td>'+(i+1)+'</td><td>'+data[i]["nombrePaci"]+'</td><td>'+data[i]["nombreEstudio"]+'</td><td>'+data[i]['nombre']+'</td><td>'+data[i]["precio"]+'</td><td>'+data[i]["nombreDoc"]+'</td><td><input onclick="compruebaExis('+idCita+',1)" type="checkbox" id="cr'+idCita+'" name ="cr'+idCita+'" class="filled-in" value="Si"><label for="cr'+idCita+'"></label></td><td><input  type="checkbox" id="entrega'+idCita+'" name ="entrega'+idCita+'" class="filled-in" value="Si"><label for="entrega'+idCita+'"></label></td><td>'+prioridadEstudio+'</td></tr>');
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

function getCheck(idCita)
{
    //alert(idCita)
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/comprobarExiste/"+idCita,
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
function cambiarStatusCita(prioridad, idCita)
{
    var priorOrigina=prioridad;
    prioridad++;

    var prioridadEstudio="";
    var colorLetraEstudio='#FFFFFF';
    var texto="";
    if(prioridad>3)
        prioridad=1;
    $.ajax(
        {
            url: 'http://localhost/CDI/Panel/index.php/Crudestudiosporsala/cambiarPrioridadEstudio/'+idCita+'/'+prioridad,
            contentType: false,
            processData: false,
            dataType: 'HTML'
        }
    );
    if(prioridad==1||prioridad==0||!prioridad)
    {
        texto="Normal";
        prioridadEstudio='#4CAF50';
    }
    else if(prioridad==2)
    {
        texto="Entregar hoy";
        colorLetraEstudio='#000000';
        prioridadEstudio='#FFEB3B';
    }
    else
    {
        texto="Urgente!";
        prioridadEstudio='#FD0B13';
    }
    $("#button"+idCita).text(texto);
    $("#button"+idCita).css('color', colorLetraEstudio);
    $("#button"+idCita).css('background', prioridadEstudio);
    $("#button"+idCita).attr("onclick","cambiarStatusCita("+prioridad+", "+idCita+")");

    //   $.ajax(
    //     {
    //         url: 'http://localhost/CDI/Panel/index.php/Crudcitas/EditaCita/'+idCita+'/'+prioridad,
    //         contentType: false,
    //         processData: false,
    //         dataType: 'HTML'
    //     }
    // );


}