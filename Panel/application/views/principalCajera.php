<section class="content" style="margin-left: 15px;">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PANEL DE CAJERA</h2>
            </div>
           
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" onclick="muestrarecepcion();" style="">
                    <div id="btnalma" class="info-box hover-expand-effect" style="cursor: pointer; background: transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Recepcion.png);background-repeat: no-repeat; background-size: contain;box-shadow: none;">
                        <div class="content">
                            <div class="text" style="font-size: 20px; color:white;">Recepción</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                <div id="recepcion" class="inicio">
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
                        <a href="http://localhost/CDI/Panel/index.php/Crudpedidos/listaPedido" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Productos.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Pedir artículos</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/verFacturacion" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Facturacion-Clientes.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Facturación de clientes</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/verFacturacionCaja" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Facturacion-Clientes.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Facturación caja</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudestudiosporsala" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/boton-2.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Estudio por sala</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudestudiosporsala/entrega" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/boton-entregas.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Entrega de resultado</div>
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
                </div>
            </div>
            
            <div class="row clearfix">
                <div id="admin">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/verFacturacionCaja" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Facturacion-Clientes.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Facturación caja</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/CrudFacturacionClientes/verFacturacion" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-Facturacion-Clientes.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Facturación de clientes</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudestudiosporsala" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/boton-2.png);background-repeat: no-repeat; background-size: contain">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Estudio por sala</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudpacientes" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-pacientes.png);background-repeat: no-repeat; background-size: contain;">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Pacientes</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 box">
                        <a href="http://localhost/CDI/Panel/index.php/Crudclientes" style="text-decoration: none;">
                            <div class="info-box hover-expand-effect rotateY" style="cursor: pointer; background:  transparent;background-image: url(http://localhost/CDI/Panel/content/images/btninicio/Boton-clientes.png);background-repeat: no-repeat; background-size: contain;">
                                <div class="content">
                                    <div class="text" style="font-size: 18px; color:white;">Clientes</div>
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

        function muestrarecepcion()
        {
            $("#recepcion").show()

            var div = "recepcion";
            var contra = ["admin","almacen"];
            setTimeout(function() {
                darentrada(div,contra);
            },100);
        }

        function darentrada(div,contra) 
        {
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
