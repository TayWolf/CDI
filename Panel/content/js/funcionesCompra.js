var total = new Array(100);
for(var i=0; i<total.length; i++){
      total[i]='';
}
var totaliv = new Array(100);
for(var i=0; i<totaliv.length; i++){
      totaliv[i]='';
}
var descuentoArtArreglo = new Array(100);
for(var c=0; c<descuentoArtArreglo.length; c++){
      descuentoArtArreglo[c]='';
      }
var ArtArreglo = new Array(100);
for(var b=0; b<ArtArreglo.length; b++){
      ArtArreglo[b]='';
      }  

function vDescuento()
{
    var acepD=$("#descAc").val();
    if ($('#descAc').prop('checked')) {
             $("#cantidadDes").show();   
        }else{
            $("#cantidadDes").hide();  
            $("#cantidadDes").val(""); 
        }
}
 var array = {
    'listArt': []             
  };
   var arregloJson;

window.onload=nCompra;
function nCompra(){
    botones();
    $("#ivaSi").on("click",calculoTotalDos);
    $("#ivaNo").on("click",calculoTotalDos);
        $.ajax({
          url : "http://localhost/CDI/Panel/index.php/Crudcompras/traerIdCompra/",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          { 
              var f = new Date();
             var o = (f.getDate() + "" + (f.getMonth() +1) + "" + f.getFullYear()+"CDI");
              if (data.length>0)
               {
                for(i=0;i<data.length;i++)
                {
                  $("#noCompra").val(o+data[i]['idCompra']);
                  $("#noPedido").val(o+data[i]['idCompra']);
                }
               }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
    }

// function botones () {
//   $("#NombreArt").on("focus",articulo);
// }

function articulos () {

   if ($("#idProve").val()!='') {
    
              var idPro=$("#idProve").val();
             $("#NombreArt").autocomplete({
          source:function(request,response) {
            $.ajax({
              url : "http://localhost/CDI/Panel/index.php/Crudcompras/traerArt/",
              dataType:"json",
              data:{q:request.term,idProve:idPro},
              success:function(data) {
                response(data);
              }
            });
          },
          minLength:1,
          select:function(event,ui) {
            $("#idArt").val(ui.item.idArticulo);
            $("#UnidadArt").val(ui.item.medida);
            $("#costoArt").val(ui.item.costo_unitario);
            $("#costoArOculto").val(ui.item.costo_unitario);
            $("#existencia").val(ui.item.existencia);
            $("#cantidadArt").val(1);
            calImporte();
            }
         });
          }else{
            $("#mensajeUno").html('Es necesario escoger un proveedor');
            $("#mensajeUno").fadeIn();
          }
}

function calculoFecha(){
      var fechaR = $("#fechaSoliCom").val();
      var cantidadPagosF = $("#cantidadPagos").val();
      var diasPagoF = $("#diasPago").val();
      var fechaEn=fechaR.split("-");
      var ano=fechaEn[0];
      var mes=fechaEn[1];
      var dia=fechaEn[2];
      var signo="/";
      var signoDos="+";
      var diasP=cantidadPagosF*diasPagoF;
      var intervalo=signoDos+diasP;
      fecha=dia+signo+mes+signo+ano;
      if (validaFecha(fecha)) {
        if (validaIntervalo(intervalo)) {
          var newFecha=nuevaFecha(fecha,intervalo);
        }
      }
      var fechaLimitePagoCon=newFecha.split("/");
      var fechaL=fechaLimitePagoCon[2]+signo+fechaLimitePagoCon[1]+signo+fechaLimitePagoCon[0];
      $("#fechaLimitePago").val(fechaL);
      $("#fechaLimiteDos").val(newFecha);
  }

function muestradatosProve()
{
  var NotaC =$("#NotaC").val();
  var FactC =$("#FactC").val();
  var formPago =$("#formPago").val();
  var tiPago =$("#tiPago").val();
  if ((NotaC!="" || FactC!="") && formPago!="" && tiPago!="" )
   {
    $("#muestraProve").show();  
      jQuery('html, body').animate({
        scrollTop: jQuery('#muestraProve').position().top
                },1000);
   }
}

function muestraarrt()
{
  $("#datosArtmuestra").show();  
    jQuery('html, body').animate({
      scrollTop: jQuery('#datosArtmuestra').position().top
      },1000);
}

function verificarImpor()
{
  var idArticulo = $("#idArt").val();
  var costoAr = parseFloat ($("#costoArt").val());
   $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcompras/verificarI/"+idArticulo,
            type: "POST",
           // data: parametros,  
            dataType: "json",
            success: function(data)
           {
                  var nombreAr=data.nombre;
                 //alert(data.costo_unitario+" ="+costoAr)  
                 if (data.costo_unitario==costoAr)
                  {
                    agregarArticuloLista();
                  } else{
                    swal({
                        title: "Alto",
                        text: "Por favor ingrese contraseña para poder alterar el nombre del artículo.",
                        type: "input",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        inputPlaceholder: "Password"
                      }, function (inputValue) {
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                          swal.showInputError("Ingrese la contraseña.");
                          return false
                        }
                        var clave =inputValue;
                          $.ajax({
                              url : "http://localhost/CDI/Panel/index.php/Crudcompras/CompararClave/"+clave,
                              type: "GET",
                              dataType: "json",
                              success: function(data)
                              { 
                                
                                if (data.length>0)
                                 {
                                  swal("Éxito", "el importe del artículo  " + nombreAr+" se ha alterado.", "success"); 
                                  agregarArticuloLista();
                                 }else{
                                    swal("Error!", "Contraseña incorrecta", "error")
                                 }

                                 //
                              },
                              error: function (jqXHR, textStatus, errorThrown)
                              {
                                  alert('Error get data from ajax');
                              }
                          });
                        
                      });
                  }   
           },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
    });

}

function agregarArticuloLista(){
      var nomArticulo = $("#NombreArt").val();
      var idArticulo = $("#idArt").val();
      var unidad = $("#UnidadArt").val();
      var fCaducidad = $("#fechaCad").val();
      var costoAr = parseFloat ($("#costoArt").val());
      var costoArOculto = parseFloat ($("#costoArOculto").val());
      var cantidadAr = $("#cantidadArt").val();
      var importeAr = $("#importeArt").val();
      var desArt=$("#DescuentoArt").val();
      var existencia=$("#existencia").val();
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
      if (costoAr==costoArOculto) {
        costoPromedio=costoAr;
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
      costoArDos=costoAr*cantidadAr;
      descuentoTotalArt=costoArDos*desArt;
      descuentoTotalArt=descuentoTotalArt/100;
      costoArDes=costoArDos-descuentoTotalArt;
      idArticulo=parseInt(idArticulo);
       var ivvv=0;
        if( $('#subivaSi').is(':checked') ) {
        var iv=1;
         ivvv=costoArDes*.16;
          }
       if (nomArticulo != '') { //verifica si hay un proveedor escogido
        var prueba=jQuery.inArray(idArticulo,ArtArreglo );      
      $.each(total,function(index,value){
            if(value == ''){
                  x=index;
        array.listArt.push({ 'idArticulo': idArticulo,'cantidadA': cantidadArt, 'unidadA': UnidadArt, 'caducidadA': fechaCad, 'nomArt':NombreArt, 'descuentoAr':DescuentoArt,  'costoAr':costoArt,'importArt':importeArt,'existencia':existencia,'costoArDes':costoArDes,'ivvv':ivvv});
        $("#listaArticulo").append('<tr id='+x+'><td>'+cantidadAr+'</td><td>'+unidad+'</td><td>'+fCaducidad+'</td><td>'+nomArticulo+'<input type="hidden" value="'+cantidadAr+'" name="cantidadAr'+x+'" id="cantidadAr'+x+'"/><input type="hidden" value="'+existencia+'" name="existencia'+x+'" id="existencia'+x+'"/><input type="hidden" value="'+nomArticulo+'" name="nomArticulo'+x+'" id="nomArticulo'+x+'"/><input type="hidden" value="'+unidad+'" name="unidad'+x+'" id="unidad'+x+'"/><input type="hidden" value="'+costoAr+'" name="costoAr'+x+'" id="costoAr'+x+'"/><input type="hidden" value="'+costoPromedio+'" name="costoPromedio'+x+'" id="costoPromedio'+x+'"/><input type="hidden" value="'+idArticulo+'" name="idArticulo'+x+'" id="idArticulo'+x+'"/><input type="hidden" value="'+fCaducidad+'" name="fCaducidad'+x+'" id="fCaducidad'+x+'"/><input type="hidden" value="'+desArt+'" name="desArt'+x+'" id="desArt'+x+'"/><input type="hidden" value="'+costoArDes+'" name="costodes'+x+'" id="costodes'+x+'"/></td><td>'+desArt+' % </td><td>'+costoAr+'</td><td >'+costoArDes.toFixed(2)+'</td><td>'+ivvv+'</td><td align=center><a href="javascript:eliminararticulo('+x+');">Eliminar</a></td></tr>');
            calculoTotal(costoArDos,x,descuentoTotalArt,idArticulo,ivvv);
           $("#tablaAgregar").show();  
              jQuery('html, body').animate({
                scrollTop: jQuery('#tablaAgregar').position().top
                },1000);
           limpiarCamArticulo();
            return false;
            }
      });
      }
  }
  function esBisiesto(anio) {
    return ((anio % 4 == 0 && anio % 100 != 0) || anio % 400 == 0) ? true : false;
}

  function validaFecha(fecha) {
    var arreglo = fecha.split("/");
    if (arreglo.length != 3)
        return false;
 
    if (!parseInt(arreglo[0]) || !parseInt(arreglo[1]) || !parseInt(arreglo[2]))
        return false;
 
    var dia = parseInt(arreglo[0]);
    var mes = parseInt(arreglo[1]);
    var anio = parseInt(arreglo[2]);
    if (dia < 1 || dia > 31 || mes < 1 || mes > 12 || anio < 1)
        return false;
 
    switch (mes) {
        case 4:
        case 6:
        case 9:
        case 11:
            if (dia > 30)
                return false;
            break;
        case 2:
            if (esBisiesto(anio)) {
                if (dia > 29)
                    return false;
            }
            else {
                if (dia > 28)
                    return false;
            }
    }
    return true;
}
function validaIntervalo(intervalo) {
    var primero = intervalo.substring(0, 1);
    var valor = intervalo.substring(1, intervalo.length);
    if (primero != "+" && primero != "-")
        return false;
    if (!parseInt(valor))
        return false;
    return true;
}

function nuevaFecha(fecha, intervalo) {
    var arrayFecha = fecha.split('/');
    var interv = intervalo.substring(1, intervalo.length);
    var operacion = intervalo.substring(0, 1);
    var dia = arrayFecha[0];
    var mes = arrayFecha[1];
    var anio = arrayFecha[2];
    var fechaInicial = new Date(anio, mes - 1, dia);
    var fechaFinal = fechaInicial;
    if (operacion == "+")
        fechaFinal.setDate(fechaInicial.getDate() + parseInt(intervalo));
    else
        fechaFinal.setDate(fechaInicial.getDate() - parseInt(intervalo));
    dia = fechaFinal.getDate();
    mes = fechaFinal.getMonth() + 1;
    anio = fechaFinal.getFullYear();
    dia = (dia.toString().length == 1) ? "0" + dia.toString() : dia;
    mes = (mes.toString().length == 1) ? "0" + mes.toString() : mes;
    return dia + "/" + mes + "/" + anio;
}

  function limpiarCamArticulo () {
      var dato1='';
      $("#NombreArt").val(dato1);
      $("#idArt").val(dato1);
      $("#UnidadArt").val(dato1);
      $("#DescuentoArt").val(dato1);
      $("#fechaCad").val(dato1);
      $("#costoArt").val(dato1);
      $("#costoArOculto").val(dato1);
      $("#cantidadArt").val(dato1);
      $("#importeArt").val(dato1);
      $("#nomArticulo").focus();
  }

 function eliminararticulo(x){
      eliminar=x;
      $( "tr" ).remove('#'+eliminar+'');
      array.listArt.splice('#'+eliminar, 1);
       total[x]='';
       descuentoArtArreglo[x]='';
       totaliv[x]='';
       ArtArreglo[x]='';
        calculoTotalDos();
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
      var subtotalito=0;
       var iva=$('input:radio[name=gender]:checked').val()
      for (var i=0; i<total.length; i++) {
            if (total[i]!='') {
            suma += (total[i]);
      }
      };
     for (var c=0; c<descuentoArtArreglo.length; c++) {
            if (descuentoArtArreglo[c]!='') {
            sumaDescuento += parseFloat(descuentoArtArreglo[c]);
      }
      };
      for (var v=0; v<totaliv.length; v++) {
            if (totaliv[v]!='') {
            totalIva += parseFloat(totaliv[v]);
      }
      };
        suma2=suma;
        subtotalito=suma-sumaDescuento;
        suma=suma-sumaDescuento;
        suma=suma+totalIva;
         totalSuma=suma;
     $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(totalIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#subtotalitoDos").val(subtotalito.toFixed(2));
      $("#ivacantidadDos").val(totalIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
  }

  function calculoTotal(costoAr,x,descuentoTotalArt,idArt,iv){
      total[x]=costoAr;
      totaliv[x]=iv;
      descuentoArtArreglo[x]=descuentoTotalArt;
      ArtArreglo[x]=idArt;
      var totalIva=0;
       var totalSuma=0;
       var resIva=0;
       var suma=0;
       var sumaDescuento=0;
       var valorDescuento=$("#descuento").val();
       var descuentoTotal=0;
       var suma2=0;
       var ivaM=0.16;
       var ivasolo=0;
       var subtotalito=0;
       var iva=$('input:radio[name=gender]:checked').val()
      for (var e=0; e<totaliv.length; e++) {
            if (totaliv[e]!=0) {
            ivasolo += (totaliv[e]);
            $("#ivacantidadDos").val(ivasolo.toFixed(2));
            $("#ivacantidad").val(ivasolo.toFixed(2));
        }else{
           $("#ivacantidadDos").val(ivasolo.toFixed(2));
            $("#ivacantidad").val(ivasolo.toFixed(2));
        }
      };
      for (var i=0; i<total.length; i++) {
            if (total[i]!='') {
            suma += (total[i]);  
        }
      };
      for (var c=0; c<descuentoArtArreglo.length; c++) {
            if (descuentoArtArreglo[c]!='') {
            sumaDescuento += parseFloat(descuentoArtArreglo[c]);
      }
      };
      for (var v=0; v<totaliv.length; v++) {
            if (totaliv[v]!='') {
            totalIva += parseFloat(totaliv[v]);
      }
      };
     if($("#des").is(':checked') && iva==1){
        suma2=suma;
        suma=suma-sumaDescuento;
        descuentoTotal=suma*valorDescuento;
        descuentoTotal=descuentoTotal/100;
        suma=suma-descuentoTotal;
        resIva=suma*ivaM;
        totalSuma=suma+resIva;
      $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(resIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(resIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       }else if($("#des").is(':checked')){
        suma2=suma;
        suma=suma-sumaDescuento;
        descuentoTotal=suma*valorDescuento;
        descuentoTotal=descuentoTotal/100;
        totalSuma=suma-descuentoTotal;
      $("#subtotal").val(suma2.toFixed(2));
      $("#ivacantidad").val(totalIva.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#ivacantidadDos").val(totalIva.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       } else if(iva==1){
        suma2=suma;
        suma=suma-sumaDescuento;
        resIva=suma*ivaM;
        var subIsi=$("#subivaSi").val();
        var subivaNo=$("#subivaNo").val();
        totalSuma=suma+ivasolo;
     $("#subtotal").val(suma2.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       }else{
        suma2=suma;
        suma=suma-sumaDescuento;
        subtotalito = suma;
        suma=suma+totalIva;
         totalSuma=suma;
     $("#subtotal").val(suma2.toFixed(2));
      $("#descuentoTotalDos").val(sumaDescuento.toFixed(2));
      $("#total").val(totalSuma.toFixed(2));
      $("#subtotalDos").val(suma2.toFixed(2));
      $("#subtotalitoDos").val(subtotalito.toFixed(2));
      $("#descuentoTotal").val(sumaDescuento.toFixed(2));
      $("#totalDos").val(totalSuma.toFixed(2));
       }  
  }

function calImporte () {
            var can=$("#cantidadArt").val(),cos=$("#costoArt").val(),imp;
            var des=$("#DescuentoArt").val();
            parseFloat(des);
            imp=parseFloat(cos)*parseFloat(can);
            parseFloat(imp);
            if(des!='')
            {
              var calDes=imp*des;
              calDes=calDes/100;
              imp=imp-calDes;
            }
           $("#importeArt").val(imp.toFixed(2)); 
          }

function muestraDCre()
{
  var tiPago=$("#tiPago").val();
  if (tiPago==1)
   {
    $("#muestraDaCredito").show();   
   }else{
    $("#muestraDaCredito").hide();   
   }
}

    function SaveSol()
  {
    var fechaSoliCom = $("#fechaSoliCom").val();//
    var noCompra = $("#noCompra").val();//
    var HoyFec = $("#HoyFec").val();//
    var idUser = $("#idUser").val();//
    var FactC = $("#FactC").val();//
    var NotaC = $("#NotaC").val();//
    var idProve = $("#idProve").val();//
    var tiPago = $("#tiPago").val();//
    var formPago = $("#formPago").val();//
    var diasPago = $("#diasPago").val();//
    var cantidadPagos = $("#cantidadPagos").val();
    var fechaLimiteDos = $("#fechaLimiteDos").val();//
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
    var OrdeComp = $("#OrdeComp").val();
    var subtotalitoDos = $("#subtotalitoDos").val();
            arregloJson=JSON.stringify(array);
            arre = JSON.parse(arregloJson);
              var parametros = {
              "fechaSoliCom":fechaSoliCom,
              "noCompra":noCompra,
              "HoyFec":HoyFec,
              "idUser":idUser,
              "FactC":FactC,
              "NotaC":NotaC,
              "OrdeComp":OrdeComp,
              "idProve":idProve,
              "tiPago":tiPago,
              "formPago":formPago,
              "cantidadPagos":cantidadPagos,
              "diasPago":diasPago,
              "fechaLimiteDos":fechaLimiteDos,
              "subtotal":subtotal,
              "descuentoTotal":descuentoTotal,
              "ivacantidad":ivacantidad,
              "total":totalG,
              "subtotalitoDos":subtotalitoDos,
              "arreglo" : arre //Aquí enviamos el arreglo con las habitaciones
              };
        if (OrdeComp!="" && (NotaC!="" || FactC!="" ) && formPago!="" && tiPago!="" )
          {    
          $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcompras/agregaCompra/",
            type: "POST",
            data: parametros,  
            dataType: "HTML",
            success: function(data)
           {
                swal({
                  title: "Éxito ",
                  text: "Compra registrada exitosamente.",
                  type: "success",
                  confirmButtonText: "Aceptar",
                },
                function(){
                  location.href='http://localhost/CDI/Panel/index.php/Crudcompras';
                });           
           },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
                });
        }else
        {
          swal("Aviso", "Por favor complete los campos", "warning")
        }  
 }

 function filtroListoCompra()
 {
  var feIni =$("#feIniC").val();
  var feFin =$("#feFinC").val();
  $("#listaCompras").html("");
  if (feIni!="" && feFin!="" ) 
    {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcompras/traerlistaCompraFilt/"+feIni+"/"+feFin,
            type: "POST",
            dataType: "JSON",
            success:function(data) {
             if (data!="") {
              if(data.length > 0)
              {
                for(i=0; i<data.length; i++)
                {
                  var ti=data[i]["tipo_pago"];
                  if (ti==1)
                   {
                     var tipopa="Crédito";
                   }
                   if (ti==2)
                   {
                     var tipopa="Pagado";
                   }
                   $("#listaCompras").append('<tr><td>'+data[i]["fechaCompra"]+'</td><td><a href="#" data-toggle="modal" data-target="#defaultModalDetalle" onclick="abrirVentanaDetalle('+data[i]["idCompra"]+')" >Ver</a></td><td>'+tipopa+'</td><td> <a href="#" onclick="pdfDetalle('+data[i]["idCompra"]+')">pdf</a></td></tr>');
                    $("#subfiltros").show();   
                  }
                }
              }
             }
          });
    }
 }

function pdfDetalle(idCompra)
{
  var idCompra=idCompra;
  mipopup=window.open("http://localhost/CDI/Panel/pdfdetallecompra.php?idCompra="+idCompra,"neo","width=900,height=600,menubar=si");
}
 function abrirVentanaDetalle(idComp)
 {
  $("#detalleRespo").html("");
  $("#detalleTip").html("");
  $("#detalleImpor").html("");
 var idComp=idComp;
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcompras/getDetalle/"+idComp,
            type: "POST",
            dataType: "JSON",
            success:function(data) {
             if (data!="") {
              if(data.length > 0)
              {
                for(i=0; i<data.length; i++)
                {
                  var fP=data[i]["forma_de_pago"];
                  var No=data[i]["nota"];
                  var tP=data[i]["tipo_pago"];
                  var fac=data[i]["factura"];
                  if (fP==1)
                   {
                    var  pag="Transferencia";
                   }
                   if (fP==2)
                   {
                    var  pag="Efectivo";
                   }
                   if (fP==3)
                   {
                    var  pag="Deposito bancario";
                   }
                  if (tP==1)
                   {
                    var tP="Crédito";
                   }
                   if (tP==2)
                   {
                    var tP="Contado";
                   }
                   $("#detalleRespo").append('<tr><td>'+data[i]["nombreUser"]+'</td><td>'+data[i]["nombreP"]+'</td></tr>');   
                  $("#detalleTip").append('<tr><td>'+data[i]["fechaCompra"]+'</td><td>'+data[i]["descuento"]+' %</td><td>'+pag+'</td><td>'+fac+'</td><td>'+No+'</td><td>'+tP+'</td></tr>');   
                  $("#detalleImpor").append('<tr><td>'+data[i]["dias"]+'</td><td>'+data[i]["cantidadPagos"]+'</td><td>'+data[i]["fechaLimitePago"]+'</td><td>'+data[i]["totalDes"]+'</td><td>'+data[i]["subtotalito"]+'</td><td>'+data[i]["iva"]+'</td><td>'+data[i]["total"]+'</td></tr>');   
                  }
                   traerlistadoarray(idComp);
                }
              }
             }
          });
 }

 function traerlistadoarray(id)
 {
    var id=id;
    $("#listCart").html("");
    $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcompras/getDetalleArray/"+id,
            type: "POST",
            dataType: "JSON",
            success:function(data) {
             if (data!="") {
              if(data.length > 0)
              {
                for(i=0; i<data.length; i++)
                {
                    var importe = data[i]["cantidadArt"] * data[i]["costoArticulo"];
                    var to=parseFloat(data[i]["totalArticulo"]) + parseFloat(data[i]["iva"]);
                   $("#listCart").append('<tr><td>'+data[i]["fechaCaducidad"]+'</td><td>'+data[i]["cantidadArt"]+'</td><td>'+data[i]["unidad"]+'</td><td>'+data[i]["nombreArticulo"]+'</td><td>'+data[i]["costoArticulo"]+'</td><td>'+data[i]["descuento"]+'</td><td>'+data[i]["totalArticulo"]+'</td><td>'+data[i]["iva"]+'</td><td>'+to+'</td></tr>')
                }
                }
              }
             }
          });
 }

  function validaOrden()
  {
    var OrdeComp=$("#OrdeComp").val();
     var res = OrdeComp.replace(" ", "");
      $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcompras/validOrd/"+res,
            type: "POST",
            dataType: "html",
            success:function(data) {
            if (data=="null")
             {
              getDatosCompra()
             }else{
              swal("Error", "El número de orden que quiere anexar, ya ha sido capturada.", "error");
             }
            }
          });
 }

