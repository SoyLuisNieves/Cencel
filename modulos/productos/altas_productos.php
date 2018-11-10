<?php 
    require_once('../menu.php');  
    session_start();
$_SESSION['id_almacen']=1;
    ?>

</section>

    <section class="content">
      <div class="block">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-2 col-sm-6 col-xs-12">
                    <h2>
                        INGRESAR PRODUCTOS
                    </h2>
            </div>                      
            <div class="" align="right">
               <a href="capturar.php">
                <div id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">add_circle_outline</i>
                        </div>
                        <div class="bton">
                            <div class="text">INGRESAR SERIES</div>
                        </div>
                    </div>
                </div>
               </a>
               <a href="consultar.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">CONSULTAR SERIES</div>
                        </div>
                    </div>
                </div>
               </a> 
            </div>
          </div>
        </div>
            <form id="form_validation">
            </form>
            
      <!-- ============================== FACTURA ==================== -->
               <!-- ============================== FACTURA ==================== -->
            <!-- declara arreglo para agregar productos-->
            <?php
                $exisfac = false;
                $existe=false;
                if(!isset($_POST['productos']) || isset($_POST['clear'])) {
                    // Creamos el array productos
                    $productos = array();
                } else {
                    // si existe lo deserializamos para poder tratarlo
                    $productos = unserialize(stripslashes($_POST['productos']));
                    if (isset($_POST['agregar'])&& !empty($_POST['clave'])&& !empty($_POST['cantidad'])) {
                        for ($i=0; $i < count($productos) ; $i++) { 
                            if ($_POST['clave']==$productos[$i][0]) {
                                $existe=true;
                                $i=count($productos);
                            }
                        }
                        if($existe == false){
                            $selproducto = $Productos->get_producto_id();
                            $prod = mysqli_fetch_array($selproducto);
                            $clave = $prod['cve'];
                            $marca = $prod['marca'];
                            $modelo = $prod['modelo'];
                            $cantidad = $_POST['cantidad'];
                            array_push($productos, array($clave,$marca,$modelo,$cantidad));
                        }
                        
                    }
                    //var_dump($productos);
                }
            ?>
            <?php
                if (isset($_POST['actualizar'])) {
                    $productos[$_POST['actualizar']][3]=$_POST['act'.$_POST['actualizar']];
                }
                if (isset($_POST['borrar'])) {
                    unset($productos[$_POST['borrar']]);
                    $productos = array_values($productos);
                    //var_dump($productos);
                }
                if (isset($_POST['gproductosfac'])) {
                    $nofacatura = $Productos->get_factura();
                    if($row=mysqli_fetch_array($nofacatura)){
                        $exisfac = true;
                    }else{
                        $ingresarpro = $Productos->insert_productos($productos);
                    }
                }
            ?>
            <!-- borrar registro del arreglo de productos -->
            
              <form class="ui form" method="POST" action="altas_productos.php">
              <div class="seccion"><h3>Ingresar <b>Factura</b></h3></div>
                    <div class="ui form content">
                        <div class="fields borde" align="center">
                            <div class="form-group form-float six wide field">
                                <label>Selecciona el Departamento</label>
                                <select class="ui fluid dropdown" name="cat" onchange="return buscar()" id="depto">
                                    <?php $deptos = $Almacen->get_categorias_sel();
                                        $row = mysqli_fetch_array($deptos);
                                        if (isset($_POST['clear'])||isset($_POST['agregar'])||isset($_POST['actualizar'])||isset($_POST['borrar'])) {
                                             $deptos = $Productos->get_depto_id();
                                             $row=mysqli_fetch_array($deptos);
                                         } ?>
                                        <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                          <?php  $depto = $Almacen->get_depto();
                                            while($row = mysqli_fetch_array($depto)){ ?>                            
                                            <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                        <?php }?>
                                </select>
                            </div>
                            <div class="form-group form-float seven wide field" id="producto" style='<?php if(isset($_POST['subcat'])){ echo "display:";}else{ echo "display: ";} ?>' >
                                    <label>Catalogo </label>
                                        <select class="ui fluid dropdown" name="subcat" onchange="return buscarc()" id="catalogo">
                                         <?php $categoriass = $Pedidos->get_catalogo_sel();
                                            $row = mysqli_fetch_array($categoriass);
                                            if (isset($_POST['clear'])||isset($_POST['agregar'])||isset($_POST['actualizar'])||isset($_POST['borrar'])) {
                                             $categoriass = $Productos->get_categoria_id();
                                             $row=mysqli_fetch_array($categoriass);
                                         }  ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option>
                                        <?php $categorias = $Almacen->get_categorias_dep();
                                            while($row = mysqli_fetch_array($categorias)){ ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option> <?php }?>
                                    </select>
                            </div><div class="four wide field"></div>
                            <div class="form-group form-float seven wide field">
                                <div class="fields" align="right">
                                    <div class="seven wide field">
                                        <label>No. de Factura</label>
                                        <input type="text" name="factura" value="<?php if(isset($_POST['agregar'])&&!empty($_POST['factura'])||isset($_POST['borrar'])&&!empty($_POST['factura'])||isset($_POST['actualizar'])&&!empty($_POST['factura'])||isset($_POST['clear'])&&!empty($_POST['factura'])){ echo $_POST['factura']; }?>" <?php if(isset($_POST['agregar'])&&!empty($_POST['factura'])||isset($_POST['borrar'])&&!empty($_POST['factura'])||isset($_POST['actualizar'])&&!empty($_POST['factura'])||isset($_POST['clear'])&&!empty($_POST['factura'])){ echo 'readonly="readonly"'; }?> required="">
                                    </div>
                                    <div class="ten wide field">
                                        <label>Fecha de Facturación</label>
                                        <input type="date" name="fecha_facturacion" value="<?php echo date("Y-m-d"); ?>">
                                    </div>
                                </div>
                            </div>                                
                        </div>
                        <?php if($exisfac == true){ ?>
                        <div class="row" align="right">
                            <label>Advertencia!, ya existe este No. de Factura.</label>
                        </div>
                        <?php } ?>

                        <!-- Basic Validation --><hr>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="body">
                                     
                                        <div class="two fields borde">                                            
                                            <div class="field">
                                                <div class="form-group form-float " align="right">
                                                    <label class="form-label">Proveedor</label><br>
                                                    <select name="subpro" class="ui dropdown">
                                                        <option value=<?php if(isset($_POST['subpro'])){ echo $_POST['subpro'];}else{echo "0";} ?> >
                                                          <?php 
                                                            if(isset($_POST['subpro'])){
                                                                $selpro = $Productos->get_proveedor_id();
                                                                $row = mysqli_fetch_array($selpro);
                                                                echo $row['proveedor'];}else{echo "- -";} ?></option>

                                                        <?php $selproveedor = $Productos ->get_proveedores();
                                                        while ($row=mysqli_fetch_array($selproveedor)) {
                                                            echo '<option value='.$row['id_proveedor'].'>'.$row['proveedor'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="three wide field">
                                                <div class="form-group form-float ">
                                                    <label class="form-label">Importe</label>
                                                    <input type="text" class="" name="monto" value="<?php if(isset($_POST['agregar'])&&!empty($_POST['monto'])||isset($_POST['borrar'])&&!empty($_POST['monto'])||isset($_POST['actualizar'])&&!empty($_POST['monto'])||isset($_POST['clear'])&&!empty($_POST['monto'])){ echo $_POST['monto'];} ?>" <?php if(isset($_POST['agregar'])&&!empty($_POST['monto'])||isset($_POST['borrar'])&&!empty($_POST['monto'])||isset($_POST['actualizar'])&&!empty($_POST['monto'])||isset($_POST['clear'])&&!empty($_POST['monto'])){ echo 'readonly="readonly"'; }?> placeholder="Importe" required>
                                                </div>
                                            </div>
                                        </div><br>   

                        <div class="seccion">Ingresar Productos</div>
                        <div class="two fields">
                            <div class="fields esp">
                                <div class="form-group form-float  field">
                                    <div class="form-group form-float ">
                                        <label class="form-label">Clave</label><br>
                                        <select name="clave" class="ui dropdown">
                                            <option> - - </option>
                                        <?php $selclave = $Productos->get_productos();
                                            while($row2 = mysqli_fetch_array($selclave)){
                                        ?>            
                                            <option><?php echo $row2['cve']; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float seven wide field">
                                    <label class="form-label">Cantidad</label>
                                    <input type="text" id="#masrequisitos" class=" caja2" name="cantidad" value="0" placeholder="Cantidad">
                                </div>
                            </div>
                            <div><br>
                                <input type="submit" name="agregar" class=" ui submit button blue btn" value="AGREGAR">
                            </div>
                        </div>
                        <br>
                        <!--envia por post los productos -->
                        <input type="hidden" name="productos" value='<?php echo serialize($productos) ?>'></input>
                        <div class="row" align="center">
                        <?php if ($existe==true) {
                            echo '<label>El producto ('.$_POST['clave'].') ya sea agregado, si desea agregar mas, puede modificar la cantidad que se encuentra en la siguiente lista de productos.<label>';
                        } ?>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-2"></div>
                            <div class="body table-responsive col-md-8">
                                <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5px"></th>
                                                <th width="10px">Producto</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>
                                                <th width="7px">Cantidad</th>
                                                <th width="5px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                    //imprime arreglo
                                                    if(isset($_POST['agregar'])||isset($_POST['borrar'])||isset($_POST['actualizar'])){
                                                        for ($i=0; $i <  count($productos); $i++) { 
                                                            echo '<tr>';
                                                            ?> 
                                                            <th scope="row"><button type="submit" class="boton" name="borrar" value="<?php echo $i; ?>" ><img src="../../images/img/borrar.png"  width="33px"></button></th> 
                                                            <?php
                                                            echo '<td>'.$productos[$i][0].'</td>';
                                                            echo '<td>'.$productos[$i][1].'</td>';
                                                            echo '<td>'.$productos[$i][2].'</td>';
                                                            echo '<td><div class="ui input mini"><input type="text" name="act'.$i.'" size="1px" value='.$productos[$i][3].'></div>
                                                                </td>
                                                                <td><button type="submit" class="boton" name="actualizar" value="'.$i.'" ><img src="../../images/img/recargar.png"  width="28px"></button></td>';
                                                            echo '</tr>';
                                                        }
                                                    }
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <!--<div class="fields borde" align="center">
                            <div class="form-group form-float ten wide field"><br>FACTURAR CHIPS</div>
                            <div class="form-group form-float seven wide field">
                                <div class="fields" align="right">
                                    <div class="seven wide field">
                                        <label>No. de Factura</label>
                                        <input type="text" name="" required="">
                                    </div>
                                    <div class="ten wide field">
                                        <label>Importe</label>
                                        <input type="text" name="importe">
                                    </div>
                                </div>
                            </div>                                
                        </div>-->
                        <div align="center">
                            <input type="submit" name="clear" class=" ui submit button btn" value="LIMPIAR"><button name="gproductosfac" class=" ui submit button green btn" type="submit">GUARDAR</button>
                                <a type="button" name="cancel" class="ui submit button red btn" href="../../index.php">CANCELAR</a>
                        </div><br></div>
                            
                        </div>
                    </div>
                </div>
            </form>



<script type="text/javascript">
    function mostrarp(sel){
        if (sel.value=="0"){
    divT = document.getElementById("producto");
    divT.style.display = "none";
    }else{
    divT = document.getElementById("producto");
    divT.style.display = "";
    }
}
</script>


    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>