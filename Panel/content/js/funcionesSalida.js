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
          url : "http://localhost/CDI/Panel/index.php/Crudsalida/traerIdSalida/",
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
                  $("#noSal").val(o+data[i]['idSalida']);
                  $("#noSalida").val(o+data[i]['idSalida']);
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
function articuloSSS () {
   if ($("#motivo").val()!='') {
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

      }
      function  obtenerFechasCaducidad(idArticulo ){
      $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudsalida/obtenerFcA/",
              dataType:"json",
              data:{idArt:idArticulo},
              success:function(data) {
              //  prueba=obtenerSiLLevaCaducidad(idArticulo);
               if(data==null)
               {
                
                 $('#fCaducidad').html('');
                 $('#fCaducidad').append('<option value="no">No existen datos</option>'); 
               }
               else
               {
                  $('#fCaducidad').html('');
                  $('#fCaducidad').append('<option value="no">No habilitada</option>');         
                  $.each(data, function(i,item){
                            fecha=data[i].fechaCaducidad;
                            idCompra=data[i].idcompraArticulo;
                             if (fecha=="0000-00-00")
                     {
                        fecha="";
                     }
                            $('#fCaducidad').append('<option value="'+idCompra+'">'+fecha+' Cantidad '+data[i].cantidadArt+'</option>');     
                         })
               }

              }
            });
}

