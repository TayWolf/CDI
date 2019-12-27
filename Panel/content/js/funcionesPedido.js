var total = new Array(100);
var contadorTr=0;
for(var i=0; i<total.length; i++){
    total[i]='';
}

var ArtArreglo = new Array(100);
for(var b=0; b<ArtArreglo.length; b++){
    ArtArreglo[b]='';
}
var array = {
    'listArt': []
};
var arregloJson;

window.onload=nCompra;

function nCompra(){
    //botones();
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpedidos/traerIdCompra/",
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
                    $("#noPedi").val(o+data[i]['idSolicitud']);
                    $("#noPedido").val(o+data[i]['idSolicitud']);
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    $("#entregoPedi").val($("#respons").val());
}
function botones () {
    $("#NombreArt").on("focus",articulo);
}

function articulo () {

    $("#NombreArt").autocomplete({
        source:function(request,response) {
            $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudpedidos/traerArt/",
                dataType:"json",
                data:{q:request.term},
                success:function(data) {
                    response(data);

                }
            });
        },
        minLength:1,
        select:function(event,ui) {
            $("#idArt").val(ui.item.idArticulo);
            $("#UnidadArt").val(ui.item.medida);
            $("#cantidadArt").val(1);
            $("#existencia").val(ui.item.existencia);
            obtenerFechasCaducidad(ui.item.idArticulo);
            obtenerFechasEntradaCaducidad(ui.item.idArticulo);
        }
    });
}

function  obtenerFechasCaducidad(idArticulo ){
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudsalida/obtenerFcA/",
        //url : "http://localhost/CDI/Panel/index.php/Crudsalida/pbtenerUnifFecah/",
        dataType:"json",
        data:{idArt:idArticulo},
        success:function(data) {
            //  prueba=obtenerSiLLevaCaducidad(idArticulo);
            if(data==null)
            {

                $('#fCaducidad').html('');
                $('#fCaducidad').append('<option value="no">No existen datos</option>');
                // $('#fechaCaudUnica').html('');
                //$('#fechaCaudUnica').append('<option value="no">No existen datos</option>');
            }
            else
            {
                $('#fCaducidad').html('');
                $('#fCaducidad').append('<option value="no">No habilitada</option>');
                //$('#fechaCaudUnica').html('');
                //$('#fechaCaudUnica').append('<option value="no">No habilitada</option>');
                $.each(data, function(i,item){
                    fecha=data[i].fechaCaducidad;
                    idCompra=data[i].idcompraArticulo;
                    if (fecha=="0000-00-00")
                     {
                        fecha="";
                     }
                    $('#fCaducidad').append('<option value="'+idCompra+'">'+fecha+' Cantidad '+data[i].existenciaAnterior+'</option>');
                    //$('#fechaCaudUnica').append('<option value="'+idCompra+'">'+fecha+' Cantidad '+data[i].existenciaAnterior+'</option>');
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

                    $('#fCaducidadEntrada').append('<option value="'+idEntrada+'">'+fecha+' Cantidad '+data[i].cantidadActual+'</option>');


                    //document.write("<br>"+i+" - "+miJSON[i].valor+" - "+miJSON[i].color+" - "+miJSON[i].caracteristica.tipo+" - "+miJSON[i].caracteristica.ref);
                })
            }

            // alert("desde php"+data);
        }
    });
}
function reci()
{
    var solicitadoPor=$("#solicitadoPor").val();
    $("#reciboPedido").val(solicitadoPor);
}

$(document).on('click', '.linkEliminacion', function (event) {
    event.preventDefault();
    var indice= $(this).closest('tr').index();
    $(this).closest('tr').remove();
   // alert(indice);
    array.listArt.splice(indice, 1);
    console.log(JSON.stringify(array.listArt, null, 4));

});

