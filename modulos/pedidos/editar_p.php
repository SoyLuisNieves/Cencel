<?php  
    require_once('../menu.php');
?> </section>

    <section class="content">
            <form id="form_validation">
            </form>
              <!-- Fin formulario semantic -->
            <div class="seccion"><h3>.: Editar Pedido :.</h3></div>
            <?php if (isset($_POST['del_pedido'])) { 
                    $pedido = $Pedidos->eliminar_pedido();
                } ?>
                <div class="ui">
                    <div class="ui form content">
                        <!-- Basic Validation -->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="">
                                    <div class="body"> 
                                        <div class="">
                                            <div class="form-group form-float">
                                                <div class="" align="center">
                                                    <div class="form-group form-float">
                                                        <label>Almacen</label>
                                                        <select class="ui fluid dropdown" name="almacen" onchange="return buscaralm()" id="almacen">
                                                            <?php $almacen = $Almacen->get_almacen_sel();
                                                                $row = mysqli_fetch_array($almacen)?>
                                                                <option value=<?php echo '"'.$row['almacen'].'"'; ?>><?php echo $row['almacen']; ?></option>
                                                                <option value="todos">Todos</option>
                                                                  <?php  $almacenes = $Almacen->get_almacenes();
                                                                    while($row = mysqli_fetch_array($almacenes)){ ?>
                                                                    <option value=<?php echo '"'.$row['almacen'].'"'; ?>><?php echo $row['almacen']; ?></option>
                                                                <?php }?>
                                                        </select>
                                                        </div>
                                                    <br>
                                                    <div class="body table-responsive ">
                                                    <?php 
                                             if (isset($_POST['almacen'])) { 
                                                    if ($_POST['almacen']=="todos") {
                                                        $pedidos = $Pedidos->get_pedidos_pendiente();
                                                    }else{ $pedidos = $Pedidos->get_pedidos_alm_sel_pendiente();}
                                                  ?>
                                                <?php } else{ $pedidos = $Pedidos->get_pedidos_pendiente();}?>
                                                    <table class=" table table-hover table-bordered borde2" border="0">
                                                      <thead align="center">
                                                        <tr>
                                                            <th>Folio</th>
                                                            <th>Cliente</th>
                                                            <th>Almacen</th>
                                                            <th>Importe</th>
                                                            <th>Fecha de Envío</th>
                                                            <th>Estado</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                       <?php 
                                                        while($row = mysqli_fetch_array($pedidos)){ ?>
                                                        <tr class="" align="center">
                                                            <td><form action="edit_pedido.php" method="POST"><button name="folio" class="boton" value="<?php echo $row['folio']; ?>"><a><?php echo $row['folio']; ?></a></button></form></td>
                                                            <td><?php echo $row['nombre'].' '.$row['ape_pat'].' '.$row['ape_mat']; ?></td>
                                                            <td><?php echo $row['almacen']; ?></td>
                                                            <td><?php echo $row['importe']; ?></td>
                                                            <td><?php echo $row['fecha_inicio']; ?></td>
                                                            <td><?php if ($row['estado']==1) {
                                                                echo "Aprobado";
                                                            } else{ echo "Pendiente";}?></td>
                                                            <td><form action="" method="POST"><button name="del_pedido" class="boton" value="<?php echo $row['folio']; ?>"><img src="../../images/img/borrar.png" width="23px"></button></form>
                                                            </td>
                                                        </tr><?php } ?>
                                                      </tbody>
                                                    </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div></div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            <!-- #END# Basic Validation -->

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>