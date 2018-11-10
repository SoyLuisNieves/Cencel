                <div class="seccion"><h3>Almacenes <b>Inactivos</b></h3></div>
                <br>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body borde2">
                                    <div class="body table-responsive"><form method="POST" action="almacenes.php">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Clave</th>
                                                <th>Almacén</th>
                                                <th>Dirección</th>
                                                <th>Contacto</th>
                                                <th>Telefono</th>
                                                <th>status</th>
                                                <th width="10px">Activar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $almacenes = $Almacen->get_almacenes_in();
                                            while($row = mysqli_fetch_array($almacenes)){ ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['clave']; ?></th>
                                                <td><?php echo $row['almacen']; ?></td>
                                                <td><?php echo $row['direccion']; ?></td>
                                                <td><?php echo $row['contacto']; ?></td>
                                                <td><?php echo $row['telefono1']; ?></td>
                                                <td><?php if ($row['status']==1) {
                                                    echo "Activo";
                                                } else { echo "Inactivo";}
                                                echo '</td>
                                                <td><button name="activar_alm" value="'.$row['id_almacen'].'" onclick="mostraract()"><i class="material-icons">cached</i>
                                                </button>
                                                </td>
                                            </tr>';  }?>
                                        </tbody>
                                    </table></form>
                                </div></div>
                        </div>
                            
                            </div>
                        </div>
            <!-- #END# Basic Validation -->
       