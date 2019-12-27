  $(function(){
  $("#form").on("submit", function(e){
    var url;
    url= "http://localhost/CDI/Panel/index.php/Crudareainterna/altaAreainterna";
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
                    window.location.replace("http://localhost/CDI/Panel/index.php/Crudareainterna");
                    
                  }
                  
                  });

                });
             });
