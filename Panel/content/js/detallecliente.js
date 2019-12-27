 window.onload=inicio;
    function inicio(){
       var idC = $("#idC").val();
       // alert("data");
       //var idE =1;
       
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudclientes/obtenerDatos/" + idC,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
         $("#nombreCliente").val(data.nombreCliente);   
         $("#claveCl").val(data.Clave);
         $("#rfcCliente").val(data.RFC);
         $("#telClien").val(data.telefono);
         $("#direccionCli").val(data.direccionCliente);
         $("#estadoClien").val(data.nombreEstado);
         $("#municipioCli").val(data.nombreMunicipio);
         $("#coloniaClien").val(data.nombreRegion);
         $("#codigoPo").val(data.CP);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }