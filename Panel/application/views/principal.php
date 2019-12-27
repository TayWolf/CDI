<!-- START LEFT SIDEBAR NAV-->
<?php
if ($this->session->userdata("idUser")!= "") {
   
}
else
{
    header("Location: http://localhost/CDI/Panel/");
die();
}
//echo "nailon ".$this->session->userdata("idUser");

if(!empty($permisos)) {
    $arregloPermisos = array();
    foreach ($permisos as $permiso) {
        $arregloPermisos[intval($permiso['idModulo'])] = $permiso;
    }
    $script="<script>";
    ?>
   
    <section class="content" style="margin-left: 15px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PANEL DE ADMINISTRACIÓN</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <?php
                //31 es de permisos
                $modulosAdministracion=array(2,3,4,5,6,7,8,9);

                foreach ($modulosAdministracion as $modulo) {

                    if (!empty($arregloPermisos[$modulo]['mostrar']) && $arregloPermisos[$modulo]['idTipoUsuario']==1)
                    {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="muestraadmin();" style="">
                            <div id="btnadmin" class="info-box hover-expand-effect"
                                 style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-admin.png);background-repeat: no-repeat; background-size: contain;box-shadow: none;">
                                <div class="content">
                                    <div class="text" style="font-size: 20px; color:white;">Catálogos</div>

                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                    }else{
                        $script.=" muestraadminD(); ";                       
                        break; 
                    }
                }
                $modulosAlmacen=array(11,12,13,14,15,16,17);
                foreach ($modulosAlmacen as $modulo)
                {
                    if(!empty($arregloPermisos[$modulo]['mostrar']) && $arregloPermisos[$modulo]['idTipoUsuario']==1)
                    {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="muestraalmacen();" style="">
                            <div id="btnalma" class="info-box hover-expand-effect"
                                 style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-almacen.png);background-repeat: no-repeat; background-size: contain;box-shadow: none;border-radius: 20px;">
                                <!-- <div class="icon">
                                    <i class="material-icons">supervisor_account</i>
                                </div> -->
                                <div class="content">
                                    <div class="text" style="font-size: 20px; color:white;">Almacén</div>
                                    <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                    }else{
                        $script.=" muestraalmacenD(); ";                       
                        break;
                    }
                }
                $modulosRecepcion=array(18,19,20,21,22,23,24,25);
                foreach ($modulosRecepcion as $modulo)
                {
                    if(!empty($arregloPermisos[$modulo]['mostrar']) && $arregloPermisos[$modulo]['idTipoUsuario']==1)
                    {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="muestrarecepcion();" style="">
                            <div id="btnalma" class="info-box hover-expand-effect"
                                 style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Recepcion.png);background-repeat: no-repeat; background-size: contain;box-shadow: none;">
                                <!-- <div class="icon">
                                    <i class="material-icons">supervisor_account</i>
                                </div> -->
                                <div class="content">
                                    <div class="text" style="font-size: 20px; color:white;">Recepción</div>
                                    <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                    }else{
                        $script.=" muestrarecepcionD(); ";
                         break;
                    }
                }
                $modulosCaja=array(26,27,28,29,30);
                foreach ($modulosCaja as $modulo)
                {
                    if(!empty($arregloPermisos[$modulo]['mostrar']) && $arregloPermisos[$modulo]['idTipoUsuario']==1)
                    {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="muestracajero();" style="">
                            <div id="btnalma" class="info-box hover-expand-effect"
                                 style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/caja-de-cobro.png);background-repeat: no-repeat; background-size: contain;box-shadow: none;">
                                <!-- <div class="icon">
                                    <i class="material-icons">supervisor_account</i>
                                </div> -->
                                <div class="content">
                                    <div class="text" style="font-size: 20px; color:white;">Caja</div>
                                    <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                    }else{
                        $script.=" muestracajeroD(); ";
                         break;
                    }
                }
                $modulosUtileria=array(0,1,10,31);
                foreach ($modulosUtileria as $modulo)
                {
                    if(!empty($arregloPermisos[$modulo]['mostrar']) && $arregloPermisos[$modulo]['idTipoUsuario']==1)
                    {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="muestraUtileria();" style="">
                            <div id="btnalma" class="info-box hover-expand-effect"
                                 style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/panel-de-utileria.png);background-repeat: no-repeat; background-size: contain;box-shadow: none;">
                                <!-- <div class="icon">
                                    <i class="material-icons">supervisor_account</i>
                                </div> -->
                                <div class="content">
                                    <div class="text" style="font-size: 20px; color:white;">Utilerías</div>
                                    <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                                </div>
                            </div>
                        </div>
                        <?php
                        break;
                    }else{
                        $script.="  muestraUtileriaD(); ";
                         break;
                    }
                }
                ?>
            </div>
            <div class="row clearfix">
                <div id="admin" class="inicio">
                    <?php
                    if(!empty($arregloPermisos[2]['mostrar'])) {
                        ?>

                        <!--Empresas-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudempresas" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-empresas.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- #293a4a; -->
                                    <!-- <div class="icon">
                                        <i class="material-icons">domain</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Empresas</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[3]['mostrar'])) {
                        ?>

                        <!--Doctores-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Cruddoctores" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-medicos.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">portrait</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Médicos</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[4]['mostrar'])) {
                        ?>
                        <!--Salas-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudsalas" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-salas.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">layers</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Salas</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[5]['mostrar'])) {
                        ?>
                        <!--Area interna-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudareainterna"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/AreaInterna.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">layers</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Áreas Internas</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[6]['mostrar'])) {
                        ?>
                        <!--Estudios-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudestudios" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-estudios.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">assignment</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Estudios</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[7]['mostrar'])) {
                        ?>
                        <!--Remitentes-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudremitentes"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-medicosR.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">recent_actors</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Médicos Remitentes</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php

                    }
                    if(!empty($arregloPermisos[8]['mostrar'])) {
                        ?>
                        <!--Clientes-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudclientes" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-clientes.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">people_outline</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Clientes</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[9]['mostrar'])) {
                        ?>
                        <!--Pacientes-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudpacientes" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-pacientes.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">accessibility</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Pacientes</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudcitas" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-citas.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Citas</div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
                        <?php
                    }?>
                </div>

                <div id="util" class="inicio">
                    <?php
                    if(!empty($arregloPermisos[0]['mostrar'])) {
                        ?>
                        <!--Usuario-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box" style="">
                            <a href="http://localhost/CDI/Panel/index.php/Crudusuarios" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-usuarios.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- #293a4a; -->
                                    <!-- <div class="icon">
                                        <i class="material-icons">supervisor_account</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Usuarios</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[1]['mostrar'])) {
                        ?>

                        <!--Contraseña-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box" style="">
                            <a href="http://localhost/CDI/Panel/index.php/CrudContrasena"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/contrasena.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- #293a4a; -->
                                    <!-- <div class="icon">
                                        <i class="material-icons">supervisor_account</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Contraseñas</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[10]['mostrar'])) {
                        ?>
                        <!--Categorias-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudcategorias"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-categorias.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">list</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Categorías</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php

                    }
                    if(!empty($arregloPermisos[31]['mostrar'])) {
                    ?>
                    <!--Permisos-->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/CrudPermisos" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY"
                                 style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-categorias.png);background-repeat: no-repeat; background-size: contain;">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Permisos</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>

                <div id="almacen" class="inicio">

                    <?php
                    if(!empty($arregloPermisos[11]['mostrar'])) {
                    ?>
                    <!--Proveedores-->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudproveedores" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY"
                                 style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Proveedores.png);background-repeat: no-repeat; background-size: contain;">
                                <!--  <div class="icon">
                                     <i class="material-icons">contact_phone</i>
                                 </div> -->
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Proveedores</div>
                                    <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    if(!empty($arregloPermisos[12]['mostrar'])) {
                        ?>
                        <!--Articulos-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudarticulos" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Articulos.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">add_shopping_cart</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Articulos</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[13]['mostrar'])) {
                        ?>
                        <!--Linea-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudlinea" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Linea.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">account_balance_wallet</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Linea</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[14]['mostrar'])) {
                        ?>
                        <!--Ingreso de Compras-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudcompras" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-IngresoDeCompras.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">add_shopping_cart</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Ingreso de Compras</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[15]['mostrar'])) {
                        ?>
                        <!--Entradas-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudentradas" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Entradas.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">add_shopping_cart</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Entradas</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[16]['mostrar'])) {
                    ?>
                    <!--Salidas-->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudsalida" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY"
                                 style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Salidas.png);background-repeat: no-repeat; background-size: contain;">
                                <!-- <div class="icon">
                                    <i class="material-icons">add_shopping_cart</i>
                                </div> -->
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Salidas</div>
                                    <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    if(!empty($arregloPermisos[17]['mostrar'])) {
                        ?>
                        <!--Orden de compra-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudordencompra"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-OrdenDeCompras1.png);background-repeat: no-repeat; background-size: contain;">
                                    <!-- <div class="icon">
                                        <i class="material-icons">add_shopping_cart</i>
                                    </div> -->
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Orden de compra</div>
                                        <!-- <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div id="recepcion" class="inicio">
                    <?php
                    if(!empty($arregloPermisos[18]['mostrar'])) {
                        ?>
                        <!--Citas-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <!--Citas-->
                            <a href="http://localhost/CDI/Panel/index.php/Crudcitas" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-citas.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Cita</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[19]['mostrar'])) {
                    ?>

                    <!--Todas las citas-->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudcitas/citasProgramadas"
                           style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY"
                                 style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-citas.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">

                                    <div class="text" style="font-size: 18px; color:white;">Confirmación las citas</div>

                                </div>
                            </div>
                        </a>
                    </div>
                    <?php }
                    if(!empty($arregloPermisos[20]['mostrar'])) {
                        ?>
                        <!--Cotizaciones-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudcotizaciones"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Cotizacion.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Cotizaciones</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[21]['mostrar'])) {
                        ?>
                        <!--Pedir articulos-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudpedidos/listaPedido"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Productos.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Pedir artículos</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[22]['mostrar'])) {
                    ?>
                    <!--Estudio por sala-->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudestudiosporsala"
                           style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY"
                                 style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/boton-2.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Estudio por sala</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                    if(!empty($arregloPermisos[23]['mostrar'])) {
                        ?>
                        <!--Entrega de  resultado-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Crudestudiosporsala/entrega"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/boton-entregas.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Entrega de resultado
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[24]['mostrar'])) {
                        ?>
                        <!--Paciente en espera-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/CrudPacienteEspera"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/boton_espera.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Pacientes en Espera
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[25]['mostrar'])) {
                        ?>
                        <!--Resumen del sistema-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/CrudAdministracion"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/resumen-de-sistema.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Resumen del sistema
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <div id="cajera" class="inicio">
                    <?php
                    if(!empty($arregloPermisos[26]['mostrar'])) {
                        ?>
                        <!--Facturación de clientes-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/verFacturacion"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Facturacion-Clientes.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Facturación de clientes
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[27]['mostrar'])) {
                        ?>
                        <!--Facturación de caja-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/verFacturacionCaja"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Facturacion-Clientes.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Facturación caja</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[28]['mostrar'])) {
                        ?>
                        <!--Facturas del sisetma-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/CrudFacturas" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Facturas.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Facturas del sistema
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[29]['mostrar'])) {
                        ?>
                        <!--Facturas emitidas clientes-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/CrudFacturas/Clientes"
                               style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Facturas.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Facturas emitidas
                                            Clientes
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    if(!empty($arregloPermisos[30]['mostrar'])) {
                        ?>
                        <!--Deudores-->
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                            <a href="http://localhost/CDI/Panel/index.php/Cruddeudores" style="text-decoration: none;">
                                <div class="info-box hover-expand-effect rotateY"
                                     style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/deudores.png);background-repeat: no-repeat; background-size: contain">
                                    <div class="content">
                                        <div class="text" style="font-size: 18px; color:white;">Deudores</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>


            <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?php
            foreach ($total as $row) {
                $cantidad = $row['row'];

            }

            // echo "
            // <div class='info-box bg-orange hover-expand-effect'>
            //     <div class='icon'>
            //         <i class='material-icons'>person_add</i>
            //     </div>
            //     <div class='content'>
            //         <div class='text'>Total de Usuarios</div>
            //         <div class='number count-to' data-from='0' data-to='$cantidad' data-speed='2000' data-fresh-interval='20'></div>
            //     </div>
            // </div>
            // ";
            ?>
                    
                </div> -->
        </div>
        <!-- #END# Widgets -->

        </div>
    </section>

    <script type="text/javascript">
        function muestraadmin() {
            $("#admin").show();
            $("#almacen").hide();
            $("#cajera").hide();
            $("#recepcion").hide();
            $("#util").hide();
            // $("#btnadmin").css("background","#980000");
            // $("#btnalma").css("background","#580000");
            var div = "admin";
            var contra = ["util","almacen", "recepcion", "cajera"];
            setTimeout(function () {
                darentrada(div, contra);
            }, 100);
            // $("#almacen").addClass("inicio");
            // $("#almacen").removeClass("entrada");
        }

        function muestraadminD() {
            $("#admin").show();
            $("#almacen").show();
            $("#cajera").show();
            $("#recepcion").show();
            $("#util").show();
            var div = "admin";
            var contra = ["util","almacen", "recepcion", "cajera"];
            setTimeout(function () {
                darentradaD(div, contra);
            }, 100);
        }

        function muestraUtileria() {
            $("#admin").hide();
            $("#almacen").hide();
            $("#cajera").hide();
            $("#recepcion").hide();
            $("#util").show();
            // $("#btnadmin").css("background","#980000");
            // $("#btnalma").css("background","#580000");
            var div = "util";
            var contra = ["admin","almacen", "recepcion", "cajera"];
            setTimeout(function () {
                darentrada(div, contra);
            }, 100);
            // $("#almacen").addClass("inicio");
            // $("#almacen").removeClass("entrada");
        }

        function muestraUtileriaD() {
            $("#util").show();
            $("#admin").show();
            $("#almacen").show();
            $("#cajera").show();
            $("#recepcion").show();
            var div = "util";
            var contra = ["admin","almacen", "recepcion", "cajera"];
            setTimeout(function () {
                darentradaD(div, contra);
            }, 100);
        }

        function muestraalmacen() {
           
            $("#admin").hide();
            $("#almacen").show();
            $("#cajera").hide();
            $("#recepcion").hide();
            $("#util").hide();
            // $("#btnalma").css("background","#980000");
            // $("#btnadmin").css("background","#580000");
            var div = "almacen";
            var contra = ["util","admin", "recepcion", "cajera"];
            setTimeout(function () {
                darentrada(div, contra);
            }, 100);

            // $("#admin").addClass("inicio");
            // $("#admin").removeClass("entrada");
        }
        function muestraalmacenD() {
           
            $("#admin").show();
            $("#almacen").show();
            $("#cajera").show();
            $("#recepcion").show();
            $("#util").show();
            var div = "almacen";
            var contra = ["util","admin", "recepcion", "cajera"];
            setTimeout(function () {
                darentradaD(div, contra);
            }, 100);
        }

        function muestrarecepcion() {
            $("#admin").hide();
            $("#almacen").hide();
            $("#cajera").hide();
            $("#util").hide();
            $("#recepcion").show();
            // $("#btnalma").css("background","#980000");
            // $("#btnadmin").css("background","#580000");
            var div = "recepcion";
            var contra = ["util","admin", "almacen", "cajera"];
            setTimeout(function () {
                darentrada(div, contra);
            }, 100);

            // $("#admin").addClass("inicio");
            // $("#admin").removeClass("entrada");
        }
        function muestrarecepcionD() {
            $("#admin").show();
            $("#almacen").show();
            $("#cajera").show();
            $("#recepcion").show();
            $("#util").show();
            var div = "recepcion";
            var contra = ["util","admin", "almacen", "cajera"];
            setTimeout(function () {
                darentradaD(div, contra);
            }, 100);
        }

        function muestracajero() {
            $("#admin").hide();
            $("#almacen").hide();
            $("#recepcion").hide();
            $("#cajera").show();
            $("#util").hide();
            // $("#btnalma").css("background","#980000");
            // $("#btnadmin").css("background","#580000");
            var div = "cajera";
            var contra = ["util","admin", "almacen", "recepcion"];
            setTimeout(function () {
                darentrada(div, contra);
            }, 100);

            // $("#admin").addClass("inicio");
            // $("#admin").removeClass("entrada");
        }
        function muestracajeroD() {
            $("#admin").show();
            $("#almacen").show();
            $("#recepcion").show();
            $("#cajera").show();
            $("#util").show();
            var div = "cajera";
            var contra = ["util","admin", "almacen", "recepcion"];
            setTimeout(function () {
                darentradaD(div, contra);
            }, 100);
        }

        // Funcion para simplificar funciones de mostrar menus

        // function traemenus(valordiv) {
        //     var valorentrante = valordiv;
        //     var array = ["admin","almacen","productos"]; // Aqui se deberán agregar los ID´s de todos los divs ocultos
        //     var posicionAct = array.indexOf(valorentrante);
        //     array.splice(posicionAct,1);

        // }

        function darentrada(div, contra) {
            var seleccionado = div;
            var contrario = contra;
            $("#" + seleccionado).addClass("entrada");
            for (var i = 0; i <= contrario.length; i++) {
                $("#" + contrario[i]).removeClass("entrada");
            }

        }

        function darentradaD(div, contra) {
            var seleccionado = div;
            var contrario = contra;
            $("#" + seleccionado).addClass("entrada");
            // for (var i = 0; i <= contrario.length; i++) {
            //     $("#" + contrario[i]).removeClass("entrada");
            // }

        }
    </script>
    <style type="text/css">
        .box {
            /*width: calc(20%);
            margin: 20px 20px;*/
            /*background: #ddd;*/
            cursor: pointer;
            color: #FFF;
            text-align: center;
            /*line-height: 130px;*/
        }

        .blue {
            background-color: rgba(56, 207, 248, 0.5);
        }

        .rotateX {
            /*   perspective: 100px; */
            transform: perspective(1) scaleZ(1) rotateX(0deg);
            transition: transform 0.5s ease;
        }

        .box:hover .rotateX {
            transform: perspective(800px) scaleZ(2) rotateX(15deg);
            /* Standard syntax */
        }

        .rotateY {
            transform: perspective(1) scaleZ(1) rotateY(0deg);
            transition: transform 0.5s ease;
            box-shadow: none;
            /*   perspective: 300px; */
            /*   transform-style: preserve-3d; */
        }

        .box:hover .rotateY {
            /*   transform: translate3d(42px, 42px, 42px); */
            transform: perspective(800px) scaleZ(2) rotateY(15deg);
            /* Standard syntax */
        }

        .inicio {
            display: none;
            transform: translateY(100px);
            opacity: 0;
        }

        .entrada {
            transform: translateY(0px);
            opacity: 1;
            transition-duration: 1s;
            /*transition-delay: 1s;*/
        }
    </style>
    <?php
    $script.="</script>";
echo $script;
}
?>