function getDatosCompra()
 {
    var OrdeComp=$("#OrdeComp").val();
    if (OrdeComp!="")
     {
      $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcompras/getDetalleFolio/"+OrdeComp,
            type: "POST",
            dataType: "JSON",
            success:function(data) {
              if (data.length>0)
               {
                  for(i=0; i<data.length; i++)
                  {
                  $("#fechaSoliCom").val(data[i]["fechaPedido"]);
                   $("#ProveNombre").val(data[i]["nombreP"]);
                   $("#idProve").val(data[i]["idProveedor"]);
                   var idPerr= data[i]["idCompra"];
                   }
                   getArreglo(idPerr)
               }else{
                swal("ERROR", "No existe este número de orden.", "error")
               }
             
             }
          });
     }
 }

function getArreglo(idCom)
  {
    var idCom=idCom;
    $.ajax({
          url : "http://localhost/CDI/Panel/index.php/Crudcompras/traerLisAr/"+idCom,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          { 
              if (data.length>0)
               {
                for(i=0;i<data.length;i++)
                {
                  var ivvv=0;
                  if( $('#subivaSi').is(':checked') ) {
                  var iv=1;
                   ivvv=(parseFloat(data[i]['costo_unitario'])*parseInt(data[i]['cantidad']))*.16;
                    }
                  
                  $.each(total,function(index,value){
                    if(value == ''){
                          x=index;
                          var impor = parseFloat(data[i]['costo_unitario'])*parseInt(data[i]['cantidad']);
                          var descuento=0;
                          var fechaCadu="0000-00-00";
                         var descuentoTotalArt=impor*parseFloat(descuento);
                         var descuentoTotalArt=descuentoTotalArt/100;
                         var idA= parseInt(data[i]['idArticulo']);
                  array.listArt.push({ 'idArticulo': data[i]['idArticulo'],'cantidadA': data[i]['cantidad'], 'unidadA': data[i]['medida'], 'caducidadA':fechaCadu, 'nomArt':data[i]['nombre'], 'descuentoAr':descuento,  'costoAr':data[i]['costo_unitario'],'importArt':impor,'existencia':data[i]['existencia'],'costoArDes':impor,'ivvv':ivvv});
                    $("#listaArticulo").append('<tr id='+i+'><td style="display:none">'+data[i]['idArticulo']+'</td><td id="contTD'+i+'" onchange="nuevoOper('+parseFloat(impor)+','+i+','+descuentoTotalArt+','+parseInt(idA)+','+ivvv+');">'+data[i]['cantidad']+'</td><td>'+data[i]['medida']+'</td><td onchange="nuevoOper('+parseFloat(impor)+','+i+','+descuentoTotalArt+','+parseInt(idA)+','+ivvv+');">'+fechaCadu+'</td><td>'+data[i]['nombre']+'<input type="hidden" value="'+data[i]['cantidad']+'" name="cantidadAr'+i+'" id="cantidadAr'+i+'"/><input type="hidden" value="'+data[i]['existencia']+'" name="existencia'+i+'" id="existencia'+i+'"/><input type="hidden" value="'+data[i]['nombre']+'" name="nomArticulo'+i+'" id="nomArticulo'+i+'"/><input type="hidden" value="'+data[i]['medida']+'" name="unidad'+i+'" id="unidad'+i+'"/><input type="hidden" value="'+data[i]['costo_unitario']+'" name="costoAr'+i+'" id="costoAr'+i+'"/><input type="hidden" value="'+data[i]['costo_unitario']+'" name="costoPromedio'+i+'" id="costoPromedio'+i+'"/><input type="hidden" value="'+data[i]['idArticulo']+'" name="idArticulo'+i+'" id="idArticulo'+i+'"/><input type="hidden" value="'+fechaCadu+'" name="fCaducidad'+i+'" id="fCaducidad'+i+'"/><input type="hidden" value="'+descuento+'" name="desArt'+i+'" id="desArt'+i+'"/></td><td onchange="nuevoOper('+parseFloat(impor)+','+i+','+descuentoTotalArt+','+parseInt(idA)+','+ivvv+');">'+descuento+'</td><td class="identificador" id="cambio'+i+'" onchange="VerificarContr('+parseFloat(impor)+','+i+','+descuentoTotalArt+','+parseInt(idA)+','+ivvv+');">'+data[i]['costo_unitario']+'</td><td id="impp'+i+'">'+impor.toFixed(2)+'</td><td id="ivarr'+i+'">'+ivvv.toFixed(2)+'</td><td align=center><a href="javascript:eliminararticulo('+i+');">Eliminar</a></td></tr>');
                     $('#tablapedidos').Tabledit({
                      editButton: false,
                      deleteButton:false,
                      columns: {
                          identifier: [11, 'idAr'],
                          editable: [[1, 'cantidadR'], [3, 'fechita'],[5, 'descuentoR'],[6, 'costoR'],[8, 'ivaEdit']],
                      attributes: [
                        [3, '{"type": "date", "required": ""}']
                      ]
                      }
                    });
                    $("input[name*='fechita']").attr("type",'date');
                    calculoTotal(parseFloat(impor),i,descuentoTotalArt,parseInt(data[i]['idArticulo']),ivvv);//calculo
                   $("#tablaAgregar").show();  
                   limpiarCamArticulo();
                    return false;
                    }
              });
                }
               }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function VerificarContr(inpo,i,desc,idAr,ivv)
  {
    var inpo=inpo;
    var i=i;
    var desc=desc;
    var idAr=idAr
    var ivv=ivv;
    
    var costoAr =$("#costoR"+i).val(); 
    $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcompras/verificarI/"+idAr,
            type: "POST",
           // data: parametros,  
            dataType: "json",
            success: function(data)
           {
                  var nombreAr=data.nombre;  
                 if (data.costo_unitario==costoAr)
                  {
                    nuevoOper(inpo,i,desc,idAr,ivv);
                  } else{
                    swal({
                        title: "Alto",
                        text: "Por favor ingrese contraseña para poder alterar el nombre del artículo.",
                        type: "input",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        inputPlaceholder: "Ingrese la contraseña."
                      }, function (inputValue) {
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                          swal.showInputError("Ingrese la contraseña.");
                           
                          return false

                        }
                        var clave =inputValue;
                          $.ajax({
                              url : "http://localhost/CDI/Panel/index.php/Crudcompras/CompararClave/"+clave,
                              type: "GET",
                              dataType: "json",
                              success: function(data)
                              { 
                                
                                if (data.length>0)
                                 {

                                  swal("Éxito", "el importe del artículo  " + nombreAr+" se ha alterado.", "success");
                                  $("#costoR1").val(10);
                                  nuevoOper(inpo,i,desc,idAr,ivv)
                                 }else{
                                    swal("Error!", "Contraseña incorrecta", "error")
                                    
                                 }

                                 //
                              },
                              error: function (jqXHR, textStatus, errorThrown)
                              {
                                  alert('Error get data from ajax');
                              }
                          });
                        
                      });
                  }   
           },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
    });

  }

  function nuevoOper(inpo,i,desc,idAr,ivv)
  {
    var desc=0;
    var subtD=0;
    $("#impp"+i).html("");
    $("#ivarr"+i).html("");
    var i = parseInt(i);
      var cantidad =$("#cantidadR"+i).val();
      var costo =$("#costoR"+i).val();
      var descuentoRess =$("#descuentoR"+i).val();
      var fechita =$("#fechita"+i).val();
      var nomArticulo =$("#nomArticulo"+i).val();
      var existenciaarr=$("#existencia"+i).val();
      var med=$("#unidad"+i).val();
      var fechita=$("#fechita"+i).val();
      var importe=parseFloat(cantidad)*parseFloat(costo);
      desc=(parseFloat(importe)*parseFloat(descuentoRess))/100;
      subtD=parseFloat(importe)-parseFloat(desc);
      $("#impp"+i).append(subtD.toFixed(2));
      var ivv=subtD*.16;
      $("#ivarr"+i).append(ivv.toFixed(2));
            array.listArt[i].cantidadA=cantidad;
            array.listArt[i].caducidadA=fechita;
            array.listArt[i].descuentoAr=descuentoRess;
            array.listArt[i].costoAr=costo;
            array.listArt[i].costoArDes=subtD;
            array.listArt[i].ivvv=ivv;
      calculoTotal(importe,i,desc,idAr,ivv);
  }


function oper()
{
  alert("dentro")
}

function filtroBuscador()
{
  var feIniC=$("#feIniC").val();
  var feFinC=$("#feFinC").val();
  $("#listaCompras").html("");
  if ($("#pagadasC").is(':checked'))
   {
     var pagadasC=$("#pagadasC").val();
   }
   if ($("#creditoC").is(':checked'))
   {
      var creditoC=$("#creditoC").val();
   }
   if ($("#pagosC").is(':checked'))
   {
      var pagosC=$("#pagosC").val();
   }
    $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudcompras/getfiltroCheck/"+pagadasC+"/"+creditoC+"/"+pagosC+"/"+feIniC+"/"+feFinC,
            type: "POST",
            dataType: "JSON",
            success:function(data) {
             if (data!="") {
                if(data.length > 0)
                {
                  for(i=0; i<data.length; i++)
                  {
                    var ti=data[i]["tipo_pago"];
                  if (ti==1)
                   {
                     var tipopa="Crédito";
                   }
                   if (ti==2)
                   {
                     var tipopa="Pagado";
                   }
                    $("#listaCompras").append('<tr><td>'+data[i]["fechaCompra"]+'</td><td><a href="#" data-toggle="modal" data-target="#defaultModalDetalle" onclick="abrirVentanaDetalle('+data[i]["idCompra"]+')" >Ver</a></td><td>'+tipopa+'</td><td> <a href="#" onclick="pdfDetalle('+data[i]["idCompra"]+')">pdf</a></td></tr>');
                  } 
                  }
                }
             }
          });
}

