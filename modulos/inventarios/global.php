<?php 
    require_once('../menu.php');
    
?> </section>


    <section class="content">
            <div class="block">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-2 col-sm-6 col-xs-12">
                    <h2>
                        INVENTARIO
                    </h2>
            </div>                      
            <div class="" align="right">
                <a href="inventario.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">VER INVENTARIO</div>
                        </div>
                    </div>
                </div></a>
                <a href="almacen_global.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">ALMACEN GLOBAL</div>
                        </div>
                    </div>
                </div></a>
                <a >
                <div  id="enlaces">
                    <div class="info-box-3 bg-blue-grey hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">VER GLOBAL</div>
                        </div>
                    </div>
                </div></a>
            </div>
          </div>
        </div>

            <form id="form_validation">
            </form>

              <!-- Fin formulario semantic -->
        <div class="" id="activos">
            <div class="seccion"><h3>Inventario <b>Almacenes Global</b></h3></div>
            <br>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="body borde2">
                                <div class="body table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Almacen</th>
                                                <?php $productos = $Inventarios->get_catalogo_global();
                                                while($row = mysqli_fetch_array($productos)){ ?>
                                                <th colspan="2"><?php echo $row['catalogo']; ?></th>
                                                <?php  }?>
                                            </tr>
                                            <tr><?php $productos = $Inventarios->get_catalogo_global();
                                                while($row = mysqli_fetch_array($productos)){ ?>
                                                <th width="7px">Cantidad</th>
                                                <th width="7px">Total</th><?php }?>
                                            </tr>
                                        </thead>                                            
                                        <tbody>
                                            <?php $almacen = $Inventarios->get_almacen();
                                                while($row = mysqli_fetch_array($almacen)){ ?>
                                                <tr>
                                                    <td><?php echo $row['almacen']; ?></td>
                                                    <?php $inventario = $Inventarios->get_catalogo_global();
                                                    while($row = mysqli_fetch_array($inventario)){ ?>
                                                    <td>cantidad</td>
                                                    <td>total</td>
                                                    <?php  }?>
                                                </tr>
                                                <?php $totalU=$totalU+$row['stock']; 
                                                    $totalC=$totalC+$total;
                                                }?>
                                                 <tr id="totales">
                                                    <th>TOTALES</th>
                                                    <?php $productos = $Inventarios->get_catalogo_global();
                                                while($row = mysqli_fetch_array($productos)){ ?>
                                                    <th><?php echo $totalU ; ?></th>
                                                    <th><?php echo '$ '.$totalC ; ?></th>
                                                    <?php  }?>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

</section>

        <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>