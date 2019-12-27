<?php
  $idUsuarioBase = $_SESSION['idusuariobase'];
  $tipoUser = $_SESSION['tipoUser'];
if ($idUsuarioBase == "") {
  header("location: http://localhost/CDI/Panel/");
}

$url= $_SERVER["REQUEST_URI"];

$array = explode("/", $url);

$CrudCl=$array[4];


 date_default_timezone_set('America/Mexico_City');
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Laboratorios CDI </title>
    <!-- Favicon-->
    <!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->
    <link rel="shortcut icon" href="http://localhost/CDI/Panel/content/images/icon/cdi.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="http://localhost/CDI/Panel/content/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="http://localhost/CDI/Panel/content/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="http://localhost/CDI/Panel/content/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="http://localhost/CDI/Panel/content/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="http://localhost/CDI/Panel/content/css/style.css" rel="stylesheet">

    <link href="http://localhost/CDI/Panel/content/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="http://localhost/CDI/Panel/content/css/themes/all-themes.css" rel="stylesheet" />
    <script src="http://localhost/CDI/Panel/content/plugins/jquery/jquery.min.js"></script>

    <script src="http://localhost/CDI/Panel/content/sweetalert-master/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" type="text/css" href="http://localhost/CDI/Panel/content/sweetalert-master/dist/sweetalert.css">

    <link href="http://localhost/CDI/Panel/content/css/paginacion.css" rel="stylesheet">


</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Cargando...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar" style="background:  #293a4a;">
    <div class="col-md-1 col-sm-1 col-xs-1">
        <section id="menunav" >
            <div class="btn-group mainfooter">
                <button type="button" class="btn btn-circle-lg waves-effect waves-circle waves-float dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:  #7d1800; color: white;">
                    <i class="material-icons">reorder</i>
                </button>
                <ul id="listado1" class="dropdown-menu" style="right: auto; left: auto; min-width: 180px;"></ul>
                <ul id="listado2" class="dropdown-menu" style="right: auto; left: 360%; min-width: 180px;"></ul>
                <ul id="listado3" class="dropdown-menu" style="right: auto; left: 720%; min-width: 180px;"></ul>
                <ul id="listado4" class="dropdown-menu" style="right: auto; left: 1080%;min-width: 180px;"></ul>
            </div>
        </section>        
    </div>   

        <div class="col-md-8 col-sm-5 col-xs-5">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a> -->
                    <!-- <a href="javascript:void(0);" class="bars"></a> -->
                    <a class="navbar-brand" href="http://localhost/CDI/Panel/index.php/menus" style="margin-left: 0px;">LABORATORIOS CDI </a>
                    <input type="hidden" id="idUsuarioG" name="idUsuarioG" value="<?php echo $tipoUser ?>">
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="col-md-2 col-sm-2 col-xs-4" style="padding: 10px;">
                <input type="hidden" name="idubase" id="idubase" value="<?php echo "$idUsuarioBase"; ?>">
                <div id="fotousuarioxz" class="image"></div>  
            </div>
            <div class="col-md-8 col-sm-8 col-xs-6" style="padding-top: 24px;color: #fff">
                <div id="nombreusuarioxz" class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2" style="padding-top: 24px; padding-left: 0px; padding-right: 0px;">
                <div class="user-helper-dropdown" style="cursor: pointer;color: white;">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="http://localhost/CDI/Panel/index.php/Crudusuarios/logout"><i class="material-icons">input</i>Cerrar Sesión</a></li>
                        </ul>
                    </div>
            </div>
        </div>
        <div></div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar" style="display: none;">
         
            <!-- Menu -->
            <div class="menu">
                <ul class="list" id="ejm3">
                    <li class="header">MENÚ DE NAVEGACIÓN</li>
                    <input type="hidden" id="hover" value="<?php echo "$CrudCl"; ?>" >
                    <li class="active">
                        <a href="http://localhost/CDI/Panel/index.php/menus" id="inicio">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                  

                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <?php 
            $hoy = date("Y");           
             ?>
            <div class="legal">
                <div class="copyright">
                    &copy; <?php echo "$hoy"; ?> <a href="https://cointic.com.mx/">Elaborado por Cointic</a>.
                </div>
                <!-- <div class="version">
                    <b>Version: </b> 1.0.5
                </div> -->
            </div>
            <!-- #Footer -->
        </aside>
      
    </section>
    <!-- <script src="http://localhost/CDI/Panel/content/js/hovermenu.js"></script> -->
    <script src="http://localhost/CDI/Panel/content/js/traedatosheader.js"></script>
