function traesalashoras(idDoc) {
	$("#pintahorariosDoctor").html("");
	var id = idDoc;
	//alert("Entra doctor con id: "+id);
	$.ajax({
        url : "http://localhost/CDI/Panel/index.php/Cruddoctores/traeSalaMedico/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            // alert(data);
            if (data.length>0) {
				for (var i = 0; i <= data.length; i++) {
					$("#pintahorariosDoctor").append('<div class="row text-center" id="sala" style="margin-bottom:30px;"><h5>'+data[i]["nombre"]+'</h5><div id="dias'+data[i]["idsalaMedico"]+'" ><div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true"></div></div></div>');
					traehoras(data[i]["idsalaMedico"]);
				}
            }
            	
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function traehoras(id) {
	var id = id;
	//alert("iEntra ID"+id);
	$.ajax({
        url : "http://localhost/CDI/Panel/index.php/Cruddoctores/traeHorarioSalaMedico/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
        	var valorDia;
            if (data.length>0) {
				for (var i = 0; i <= data.length; i++) {
					if (data[i]["dia"] == 1) {
						valorDia="Lunes";
					}else if (data[i]["dia"]==2)
			        {
			          valorDia="Martes";
			        }else if (data[i]["dia"]==3)
			        {
			          valorDia="Miercoles";
			        }
			        else if (data[i]["dia"]==4)
			        {
			          valorDia="Jueves";
			        }
			        else if (data[i]["dia"]==5)
			        {
			          valorDia="Viernes";
			        }else if (data[i]["dia"]==6)
			        {
			          valorDia="Sabado";
			        }else if (data[i]["dia"]==7)
			        {
			          valorDia="Domingo";
			        }
			       // $("#dias"+id).append('<div class="col-md-3 col-sm-3 col-xs-3"><div class="row text-center" id="dia">'+valorDia+'</div><div class="row"><div class="col-md-6 col-sm-6 col-xs-6"><div class="row text-center">Entrada</div><div class="row" id="horaentrada"><div class="col-md-12 col-sm-12 col-xs-12">'+data[i]["horaEntrada"]+'</div></div></div><div class="col-md-6 col-sm-6 col-xs-6"><div class="row text-center">Salida</div><div class="row" id="horasalida"><div class="col-md-12 col-sm-6 col-xs-6">'+data[i]["horaSalida"]+'</div></div></div> </div></div>');
					$("#dias"+id).append('<div class="panel panel-primary">'+
                                            '<div class="panel-heading" role="tab" id="heading'+i+id+'_1">'+
                                                '<h4 class="panel-title">'+
                                                    '<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapse'+i+id+'_1" aria-expanded="false" aria-controls="collapse'+i+id+'_1">'+
                                                        valorDia+
                                                    '</a>'+
                                                '</h4>'+
                                            '</div>'+
                                            '<div id="collapse'+i+id+'_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+i+id+'_1">'+
                                                '<div class="panel-body">'+
                                                    '<div class="row">'+
															'<div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-2">'+
																'<div class="row text-center">Entrada</div>'+
																'<div class="row" id="horaentrada'+data[i]["dia"]+id+'">'+
																//aqui va entrada	'<div class="col-md-12 col-sm-12 col-xs-12">'+data[i]["horaEntrada"]+'</div>'+
																'</div>'+
															'</div>'+
															'<div class="col-md-4 col-sm-6 col-xs-6">'+
																'<div class="row text-center">Salida</div>'+
																'<div class="row" id="horasalida'+data[i]["dia"]+id+'">'+
																	// aqui va salida '<div class="col-md-12 col-sm-6 col-xs-6">'+data[i]["horaSalida"]+'</div>'+
																'</div>'+
															'</div>'+ 
														'</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>');
					horarioPordia(data[i]["dia"],id);
					
				}
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function horarioPordia(dia,id)
{
	//alert(dia+" id: "+id);
	var id = id;
	var dia = dia;
	$.ajax({
        url : "http://localhost/CDI/Panel/index.php/Cruddoctores/traerHorapordia/"+dia+"/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
        	
            if (data.length>0) {
				for (var i = 0; i <= data.length; i++) {
					
			        $("#horaentrada"+dia+id).append('<div class="col-md-12 col-sm-12 col-xs-12">'+data[i]["horaEntrada"]+'</div>');
			        $("#horasalida"+dia+id).append('<div class="col-md-12 col-sm-12 col-xs-12">'+data[i]["horaSalida"]+'</div>');
				}
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function asignaid(id) {
	var id = id;
	$("#doctorActual").val(id);
	verificaExistencia(id);
	$("#rowresultados").hide();
}

function traeestudio(id) {
	$("#rowresultados").show();
	$("#pintaestudiosDispo").html("");
	$("#headerDisponibles").html("");
	$("#alerta").html("");
	var idDoc = id;
	var clave =  $("#buscaestudio").val();
	if (clave != "") {
		$.ajax({
	        url : "http://localhost/CDI/Panel/index.php/Cruddoctores/traeEstudios/"+clave,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {
	        	// verificaExistencia(idDoc)
	            // alert(data);
	            if (data.length>0) {
	            	$("#headerDisponibles").append('Estudios Encontrados');
					for (var i = 0; i <= data.length; i++) {
						// alert(data[i]["IdEstudio"]);
						$("#pintaestudiosDispo").append('<div id="inputestudio'+data[i]["IdEstudio"]+'" class="col-md-3" style="padding:0px;"><div class="col-md-12" style="padding:0px;">'+                                                     
	                                                    '<input type="checkbox" name="estudio'+data[i]["IdEstudio"]+'" id="estudio'+data[i]["IdEstudio"]+'" class="filled-in chk-col-light-blue" />'+
	                                                    '<label for="estudio'+data[i]["IdEstudio"]+'">'+data[i]["nombreEstudio"]+'</label>'+
	                                                '</div></div>');
						$("#ultimoidEstudio").val(data[i]["IdEstudio"]);
					}

	            }else{
	            	$("#headerDisponibles").append('Estudios Encontrados');
	            	$("#pintaestudiosDispo").append('<span>No se encontraron resultados en tu busqueda, por favor intenta con otra palabra</span>');
	            }

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}else{
		$("#alerta").append("<span style='font-size: 12px; color: red;'>Debes buscar un estudio para poder agregarlo.<span>");
	}
	

}

function guardaestudios() {
	var idDoc = $("#doctorActual").val();
	var totalestudios = $("#ultimoidEstudio").val();
	for (var i = 0; i <= totalestudios; i++) {
		if ($('#estudio'+i).length > 0) {
			if ($("#estudio"+i).prop('checked')) {
				var seleccionado = i;
				$.ajax({
			        url : "http://localhost/CDI/Panel/index.php/Cruddoctores/guardaEstudiosDoctor/"+i+"/"+idDoc,
			        type: "post",
			        dataType: "html",
			        success: function(data)
			        {
			            // traeestudio(idDoc);
			        },
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error get data from ajax');
			        }
			    });
			}
		}
	}
	quitaestudios();
}

function quitaestudios() {
	var idDoc = $("#doctorActual").val();
	var totalestudios = $("#ultimoidEstudio").val();
	//alert(totalestudios);
	for (var i = 0; i <= totalestudios; i++) {
		if ($('#estudioAsignado'+i).length > 0) {
			var checked = $("#estudioAsignado"+i).prop('checked');
			if (!checked) {
				var Deseleccionado = i;
				//alert(Deseleccionado);
				$.ajax({
			        url : "http://localhost/CDI/Panel/index.php/Cruddoctores/quitaEstudiosDoctor/"+i+"/"+idDoc,
			        type: "post",
			        dataType: "html",
			        success: function(data)
			        {
			            // traeestudio(idDoc);
			        },
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error get data from ajax');
			        }
			    });
			}
		}
	}
	
	setTimeout(function(){ verificaExistencia(idDoc); }, 500);
}

function verificaExistencia(idDoc) {
	$("#pintaestudiosAsig").html("");
	$("#pintaestudiosDispo").html("");
	$("#headerAsignados").html("");
	$("#headerDisponibles").html("");
	var idDoc = idDoc;
	$.ajax({
		url : "http://localhost/CDI/Panel/index.php/Cruddoctores/buscaExistencia/"+idDoc,
		type: "post",
		dataType: "JSON",
		success: function(data)
		{
			if (data != "") {
				if (data.length>0) {
					
					$("#headerAsignados").append('Estudios Asignados');
					for (var i = 0; i <= data.length; i++) {
						// alert(data[i]["idEstudio"]);
						// $("#inputestudio"+data[i]["idEstudio"]).hide();
						$("#pintaestudiosAsig").append('<div class="col-md-3" style="padding:0px;"><div class="col-md-12" style="padding:0px;">'+                                                     
			                                                '<input type="checkbox" name="estudioAsignado'+data[i]["idEstudio"]+'" id="estudioAsignado'+data[i]["idEstudio"]+'" class="filled-in chk-col-light-blue" checked/>'+
			                                                '<label for="estudioAsignado'+data[i]["idEstudio"]+'">'+data[i]["nombreEstudio"]+'</label>'+
			                                            '</div></div>');
						// ocultainput(data[i]["idEstudio"]);
						$("#ultimoidEstudio").val(data[i]["idEstudio"]);
					}
				 }
			}else{
				$("#headerAsignados").append('Estudios Asignados');
				$("#pintaestudiosAsig").append('Este médico no tiene estudios asignados');
			}		
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
		    alert('Error get data from ajax');
		}
	});
}

function ocultainput(id) {
	var id = id;
	// alert("El id entrante es: "+id);
	$("#inputestudio"+id).css("display","none");
}