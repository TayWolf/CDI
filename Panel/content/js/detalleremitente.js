    window.onload = inicio();
    // $(document).on("ready",inicio);
    function inicio(){
        var idR = $("#idR").val();
        $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudremitentes/obtenerDatos/" + idR,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
        if(data.controlRem == 2){
            var control = "No se lleva un Control";
        }if(data.controlRem == 1){
            var control = "Si se lleva un Control";
        }

        $("#nombre").val(data.nombreRem);
        $("#especialidad").val(data.especialidadRem);
        $("#clave").val(data.claveRem);
        $("#fecha").val(data.fechanaciRem);
        $("#teluno").val(data.telefonoRemuno);
        $("#teldos").val(data.telefonoRemdos);
        $("#correo").val(data.EmailRem);
        $("#estado").val(data.nombreEstado);
        $("#ciudad").val(data.nombreMunicipio);
        $("#colonia").val(data.nombreRegion);
        $("#calle").val(data.calleRem);
        $("#cp").val(data.cp);
        $("#control").val(control);

        //$(".body").append("<div class='row clearfix'><div class='col-md-4'><h6>Nombre</h6><div class='form-group'><div class='form-line'><input id='nombreUser' type='text' class='form-control' value='"+data.nombreUser+"'></div></div></div><div class='col-md-4'><h6>Tipo Usuario</h6><div class='form-group'><div class='form-line'><input id='tipoUser' type='text' class='form-control' value='"+tipo+"'></div></div></div><div class='col-md-4'><h6>Foto usuario</h6><img scr='"+ruta+"' width='100' height='100'></div></div><div class='row clearfix'><div class='col-md-6'><h6>Cuenta de correo</h6><div class='form-group'><div class='form-line'><input id='correoUser' type='text' class='form-control' value='"+data.correoUser+"'></div></div></div><div class='col-md-6'><h6>Contraseña</h6><div class='form-group'><div class='form-line'><input id='passwordUser' type='text' class='form-control' value='"+data.password+"'></div></div></div></div>");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }