 window.onload=inicio;
    function inicio(){
       var idE = $("#idE").val();
       // alert("data");
       //var idE =1;
       
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudempresas/obtenerDatos/" + idE,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
         $("#nombreEmp").val(data.nombreEmpresa);   
         $("#rfcEmpresa").val(data.RFC);
         $("#direccionE").val(data.direccionEmpresa);
         $("#coloniaempre").val(data.coloniaEmpresa);
         $("#estadoEm").val(data.EstadoEmpresa);
         $("#telefonoEmp").val(data.telefonoEmpresa);
         $("#nombreContact").val(data.nombreContacto);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }