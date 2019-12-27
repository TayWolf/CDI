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
            var ruta = "https://cointic.com.mx/DCI/Panel/content/images/usuarios/user.png";
        }else{
            var ruta= "https://cointic.com.mx/DCI/Panel/content/images/usuarios/"+data.fotoUser+"";  
        }

        $("#fotoInicial").val(data.fotoUser);
        $("#nombre").val(data.nombreUser);
        $("#correo").val(data.correoUser);
        $("#password").val(data.password);
        $("#tipo").val(data.tipoUser);
        //$(".body").append("<div class='row clearfix'><div class='col-md-4'><h6>Nombre</h6><div class='form-group'><div class='form-line'><input type='hidden' name='iduser' value='"+data.idUser+"'><input type='hidden' name='fotoInicial' value='"+data.fotoUser+"'><input id='nombreUser' name='nombreUser' type='text' class='form-control' value='"+data.nombreUser+"'></div></div></div><div class='col-md-4'><h6>Tipo Usuario</h6><div class='form-group'><div class='form-line'><select name='tipoUser'><option value='1'>Administrador</option><option value='2'>Empleado</option></select></div></div></div><div class='col-md-4'><h6>Foto del Usuario</h6><div class='form-group'><div class='form-line'><input name='foto' id='foto' type='file' class='form-control'></div></div></div></div><div class='row clearfix'><div class='col-md-6'><h6>Cuenta de correo</h6><div class='form-group'><div class='form-line'><input id='correoUser' name='correoUser' type='text' class='form-control' value='"+data.correoUser+"'></div></div></div><div class='col-md-6'><h6>Contraseña</h6><div class='form-group'><div class='form-line'><input id='passwordUser' name='passwordUser' type='text' class='form-control' value='"+data.password+"'></div></div></div></div>");
        
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }