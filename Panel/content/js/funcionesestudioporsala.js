 window.onload = getlistadoTodos;

 function getlistado ()
   {
      $("#listado").html("");
      var idSala=$("#areaSele").val();
      var fechaconsu=$("#fechaconsu").val();
      var fechaconsuFinal=$("#fechaconsuFinal").val();
      var doctorName=$("#doctorName").val();
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
      var direccion="http://localhost/CDI/Panel/index.php/Crudestudiosporsala/traeLista/"+idSala+"/"+fechaconsu+"/"+fechaconsuFinal+"/"+doctorName;

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
                     var observ = data[i]["observacionesPaciente"];
                    if (observ==null)
                     {
                      observ="";
                     }

                    $("#listado").append('<tr><td>'+data[i]["horarioCita"]+'</td><td>'+data[i]["fechaCita"]+'</td><td>'+data[i]["Sala"]+'</td><td>'+data[i]["nombreEstudio"]+'</td><td>'+data[i]["nombrePaci"]+'</td><td>'+data[i]["edadPaci"]+'</td><td>'+observ+'</td><td><input  type="checkbox" id="cr'+idCita+'" name ="cr'+idCita+'" class="filled-in"><label for="cr'+idCita+'"></label></td><td>'+data[i]["nombreDoc"]+'</td><td><input type="checkbox" id="Ate'+idCita+'" name ="Ate'+idCita+'" class="filled-in"><label for="Ate'+idCita+'"></label></td><td>'+data[i]["horaTerminada"]+'</td><td></td><td></td><td>'+data[i]["nombreRem"]+'</td></tr>');
                  getPintarConfirmado(idCita)
                  }
                }
                  
             },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert(textStatus+"\n"+ errorThrown);
              }
          });
      
   }

   function insertaConfirma(idCita)
   {
    $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/insertaDato/"+idCita,
              type: "POST",
              dataType: "html",
              success: function(data)
             {
                                
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
              url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/traeListaTodo/",
              type: "POST",
              dataType: "JSON",
              success: function(data)
             {
                if(data.length > 0)
                {
                  for(i=0; i<data.length; i++)
                  {
                    var idCita = data[i]["idCita"];

                    var observ = data[i]["observacionesPaciente"];
                    if (observ==null)
                     {
                      observ="";
                     }
                    
                    var checkedAtendido = (data[i]["statusProceso"] >= 5) ? "checked" : "";

                    $("#listado").append('<tr><td>'+data[i]["horarioCita"]+'</td><td>'+data[i]["fechaCita"]+'</td><td>'+data[i]["Sala"]+'</td><td>'+data[i]["nombreEstudio"]+'</td><td>'+data[i]["nombrePaci"]+'</td><td>'+data[i]["edadPaci"]+'</td><td>'+observ+'</td><td><input onclick="getConfirmado('+idCita+')"  type="checkbox" id="cr'+idCita+'" name ="cr'+idCita+'" class="filled-in"><label for="cr'+idCita+'"></label></td><td>'+data[i]["nombreDoc"]+'</td><td><input type="checkbox" id="Ate'+idCita+'" name ="Ate'+idCita+'" class="filled-in" '+checkedAtendido+'><label for="Ate'+idCita+'"></label></td><td>'+data[i]["horaTerminada"]+'</td><td></td><td></td><td>'+data[i]["nombreRem"]+'</td></tr>');
                    getPintarConfirmado(idCita)
                    //$("#listado").append('<tr><td>'+data[i]["nombrePaci"]+'</td><td>'+data[i]["nombreEstudio"]+'</td><td>'+data[i]["precio"]+'</td><td>'+data[i]["nombreDoc"]+'</td><td><input type="checkbox" id="cr'+idCita+'" name ="cr'+idCita+'" class="filled-in"><label for="cr'+idCita+'"></label></td><td><input type="checkbox" id="entrega'+idCita+'" name ="entrega'+idCita+'" class="filled-in"><label for="entrega'+idCita+'"></label></td></tr>');
                  }
                }
                  
             },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error adding / update data');
              }
          });
   }

   function getPintarConfirmado(idCita)
   {
      $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/getConfirmadoLista/"+idCita,
              type: "POST",
              dataType: "JSON",
              success: function(data)
             {

                $("#cr"+data.idCita).attr("checked","checked");
                
             },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error adding / update data');
              }
          });
   }

   function getConfirmado(idCita)
   {
      $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/getConfirmadoLista/"+idCita,
              type: "POST",
              dataType: "JSON",
              success: function(data)
             {

             // alert(data)
              if (data==null)
               {
                //alert("no hay datos")
                insertaConfirma(idCita)
               }else{
                //alert("hay datos")
                eliminarConfirma(data.idCita)
               }
                
                //insertaConfirma(data.idCita)
             },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error adding / update data');
              }
          });
   }

   function eliminarConfirma(idCita)
   {
      $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudestudiosporsala/eliminarCita/"+idCita,
              type: "POST",
              dataType: "html",
              success: function(data)
             {
              swal("Éxito", "Confirmación de cita eliminada", "success")
             },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error adding / update data');
              }
          });
   }