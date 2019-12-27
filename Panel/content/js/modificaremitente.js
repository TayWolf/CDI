
    window.onload = inicio();
    // $(document).on("ready",inicio);
    function inicio(){
      
        traeEstado();

        var idR = $("#idR").val();
        $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudremitentes/obtenerDatos/" + idR,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
        if(data.controlRem == 2){
            // var control = "No se lleva un Control";
            $("#md_checkbox_23").attr( 'checked', false );
        }if(data.controlRem == 1){
            $("#md_checkbox_23").attr( 'checked', true );
        }

        $("#nombre").val(data.nombreRem);
        $("#especialidad").val(data.especialidadRem);
        $("#clave").val(data.claveRem);
        $("#fecha").val(data.fechanaciRem);
        $("#teluno").val(data.telefonoRemuno);
        $("#teldos").val(data.telefonoRemdos);
        $("#correo").val(data.EmailRem);
        $("#estado").val(data.estadoRem);
        $("#ciudadhidden").val(data.ciudadRem);
        traeMunicipio();
        $("#coloniahidden").val(data.coloniaRem);
        $("#calle").val(data.calleRem);
        $("#cp").val(data.cp);
        $("#md_checkbox_23").val(data.controlRem);

        //$(".body").append("<div class='row clearfix'><div class='col-md-4'><h6>Nombre</h6><div class='form-group'><div class='form-line'><input id='nombreUser' type='text' class='form-control' value='"+data.nombreUser+"'></div></div></div><div class='col-md-4'><h6>Tipo Usuario</h6><div class='form-group'><div class='form-line'><input id='tipoUser' type='text' class='form-control' value='"+tipo+"'></div></div></div><div class='col-md-4'><h6>Foto usuario</h6><img scr='"+ruta+"' width='100' height='100'></div></div><div class='row clearfix'><div class='col-md-6'><h6>Cuenta de correo</h6><div class='form-group'><div class='form-line'><input id='correoUser' type='text' class='form-control' value='"+data.correoUser+"'></div></div></div><div class='col-md-6'><h6>Contraseña</h6><div class='form-group'><div class='form-line'><input id='passwordUser' type='text' class='form-control' value='"+data.password+"'></div></div></div></div>");
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
        var check = $("#md_checkbox_23").val();

         $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudremitentes/modificarDatos/"+check,
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
                     location.href='http://localhost/CDI/Panel/index.php/Crudremitentes';
                    
                }

    });
 });
   });



function traeEstado(){
  $.ajax({
  url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getEstado",
  type: "post",
  dataType: "JSON",
  success: function(data)
    {
      if(data.length>0)
      {
        for (i=0; i<data.length; i++)
          {
            $("#estado").append("<option value='"+data[i]['id_Estado']+"'>"+data[i]['nombreEstado']+"</option>"); 
            //$("#estado").append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']));
          }
      }
    },
  error: function (jqXHR, textStatus, errorThrown)
    {
      alert('Error get data from ajax');
    }
  });
}

function traeMunicipio(){
  //$("#ciudad").html("");
  var idEstado = $("#estado").val();
  var idhidden = $("#ciudadhidden").val();
   // alert(idhidden);
  $.ajax({
  url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getMunicipio/"+ idEstado,
  type: "post",
  dataType: "JSON",
  success: function(data)
    {
      if(data.length>0)
      {
        for (i=0; i<data.length; i++)
          {
            $("#ciudad").append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']));
          }
      }
      $("#ciudad").val(idhidden);
      traeRegion();
    },
  error: function (jqXHR, textStatus, errorThrown)
    {
      alert('Error get data from ajax');
    }
  });
}

function traeRegion(){
  $("#colonia").html("");
  var idMunic = $("#ciudad").val();
  var idhidden = $("#coloniahidden").val();
  // alert(idhidden);
  $.ajax({
  url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getColonia/"+ idMunic,
  type: "post",
  dataType: "JSON",
  success: function(data)
    {
      if(data.length>0)
      {
        for (i=0; i<data.length; i++)
          {
            $("#colonia").append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']));
          }
      }
      $("#colonia").val(idhidden);
    },
  error: function (jqXHR, textStatus, errorThrown)
    {
      alert('Error get data from ajax');
    }
  });
}

function cambiacheck() {

  if( $("#md_checkbox_23").prop('checked') ) {
      $("#md_checkbox_23").val(1);
  }else{
      $("#md_checkbox_23").val(2);
    }
}