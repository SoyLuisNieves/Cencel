<?php 
//error_reporting("0");
    require_once('../menu.php');
    session_start();
$_SESSION['id_almacen']=1;
?> </section>
<?php if(empty($_SESSION['folio'])||$_SESSION['folio']!=$_POST['folio']){
        $_SESSION['folio']=$_POST['folio'];
    } ?>

<?php
if (isset($_POST['borrar'])) {
    unset($_SESSION['aprobart'][$_POST['borrar']]);
    $_SESSION['aprobart'] = array_values($_SESSION['aprobart']);
}
?>
    <section class="content">
            <div class="block">
                <h2>
                    TRASPASOS
                </h2>
            </div>
        <div class="seccion"><h3>.: Detalles de Traspaso Solicitado:.</h3></div>
              <!-- Fin formulario semantic -->
                    <div class="ui form content">
                        <!-- Basic Validation -->
                        <div class="" align="right">
                            <div class="form-group">
                            <form action="aprobar.php" method="POST">
                                <div class="col-md-8" align="left">
                                    <label > Número de Remisión </label>
                                    <div class="ui input mini">
                                        <input placeholder="" type="text" size="12px">
                                    </div>
                                    <label class="m-l-20"> Fecha de Vencimiento </label>
                                    <div class="ui input mini">
                                        <input type="date" size="12px" name="vencimiento" value="<?php echo date("Y-m-d");?>">
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary waves-effect" name="aprobart" type="submit">Aprobar Traspaso</button>
                            </form>
                            </div>  
                        </div>

        <?php $pedidosc = $Traspasos->get_productos_cantidades();
            $rowc = mysqli_fetch_array($pedidosc);
            $pedidos = $Traspasos->aprobar_productos_series();
            $row = mysqli_fetch_array($pedidos);
            if (!empty($row)) { ?>
                        <div class="body"> 
                            <div class="form-group form-float">
                                    <div class="body table-responsive">
                                        <table class=" table table-hover table-bordered" border="0">
                                            <thead align="center">
                                                <tr>
                                                    <th colspan="2" align="center" ><form action="detalle_solicitados.php" method="POST"><button name="folio" class="boton" value="<?php echo $_POST['folio']; ?>"><img src="../../images/img/regresar.png" width="35px"></button></form></th>             
                                                    <th colspan="3" >Producto</th>
                                                    <th rowspan="2">IMEI</th>
                                                    <th rowspan="2">ACCID</th>
                                                    <th rowspan="2">Tel</th>
                                                    <th rowspan="2">Almacen</th>                
                                                    <th rowspan="2" >Precio</th>
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
                                                       for ($i=0; $i < count($_SESSION['aprobart']); $i++) 
                                                       { 
                                                            if (strlen($_SESSION['aprobart'][$i])<16) {
                                                                $productos = $Traspasos->get_productos_aprobar_imei($i);
                                                            }else{
                                                                $productos = $Traspasos->get_productos_aprobar_iccid($i);
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
                                                    <td><?php echo  $row['almacen']; ?></td>
                                                    <td><?php echo  $row['pb']; ?></td>
                                                     <td><form action="generar_trasp_ap.php" method="POST">
                                                    <input type="hidden" name="folio" value="<?php echo $_SESSION['folio']; ?>">
                                                     <button type="submit" name="borrar" value="<?php echo $i; ?>" class="boton"><img src="../../images/img/borrar.png" width="23px"></button></form></td>
                                                </tr><?php } ?>
                                                <tr align="center">
                                                    <td colspan="13">Total de Artículos: </td>
                                                    <td colspan="3"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                        
                            </div>
                        </div>
                            <?php }
                    if (!empty($rowc)) {
                         require_once('aprobar_pedido_cantidades.php');
                     } ?>                     
                            
                    <?php $importe = $Traspasos->get_importe();
                        $imp = mysqli_fetch_array($importe); 
                        $total=$imp['importe']; ?>
                    <div align="center"><h2>Total: $ <?php echo $total; ?></h2></div>
                        
                </div>  
            <!-- #END# Basic Validation -->
            <?php var_dump($_SESSION["aprobart"]); ?>

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>