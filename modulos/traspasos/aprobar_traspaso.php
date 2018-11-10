<?php 
error_reporting("0");
    session_start();
    require_once('../menu.php');
?> </section>
<?php if(empty($_SESSION['folio'])){$_SESSION['folio']=$_POST['folio'];} ?>
<?php require_once('inicio_session.php'); ?>

    <section class="content">
            <div class="block">
                <div class="col-md-1"><form method="POST" action="detalle_solicitados.php"><button class="boton" name="folio" value="<?php echo $_POST['folio'];?>"><img src="../../images/img/regresar.png" width="38px"></button></form></div>
                <h2><br>
                    TRASPASOS
                </h2>
            </div>
            <form id="form_validation">
            </form>
        <div class="seccion"><h3>.: Detalles de Traspaso Solicitado:.</h3></div><br>
              <!-- Fin formulario semantic -->
            <div class="body"> 
                <div class="card ">
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead align="center">
                                <tr>                            
                                    <th >Clave</th>
                                    <th >IMEI</th>
                                    <th >ICCID/SERIE</th>
                                    <th ><div align="center"><form action="generar_trasp_ap.php" method="POST"><button name="folio" class="boton" value="<?php echo $_POST['folio']; ?>"><img src="../../images/img/car.png" width="40px"></button></form></div></th>             
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $productos = $Traspasos->get_productos_series();
                                    while($row = mysqli_fetch_array($productos)){ ?>
                                <tr class="" align="center">
                                    <td><?php echo  $row['cve']; ?></td>
                                    <td><?php echo  $row['imei']; ?></td> <!-- Aprobar el producto y agregar a la factura o remisión -->
                                    <td><?php echo  $row['iccid']; ?></td>
                                    <td><div class="form-group">
                                    <?php if ($row['tipo']==1) { ?>
                                        <input type="checkbox" id="<?php echo $row['iccid']; ?>" name="<?php echo $row['iccid']; ?>" onclick="valuecheck(this)" value="<?php echo $row['iccid']; ?>" 
                                        <?php if(!empty($_SESSION['aprobart'])){
                                            for ($i=0; $i < count($_SESSION['aprobart']); $i++) { 
                                                if($_SESSION['aprobart'][$i]==$row['iccid']){
                                                    echo 'checked="checked"';
                                                }
                                            }
                                        } ?>>
                                        <label for="<?php echo $row['iccid']; ?>"></label></div>
                                    <?php }elseif ($row['tipo']==2) { ?>
                                        <input type="checkbox" id="<?php echo $row['imei']; ?>" onclick="valuecheck(this)" name="<?php echo $row['imei']; ?>" value="<?php echo $row['imei']; ?>"
                                        <?php if(!empty($_SESSION['aprobart'])){
                                            for ($i=0; $i < count($_SESSION['aprobart']); $i++) { 
                                                if($_SESSION['aprobart'][$i]==$row['imei']){
                                                    echo 'checked="checked"';
                                                }
                                            }
                                        } ?>>
                                        <label for="<?php echo $row['imei']; ?>"></label></div>
                                    <?php } ?>                                        
                                    </td>
                                </tr><?php } ?>
                            </tbody>
                        </table></div>
                </div>
            </div>
                            
            <!-- #END# Basic Validation -->
            <?php require_once('arrayaprobart.php'); ?>

            <?php if(!empty($_SESSION['aprobart'])){
            ?>
            <script type="text/javascript">
                var pedido = new Array();

                <?php
                for ($i = 0; $i < count($_SESSION['aprobart']); $i++) {
                    //echo 'pedido.push($_SESSION["pedido"]['.$i.']);';
                    //echo 'pedido['.$i.'][0]="'.$_SESSION['pedido'][$i][0].'";';
                    echo 'pedido.push("'.$_SESSION['aprobart'][$i].'");';
                }
                ?>
                //alert(pedido.toString());

                function valuecheck(check)
                {
                    var repetido=false;
                    if (check.value!=null) {
                        for( $i=0; $i < pedido.length; $i++ )
                        {
                            if( pedido[$i] == check.value) {
                                delete pedido[$i];
                                repetido=true;
                                break;
                            }
                        }
                        if (repetido==false) {
                            pedido.push(check.value);
                        }
                    }
                    cleanpedido=pedido.filter(Boolean);
                    alert(cleanpedido.toString());

                    $('#resultado').load("arrayaprobart.php",{cleanpedido});
                    
                }
            </script>
            <?php
            }else{?>

            <script type="text/javascript">
                var pedido = new Array();
                
                function valuecheck(check)
                {
                    //alert('El check '+check.name+' tiene el valor '+check.value);
                    var repetido=false;
                    if (check.value!=null) {
                        for( $i=0; $i < pedido.length; $i++ )
                        {
                            if( pedido[$i] == check.value) {
                                delete pedido[$i];
                                repetido=true;
                                break;
                            }
                        }
                        if (repetido==false) {
                            pedido.push(check.value);
                        }
                    }
                    cleanpedido=pedido.filter(Boolean);
                    alert(cleanpedido.toString());

                    $('#resultado').load("arrayaprobart.php",{cleanpedido});
                }
            </script>
            <?php }?>

    <script src="../../plugins/jquery/jquery.min.js"></script>     
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
 <?php require_once('../footer.php');?>