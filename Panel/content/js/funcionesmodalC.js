function pintatodashorasModal(idS,idE,Fec) {
  //alert(Fec)
 

  $("#contenidoDispone").html("");
    momentoActual = new Date();
    
    momentoActual.setHours(0,0);
    hora = momentoActual.getHours(); 
    minuto = momentoActual.getMinutes();
    horaImprimible = hora + " : " + minuto;
  for (var i = 8; i <= 19; i++) {
    horasuma = parseInt(hora) + parseInt(i);
    $("#contenidoDispone").append('<tr id="minutosModal'+i+'"><th class="disponible" id="botonhoraModal'+horasuma+'">'+horasuma+':00</th></tr>');
        despliegaminutosModa(horasuma,minuto,i,idS,idE,Fec);
  }
}

function despliegaminutosModa(hora,min,i,idS,idE,Fec) {
  
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
   $("#minutosModal"+botoni).append('<td id="botonminutoModal'+minutosuma+'-'+hora+'" onclick="asignahoracitaModal('+hora+','+minutosuma+','+idS+','+idE+','+Fec+')" class="tdDisponible desbloc'+hora+'">'+'<div id="divModal'+minutosuma+'-'+hora+'">'+hora+':'+minutosuma+'</div></td>');
   
  }
}


function pruebaModific(i)
{
  var fechaNeu=$("#fechaCt"+i).val();
 //alert(fechaNeu)
 $('#myModalModificHor').modal('show');
}

function asignahoracitaModal(hora,min,idS,idE,Fec) {
  $("#modal-alert").html("");

  var emergencia = $("#emergencia").val();
  if (emergencia == 1) {
    traedisponibilidadModal(idS,idE,Fec);
    //alert("vamos a comprobar el choque de horas");
    validadisponibilidadModal(hora,min);
  }else{
    traedisponibilidadModal(idS,idE,Fec);
    validadisponibilidadModal(hora,min);
  }
}

function traedisponibilidadModal(idS,idE,Fec) {

  $("#duracionEstudio").html("");
  $("#modal-alert").html("");
  $("#modal-alert-div").css("background","#fff");
 
  //var Fec=""+yearC+"-"+MesC+"-"+dayC+"";
  //alert("hasta qui"+Fec)
  var idsala = idS;
  var Estudio = idE;
  if ($("#fechamodal").val() != "") {

    var fecha = Fec;
    $('#myModal').modal('show');
    //$("#visualDisponibilidad").show();
    var duracion = traeduracion(Estudio); // definimos una variable que va a valer lo que traiga la funcion "traeduracion"
    noDisponibles(Estudio,idsala,fecha,duracion);
    $("#duracionEstudio").append('<span>Duración: <b> '+duracion+'</b> hr(s)</span>');
    $("#inputduracion").val(duracion);
  }else{
    var fecha = Fec;
    //alert("entra")
    $("#fechamodal").val(fecha);
    $('#myModal').modal('show');
   // $("#visualDisponibilidad").show();
    var duracion = traeduracion(Estudio); // definimos una variable que va a valer lo que traiga la funcion "traeduracion"
    noDisponibles(Estudio,idsala,fecha,duracion);
    $("#duracionEstudio").append('<span>Duración: <b> '+duracion+'</b> hr(s)</span>');
    $("#inputduracion").val(duracion);
  }
  
}

function validadisponibilidadModal(hora,min) {
  var horazzz = hora;
  var min = min;
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
                // compruebachoque(data[i]['horarioCita'],hora,min);
                
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
                    horaselec.setHours(horazzz,min,0);
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
                        traedisponibilidadModal();
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
                    var horainicio = construyehora.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
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
                    alert("entra")
                    $("#botonhoraModal"+horazzz).css("background", "#ffca00");
                    $("#botonminutoModal"+min+"-"+horazzz+"").css("background", "#ffca00");
                    $("#divModal"+min+"-"+horazzz+"").css("background", "#ffca00");
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
                traedisponibilidadModal();
                $("#modal-alert").html("");
                var Estudio = $("#Estud").val();
                    var duracion = traeduracion(Estudio);
                    var construyehora = new Date();
                    construyehora.setHours(horazzz,min,0);
                    var horainicio = construyehora.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
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
                     //alert(horainicio)
                    $("#modal-alert").append('<span style="background: #e3f1e0; text-align: center;">La cita quedaría agendada a las <b>'+horainicio+'</b> hr(s) y terminaría a las <b id="horatotal"> </b> hr(s)</span><br>');
                    $("#modal-alert-div").css("background","#e3f1e0");
                    if (min == "0") {
                     min = "00";
                    }
                    $("#botonhoraModal"+horazzz).css("background", "#ffca00");
                    $("#botonminutoModal"+min+"-"+horazzz+"").css("background", "#ffca00");
                    $("#divModal"+min+"-"+horazzz+"").css("background", "#ffca00");
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

function deshabilitaBtnsModal(idMed) {
  //alert("datos"+idMed)
  var diaBuscado = $("#idDiainput").val();
    var medicoSolicitado = $("#medico").val();
    // alert("diaBuscado"+diaBuscado+" medicoSolicitado"+medicoSolicitado);
    $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcitas/compruebaDiasLaborales/"+diaBuscado+"/"+idMed,
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