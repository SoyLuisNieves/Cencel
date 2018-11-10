<?php 
    require_once('../menu.php');  
?> 
<?php require_once('inicio_session.php');
if (empty($_SESSION['folio'])) { $_SESSION['folio']=$_POST['folio'];}
if (empty($_SESSION['pedido'])) {
    $obpedido = $Pedidos->get_pedido_productos();
    $_SESSION['pedido']=array();
    while ($row=mysqli_fetch_array($obpedido)) {
        array_push($_SESSION['pedido'], array($row['cve'],$row['cant_solicitada']));
    }
}
?>
</section>
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
        <form id="form_validation">
            </form>

<!-- ===================================== CREAR PEDIDO =================================== -->
<div class="seccion"><h3>Editar <b>Pedido</b></h3></div>
            
              <!-- Fin formulario semantic -->
            <form class="ui form" id="form_validation" method="POST">
               
                <?php 
                    if (isset($_POST['depto'])) {
                    }
                ?>

                <div class="fields" align="center">
                                <div class="form-group form-float">
                                <label>Departamento</label>
                                <select class="ui fluid dropdown" name="depto" onchange="return buscar()" id="depto">
                                    <?php $deptos = $Almacen->get_categorias_sel();
                                        $row = mysqli_fetch_array($deptos)?>
                                        <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                          <?php  $depto = $Almacen->get_depto();
                                            while($row = mysqli_fetch_array($depto)){ ?>                            
                                            <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                        <?php }?>
                                </select>
                                </div>
                                <div class="form-group form-float" id="cat_oculto" style="display:;">
                                    <label>Catalogo </label>
                                    <select class="ui fluid dropdown" name="subcat" onchange="return buscarc()" id="catalogo">
                                         <?php $categoriass = $Pedidos->get_catalogo_sel();
                                            $row = mysqli_fetch_array($categoriass) ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option>
                                        <?php $categorias = $Almacen->get_categorias_dep();
                                            while($row = mysqli_fetch_array($categorias)){ ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option> <?php }?>
                                    </select>
                                </div>
                                <div class="form-group form-float" id="cat_oculto" style="display:;"></div>
                                <div class="form-group form-float">
                                    <label class="form-label">Seleccione por Marca</label>
                                    <select class="ui fluid dropdown" name="marca" onchange="return buscarm()" id="marca">
                                        <?php $marcas = $Pedidos->get_marca_sel();
                                        $row = mysqli_fetch_array($marcas) ?>
                                            <option><?php echo $row['marca']; ?></option>
                                            <option value="todos"> - TODOS - </option>
                                            <?php $marca = $Pedidos->get_marca();
                                            while($row = mysqli_fetch_array($marca)){ ?>              
                                            <option><?php echo $row['marca']; ?></option>
                                            <?php }?>
                                    </select>
                                </div>
                            </div>
                        </form>


                <div class="ui">
                    <div class="ui form content">
                        <!-- Basic Validation -->
                         <?php 
                             if (isset($_POST['subcat'])) { 
                                ?>
                            
                                <div class=""  id="oculto" style="display:;">
                                    <div class="body">
                                            <div class="form-group form-float">
                                                <div class="">
                                                    <div class="body table-responsive">
                                                    <table class="borde2 table table-hover table-bordered" border="0">
                                                      <thead align="center">
                                                        <tr><th rowspan="2">Inventario</th>
                                                            <th colspan="5" >Producto</th>                  
                                                            <th rowspan="2">Precio</th>
                                                            <th rowspan="2"><div align="center"><a href="cont_pedido.php"><img src="../../images/img/car.png" width="40px"> </a></div></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>                                                            
                                                            <th>Color</th>
                                                            <th>Tamaño</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $productos = $Pedidos->get_productos_m();
                                                        while($row = mysqli_fetch_array($productos)){ ?>
                                                        <tr class="">
                                                            <td align="center"><?php echo $row['stock'];?></td>
                                                            <td><?php echo $row['cve'];?></td>
                                                            <td><?php echo $row['marca']; ?></td>
                                                            <td><?php echo $row['modelo']; ?></td>
                                                            <td><?php echo $row['color']; ?></td>
                                                            <td><?php echo $row['tamano']; ?></td>
                                                            <td align="center"><?php echo $row['co']; ?></td>
                                                            <td align="center">
                                                                <input type="checkbox" id="<?php echo 'chk_'.$row['cve']; ?>" NAME="<?php echo 'chk'.$row['cve'];?>" value="<?php echo $row['cve'];?>" onclick="valuecheck(this)" <?php if(!empty($_SESSION['pedido'])){
                                                                        for ($i=0; $i < count($_SESSION['pedido']); $i++) { 
                                                                            if($_SESSION['pedido'][$i][0]==$row['cve']){
                                                                                echo 'checked="checked"';
                                                                            }
                                                                        }
                                                                    } ?>>
                                                                <label for="chk_<?php echo $row['cve'] ?>"></label>
                                                            </td>
                                                        </tr><?php } ?>
                                                      </tbody>
                                                    </table></div>
                                                </div>
                                            </div>                            
                                    </div>
                                    <br>
                        </div>
                        <?php } ?>                         
                    </div>
                </div>
                <?php require_once('arraypedidoedt.php'); ?>

            <?php if(!empty($_SESSION['pedido'])){
            ?>
            <script type="text/javascript">
                var pedido = new Array();

                <?php
                for ($i = 0; $i < count($_SESSION['pedido']); $i++) {
                    //echo 'pedido.push($_SESSION["pedido"]['.$i.']);';
                    //echo 'pedido['.$i.'][0]="'.$_SESSION['pedido'][$i][0].'";';
                    echo 'pedido.push(Array("'.$_SESSION['pedido'][$i][0].'",'.$_SESSION['pedido'][$i][1].'));';
                }
                ?>
                //alert(pedido.toString());

                function valuecheck(check)
                {
                    //alert('El check '+check.name+' tiene el valor '+check.value);
                    var repetido=false;
                    if (check.value!=null) {
                        for( $i=0; $i < pedido.length; $i++ )
                        {
                            if( pedido[$i][0] == check.value) {
                                delete pedido[$i];
                                repetido=true;
                                break;
                            }
                        }
                        if (repetido!=true) {
                            pedido.push(Array(check.value));
                        }
                    }
                    cleanpedido=pedido.filter(Boolean);
                    alert(cleanpedido.toString());

                    $('#resultado').load("arraypedidoedt.php",{cleanpedido});
                    
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
                            if( pedido[$i][0] == check.value) {
                                delete pedido[$i];
                                repetido=true;
                                break;
                            }
                        }
                        if (repetido==false) {
                            pedido.push(Array(check.value));
                        }
                    }
                    cleanpedido=pedido.filter(Boolean);
                    //alert(cleanpedido.toString());

                    $('#resultado').load("arraypedidoedt.php",{cleanpedido});
                }

                /*pedido[0] = 155 
                pedido[1] = 4 
                pedido[2] = 499 */
            </script>
            <?php }?>
            <!-- #END# Basic Validation -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>