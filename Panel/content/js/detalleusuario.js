    window.onload = inicio();
    // $(document).on("ready",inicio);
    function inicio(){
        var idu = $("#idu").val();
        $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudusuarios/obtenerDatos/" + idu,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
        if(data.tipoUser == 1){
            var tipo = "Administrador"
        }if(data.tipoUser == 2){
            var tipo = "Empleado";
        }
        if(data.fotoUser=='' || data.fotoUser == "null") {
            var ruta = "http://localhost/CDI/Panel/content/images/usuarios/user.png";
        }else{
            var ruta= "http://localhost/CDI/Panel/content/images/usuarios/"+data.fotoUser+"";  
        }
        $("#nombre").val(data.nombreUser);
        $("#tipo").val(tipo);
        $("#correo").val(data.correoUser);
        $("#password").val(data.password);
        $("#foto").append("<img src='"+ruta+"' width='100px' height='100px'>")
        //$(".body").append("<div class='row clearfix'><div class='col-md-4'><h6>Nombre</h6><div class='form-group'><div class='form-line'><input id='nombreUser' type='text' class='form-control' value='"+data.nombreUser+"'></div></div></div><div class='col-md-4'><h6>Tipo Usuario</h6><div class='form-group'><div class='form-line'><input id='tipoUser' type='text' class='form-control' value='"+tipo+"'></div></div></div><div class='col-md-4'><h6>Foto usuario</h6><img scr='"+ruta+"' width='100' height='100'></div></div><div class='row clearfix'><div class='col-md-6'><h6>Cuenta de correo</h6><div class='form-group'><div class='form-line'><input id='correoUser' type='text' class='form-control' value='"+data.correoUser+"'></div></div></div><div class='col-md-6'><h6>Contraseña</h6><div class='form-group'><div class='form-line'><input id='passwordUser' type='text' class='form-control' value='"+data.password+"'></div></div></div></div>");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }


function muestrapass() {
    $("#password").prop("type", "text"); 
}


function ocultapass() {
    $("#password").prop("type", "password"); 
}