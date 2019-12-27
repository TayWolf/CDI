window.onload=inicio;
    function inicio(){
        var idS = $("#idS").val();
       // alert("data");
       //var idE =1;
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudsalas/obtenerDatos/" + idS,
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
    $(function(){
  $("#form").on("submit", function(e){ 
        e.preventDefault();
         $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
         var page = $(this).attr('data');        
        var dataString = 'page='+page;
        var formData = new FormData(document.getElementById("form"));
         $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudsalas/modificarDatos/",
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
                     location.href='http://localhost/CDI/Panel/index.php/Crudsalas';
                    
                }

                });
        });
   });

    function horario(idHo)
    {
        var idHo=idHo;
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudsalas/modHorario/" + idHo,
            dataType: "json",
            success: function(data)
            {
                if (data==1) 
                {
                    
                    swal("EXITO!", "Se ha modificado correctamente!", "success")
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

