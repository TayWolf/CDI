$(function(){
  $("#form").on("submit", function(e){
        e.preventDefault();
        var page = $(this).attr('data');        
        var dataString = 'page='+page;
        var formData = new FormData(document.getElementById("form"));
         $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudusuarios/modificarDatos/",
                type: "post",
                data: formData,
                dataType: "HTML",
                cache: false,
                contentType: false,
                 processData: false,
                success: function(data)
                {
                    // alert(data);
                    window.location.replace("http://localhost/CDI/Panel/index.php/Crudusuarios");
                }

    });
 });
});


function muestrapass() {
    $("#password").prop("type", "text"); 
}


function ocultapass() {
    $("#password").prop("type", "password"); 
}