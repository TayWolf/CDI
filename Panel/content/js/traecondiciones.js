 window.onload=inicio;
    function inicio(){
       var id = $("#id").val();
    // alert(id);
       
        $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudclientes/buscacondiciones/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
         $("#descuento").val(data.descuento);   
         $("#diascredito").val(data.diasCredito);
         $("#credito").val(data.creditos);
         $("#vales").val(data.controldeVales);
         $("#catalogo").val(data.Catalogo);
         $("#fpago").val(data.formaPago);
         $("#cuenta").val(data.cuenta);

         if (data.precio == 1) {
            $("#radio1").attr('checked', true);
         }else if (data.precio == 2) {
            $("#radio2").attr('checked', true);
         }else if (data.precio == 3) {
            $("#radio3").attr('checked', true);
         }else if (data.precio == 4) {
            $("#radio4").attr('checked', true);
         }
         if (data.estadoCuenta == 1){
            $("#estadoc").attr('checked',true);
         }else{
            4("#estadoc").attr('checked',false);
         }

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
        if($("#estadoc").prop("checked"))
        {
            $("#estadoc").val(1);
        }

        var formData = new FormData(document.getElementById("form"));

         $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudclientes/modificarCondiciones/",
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