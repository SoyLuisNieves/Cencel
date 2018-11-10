<?php 
error_reporting("0");
    session_start();
    require_once('../menu.php'); ?> 
    </section>
<?php if(empty($_SESSION['folio'])){$_SESSION['folio']=$_POST['folio'];} ?>

<?php
if (isset($_POST['borrar'])) {
    unset($_SESSION['aprobar'][$_POST['borrar']]);
    $_SESSION['aprobar'] = array_values($_SESSION['aprobar']);
}
?>
    <section class="content">
         <div class="seccion"><h3>.: Aprobar <b>Pedido :.</b></h3></div>
            <form id="form_validation">
            </form>

                    <div class="ui form content">
                        <form action="aprobar.php" method="POST">
                            <div  align="right">
                                <div class="form-group">
                                    <input type="radio" name="gender" id="factura" class="with-gap">
                                    <label for="factura">Factura </label>
                                    <div class="ui input mini">
                                        <input placeholder="" type="text" size="7px">
                                    </div>
                                    <input type="radio" name="gender" id="remision" class="with-gap">
                                    <label for="remision" class="m-l-20">Remisión </label>
                                    <div class="ui input mini">
                                        <input placeholder="" type="text" size="7px" value="<?php echo  $row['n_remision']; ?>">
                                    </div>
                                    <label for="remision" class="m-l-20">Fecha de Vencimiento </label>
                                    <div class="ui input mini">
                                        <input placeholder="" type="date" name="vencimiento" value="<?php echo date("Y-m-d"); ?>" size="12px">
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit" name="aprobar">Aprobar Pedido</button>
                            </div>
                        </form>

            <?php $pedidosc = $Pedidos->get_productos_cantidades();
            $rowc = mysqli_fetch_array($pedidosc);
            $pedidos = $Pedidos->aprobar_productos_series();
            $row = mysqli_fetch_array($pedidos);
            if (!empty($row)) { ?>
              <!-- Fin formulario semantic -->
                                    <div class="form-group form-float">
                                            <label class="form-label">Productos Series</label>
                                            <div class="body table-responsive">
                                                <table class=" table table-hover table-bordered" border="0">
                                                    <thead align="center">
                                                        <tr>
                                                            <th colspan="2" align="center" ><form action="detalle_solicitados.php" method="POST"><button name="folio" class="boton" value="<?php echo $_SESSION['folio']; ?>"><img src="../../images/img/regresar.png" width="35px"></button></form></th>                   
                                                            <th colspan="3" >Producto</th>
                                                            <th rowspan="2">IMEI</th>
                                                            <th rowspan="2">ACCID/SERIE</th>
                                                            <th rowspan="2">Tel</th>
                                                            <th rowspan="2">Almacen</th>                
                                                            <th rowspan="2" colspan="1">Precio</th>
                                                            <th rowspan="2">Borrar</th>             
                                                        </tr>
                                                        <tr>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>
                                                            <th>Producto</th>
                                                            <th>Color</th>
                                                            <th>Descripción</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                       <?php 
                                                       for ($i=0; $i < count($_SESSION['aprobar']); $i++) 
                                                       { 
                                                            if (strlen($_SESSION['aprobar'][$i])<16) {
                                                                $productos = $Pedidos->get_productos_aprobar_imei($i);
                                                            }else{
                                                                $productos = $Pedidos->get_productos_aprobar_iccid($i);
                                                            }
                                                            $row=mysqli_fetch_array($productos); ?>
                                                        <tr class="" align="center">
                                                            <td><?php echo  $row['marca']; ?></td>
                                                            <td><?php echo  $row['modelo']; ?></td> <!-- Aprobar el producto y agregar a la factura o remisión -->
                                                            <td><?php echo  $row['catalogo']; ?></td>
                                                            <td><?php echo  $row['color']; ?></td>
                                                            <td><?php echo  $row['clase'].'<br> '.$row['tamano']; ?></td>
                                                            <td><?php echo  $row['imei']; ?></td>
                                                            <td><?php echo  $row['iccid']; ?></td>
                                                            <td><?php echo  $row['n_telefono']; ?></td>
                                                            <td><?php /*echo  $row['almacen'];*/ ?></td>
                                                            <td><?php echo  $row['pb']; ?></td>
                                                            <!--<td><form class="ui form" id="frm-prueba" method="post"><input placeholder="cantidad" type="text" width="5px"></form></td>-->
                                                            <td><form action="aprobar_pedido.php" method="POST"><button type="submit" name="borrar" value="<?php echo $i; ?>" class="boton"><img src="../../images/img/borrar.png" width="23px"></button></form></td>
                                                        </tr><?php } ?>
                                                        <tr align="center" id="totales">
                                                            <td colspan="9">
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
                                                    <?php $importe = $Pedidos->get_importe();
                                                            $imp = mysqli_fetch_array($importe); 
                                                            $total=$imp['importe']; ?>
                                                    </table></div>
                                                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                                            </div> 
                        
                    <?php }
                    if (!empty($rowc)) {
                         require_once('aprobar_pedido_cantidades.php');
                     } ?>
                     <div align="center"><h2>Total: $ <?php echo $total; ?></h2></div>
                     </div>
                </div>
            <!-- #END# Basic Validation -->

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>