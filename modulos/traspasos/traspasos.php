<?php 
    require_once('../menu.php');
?> </section>

    <section class="content">
             <div class="seccion"><h3>.: Consultar Traspasos :.</h3></div><br>
              <!-- Fin formulario semantic -->
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
                        <div class="body borde2">
                        <div class="body table-responsive">
                            <table class=" table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Num</th>
                                        <th>Cliente</th>
                                        <th>Importe</th>
                                        <th>Fecha de Envio</th>
                                        <th>Fecha de Cierre</th>
                                        <th>Status</th>
                                        <th>Pagado</th>
                                        <th>Pagos</th>
                                        <th>Almacen Origen</th>
                                        <th>Almacen Destino</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($_POST['estado'])) {
                                        if ($_POST['estado']==2) {
                                            $traspasos = $Traspasos->get_traspasos_alm();
                                        }else{ $traspasos = $Traspasos->get_traspasos_pa(); }
                                    }else{
                                        $traspasos = $Traspasos->get_traspasos_alm();
                                    }while($row = mysqli_fetch_array($traspasos)){ ?>
                                    <tr class="">
                                        <td><form method="POST" action="detalles.php"><button class="boton" name="folio" value="<?php echo $row['folio']; ?>"><a><?php echo $row['folio']; ?></a></button></form></td>
                                        <td><?php echo $row['n_remision']; ?></td>
                                        <td><?php echo $row['nombre'].' '.$row['ape_pat'].' '.$row['ape_mat']; ?></td>
                                        <td><?php echo $row['importe']; ?></td>
                                        <td><?php echo $row['fecha_inicio']; ?></td>
                                        <td><?php echo $row['fecha_cierre']; ?></td>
                                        <td><?php if ($row['estado']==1) {
                                            echo "Aprobado";
                                        } else{ echo "Pendiente";}?></td>
                                        <td><?php if ($row['pagado']==1) {
                                            echo "SI";
                                        } else{ echo "NO"; } ?></td>
                                        <td><form method="POST" action="pagos.php"><button name="pagos" class="boton" value="<?php echo $row['folio']; ?>"><a>Ver</a></button></form></td>
                                        <td><?php echo $row['almacen_origen']; ?></td>
                                        <td><?php echo $row['almacen_destino']; ?></td>
                                    </tr><?php }  ?>
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