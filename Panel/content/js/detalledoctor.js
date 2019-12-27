 window.onload=inicio;
    function inicio(){
       var idD = $("#idD").val();
       
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Cruddoctores/obtenerDatos/" + idD,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
         $("#nombre").val(data.nombreDoc);   
         $("#clave").val(data.claveDoc);
         $("#fecha").val(data.fechanaciDoc);
         $("#cedula").val(data.cedulaDoc);
         $("#universidad").val(data.universidadDoc);
         $("#horario").val(data.horarioDoc);
         if (data.status == 1) {
            $("#status").val("ACTIVO");
         }else{
            $("#status").val("INACTIVO");
         }
         
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }