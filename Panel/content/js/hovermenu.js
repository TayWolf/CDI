$(document).ready(function() {
    $('a[href="#navbar-more-show"]').on('click', function(event) {
    event.preventDefault();
    $('body').toggleClass('navbar-more-show');
    if ($('body').hasClass('navbar-more-show')) {
      $('a[href="#navbar-more-show"]').closest('body').addClass('active');
    }else{
      $('a[href="#navbar-more-show"]').closest('body').removeClass('active');
    }
    return false;
  });
});    
    
    window.onload=serch();
    function serch(){
      var cadena = $("#hover").val();
      if (cadena=="Crudclientes") {
        // alert(cadena);
        $('#clientes').css('background','#d29a9a');
      }
      if (cadena=="Crudusuarios") {
        $('#usuarios').css('background','#d29a9a');
      }
      if (cadena=="Crudempresas") {
        $('#empresas').css('background','#d29a9a');
      }
      if (cadena=="Cruddoctores") {
        $('#doctores').css('background','#d29a9a');
      }
      if (cadena=="Crudsalas") {
        $('#salas').css('background','#d29a9a');
      }
      if (cadena=="Crudremitentes") {
        $('#remitentes').css('background','#d29a9a');
      }
      if (cadena=="Crudpacientes") {
        $('#pacientes').css('background','#d29a9a');
      }
      if (cadena=="menus") {
        $('#inicio').css('background','#d29a9a');
      }
    }