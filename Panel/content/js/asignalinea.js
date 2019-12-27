////////////////////////funciones de los articulos////////////////////////////////
function traerIdarticulo(idArticulo)
{
    var idArticulo=idArticulo;
    $("#idArticuloactual").val(idArticulo);

}
function allowDropp(ev) {
    ev.preventDefault();
 // alert("entra ALLOWDROP");
}

function dragg(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
// alert("ENTRA DRAG");
}

function dropp(ev,ids) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));

var id=ids;
// alert("ENTRA DROP"+id);
altaLinea(id);
}

function altaLinea(id)
{
	var id=id;
    $("#idlinea"+id).val(id);
    var total = $("#totalLin").val();
    var actual = $("#idArticuloactual").val();
    var idD=$("#idlinea"+id).val();
    //alert("entra"+id);
                     //var idub = idS+i;
                    var art = $("#drag"+idD);
                    var funcionaejecutar = art.parent().attr('id');
                    // alert(funcionaejecutar);

                    if (idD!="") {
                    	//alert("entra "+idD+" asignarLinea"+idD)
                        if (funcionaejecutar == "asignarLinea"+idD) {
                            $.ajax({
                                url : "http://localhost/CDI/Panel/index.php/Crudarticulos/agregarPuenteLine/" + idD+"/"+total+"/"+actual,
                                type: "GET",
                                dataType: "html",
                                success: function(data)
                                {
                                      swal("ÉXITO!", "Línea asignada para el artículo", "success");
                                  
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                        }else{
                            $.ajax({
                                url : "http://localhost/CDI/Panel/index.php/Crudarticulos/quitarPuenteLinea/" + idD+"/"+total+"/"+actual,
                                type: "GET",
                                dataType: "html",
                                success: function(data)
                                {
                                     swal("AVISO!", "La línea se deslinda del articulo ", "warning")
                                  // $("#ocultaverhorario"+id).hide();
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                        }                        
                    }
}

function identificaLineaAsignados(){
    $("#pintaLineas").html("");
    var total = $("#totalLin").val();
    var actual = $("#idArticuloactual").val();
    for (var i = 1; i <= total; i++) {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudarticulos/buscaLinasignados/"+i+"/"+actual,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data != "null") {
                    $("#pintaLineas").append('<tr><td id="quitar'+data.idLinea+'" ondrop="dropp(event,'+data.idLinea+')" ondragover="allowDropp(event)"><input type="hidden" name="idlinea'+data.idLinea+'" id="idlinea'+data.idLinea+'" class="filled-in chk-col-purple"></td><td id="asignarLinea'+data.idLinea+'" ondrop="dropp(event,'+data.idLinea+')" ondragover="allowDropp(event)"><p id="drag'+data.idLinea+'" draggable="true" ondragstart="dragg(event)">'+data.nombre+'</p></td></tr>');
                }         
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });  
    }
    identificaLineasDisponibles();
}

function listaCaduca(idAr){
    var idAr=idAr;
    $("#pintaListaCa").html("");
    //var total = $("#totalLin").val();
   // var actual = $("#idArticuloactual").val();
    //for (var i = 1; i <= total; i++) {

        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudarticulos/getListacaduca/"+idAr,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                
                    
                if (data!="") {
                    if(data.length > 0)
                      {
                          for(i=0; i<data.length; i++)
                              {
                               // alert(data[i]["idUbicacion"]);
                                
                               $("#pintaListaCa").append('<tr><td>'+data[i]["fechaCaducidad"]+'</td><td>'+data[i]["cantidadArt"]+'</td><td>'+data[i]["existenciaAnterior"]+'</td></tr>');
                              }   
                      }
                }      
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        }); 
    //}
    
}

function listaCaducaEntr(idAr){
    var idAr=idAr;
    $("#listaCaducaE").html("");
    //var total = $("#totalLin").val();
   // var actual = $("#idArticuloactual").val();
    //for (var i = 1; i <= total; i++) {

        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudarticulos/getListacaducaEntr/"+idAr,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                
                    
                if (data!="") {
                    if(data.length > 0)
                      {
                          for(i=0; i<data.length; i++)
                              {
                               // alert(data[i]["idUbicacion"]);
                                
                               $("#listaCaducaE").append('<tr><td>'+data[i]["fechaCaducidad"]+'</td><td>'+data[i]["cantidadArt"]+'</td><td>'+data[i]["cantidadActual"]+'</td></tr>');
                              }   
                      }
                }      
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        }); 
    //}
    
}

