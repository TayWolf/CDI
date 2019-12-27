window.onload=inicio;
    function inicio(){
        var idE = $("#idE").val();
       // alert("data");
       //var idE =1;
          $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudempresas/obtenerDatos/" + idE,
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
    $(function(){
  $("#form").on("submit", function(e){ 
        e.preventDefault();
         $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
         var page = $(this).attr('data');        
        var dataString = 'page='+page;
        var formData = new FormData(document.getElementById("form"));
         $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudempresas/modificarDatos/",
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
                     location.href='http://localhost/CDI/Panel/index.php/Crudempresas';
                    
                }

    });
 });
   });