function traerMinimo()
{
    var nomArticulo = $("#NombreArt").val();
    var idArticulo = $("#idArt").val();

    var unidad = $("#UnidadArt").val();
    var areaUso = $("#AreaUso").val();
    var Observaciones = $("#Observacion").val();
    var cantidadAr = $("#cantidadArt").val();
    var fCaducidad= $("#fCaducidad").val();
    var existencia = $("#existencia").val();
    $.trim(existencia);
    existencia=parseInt(existencia);
    var fCaducidadEntrada=$("#fCaducidadEntrada").val();
    var caducidadSeleccionadaEntrada = $("#fCaducidad option:selected").html();
    var table=document.getElementById("listaArticulo");
    var numFilasTabla=table.rows.length;


//alert(fCaducidad + fCaducidadEntrada)
    var datos = {
        "idArticulo" :idArticulo,
        "fCaducidad" :fCaducidad,
        "fCaducidadEntrada" :fCaducidadEntrada,
        "cantidadAr" :cantidadAr
    };
    if (areaUso!="")
     {

     
    if(fCaducidad!="no" && fCaducidadEntrada!="no" ){
        
        $("#mensajeUno").html('<div style="position: absolute;left: 55%;z-index: 3;"><div class="card"><div class="body redMes">Solo puedes escojer una fecha de caducidad</div></div>');
        $("#mensajeUno").fadeIn();
    }
    else{ //caduciada ambas
        if(fCaducidad=="no" && fCaducidadEntrada=="no")
        {               
            $("#mensajeUno").html('<div style="position: absolute;left: 55%;z-index: 3;"><div class="card"><div class="body redMes">Debes al menos seleccionar una fecha de caducidad</div></div>');
            $("#mensajeUno").fadeIn();
        }else {

            $.ajax({
                data:  datos,
                url : "http://localhost/CDI/Panel/index.php/Crudsalida/traerValidacionMinimo/",
                // url:   'traerValidacionMinimo.php',
                type:  'post',
                dataType: "JSON",
                success:  function (response)
                {
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
                                        $("#mensajeUno").html('Existencia agotada en el almacen para este artículo');
                                        $("#mensajeUno").fadeIn();
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
                                        $("#mensajeUno").html('Existencia agotada en el almacen para este artículo');
                                        $("#mensajeUno").fadeIn();
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
                        //$("#mensajeUno").html('La cantidad excede la existencia actual de ese producto');
                        $("#mensajeUno").html('<div style="position: absolute;left: 55%;z-index: 3;"><div class="card"><div class="body redMes">La cantidad excede la existencia actual de ese producto</div></div>');
                        $("#mensajeUno").fadeIn();

                    }

                }
            });
        }
    }
}else{
    swal("AVISO", "Por favor seleccione una área", "warning")
    //console.log(JSON.stringify(array.listArt, null, 4));
}
}