function  obtenerFechasEntradaCaducidad(idArticulo ){
      //alert("idArticulo"+idArticulo);
      $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudsalida/obtenerFcAEntrada/",
              dataType:"json",
              data:{idArt:idArticulo},
              success:function(data) {

                if(data==null)
               {
                  $('#fCaducidadEntrada').html('');
                  $('#fCaducidadEntrada').append('<option value="no">No existen datos</option>');
               }
               else
               {
                  $('#fCaducidadEntrada').html('');
                  $('#fCaducidadEntrada').append('<option value="no">No habilitada</option>');           
                  $.each(data, function(i,item){
                          //alert(data[i].fechaCaducidad); 
                          fecha=data[i].fechaCaducidad;
                          idEntrada=data[i].idEntradaArticulo;
                          if (fecha=="0000-00-00")
                     {
                        fecha="";
                     }
                           
                              $('#fCaducidadEntrada').append('<option value="'+idEntrada+'">'+fecha+' Cantidad '+data[i].cantidadArt+'</option>');   
                            
                          
                          //document.write("<br>"+i+" - "+miJSON[i].valor+" - "+miJSON[i].color+" - "+miJSON[i].caracteristica.tipo+" - "+miJSON[i].caracteristica.ref);
                       })
               }
                
               // alert("desde php"+data);
              }
            });
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
  
 /* */

  function traerMinimo()
  {
    var idArticulo = $("#idArt").val();
    var fCaducidad = $("#fCaducidad").val();
    var fCaducidadEntrada= $("#fCaducidadEntrada").val();
    var cantidadAr= $("#cantidadArt").val();
    var table=document.getElementById("listaArticulo");
    var numFilasTabla=table.rows.length;
    var nomArticulo= $("#NombreArt").val();
//alert(fCaducidad + fCaducidadEntrada)
var datos = {
                "idArticulo" :idArticulo,
                 "fCaducidad" :fCaducidad,
                 "fCaducidadEntrada" :fCaducidadEntrada,
                  "cantidadAr" :cantidadAr    
        };
         if(fCaducidad!="no" && fCaducidadEntrada!="no" ){  
             $("#mensajeUno").html('Solo puedes escojer una fecha de caducidad');
             $("#mensajeUno").fadeIn();   
            }
              else{ //caduciada ambas
                  if(fCaducidad=="no" && fCaducidadEntrada=="no")
                  {
                       swal("ERROR", "Debes al menos seleccionar una fecha de caducidad", "error")
                      //$("#mensajeUno").html('Debes al menos seleccionar una fecha de caducidad');
                      //$("#mensajeUno").fadeIn();        
                  }else {

                    $.ajax({
                data:  datos,
                url : "http://localhost/CDI/Panel/index.php/Crudsalida/traerValidacionMinimo/",
               // url:   'traerValidacionMinimo.php',
                type:  'post',
                dataType: "JSON",
                success:  function (response) {
                     
                      //alert(response)
                       if(response.length > 0)
                    {
                        for(i=0; i<response.length; i++)
                      {
                            var ante = response[i]["existenciaAnterior"];
                            var total=parseInt(ante) - parseInt(cantidadAr);    
                            var totalAnterior=response[i]["existenciaAnterior"];
                            var idControl=response[i]["idcompraArticulo"];    
                             var idArticuloMinimo=response[i]["idArticulo"];    
                             
                            //alert(idControl)           
                      }
                    }
                   //alert("anterior "+ante+" cantiad sacada"+cantidadAr+" total "+total);
                    if (total>=0 )
                     {
                       
                        if(numFilasTabla>0)
                        {
                          
                          for(i=0;i<numFilasTabla; i++)
                          {
                             var prueba=jQuery.inArray(idArticulo,ArtArreglo );
                                //nomEnTabla=table.rows[i].cells[3].innerHTML;
                                nomEnTabla=$("#NombreArt"+i).val();
                                idIndetificador=$("#idControl"+i).val();
                                  //alert(idIndetificador);
                                   var pruebasss=jQuery.inArray(idControl,ArtArreglo );
                                  // alert(pruebasss+" nom"+nomArticulo+" = "+nomEnTabla)
                                if(nomArticulo==nomEnTabla)
                                {
                                  cantidadTable=table.rows[i].cells[0].innerHTML;
                                  
                                    cantidadTotalASacar=parseInt(cantidadTable)+parseInt(cantidadAr);
                                   
                                   //alert("tabla "+numFilasTabla+" contador "+o);
                                   
                                   if(totalAnterior<cantidadTotalASacar &&  pruebasss ==0)
                                   {
                                     swal("ERROR", "Existencia agotada en el almacen para este artículo", "error")
                                      //$("#mensajeUno").html('Existencia agotada en el almacen para este artículo');
                                    //$("#mensajeUno").fadeIn();   
                                   }
                                   else if (pruebasss == -1 )
                                   {  
                                    
                                      agregarArticuloLista(idControl);
                                   }
                                   else if (totalAnterior<=cantidadTotalASacar &&  pruebasss > -1 )
                                   {  
                                    $("#mensajeUno").html('ya ha sido agregado');
                                    $("#mensajeUno").fadeIn();  
                                     
                                   }
                                  //cantidadAri
                                }else{
                                    cantidadTable=table.rows[i].cells[0].innerHTML;
                                  
                                    cantidadTotalASacar=parseInt(cantidadTable)+parseInt(cantidadAr);
                                   
                                   //alert("tabla "+numFilasTabla+" contador "+o);
                                   
                                   if(totalAnterior<cantidadTotalASacar &&  pruebasss ==0)
                                   {
                                     swal("ERROR", "Existencia agotada en el almacen para este artículo", "error")
                                      //$("#mensajeUno").html('Existencia agotada en el almacen para este artículo');
                                    //$("#mensajeUno").fadeIn();   
                                   }
                                   else if (pruebasss == -1 )
                                   {  
                                   // alert("pruebasss");
                                      agregarArticuloLista(idControl);
                                   }

                                }
                            

                          }
                        }
                        else
                        {
                           agregarArticuloLista(idControl);
                        }
                     
                     } else {
                      swal("ERROR", "La cantidad excede la existencia actual de ese producto", "error")
                     // $("#mensajeUno").html('La cantidad excede la existencia actual de ese producto');
                     // $("#mensajeUno").fadeIn();   
                      
                     }   
                           
                }
        });
                  }
                }

  }

  function agregarArticuloLista(idControl){
      //impArrglo();
      var fCaducidad = $("#fCaducidad").val();
      var fCaducidadEntrada= $("#fCaducidadEntrada").val();
      if (fCaducidad!="no")
         {
            var fechId=fCaducidad;
            var Ident="1";//compra
         }else if(fCaducidadEntrada!="no"){
            var fechId=fCaducidadEntrada;
            var Ident="2";//entrada
         }
         //alert("fecha "+fechId)

      var idControl=idControl;
      var nomArticulo = $("#NombreArt").val();
      var idArticulo = $("#idArt").val();
      var unidad = $("#UnidadArt").val();
      
      var costoAr = parseFloat($("#costoArt").val());
      var costoArOculto = parseFloat ($("#costoArOculto").val());
      var cantidadAr = $("#cantidadArt").val();
      var existencia = $("#existencia").val();
      var importeAr = $("#importeArt").val();
      var desArt=$("#descuentoArt").val();
      var fCaducidad = $("#fCaducidad").val();
      var fCaducidadEntrada= $("#fCaducidadEntrada").val();

      var caducidadSeleccionada = $("#fCaducidad option:selected").html(); //selecciono el texto para mandarlo a la tabla
      var caducidadSeleccionadaEntrada = $("#fCaducidadEntrada option:selected").html();

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
      var descuentoTotalArt=0;
      $.trim(existencia);
      existencia=parseInt(existencia);
      costoArDos=costoAr*cantidadAr;
      descuentoTotalArt=costoArDos*desArt;
      descuentoTotalArt=descuentoTotalArt/100;
      //alert(descuentoTotalArt);
      importe=costoArDos-descuentoTotalArt;

      var statusCantidadCaducidad=0;

       if (nomArticulo != '') { //verifica si hay un sucursal escogido 
        var prueba=jQuery.inArray(idArticulo,ArtArreglo );
          if (cantidadAr <= existencia && prueba == -1 || prueba > -1) {
           if(fCaducidad=="no_datos" && fCaducidadEntrada=="no_datos"  )
           {    
                  $.each(total,function(index,value){
                  if(value == ''){

                          x=index;
                           
                              valorMostrar=$("#fCaducidadEntrada option:selected").html();
                              valorValue= fCaducidadEntrada;
                              tipoCaducidad="sin";
                             // alert("entra"+existencia)
    array.listArt.push({ 'fechId':fechId,'Ident':Ident,'tipoCaducidad':tipoCaducidad,'idArticulo': idArticulo,'cantidadA': cantidadArt, 'unidadA': UnidadArt, 'nomArt':NombreArt, 'costoAr':costoArt,'importArt':importeArt,'existencia':existencia});
                              $("#listaArticulo").append('<tr id='+x+'><td>'+cantidadAr+'</td><td>'+unidad+'</td><td>'+valorMostrar+'</td><td>'+nomArticulo+
                          '<input type="hidden" value="'+cantidadAr+'" name="cantidadAr'+x+'" id="cantidadAr'+x+
                          '"/><input type="hidden" value="'+idControl+'" name="idControl'+x+'" id="idControl'+x+
                          '"/><input type="hidden" value="'+nomArticulo+'" name="nomArticulo'+x+'" id="nomArticulo'+x+
                          '"/><input type="hidden" value="'+unidad+'" name="unidad'+x+'" id="unidad'+x+
                          '"/><input type="hidden" value="'+costoAr+'" name="costoAr'+x+'" id="costoAr'+x+
                          '"/><input type="hidden" value="'+idArticulo+'" name="idArticulo'+x+'" id="idArticulo'+x+
                          '"/><input type="hidden" value="'+valorValue+'" name="fCaducidad'+x+'" id="fCaducidad'+x+
                          '"/><input type="hidden" value="'+tipoCaducidad+'" name="tipoCaducidad'+x+'" id="tipoCaducidad'+x+
                          '"/></td><td>'+costoAr+'</td><td>'+costoArDos.toFixed(2)+'</td><td align=center><a href="javascript:eliminararticulo('+x+');">Eliminar</a></td></tr>');
                            calculoTotal(costoArDos,x,idArticulo,idControl);
                                  //$("#arreglo").append('Artagregado');
                           // impArrglo();
                           limpiarCamArticulo();
                            return false;

                  } //fin if value
            });//fin each value
           }else{
            if(fCaducidad!="no" && fCaducidadEntrada!="no" ){  
             $("#mensajeUno").html('Solo puedes escojer una fecha de caducidad');
             $("#mensajeUno").fadeIn();   
            }
              else{ //caduciada ambas
                  if(fCaducidad=="no" && fCaducidadEntrada=="no")
                  {
                      $("#mensajeUno").html('Debes al menos seleccionar una fecha de caducidad');
                      $("#mensajeUno").fadeIn();        
                  }
                  else{//caducidad ambas no
                  $.each(total,function(index,value){
                  if(value == ''){

                          x=index;
                            if(fCaducidad=="no")
                            {
                              valorMostrar=$("#fCaducidadEntrada option:selected").html();
                              valorValue= fCaducidadEntrada;
                              tipoCaducidad="entrada";
                            }
                            if(fCaducidadEntrada=="no")
                            {
                              valorMostrar=$("#fCaducidad option:selected").html();
                              valorValue= fCaducidad;
                              tipoCaducidad="compra";
                            }
                            //alert("datos"+tipoCaducidad)
                            // alert("entra"+existencia)
                            array.listArt.push({ 'fechId':fechId,'Ident':Ident,'tipoCaducidad':tipoCaducidad,'idArticulo': idArticulo,'cantidadA': cantidadArt, 'unidadA': UnidadArt, 'nomArt':NombreArt, 'costoAr':costoArt,'importArt':importeArt,'existencia':existencia});
                         $("#listaArticulo").append('<tr id='+x+'><td>'+cantidadAr+'</td><td>'+unidad+'</td><td>'+valorMostrar+'</td><td>'+nomArticulo+
                          '<input type="hidden" value="'+cantidadAr+'" name="cantidadAr'+x+'" id="cantidadAr'+x+
                          '"/><input type="hidden" value="'+idControl+'" name="idControl'+x+'" id="idControl'+x+
                          '"/><input type="hidden" value="'+nomArticulo+'" name="nomArticulo'+x+'" id="nomArticulo'+x+
                          '"/><input type="hidden" value="'+unidad+'" name="unidad'+x+'" id="unidad'+x+
                          '"/><input type="hidden" value="'+costoAr+'" name="costoAr'+x+'" id="costoAr'+x+
                          '"/><input type="hidden" value="'+idArticulo+'" name="idArticulo'+x+'" id="idArticulo'+x+
                          '"/><input type="hidden" value="'+valorValue+'" name="fCaducidad'+x+'" id="fCaducidad'+x+
                          '"/><input type="hidden" value="'+tipoCaducidad+'" name="tipoCaducidad'+x+'" id="tipoCaducidad'+x+
                          '"/></td><td>'+costoAr+'</td><td>'+costoArDos.toFixed(2)+'</td><td align=center><a href="javascript:eliminararticulo('+x+');">Eliminar</a></td></tr>');
                            calculoTotal(costoArDos,x,idArticulo,idControl);
                                  //$("#arreglo").append('Artagregado');
                           // impArrglo();
                           limpiarCamArticulo();
                            return false;

                  } //fin if value
            });//fin each value
             } //fin else ambas caducidad no
             } //fin else caducidad ambas
           }
      }else{
        if (cantidadAr > existencia && prueba > -1) {
         $("#mensajeUno").html('Sobrepasas la existencia de este articulo que es '+existencia+' al querer dar salida '+cantidadAr+' El articulo ya ha sido agregado a la lista');
         $("#mensajeUno").fadeIn();
        }else if(cantidadAr > existencia){
          $("#mensajeUno").html('Sobrepasas la existencia de este articulo que es '+existencia+' al querer dar salida '+cantidadAr+' ');
         $("#mensajeUno").fadeIn();
        }
      }

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
       total[x]='';
       ArtArreglo[x]='';
        calculoTotalDos();
      /*$("#arreglo").append('eliminar');
      impArrglo();
      */
  }

  function SaveSalida()
  {
   //var url;
  //Recojemos datos del formulario para su envio
    var fechaSoliMos = $("#fechaSoliMos").val();//
    var noSal = $("#noSal").val();//
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
              "noSal":noSal,
              "Solifec":Solifec,
              "idUser":idUser,
              "motivo":motivo,
              "subtotal":subtotal,
              "descuentoTotal":descuentoTotal,
              "ivacantidad":ivacantidad,
              "total":totalG,
              "arreglo" : arre //Aquí enviamos el arreglo con las habitaciones
              };
               if (arregloJson!='{"listArt":[]}')
        {
          
        
          $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudsalida/agregaSalida/",
            type: "POST",
            data: parametros,  
            dataType: "HTML",
            success: function(data)
           {
             //swal({   title: "Registrado!",   text: "Compra registrada exitosamente.",   type: "success",   confirmButtonText: "Cerrar", confirmButtonColor: "#e1bd85" });
                swal({
                  title: "Éxito ",
                  text: "Salida registrada exitosamente.",
                  type: "success",
                  //showCancelButton: true,
                  //confirmButtonClass: "btn-danger",
                  confirmButtonText: "Aceptar",
                  //closeOnConfirm: false
                },
                function(){
                  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  location.href='http://localhost/CDI/Panel/index.php/Crudsalida';
                });           
           },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
                });

         }else{
          swal("AVISO", "Agregue artículo’s", "warning");
        }   
 }
  