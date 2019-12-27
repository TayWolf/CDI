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
  $("#ivaSi").on("click",calculoTotalDos);
  $("#ivaNo").on("click",calculoTotalDos);
  botones();

   $.ajax({
          url : "http://localhost/CDI/Panel/index.php/Crudentradas/traerIdEntrada/",
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
                  $("#noEnt").val(o+data[i]['idEntrada']);
                  $("#noEntrada").val(o+data[i]['idEntrada']);
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
// function botones () {
//   // body...
//   $("#NombreArt").on("focus",articulo);
// }
function articulo () {
   if ($("#motivo").val()!='') {
              //var idPac=$("#idSucursal").val();
              
             $("#NombreArt").autocomplete({
          source:function(request,response) {
            $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudentradas/traerArt/",
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
            }
         });
          }

      }

          function calImporte () {
            var can=$("#cantidadArt").val(),cos=$("#costoArt").val(),imp;
            imp=parseFloat(cos)*parseFloat(can);
            parseFloat(imp);
           $("#importeArt").val(imp.toFixed(2)); 
          }

           function visualArt()
              {
                //alert("entra");
                 var mot =$("#motivo").val();
                   if (mot!='') {
                     $("#datosArtmuestra").show();
                     $("#tablaAgregar").show();  
                    }else{
                      $("#datosArtmuestra").hide();
                      $("#tablaAgregar").hide();  
                    }
               }
  
  function agregarArticuloLista(){
      //impArrglo();
      var nomArticulo = $("#NombreArt").val();
      var idArticulo = $("#idArt").val();
      var unidad = $("#UnidadArt").val();
      
      var costoAr = parseFloat($("#costoArt").val());
      var costoArOculto = parseFloat ($("#costoArOculto").val());
      var cantidadAr = $("#cantidadArt").val();
      var existencia = $("#existencia").val();
      var importeAr = $("#importeArt").val();
      var desArt=$("#descuentoArt").val();
      var fCaducidad = $("#fechaCad").val();

      var NombreArt = $("#NombreArt").val();//
      var idArt = $("#idArt").val();
      var UnidadArt = $("#UnidadArt").val();//
      var DescuentoArt = $("#DescuentoArt").val();//
      var fechaCad = $("#fechaCad").val();//
      var costoArt = $("#costoArt").val();//
      var cantidadArt = $("#cantidadArt").val();//
      var importeArt = $("#importeArt").val();//
      var descuentoTotalArt=0;
      var costoPromedio = 0 ;
        //alert ("costoAr"+costoAr+"costoArOculto"+costoArOculto);
      if (costoAr==costoArOculto) {
        costoPromedio=costoAr;
     // alert("hola");
      }else{
        if(costoArOculto==0)
        {
           costoPromedio=costoAr;
        }
        else
        {
           costoPromedio = (costoArOculto + costoAr)/2;
        }
        
      }

     // $.trim(existencia);
      existencia=parseInt(existencia);
      costoArDos=costoAr*cantidadAr;
      descuentoTotalArt=costoArDos*desArt;
      descuentoTotalArt=descuentoTotalArt/100;
      //alert(descuentoTotalArt);
      importe=costoArDos-descuentoTotalArt;

       if (nomArticulo != '') { //verifica si hay un sucursal escogido 
        var prueba=jQuery.inArray(idArticulo,ArtArreglo );
        //alert(prueba);
        //if (prueba == -1) {
     $.each(total,function(index,value){
            if(value == ''){
                  x=index;
                 // alert(x);
        array.listArt.push({ 'costoPromedio':costoPromedio,'idArticulo': idArticulo,'cantidadA': cantidadArt, 'unidadA': UnidadArt, 'caducidadA': fechaCad, 'nomArt':NombreArt, 'descuentoAr':DescuentoArt,  'costoAr':costoArt,'importArt':importeArt,'existencia':existencia});
        $("#listaArticulo").append('<tr id='+x+'><td>'+cantidadAr+'</td><td>'+unidad+'</td><td>'+fCaducidad+'</td><td>'+nomArticulo+
          '<input type="hidden" value="'+cantidadAr+'" name="cantidadAr'+x+'" id="cantidadAr'+x+
          '"/><input type="hidden" value="'+nomArticulo+'" name="nomArticulo'+x+'" id="nomArticulo'+x+
          '"/><input type="hidden" value="'+unidad+'" name="unidad'+x+'" id="unidad'+x+
          '"/><input type="hidden" value="'+costoAr+'" name="costoAr'+x+'" id="costoAr'+x+
          '"/><input type="hidden" value="'+costoPromedio+'" name="costoPromedio'+x+'" id="costoPromedio'+x+'"/><input type="hidden" value="'+idArticulo+'" name="idArticulo'+x+'" id="idArticulo'+x+
          '"/><input type="hidden" value="'+fCaducidad+'" name="fCaducidad'+x+'" id="fCaducidad'+x+
          '"/></td><td>'+costoAr+'</td><td>'+costoArDos.toFixed(2)+'</td><td align=center><a href="javascript:eliminararticulo('+x+');">Eliminar</a></td></tr>');
            calculoTotal(costoArDos,x,idArticulo);
            //$("#arreglo").append('Artagregado');
           // impArrglo();
           limpiarCamArticulo();
            return false;
            }
      });
      
      }
    
  }
    function limpiarCamArticulo () {
      var dato1='';
      $("#NombreArt").val(dato1);
      $("#idArt").val(dato1);
      $("#UnidadArt").val(dato1);
      $("#fechaCad").val(dato1);
      $("#costoArt").val(dato1);
      $("#costoArOculto").val(dato1);
      $("#existencia").val(dato1);
      $("#cantidadArt").val(dato1);
      $("#importeArt").val(dato1);
      $("#NombreArt").focus();

  }

  function calculoTotal(costoAr,x,idArticulo){
      total[x]=costoAr;
      ArtArreglo[x]=idArticulo;
      var totalIva=0;
       var totalSuma=0;
       var resIva=0;
       var suma=0;
       var sumaDescuento=0;
       var valorDescuento=$("#descuento").val();
       var descuentoTotal=0;
       var suma2=0;
       var ivaM=0.16;
       var iva=$('input:radio[name=gender]:checked').val()
      for (var i=0; i<total.length; i++) {
            if (total[i]!='') {

            suma += (total[i]);
      }
      };
     
     
     if($("#des").is(':checked') && iva==1){
        //alert("descuento y iva");
        suma2=suma;
        //alert("suma2"+suma2)
        suma=suma-sumaDescuento;
        //alert("suma suma-sumaDescuento"+suma);
        descuentoTotal=suma*valorDescuento;
        descuentoTotal=descuentoTotal/100;
        //alert("desc"+descuentoTotal);
        suma=suma-descuentoTotal;
        //alert("suma-descuentoTotal"+suma);
        resIva=suma*ivaM;
        //alert("resIva"+resIva);
        //totalIva=suma-resIva;
        totalSuma=suma+resIva;
        //alert(totalSuma);
      $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(resIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(resIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       }else if($("#des").is(':checked')){
        //alert("descuento");
        //alert(sumaDescuento);
        suma2=suma;
        //alert(suma2);
        suma=suma-sumaDescuento;
        //alert(suma);
        descuentoTotal=suma*valorDescuento;
        //alert(descuentoTotal);
        descuentoTotal=descuentoTotal/100;
        //alert(descuentoTotal);
        totalSuma=suma-descuentoTotal;
        //alert(totalSuma);
      $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(totalIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(totalIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       } else if(iva==1){
        
        //alert("iva");
        suma2=suma;
        
        suma=suma-sumaDescuento;
        //alert(suma);
        resIva=suma*ivaM;
        //alert(resIva);
        totalSuma=suma+resIva;
        //alert(totalSuma);
     $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(resIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(resIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
      
       }else{
        //alert("nada");
        suma2=suma;
        
        suma=suma-sumaDescuento;
         totalSuma=suma;
     $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(totalIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(totalIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       }  
     
  }

  function calculoTotalDos(){
    var totalIva=0;
       var totalSuma=0;
       var resIva=0;
       var suma=0;
       var sumaDescuento=0;
       var valorDescuento=$("#descuento").val();
       var descuentoTotal=0;
       var suma2=0;
       var ivaM=0.16;
       var iva=$('input:radio[name=gender]:checked').val()
      for (var i=0; i<total.length; i++) {
            if (total[i]!='') {

            suma += (total[i]);
      }
      };
     
      if($("#des").is(':checked') && iva==1){
        //alert("descuento y iva");
        suma2=suma;
        //alert("suma2"+suma2)
        suma=suma-sumaDescuento;
        //alert("suma suma-sumaDescuento"+suma);
        descuentoTotal=suma*valorDescuento;
        descuentoTotal=descuentoTotal/100;
        //alert("desc"+descuentoTotal);
        suma=suma-descuentoTotal;
        //alert("suma-descuentoTotal"+suma);
        resIva=suma*ivaM;
        //alert("resIva"+resIva);
        //totalIva=suma-resIva;
        totalSuma=suma+resIva;
        //alert(totalSuma);
      $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(resIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(resIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       }else if($("#des").is(':checked')){
        //alert("descuento");
        //alert(sumaDescuento);
        suma2=suma;
        //alert(suma2);
        suma=suma-sumaDescuento;
        //alert(suma);
        descuentoTotal=suma*valorDescuento;
        //alert(descuentoTotal);
        descuentoTotal=descuentoTotal/100;
        //alert(descuentoTotal);
        totalSuma=suma-descuentoTotal;
        //alert(totalSuma);
      $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(totalIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(totalIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       } else if(iva==1){
        
        //alert("iva");
        suma2=suma;
        
        suma=suma-sumaDescuento;
        //alert(suma);
        resIva=suma*ivaM;
        //alert(resIva);
        totalSuma=suma+resIva;
        //alert(totalSuma);
     $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(resIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(resIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
      
       }else{
        //alert("nada");
        suma2=suma;
        
        suma=suma-sumaDescuento;
         totalSuma=suma;
     $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(totalIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(totalIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       }  
  }  

  function eliminararticulo(x){
      eliminar=x;
      $( "tr" ).remove('#'+eliminar+'');
      array.listArt.splice('#'+eliminar, 1);
       total[x]='';
       ArtArreglo[x]='';
        calculoTotalDos();
      /*$("#arreglo").append('eliminar');
      impArrglo();
      */
  }

  function SaveEntrada()
  {
   //var url;
  //Recojemos datos del formulario para su envio
    var fechaSoliMos = $("#fechaSoliMos").val();//
    var noEnt = $("#noEnt").val();//
    var Solifec = $("#Solifec").val();//
    var idUser = $("#idUser").val();//
    
    var motivo = $("#motivo").val();//
    var subtotal = $("#subtotal").val();//
    var descuentoTotal = $("#descuentoTotal").val();//
    var ivacantidad = $("#ivacantidad").val();//
    var totalG = $("#total").val();//

    var NombreArt = $("#NombreArt").val();
    var idArt = $("#idArt").val();
    var UnidadArt = $("#UnidadArt").val();
    var DescuentoArt = $("#DescuentoArt").val();
    var fechaCad = $("#fechaCad").val();
    var costoArt = $("#costoArt").val();
    var cantidadArt = $("#cantidadArt").val();
    var importeArt = $("#importeArt").val();
       //convertimos el arreglo en JSON
            arregloJson=JSON.stringify(array);
            arre = JSON.parse(arregloJson);
              var parametros = {
              "fechaSoliMos":fechaSoliMos,
              "noEnt":noEnt,
              "Solifec":Solifec,
              "idUser":idUser,
              "motivo":motivo,
              "subtotal":subtotal,
              "descuentoTotal":descuentoTotal,
              "ivacantidad":ivacantidad,
              "total":totalG,
              "arreglo" : arre //Aquí enviamos el arreglo con las habitaciones
              };
          $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudentradas/agregaEntrada/",
            type: "POST",
            data: parametros,  
            dataType: "HTML",
            success: function(data)
           {
             //swal({   title: "Registrado!",   text: "Compra registrada exitosamente.",   type: "success",   confirmButtonText: "Cerrar", confirmButtonColor: "#e1bd85" });
              //  alert(data)
                swal({
                  title: "Éxito ",
                  text: "Entrada registrada exitosamente.",
                  type: "success",
                  
                  confirmButtonText: "Aceptar",
                 
                },
                function(){
                  
                  location.href='http://localhost/CDI/Panel/index.php/Crudentradas';
                });          
           },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
                });
            
 }
  