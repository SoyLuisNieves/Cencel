<?php 
    require_once('../menu.php');
?> </section>

    <section class="content">
            <div class="block">
                <h2>
                    TRASPASOS
                </h2>
            </div>
            <form id="form_validation">
            </form>
        <div class="seccion"><h3>.: Detalles de Traspaso :.</h3></div>
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
                                                            <th colspan="2"><a href="traspasos.php"><img src="../../images/img/regresar.png" width="45px"></a></th>
                                                            <th colspan="5" >Producto</th>                  
                                                            <th rowspan="2">Precio</th>
                                                            <th rowspan="2">Solicitados</th>                        
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
                                                      <tbody>
                                                      <?php
                                                    $traspaso = $Traspasos->get_traspaso_folio();
                                                    while($row = mysqli_fetch_array($traspaso)){ ?>
                                                        <tr class="" align="center">
                                                            <td><?php echo $row['folio']; ?></td>
                                                            <td><?php echo  $row['cve']; ?></td>
                                                            <td><?php echo  $row['marca']; ?></td>
                                                            <td><?php echo  $row['modelo']; ?></td>
                                                            <td><?php echo  $row['catalogo']; ?></td>
                                                            <td><?php echo  $row['color']; ?></td>
                                                            <td><?php echo  $row['clase'].'<br> '.$row['tamano']; ?></td>
                                                            <td><?php echo  $row['pb']; ?></td>
                                                            <td><?php echo  $row['cant_solicitada'];  
                                                            $total_sol=$total_sol+$row['cant_solicitada'];?></td>
                                                        </tr><?php } ?>
                                                        <tr id="totales">
                                                            <td colspan="8">Total de Productos: </td>
                                                            <td><?php echo $total_sol; ?></td>
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

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>