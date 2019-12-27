
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
