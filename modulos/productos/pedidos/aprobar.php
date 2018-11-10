<?php 
session_start();
$_SESSION['id_almacen']=1;
    require_once('../menu.php');
?> </section>
    <section class="content">
            <div class="block">
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <h2>
                        PEDIDOS
                    </h2>
            </div>
          </div>
        </div>
        <?php
        if (isset($_POST['aprobar'])) {
            for ($i=0; $i < count($_SESSION['aprobar']); $i++) { 
                if (strlen($_SESSION['aprobar'][$i])<16) {
                    $regimei= $Pedidos->update_productos_imei_ven($i);
                    $regclave= $Pedidos->get_poducto_clave_imei($i);
                    $row = mysqli_fetch_array($regclave);
                }else{
                    $regiccid= $Pedidos->update_productos_iccid_ven($i);
                    $regclave= $Pedidos->get_poducto_clave_iccid($i);
                    $row = mysqli_fetch_array($regclave);
                }
                $regstock= $Pedidos->update_almacen_stock($i,$row['cve']);
                $regpedido= $Pedidos->update_pedidos();

                $regcant = $Pedidos->get_cant_asignada($row['cve']);
                $rowcant = mysqli_fetch_array($regcant);
                $cant = $rowcant['cant_asignada']+1;

                $regcantidad= $Pedidos->update_prod_ped_cantidad($cant,$row['cve']);
                $_SESSION['aprobar']=null;
                $_SESSION['folio']=null;
            }
            
        }
        ?>
    <div class="seccion"><h3>.: Aprobar <b>Pedidos :.</b></h3></div>
            <!-- Basic Examples --><br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class=" card">
                        <div class="body table-responsive borde2">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th width="23px">Folio</th>
                                        <th>Cliente</th>
                                        <th width="30px">Importe</th>                    
                                        <th width="45px">Fecha de Envio</th>                         
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $pedidos = $Pedidos->get_pedidos_pendiente();
                                    while($row = mysqli_fetch_array($pedidos)){ ?>
                                    <tr class="" align="center">
                                        <td><form method="POST" action="detalle_solicitados.php"><button name="folio" class="boton" value="<?php echo $row['folio']; ?>"><a><?php echo $row['folio']; ?></a></button></form></td><!-- Folio para revisión de productos solicitados en pedido -->
                                        <td><?php echo $row['nombre'].' '.$row['ape_pat'].' '.$row['ape_mat']; ?></td>
                                        <td><?php echo $row['importe']; ?></td>
                                        <td><?php echo $row['fecha_inicio']; ?></td>
                                    </tr><?php } ?>
                                  </tbody>
                            </table></div>
                        </div><br></div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
    </section>

        <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>