function agregarArticuloLista(idControl){
    //impArrglo();

    var fCaducidad = $("#fCaducidad").val();
    var fCaducidadEntrada= $("#fCaducidadEntrada").val();
    var caducidadArray = $("#fCaducidad option:selected").html();
    if (fCaducidad!="no")
    {
        var fechId=fCaducidad;
        var Ident="1";//compra

    }else if(fCaducidadEntrada!="no"){
        var fechId=fCaducidadEntrada;
        var Ident="2";//entrada
        caducidadArray= $("#fCaducidadEntrada option:selected").html();
    }
    //alert("fecha "+fechId)

    var idControl=idControl;
    var nomArticulo = $("#NombreArt").val();
    var idArticulo = $("#idArt").val();
    var unidad = $("#UnidadArt").val();
    var cantidadAr = $("#cantidadArt").val();
    var existencia = $("#existencia").val();
    var Observaciones = $("#Observacion").val();
    var caducidadSeleccionada = $("#fCaducidad option:selected").html(); //selecciono el texto para mandarlo a la tabla
    var caducidadSeleccionadaEntrada = $("#fCaducidadEntrada option:selected").html();

    var NombreArt = $("#NombreArt").val();//
    var idArt = $("#idArt").val();
    var UnidadArt = $("#UnidadArt").val();//
    var fechaCad = $("#fechaCad").val();//
    var cantidadArt = $("#cantidadArt").val();//

    var areaUso = $("#AreaUso").val();

    $.trim(existencia);
    existencia=parseInt(existencia);
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
                        var nombreAreaUso="";


                        $.ajax({
                            url : "http://localhost/CDI/Panel/index.php/Crudpedidos/sacarNombreA/"+areaUso,
                            type: "POST",
                            dataType: "json",
                            success: function(data)
                            {

                                nombreAreaUso=data.nombreArea;
                                array.listArt.push({ 'fechId': fechId, 'fechaC':caducidadArray,'Ident':Ident,'tipoCaducidad':tipoCaducidad,'idArticulo': idArticulo,'cantidadA': cantidadArt, 'unidadA': UnidadArt, 'nomArt':NombreArt, 'observaciones':Observaciones,'areaUso':areaUso,'existencia':existencia});
                                // alert("entra"+existencia)

                                $("#listaArticulo").append('<tr id=tr'+x+'><td>'+cantidadAr+'</td><td>'+unidad+'</td><td>'+nomArticulo+
                                    '<input type="hidden" value="'+cantidadAr+'" name="cantidadAr'+x+'" id="cantidadAr'+x+
                                    '"/><input type="hidden" value="'+idControl+'" name="idControl'+x+'" id="idControl'+x+
                                    '"/><input type="hidden" value="'+nomArticulo+'" name="nomArticulo'+x+'" id="nomArticulo'+x+
                                    '"/><input type="hidden" value="'+unidad+'" name="unidad'+x+'" id="unidad'+x+
                                    '"/><input type="hidden" value="'+idArticulo+'" name="idArticulo'+x+'" id="idArticulo'+x+
                                    '"/><input type="hidden" value="'+valorValue+'" name="fCaducidad'+x+'" id="fCaducidad'+x+
                                    '"/><input type="hidden" value="'+tipoCaducidad+'" name="tipoCaducidad'+x+'" id="tipoCaducidad'+x+
                                    '"/></td><td>'+nombreAreaUso+'</td><td>'+Observaciones+'  </td><td>'+caducidadArray+'</td><td align=center><a href="#" class="linkEliminacion">Eliminar</a></td></tr>');

                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Error adding / update data');
                            }
                        });


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
                                $.ajax({
                                    url : "http://localhost/CDI/Panel/index.php/Crudpedidos/sacarNombreA/"+areaUso,
                                    type: "POST",
                                    dataType: "json",
                                    success: function(data)
                                    {

                                        nombreAreaUso=data.nombreArea;

                                        array.listArt.push({ 'fechId': fechId, 'fechaC':caducidadArray,'Ident':Ident,'tipoCaducidad':tipoCaducidad,'idArticulo': idArticulo,'cantidadA': cantidadArt, 'unidadA': UnidadArt, 'nomArt':NombreArt, 'observaciones':Observaciones,'areaUso':areaUso,'existencia':existencia});
                                        $("#listaArticulo").append('<tr id=tr'+x+'><td>'+cantidadAr+'</td><td>'+unidad+'</td><td>'+nomArticulo+
                                            '<input type="hidden" value="'+cantidadAr+'" name="cantidadAr'+x+'" id="cantidadAr'+x+
                                            '"/><input type="hidden" value="'+idControl+'" name="idControl'+x+'" id="idControl'+x+
                                            '"/><input type="hidden" value="'+nomArticulo+'" name="nomArticulo'+x+'" id="nomArticulo'+x+
                                            '"/><input type="hidden" value="'+unidad+'" name="unidad'+x+'" id="unidad'+x+
                                            '"/><input type="hidden" value="'+idArticulo+'" name="idArticulo'+x+'" id="idArticulo'+x+
                                            '"/><input type="hidden" value="'+valorValue+'" name="fCaducidad'+x+'" id="fCaducidad'+x+
                                            '"/><input type="hidden" value="'+tipoCaducidad+'" name="tipoCaducidad'+x+'" id="tipoCaducidad'+x+
                                            '"/></td><td>'+nombreAreaUso+'</td><td>'+Observaciones+'  </td><td>'+caducidadArray+'</td><td align=center><a href="#" class="linkEliminacion">Eliminar</a></td></tr>');
                                    },
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                        alert('Error adding / update data');
                                    }
                                });

                                $("#tablaAgregar").show();
                                jQuery('html, body').animate({
                                    scrollTop: jQuery('#tablaAgregar').position().top
                                },1000);
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
    $("#cantidadArt").val(dato1);
    $("#existencia").val(dato1);
    $("#AreaUso").val(dato1);
    $("#Observacion").val(dato1);
    $("#nomArticulo").focus();
}

