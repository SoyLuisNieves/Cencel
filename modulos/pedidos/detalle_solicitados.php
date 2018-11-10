<?php 
//error_reporting("0");
    require_once('../menu.php');
    session_start();
    $_SESSION['id_almacen']=1;
    if(empty($_SESSION['folio'])||$_SESSION['folio']!=$_POST['folio']){
        $_SESSION['folio']=$_POST['folio'];
        $_SESSION['pedcant']=array();
    }
?> </section>

<!--===================================SECCIÓN PEDIDOS CANTIDADES (APROBAR)======================================-->

        <?php $pedidosc = $Pedidos->get_productos_cantidades();
            $rowc = mysqli_fetch_array($pedidosc);
            $pedidos = $Pedidos->aprobar_productos_series();
            $rows = mysqli_fetch_array($pedidos);
            if (!empty($rows)) {
                

        /*
            if (isset($_POST['aprobar_cantidades'])) {
                 $serie=$_POST['aprobar_cantidades'];
            }else{
                $serie=0;
            }
        if (!empty($row) and $serie!='1') {
           require_once('aprobar_pedido_cantidades.php');
        }  else{*/ ?>

<!--===================================SECCIÓN PEDIDOS SERIES======================================-->
<section class="content">
        <div class="seccion"><h3>.: Detalles <b>Pedido Series:.</b></h3></div>
            <form id="form_validation">
            </form>
                <div class="ui">                
                    <div class="ui form content">
                        <!-- Basic Validation -->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="">
                                    <div class="body"> 
                                        <div class="">
                                            <div class="form-group form-float">
                                                <div class="">
                                                    <label class="form-label">Productos</label>
                                                    <div class="body table-responsive">
                                                    <table class=" table table-hover table-bordered" border="0">
                                                      <thead align="center">
                                                        <tr>
                                                            <th colspan="2"><a href="aprobar.php"><img src="../../images/img/regresar.png" width="35px"></a></th>                        
                                                            <th colspan="5" >Producto</th>                  
                                                            <th rowspan="2">Precio</th>
                                                            <th rowspan="2">Solicitados</th>                
                                                        </tr>
                                                        <tr>
                                                            <th>Folio</th>
                                                            <th>Clave</th>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>
                                                            <th>Producto</th>
                                                            <th>Color</th>
                                                            <th>Descripción</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <?php  $pedidos = $Pedidos->aprobar_productos_series();
                                                            $costo=0;$cantidad=0;
                                                            while($row = mysqli_fetch_array($pedidos)){ ?>
                                                        <tr class="" align="center">
                                                            <form action="aprobar_pedido_sel.php" method="POST">
                                                            <td><?php echo $row['folio']; ?><input type="hidden" name="folio" value="<?php echo $row['folio']; ?>"></td>
                                                            <td><button name="clave" class="boton" value="<?php echo $row['cve']; ?>"><a><?php echo $row['cve']; ?></a></button></td></form>
 <!-- Aprobar el producto y agregar a la factura o remisión -->
                                                            <td><?php echo  $row['marca']; ?></td>
                                                            <td><?php echo  $row['modelo']; ?></td>
                                                            <td><?php echo  $row['catalogo']; ?></td>
                                                            <td><?php echo  $row['color']; ?></td>
                                                            <td><?php echo  $row['clase'].'<br> '.$row['tamano']; ?></td>
                                                            <td><?php echo  $row['pb']; 
                                                            $costo=$costo+$row['pb']; ?>  
                                                            </td>
                                                            <td><?php echo  $row['cant_solicitada']; 
                                                            $cantidad=$cantidad+$row['cant_solicitada'];?></td>
                                                        </tr><?php } ?>
                                                        <tr id="totales" align="center">
                                                            <?php $total=$_POST['total']; ?>
                                                            <td colspan="7">
                                                            <?php $cant_productos = $Pedidos->num_total_productos();
                                                                $productos_cant = $Pedidos->num_productos_cantidades();
                                                                $productos_series = $Pedidos->num_productos_series();
                                                                    $cant = mysqli_fetch_array($cant_productos); 
                                                                    $cantidad = mysqli_fetch_array($productos_cant);
                                                                    $series = mysqli_fetch_array($productos_series);?>
                                                            Total de Artículos: <?php echo  $cant['productos']; ?></td>
                                                            <td colspan="2">Cantidades: <?php echo  $cantidad['cantidades'];
                                                                echo '<label class="m-l-20"></label>';
                                                                echo "Series: ".$series['series'];?></td>
                                                        </tr>
                                                      </tbody>
                                                    </table><div align="center"><h2>Total: $ <?php echo $total; ?></h2></div></div>
                                                    <input type="hidden" name="total" value="<?php echo $total; ?>"></div>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div></div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <?php } elseif (!empty($rowc)) {
                    require_once('aprobar_pedido.php');
                } ?>
            <!-- #END# pedidos Series -->

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>