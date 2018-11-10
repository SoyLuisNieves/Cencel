<?php 
    require_once('../menu.php');
?> </section>
    <section class="content">
            <div class="block">
                <h2>
                    TRASPASOS
                </h2>
            </div>
        <?php if (isset($_POST['del_traspaso'])) { 
                    $traspaso = $Traspasos->eliminar_traspaso();
                } ?>

        <div class="seccion"><h3>.: Traspasos :.</h3></div><br>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card ">
                        <div class="body borde2">
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Cliente</th>
                                        <th>Importe</th>                    
                                        <th>Fecha de Envio</th>
                                        <th>Estatus</th>
                                        <th>Almacen de Origen</th>
                                        <th>Almacen Destino</th>
                                        <th>Eliminar</th>                         
                                    </tr>
                                  </thead>
                                  <tbody>
                                   <?php $pedidos = $Traspasos->get_traspasos_pendiente();
                                   while($row = mysqli_fetch_array($pedidos)){
                                   ?>
                                    <tr class="" align="center">
                                        <td><form action="cont_traspaso.php" method="POST"><button name="folio" class="boton" value="<?php echo $row['folio']; ?>"><a><?php echo $row['folio']; ?></a></button></form></td> <!-- Folio para revisión de productos solicitados en pedido -->
                                        <td><?php echo $row['nombre'].' '.$row['ape_pat'].' '.$row['ape_mat']; ?></td>
                                        <td><?php echo $row['importe']; ?></td>
                                        <td><?php echo $row['fecha_inicio']; ?></td>
                                        <td><?php if ($row['estado']==1) {
                                                echo "Aprobado";
                                            } else{ echo "Pendiente";}?></td>
                                        <td><?php echo $row['almacen_origen']; ?></td>
                                        <td><?php echo $row['almacen_destino']; ?></td>
                                        <td><form action="" method="POST"><button name="del_traspaso" class="boton" value="<?php echo $row['folio']; ?>"><img src="../../images/img/borrar.png" width="23px"></button></form></td>
                                    </tr><?php } ?>
                                  </tbody>
                            </table></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
    </section>

        <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>