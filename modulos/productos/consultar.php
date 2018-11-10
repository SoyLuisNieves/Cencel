
<?php 
    require_once('../menu.php');
    
?>     </section>


    <section class="content">
            <div class="block">
             <div class="row clearfix">
                <div class="col-md-2">
                    <h2>
                        PRODUCTOS
                    </h2>
                </div>
                <div class="col-md-9"><div class="seccion">buscar</div>
                <form id="form_validation" method="POST" action="consultar.php">
                <div class="col-md-5">
                    <select onchange="habilitar(this.value);" name="tipo">
                        <option value="0"></option>
                        <?php $tipo = $Productos ->get_catalogos();
                                while ($row=mysqli_fetch_array($tipo)) {?>
                        <option value="<?php echo $row['tipo'];?>"><?php echo $row['catalogo'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="field">
                        <label for="imei"> IMEI </label>
                        <div class="ui input mini">
                            <input placeholder="IMEI" name="imei" id="imei" type="text" size="16px" list="busimei" disabled="false">
                            <datalist id="busimei">
                                <?php $imei = $Productos ->get_imei();
                                while ($row=mysqli_fetch_array($imei)) {
                                    echo '<option value="'.$row['imei'].'" />';
                                }
                                ?>
                            </datalist>
                        </div>
                    </div><br>
                    <div class="field">
                        <label for="iccid"> ICCID </label>
                        <div class="ui input mini">
                            <input placeholder="ICCID" name="iccid" id="iccid" type="text" size="15px" list="busiccid" disabled="false">
                            <datalist id="busiccid">
                                <?php $iccid = $Productos ->get_iccid();
                                while ($row=mysqli_fetch_array($iccid)) {
                                    echo '<option value="'.$row['iccid'].'" />';
                                }
                                ?>
                            </datalist>
                        </div>
                    </div>
                </div><hr>
                <div align="center"><button name="buscar" class=" ui submit button blue btn" type="submit">BUSCAR</button></div>
                </form></div>
             </div>
            </div>
            
            <?php if (isset($_POST['act_prod_imei'])) {
                $editar = $Productos->udp_imei_editar(); }
                if (isset($_POST['act_prod_iccid'])) {
                $editar = $Productos->udp_iccid_editar(); }
            ?>
            <?php if (isset($_POST['editariccid']) or isset($_POST['editarimei'])) { ?>

        <form class="ui form" method="POST" action="consultar.php">
            <div class="seccion"><h3>Modificar <b>Equipos</b></h3></div>
                <div class="ui">
                    <div class="ui form content">
                        <?php if (isset($_POST['editarimei'])) {
                            $editar = $Productos->get_imei_editar(); }
                            if (isset($_POST['editariccid'])) {
                            $editar = $Productos->get_iccid_editar(); }
                            $row = mysqli_fetch_array($editar) ?>
                        <div align="right" class="field">
                            <div id="enlaces"><label>Fecha de Facturación</label>
                            <div id="caja"><?php echo $row['fecha_factura']; ?></div></div>
                            <div id="enlaces"><label>No. de Factura</label>
                            <div id="caja"><?php echo $row['n_factura']; ?></div></div>
                        </div><br><hr>
                            <div class="fields borde">
                                <div class="field">
                                    <input style="display:none;" type="text" class="form-control" name="imei_id" value="<?php echo $row['imei'];?>" >
                                    <input style="display:none;" type="text" class="form-control" name="iccid_id" value="<?php echo $row['iccid'];?>">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Clave Producto</label>
                                        <input type="text" class="form-control" name="clave" value="<?php echo $row['cve']; ?>" required disabled>
                                    </div>
                                </div>
                                <div class="four wide field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Num. Telefónico</label>
                                        <input type="text" class="form-control" name="num_tel" value="<?php echo $row['n_telefono']; ?>" required>
                                    </div>
                                </div>
                                <?php if ($row['tipo']==2) { ?>
                                <div class="field">
                                    <div class="form-group form-float">
                                        <label class="form-label">IMEI</label>
                                        <input type="text" class="form-control" name="imei" value="<?php echo $row['imei']; ?>" required>
                                    </div>
                                </div><?php } ?>
                                <div class="field">
                                    <div class="form-group form-float">
                                        <label class="form-label">ICCID</label>
                                        <input type="text" class="form-control" name="iccid" value="<?php echo $row['iccid']; ?>" required>
                                    </div>
                                </div> 
                                <div class=" field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Fecha de Activación</label>
                                        <input type="date" class="form-control" name="fecha_activacion" value="<?php echo $row['fecha_activacion']; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row clearfix">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div class="form-group form-float">
                                        <label class="form-label">Observaciones</label>
                                        <input type="textarea" id="" class="form-control" name="observaciones" value="<?php echo $row['observaciones']; ?>">
                                    </div>
                                </div>
                            </div><div class="borde">
                            <div class="fields esp2">
                                <div class="six wide field">
                                    <label>Cliente</label>
                                    <input type="text" name="cliente">
                                </div>
                                <div class="two wide field">
                                    <label>Folio</label>
                                    <input type="text" name="folio" required value="<?php echo $row['folio']; ?>">
                                </div>
                                <div class="field">
                                    <label>Vendido</label>
                                    <select name="venta">
                                        <option value="<?php echo $row['vendido']; ?>"><?php if ( $row['vendido']==0) {
                                                    echo "NO";
                                                }else{echo "SI";} ?></option>
                                        <option value="1">SI</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Almacen</label>
                                    <select>
                                        <option>Almacen1</option>
                                    </select>
                                </div>
                            </div></div>
                            <div align="center">
                                <?php if (isset($_POST['editarimei'])) { ?><button name="act_prod_imei" class=" ui submit button Green btn" type="submit">ACTUALIZAR</button><?php } ?>
                                <?php if (isset($_POST['editariccid'])) { ?><button name="act_prod_iccid" class=" ui submit button Green btn" type="submit">ACTUALIZAR</button><?php } ?>
                                <a href="consultar.php" class="ui submit button red">CANCELAR</a>
                            </div>
                            <hr>
                        <!-- Basic Validation -->
                    </div>
                </div></form>

        <?php } ?>



<?php if (isset($_POST['buscar'])) { ?>
              <!-- Fin formulario semantic -->
                <div class="">
                <div class="seccion"><h3>Datos <b>Equipos</b></h3></div>
                <br>
                    <div class="">
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="body borde2">
                                    <div class="body table-responsive"><form method="POST" action="consultar.php">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Num. de Factura</th>
                                                <th>Fecha de Facturación</th>
                                                <th>Clave Producto</th>
                                                <th>IMEI</th>
                                                <th>ICCID</th>
                                                <th>Num. Telefónico</th>
                                                <th>Fecha de Activación</th>
                                                <th>Observaciones</th>
                                                <th>Folio</th>
                                                <th>Vendido</th>
                                                <th>Cliente</th>
                                                <th>Tipo Cliente</th>
                                                <th>Almacen</th>
                                                <th>Modificar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($_POST['iccid'])) {
                                            $considencias = $Productos->get_considencias_iccid();
                                             while($row = mysqli_fetch_array($considencias)){ ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['id_factura']; ?></th>
                                                <td><?php echo $row['fecha_factura']; ?></td>
                                                <td><?php echo $row['cve']; ?></td>
                                                <td><?php echo $row['imei']; ?></td>
                                                <td><?php echo $row['iccid']; ?></td>
                                                <td><?php echo $row['n_telefono']; ?></td>
                                                <td><?php echo $row['fecha_activacion']; ?></td>
                                                <td><?php echo $row['observaciones']; ?></td>
                                                <td><?php echo $row['folio']; ?></td>
                                                <td><?php if ( $row['vendido']==0) {
                                                    echo "NO";
                                                }else{echo "SI";} ?></td>
                                                <td><?php echo $row['cliente']; ?></td>
                                                <td><?php echo $row['tipo_cliente']; ?></td>
                                                <th><?php echo $row['clave']; ?></th>
                                                <?php 
                                                    echo '
                                                    <td width="7px"><button name="editariccid" value="'.$row['iccid'].'"><i class="material-icons">edit</i>
                                                    </button></td>
                                                </tr>'; ?>
                                            <?php } }?>

                                            <?php if (!empty($_POST['imei'])) {
                                            $considencias = $Productos->get_considencias_imei();
                                             while($row = mysqli_fetch_array($considencias)){ ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['id_factura']; ?></th>
                                                <td><?php echo $row['fecha_factura']; ?></td>
                                                <td><?php echo $row['cve']; ?></td>
                                                <td><?php echo $row['imei']; ?></td>
                                                <td><?php echo $row['iccid']; ?></td>
                                                <td><?php echo $row['n_telefono']; ?></td>
                                                <td><?php echo $row['fecha_activacion']; ?></td>
                                                <td><?php echo $row['observaciones']; ?></td>
                                                <td><?php echo $row['folio']; ?></td>
                                                <td><?php if ( $row['vendido']==0) {
                                                    echo "NO";
                                                }else{echo "SI";} ?></td>
                                                <td><?php echo $row['cliente']; ?></td>
                                                <td><?php echo $row['tipo_cliente']; ?></td>
                                                <th><?php echo $row['clave']; ?></th>
                                                <?php 
                                                if (empty($row['imei'])) {
                                                    
                                                }else {
                                                        echo '
                                                    <td width="7px"><button name="editarimei" value="'.$row['imei'].'"><i class="material-icons">edit</i>
                                                    </button></td>
                                                </tr>';
                                                }
                                                 ?>
                                            <?php } }?>
                                        </tbody>
                                    </table></form>
                                </div></div>
                        </div>
                            
                            </div>
                        </div>
                    </div>
                </div><?php }?>
            <!-- #END# Basic Validation -->

</section>

<script>
    function habilitar(value)
    {
        if(value=="1" || value==true)
        {
            document.getElementById("imei").disabled=true;
            document.getElementById("iccid").disabled=false;
        }else if(value=="2" || value==false){
            document.getElementById("imei").disabled=false;
            document.getElementById("iccid").disabled=false;
        }
    }
</script>

<script type="text/javascript">
function iccid(){

    divT = document.getElementById("iccid");
    divT.style.display = "";
    divI = document.getElementById("oculto");
    divI.style.display = "";
}
</script>
    <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>