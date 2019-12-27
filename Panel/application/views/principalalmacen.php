 <section class="content" style="margin-left: 15px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>CONTROL DE ALMACEN</h2>
            </div>
           
            <!-- Widgets -->
            <div class="row clearfix">
                <div id="almacen" class="inicio">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudproveedores" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Proveedores.png);background-repeat: no-repeat; background-size: contain;">
                              
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Proveedores</div>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudarticulos" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Articulos.png);background-repeat: no-repeat; background-size: contain;">
                               
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Articulos</div>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudlinea" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Linea.png);background-repeat: no-repeat; background-size: contain;">
                               
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Linea</div>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudcompras" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-IngresoDeCompras.png);background-repeat: no-repeat; background-size: contain;">
                               
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Ingreso de Compras</div>
                                    
                                </div>
                            </div>
                        </a>
                    </div> 
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudentradas" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Entradas.png);background-repeat: no-repeat; background-size: contain;">
                                
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Entradas</div>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudsalida" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Salidas.png);background-repeat: no-repeat; background-size: contain;">
                                
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Salidas</div>
                                    
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudordencompra" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-OrdenDeCompras1.png);background-repeat: no-repeat; background-size: contain;">
                                
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Orden de compra</div>
                                   
                                </div>
                            </div>
                        </a>
                    </div>                     
                </div>


                
            </div>
            <!-- #END# Widgets -->

        </div>
    </section>

    <script type="text/javascript">
        function muestraadmin() {
            $("#admin").show();
            $("#almacen").hide();
            // $("#btnadmin").css("background","#980000");
            // $("#btnalma").css("background","#580000");
            var div = "admin";
            var contra = ["almacen","productos"];
            setTimeout(function() {
                darentrada(div,contra);
            },100);
            // $("#almacen").addClass("inicio");
            // $("#almacen").removeClass("entrada");
        }
        function muestraalmacen() {
            $("#admin").hide();
            $("#almacen").show();
            // $("#btnalma").css("background","#980000");
            // $("#btnadmin").css("background","#580000");
            var div = "almacen";
            var contra = ["admin","productos"];
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
          background: #ddd;
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
