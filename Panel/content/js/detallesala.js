 window.onload=inicio;
    function inicio(){
       var idS = $("#idS").val();
       // alert("data");
       //var idE =1;
       
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudsalas/obtenerDatos/" + idS,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
         $("#nombreSala").val(data.nombre);   
         $("#tipoSala").val(data.tipo);
         $("#horariosSala").val(data.horarios);
         $("#claveSala").val(data.clave);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }