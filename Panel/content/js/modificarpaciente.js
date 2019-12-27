window.onload=inicio;
    function inicio(){
        var idP = $("#idP").val();
       // alert("data");
       //var idE =1;
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpacientes/obtenerDatos/" + idP,
        dataType: "json",
        success: function(data)
        {
            // alert(data);
            // if (data.generoPaci == 1) {
            //     data.generoPaci = "Masculino";
            // }else{
            //     data.generoPaci = "Femenino";
            // }
         $("#nombre").val(data.nombrePaci);   
         $("#clave").val(data.clavePaci);
         $("#genero").val(data.generoPaci);
         $("#correo").val(data.correoPaci);
         $("#edad").val(data.edadPaci);
         $("#fechanaci").val(data.fechanaciPaci);
         $("#telefono").val(data.telefonoPaci);
         $("#remitente").val(data.remitente);
         $("#cliente").val(data.cliente);
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
                url : "http://localhost/CDI/Panel/index.php/Crudpacientes/modificarDatos/",
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
                     location.href='http://localhost/CDI/Panel/index.php/Crudpacientes';
                    
                }

    });
 });
   });