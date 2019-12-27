<style type="text/css">
.mainfooter {
    bottom: 0px;
    padding-top: 10%;
    box-shadow: none;
}
@media screen and (max-width: 681px){
    .mainfooter {
        bottom: 0px;
        padding-top: 40%;
        box-shadow: none;
    }
}
@media screen and (max-width: 525px){
    .mainfooter {
        bottom: 0px;
        padding-top: 40%;
        box-shadow: none;
    }
}
@media screen and (max-width: 385px){
    .mainfooter {
        bottom: 0px;
        padding-top: 40%;
        box-shadow: none;
    }
}
</style>
<script type="text/javascript">
    window.onload=menu;
    function menu() {
        var url = window.location.href;
        if (url == 'http://localhost/CDI/Panel/index.php/menus') {
            $("#menunav").css('display','none');
        }
        /*var idGogleado=3;
         
        if (idGogleado==3 && url == 'http://localhost/CDI/Panel/index.php/Crudcompras')
         {
             $("#menunavAlmace").css('display','none');

         }*/
        muestraalmacen();
        cambiainput();

         
    }

    
</script>

<!-- <section id="menunav">
    <div class="btn-group mainfooter">
        
        <button type="button" class="btn btn-circle-lg waves-effect waves-circle waves-float dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:  #293a4a; color: white;">
            <i class="material-icons">reorder</i>
            
        </button>
        <ul class="dropdown-menu" style="right: 10px;left: auto; min-width: 180px;">
            
            <li><a href="http://localhost/CDI/Panel/index.php/Crudusuarios"><i class="material-icons">supervisor_account</i>Usuarios</a></li>
            <li><a href="http://localhost/CDI/Panel/index.php/Crudempresas"><i class="material-icons">domain</i>Empresas</a></li>
            <li><a href="http://localhost/CDI/Panel/index.php/Cruddoctores"><i class="material-icons">portrait</i>Doctores</a></li>
            <li><a href="http://localhost/CDI/Panel/index.php/Crudsalas"><i class="material-icons">layers</i>Salas</a></li>
            <li><a href="http://localhost/CDI/Panel/index.php/Crudestudios"><i class="material-icons">colorize</i>Estudios</a></li>
            <li><a href="http://localhost/CDI/Panel/index.php/Crudremitentes"><i class="material-icons">recent_actors</i>Medicos Remitentes</a></li>
            <li><a href="http://localhost/CDI/Panel/index.php/Crudclientes"><i class="material-icons">people_outline</i>Clientes</a></li>
            <li><a href="http://localhost/CDI/Panel/index.php/Crudpacientes"><i class="material-icons">accessibility</i>Pacientes</a></li>
            <li><a href="http://localhost/CDI/Panel/index.php/Crudcitas"><i class="material-icons">schedule</i>Citas</a></li>
        </ul>
    </div>
</section> -->
<!-- Jquery Core Js -->
    <!-- Bootstrap Core Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!-- <script src="http://localhost/CDI/Panel/content/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

    <!-- Slimscroll Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/raphael/raphael.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="http://localhost/CDI/Panel/content/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="http://localhost/CDI/Panel/content/js/admin.js"></script>
    <script src="http://localhost/CDI/Panel/content/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="http://localhost/CDI/Panel/content/js/demo.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="http://localhost/CDI/Panel/content/js/pages/tables/jquery-datatable.js"></script>




    <!-- Jquery Validation Plugin Css -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="http://localhost/CDI/Panel/content/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="http://localhost/CDI/Panel/content/js/pages/forms/form-validation.js"></script>
    
    <script src="http://localhost/CDI/Panel/content/js/pages/forms/basic-form-elements.js"></script>

</body>

</html>