function SaveSol()
{
    var idUser = $("#idUser").val();//
    var noPedi = $("#noPedi").val();//
    var HoyFec = $("#HoyFec").val();//
    var areaSolicita = $("#areaSolicita").val();//
    var solicitadoPor = $("#solicitadoPor").val();//

    arregloJson=JSON.stringify(array);
    arre = JSON.parse(arregloJson);
    var parametros = {
        "HoyFec":HoyFec,
        "noPedi":noPedi,
        "idUser":idUser,
        "areaSolicita":areaSolicita,
        "solicitadoPor":solicitadoPor,
        "arreglo" : arre //Aquí enviamos el arreglo con las habitaciones
    };
    if (areaSolicita!="" &&  solicitadoPor!="" )
    {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudpedidos/agregaCompra/",
            type: "POST",
            data: parametros,
            dataType: "HTML",
            success: function(data)
            {
                swal({
                        title: "Éxito",
                        text: "Imprimir PDF.",
                        type: "success",
                        confirmButtonText: "Aceptar",
                    },
                    function(){
                        //location.href='http://localhost/CDI/Panel/pdfpedido.php?idCompra='+data;
                        mipopup=window.open("http://localhost/CDI/Panel/pdfpedido.php?idCompra="+data,"neo","width=900,height=600,menubar=si");
                        location.href='http://localhost/CDI/Panel/index.php/Crudpedidos';
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
    $("#listaPedidos").html("");
    if (feIni!="" && feFin!="" )
    {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudpedidos/traerlistaPedidoFilt/"+feIni+"/"+feFin,
            type: "POST",
            dataType: "JSON",
            success:function(data) {
                if (data!="") {
                    if(data.length > 0)
                    {
                        for(i=0; i<data.length; i++)
                        {

                            $("#listaPedidos").append('<tr><td>'+data[i]["fechaPedido"]+'</td><td><a href="#" data-toggle="modal" data-target="#defaultModalDetalle" onclick="abrirVentanaDetalle('+data[i]["idSolicitud"]+')" >Ver</a></td><td><a href="#" onclick="pdfDetalle('+data[i]["idSolicitud"]+')">pdf</a></td></tr>');
                            //$("#subfiltros").show();
                        }
                    }
                }
            }
        });
    }
}

function abrirVentanaDetalle(idPedido)
{
    $("#detalleRespo").html("");

    $("#detalleImpor").html("");
    var idPedido=idPedido;
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpedidos/getDetalle/"+idPedido,
        type: "POST",
        dataType: "JSON",
        success:function(data) {
            if (data!="") {
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {

                        $("#detalleRespo").append('<tr><td>'+data[i]["nombreUser"]+'</td><td>'+data[i]["personaPedido"]+'</td><td>'+data[i]["fechaPedido"]+'</td><td>'+data[i]["AreaPedido"]+'</td></tr>');

                        //$("#detalleImpor").append('<tr><td>'+data[i]["dias"]+'</td><td>'+data[i]["cantidadPagos"]+'</td><td>'+data[i]["fechaLimitePago"]+'</td><td>'+data[i]["totalDes"]+'</td><td>'+data[i]["subtotalito"]+'</td><td>'+data[i]["iva"]+'</td><td>'+data[i]["total"]+'</td></tr>');
                    }
                    traerlistadoarray(idPedido);
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
        url : "http://localhost/CDI/Panel/index.php/Crudpedidos/getDetalleArray/"+id,
        type: "POST",
        dataType: "JSON",
        success:function(data) {
            if (data!="") {
                if(data.length > 0)
                {
                    for(i=0; i<data.length; i++)
                    {
                        $("#listCart").append('<tr><td>'+data[i]["cantidadPedido"]+'</td><td>'+data[i]["unidadPedido"]+'</td><td>'+data[i]["nombreArt"]+'</td><td>'+data[i]["areaUso"]+'</td><td>'+data[i]["observacionesPedido"]+'</td></tr>')
                    }
                }
            }
        }
    });
}

function pdfDetalle(idPedido)
{
    var idPedido=idPedido;
    mipopup=window.open("http://localhost/CDI/Panel/pdfpedido.php?idCompra="+idPedido,"neo","width=900,height=600,menubar=si");

}

function traerAreaNombre(idped)
{
    var id=idped;
    $("#muestraselectcarea"+id).show();
    $("#nombreAre"+id).hide();
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpedidos/traerAre/",
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $("#selectarea"+id).append(new Option("Selecciones una opción",""));
            if (data.length>0)
            {
                for (i=0; i<data.length; i++)
                {
                    $("#selectarea"+id).append(new Option(data[i]['nombreArea'],data[i]['idInterno']));
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function modificarDatosAree(id){

    var id = id;
    var idAreaI = $("#selectarea"+id).val();

    // alert (idcolonia);
    var parametros = {"idAreaI":idAreaI,"id":id}
    //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudpedidos/editaAr/",
        type: "post",
        data: parametros,
        dataType: "HTML",
        success: function(data)
        {
            //    alert(data);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            // alert('ERROR AL GUARDAR ESTADO');
        }
    });
}