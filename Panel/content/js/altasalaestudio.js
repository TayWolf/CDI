function allowDrop(ev) {
    ev.preventDefault();
 // alert("entra ALLOWDROP");
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
// alert("ENTRA DRAG");
}

function drop(ev,ids) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));

var id=ids;
// alert("ENTRA DROP"+id);
altaPrueba(id);
}

function altaPrueba(id)
{
    //alert("Entra")
    var id=id;
    $("#idsala"+id).val(id);
    var total=$("#total").val();
    var idactual=$("#idactual").val();
    //for (i=1; i <= total ; i++) { 
        var idS=$("#idsala"+id).val();
                     //var idub = idS+i;

                    var sala = $("#drag"+idS);
                    var funcionaejecutar = sala.parent().attr('id');
                    // alert(funcionaejecutar);

                    if (idS!="") {
                        if (funcionaejecutar == "asignar"+idS) {
                            $.ajax({
                                url : "http://localhost/CDI/Panel/index.php/Crudestudios/agregarPuente/" + idS+"/"+total+"/"+idactual,
                                type: "GET",
                                dataType: "html",
                                success: function(data)
                                {
                                    // alert("Dato insertado "+data);
                                   
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                        }else{
                            $.ajax({
                                url : "http://localhost/CDI/Panel/index.php/Crudestudios/quitarPuente/" + idS+"/"+total+"/"+idactual,
                                type: "GET",
                                dataType: "html",
                                success: function(data)
                                {
                                    // alert("Dato eliminado");
                                   
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });
                        }                        
                    }
}

function identificaSalasAsignadas(){
    var total = $("#total").val();
    var actual = $("#idactual").val();
    for (var i = 1; i <= total; i++) {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudestudios/buscaasignadas/" + i+"/"+actual,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data != "null") {
                    //alert(data.idSala)
                    $("#pintasalas").append('<tr><td id="quitar'+data.idSala+'" ondrop="drop(event,'+data.idSala+')" ondragover="allowDrop(event)"><input type="hidden" name="idsala'+data.idSala+'" id="idsala'+data.idSala+'" class="filled-in chk-col-purple"></td><td id="asignar'+data.idSala+'" ondrop="drop(event,'+data.idSala+')" ondragover="allowDrop(event)"><p id="drag'+data.idSala+'" draggable="true" ondragstart="drag(event)">'+data.nombre+'</p></td></tr>');
                }         
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });  
    }
    identificaSalasDisponibles();
}

function identificaSalasDisponibles(){
    
    var total = $("#total").val();
    var actual = $("#idactual").val();
    for (var i = 1; i <= total; i++) {
        $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudestudios/buscadisponibles/" + i+"/"+actual,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                // alert(data);
                if (data != "null") {
                    $("#pintasalas").append('<tr><td id="quitar'+data.idSala+'" ondrop="drop(event,'+data.idSala+')" ondragover="allowDrop(event)"><p id="drag'+data.idSala+'" draggable="true" ondragstart="drag(event)">'+data.nombre+'</p><input type="hidden" name="idsala'+data.idSala+'" id="idsala'+data.idSala+'" class="filled-in chk-col-purple"></td><td id="asignar'+data.idSala+'" ondrop="drop(event,'+data.idSala+')" ondragover="allowDrop(event)"></td></tr>'); 
                }          
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });  
    }
}

