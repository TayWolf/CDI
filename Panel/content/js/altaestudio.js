$(function(){
  $("#form").on("submit", function(e){ 
    
        e.preventDefault();
         $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
         var page = $(this).attr('data');        
        var dataString = 'page='+page;
        var formData = new FormData(document.getElementById("form"));
         $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudestudios/agregaraltaestudio/",
                type: "post",
                data: formData,
                dataType: "HTML",
                cache: false,
                contentType: false,
                 processData: false,
                success: function(data)
                {
                    // alert(data);
                    $('#cargando').fadeIn(1000).html(data);
                    location.href='http://localhost/CDI/Panel/index.php/Crudestudios';
                }

    });
 });
   });

function traerEmpresa(idEstudio)
    {        
            var id=idEstudio;
            $("#muestraselectempresas"+id).show();
            $("#selectempresa"+id).show();
            $("#nombreEmpresa"+id).hide();
             $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudestudios/traerEmpr/",
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //alert(data);
                    if (data.length>0) 
                    {
                        for (i=0; i<data.length; i++)
                        {
                            $("#selectempresa"+id).append(new Option(data[i]['nombreEmpresa'],data[i]['idEmpresa']));
                        }
                    }
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function modificarDatosEmpre(id){
             
             var id = id;
             var idempresa = $("#selectempresa"+id).val();
             
             // alert (idcolonia);
             var parametros = {"idEmpresa":idempresa,"id":id}
              //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
             $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudestudios/editaempresa/",
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

function traerCategoria(idEstudio)
    {        
            var id=idEstudio;
            $("#muestraselectcategoria"+id).show();
            $("#selectcategoria"+id).show();
            $("#nombreCategoria"+id).hide();
             $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudestudios/traerCate/",
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //alert(data);
                    if (data.length>0) 
                    {
                        for (i=0; i<data.length; i++)
                        {
                            $("#selectcategoria"+id).append(new Option(data[i]['nombreCat'],data[i]['idCat']));
                        }
                    }
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

function modificarDatosCate(id){
             
             var id = id;
             var idcategoria = $("#selectcategoria"+id).val();
             
             // alert (idcolonia);
             var parametros = {"idcategoria":idcategoria,"id":id}
              //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
             $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudestudios/editacategoria/",
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
        
    