<?php

$idUsuarioBase = $_REQUEST['idusuariobase'];

$tipoUser = $_REQUEST['tipoUser'];

$url= $_SERVER["REQUEST_URI"];
// echo "La ruta es $url";
$array = explode("/", $url);
// echo "<br><br>El número de elementos en el array es: " . count($array);
$CrudCl=$array[4];
//echo " echale ganas $idUsuarioBase";

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

<body class="theme-red" style="background: white;">
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


<input type="hidden" id="idUsuarioG" name="idUsuarioG" value="<?php echo $tipoUser ?>">
<input type="hidden" name="idubase" id="idubase" value="<?php echo "$idUsuarioBase"; ?>">
<div style="display: none;" id="nombreusuarioxz" class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>


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
