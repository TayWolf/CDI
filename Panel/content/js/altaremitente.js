$(function(){
  $("#form_validation").on("submit", function(e){
    var url;
    url= "http://localhost/CDI/Panel/index.php/Crudremitentes/altaRemitente";
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("form_validation"));

    $.ajax({
      url: url,
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      if(res==1)
        {
          window.location.replace("http://localhost/CDI/Panel/index.php/Crudremitentes");
        }
    });
  });
});

// window.onload = traeEstado();

// function traeEstado(){
//   $.ajax({
//   url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getEstado",
//   type: "post",
//   dataType: "JSON",
//   success: function(data)
//     {
//       if(data.length>0)
//       {
//         for (i=0; i<data.length; i++)
//           {
//             $("#estado").append("<option value='"+data[i]['id_Estado']+"'>"+data[i]['nombreEstado']+"</option>");
//             // document.getElementsByName("estado")[0].append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']));
//             $("select[name='estado']").append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']));
//           }
//       }
//       document.getElementsByName("estado")[0].addEventListener("change", traeMunicipio);
//     },
//   error: function (jqXHR, textStatus, errorThrown)
//     {
//       alert('Error get data from ajax');
//     }
//   });
// }

// function traeMunicipio(){
//   $("#ciudad").html("");
//   $("select[name=ciudad]").html("");
//   var idEstado = $("#estado").val();
//   if (idEstado == "") {
//     idEstado=$("select[name=estado]").val();
//   }
//   // alert(idEstado);
//   $.ajax({
//   url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getMunicipio/"+ idEstado,
//   type: "post",
//   dataType: "JSON",
//   success: function(data)
//     {
//       if(data.length>0)
//       {
//         for (i=0; i<data.length; i++)
//           {
//             $("#ciudad").append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']));
//             $("select[name='ciudad']").append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']));
//           }
//       }
//       traeRegion();
//     },
//   error: function (jqXHR, textStatus, errorThrown)
//     {
//       alert('ERROR DE TRAER MUNICIPIO');
//     }
//   });
// }


// function traeRegion(){
//   $("#colonia").html("");
//   $("select[name=colonia]").html("");
//   var idMunic = $("#ciudad").val();
//   if (idMunic == "") {
//     idMunic = idEstado=$("select[name=ciudad]").val();
//   }
//   $.ajax({
//   url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getColonia/"+ idMunic,
//   type: "post",
//   dataType: "JSON",
//   success: function(data)
//     {
//       if(data.length>0)
//       {
//         for (i=0; i<data.length; i++)
//           {
//             $("#colonia").append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']));
//             $("select[name='colonia']").append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']));
//           }
//       }
//     },
//   error: function (jqXHR, textStatus, errorThrown)
//     {
//       alert('Error get data from ajax');
//     }
//   });
// }

function cambiacheck() {

  if( $("#md_checkbox_23").prop('checked') ) {
      $("#md_checkbox_23").val(1);
  }else{
      $("#md_checkbox_23").val(2);
    }
}