var total = new Array(100);
for(var i=0; i<total.length; i++){
      total[i]='';
}

var ArtArreglo = new Array(100);
for(var b=0; b<ArtArreglo.length; b++){
      ArtArreglo[b]='';
      }
window.onload=nEntrada;
function nEntrada(){
  //$("#ivaSi").on("click",calculoTotalDos);
  //$("#ivaNo").on("click",calculoTotalDos);
  botones();

   $.ajax({
          url : "http://localhost/CDI/Panel/index.php/Crudordencompra/traerId/",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          { 
              var f = new Date();
             var o = (f.getDate() + "" + (f.getMonth() +1) + "" + f.getFullYear()+"CDI");

             // alert("entra");
              if (data.length>0)
               {
                for(i=0;i<data.length;i++)
                {
                  $("#noEm").val(o+data[i]['idCompra']);
                  $("#noEmisi").val(o+data[i]['idCompra']);
                }
               }
            
 
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
}
var array = {
    'listArt': []             
  };
   var arregloJson;
function botones () {
  // body...
  $("#NombreArt").on("focus",articulo);
}
function articulo () {
              //var idPac=$("#idSucursal").val();
              
             $("#NombreArt").autocomplete({
          source:function(request,response) {
            $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudsalida/traerArt/",
              dataType:"json",
              data:{q:request.term},
              success:function(data) {
                
                response(data);
              }
            });
          },
          minLength:1,
          select:function(event,ui) {
            //alert("nombre "+ ui.item.value+"id "+ui.item.idArticulo);
            $("#idArt").val(ui.item.idArticulo);
            $("#UnidadArt").val(ui.item.medida);
            $("#costoArt").val(ui.item.costo_unitario);
            $("#costoArOculto").val(ui.item.costo_unitario);
            $("#existencia").val(ui.item.existencia);
            $("#cantidadArt").val(1);
            calImporte();
            obtenerFechasCaducidad(ui.item.idArticulo);
           obtenerFechasEntradaCaducidad(ui.item.idArticulo);
            }
         });
          

      }


  function listaArticu()
  {
    var idPr=$("#idProve").val();
    //alert(idPr)
    $("#listaAr").html("");
    if (idPr!="") {
     $.ajax({

            url : "http://localhost/CDI/Panel/index.php/Crudordencompra/traerMinimo/"+idPr,
            type: "POST",
            dataType: "JSON",

            success:function(data) {

             if (data!="") {
              if(data.length > 0)
              {
                for(i=0; i<data.length; i++)
                {
                   // alert(data[i]["idUbicacion"]);
                   
                   $("#listaAr").append('<tr><td>'+data[i]["nombre"]+'</td><td><input type="checkbox" id="remeArt'+data[i]["idArticulo"]+'" name="remeArt'+data[i]["idArticulo"]+'" value="'+data[i]["idArticulo"]+'" onclick="ocultar('+data[i]["idArticulo"]+');" class="filled-in"><label for="remeArt'+data[i]["idArticulo"]+'"></label></td><td><input type="text" name="canti'+data[i]["idArticulo"]+'" id="canti'+data[i]["idArticulo"]+'" value="1"></td></tr>');
                    // prueba(data[i]["idUbicacion"])
                  }
                }
              }
             }

          });
   }else{
      swal({
        title: "Aviso",
        text: "¡Seleccione un proveedor por favor!",
        type: "warning",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
      },
      function(){
        swal("Gracias", "", "success");
        $('#myModal').modal('hide');
      });
   }
  }

   function listaOrden()
  {
    var idPr=$("#idProve").val();
    //alert(idPr)
    $("#listaOrden").html("");
    if (idPr!="") {
     $.ajax({

            url : "http://localhost/CDI/Panel/index.php/Crudordencompra/traerlistaOrden/"+idPr,
            type: "POST",
            dataType: "JSON",

            success:function(data) {

             if (data!="") {
              if(data.length > 0)
              {
                for(i=0; i<data.length; i++)
                {
                   // alert(data[i]["idUbicacion"]);
                   
                   $("#listaOrden").append('<tr><td>'+data[i]["fechaEmitida"]+'</td><td><a href="#" onclick="abrirVentana('+data[i]["idCompra"]+')" >Ver</a></td><td><a href="#" data-toggle="modal" data-target="#myModal3" onclick="listaArticulos('+data[i]["idCompra"]+');">Editar</a></td></tr>');
                    // prueba(data[i]["idUbicacion"])
                  }
                }
              }
             }

          });
   }else{
      swal({
        title: "Aviso",
        text: "¡Seleccione un proveedor para consultar sus pedidos!",
        type: "warning",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
      },
      function(){
        swal("Gracias", "", "success");
        $('#myModal2').modal('hide');
      });
   }
  }

  function abrirVentana(idCompra)
  {
    var idCompra=idCompra;
    mipopup=window.open("http://localhost/CDI/Panel/gridpdfpedidos.php?idCompra="+idCompra,"neo","width=900,height=600,menubar=si");

  }

function ocultar(id)
{
  var id=id;
  if ($('#remeArt'+id).is(':checked')) 
  {
    //alert("exito")
    $("#bot").show();
  }else{
    //alert("no seleccion")
    $("#bot").hide();
  }
   PonerMinimo(id)
}

function PonerMinimo(id)
{
  var id=id;
  $.ajax({

            url : "http://localhost/CDI/Panel/index.php/Crudordencompra/calculaMini/"+id,
            type: "POST",
            dataType: "JSON",

            success:function(data) {

             if (data!="") {
              if(data.length > 0)
              {
                for(i=0; i<data.length; i++)
                {
                    var existencia = parseInt(data[i]["existencia"]);
                    var minimo = parseInt(data[i]["minimo"]);
                    var Pedir = minimo-existencia;
                    $("#canti"+id).val(Pedir);
                   // alert(data[i]["idUbicacion"]);
                  // alert("bien")
                   
                   
                  }
                }
              }
             }

          });

}

  function agregaOrdenc()
  {
   //var url;
  //Recojemos datos del formulario para su envio
    var Solifecemi = $("#Solifecemi").val();//
    var noEmisi = $("#noEmisi").val();//
    var idProve = $("#idProve").val();//
    var Solifec = $("#Solifec").val();//

    
    var fechaSoliMos = $("#fechaSoliMos").val();//
    var tot = $("#tot").val();
   var remeArt = $("#remeArt").val();//
   var canti = $("#canti").val();//
       //convertimos el arreglo en JSON
            /*arregloJson=JSON.stringify(array);
            arre = JSON.parse(arregloJson);*/
              var parametros = {
              "Solifecemi":Solifecemi,
              "noEmisi":noEmisi,
              "idProve":idProve,
              "fechaSoliMos":fechaSoliMos,
              "Solifec":Solifec,
              "remeArt":remeArt,
              "canti":canti,
              "tot":tot //Aquí enviamos el arreglo con las habitaciones
              };
          $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudordencompra/agregaOrdenc/",
            type: "POST",
            data: parametros,  
            dataType: "HTML",
            success: function(data)
           {
             //swal({   title: "Registrado!",   text: "Compra registrada exitosamente.",   type: "success",   confirmButtonText: "Cerrar", confirmButtonColor: "#e1bd85" });
                alert(data)
                /*swal({
                  title: "Éxito ",
                  text: "Orden de compra registrada exitosamente.",
                  type: "success",
                  //showCancelButton: true,
                  //confirmButtonClass: "btn-danger",
                  confirmButtonText: "Aceptar",
                  //closeOnConfirm: false
                },
                function(){
                  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  //location.href='http://localhost/CDI/Panel/index.php/Crudsalida';
                });         */  
           },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
                });
            
 }

 function filtroListorden()
 {
  var feIni =$("#feIni").val();
  var feFin =$("#feFin").val();
  var idP =$("#idProve").val();
  $("#listaOrden").html("");
  if (feIni!="" && feFin!="" ) 
    {
      //alert("entra");
        $.ajax({

            url : "http://localhost/CDI/Panel/index.php/Crudordencompra/traerlistaOrdenFilt/"+feIni+"/"+feFin+"/"+idP,
            type: "POST",
            dataType: "JSON",

            success:function(data) {

             if (data!="") {
              if(data.length > 0)
              {
                for(i=0; i<data.length; i++)
                {
                   // alert(data[i]["idUbicacion"]);
                  // alert("bien")
                   $("#listaOrden").append('<tr><td>'+data[i]["fechaEmitida"]+'</td><td><a href="#" onclick="abrirVentana('+data[i]["idCompra"]+')" >Ver</a></td><td><a href="#" data-toggle="modal" data-target="#myModal3" onclick="listaArticulos('+data[i]["idCompra"]+')" >Editar</a></td></tr>');
                   
                  }
                }
              }
             }

          });
    }
 }

