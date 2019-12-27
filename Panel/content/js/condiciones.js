function diferenciador($id) {
	var id = $id;
	$.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudclientes/buscacondiciones/" + id,
        type: "GET",
        dataType: "json",
        success: function(data)
        {
        	//alert(data);}
        	if (data == null) {
        		location.href ="http://localhost/CDI/Panel/index.php/Crudclientes/CondicionesAlta?id="+id+"";
        	}else{
        		location.href ="http://localhost/CDI/Panel/index.php/Crudclientes/CondicionesDetalle?id="+id+"";
        	}
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}