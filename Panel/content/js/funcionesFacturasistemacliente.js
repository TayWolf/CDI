window.onload = cargaDatos();
function cargaDatos() {
    getlistado();
}

function getlistado ()
{

    var fechaconsu=$("#fechaconsu").val();
    var fechaconsuFinal=$("#fechaconsuFinal").val();
    var pacienteName=encodeURIComponent($("#pacienteName").val());
    var adeudoMinimo=encodeURIComponent($("#adeudoMinimo").val());
    var adeudoMaximo=encodeURIComponent($("#adeudoMaximo").val());
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
    if(!adeudoMinimo.length>0)
    {
        adeudoMinimo="0";
    }
    if(!adeudoMaximo.length>0)
    {
        adeudoMaximo="0";
    }

    var direccion="http://localhost/CDI/Panel/index.php/CrudFacturas/traeListaClientes/"+fechaconsu+"/"+fechaconsuFinal+"/"+pacienteName.replace(" ", "%20")+"/"+adeudoMinimo+"/"+adeudoMaximo;
    $.ajax({
        url : direccion,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            var tabla="";
            if(data.length > 0)
            {

                for(i=0; i<data.length; i++)
                {

                    var deuda=data[i]['deuda'];
                    if(deuda!=0)
                    tabla+= '<tr id="trFacturacion'+data[i]["idFacturacionClientes"]+'" >' +
                        '<td>'+data[i]["idFacturacionClientes"]+'</td>' +
                        '<td>'+data[i]["nombreCliente"]+'</td>' +
                        '<td>$ '+data[i]['montoPago']+'</td>' +
                        '<td  id="deudores'+data[i]["idFacturacionClientes"]+'"><a onclick="abrirVentanaPago('+data[i]["idFacturacionClientes"]+')">$ '+data[i]['deuda']+'</a></td>' +
                        '<td id="diasCredito'+data[i]["idFacturacionClientes"]+'">'+data[i]["diasCredito"]+' días</td>' +
                        '<td>'+data[i]['fecha']+'</td>' +
                        '<td>'+data[i]['nombreEmpresa']+'</td>' +
                        '<td><a onclick="abrirFacturacion('+data[i]["idFacturacionClientes"]+')">Detalle</a></td>' +
                        '<td><a onclick="historial('+data[i]["idFacturacionClientes"]+')" style="cursor: pointer;">Historial</a></td>' +
                        '</tr>';
                    else
                        tabla+= '<tr id="trFacturacion'+data[i]["idFacturacionClientes"]+'" >' +
                            '<td>'+data[i]["idFacturacionClientes"]+'</td>' +
                            '<td>'+data[i]["nombreCliente"]+'</td>' +
                            '<td>$ '+data[i]['montoPago']+'</td>' +
                            '<td  id="deudores'+data[i]["idFacturacionClientes"]+'">$ '+data[i]['deuda']+'</td>' +
                            '<td id="diasCredito'+data[i]["idFacturacionClientes"]+'">'+data[i]["diasCredito"]+' días</td>' +
                            '<td>'+data[i]['fecha']+'</td>' +
                            '<td>'+data[i]['nombreEmpresa']+'</td>' +
                            '<td><a onclick="abrirFacturacion('+data[i]["idFacturacionClientes"]+')">Detalle</a></td>' +
                            '<td><a onclick="historial('+data[i]["idFacturacionClientes"]+')" style="cursor: pointer;">Historial</a></td>' +
                            '</tr>';

                    //traerdiasCredito(data[i]["idCliente"]);
                }

            }
            $("#listado").html(tabla);

        }
    });
}
function abrirFacturacion(idFacturacion)
{
    console.log("popup"+idFacturacion);
    window.open("http://localhost/CDI/Panel/index.php/CrudFacturas/verDetallesFacturaCliente/"+idFacturacion, '_blank', 'location=yes,height=480,width=1000,scrollbars=yes,status=yes');
}

function traerdiasCredito (idCli)
{
    var direccion="http://localhost/CDI/Panel/index.php/CrudFacturas/traerDiasC/"+idCli;
    $.ajax({
        url : direccion,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            if(data.length > 0)
            {
                for(i=0; i<data.length; i++)
                {
                     $("#diasCredito"+data[i]['cliente']).html("");
                    $("#diasCredito"+data[i]['cliente']).append(data[i]['diasCredito']+' días');                    
                }
            }
        }
    });
}
function abrirVentanaPago(idFacturacion)
{
    window.open("http://localhost/CDI/Panel/index.php/CrudFacturas/verVentanaPagoCliente/"+idFacturacion, '_blank', 'location=yes,height=480,width=1000,scrollbars=yes,status=yes');
}
function historial(idFacturacion)
{
    window.open("http://localhost/CDI/Panel/index.php/CrudFacturas/verHistorialPagosCliente/"+idFacturacion, '_blank', 'location=yes,height=480,width=1000,scrollbars=yes,status=yes');
}