function listaArticulos(idCo)
  {
    var idPr=$("#idProve").val();
    var idCom=idCo;
    //alert(idPr)
    $("#listaArEdit").html("");
    if (idPr!="") {
     $.ajax({

            url : "http://localhost/CDI/Panel/index.php/Crudordencompra/traerMin/"+idPr+"/"+idCom,
            type: "POST",
            dataType: "JSON",

            success:function(data) {

             if (data!="") {
              if(data.length > 0)
              {
                for(i=0; i<data.length; i++)
                {
                   // alert(data[i]["idUbicacion"]);
                   
                   $("#listaArEdit").append('<tr><td>'+data[i]["nombre"]+'</td><td><input type="checkbox" id="remeArtt'+data[i]["idArticulo"]+'" name="remeArtt'+data[i]["idArticulo"]+'" value="'+data[i]["idArticulo"]+'" onclick="ocultar('+data[i]["idArticulo"]+');" class="filled-in"><label for="remeArtt'+data[i]["idArticulo"]+'"></label></td><td><input type="text" name="canti'+data[i]["idArticulo"]+'" id="canti'+data[i]["idArticulo"]+'" value="0"></td></tr>');
                    // prueba(data[i]["idUbicacion"])
                    traerListaEdit(idCom)
                  }
                }
              }
             }

          });
   }else{
      swal({
        title: "Aviso",
        text: "¡Seleccione un proveedor por favor!",
        type: "warning",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Aceptar",
        closeOnConfirm: false
      },
      function(){
        swal("Gracias", "", "success");
        $('#myModal').modal('hide');
      });
   }
  }
 
  function traerListaEdit(idComp)
 {
  var idComp =idComp;
        $.ajax({

            url : "http://localhost/CDI/Panel/index.php/Crudordencompra/traerListaEditBase/"+idComp,
            type: "POST",
            dataType: "JSON",

            success:function(data) {

             if (data!="") {
              if(data.length > 0)
              {
                for(i=0; i<data.length; i++)
                {
                  var checked = "checked ";
                  document.getElementById("remeArtt"+data[i]["idArticulo"]).checked = true;
                   
                  $("#canti"+data[i]["idArticulo"]).val(data[i]["cantidad"]);
                  $("#idComprrr").val(idComp);
                  }
                }
              }
             }
          });
  
 }

 function guardarCambios()
 {
  var idCom=$("#idComprrr").val();
  
    $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudordencompra/deleteArrayArt/"+idCom,
            type: "POST",
            dataType: "JSON",
            success:function(data) {
                 //alert("Hecho")
                 actualizaArray(idCom)
              }
             
          });
  }
  function actualizaArray(idCom){
    var idCom=idCom;
    var total = $("#tot").val();
      for (i = 1; i < total; i++) {
        var remeArt =$("#remeArtt"+i).val();
        var canti =$("#canti"+i).val();
      //  var che = document.getElementById("remeArt"+i).checked = true;
        if (remeArt == i && $('#remeArtt'+i).is(':checked')) {
          $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudordencompra/guardarArreglo/"+idCom+"/"+remeArt+"/"+canti,
            type: "POST",
            dataType: "html",
            success:function(data) {
                 swal({
                  title: "Éxito ",
                  text: "Orden de compra Actualizada exitosamente.",
                  type: "success",
                  showCancelButton: true,
                  //confirmButtonClass: "btn-danger",
                  cancelButtonText: "Ver PDF",
                  confirmButtonText: "Aceptar",
                  //closeOnConfirm: false
                },
                function(isConfirm){
                  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  if(isConfirm)
                    location.href='http://localhost/CDI/Panel/index.php/Crudordencompra';
                  else
                    abrirVentana(idCom);
                }); 
                
              }
          });
          
        }
      }
  }
  
  


 