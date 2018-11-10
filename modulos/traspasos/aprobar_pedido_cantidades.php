<?php
session_start();
if(empty($_SESSION['folio'])||$_SESSION['folio']!=$_POST['folio']){
        $_SESSION['folio']=$_POST['folio'];
    }

$_SESSION['id_almacen']=1;
if (isset($_POST['actualizar'])) {
    for ($i=0; $i < count($_SESSION['tracant']); $i++) { 
        if ($_SESSION['tracant'][$i][0]==$_POST['actualizar']) {
            $_SESSION['tracant'][$i][1]=$_POST['cantidad'];
        }
    }
}
if (isset($_POST['borrar'])) {
    for ($i=0; $i < count($_SESSION['tracant']); $i++) { 
        if ($_SESSION['tracant'][$i][0]==$_POST['borrar']) {
            echo '<script>alert("Borrado el producto '.$_POST['borrar'].'")</script>';
            unset($_SESSION['tracant'][$i]);
            $_SESSION['tracant'] = array_values($_SESSION['tracant']);
            $eliprod = $Traspasos->delete_produto_ped($_SESSION['tracant'][$i][0]);
        }
    }
}
?>  
                <form method="POST" action="generar_trasp_ap.php">
                            <div class="body"> 
                                            <label class="form-label">Productos Cantidades</label>
                                            <div class="body table-responsive">
                                                <table class=" table table-hover table-bordered" border="0">
                                                    <thead align="center">
                                                        <tr>
                                                            <th colspan="2" align="center" ><a href="aprobar.php"><img src="../../images/img/regresar.png" width="35px"></a></th>                   
                                                            <th colspan="3" >Producto</th>
                                                            <th rowspan="2">Almacen</th>                
                                                            <th rowspan="2" colspan="1">Precio</th>
                                                            <th colspan="4">Unidades</th>
                                                            <th rowspan="2">Actualizar</th>
                                                            <th rowspan="2">Borrar</th>             
                                                        </tr>
                                                        <tr>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>
                                                            <th>Producto</th>
                                                            <th>Color</th>
                                                            <th>Descripción</th>
                                                            <th>Solicitados</th>
                                                            <th>stock</th>
                                                            <th colspan="2">aprobados</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                       <?php $t_cant=0; $productos = $Traspasos->get_productos_cantidades();
                                                            if (empty($_SESSION['tracant'])&& !isset($_POST['borrar'])) {
                                                                $_SESSION['tracant']=array();
                                                                while($row = mysqli_fetch_array($productos)){
                                                                   array_push($_SESSION['tracant'], array($row['cve'],$row['cant_asignada']));
                                                               }
                                                            }
                                                            for ($i=0; $i < count($_SESSION['tracant']); $i++) { 
                                                            $pedidopro = $Traspasos->get_prod_cant($i);
                                                            $row=mysqli_fetch_array($pedidopro);
                                                            ?>
                                                        <tr class="" align="center">
                                                            <td><?php echo  $row['marca']; ?></td>
                                                            <td><?php echo  $row['modelo']; ?></td> <!-- Aprobar el producto y agregar a la factura o remisión -->
                                                            <td><?php echo  $row['catalogo']; ?></td>
                                                            <td><?php echo  $row['color']; ?></td>
                                                            <td><?php echo  $row['clase'].'<br> '.$row['tamano']; ?></td>
                                                            <td><?php echo  $row['almacen']; ?></td>
                                                            <td><?php echo  $row['pb']; ?></td>
                                                            <!--<td><form class="ui form" id="frm-prueba" method="post"><input placeholder="cantidad" type="text" width="5px"></form></td>-->
                                                            <td><?php echo  $row['cant_solicitada']; ?></td>
                                                            <td><?php echo  $row['stock']; ?></td>
                                                            <td><?php echo $_SESSION['tracant'][$i][1]; ?></td>
                                                            <form class="ui form" id="frm-prueba" method="post">
                                                            <td width="85px">
                                                            <input placeholder="cantidad" name="cantidad" type="text" width="5px" ></td>
                                                            <input name="folio" type="hidden" width="5px" value="<?php echo $_SESSION['folio']; ?>"></td>
                                                            <td><button type="submit" name="actualizar" value="<?php echo $row['cve']; ?>" class="boton"><img src="../../images/img/recargar.png" width="25px"></button></td>
                                                            <td><button type="submit" name="borrar" value="<?php echo $row['cve']; ?>" class="boton" ><img src="../../images/img/borrar.png" width="23px"></button></td>
                                                            </form>
                                                        </tr><?php } ?>
                                                        <tr align="center" id="totales">
                                                            <?php $total=$row['importe']; ?>
                                                            <td colspan="11">
                                                            <?php $cant_productos = $Traspasos->num_total_productos();
                                                                $productos_cant = $Traspasos->num_productos_cantidades();
                                                                $productos_series = $Traspasos->num_productos_series();
                                                                    $cant = mysqli_fetch_array($cant_productos); 
                                                                    $cantidad = mysqli_fetch_array($productos_cant);
                                                                    $series = mysqli_fetch_array($productos_series);?>
                                                            Total de Artículos: <?php echo  $cant['productos']; ?></td>
                                                            <td colspan="2">Cantidades: <?php echo  $cantidad['cantidades'];
                                                                echo '<label class="m-l-20"></label>';
                                                                echo "Series: ".$series['series'];?></td>
                                                        </tr>
                                                      </tbody>
                                                      </table>
                                                </div>                               
                                    </div>
                </form>
                <?php var_dump($_SESSION["tracant"]); ?>