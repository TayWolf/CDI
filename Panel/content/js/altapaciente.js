$(function(){
    $("#formaltaPac").on("submit", function(e){
        e.preventDefault();
        // asignaClave();
        var nombreN=$("#nombre").val();
        $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
        var page = $(this).attr('data');
        var dataString = 'page='+page;
        var formData = new FormData(document.getElementById("formaltaPac"));
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
                //alert(data);
                var URLactual = window.location;
                if (URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas#" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas/") {
                    $("#myModalAlta").modal('hide');
                    $("#idPaciente").val(data);
                    $("#paciente").val(nombreN);
                }else{
                    $('#cargando').fadeIn(1000).html(data);
                    location.href='http://localhost/CDI/Panel/index.php/Crudpacientes';
                }
            }
        });
        //AQUI TIENES QUE RESETEAR LOS CAMPOS
        $("#nombre").val("");
        $("#genero").val("");
        $("#correo").val("");
        $("#telefono").val("");
        $("#fechanacimiento").val("");
        $("#edad").val("");
        $("#medicoremitente").val("");
        $("#cliente").val("");

    });
});
//window.onload = asignaClave();
function asignaClave() {

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
            $("#clave").attr("readonly","");
            //alert(clave)
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}

function isValidDate(day,month,year)
{
    var dteDate;

    // En javascript, el mes empieza en la posicion 0 y termina en la 11 
    //   siendo 0 el mes de enero
    // Por esta razon, tenemos que restar 1 al mes
    month=month-1;
    // Establecemos un objeto Data con los valore recibidos
    // Los parametros son: año, mes, dia, hora, minuto y segundos
    // getDate(); devuelve el dia como un entero entre 1 y 31
    // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,
    //   martes, miercoles ...
    // getHours(); Devuelve la hora
    // getMinutes(); Devuelve los minutos
    // getMonth(); devuelve el mes como un numero de 0 a 11
    // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1
    //   de enero de 1970 hasta el momento definido en el objeto date
    // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.
    // getYear(); devuelve el año
    // getFullYear(); devuelve el año
    dteDate=new Date(year,month,day);

    //Devuelva true o false...
    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}

function validate_fecha(fecha)
{
    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");

    if(fecha.search(patron)==0)
    {
        var values=fecha.split("-");
        if(isValidDate(values[2],values[1],values[0]))
        {
            return true;
        }
    }
    return false;
}

function calcularEdad()
{
    var fecha=$("#fechanaci").val();
    if(validate_fecha(fecha)==true)
    {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];

        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth();
        var ahora_dia = fecha_hoy.getDate();

        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < (mes - 1))
        {
            edad--;
        }
        if (((mes - 1) == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }

        $("#edad").val(edad);
        $("#edad-paciente").val(edad);
        $("#linea").addClass( "focused" );
        $("#edad").prop('disabled', true);
    }else{
        $("#edad").val("La fecha "+fecha+" es incorrecta");
    }
}

