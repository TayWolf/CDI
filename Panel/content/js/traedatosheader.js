window.onload = inicio();
// $(document).on("ready",inicio);
function inicio(){
    var idubase = $("#idubase").val();
    $.ajax({
        url : "http://localhost/CDI/Panel/index.php/Crudusuarios/obtenerDatosbase/" + idubase,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            
            var ruta = "http://localhost/CDI/Panel/content/images/usuarios/user.png";
            $("#nombreusuarioxz").append(data.nombreUser);
            $("#correousuarioxz").append(data.correoUser);
            $("#respons").val(data.nombreUser);
            $("#respons2").val(data.nombreUser);
            // alert("entra")
            $("#fotousuarioxz").append("<img src='"+ruta+"' width='48' height='48' alt='User' style='border-radius:50%'/>");
            pintarMenu(data.tipoUser);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

var user="";
var Contrasena="";
var empresa="";
var medico="";
var sala="";
var areInterna="";
var estudio="";
var medicoRemite ="";
var cliente="";
var pacientee="";
var categoria="";
var proveedor="";
var articulo="";
var linea="";
var ingresoCompra="";
var entrada="";
var salida="";
var ordenCompra="";
var citass="";
var todasCitas="";
var cotizaciones="";
var pedirarticulo="";
var estudioPorsala="";
var entregaEstudio="";
var pacienteEspera="";
var resumenSistema="";
var facturacionCliente="";
var facturacionCliente="";
var facturacioncaja="";
var facturacionsistema="";
var listadofacturacioncliente="";
var deudores="";
var permisos="";
var arregloMenus=[];
var idI=1;
function pintarMenu(tipoUser)
{
   
   $.ajax({
            url : "http://localhost/CDI/Panel/index.php/Crudusuarios/pintarMenus/" + tipoUser,
            type: "post",
            dataType: "JSON",
                success: function(data)
                    {
                        if (data.length>0)
                            {
                                
                                for (i=0; i< data.length; i++) {
                                    if (data[i]["idModulo"]==0)
                                     {
                                        user = '<li><a href="http://localhost/CDI/Panel/index.php/Crudusuarios"><i class="material-icons">supervisor_account</i>Usuarios</a></li>';
                                        arregloMenus.push(user);         
                                     }
                                     if (data[i]["idModulo"]==1)
                                     {
                                        Contrasena = '<li><a href="http://localhost/CDI/Panel/index.php/CrudContrasena"><i class="material-icons">vpn_key</i>Contraseña</a></li>';
                                        arregloMenus.push(Contrasena); 
                                     }
                                     if (data[i]["idModulo"]==2)
                                     {
                                        empresa = '<li><a href="http://localhost/CDI/Panel/index.php/Crudempresas"><i class="material-icons">domain</i>Empresas</a></li>';
                                        arregloMenus.push(empresa);
                                     }
                                     if (data[i]["idModulo"]==3)
                                     {
                                        medico = '<li><a href="http://localhost/CDI/Panel/index.php/Cruddoctores"><i class="material-icons">portrait</i>Médicos</a></li>';
                                        arregloMenus.push(medico);
                                     }
                                     if (data[i]["idModulo"]==4)
                                     {
                                        sala = '<li><a href="http://localhost/CDI/Panel/index.php/Crudsalas"><i class="material-icons">layers</i>Salas</a></li>';
                                        arregloMenus.push(sala);
                                     }
                                     if (data[i]["idModulo"]==5)
                                     {
                                        areInterna = '<li><a href="http://localhost/CDI/Panel/index.php/Crudareainterna"><i class="material-icons">map</i>Área Interna</a></li>';
                                        arregloMenus.push(areInterna);
                                     }
                                     if (data[i]["idModulo"]==6)
                                     {
                                        estudio = '<li><a href="http://localhost/CDI/Panel/index.php/Crudestudios"><i class="material-icons">colorize</i>Estudio</a></li>';
                                        arregloMenus.push(estudio);
                                     }
                                     if (data[i]["idModulo"]==7)
                                     {
                                        medicoRemite = '<li><a href="http://localhost/CDI/Panel/index.php/Crudremitentes"><i class="material-icons">supervisor_account</i>Médico remitente</a></li>';
                                        arregloMenus.push(medicoRemite);
                                     }
                                     if (data[i]["idModulo"]==8)
                                     {
                                        cliente = '<li><a href="http://localhost/CDI/Panel/index.php/Crudclientes"><i class="material-icons">people_outline</i>Cliente</a></li>';
                                        arregloMenus.push(cliente);
                                     }
                                     if (data[i]["idModulo"]==9)
                                     {
                                        pacientee = '<li><a href="http://localhost/CDI/Panel/index.php/Crudpacientes"><i class="material-icons">accessibility</i>Paciente</a></li>';
                                        arregloMenus.push(pacientee);
                                     }
                                     if (data[i]["idModulo"]==10)
                                     {
                                        categoria = '<li><a href="http://localhost/CDI/Panel/index.php/Crudcategorias"><i class="material-icons">line_weight</i>Categoria</a></li>';
                                        arregloMenus.push(categoria);
                                     }
                                     if (data[i]["idModulo"]==11)
                                     {
                                        proveedor = '<li><a href="http://localhost/CDI/Panel/index.php/Crudproveedores"><i class="material-icons">local_shipping</i>Proveedor</a></li>';
                                        arregloMenus.push(proveedor);
                                     }
                                     if (data[i]["idModulo"]==12)
                                     {
                                        articulo = '<li><a href="http://localhost/CDI/Panel/index.php/Crudarticulos"><i class="material-icons">pets</i>Articulo</a></li>';
                                        arregloMenus.push(articulo);
                                     }
                                     if (data[i]["idModulo"]==13)
                                     {
                                        linea = '<li><a href="http://localhost/CDI/Panel/index.php/Crudlinea"><i class="material-icons">line_weight</i>Linea</a></li>';
                                        arregloMenus.push(linea);
                                     }
                                     if (data[i]["idModulo"]==14)
                                     {
                                        ingresoCompra = '<li><a href="http://localhost/CDI/Panel/index.php/Crudordencompra"><i class="material-icons">monetization_on</i>Ingreso Compra</a></li>';
                                        arregloMenus.push(ingresoCompra);
                                     }
                                     if (data[i]["idModulo"]==15)
                                     {
                                        entrada = '<li><a href="http://localhost/CDI/Panel/index.php/Crudentradas"><i class="material-icons">call_received</i>Entrada</a></li>';
                                        arregloMenus.push(entrada);
                                     }
                                     if (data[i]["idModulo"]==16)
                                     {
                                        salida = '<li><a href="http://localhost/CDI/Panel/index.php/Crudsalida"><i class="material-icons">call_made</i>Salida</a></li>';
                                        arregloMenus.push(salida);
                                     }
                                     if (data[i]["idModulo"]==17)
                                     {
                                        ordenCompra = '<li><a href="http://localhost/CDI/Panel/index.php/Crudordencompra"><i class="material-icons">shopping_cart</i>Orden Compra</a></li>';
                                        arregloMenus.push(ordenCompra);
                                     }
                                     if (data[i]["idModulo"]==18)
                                     {
                                        citass = '<li><a href="http://localhost/CDI/Panel/index.php/Crudcitas"><i class="material-icons">schedule</i>Citas</a></li>';
                                        arregloMenus.push(citass);
                                     }
                                     if (data[i]["idModulo"]==19)
                                     {
                                        todasCitas = '<li><a href="http://localhost/CDI/Panel/index.php/Crudcitas/citasProgramadas"><i class="material-icons">view_comfy</i>Confirmación de Citas</a></li>';
                                        arregloMenus.push(todasCitas);
                                     }
                                     if (data[i]["idModulo"]==20)
                                     {
                                        cotizaciones = '<li><a href="http://localhost/CDI/Panel/index.php/Crudcotizaciones"><i class="material-icons">local_atm</i>Cotizaciones</a></li>';
                                        arregloMenus.push(cotizaciones);
                                     }
                                     if (data[i]["idModulo"]==21)
                                     {
                                        pedirarticulo = '<li><a href="http://localhost/CDI/Panel/index.php/Crudpedidos/listaPedido"><i class="material-icons">notifications</i>Solicitar articulo</a></li>';
                                        arregloMenus.push(pedirarticulo);
                                     }
                                     if (data[i]["idModulo"]==22)
                                     {
                                        estudioPorsala = '<li><a href="http://localhost/CDI/Panel/index.php/Crudestudiosporsala"><i class="material-icons">storage</i>Estidio por sala</a></li>';
                                        arregloMenus.push(estudioPorsala);
                                     }
                                     if (data[i]["idModulo"]==23)
                                     {
                                        entregaEstudio = '<li><a href="http://localhost/CDI/Panel/index.php/Crudestudiosporsala/entrega"><i class="material-icons">note_add</i>Entrega Resultados</a></li>';
                                        arregloMenus.push(entregaEstudio);
                                     }
                                     if (data[i]["idModulo"]==24)
                                     {
                                        pacienteEspera = '<li><a href="http://localhost/CDI/Panel/index.php/CrudPacienteEspera"><i class="material-icons">access_alarm</i>Pacientes en Espera</a></li>';
                                        arregloMenus.push(pacienteEspera);
                                     }
                                     if (data[i]["idModulo"]==25)
                                     {
                                        resumenSistema = '<li><a href="http://localhost/CDI/Panel/index.php/CrudAdministracion"><i class="material-icons">dvr</i>Resumen Sistema</a></li>';
                                        arregloMenus.push(resumenSistema);
                                     }
                                     if (data[i]["idModulo"]==26)
                                     {
                                        facturacionCliente = '<li><a href="http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/verFacturacion"><i class="material-icons">payment</i>Facturar a clientes</a></li>';
                                        arregloMenus.push(facturacionCliente);
                                     }
                                     if (data[i]["idModulo"]==27)
                                     {
                                        facturacioncaja = '<li><a href="http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/verFacturacionCaja"><i class="material-icons">credit_card</i>Facturar a pacientes</a></li>';
                                        arregloMenus.push(facturacioncaja);
                                     }
                                     if (data[i]["idModulo"]==28)
                                     {
                                        facturacionsistema = '<li><a href="http://localhost/CDI/Panel/index.php/CrudFacturas"><i class="material-icons">list</i>Facturas Emitidas a Pacientes</a></li>';
                                        arregloMenus.push(facturacionsistema);
                                     }
                                     if (data[i]["idModulo"]==29)
                                     {
                                        listadofacturacioncliente = '<li><a href="http://localhost/CDI/Panel/index.php/CrudFacturas/Clientes"><i class="material-icons">list</i>Facturas Emitidas a Clientes</a></li>';
                                        arregloMenus.push(listadofacturacioncliente);
                                     }
                                     if (data[i]["idModulo"]==30)
                                     {
                                        deudores = '<li><a href="http://localhost/CDI/Panel/index.php/Cruddeudores"><i class="material-icons">supervisor_account</i>Deudores</a></li>';
                                        arregloMenus.push(deudores);
                                     }
                                     if (data[i]["idModulo"]==31)
                                     {
                                        permisos = '<li><a href="http://localhost/CDI/Panel/index.php/CrudPermisos"><i class="material-icons">lock_open</i>Permisos</a></li>';
                                        arregloMenus.push(permisos);
                                     }
                                     
                                 }
                                 var x=0;
                                 for (x; x < arregloMenus.length; x++)
                                 {

                                     if (x%8==0 && x!=0)
                                     {
                                         console.log(x)
                                         idI++;
                                     }
                                     $("#listado"+idI).append(arregloMenus[x]);


                                     //alert(idI)
                                 }
                                //Quita las listas que estan vacias
                                 if(!$("#listado4").html())
                                 {
                                     $("#listado4").remove();
                                 }
                                 if(!$("#listado3").html())
                                 {
                                     $("#listado3").remove();
                                 }
                                 if(!$("#listado2").html())
                                 {
                                     $("#listado2").remove();
                                 }
                                 if(!$("#listado1").html())
                                 {
                                     $("#listado1").remove();
                                 }


                                 
                            }
                        },
                error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
        });
    
}