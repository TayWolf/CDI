		  //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de usuario inicio++++++++++++++++++++++++++++++++++++++++++++
		  function buscarusuario()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }else if(nombrec == "administrador"){
		        nombrec = "1";
		      }else if (nombrec == "empleado") {
		        nombrec = "2";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorusuario/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      if (obj["tipoUser"]==1) {
		                        var tip="Administrador";
		                      }
		                      if (obj["tipoUser"]==2) {
		                        var tip="Empleado";
		                      }
		                      if (obj["fotoUser"]=="null" || obj["fotoUser"] == "") {
		                          obj["fotoUser"]='user.png';
		                      }
		                      var iduser = obj["idUser"];
		                      var nombre = obj["nombreUser"];
		                      var tipo = tip;
		                      var correo = obj["correoUser"];
		                      var password = obj["password"];
		                      $("#tabla").append('<tr><td style="display:none;">'+iduser+'</td><td>'+nombre+'</td><td>'+tipo+'</td><td>'+correo+'</td><td>'+password+'</td><td><a href="#" onclick="confirmaDeleteUser('+obj["idUser"]+');">Eliminar</a></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaUsuarios').Tabledit({
		                  url: 'Crudusuarios/modificarDatos/',
		                  eventType: 'dblclick',
		                  editButton: false,
		                  deleteButton:false,
		                  columns: {
		                      identifier: [0, 'iduser'],
		                      editable: [[1, 'nombre'], [2, 'tipo', '{"0": "Elija una opción", "1": "Administrador", "2": "Empleado"}'],[3, 'correo'],[4, 'password']]
		                  }
		                });
		              }
		          })
		  }
		  ///// buscador lineas **////

		  	function buscarlinea()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorlinea/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      var idLinea = obj["idLinea"];
		                      var nombreLin = obj["nombre"];
		                      var controlCad = obj["controla_caducidad"];
		                      if (controlCad==1)
		                       {
		                       	tipo="SI"
		                       }
		                       if (controlCad==2)
		                       {
		                       	tipo="NO"
		                       }
		                      $("#tabla").append('<tr><td style="display:none;">'+idLinea+'</td><td>'+nombreLin+'</td><td>'+tipo+'</td><td><a href="#" onclick="confirmaDeleteLinea('+obj["idLinea"]+');">Eliminar</a></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaLinea').Tabledit({
		                  url: 'Crudlinea/modificarDatos/',
		                  eventType: 'dblclick',
		                  editButton: false,
		                  deleteButton:false,
		                  columns: {
						        identifier: [0, 'idLinea'],
						        editable: [[1, 'nombre'],[2,'tipo', '{"": "Control de Caducidad", "1": "SI", "2": "NO"}']]
						    }
		                });
		              }
		          })
		  }


		  ///// fin buscador lineas ////**

		  //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de categorias++++++++++++++++++++++++++++++++++++++++++++
		  function buscarcategoria()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorcategoria/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      var idcategoria = obj["idCat"];
		                      var nombreCat = obj["nombreCat"];
		                      $("#tabla").append('<tr><td style="display:none;">'+idcategoria+'</td><td>'+nombreCat+'</td><td><a href="#" onclick="confirmaDeleteCategoria('+obj["idCat"]+');">Eliminar</a></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaCategorias').Tabledit({
		                  url: 'Crudcategorias/modificarDatos/',
		                  eventType: 'dblclick',
		                  editButton: false,
		                  deleteButton:false,
		                  columns: {
		                      identifier: [0, 'idcategoria'],
		                      editable: [[1, 'nombreCat']]
		                  }
		                });
		              }
		          })
		  }
		  //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de categorias++++++++++++++++++++++++++++++++++++++++++++
		  function buscarproveedor()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorproveedor/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      var idproveedor = obj["idProveedor"];
		                      var nombreP = obj["nombreP"];
		                      var direccion = obj["direccion"];
		                      var poblacion = obj["poblacion"];
		                      var colonia = obj["colonia"];
		                      var codigo_postal = obj["codigo_postal"];
		                      var reg_fed_cau = obj["reg_fed_cau"];
		                      var nombreContacto = obj["nombreContacto"];
		                      var telefonoUno = obj["telefonoUno"];
		                      var saldo = obj["saldo"];
		                      $("#tabla").append('<tr><td style="display:none;">'+idproveedor+'</td><td>'+nombreP+'</td><td>'+direccion+'</td><td>'+poblacion+'</td><td>'+colonia+'</td><td>'+codigo_postal+'</td><td>'+reg_fed_cau+'</td><td>'+nombreContacto+'</td><td>'+telefonoUno+'</td><td>'+saldo+'</td><td><a href="#" onclick="confirmaDeleteProveedor('+obj["idProveedor"]+');">Eliminar</a></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaProveedores').Tabledit({
		                  url: 'Crudproveedores/modificarDatos/',
		                  eventType: 'dblclick',
		                  editButton: false,
		                  deleteButton:false,
		                  columns: {
		                      identifier: [0, 'idproveedor'],
		                      editable: [[1, 'nombreproveedor'],[2, 'direccion'],[3, 'poblacion'],[4, 'colonia'],[5, 'codigopostal'],[6, 'reg_fed_cau'],[7, 'nomcontacto'],[8, 'telefono'],[9, 'saldo']]
		                  }
		                });
		              }
		          })
		  }

		   function buscararea()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorarea/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      var idArea = obj["idArea"];
		                      var nombreArea = obj["nombreArea"];

		                      $("#tabla").append('<tr><td style="display:none;">'+idArea+'</td><td>'+nombreArea+'</td><td>Modificar</td><td><a href="#" onclick="confirmaDeleteArea('+obj["idArea"]+');">Eliminar</a></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaProveedores').Tabledit({
		                  url: 'Crudproveedores/modificarDatos/',
		                  eventType: 'dblclick',
		                  editButton: false,
		                  deleteButton:false,
		                  columns: {
		                      identifier: [0, 'idproveedor'],
		                      editable: [[1, 'nombreproveedor'],[2, 'direccion'],[3, 'poblacion'],[4, 'colonia'],[5, 'codigopostal'],[6, 'reg_fed_cau'],[7, 'nomcontacto'],[8, 'telefono'],[9, 'saldo']]
		                  }
		                });
		              }
		          })
		  }

		  		  //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de pedidos++++++++++++++++++++++++++++++++++++++++++++
		  function buscarpedido()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorpedido/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      var idSolicitud = obj["idSolicitud"];
		                      var idUser = obj["idUser"];
		                      var fechaPedido = obj["fechaPedido"];
		                      var noPedido = obj["noPedido"];
		                      var AreaPedido = obj["AreaPedido"];
		                      var personaPedido = obj["personaPedido"];
		                      $("#tabla").append('<tr><td style="display:none;">'+idSolicitud+'</td><td>'+fechaPedido+'</td><td>'+AreaPedido+'</td><td>'+personaPedido+'</td><td><a href="#" data-toggle="modal" data-target="#defaultModalDetalle" onclick="abrirVentanaDetalle('+idSolicitud+')">Ver</a></td><td><a href="#" onClick="pdfDetalle('+idSolicitud+')">PDF</a></td><td><a href="#" onClick="eliminarPedido('+idSolicitud+')">Eliminar</a></td>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaPedidos').Tabledit({
		                  url: 'Crudpedidos/modificarDatos/',
		                  eventType: 'dblclick',
		                  editButton: false,
		                  deleteButton:false,
		                  columns: {
		                      identifier: [0, 'idSolicitud'],
		                      editable: [[1, 'fechaPedido'],[2, 'AreaPedido'],[3, 'personaPedido']]
		                  }
		                });
		              }
		          })
		  }




		  //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de empresas inicio++++++++++++++++++++++++++++++++++++++++++++
		  function buscarempresa()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorempresa/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                    var obj= data[i];
		                    var id = obj["idEmpresa"];
		                    var nombre = obj["nombreEmpresa"]
		                    var rfc = obj["RFC"];
		                    var direccion = obj["direccionEmpresa"];
		                    var colonia = obj["coloniaEmpresa"];
		                    var estado = obj["EstadoEmpresa"];
		                    var telefono = obj["telefonoEmpresa"];
		                    var contacto = obj["nombreContacto"];

		                    $("#tabla").append('<tr><td style="display:none;">'+id+'</td><td>'+nombre+'</td><td>'+rfc+'</td><td>'+direccion+'</td><td>'+colonia+'</td><td>'+estado+'</td><td>'+telefono+'</td><td>'+contacto+'</td><td><a href="#" onclick="deleteEmpresa('+id+');">Eliminar</a></td></tr>'); 
		                    $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaEmpresas').Tabledit({
		                url: 'Crudempresas/modificarDatos/',
		                eventType: 'dblclick',
		                editButton: false,
		                deleteButton:false,
		                columns: {
		                    identifier: [0, 'idempresa'],
		                    editable: [[1, 'nombre'], [2, 'RFC'],[3, 'direccion'],[4, 'colonia'],[5, 'estado'],[6, 'telefono'],[7, 'contacto']]
		                    }
		                });
		              }
		          })
		  }
		  //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de doctores inicio++++++++++++++++++++++++++++++++++++++++++++
		  function buscardoctor()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }else if(nombrec == "activo"){
		        nombrec = "1";
		      }else if (nombrec == "inactivo") {
		        nombrec = "2";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadordoctor/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data!= "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      if (obj["status"]==1) {
		                        var status="checked";
		                      }else{
		                        var status="";
		                      }
		                      var idDoctor = obj["idDoctor"];
		                      var clave = obj["claveDoc"];
		                      var nombreDoc = obj["nombreDoc"];
		                      var fecha = obj["fechanaciDoc"];
		                      var cedula = obj["cedulaDoc"];
		                      var uni = obj["universidadDoc"];
		                      var horario = obj["horarioDoc"];

		                      $("#tabla").append('<tr><td style="display:none;">'+idDoctor+'</td><td>'+clave+'</td><td>'+nombreDoc+'</td><td>'+fecha+'</td><td>'+cedula+'</td><td>'+uni+'</td><td>'+horario+'</td><td><div class="col-sm-3" style="margin-bottom:0px;"><div class="switch"><label><input id="status'+idDoctor+'" onclick="modifica('+idDoctor+');" type="checkbox" '+status+'><span class="lever switch-col-deep-purple"></span></label></div></div></td></tr>'); 
		                      
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }

		                $('#tablaDoctores').Tabledit({
		          url: 'Cruddoctores/modificarDatos/',
		          eventType: 'dblclick',
		          editButton: false,
		          deleteButton:false,
		          columns: {
		              identifier: [0, 'idD'],
		              //editable: [[1, 'nombre'], [2, 'claveDoc'],[3, 'nombreDoc'],[4, 'fechanaciDoc'],[5, 'cedulaDoc'],[6, 'universidadDoc'], [7, 'horarioDoc']]
		              editable: [[1, 'claveDoc'], [2, 'nombre'],[3, 'fecha'],[4, 'cedulaDoc'],[5, 'universidadDoc'],[6, 'horarioDoc'] ]
		          }
		          });
		                cambiainput();
		              }
		          })
		  }
		  //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de salas inicio++++++++++++++++++++++++++++++++++++++++++++
		  function buscarsala()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorsala/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      var idSala=obj["idSala"];
		                      var nombre=obj["nombre"];
		                      if (obj["horarios"]==1) {
		                        var checked="checked";
		                      }if (obj["horarios"]==2) {
		                        var checked="";
		                      }
		                        var tipo=obj["tipo"];
		                        var clave=obj["clave"];

		                      $("#tabla").append('<tr><td style="display:none">'+idSala+'</td><td>'+nombre+'</td><td><input type="checkbox" onclick="horario('+obj["idSala"]+')"  id="horass'+obj["idSala"]+'" name="horass'+obj["idSala"]+'" class="filled-in chk-col-purple" '+checked+'><label for="horass'+obj["idSala"]+'"></label></td><td>'+tipo+'</td><td>'+clave+'</td> <td><a href="#" onclick="traerIdSala('+obj["idSala"]+');traeNombreSala('+"'"+obj["nombre"]+"'"+');identificaEstudiosAsignados();" data-toggle="modal" data-target="#myModal2">Asignar Estudios</a></td><td><a href="#" onclick="traerIdSala('+obj["idSala"]+');traeNombreSala('+"'"+obj["nombre"]+"'"+');identificaMedicosAsignados();" data-toggle="modal" data-target="#myModal3">Asignar Médicos</a></td><td><a href="#" onclick="deleteSala('+obj["idSala"]+');">Eliminar</a></td></tr>');
		                     // $("#tabla").append('<tr><td>'+obj["nombre"]+'</td><td><input type="checkbox" onclick="horario('+obj["idSala"]+')"  id="horass'+obj["idSala"]+'" name="horass'+obj["idSala"]+'" class="filled-in chk-col-purple" '+checked+'><label for="horass'+obj["idSala"]+'"></label></td><td><a href="http://localhost/CDI/Panel/index.php/Crudsalas/detalleSala?id='+obj["idSala"]+'"><button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">description</i></button></a></td><td><a href="http://localhost/CDI/Panel/index.php/Crudsalas/ModificarSala?id='+obj["idSala"]+'"><button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">create</i></button></a></td><td><button type="button" onclick="deleteSala('+obj["idSala"]+');" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">delete</i></button></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaSalas').Tabledit({
		                      url: 'Crudsalas/modificarDatos/',
		                      eventType: 'dblclick',
		                      editButton: false,
		                      deleteButton:false,
		                      columns: {
		                          identifier: [0, 'idSala'],
		                          editable: [[1, 'nombre'], [3, 'tipo'],[4, 'clave']]
		                      }
		                    });
		              }
		          })
		  }
		  //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de doctores remitentes inicio++++++++++++++++++++++++++++++++++++++++++++
		  //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de Estudio inicio++++++++++++++++++++++++++++++++++++++++++++
		  function buscarEstudio()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorEstudio/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      var idEstudio=obj["IdEstudio"];
		                      var nombre=obj["nombreEstudio"];
		                     
		                        var indicacionesPaciente=obj["indicacionesPaciente"];
		                        var claveSat=obj["claveSat"];

		                      $("#tabla").append('<tr><td style="display:none">'+idEstudio+'</td><td>'+nombre+'</td><td>'+indicacionesPaciente+'</td><td>'+claveSat+'</td><td>'+obj["duracion"]+'</td><td>'+obj["precioPublico"]+'</td><td><a href="#" onclick="traerId('+obj["IdEstudio"]+');identificaSalasAsignadas();" data-toggle="modal" data-target="#myModal2">Asignar Salas</a></td><td><a href="#" onclick="traerId('+idEstudio+'); traeNombre('+"'"+obj["nombreEstudio"]+"'"+');traeclientes();" data-toggle="modal" data-target="#myModal3">Asignar/Modificar Precios</a></td><td><a href="#" onclick="confirmaDeleteEstudio('+obj["IdEstudio"]+');">Eliminar</a></td></td></tr>');
		                     // $("#tabla").append('<tr><td>'+obj["nombre"]+'</td><td><input type="checkbox" onclick="horario('+obj["idSala"]+')"  id="horass'+obj["idSala"]+'" name="horass'+obj["idSala"]+'" class="filled-in chk-col-purple" '+checked+'><label for="horass'+obj["idSala"]+'"></label></td><td><a href="http://localhost/CDI/Panel/index.php/Crudsalas/detalleSala?id='+obj["idSala"]+'"><button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">description</i></button></a></td><td><a href="http://localhost/CDI/Panel/index.php/Crudsalas/ModificarSala?id='+obj["idSala"]+'"><button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">create</i></button></a></td><td><button type="button" onclick="deleteSala('+obj["idSala"]+');" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">delete</i></button></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaSalas').Tabledit({
		                      url: 'Crudsalas/modificarDatos/',
		                      eventType: 'dblclick',
		                      editButton: false,
		                      deleteButton:false,
		                      columns: {
		                          identifier: [0, 'idSala'],
		                          editable: [[1, 'nombre'], [3, 'tipo'],[4, 'clave']]
		                      }
		                    });
		              }
		          })
		  }
		  //++++++++++++++++++++++++++++++++++++++++++++++++fin Estudio++++++++++++++++++++++++++++++++++++++++++++
		  
		  function buscarremitente()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorremitente/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                     var idCliente=obj["idCliente"];
	                                                    var nombreCliente=obj["nombreCliente"];
	                                                    var Clave=obj["Clave"];
	                                                    var RFC=obj["RFC"];
	                                                    var direccionCliente=obj["direccionCliente"];
	                                                    var CP=obj["cp"];
	                                                    var Colonia=obj["nombreRegion"];
	                                                    var Municipio=obj["nombreMunicipio"];
	                                                    var Estado=obj["nombreEstado"];
	                                                    var Coloniaclave=obj["Colonia"];
	                                                    var Municipioclave=obj["municipio"];
	                                                    var Estadoclave=obj["Estado"];
	                                                    var telefono=obj["telefono"];

		                      if (control == 1) {
		                        var controll = "SI";
		                      }else{
		                        var controll = "NO";
		                      }

		                      $("#tabla").append('<tr><td style="display:none">'+idRem+'</td><td>'+nombreRem+'</td><td>'+claveRem+'</td><td>'+calleRem+'</td><td>'+telefonoRemuno+'</td><td>'+telefonoRemdos+'</td><td>'+EmailRem+'</td><td>'+especialidadRem+'</td><td>'+fechanaciRem+'</td><td id="estado'+idRem+'" ondblclick=cambiaEstado('+idRem+');>'+estado+'</td><td id="muestraselectestado'+idRem+'" style="display:none;"><input type=hidden id=valorestado'+idRem+' value='+valorestado+'><select id="selectestado'+idRem+'" name="selectestado'+idRem+'" onchange="traeMuni('+idRem+'); modificarDatosE('+idRem+');"></select></td><td id="municipio'+idRem+'" ondblclick=cambiaMuni('+idRem+');>'+muni+'</td><td id="muestraselectmuni'+idRem+'" style="display:none;"><input type=hidden id=valorciudad'+idRem+' value='+valorciudad+'><select id="selectmuni'+idRem+'" name="selectmuni'+idRem+'" onchange="traeCol('+idRem+');modificarDatosE('+idRem+');"></select></td><td id="colonia'+idRem+'"ondblclick=cambiaColo('+idRem+');>'+region+'</td><td id="muestraselectcolo'+idRem+'" style="display:none;"><select id="selectcolo'+idRem+'" name="selectcolo'+idRem+'" onchange="modificarDatosE('+idRem+');"></select></td><td>'+controll+'</td><td><a href="#" onclick="confirmaDeleteRemitente('+obj["idRemitente"]+');">Eliminar</a></td></tr>');
		                     // $("#tabla").append('<tr><td>'+nombreRem+'</td><td>'+claveRem+'</td><td>'+calleRem+'</td><td>'+telefonoRemuno+'</td><td>'+telefonoRemdos'</td><td>'+EmailRem'</td><td>'+especialidadRem'</td><td>'+fechanaciRem'</td><td><a href="#" onclick="confirmaDeleteRemitente('+obj["idRemitente"]+');">Eliminar</a></td></tr>');
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaremitente').Tabledit({
		                  url: 'Crudremitentes/modificarDatos/',
		                  eventType: 'dblclick',
		                  editButton: false,
		                  deleteButton:false,
		                  columns: {
		                      identifier: [0, 'idRemitente'],
		                      editable: [[1, 'nombreRem'], [2, 'claveRem'], [3, 'calleRem'],[4, 'telefonoRemuno'], [5, 'telefonoRemdos'], [6, 'EmailRem'], [7, 'especialidadRem'], [8, 'fecha'],[15,'control', '{"0": "Elija una opción", "1": "SI", "2": "NO"}']]
		                  }
		                });
		                cambiainput();
		              }
		          })
		  }
		    //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de clientes inicio++++++++++++++++++++++++++++++++++++++++++++
		  
		    /// inicia buscador articulo

		    function buscarArticulo()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorArticulo/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                     var idArticulo=obj["idArticulo"];
	                         var nombre=obj["nombre"];
	                         var presentacion=obj["presentacion"];
	                         var medida=obj["medida"];
	                         var ubicacion=obj["ubicacion"];
	                         var costoUni=obj["costo_unitario"];
	                         var existec=obj["existencia"];
	                         var maximo=obj["maximo"];
	                         var minimo=obj["minimo"];
	                         
		                      $("#tabla").append('<tr><td style="display:none">'+idArticulo+'</td><td>'+nombre+'</td><td>'+presentacion+'</td><td>'+medida+'</td><td>'+ubicacion+'</td><td>'+costoUni+'</td><td>'+existec+'</td><td>'+maximo+'</td><td>'+minimo+'</td><td> <a href="#" id="linea'+idArticulo+'" onclick="traerIdarticulo('+idArticulo+');identificaLineaAsignados()" data-toggle="modal" data-target="#myModal3">Asignar </a></td><td> <a href="#" id="provee'+idArticulo+'" onclick="traerIdarticulo('+idArticulo+');identificaProveAsignadosProve()" data-toggle="modal" data-target="#myModal2">Asignar </a></td><td> <a href="#" id="caduci'+idArticulo+'" onclick="listaCaduca('+idArticulo+');listaCaducaEntr('+idArticulo+');" title="Fecha de caducidad'+idArticulo+'"  data-toggle="modal" data-target="#myModal4">Ver </a></td><td> <a href="#" id="compra'+idArticulo+'" title="Historial de compras" onclick="popupHcompra('+idArticulo+');">PDF</a></td><td> <a href="#" id="entrada'+idArticulo+'" title="Historial de entradas" onclick="popupHentrada('+idArticulo+');">PDF </a></td><td> <a href="#" id="salida'+idArticulo+'" title="Historial de salidas" onclick="popupHsalida('+idArticulo+');">PDF </a></td><td><a href="#" onclick="confirmaDeleteArticulo('+obj["idArticulo"]+');">Eliminar</a></td></tr><script type="text/javascript">setTimeout(function(){colorear('+idArticulo+','+existec+','+minimo+');},1000);</script><input type="hidden" id="idArticuloactual" name="idArticuloactual">');
		                     // $("#tabla").append('<tr><td>'+nombreRem+'</td><td>'+claveRem+'</td><td>'+calleRem+'</td><td>'+telefonoRemuno+'</td><td>'+telefonoRemdos'</td><td>'+EmailRem'</td><td>'+especialidadRem'</td><td>'+fechanaciRem'</td><td><a href="#" onclick="confirmaDeleteRemitente('+obj["idRemitente"]+');">Eliminar</a></td></tr>');
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaarticulo').Tabledit({
		                  url: 'Crudarticulos/modificarDatos/',
		                  eventType: 'dblclick',
		                  editButton: false,
		                  deleteButton:false,
		                  columns: {
		                      identifier: [0, 'idArticulo'],
		                      editable: [[1, 'nombre'], [2, 'presentacion'], [3, 'medida'],[4, 'ubicacion'], [5, 'costoUni'], [6, 'existec'], [7, 'maximo'], [8, 'minimo']]
		                  }
		                });
		                cambiainput();
		              }
		          })
		  }

		    /// finzaliza buscador articulo
		  function buscarcliente()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorcliente/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                  for(var i=0; i < data.length ; i++)
		                  {


	                                                    var obj= data[i];
	                                                    var idCliente=obj['idCliente'];
	                                                    var nombreCliente=obj['nombreCliente'];
	                                                    var Clave=obj['Clave'];
	                                                    var RFC=obj['RFC'];
	                                                    var direccionCliente=obj['direccionCliente'];
	                                                    var CP=obj['cp'];
	                                                    var Colonia=obj['nombreRegion'];
	                                                    var  Municipio=obj['nombreMunicipio'];
	                                                    var Estado=obj['nombreEstado'];
	                                                    var Coloniaclave=obj['Colonia'];
	                                                    var Municipioclave=obj['municipio'];
	                                                    var Estadoclave=obj['Estado'];
	                                                    var telefono=obj['telefono'];
		                      // var obj= data[i];
		                      // var idCliente= obj["idCliente"];
		                      // var nombreCliente=obj["nombreCliente"];
		                      // var Clave=obj["Clave"];
		                      // var RFC=obj["RFC"];
		                      // var direccionCliente=obj["direccionCliente"];
		                      // var CP=obj["CP"];
		                      // var Colonia=obj["Colonia"];
		                      // var municipio=obj["municipio"];
		                      // var Estado=obj["Estado"];
		                      // var telefono=obj["telefono"];
		                      $("#tabla").append('<tr><td style="display:none;">'+idCliente+'</td><td>'+nombreCliente+'</td> <td>'+Clave+'</td> <td>'+RFC+'</td> <td>'+direccionCliente+'</td> <td id="estado'+idCliente+'" ondblclick=cambiaEstado('+idCliente+');>'+Estado+'</td> <td id="muestraselectestado'+idCliente+'" style="display: none;"> <input type="hidden" name="valorestado'+idCliente+'" id= "valorestado'+idCliente+'" value="'+Estado+'clave"> <select id="selectestado'+idCliente+'" name="selectestado'+idCliente+'" onchange="traeMuni('+idCliente+'); modificarDatosE('+idCliente+');"> </select> </td> <td id="municipio'+idCliente+'" ondblclick=cambiaMuni('+idCliente+');>'+Municipio+'</td> <td id="muestraselectmuni'+idCliente+'" style="display: none;"> <input type="hidden" name="valorciudad'+idCliente+'" id="valorciudad'+idCliente+'" value="'+Municipio+'clave"> <select id="selectmuni'+idCliente+'" onchange="traeCol('+idCliente+');modificarDatosE('+idCliente+');"> </select></td><td id="colonia'+idCliente+'" ondblclick="cambiaColo('+idCliente+');">'+Colonia+'</td> <td id="muestraselectcolo'+idCliente+'" style="display: none;"> <select id="selectcolo'+idCliente+'" name="selectcolo'+idCliente+'" onchange="modificarDatosE('+idCliente+');"> </select></td><td id="CP'+idCliente+'">'+CP+'</td><td>'+telefono+'</td><td><a onclick="diferenciador('+idCliente+');" style="cursor:pointer;">Ver / Editar</a></td><td><a href="#" onclick="deleteCliente('+obj["idCliente"]+');">Eliminar</a></td></tr>";');
		                      //$("#tabla").append('<tr><td>'+obj["nombreCliente"]+'</td><td><a onclick="diferenciador('+obj["idCliente"]+');"><button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">settings</i></button></a></td><td><a href="http://localhost/CDI/Panel/index.php/Crudclientes/detalleCliente?id='+obj["idCliente"]+'"><button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">description</i></button></a></td><td><a href="http://localhost/CDI/Panel/index.php/Crudclientes/ModificarCliente?id='+obj["idCliente"]+'"><button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">create</i></button></a></td><td><button type="button" onclick="deleteCliente('+obj["idCliente"]+');" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">delete</i></button></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                   
		                    $('#tablaclientes').Tabledit({
	    url: 'Crudclientes/modificarDatos/',
	    eventType: 'dblclick',
	    editButton: false,
	    deleteButton:false,
	    columns: {
	        identifier: [0, 'idCliente'],
	        editable: [[1, 'nombre'], [2, 'clave' ],[3, 'rfc'],[4, 'direccion'],[12, 'telefono']]
	    }
	    });
		              }
		          })
		  }
		    //++++++++++++++++++++++++++++++++++++++++++++++++Buscador de pacientes inicio++++++++++++++++++++++++++++++++++++++++++++
		  function buscarpaciente()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorpaciente/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {

		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      var idPaciente=obj["idPaciente"];
		                      var nombrePaci=obj["nombrePaci"];
		                      var generoPaci=obj["generoPaci"];
		                      if (generoPaci==1) {
		                        var genero="Masculino";
		                      }
		                      else{
		                        genero="Femenino";
		                      }
		                      var correoPaci=obj["correoPaci"];
		                      var edadPaci=obj["edadPaci"];
		                      var fechanaciPaci=obj["fechanaciPaci"];
		                      var telefonoPaci=obj["telefonoPaci"];
		                      $("#tabla").append('<tr><td style="display:none">'+idPaciente+'</td><td>'+nombrePaci+'</td><td>'+genero+'</td><td>'+correoPaci+'</td><td>'+edadPaci+'</td><td>'+fechanaciPaci+'</td><td>'+telefonoPaci+'</td><td id="nombreCliente'+idPaciente+'" ondblclick=traerCliente('+idPaciente+');>'+obj["nombreCliente"]+'</td>'+

		                      	'<td id="muestraselectCliente'+idPaciente+'" style="display: none;">'+
                                        '<select id="selectCliente'+idPaciente+'" name="selectCliente'+idPaciente+'" onchange="modificarDatosClien('+idPaciente+');"></select>'+
                                '</td>'+


		                      	'<td id="nombreRemite'+idPaciente+'" ondblclick=traerRemite('+idPaciente+');>'+obj["nombreRem"]+'</td>'+
		                      	'<td id="muestraselectRemite'+idPaciente+'" style="display: none;">'+
                                    '<select id="selectRemite'+idPaciente+'" name="selectRemite'+idPaciente+'" onchange="modificarDatosRemite('+idPaciente+');"></select>'+
                                '</td>'+


		                      	'<td><a href="#" onclick="confirmaDeleteRemitente('+obj["idRemitente"]+');">Eliminar</a></td></tr>');
		                      //$("#tabla").append('<tr><td>'+obj["nombrePaci"]+'</td><td><a href="http://localhost/CDI/Panel/index.php/Crudpacientes/detallePaciente?id='+obj["idPaciente"]+'"><button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">description</i></button></a></td><td><a href="http://localhost/CDI/Panel/index.php/Crudpacientes/ModificarPaciente?id='+obj["idPaciente"]+'"><button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">create</i></button></a></td><td><button type="button" onclick="deletePaciente('+obj["idPaciente"]+');" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons">delete</i></button></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }

		                $('#tablapacientes').Tabledit({
		      url: 'Crudpacientes/modificarDatos/',
		      eventType: 'dblclick',
		      editButton: false,
		      deleteButton:false,
		      columns: {
		          identifier: [0, 'idPaciente'],
		          editable: [[1, 'nombre'], [2, 'genero', '{"0": "Elija una opción", "1": "Masculino", "2": "Femenino"}'], [3, 'correo'],[4, 'edad'], [5, 'fecha'], [6, 'telefono'] ]
		      }
		      });
		  cambiainput();
		              }
		          })
		  }
		  //++++++++++++++++++++++++++++++++++++++++++++++++Cambia input inicio++++++++++++++++++++++++++++++++++++++++++++
		     function cambiainput(){
		          $("input[name*='fecha']").attr("type",'date');
		      }
		//++++++++++++++++++++++++++++++++++++++++++++++++Cambia muni inicio++++++++++++++++++++++++++++++++++++++++++++
		    function cambiaEstado($idRem){
		        var id = $idRem;
		        // alert("Entra Onclick con valor de ID "+id);
		        $("#estado"+id).css('display','none');
		        $("#muestraselectestado"+id).show();
		        traeEstados(id);

		    }

		    function cambiaMuni($idRem){
		        var id = $idRem;
		        // alert("Entra Onclick con valor de ID "+id);
		        $("#municipio"+id).css('display','none');
		        $("#muestraselectmuni"+id).show();
		        traeMuni(id);

		    }

		    function cambiaColo($idRem){
		        var id = $idRem;
		        // alert("Entra Onclick con valor de ID "+id);
		        $("#colonia"+id).css('display','none');
		        $("#muestraselectcolo"+id).show();
		        traeCol(id);

		    }

		    function getCP($idCliente){
		      var id = $idCliente;
		      $("#Colonia"+id).hide();
		      $("#muestraSelectColonia"+id).show();
		    }


		    function traeEstados(id){
		      var id = id;
		      // alert(id);
		      $.ajax({
		      url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getEstado",
		      type: "post",
		      dataType: "JSON",
		      success: function(data)
		        {
		          if(data.length>0)
		          {
		            for (i=0; i<data.length; i++)
		              {
		                $("#selectestado"+id).append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']));
		                // $("#selectestado"+id).append("<option value='"+data[i]['id_Estado']+"' onclick='modificarDatosE("+data[i]['id_Estado']+","+id+")'>"+data[i]['nombreEstado']+"</option>");
		              }
		          }
		        },
		      error: function (jqXHR, textStatus, errorThrown)
		        {
		          alert('Error get data from ajax');
		        }
		      });
		    }


		    function modificarDatosE(id){
		     
		     var id = id;
		     var idestado = $("#selectestado"+id).val();
		     if (idestado == null) {
		        idestado =$("#valorestado"+id).val();
		     }
		     var idciudad = $("#selectmuni"+id).val();
		     if (idciudad == null) {
		        idciudad = $("#valorciudad"+id).val();
		     }
		     var idcolonia = $("#selectcolo"+id).val();
		     var ruta= $("#ruta").val();
		     // alert (idcolonia);
		     var parametros = {"idestado":idestado,"idciudad": idciudad,"idcolonia":idcolonia,"id":id, "ruta":ruta}
		      //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
		     $.ajax({
		    url : "http://localhost/CDI/Panel/index.php/Crudremitentes/editaestado/",
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


		function traeMuni(id){
		    var id=id;
		    $("#selectmuni"+id).html("");
		    $("#municipio"+id).css('display','none');
		    $("#muestraselectmuni"+id).show();
		      
		    var idestado = $("#selectestado"+id).val();
		    
		    if (idestado == "" || idestado == null) {
		        idestado = $("#valorestado"+id).val();
		    }
		    //alert(idestado);
		    $.ajax({
		    url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getMunicipio/"+ idestado,
		    type: "post",
		    dataType: "JSON",
		      success: function(data)
		        {
		          if(data.length>0)
		          {
		            for (i=0; i<data.length; i++)
		              {
		                $("#selectmuni"+id).append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']));
		              }
		          }
		          traeCol(id);
		        },
		      error: function (jqXHR, textStatus, errorThrown)
		        {
		          alert('ERROR DE TRAER MUNICIPIO');
		        }
		    });
		}

		function traeCol(id){
		    var id=id;
		    $("#selectcolo"+id).html("");
		    $("#colonia"+id).css('display','none');
		    $("#muestraselectcolo"+id).show();
		    var idMunic = $("#selectmuni"+id).val();
		    if (idMunic == null) {
		        idMunic = $("#valorciudad"+id).val();
		    }
		    $.ajax({
		    url : "http://localhost/CDI/Panel/index.php/Crudremitentes/getColonia/"+ idMunic,
		    type: "post",
		    dataType: "JSON",
		        success: function(data)
		        {
		          if(data.length>0)
		          {
		            for (i=0; i<data.length; i++)
		              {
		                $("#selectcolo"+id).append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']));

		                 }
		                 ("#CP1"+id).append("data");
		                 

		          }
		          modificarDatosE(id);
		          // location.reload();
		        },
		        error: function (jqXHR, textStatus, errorThrown)
		        {
		          alert('Error get data from ajax');
		        }
		    });
		}
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
		    url= "http://localhost/CDI/Panel/index.php/Cruddoctores/inactivo/"+id;
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
		    url= "http://localhost/CDI/Panel/index.php/Cruddoctores/activo/"+id;
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


// empiza contraseñas

		  	function buscarcontrasena()
		  {
		      $("#tabla").html("");
		      var nombrec=$("#busqueda").val();
		      if (nombrec == "") {
		        nombrec = "todo";
		      }
		          $.ajax({
		              url : "http://localhost/CDI/Panel/index.php/Crudbuscador/buscadorcontrasena/"+nombrec,
		              type : "POST",
		              dataType: "json",
		              success: function(data)
		              {
		                if (data != "") {
		                   for(var i=0; i < data.length ; i++)
		                  {
		                      var obj= data[i];
		                      var idContrasena = obj["idContrasena"];
		                      var contrasena = obj["contrasena"];
		                      var permiso = obj["permiso"];
		                      if (permiso==1)
		                       {
		                       	tipo="SI"
		                       }
		                       if (permiso==2)
		                       {
		                       	tipo="NO"
		                       }
		                      $("#tabla").append('<tr><td style="display:none;">'+idContrasena+'</td><td>'+contrasena+'</td><td>'+tipo+'</td><td><a href="#" onclick="confirmaDeleteLinea('+obj["idContrasena"]+');">Eliminar</a></td></tr>'); 
		                      $("#sinresultados").html("");
		                  }
		                }else{
		                  $("#sinresultados").html("");
		                  $("#sinresultados").append('<div align="center" style="color: #c12626; margin-top:80px; margin-bottom:80px; font-weight:bold; font-size:20px;">No se encontraron resultados</div>');
		                }
		                $('#tablaLinea').Tabledit({
		                  url: 'CrudContrasena/modificarDatos/',
		                  eventType: 'dblclick',
		                  editButton: false,
		                  deleteButton:false,
		                  columns: {
						        identifier: [0, 'idContrasena'],
						        editable: [[1, 'nombre'],[2,'tipo', '{"": "Control de Caducidad", "1": "SI", "2": "NO"}']]
						    }
		                });
		              }
		          })
		  }