//window.onload = prueba();
function prueba() {

    var fActa=$("#fechaAct").val();
    var idUser=$("#idUser").val();
    //alert(idUser)
    var URLactual = window.location;
    // alert(URLactual)
    //alert("entr"+URLactual)
    if (URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas#" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas/" || URLactual == "http://localhost/CDI/Panel/index.php/Crudcitas/#" || URLactual=="http://localhost/CDI/Panel/index.php/Crudcitas/indexbajo" || URLactual=="http://localhost/CDI/Panel/index.php/Crudcitas/indexbajo#") {

        $("#listadocitasProx").html("");
        var rightNow = new Date();
        var res = rightNow.toISOString().slice(0,10).replace(/-/g,"-");
        // alert(rightNow);
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcitas/traerListaTodoCitas/"+fActa,
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
                        //alert(data[i]['statusProceso'])

                        var statusProceso=data[i]['statusProceso'];
                        //alert(statusProceso)
                        if (statusProceso==1)
                        {
                            var check="checked";
                            var valorSta=0;
                            var disabled="";
                        }else  if (statusProceso==0){
                            var check="";
                            var valorSta=1;
                            var disabled="";
                        }else{
                            var check="checked";
                            var valorSta=statusProceso;
                            var disabled="disabled";
                        }
                        //alert()
                        var res = srt.replace(/-/g, "");
                        var salidasala = data[i]['horarioCita']

                        $("#listadocitasProx").append('<tr class="'+clas+'">'+

                            '<td style="display:none;">'+data[i]['idCita']+'</td>'+
                            '<td>'+data[i]['nombreUser']+'  <input type="hidden" name="fechOculto'+data[i]['idPaciente']+'" id="fechOculto'+data[i]['idPaciente']+'" value="'+data[i]['fechaCita']+'"></td>'+
                            '<td >'+data[i]['folioCita']+'</td>'+

                            '<td onclick="abrirPotHora('+data[i]['idCita']+');pruebaModific('+i+')" >'+data[i]['horarioCita']+'</td>'+

                            '<td  style="text-align: center;"><input  type="checkbox" onClick="cambiarStatusProceso('+valorSta+', '+data[i]['idCita']+','+data[i]['folioCita']+')"  id="llego'+data[i]['idCita']+'" name ="llego'+data[i]['idCita']+'" class="filled-in" value="'+valorSta+'" '+check+' '+disabled+'><label style="margin-bottom: 0px;height: 15px;" for="llego'+data[i]['idCita']+'"></label></td>'+

                            '<td ><a style="cursor: pointer;" onclick="GetTdodoEstudio('+data[i]['idPaciente']+','+data[i]['folioCita']+','+idUser+')">Imprimir</a></td>'+
                            '<td style="'+fuent+'" id="horaLL'+data[i]['idCita']+'">'+Horal+'</td>'+

                            //'<td scope="row">'+data[i]['orden_medica']+'</td>'+
                            '<td><a style="cursor: pointer;" onclick="GetTdodoEstudio('+data[i]['idPaciente']+','+data[i]['folioCita']+','+idUser+')">'+data[i]['nombrePaci']+'</a></td>'+
                            '<td>'+data[i]['nombreEstudio']+'</td>'+
                            '<td>'+data[i]['observacionesPaciente']+'</td>'+
                            '<td>'+data[i]['nombreCliente']+'</td>'+
                            '<td>'+data[i]['nombreRem']+'</td>'+
                            //'<td>'+data[i]['nombre']+'</td>'+
                            //'<td>'+data[i]['nombreEstudio']+'</td>'+
                            //'<td onchange="abrirPot('+data[i]['idCita']+','+i+')">'+data[i]['fechaCita']+'</td>'+

                            //'<td>'+data[i]['horaTerminada']+'</td>'+

                            '<td class="'+classs+'"><a onclick="cancelarCita('+data[i]['idCita']+')">CANCELAR</a></td>'+
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
                        editable: [[3, 'horaCit']]
                    }
                });
                $("input[name*='horaLlega']").attr("type",'time');
                $("input[name*='fechaC']").attr("type",'date');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
}

