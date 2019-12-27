function modifica($idD) {
	var idD = $idD;
$('#status'+idD).on('change', function(event) {
    if($(this).is(':checked')) {
        swal('EXITO!', 'Doctor Activado, El status del doctor ha cambiado a Activo', 'success')
        activado($idD);
    } else {
        swal('EXITO!', 'Doctor Desactivado, El status del doctor ha cambiado a Inactivo', 'success')                                    
        desactivado($idD);    
    }
});
}

function desactivado(idD)
{
    var id=idD;
    var url;
    url= "http://cointic.com.mx/CDI/Panel/index.php/Cruddoctores/inactivo/"+id;
    $.ajax({
    	url : url,
        type: "POST",
        data: {'id':id},
        dataType: "HTML",
		success: function(data)
	    {
	        //location.reload();
	    }          
    });
}

function activado(idD)
{
    var id=idD;
    var url;
    url= "http://cointic.com.mx/CDI/Panel/index.php/Cruddoctores/activo/"+id;
	$.ajax({
        url : url,
        type: "POST",
        data: {'id':id},
        dataType: "HTML",
		success: function(data)
        {

        }
                
    });
}