function identificaLineasDisponibles(){
    
    var total = $("#totalLin").val();
    var actual = $("#idArticuloactual").val();
    for (var i = 1; i <= total; i++) {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudarticulos/buscaLinedisponibles/" + i+"/"+actual,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                // alert(data);
                if (data != "null") {
                    $("#pintaLineas").append('<tr><td id="quitar'+data.idLinea+'" ondrop="dropp(event,'+data.idLinea+')" ondragover="allowDropp(event)"><p id="drag'+data.idLinea+'" draggable="true" ondragstart="dragg(event)">'+data.nombre+'</p><input type="hidden" name="idlinea'+data.idLinea+'" id="idlinea'+data.idLinea+'" class="filled-in chk-col-purple"></td><td id="asignarLinea'+data.idLinea+'" ondrop="dropp(event,'+data.idLinea+')" ondragover="allowDropp(event)"></td></tr>'); 
                }          
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });  
    }
}



function identificaProveAsignadosProve(){
    $("#pintaProvedores").html("");
    var total = $("#totalidProveedor").val();
    var actual = $("#idArticuloactual").val();
    for (var i = 1; i <= total; i++) {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudarticulos/buscaProvesignados/"+i+"/"+actual,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data != "null") {
                    $("#pintaProvedores").append('<tr><td id="quitar'+data.idProveedor+'" ondrop="droppP(event,'+data.idProveedor+')" ondragover="allowDroppP(event)"><input type="hidden" name="idProveedor'+data.idProveedor+'" id="idProveedor'+data.idProveedor+'" class="filled-in chk-col-purple"></td><td id="asignarProveedor'+data.idProveedor+'" ondrop="droppP(event,'+data.idProveedor+')" ondragover="allowDroppP(event)"><p id="dragPR'+data.idProveedor+'" draggable="true" ondragstart="draggP(event)">'+data.nombreP+'</p></td></tr>');
                }         
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });  
    }
   identificaProvedDisponibles();
}

function identificaProvedDisponibles(){
    $("#pintaProvedores").html("");
    var total = $("#totalidProveedor").val();
    var actual = $("#idArticuloactual").val();
    for (var i = 1; i <= total; i++) {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudarticulos/buscaProvedisponibles/" + i+"/"+actual,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                // alert(data);
                if (data != "null") {
                    $("#pintaProvedores").append('<tr><td id="quitar'+data.idProveedor+'" ondrop="droppP(event,'+data.idProveedor+')" ondragover="allowDroppP(event)"><p id="dragPR'+data.idProveedor+'" draggable="true" ondragstart="draggP(event)">'+data.nombreP+'</p><input type="hidden" name="idProveedor'+data.idProveedor+'" id="idProveedor'+data.idProveedor+'" class="filled-in chk-col-purple"></td><td id="asignarProveedor'+data.idProveedor+'" ondrop="droppP(event,'+data.idProveedor+')" ondragover="allowDroppP(event)"></td></tr>'); 
                }          
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });  
    }
}


function allowDroppP(ev) {
    ev.preventDefault();
 // alert("entra ALLOWDROP");
}

function draggP(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
// alert("ENTRA DRAG");
}

function droppP(ev,ids) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));

var id=ids;
// alert("ENTRA DROP"+id);
altaProved(id);
}

function altaProved(id)
{
	var id=id;
    $("#idProveedor"+id).val(id);
    var total = $("#totalidProveedor").val();
    var actual = $("#idArticuloactual").val();
    var idD=$("#idProveedor"+id).val();
    //alert("entra"+idD);
                     //var idub = idS+i;
                    var art = $("#dragPR"+idD);
                    //alert(art)
                    var funcionaejecutar = art.parent().attr('id');
                    // alert(funcionaejecutar);

                    if (idD!="") {
                    	//alert("entra "+idD)
                        if (funcionaejecutar == "asignarProveedor"+idD) {
                            $.ajax({
                                url : "http://localhost/CDI/Panel/index.php/Crudarticulos/agregarPuenteProved/" + idD+"/"+total+"/"+actual,
                                type: "GET",
                                dataType: "html",
                                success: function(data)
                                {
                                      swal("ÉXITO!", "Proveedor asignado para el artículo", "success");
                                  
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                        }else{
                        	//alert("entra")
                            $.ajax({
                                url : "http://localhost/CDI/Panel/index.php/Crudarticulos/quitarPuenteProved/" + idD+"/"+total+"/"+actual,
                                type: "GET",
                                dataType: "html",
                                success: function(data)
                                {
                                     swal("AVISO!", "El proveedor se deslinda del articulo ", "warning")
                                  // $("#ocultaverhorario"+id).hide();
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                        }                        
                    }
}
///////////////////////FIN FUNCIONES DE LOS ARTICULOS ///////////////////////////