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
                <a>
                <div  id="enlaces">
                    <div class="info-box-3 bg-blue-grey hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">ALMACEN GLOBAL</div>
                        </div>
                    </div>
                </div></a>
                <a href="global.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
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
            <div class="seccion"><h3>Inventario <b>Global</b></h3></div>
            <br>
                <div class="row clearfix" > 
                    <div class="col-md-12" >
                        <div class="col-md-7" align="right">
                            <div class="form-group form-float ">
                                <label>Almacen</label>
                                    <select class="ui fluid dropdown" name="almacen" onchange="return buscaralm()" id="almacen">
                                        <?php $deptos = $Almacen->get_almacen_s();
                                        $row = mysqli_fetch_array($deptos)?>
                                        <option value=<?php echo '"'.$row['id_almacen'].'"'; ?>><?php echo $row['almacen']; ?></option>
                                    <?php $almacen = $Almacen->get_almacenes();
                                        while ( $row = mysqli_fetch_array($almacen)) {?>
                                      <option value="<?php echo $row['id_almacen']; ?>"><?php echo $row['almacen']; ?></option>
                                      <?php }?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-5" align="left"><br>
                        </div>
                    </div>               
                </div><br>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="body borde2">
                                <div class="body table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Producto</th> 
                                                <th width="15px">Unidad</th>
                                                <th width="20px">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($_POST['almacen'])) {
                                            
                                            $productos = $Inventarios->get_catalogo();
                                            while($row = mysqli_fetch_array($productos)){ ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['catalogo']; ?></th>
                                                <td align="center"><?php $id=$row['id_catalogo']; $stock=0; $total=0; $totalp=0;
                                                    $inventario = $Inventarios->get_stock_almacen($id);
                                                     while($rowst = mysqli_fetch_array($inventario)){
                                                        $stock=$stock+$rowst['stock'];
                                                        $total=($rowst['stock']*$rowst['pb']);
                                                        $totalp=$totalp+$total;
                                                     }
                                                    echo $stock; ?></td>
                                                <td align="center"><?php  echo $totalp; ?></td>                                                
                                            </tr> <?php } ?>
                                                <?php $totalU=$totalU+$stock; 
                                                    $totalC=$totalC+$totalp;
                                                     }?>
                                             <tr id="totales">
                                                <th>TOTALES</th>
                                                <th><?php echo $totalU ; ?></th>
                                                <th><?php echo '$ '.$totalC ; ?></th>
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