 <section class="content" style="margin-left: 15px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PANEL DE ADMINISTRACIÓN</h2>
            </div>

            <!-- Widgets -->
            
<div class="row clearfix">
               
                <!-- <div id="recepcion" class="inicio"> -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudcitas" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-citas.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Citas</div>
                                </div>
                            </div>
                        </a>
                    </div>  
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudcotizaciones" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Cotizacion.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Cotizaciones</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/CrudPacienteEspera" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/boton_espera.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Pacientes en Espera</div>
                                </div>
                            </div>
                        </a>
                    </div>   
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudpedidos/listaPedido" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Productos.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Pedir artículos</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/verFacturacion" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Facturacion-Clientes.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Facturacion de clientes</div>
                                </div>
                            </div>
                        </a>
                    </div>-->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudestudiosporsala" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/boton-2.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Estudio por sala</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudestudiosporsala/entrega" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/boton-entregas.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Entrega de resultado</div>
                                </div>
                            </div>
                        </a>
                    </div>-->
                <!-- </div> -->
</div>


                <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?php 
                    foreach ($total as $row) {
                        $cantidad=$row['row'];
                        
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
            $("#recepcion").hide();
            // $("#btnadmin").css("background","#980000");
            // $("#btnalma").css("background","#580000");
            var div = "admin";
            var contra = ["almacen","recepcion"];
            setTimeout(function() {
                darentrada(div,contra);
            },100);
            // $("#almacen").addClass("inicio");
            // $("#almacen").removeClass("entrada");
        }
        function muestraalmacen() {
            $("#admin").hide();
            $("#almacen").show();
            $("#recepcion").hide();
            // $("#btnalma").css("background","#980000");
            // $("#btnadmin").css("background","#580000");
            var div = "almacen";
            var contra = ["admin","recepcion"];
            setTimeout(function() {
                darentrada(div,contra);
            },100);
            
            // $("#admin").addClass("inicio");
            // $("#admin").removeClass("entrada");
        }
        function muestrarecepcion() {
            $("#admin").hide();
            $("#almacen").hide();
            $("#recepcion").show();
            // $("#btnalma").css("background","#980000");
            // $("#btnadmin").css("background","#580000");
            var div = "recepcion";
            var contra = ["admin","almacen"];
            setTimeout(function() {
                darentrada(div,contra);
            },100);
            
            // $("#admin").addClass("inicio");
            // $("#admin").removeClass("entrada");
        }

// Funcion para simplificar funciones de mostrar menus

    // function traemenus(valordiv) {
    //     var valorentrante = valordiv;
    //     var array = ["admin","almacen","productos"]; // Aqui se deberán agregar los ID´s de todos los divs ocultos
    //     var posicionAct = array.indexOf(valorentrante);
    //     array.splice(posicionAct,1);

    // }

    function darentrada(div,contra) {
        var seleccionado = div;
        var contrario = contra;      
        $("#"+seleccionado).addClass("entrada");
        for (var i = 0; i <= contrario.length; i++) {
            $("#"+contrario[i]).removeClass("entrada");
        }
        
    }
    </script>
    <style type="text/css">
        .box{
          /*width: calc(20%);
          margin: 20px 20px;*/
          /*background: #ddd;*/
          cursor: pointer;
          color: #FFF;
          text-align: center;
          /*line-height: 130px;*/
        }


        .blue{
          background-color: rgba(56, 207, 248, 0.5);
        }

        .rotateX{
        /*   perspective: 100px; */
          transform: perspective(1) scaleZ(1) rotateX(0deg);
          transition: transform 0.5s ease;  
        }

        .box:hover .rotateX{
          transform: perspective(800px) scaleZ(2) rotateX(15deg);
         /* Standard syntax */
        }

        .rotateY{
          transform: perspective(1) scaleZ(1) rotateY(0deg);
          transition: transform 0.5s ease; 
              box-shadow: none;
        /*   perspective: 300px; */
        /*   transform-style: preserve-3d; */
        }

        .box:hover .rotateY{
        /*   transform: translate3d(42px, 42px, 42px); */
          transform: perspective(800px) scaleZ(2) rotateY(15deg);
         /* Standard syntax */
        }
        .inicio{
            display: none;
            transform: translateY(100px);
            opacity: 0;
        }
        .entrada{
            transform: translateY(0px);
            opacity: 1;
            transition-duration: 1s;
            /*transition-delay: 1s;*/
        }
    </style>
