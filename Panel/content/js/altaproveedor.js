$(function(){
  $("#form").on("submit", function(e){
    var url;
    url= "http://localhost/CDI/Panel/index.php/Crudproveedores/altaProveedor";
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("form"));

    $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                 processData: false
            })
                .done(function(res){
                 
                    if(res==1)
                  {
                    window.location.replace("http://localhost/CDI/Panel/index.php/Crudproveedores");
                    // swal({
                    //       title: 'EXITO!',
                    //       text: "Se ha dado de alta al Usuario Exitósamente.",
                    //       type: 'success',
                    //       showCancelButton: false,
                    //       confirmButtonColor: '#3085d6',
                    //       cancelButtonColor: '#d33',
                    //       confirmButtonText: 'Ok',
                    //       cancelButtonText: 'No, cancel!',
                    //       confirmButtonClass: 'btn btn-success',
                    //       cancelButtonClass: 'btn btn-danger',
                    //       buttonsStyling: false
                    //     }, function() {

                           
                          
                    //     }, function (dismiss) {})
                  }
                  if(res==2)
                    {
                      alert("La fotografía ya existe!");
                    }
                  });

                });
             });
