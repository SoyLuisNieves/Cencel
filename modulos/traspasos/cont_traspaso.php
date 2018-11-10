<?php 
error_reporting("0");
session_start();
    require_once('../menu.php');
?> 
<?php require_once('inicio_session.php');
$_SESSION['id_almacen']=1;
if(empty($_SESSION['folio'])||$_SESSION['folio']!=$_POST['folio'] && isset($_POST['folio'])){
    $_SESSION['folio']=$_POST['folio'];
    $_SESSION['traspaso']=array();
}
//if (empty($_SESSION['folio'])) { $_SESSION['folio']=$_POST['folio'];}
if (empty($_SESSION['traspaso'])) {
    $obpedido = $Traspasos->get_pedido_productos();
    $_SESSION['traspaso']=array();
    while ($row=mysqli_fetch_array($obpedido)) {
        array_push($_SESSION['traspaso'], array($row['cve'],$row['cant_solicitada']));
    }
}
?> 
    <?php
    if (isset($_POST['borrar'])) {
        for ($i=0; $i <count($_SESSION['traspaso']) ; $i++) { 
            if ($_SESSION['traspaso'][$i][0]==$_POST['borrar']) {
                unset($_SESSION['traspaso'][$i]);
                $_SESSION['traspaso'] = array_values($_SESSION['traspaso']);
            }
        }
    }
    if (isset($_POST['editar'])) {
        //obtener los productos solicitados del pedido
        $obtpedido = $Traspasos->get_pedido_productos();
        while ($row1=mysqli_fetch_array($obtpedido)) {
            $existe=false; 
            for ($i=0; $i < count($_SESSION['traspaso']); $i++) {
                if ($_SESSION['traspaso'][$i][0]==$row1['cve']) {
                    $existe=true;
                    break;
                }
            }
            //elimina los productos no exitentes en el arrays
            if ($existe==false) {
                $delprod = $Traspasos->delete_productos_pedido($row1['cve']);
            }
        }
        
        
        //actualiza la cantidad ingresad y registra los productos no existentes
        for ($i=0; $i < count($_SESSION['traspaso']); $i++) {
            $actualizado = false; 
            $obtpedido = $Traspasos->get_pedido_productos();
            while ($row=mysqli_fetch_array($obtpedido)){
                if ($_SESSION['traspaso'][$i][0]==$row['cve']) {
                    $actpedido = $Traspasos->update_pedido_prod($i);
                    $actualizado=true;
                }
            }
            if ($actualizado==false) {
                if (empty($_SESSION['traspaso'][$i][1])) {
                    $regpedido = $Traspasos->insert_prod_cant_pedido2($i,1);
                }else{
                    $regpedido = $Traspasos->insert_prod_cant_pedido($i);
                }
            }
        }
        $_SESSION['traspaso']=array();
    }
    if (isset($_POST['actualizar'])) {
        for ($i=0; $i < count($_SESSION['traspaso']) ; $i++) { 
            if ($_SESSION['traspaso'][$i][0]==$_POST['actualizar']) {
                $clave=$_POST['actualizar'];
                $_SESSION['traspaso'][$i][1]=$_POST[$clave];
            }
        }
    }
    ?>
</section>

    <section class="content">
            <div class="block">
                <h2>
                    Traspasos
                </h2>
            </div>            
        <div class="seccion"><h3>.: Contenido del Traspaso :.</h3></div>
        <form id="form_validation">
            </form>
              <!-- Fin formulario semantic -->
            <form class="ui form" id="form_validation" method="POST">
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
                                                    <table class="borde2 table table-hover table-bordered" border="0">
                                                      <thead align="center">
                                                        <tr>
                                                            <th colspan="2" ><a href="sel_prod_modif.php"><img src="../../images/img/rcar.png" width="40px"></a></th> 
                                                            <th colspan="3" >Producto</th>                 
                                                            <th rowspan="2">Precio</th>
                                                            <th colspan="2">Cantidad</th>
                                                            <th colspan="2"><button type="submit" name="editar" class="boton"><img src="../../images/img/editar.png" width="40px"></button></a></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>
                                                            <th>Producto</th>
                                                            <th>Color</th>
                                                            <th>Descripción</th>
                                                            <th>Actual</th>
                                                            <th width="20px">Modificar</th>
                                                            <th rowspan="2" width="7px">Actualizar</th>
                                                            <th rowspan="2" width="7px">Borrar</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                      <?php
                                                          for ($i=0; $i < count($_SESSION['traspaso']); $i++) { 
                                                               $pedidopro = $Traspasos->get_pedido_prod($i);
                                                               $row=mysqli_fetch_array($pedidopro);
                                                               ?>
                                                        <tr class="" align="center">
                                                            <td><?php echo  $row['marca']; ?></td>
                                                            <td><?php echo  $row['modelo']; ?></td>
                                                            <td><?php echo  $row['catalogo']; ?></td>
                                                            <td><?php echo  $row['color']; ?></td>
                                                            <td><?php echo  $row['clase'].'<br> '.$row['tamano']; ?></td>
                                                            <td><?php if(empty($_SESSION['traspaso'][$i][1])){echo $costo=$row['pb'];}else{
                                                                    if (empty($_SESSION['traspaso'][$i][1])) {
                                                                        $_SESSION['traspaso'][$i][1]=1;
                                                                    }
                                                                    $costo=$row['pb']*$_SESSION['traspaso'][$i][1];
                                                                    echo $costo;} 
                                                                    $costo_total=$costo_total+$costo;
                                                                    ?></td>
                                                            <td><?php if(empty($_SESSION['traspaso'][$i][1])){ echo $_SESSION['traspaso'][$i][1]=1;}else{echo $_SESSION['traspaso'][$i][1];} 
                                                                $total_cantidad=$total_cantidad+$_SESSION['traspaso'][$i][1];
                                                                ?></td>

                                                            <td><input placeholder="cantidad" name="<?php echo $row['cve']; ?>" type="number" width="5px"></td>
                                                            <td><button type="submit" name="actualizar" value="<?php echo $row['cve']; ?>" class="boton" ><img src="../../images/img/recargar.png" width="25px"></button></td>
                                                            <td><button type="submit" name="borrar" value="<?php echo $row['cve']; ?>" class="boton" ><img src="../../images/img/borrar.png" width="23px"></button></td>
                                                        </tr>
                                                        <?php
                                                           } 
                                                        ?>
                                                        <tr id="totales">
                                                            <td colspan="5">Total de Artículos:  <?php echo count($_SESSION['traspaso']); ?></td>
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
            <?php var_dump($_SESSION["traspaso"]); ?>

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>