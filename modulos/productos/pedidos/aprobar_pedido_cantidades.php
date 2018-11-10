    <section class="content">
         <div class="seccion"><h3>.: Detalles <b>Pedido Cantidades:.</b></h3></div>
            <form id="form_validation">
            </form>
              <!-- Fin formulario semantic -->
                <div class="ui">
                    <div class="ui form content">
                    <form method="POST" action="detalle_solicitados.php">
                        <!-- Basic Validation -->
                        <div class="row clearfix">
                            <div  align="right">
                                <div class="form-group">
                                    <input type="radio" name="gender" id="factura" class="with-gap">
                                    <label for="factura">Factura </label>
                                    <div class="ui input mini">
                                        <input placeholder="" type="text" size="7px">
                                    </div>
                                    <input type="radio" name="gender" id="remision" class="with-gap" checked>
                                    <label for="remision" class="m-l-20">Remisión </label>
                                    <div class="ui input mini">
                                        <input placeholder="" type="text" size="7px" value="<?php echo  $row['n_remision']; ?>">
                                    </div>
                                    <label class="m-l-20"> Fecha de Vencimiento </label>
                                    <div class="ui input mini">
                                        <input type="date" name="fecha_v" size="12px" value="<?php echo date("Y-m-d");?>">
                                    </div>
                                </div>
                                <?php $t_serie=0; $pedidos_serie = $Pedidos->aprobar_productos_series();
                                    $row2 = mysqli_fetch_array($pedidos_serie);                                    
                                if (empty($row2)) { ?>
                                    <button class="btn btn-primary waves-effect" type="submit" name="aprobar" value="0">Aprobar Pedido</button>
                                  <?php  }  else{  ?><button class="btn btn-primary waves-effect" type="submit" name="aprobar_cantidades" value="1">Aprobar Cantidades</button>
                                  <?php } ?>                             
                                
                                <input type="hidden" name="folio" value="<?php echo $_POST['folio'];?>">
                            </div>
                            <div class="body"> 
                                <div class="">
                                    <div class="form-group form-float">
                                        <div class="">
                                            <label class="form-label">Productos</label>
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
                                                       <?php  $t_cant=0; $productos = $Pedidos->get_productos_cantidades();
                                                            while($row = mysqli_fetch_array($productos)){ ?>
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
                                                            <td></td>
                                                            <td width="85px"><form class="ui form" id="frm-prueba" method="post">
                                                            <input placeholder="cantidad" type="text" width="5px" ></form></td>
                                                            <td><img src="../../images/img/recargar.png" width="25px"></td>
                                                            <td><img src="../../images/img/borrar.png" width="23px"></td>
                                                            <?php $t_cant=$t_cant+$row['cant_solicitada']; ?>
                                                        </tr><?php } ?>
                                                        <tr align="center" id="totales">                                              <td colspan="4">
                                                            <?php $cant_productos = $Pedidos->num_total_productos();
                                                                $productos_cant = $Pedidos->num_productos_cantidades();
                                                                $productos_series = $Pedidos->num_productos_series();
                                                                    $cant = mysqli_fetch_array($cant_productos); 
                                                                    $cantidad = mysqli_fetch_array($productos_cant);
                                                                    $series = mysqli_fetch_array($productos_series);?>
                                                            Total de Artículos: <?php echo  $cant['productos']; ?>
                                                                <label class="m-l-15"></label>
                                                                ( Cantidades: <?php echo  $cantidad['cantidades'];
                                                                    echo '<label class="m-l-15"></label>';
                                                                echo "Series: ".$series['series'];?> )
                                                        </td>
                                                         <th colspan="3"><label class="m-l-15"></label>SOLICITADOS: 
                                                         <?php echo "<label class='m-l-15'></label>".$t_cant; ?>
                                                         </th> 
                                                            <th colspan="3">APROBADOS:
                                                                <?php echo "<label class='m-l-15'></label>"; ?>
                                                            </th>
                                                            <td colspan="3"> productos cantidades </td>
                                                        </tr>
                                                      </tbody>                                                      
                                                            <?php $importe = $Pedidos->get_importe();
                                                            $imp = mysqli_fetch_array($importe); 
                                                            $total=$imp['importe']; ?>
                                                    </table><div align="center"><h2>Total: $ <?php echo $total; ?></h2></div></div>
                                                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                                                    <input type="hidden" name="t_cant" value="<?php echo $t_cant; ?>">
                                                </div>
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>