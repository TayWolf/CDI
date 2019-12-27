window.onload=inicio;
    function inicio(){
        var idD = $("#idD").val();
       // alert("data");
       //var idE =1;
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Cruddoctores/obtenerDatos/" + idD,
        dataType: "json",
        success: function(data)
        {
         $("#nombre").val(data.nombreDoc);   
         $("#clave").val(data.claveDoc);
         $("#fecha").val(data.fechanaciDoc);
         $("#cedula").val(data.cedulaDoc);
         $("#universidad").val(data.universidadDoc);
         $("#horario").val(data.horarioDoc);
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
                url : "http://localhost/CDI/Panel/index.php/Cruddoctores/modificarDatos/",
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
                    location.href='http://localhost/CDI/Panel/index.php/Cruddoctores';
                    
                }

    });
 });
   });