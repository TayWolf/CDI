window.onload=inicio;
    function inicio(){
        var idC = $("#idC").val();
       // alert("data");
       //var idE =1;
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudclientes/obtenerDatos/" + idC,
        dataType: "json",
        success: function(data)
        {
        $("#nombreCliente").val(data.nombreCliente);   
         $("#claveCl").val(data.Clave);
         $("#rfcCliente").val(data.RFC);
         $("#telClien").val(data.telefono);
         $("#direccionCli").val(data.direccionCliente);
         $("#estadoClien").val(data.Estado);
         $("#hiddenedo").val(data.Estado);
         $("#municipioCli").val(data.municipio);
         $("#hiddenmuni").val(data.municipio);
         $("#coloniaClien").val(data.Colonia);
          $("#hiddencolo").val(data.Colonia);
         $("#codigoPo").val(data.CP);
         trarMunicipio();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
    $(function(){
  $("#form").on("submit", function(e){ 
        e.preventDefault();
         $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
         var page = $(this).attr('data');        
        var dataString = 'page='+page;
        var formData = new FormData(document.getElementById("form"));
         $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudclientes/modificarDatos/",
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
                     location.href='http://localhost/CDI/Panel/index.php/Crudclientes';
                    
                }

    });
 });
   });

    function trarMunicipio()
    {

        $("#municipioCli").html('');
        
        var idEdo=$("#estadoClien").val();
         var idMu=$("#hiddenmuni").val();
        //alert(idEdo);
        $("#datos").show();
        if (idEdo!="") 
        {
             $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudclientes/getMuni/" + idEdo,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    if (data.length>0) 
                    {
                        for (i=0; i<data.length; i++)
                        {
                            $("#municipioCli").append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']));
                        }
                    }
                     $("#municipioCli").val(idMu);
                    traerColonia();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }else
        {
           $("#datos").hide();  
        }
        
    }
function traerColonia()
{
    $("#coloniaCl").html('');
        var idMuni=$("#municipioCli").val();
        var idCo = $("#hiddencolo").val();
        //alert(idEdo);
         $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudclientes/getColo/" + idMuni,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if (data.length>0) 
            {
                for (i=0; i<data.length; i++)
                {
                    $("#coloniaCl").append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']));
                }
            }
            $("#coloniaCl").val(idCo);
            traerPostal();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });   
}

function traerPostal()
{
     $("#codigoPo").html('');
    var coloniaCl=$("#coloniaCl").val();
     var idC=$("#hiddencolo").val();
        //alert(idEdo);
         $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudclientes/getPostal/" + coloniaCl,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if (data.length>0) 
            {
                for (i=0; i<data.length; i++)
                {
                     $("#codigoPo").val(data[i]['cp']);
                   
                }
            }
            $("#coloniaClien").val(idC);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });   
}