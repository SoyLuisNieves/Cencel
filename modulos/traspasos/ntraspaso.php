<?php session_start();
error_reporting("0");
$_SESSION['id_usuario']=1;
$_SESSION['id_almacen']=1;
$_SESSION['destino']=2;
require_once('../menu.php');
//require_once('inicio_session.php'); ?> 
<?php
$_SESSION['id_almacen']=1;
?>
</section>
    <section class="content">
        <div class="block">
        <div class="row clearfix">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <h2>
                        TRASPASOS
                    </h2>
            </div>                      
            <div class="" align="right">
                <a href="traspasos.php">
                <div id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">CONSULTAR</div>
                        </div>
                    </div>
                </div>
               </a>
                <a href="aprobar.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">APROBAR PEDIDO</div>
                        </div>
                    </div>
                </div></a>
               <a href="mtraspasos.php">
                <div id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">EDITAR PEDIDO</div>
                        </div>
                    </div>
                </div>
               </a>
               <a href="car.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">VER TRASPASO</div>
                        </div>
                    </div>
                </div>
               </a> 
               <a href="depto.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">IMPRIMIR REMISIÓN</div>
                        </div>
                    </div>
                </div>
               </a> 
            </div>
          </div>
        </div>
            <form id="form_validation">
            </form>
              <!-- Fin formulario semantic -->
            <div class="seccion"><h3>Crear <b>Traspaso</b></h3></div>
            <form class="ui form" id="form_validation" method="POST">
                <div class="ui">
                    <div class="ui form content">
                            <div class="">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div align="center" class="">
                                    <label>Almacen</label>
                                    <select class="ui fluid dropdown" name="almacen" onchange="return buscaralm()" id="almacen">
                                        <?php $deptos = $Almacen->get_almacen_s();
                                        $row = mysqli_fetch_array($deptos)?>
                                        <option value=<?php echo '"'.$row['id_almacen'].'"'; ?>><?php echo $row['almacen']; ?></option>
                                    <?php $almacen = $Almacen->get_almacenes();
                                        while ( $row = mysqli_fetch_array($almacen)) {?>
                                      <option value="<?php echo $row['id_almacen']; ?>"><?php echo $row['almacen']; ?></option>
                                      <?php }?>
                                      <?php if(!empty($_POST['almacen'])){ $_SESSION['origen']=$_POST['almacen'];} ?>
                                    </select><br><br>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div align="center" class="" style="display: ;">
                                        <label>Selecciona Departamento</label>
                                        <select class="ui fluid dropdown" name="depto" onchange="return buscart()" id="depto">
                                    <?php $deptos = $Almacen->get_categorias_sel();
                                        $row = mysqli_fetch_array($deptos)?>
                                        <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                          <?php  $depto = $Almacen->get_depto_alm();
                                            while($row = mysqli_fetch_array($depto)){ ?>                            
                                            <option value=<?php echo '"'.$row['id_departamento'].'"'; ?>><?php echo $row['departamento']; ?></option>
                                        <?php }?>
                                </select>
                                        <br><br>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div align="center" class="" id="oculto1" style="display: ;">
                                        <label>Tipo de producto</label>
                                        <select class="ui fluid dropdown" name="subcat" onchange="return buscarc_traspaso()" id="catalogo">
                                         <?php $categoriass = $Pedidos->get_catalogo_sel();
                                            $row = mysqli_fetch_array($categoriass) ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option>
                                        <?php $categorias = $Almacen->get_categorias_dep();
                                            while($row = mysqli_fetch_array($categorias)){ ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option> <?php }?>
                                    </select><br><br>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="ui horizontal divider header">-</h4>
                            
                            </div><br>
                        <?php 
                             if (isset($_POST['subcat'])) { 
                                ?>
                        <!-- Basic Validation -->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class=""  id="oculto" style="display:;">
                                    <div class="body"> 
                                        <div class="">
                                                <div class="" align="right">
                                                    <div class="form-group form-float">
                                                        <label class="form-label">Seleccione por Marca</label>
                                                        <select class="ui fluid dropdown" name="marca" onchange="return buscarm_traspaso()" id="marca">
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
                                                </div><br>
                                            <div class="form-group form-float">
                                                <div class="">
                                                    <h4 class="form-label">Almacen: <?php $alm = $Traspasos->get_almacen();
                                                                $g_almacen = mysqli_fetch_array($alm);
                                                                 echo $g_almacen['almacen']; ?></h4>
                                                    <div class="body table-responsive">
                                                    <table class=" table table-hover table-bordered" border="0">
                                                      <thead align="center">
                                                        <tr><th rowspan="2">Inventario</th>
                                                            <th colspan="5"> <?php $prod = $Pedidos->get_producto();
                                                                $g_prod = mysqli_fetch_array($prod);
                                                                echo $g_prod['catalogo']; ?></th>                  
                                                            <th rowspan="2">Precio</th>
                                                            <th rowspan="2"><div align="center"><a href="car.php"><img src="../../images/img/car.png" width="40px"> </a></div></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Marca</th>
                                                            <th>Modelo</th>
                                                            <th>Producto</th>
                                                            <th>Color</th>
                                                            <th>Descripción</th>
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
                                                            <td>
                                                            <div class="form-group" align="center">
                                                                <input type="checkbox" id="<?php echo 'chk_'.$row['cve']; ?>" NAME="<?php echo 'chk'.$row['cve'];?>" value="<?php echo $row['cve'];?>" onclick="valuecheck(this)" <?php if(!empty($_SESSION['traspaso'])){
                                                                        for ($i=0; $i < count($_SESSION['traspaso']); $i++) { 
                                                                            if($_SESSION['traspaso'][$i][0]==$row['cve']){
                                                                                echo 'checked="checked"';
                                                                            }
                                                                        }
                                                                    } ?>>
                                                                <label for="chk_<?php echo $row['cve']; ?>"></label></div></div>
                                                            </td>
                                                        </tr><?php } ?>
                                                      </tbody>
                                                    </table></div>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div>
                                    <br></div>
                            
                            </div>
                        </div><?php } ?> 
                    </div>
                </div></form>
            <!-- #END# Basic Validation -->

            <?php require_once('arraytraspaso.php'); ?>

            <?php if(!empty($_SESSION['traspaso'])){
            ?>
            <script type="text/javascript">
                var traspaso = new Array();

                <?php
                for ($i = 0; $i < count($_SESSION['traspaso']); $i++) {
                    echo 'traspaso.push(Array("'.$_SESSION['traspaso'][$i][0].'"));';
                }
                ?>
                //alert(pedido.toString());

                function valuecheck(check)
                {
                    //alert('El check '+check.name+' tiene el valor '+check.value);
                    var repetido=false;
                    if (check.value!=null) {
                        for( $i=0; $i < traspaso.length; $i++ )
                        {
                            if( traspaso[$i][0] == check.value) {
                                delete traspaso[$i][0];
                                repetido=true;
                                break;
                            }
                        }
                        if (repetido!=true) {
                            traspaso.push(Array(check.value));
                        }
                    }
                    cleantraspaso=traspaso.filter(Boolean);
                    //alert(cleanpedido.toString());

                    $('#resultado').load("arraytraspaso.php",{cleantraspaso});
                    
                }
            </script>
            <?php
            }else{?>

            <script type="text/javascript">
                var traspaso = new Array();
                
                function valuecheck(check)
                {
                    //alert('El check '+check.name+' tiene el valor '+check.value);
                    var repetido=false;
                    if (check.value!=null) {
                        for( $i=0; $i < traspaso.length; $i++ )
                        {
                            if( traspaso[$i][0] == check.value) {
                                delete traspaso[$i][0];
                                repetido=true;
                                break;
                            }
                        }
                        if (repetido==false) {
                            traspaso.push(Array(check.value));
                        }
                    }
                    cleantraspaso=traspaso.filter(Boolean);
                    alert(cleantraspaso.toString());

                    $('#resultado').load("arraytraspaso.php",{cleantraspaso});
                }

            </script>
            <?php }?>

    <script>
function pagoOnChange(sel) {
if (sel.value=="transferencia"){

divT = document.getElementById("oculto");
divT.style.display = "none";

}else{

divT = document.getElementById("oculto");
divT.style.display = "";
}
}
</script>

<script>
function tipoprod(sel) {
if (sel.value=="transferencia"){

divT = document.getElementById("oculto1");
divT.style.display = "none";

}else{

divT = document.getElementById("oculto1");
divT.style.display = "";
}
}
</script>

    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>