<?php 
    require_once('../menu.php');
    session_start();
    $_SESSION['id_almacen']=1;
?> </section>
<?php 
if(empty($_SESSION['folio'])||$_SESSION['folio']!=$_POST['folio'] && isset($_POST['folio'])){
    $_SESSION['folio']=$_POST['folio'];
    $_SESSION['traspaso']=array();
}
//if (empty($_SESSION['folio'])) { $_SESSION['folio']=$_POST['folio'];}
if (empty($_SESSION['traspaso'])) {
    $obpedido = $Traspasos->get_pedido_productos();
    $_SESSION['traspaso']=array();
    while ($row=mysqli_fetch_array($obpedido)) {
        array_push($_SESSION['traspaso'], array($row['cve'],$row['cant_solicitada']));
    }
}
?> 
    <section class="content">
            <div class="block">
                <h2>
                    TRASPASOS
                </h2>
            </div>
            <form id="form_validation">
            </form>
             <div class="seccion"><h3>.: Modificar Traspaso :.</h3></div>
              <!-- Fin formulario semantic -->
            <form class="ui form" id="form_validation" method="POST">
                <div class="ui">
                    <div class="ui form content">
                        <div class="row clearfix">
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                    <div align="center" class="" id="oculto1" style="display: ;">
                                        <label>Catalogo </label>
                                    <select class="ui fluid dropdown" name="subcat" onchange="return buscarc()" id="catalogo">
                                         <?php $categoriass = $Pedidos->get_catalogo_sel();
                                            $row = mysqli_fetch_array($categoriass) ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option>
                                        <?php $categorias = $Almacen->get_categorias_dep();
                                            while($row = mysqli_fetch_array($categorias)){ ?>
                                      <option value=<?php echo '"'.$row['id_catalogo'].'"'; ?>><?php echo $row['catalogo']; ?></option> <?php }?>
                                    </select><br><br>
                                    </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
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
                            </div><br>
                        <!-- Basic Validation -->
                        <?php 
                             if (isset($_POST['subcat'])) { 
                                ?>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class=""  id="oculto" style="display:;">
                                    <div class="body"> 
                                        <div class=""><br>
                                            <div class="form-group form-float">
                                                <div class="">
                                                    <label class="form-label">Productos</label>
                                                    <div class="body table-responsive">
                                                    <table class="borde2 table table-hover table-bordered" border="0">
                                                      <thead align="center">
                                                        <tr><th rowspan="2">Inventario</th>
                                                            <th colspan="5" >Producto</th>                  
                                                            <th rowspan="2">Precio</th>
                                                            <th rowspan="2"><div align="center"><a href="cont_traspaso.php"><img src="../../images/img/car.png" width="40px"> </a></div></th>
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
                                                            <td><?php echo $row['stock'];?></td>
                                                            <td><?php echo $row['cve'];?></td>
                                                            <td><?php echo $row['marca']; ?></td>
                                                            <td><?php echo $row['modelo']; ?></td>
                                                            <td><?php echo $row['color']; ?></td>
                                                            <td><?php echo $row['tamano']; ?></td>
                                                            <td><?php echo $row['co']; ?></td>
                                                            <td>
                                                            <div class="form-group" align="center">
                                                                <input type="checkbox" id="<?php echo 'chk_'.$row['cve']; ?>" NAME="<?php echo 'chk'.$row['cve'];?>" value="<?php echo $row['cve'];?>" onclick="valuecheck(this)" <?php if(!empty($_SESSION['traspaso'])){
                                                                        for ($i=0; $i < count($_SESSION['traspaso']); $i++) { 
                                                                            if($_SESSION['traspaso'][$i][0]==$row['cve']){
                                                                                echo 'checked="checked"';
                                                                            }
                                                                        }
                                                                    } ?>>
                                                                <label for="chk_<?php echo $row['cve']; ?>"></label></div>
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
                        </div>
                        <?php } ?> 
                    </div>
                </div></form>
            <!-- #END# Basic Validation -->

            <?php require_once('arraytraspasoedt.php'); ?>

            <?php if(!empty($_SESSION['traspaso'])){
            ?>
            <script type="text/javascript">
                var traspaso = new Array();

                <?php
                for ($i = 0; $i < count($_SESSION['traspaso']); $i++) {
                    //echo 'pedido.push($_SESSION["pedido"]['.$i.']);';
                    //echo 'pedido['.$i.'][0]="'.$_SESSION['pedido'][$i][0].'";';
                    echo 'traspaso.push(Array("'.$_SESSION['traspaso'][$i][0].'",'.$_SESSION['traspaso'][$i][1].'));';
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
                                delete traspaso[$i];
                                repetido=true;
                                break;
                            }
                        }
                        if (repetido!=true) {
                            traspaso.push(Array(check.value));
                        }
                    }
                    cleantraspaso=traspaso.filter(Boolean);
                    alert(cleantraspaso.toString());

                    $('#resultado').load("arraytraspasoedt.php",{cleantraspaso});
                    
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
                                delete traspaso[$i];
                                repetido=true;
                                break;
                            }
                        }
                        if (repetido==false) {
                            traspaso.push(Array(check.value));
                        }
                    }
                    cleantraspaso=traspaso.filter(Boolean);
                    //alert(cleanpedido.toString());

                    $('#resultado').load("arraytraspasoedt.php",{cleantraspaso});
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
    <script src="../../plugins/jquery/jquery.min.js"></script>
     
 <?php require_once('../footer.php');?>