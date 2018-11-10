<?php @session_start();
$_SESSION['id_usuario']=1;
$_SESSION['id_almacen']=1;
$_SESSION['destino']=2;
    require_once('head.php');
    $var=1;
    require_once('header.php'); ?>

<?php
    require_once('menu.php');
?> </section>
    <section class="content">

               <div class="block">
                <h2>INICIO</h2>
            </div>


            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">group</i>
                        </div>
                        <div class="content">
                            <div class="text">USUARIOS</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">store</i>
                        </div>
                        <div class="content">
                            <div class="text">ALMACEN</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">PEDIDOS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">swap_horiz</i>
                        </div>
                        <div class="content">
                            <div class="text">TRASPASOS</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div><hr>
            <!-- #END# Widgets -->
            <div align="center">
                <img src="images/cencel.png" width="40%">
                <h1>¡BIENVENIDO!</h1>
            </div><hr>

            <!-- ========================= INICIO CAROUSEL ========================= -->

                <!-- ================================ CAROUSEL ==================================-->
           

    <?php require_once('footer.php');?>