<?php 
    require_once('../menu.php');
?> </section>

    <section class="content">
            <div class="seccion"><h3>.: <b>Pedidos :.</b></h3></div><br>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div align="right">
                        <div class="form-group form-float">
                            <label>Estado</label>
                            <select class="ui fluid dropdown" name="status" id="status" onchange="return buscarastatus()">
                                <option value=""><?php if ($_POST['estado']==1) {
                                    echo "Aprobado";
                                }elseif ($_POST['estado']=='0') {
                                    echo "Pendiente";
                                }else{ echo "Todos";} ?></option>
                                <option value="2">Todos</option>
                                <option value="1">Aprobado</option>
                                <option value="0">Pendiente</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="card">                        
                        <div class="body table-responsive borde2">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>F/R</th>
                                        <th>Num</th>
                                        <th>Cliente</th>
                                        <th>Importe</th>
                                        <th>Fecha de Envio</th>
                                        <th>Fecha de Cierre</th>
                                        <th>Estado</th>
                                        <th>Almacen</th>
                                        <th>Pagado</th>
                                        <th>Pagos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($_POST['estado'])) {
                                        if ($_POST['estado']==2) {
                                            $pedidos = $Pedidos->get_pedidos_alm();
                                        }else{ $pedidos = $Pedidos->get_pedidos_pa(); }
                                    }else{
                                        $pedidos = $Pedidos->get_pedidos_alm();
                                    }while($row = mysqli_fetch_array($pedidos)){ ?>

                                    <tr class="">
                                        <td><form method="POST" action="detalles.php"><button class="boton" name="folio" value="<?php echo $row['folio']; ?>"><a><?php echo $row['folio']; ?></a></button></form></td>
                                        <td><?php echo $row['tipo_expedicion']; ?></td>
                                        <td><?php echo $row['n_remision']; ?></td>
                                        <td><?php echo $row['nombre'].' '.$row['ape_pat'].' '.$row['ape_mat']; ?></td>
                                        <td><?php echo $row['importe']; ?></td>
                                        <td><?php echo $row['fecha_inicio']; ?></td>
                                        <td><?php echo $row['fecha_cierre']; ?></td>
                                        <td><?php if ($row['estado']==1) {
                                            echo "Aprobado";
                                        } else{ echo "Pendiente";}?></td>
                                        <td><?php echo $row['almacen']; ?></td>
                                        <td><?php if ($row['pagado']==1) {
                                            echo "SI";
                                        } else{ echo "NO"; } ?></td>
                                        <td><form method="POST" action="pagos.php"><button name="pagos" class="boton" value="<?php echo $row['folio']; ?>"><a>Ver</a></button></form></td>
                                    </tr><?php }  ?>
                                </tbody>
                            </table></div>
                        </div><br>
                </div>
            </div>
            <!-- #END# Basic Examples -->
    </section>
    
        <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>