 $(function(){
  $("#form").on("submit", function(e){ 
        e.preventDefault();
         $('#cargando').html('<img src="http://localhost/CDI/Panel/content/images/loading.gif"/>');
         var page = $(this).attr('data');        
        var dataString = 'page='+page;
        var formData = new FormData(document.getElementById("form"));
         $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudclientes/agregaCliente/",
                type: "post",
                data: formData,
                dataType: "HTML",
                cache: false,
                contentType: false,
                 processData: false,
                success: function(data)
                {
                   // alert(data);
                    $('#cargando').fadeIn(1000).html(data);
                    location.href='http://localhost/CDI/Panel/index.php/Crudclientes';
                    
                }

    });
 });
   });

 function trarMunicipio()
    {

        $("#municipio").html('');
        var idEdo=$("#estado").val();
        //alert(idEdo);
        $("#datos").show();
        if (idEdo!="") 
        {
             $.ajax({
                url : "http://localhost/CDI/Panel/index.php/Crudclientes/getMuni/" + idEdo,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    if (data.length>0) 
                    {
                        for (i=0; i<data.length; i++)
                        {
                            $("#municipio").append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']));
                        }
                    }
                    traerColonia();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }else
        {
           $("#datos").hide();  
        }
        
    }
function traerColonia()
{
    $("#coloniaCl").html('');
        var idMuni=$("#municipio").val();
        //alert(idEdo);
         $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudclientes/getColo/" + idMuni,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if (data.length>0) 
            {
                for (i=0; i<data.length; i++)
                {
                    $("#coloniaCl").append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']));
                }
            }
            traerPostal();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });   
}

function traerPostal()
{
     $("#codigoP").html('');
    var coloniaCl=$("#coloniaCl").val();
        //alert(idEdo);
         $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudclientes/getPostal/" + coloniaCl,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if (data.length>0) 
            {
                for (i=0; i<data.length; i++)
                {
                    $("#codigoP").append(new Option(data[i]['cp'],data[i]['idRegiones']));
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });   
}