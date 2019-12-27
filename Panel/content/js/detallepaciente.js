 window.onload=inicio;
    function inicio(){
       var idP = $("#idP").val();
       // alert("data");
       //var idE =1;
       
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpacientes/obtenerDatos/" + idP,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
            if (data.generoPaci == 1) {
                data.generoPaci = "Masculino";
            }else{
                data.generoPaci = "Femenino";
            }
         $("#nombre").val(data.nombrePaci);   
         $("#clave").val(data.clavePaci);
         $("#genero").val(data.generoPaci);
         $("#correo").val(data.correoPaci);
         $("#edad").val(data.edadPaci);
         $("#fecha").val(data.fechanaciPaci);
         $("#telefono").val(data.telefonoPaci);
         $("#remitente").val(data.nombreRem);
         $("#cliente").val(data.nombreCliente);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }