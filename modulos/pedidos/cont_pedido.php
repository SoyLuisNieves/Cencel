<?php 
error_reporting("0");
session_start();
    require_once('../menu.php');
?> 
    <?php
    if (isset($_POST['borrar'])) {
        for ($i=0; $i <count($_SESSION['pedido']) ; $i++) { 
            if ($_SESSION['pedido'][$i][0]==$_POST['borrar']) {
                unset($_SESSION['pedido'][$i]);
                $_SESSION['pedido'] = array_values($_SESSION['pedido']);
            }
        }
    }
    if (isset($_POST['editar'])) {
        //obtener los productos solicitados del pedido
        $obtpedido = $Pedidos->get_pedido_productos();
        while ($row1=mysqli_fetch_array($obtpedido)) {
            $existe=false; 
            for ($i=0; $i < count($_SESSION['pedido']); $i++) {
                if ($_SESSION['pedido'][$i][0]==$row1['cve']) {
                    $existe=true;
                    break;
                }
            }
            //elimina los productos no exitentes en el arrays
            if ($existe==false) {
                $delprod = $Pedidos->delete_productos_pedido($row1['cve']);
            }
        }
        
        
        //actualiza la cantidad ingresad y registra los productos no existentes
        for ($i=0; $i < count($_SESSION['pedido']); $i++) {
            $actualizado = false; 
            $obtpedido = $Pedidos->get_pedido_productos();
            while ($row=mysqli_fetch_array($obtpedido)){
                if ($_SESSION['pedido'][$i][0]==$row['cve']) {
                    $actpedido = $Pedidos->update_pedido_prod($i);
                    $actualizado=true;
                }
            }
            if ($actualizado==false) {
                if (empty($_SESSION['pedido'][$i][1])) {
                    $regpedido = $Pedidos->insert_prod_cant_pedido2($i,1);
                }else{
                    $regpedido = $Pedidos->insert_prod_cant_pedido($i);
                }
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
</section>

    <section class="content">
              <!-- Fin formulario semantic -->
            <div class="seccion"><h3>.: Contenido del Pedido :.</h3></div>

            <form class="ui form" action="cont_pedido.php" id="form_validation" method="POST">
                <div class="ui"><br>
                        <!-- Basic Validation -->
                                            <div class="form-group form-float">
                                                <div class="">
                                                    <div class="body table-responsive ">
                                                    <table class=" table table-hover table-bordered borde2" border="0">
                                                      <thead align="center">
                                                        <tr>
                                                            <th colspan="2" ><a href="editar_p.php"><img src="../../images/img/regresar.png" width="40px"></a></th>
                                                            <th colspan="3" > Producto</th>                  
                                                            <th rowspan="2">Precio</th>
                                                            <th colspan="2">Cantidad</th>
                                                            <th colspan="2"><a href="#"><button type="submit" name="editar" class="boton"><img src="../../images/img/editar.png" width="40px"></button></a></th>
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
                                                            <td><?php echo  $row['marca']; ?></td>
                                                            <td><?php echo  $row['modelo']; ?></td>
                                                            <td><?php echo  $row['catalogo']; ?></td>
                                                            <td><?php echo  $row['color']; ?></td>
                                                            <td><?php echo  $row['clase'].'<br> '.$row['tamano']; ?></td>
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
                                       
                </div></form>
            <!-- #END# Basic Validation -->

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>