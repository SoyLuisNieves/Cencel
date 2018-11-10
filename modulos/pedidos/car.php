<?php  session_start();
error_reporting("0");
    require_once('../menu.php');
?> </section>
    <?php
    if (isset($_POST['borrar'])) {
        for ($i=0; $i <count($_SESSION['pedido']) ; $i++) { 
            if ($_SESSION['pedido'][$i][0]==$_POST['borrar']) {
                unset($_SESSION['pedido'][$i]);
                $_SESSION['pedido'] = array_values($_SESSION['pedido']);
            }
        }
    }
    if (isset($_POST['enviar'])) {
        $getfolio = $Pedidos->get_folios_rem();
        $rowfoli = mysqli_fetch_array($getfolio);
        if ($rowfoli['n_remision']==null) {
            $folio = 1;
        }else{
            $folio = $rowfoli['n_remision']+1;
        }
        $pedidoreg= $Pedidos->insert_pedido($folio);
        $last_folio=$Pedidos -> obtener_folio();
        
        for ($i=0; $i < count($_SESSION['pedido']); $i++) { 
            $pedidopro = $Pedidos->get_pedido_prod($i);
            $row=mysqli_fetch_array($pedidopro);

            if (empty($_SESSION['pedido'][$i][1])) {
                $regpedido = $Pedidos->insert_pedido_prod2($last_folio,$i,1);
            }else{
                $regpedido = $Pedidos->insert_pedido_prod($last_folio,$i);
            }
        }
        $_SESSION['pedido']=array();
    }
    if (isset($_POST['actualizar'])) {
        for ($i=0; $i < count($_SESSION['pedido']) ; $i++) { 
            if ($_SESSION['pedido'][$i][0]==$_POST['actualizar']) {
                $clave=$_POST['actualizar'];
                $_SESSION['pedido'][$i][1]=$_POST[$clave];
            }
        }
    }
    ?>
    <section class="content">
            <form id="form_validation">
            </form>
              <!-- Fin formulario semantic -->
            <div class="seccion"><h3>.: Enviar Pedido :.</h3></div>

            <form class="ui form" id="form_validation" action="car.php" method="POST">
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
                                                    <div class="body table-responsive ">
                                                    <table class=" table table-hover table-bordered borde2" border="0">
                                                      <thead align="center">
                                                        <tr>
                                                            <th colspan="2" ><a href="npedido.php"><img src="../../images/img/rcar.png" width="40px"></a></th>
                                                            <th colspan="3" > Producto</th>                  
                                                            <th rowspan="2">Precio</th>
                                                            <th colspan="2">Cantidad</th>
                                                            <th colspan="2"><a href="#"><button type="submit" name="enviar" class="boton"><img src="../../images/img/enviar.png" width="40px"></button></a></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>
                                                            <th>Producto</th>
                                                            <th>Color</th>
                                                            <th>Descripción</th>
                                                            <th>Actual</th>
                                                            <th>Modificar</th>                                          
                                                            <th>Actualizar</th>
                                                            <th>Borrar</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <?php
                                                      for ($i=0; $i < count($_SESSION['pedido']); $i++) { 
                                                           $pedidopro = $Pedidos->get_pedido_prod($i);
                                                           $row=mysqli_fetch_array($pedidopro);
                                                           ?>
                                                           <tr class="" align="center">
                                                                <td><?php echo $row['marca']; ?></td>
                                                                <td><?php echo $row['modelo']; ?></td>
                                                                <td><?php echo $row['catalogo']; ?></td>
                                                                <td><?php echo $row['color']; ?></td>
                                                                <td><?php echo 'Tamaño: '.$row['tamano'].', '.$row['clase']; ?></td>
                                                                <td><?php if(empty($_SESSION['pedido'][$i][1])){echo $costo=$row['pb'];}else{
                                                                    if (empty($_SESSION['pedido'][$i][1])) {
                                                                        $_SESSION['pedido'][$i][1]=1;
                                                                    }
                                                                    $costo=$row['pb']*$_SESSION['pedido'][$i][1];
                                                                    echo $costo;} 
                                                                    $costo_total=$costo_total+$costo;
                                                                    ?></td>
                                                                <td><?php if(empty($_SESSION['pedido'][$i][1])){ echo $_SESSION['pedido'][$i][1]=1;}else{echo $_SESSION['pedido'][$i][1];} 
                                                                $total_cantidad=$total_cantidad+$_SESSION['pedido'][$i][1];
                                                                ?></td>
                                                                <td><input placeholder="cantidad" name="<?php echo $row['cve']; ?>" type="number" width="5px"></td>
                                                                <td><button type="submit" name="actualizar" value="<?php echo $row['cve']; ?>" class="boton" ><img src="../../images/img/recargar.png" width="25px"></button></td>
                                                                <td><button type="submit" name="borrar" value="<?php echo $row['cve']; ?>" class="boton" ><img src="../../images/img/borrar.png" width="23px"></button></td>
                                                            </tr>
                                                           <?php
                                                           //$precio=$precio+$row['pb'];
                                                           //$tproductos= $tproductos+$_SESSION['pedido'][$i][1];
                                                       } 
                                                      ?>
                                                        <tr id="totales">
                                                            <td colspan="5">Total de Artículos:  <?php echo count($_SESSION['pedido']); ?></td>
                                                            <td>Total: $ <?php echo $costo_total; ?>
                                                                <input type="hidden" name="costo_total" value="<?php echo $costo_total; ?>">
                                                            </td>
                                                            <td colspan="2">Total de productos: <?php echo $total_cantidad; ?></td>
                                                            <td colspan="2"></td>
                                                        </tr>
                                                      </tbody>
                                                    </table></div>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div></div>
                            
                            </div>
                        </div>
                    </div>
                </div></form>
            <!-- #END# Basic Validation -->

    <?php 
    var_dump($_SESSION["pedido"]); ?>

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>