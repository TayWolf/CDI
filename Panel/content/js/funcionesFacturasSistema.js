window.onload = getlistado;
function getlistado ()
{
    $("#listado").html("");
    var fechaconsu=$("#fechaconsu").val();
    var fechaconsuFinal=$("#fechaconsuFinal").val();
    var pacienteName=$("#pacienteName").val();
    if(!fechaconsu.length>0)
    {
        fechaconsu="0";
    }
    if(!fechaconsuFinal.length>0)
    {
        fechaconsuFinal="0";
    }
    if(!pacienteName.length>0)
    {
        pacienteName="0";
    }
    var direccion="http://localhost/CDI/Panel/index.php/CrudFacturas/traeLista/"+fechaconsu+"/"+fechaconsuFinal+"/"+pacienteName.replace(" ", "%20");
    $.ajax({
        url : direccion,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
           // alert("dato")
            if(data.length > 0)
            {
                for(i=0; i<data.length; i++)
                {
                    var formaPago=(data[i]['formaPago']==1)?"Transferencia":(data[i]['formaPago']==2)?"Efectivo":"Deposito bancario";
                    var usoCFDI=(data[i]['usoCFDI']==1)?"Gastos generales":(data[i]['usoCFDI']==2)?"Honorarios médicos":"Por definir";
                    var metodoPago=(data[i]['metodoPago']==1)?"Crédito":"Contado";
                    var pagadoFactura=data[i]['precioEstudio'];


                    $("#listado").append(
                        '<tr id="trFacturacion'+data[i]["idFacturacion"]+'" onclick="abrirFacturacion('+data[i]["idFacturacion"]+')">' +
                        '<td>'+(i+1)+'</td>' +
                        '<td>'+data[i]["folioCita"]+'</td>' +
                        '<td>'+data[i]["nombrePaci"]+'</td>' +
                        '<td>$ '+data[i]["precioEstudio"]+'</td>' +
                        '<td>$ '+data[i]['montoPago']+'</td>' +
                        '<td>'+data[i]['fecha']+'</td>' +
                        '<td>'+formaPago+'</td>' +
                        '<td>'+metodoPago+'</td>' +
                        '<td>'+usoCFDI+'</td>' +
                        '<td>'+data[i]['nombreEmpresa']+'</td>' +
                        '</tr>');
                }
            }
        }
    });
}
function abrirFacturacion(idFacturacion)
{
    window.open("http://localhost/CDI/Panel/index.php/CrudFacturas/verFactura/"+idFacturacion, '_blank', 'location=yes,height=480,width=1000,scrollbars=yes,status=yes');
}