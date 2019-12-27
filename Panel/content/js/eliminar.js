function deleteEmpresa(id)
       {
        swal({
          title: "¿Está seguro de borrar esta empresa?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudempresas/eliminarEmpresa/"+id;
          //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
        });
         /* var r = confirm("¿Desea deshabilitar esta Marca?"); 
          if (r == true) { 
             location.href="Crudtodoubicaciones/deleteArea/"+id;
              }*/
       }
       
function deleteCliente(id){
        swal({
          title: "¿Está seguro de borrar este Cliente?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudclientes/eliminarCliente/"+id;
          //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
        });
}

function confirmaDeleteArticulo(idArticulo){
        swal({
          title: "¿Está seguro de borrar este artículo?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudarticulos/eliminarArticulo/"+idArticulo;
          //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
        });
}
function quitarSala()
{
  var idEs=$("#idactual").val();
  alert("dato"+idEs);
}
function confirmaDeleteUser(idUser)
       {
           //alert ("id"+id);
           swal({
          title: "¿Está seguro de borrar este usuario?",
          text: "Una vez eliminado, este usuario no tendrá acceso al sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudusuarios/deleteUser/"+idUser;
          //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
        });
       
        
       }
function confirmaDeleteCategoria(idCat)
       {
           //alert ("id"+id);
          swal({
          title: "¿Está seguro de borrar esta categoría?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
          },
          function(){
               location.href="http://localhost/CDI/Panel/index.php/Crudcategorias/deleteCategoria/"+idCat;
            //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
          });
         
        
       }

function confirmaDeleteLinea(idLinea)
{

  swal({
          title: "¿Está seguro de borrar esta línea?",
          text: "Por favor verifique que esta línea no tenga artículos asignados, de lo contrario no se podrá eliminar!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
          },
          function(){
               location.href="http://localhost/CDI/Panel/index.php/Crudlinea/deleteLinea/"+idLinea;
            //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
          });

}




function confirmaDeleteProveedor(idProveedor)
       {
           //alert ("id"+id);
          swal({
          title: "¿Está seguro de borrar a este proveedor?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
          },
          function(){
               location.href="http://localhost/CDI/Panel/index.php/Crudproveedores/deleteProveedor/"+idProveedor;
            //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
          });
         
        
       }

function confirmaDeleteArea(idArea)
       {
           //alert ("id"+id);
          swal({
          title: "¿Está seguro de borrar esta area?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
          },
          function(){
               location.href="http://localhost/CDI/Panel/index.php/Crudareas/deleteArea/"+idArea;
            //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
          });
         
        
       }



function confirmaDeleteArea(idArea)
       {
           //alert ("id"+id);
          swal({
          title: "¿Está seguro de borrar esta area?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
          },
          function(){
               location.href="http://localhost/CDI/Panel/index.php/Crudareas/deleteArea/"+idArea;
            //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
          });
         
        
       }



function deleteSala(id)
       {
        swal({
          title: "¿Está seguro de borrar esta Contraseña?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudsalas/eliminarSala/"+id;
          //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
        });
         /* var r = confirm("¿Desea deshabilitar esta Marca?"); 
          if (r == true) { 
             location.href="Crudtodoubicaciones/deleteArea/"+id;
              }*/

       }



       

       function confirmaDeleteAreaInterna(idArea)
       {
           //alert ("id"+id);
          swal({
          title: "¿Está seguro de borrar esta area?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
          },
          function(){
               location.href="http://localhost/CDI/Panel/index.php/Crudareainterna/deleteArea/"+idArea;
            //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
          });
         
        
       }

       function confirmaDeleteEstudio(idEstudio)
       {
           //alert ("id"+id);
           swal({
          title: "AVISO",
          text: "¿Está seguro de borrar este estudio?",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudestudios/deleteestudio/"+idEstudio;
          //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
        });
       
        
       }

function deleteSala(id)
       {
        swal({
          title: "¿Está seguro de borrar esta sala?",
          text: "Se eliminará definitivamente del sistema!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudsalas/eliminarSala/"+id;
          //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
        });
         /* var r = confirm("¿Desea deshabilitar esta Marca?"); 
          if (r == true) { 
             location.href="Crudtodoubicaciones/deleteArea/"+id;
              }*/

       }



       
function confirmaDeleteRemitente(id)
       {
        swal({
          title: "¿Está seguro de borrar este Médico Remitente?",
          text: "Se eliminará definitivamente del sistema",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudremitentes/deleteRem/"+id;
          //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
        });
         /* var r = confirm("¿Desea deshabilitar esta Marca?"); 
          if (r == true) { 
             location.href="Crudtodoubicaciones/deleteArea/"+id;
              }*/

       }

function deletePaciente(id)
       {
        swal({
          title: "¿Está seguro de borrar este Paciente?",
          text: "Se eliminará definitivamente del sistema",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudpacientes/eliminarPaciente/"+id;
          //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
        });
         /* var r = confirm("¿Desea deshabilitar esta Marca?"); 
          if (r == true) { 
             location.href="Crudtodoubicaciones/deleteArea/"+id;
              }*/

       }

       function deleteRemitente(id)
       {
        swal({
          title: "¿Está seguro de borrar este Remitente?",
          text: "Se eliminará definitivamente del sistema",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
             location.href="http://localhost/CDI/Panel/index.php/Crudremitentes/eliminarRemitente/"+id;
        });
         
       }



function confirmaDeleteCont(idContrasena)
{

  swal({
          title: "¿Está seguro de borrar esta contraseña?",
          text: "Se eliminará definitivamente del sistema",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "Cancelar",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
          },
          function(){
               location.href="http://localhost/CDI/Panel/index.php/CrudContrasena/deleteContrasenas/"+idContrasena;
            //swal("Exito!", "La empresa se ha eliminado exitosamente.", "success");
          });

}

