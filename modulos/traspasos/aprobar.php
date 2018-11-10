<?php 
session_start();
$_SESSION['id_almacen']=1;
    require_once('../menu.php');
?> </section>
    <section class="content">
            <div class="block">
                <h2>
                    TRASPASOS
                </h2>
            </div>

            <?php
            if (isset($_POST['aprobart'])) {
                for ($i=0; $i < count($_SESSION['aprobart']); $i++) {
                    $getalmacen = $Traspasos->get_almacentra();
                    $rowclave = mysqli_fetch_array($getalmacen); 
                    if (strlen($_SESSION['aprobart'][$i])<16) {
                        $regimei= $Traspasos->update_productos_imei_ven($i,$rowclave['clave']);
                        $regclave= $Traspasos->get_poducto_clave_imei($i);
                        $row = mysqli_fetch_array($regclave);
                    }else{
                        $regiccid= $Traspasos->update_productos_iccid_ven($i,$rowclave['clave']);
                        $regclave= $Traspasos->get_poducto_clave_iccid($i);
                        $row = mysqli_fetch_array($regclave);
                    }
                    $regstock= $Traspasos->update_almacen_stock($i,$row['cve']);
                    $regpedido= $Traspasos->update_pedidos();

                    $regcant = $Traspasos->get_cant_asignada($row['cve']);
                    $rowcant = mysqli_fetch_array($regcant);
                    $cant = $rowcant['cant_asignada']+1;

                    $regcantidad= $Traspasos->update_prod_ped_cantidad($cant,$row['cve']);
                    
                }
                $_SESSION['aprobart']=null;
                //$_SESSION['folio']=null;
                
            }
            if (isset($_POST['aprobart'])) {
                for ($i=0; $i < count($_SESSION['tracant']); $i++) {
                    $aprobarp = $Traspasos->update_pedido_cant($i);
                    $aprped = $Traspasos->update_pedidos();
                    
                    $getalmpro = $Traspasos->get_prod_almacen($i);
                    $rowalmdes = mysqli_fetch_array($getalmpro);
                    if (empty($rowalmdes['id_almacen'])) {
                        $agrstock = $Traspasos->insert_prod_almacen($i);
                    }else{
                        $apralm = $Traspasos->update_almacen_stock_cant($i);
                    }
                }
            }
            ?>

            <div class="seccion"><h3>.: Aprobar <b>Traspasos :.</b></h3></div>
            <!-- Basic Examples --><br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class=" card">
                        <div class="body table-responsive borde2">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th width="20px">Folio</th>
                                        <th>Cliente</th>
                                        <th width="23px">Importe</th>                    
                                        <th width="35px">Fecha de Envio</th>                         
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $traspasos = $Traspasos->get_traspasos_pendiente();
                                    while($row = mysqli_fetch_array($traspasos)){ ?>
                                    <tr class="" align="center">
                                        <td><form method="POST" action="detalle_solicitados.php">
                                            <button name="folio" class="boton" value="<?php echo $row['folio']; ?>"><a><?php echo $row['folio']; ?></a></button>
                                            </form></td> <!-- Folio para revisión de productos solicitados en pedido -->
                                        <td><?php echo $row['nombre'].' '.$row['ape_pat'].' '.$row['ape_mat']; ?></td>
                                        <td><?php echo $row['importe']; ?></td>
                                        <td><?php echo $row['fecha_inicio']; ?></td>
                                    </tr><?php } ?>
                                  </tbody>
                            </table></div>
                        </div><br></div>
                    </div>
            <!-- #END# Basic Examples -->
    </section>

        <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>