function cambiarStatusProceso(statusProceso, idCita, folio)
{


    var inpuCi=$("#llego"+idCita).val();
    if($("#llego"+idCita).prop("checked"))
        statusProceso=1;
    else
        statusProceso=0;
    $("#horaLL"+idCita).html('');
    if (statusProceso=="0")
    {
        var HoraActual="00:00:00";
        var fecActual="0000-00-00";
    }
    if (statusProceso=="1")
    {
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();

        dd = addZero(dd);
        mm = addZero(mm);
        var fecActual =yyyy+'-'+mm+'-'+dd;
        var d = new Date();
        var HoraActual=d.getHours()+':'+d.getMinutes()+':00';

    }
    var parametros={
        "statusProceso" : statusProceso,
        "idCita" : idCita,
        "fecActual" : fecActual,
        "folio" : folio,
        "HoraActual" : HoraActual}
    $.ajax({
        url: "http://localhost/CDI/Panel/index.php/CrudPacienteEspera/cambiarStatusProceso/",
        type: "POST",
        data:parametros,
        dataType: "html",
        success: function(data)
        {
            if (HoraActual=="00:00:00")
            {
                HoraActual="Hora de llegada";
            }
            $("#horaLL"+idCita).append(HoraActual);
        }
    });
}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}
function abrirPot(idCi,i){
    var fec=$("#fechaC"+i).val();
    // alert("fechaC"+i)
    var myWindow = window.open("http://localhost/CDI/Panel/index.php/Crudcitas/PoputEdit/"+idCi+"/"+fec, "", "width=1198,height=1191");
}
function abrirPotHora(idCi){
    // alert("fechaC"+i)
    var myWindow = window.open("http://localhost/CDI/Panel/index.php/Crudcitas/PoputEditHours/"+idCi, "", "width=1198,height=1191");
}
function GetTdodoEstudio(idPac,folio,idUs)
{

    var idPac=idPac;
    var fecha=$("#fechOculto"+idPac).val();

    swal({
            title: "¿Está seguro de imprimir pase a sala del paciente?",
            text: "Se registrara como paciente en recepción",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Acepto",
            closeOnConfirm: false
        },
        function(){
            var URL="http://localhost/CDI/Panel/Citapdf.php?idPa="+idPac+"&fecha="+fecha+"&idFolio="+folio+"&idU="+idUs;
            window.open(URL,"ventana1","width=740 ,height=640,scrollbars=NO")
            prueba()
            swal.close()
        });



}

function traerCliente(idP)
{
    var id=idP;
    $("#muestraselectCliente"+id).show();
    $("#selectCliente"+id).show();
    $("#nombreCliente"+id).hide();
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpacientes/traerClie/",
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            $("#selectCliente"+id).append('<option value="">Seleccione un cliente</option>');
            if (data.length>0)
            {
                for (i=0; i<data.length; i++)
                {
                    $("#selectCliente"+id).append(new Option(data[i]['nombreCliente'],data[i]['idCliente']));
                }
                var ident=$("#ident"+id).val();
                $("#selectCliente"+id).val(ident);
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function modificarDatosClien(id){

    var id = id;
    var idClie = $("#selectCliente"+id).val();

    // alert (idcolonia);
    var parametros = {"idCliente":idClie,"id":id}
    //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpacientes/editaCliente/",
        type: "post",
        data: parametros,
        dataType: "HTML",
        success: function(data)
        {
            //    alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            // alert('ERROR AL GUARDAR ESTADO');
        }
    });
}

function modificarDatosRemite(id){

    var id = id;
    var idRemi = $("#selectRemite"+id).val();

    // alert (idcolonia);
    var parametros = {"idRemi":idRemi,"id":id}
    //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpacientes/editaRemite/",
        type: "post",
        data: parametros,
        dataType: "HTML",
        success: function(data)
        {
            //    alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            // alert('ERROR AL GUARDAR ESTADO');
        }
    });
}

function traerRemite(idP)
{
    var id=idP;
    $("#muestraselectRemite"+id).show();
    $("#selectRemite"+id).show();
    $("#nombreRemite"+id).hide();
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpacientes/traerRemite/",
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            $("#selectRemite"+id).append('<option value="">Seleccione un Remitente</option>');
            if (data.length>0)
            {
                for (i=0; i<data.length; i++)
                {
                    $("#selectRemite"+id).append(new Option(data[i]['nombreRem'],data[i]['idRemitente']));
                }
                var ident=$("#identDos"+id).val();
                $("#selectRemite"+id).val(ident);
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function modificarDatosClien(id){

    var id = id;
    var idClie = $("#selectCliente"+id).val();

    // alert (idcolonia);
    var parametros = {"idCliente":idClie,"id":id}
    //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpacientes/editaCliente/",
        type: "post",
        data: parametros,
        dataType: "HTML",
        success: function(data)
        {
            //    alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            // alert('ERROR AL GUARDAR ESTADO');
        }
    });
}