function traerCitas()
{
	var idSa=$("#Salas").val();
	var fech=$("#fechamodal").val();
  if (fech == "") {
    fech = $("#fecha").val();
  }
  var estudio = $("#Estud").val();
	if (fech!="" )
	 {
	$("#listado").html("");
		$.ajax({
	        url : "http://localhost/CDI/Panel/index.php/Crudcitas/traerLista/"+fech,
	        type: "post",
	        dataType: "JSON",
	        success: function(data)
	        {
	           if (data.length>0)
	            {
	            	  //var ii=1;
	            	for(i=0; i<data.length; i++)
	            	{
                  if (data[i]['urgencia'] == 1) {
                    urgencia = "SI";
                  }else{
                    urgencia = "NO";
                  }
	            		var salidasala = data[i]['horarioCita']
	            		$("#listado").append('<tr>'+
                                                    '<th scope="row">1</th>'+
                                                    '<td>'+data[i]['nombrePaci']+'</td>'+
                                                    '<td>'+data[i]['nombre']+'</td>'+
                                                    '<td>'+data[i]['nombreEstudio']+'</td>'+
                                                    '<td >'+data[i]['fechaCita']+'</td>'+
                                                    '<td onclick="pruebaModific('+i+')">'+data[i]['horarioCita']+'</td>'+
                                                    '<td>'+data[i]['horaTerminada']+'</td>'+
                                                    '<td>'+data[i]['nombreUser']+'</td>'+
                                                    '<td>'+urgencia+'</td>'+
                                                    '<td><a onClick="verificarContraPrioridad('+idCita+')" >Cancelar</a></td>'+
                                                '</tr>');

	            		// calcT3(data[i]['idCita'],data[i]['duracion'],data[i]['horarioCita'])
                  //ii++;
	            	}


	            }else{
                $("#listado").append('<td colspan="9" align="center" style="padding-top: 20px;">NO HAY CITAS PROGAMADAS</td>');
              }
              $('#citasAldia').Tabledit({
                      url: 'Crudcitas/modificarDatostablaarray/',
                      editButton: false,
                      deleteButton:false,
                      columns: {
                          identifier: [0, 'idCita'],
                          editable: [[4, 'fechaCt'],[5, 'houraC']]
                      }
                    });
               $("input[name*='fechaCt']").attr("type",'date');
               $("input[name*='houraC']").attr("type",'time');

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}
}

function verificaContraPrioridad(idCita)
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
              url : "http://localhost/CDI/Panel/index.php/Crudcitas/getContra/",
              type: "POST",
              data:parametros,
              dataType: "JSON",
              success: function(data)
             {
                if (data.length>0)
                    {
                      for (i=0; i< data.length; i++) {data[i]['Razonsocial']
                        swal("Autorizado", "acción realizada " , "success");
                        cancelarCita(idCita);
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

function cancelarCita(idC)
{
  swal({
      title: "AVISO",
      text: "Estas seguro de cancelar la cita",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Si deseo cancelar",
      closeOnConfirm: false
    },
    function(){
      $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcitas/cancelarCita/"+idC,
        dataType:"html",
        success:function(data) {
              swal({
                title: "HECHO",
                text: "Cita cancelada.",
                type: "success",
               
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ACEPTAR",
               
              },
              function(){
                swal.close()
                //$("#listado").html("");
                //traerDi();
              });
            }    
        });
    });
}
			function padNmb(nStr, nLen) {
                var sRes = String(nStr);
                var sCeros = "0000000000";
                return sCeros.substr(0, nLen - sRes.length) + sRes;
            }
 
            function stringToSeconds(tiempo) {
                var sep1 = tiempo.indexOf(":");
                var sep2 = tiempo.lastIndexOf(":");
                var hor = tiempo.substr(0, sep1);
                var min = tiempo.substr(sep1 + 1, sep2 - sep1 - 1);
                var sec = tiempo.substr(sep2 + 1);
                return (Number(sec) + (Number(min) * 60) + (Number(hor) * 3600));
            }

			function secondsToTime(secs) {
                var hor = Math.floor(secs / 3600);
                var min = Math.floor((secs - (hor * 3600)) / 60);
                var sec = secs - (hor * 3600) - (min * 60);
                return padNmb(hor, 2) + ":" + padNmb(min, 2) + ":" + padNmb(sec, 2);
            }

			function substractTimes(t1, t2) {
                var secs1 = stringToSeconds(t1);
                var secs2 = stringToSeconds(t2);
                var secsDif = secs1 + secs2;
                return secondsToTime(secsDif);
            }

 			function calcT3() {
 				//alert(dura+" "+horario)
                // var idCita=idCita;
                var dura1=$("#inputduracion").val();
                var	horario1=$("#horacita").val();
                var horario=horario1+":00";
                var dura = dura1+":00";
              //  alert("dura1 "+dura1+" horario1 "+horario1)
                   var t3 = substractTimes(dura, horario);
                 // alert("dura1 "+dura1+" horario1 "+horario1+" horario "+horario+" dura "+dura)
                 //alert("dura " + dura + " horario"+horario)
                  $("#horatotal").append(t3);
                  
                   $("#HoraTerminada").val(t3);
                   $("#horainicio").val(horario1);
                   $("#horatermino").val(t3);
                   //horaDisponible(horario,t3);
            }


 $(function(){
  $("#form").on("submit", function(e){ 
        e.preventDefault();
         //$('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
         var page = $(this).attr('data');        
        var dataString = 'page='+page;
        var formData = new FormData(document.getElementById("form"));
        var horacita = $("#horainicio").val();
        if (horacita != "") {
          var horasrecorridas = $("#idCitarecorrida").val();
          if (horasrecorridas != "") {
            
              recorrehorasxid();
            }
           $.ajax({
                  url : "http://localhost/CDI/Panel/index.php/Crudcitas/agregacita/",
                  type: "post",
                  data: formData,
                  dataType: "HTML",
                  cache: false,
                  contentType: false,
                   processData: false,
                  success: function(data)
                  {
                    getEstudiosRealizados();
                    //swal("Éxito", "Estudio agregado", "success")
                    $("#nombreEstudio").val('');
                    $("#Estud").val('');
                     $("#autorizaBoton").show();
                      // swal({
                      //   title: "Éxito",
                      //   text: "Cita agendada correctamente.",
                      //   type: "success",
                       
                      //   confirmButtonClass: "btn-danger",
                      //   confirmButtonText: "Aceptar",
                        
                      // },
                      // function(){
                      //   location.href='http://localhost/CDI/Panel/index.php/Crudcitas/';
                      // });
                     
                  }

          });          
      }else{
        swal("Espera...", "Debes seleccionar una hora de inicio, por favor haz clic en el botón de 'Ver disponibilidad' ", "warning")
      }

 });
   });

 function finalizarCita()
 {
  swal({
                        title: "Éxito",
                        text: "Cita agendada correctamente.",
                        type: "success",
                       
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",
                        
                      },
                      function(){
                        location.href='http://localhost/CDI/Panel/index.php/Crudcitas/';
                      });
 }

 function quitarCita(idC)
 {

 $.ajax({
        url:"http://localhost/CDI/Panel/index.php/Crudcitas/QuitarCi/"+idC,
        dataType:"html",
        success:function(data) {
              getEstudiosRealizados();
            }    
        });

 }

var arregloJson; 

 function recorrehorasxid(){

  // arregloJson=JSON.stringify(array);
  // arre = JSON.parse(arregloJson);

  //alert("entra nueva funcion");
  // var idcita = id;
  var fechaurgencia = $("#fecha").val();
  var estudiourgencia = $("#Estud").val();
  var salaurgencia = $("#Salas").val();

  var horanuevoinicio = $("#horatermino").val();
  var duracion = $("#valorDuracionEstudio").val();
  var res = horanuevoinicio.replace(/:/g, ",");
  var array = res.split(",").map(Number);
    horadiv = new Date();
    horadiv.setHours(array[0],array[1],array[2]);
    // alert("la nueva hora de inicio para el  es: "+horadiv);
    horadi = horadiv.getHours(); 
    minutodiv = horadiv.getMinutes();

  var horabaseinicio = $("#horainicio").val();
  var quita = horabaseinicio.replace(/:/g, ",");
  var arrayi = quita.split(",").map(Number);
    horaBase = new Date();
    horaBase.setHours(arrayi[0],arrayi[1],arrayi[2]);
    // alert("la nueva hora de inicio para el  es: "+horaBase);
    horadi = horaBase.getHours(); 
    minutodiv = horaBase.getMinutes();

  var separa = duracion.replace(":", ",");
  var arrayduracion = separa.split(",").map(Number);
    tiempoduracion = new Date();
    tiempoduracion.setHours(arrayduracion[0],arrayduracion[1]);
    horadur = tiempoduracion.getHours(); 
    minutodur = tiempoduracion.getMinutes();
    var minutostotalduracion = (parseInt(horadur)*60) + parseInt(minutodur);
    // alert("el estudio dura: "+minutostotalduracion);

    var total = $("#idCitarecorrida").val();
      for (i = 1; i <= total; i++) {
        var idcita =$("#idcita"+i).val();
         if( $('#idcita'+i).length )         // use this if you are using class to check
          {
            // alert(conteo);
            horadiv.setMinutes(horadiv.getMinutes() + minutostotalduracion);
            var horanuevofinal = horadiv.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit', second:'2-digit'});            
            horaBase.setMinutes(horaBase.getMinutes() + minutostotalduracion);
            var horanuevaBase = horaBase.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit', second:'2-digit'});

           


            $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudcitas/EditaCita/"+idcita+"/"+horanuevaBase+"/"+horanuevofinal,
                type: "POST",
                dataType: "html",
                success: function(data)
                {
                   // alert(data);
                   if (data == 1) {
                    //swal("Cita modificada", "La cita con id "+idcita+" cambio de horario, comenzará a las "+horanuevaBase+" y terminará a las: "+horanuevofinal+" ","warning");
                   }
                   
                }
            });
          }
      }
 }
