<?php 
    require_once('../menu.php');
?> </section>

    <section class="content">
            <div class="block">
                <h2>
                    PEDIDOS
                    <a href="http://localhost/cencel/export.php">Exportar</a>
                </h2>
            </div>
        <div class="seccion"><h3>.: Detalles <b>Pedidos - Enviados:.</b></h3></div><br>
            <a href="../../exportPedido.php?folio=6"><img src="../extras/excel.png" width="50" height="50" alt=""></a>

            <form id="form_validation">
            </form>
              <!-- Fin formulario semantic -->
                        <!-- Basic Validation -->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="">
                                                    <div class="body table-responsive">
                                                    <table class=" table table-hover table-bordered" border="0">
                                                      <thead align="center">
                                                        <tr>
                                                            <th colspan="2"><a href="pedidos.php"><img src="../../images/img/regresar.png" width="35px"></a></th>
                                                            <th colspan="5" >Producto</th>                  
                                                            <th rowspan="2">Precio</th>
                                                            <th rowspan="2">Cantidad Solicitada</th>
                                                            <th rowspan="2">Cantidad Asignada</th>                          
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
                                                      <tbody><?php
                                            $pedidos = $Pedidos->get_pedido_folio();
                                            while($row = mysqli_fetch_array($pedidos)){ ?>
                                                <input type="hidden" id="remision" value="<?php echo $row['folio']; ?>">
                                                        <tr class="" align="center">
                                                            <td><?php echo $row['folio']; ?></td>
                                                            <td><?php echo  $row['cve']; ?></td>
                                                            <td><?php echo  $row['marca']; ?></td>
                                                            <td><?php echo  $row['modelo']; ?></td>
                                                            <td><?php echo  $row['catalogo']; ?></td>
                                                            <td><?php echo  $row['color']; ?></td>
                                                            <td><?php echo  $row['clase'].'<br> '.$row['tamano']; ?></td>
                                                            <td><?php echo  $row['pb']; ?></td>
                                                            <td><?php echo  $row['cant_solicitada']; ?></td>
                                                            <td><?php echo  $row['cant_asignada']; ?></td>
                                                        </tr><?php $total_asig=$total_asig+$row['cant_asignada'];
                                                             $total_sol=$total_sol+$row['cant_solicitada']; }  ?>
                                                        <tr id="totales" align="center">
                                                            <td colspan="8" align="right">Total de Productos: </td>
                                                            <td><?php echo $total_sol; ?></td>
                                                            <td><?php echo $total_asig; ?></td>
                                                            
                                                        </tr>
                                                      </tbody>
                                                    </table></div>
                                                </div>
                                            </div>
                            </div>
                        </div>
            <!-- #END# Basic Validation -->

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>