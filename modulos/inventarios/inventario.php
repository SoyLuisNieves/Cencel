<?php 
    require_once('../menu.php');
    
?> </section>


    <section class="content">
            <div class="block">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-2 col-sm-6 col-xs-12">
                    <h2>
                        INVENTARIO
                    </h2>
            </div>                      
            <div class="" align="right">
                <a>
                <div  id="enlaces">
                    <div class="info-box-3 bg-blue-grey hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">VER INVENTARIO</div>
                        </div>
                    </div>
                </div></a>
                <a href="almacen_global.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">ALMACEN GLOBAL</div>
                        </div>
                    </div>
                </div></a>
                <a href="global.php">
                <div  id="enlaces">
                    <div class="info-box-3 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">gps_fixed</i>
                        </div>
                        <div class="bton">
                            <div class="text">VER GLOBAL</div>
                        </div>
                    </div>
                </div></a>
            </div>
          </div>
        </div>

            <form id="form_validation">  </form>

              <!-- Fin formulario semantic -->
        <div class="" id="activos">
            <div class="seccion"><h3>Inventario <b>Almacenes</b></h3></div>
            <br>
                <div class="row clearfix" >
                    <div class="col-md-6" align="center">
                        <div class="col-md-6">
                                <div class="form-group form-float ">
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
                        </div>
                        <div class="col-md-6">
                                <div class="form-group form-float" id="catalogop" style="display: ;" onChange="clave(this)">
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
                        </div>
                            <?php  
                            if (isset($_POST['subcat'])) {
                                $prod = $Inventarios->get_series();
                                $rowp =mysqli_fetch_array($prod); 
                                if ($rowp['tipo']==1 || $rowp['tipo']==2) {
                                ?>
                             
                            <div class="col-md-12" id="clave" style="display: ;"><br>
                                    <input type="radio" name="inv" id="serie" class="with-gap" value="1" onchange="series()">
                                    <label for="serie">Detallado</label>
                                    <input type="radio" name="inv" id="cantidad" class="with-gap" value="2" onchange="cantidades()"  checked="">
                                    <label for="cantidad" class="m-l-20">Cantidades</label>
                                    <br><br>
                            </div> <?php } } ?>
                    </div>
                    <div class="col-md-6" align="right">
                            <div class="col-md-12">       
                                <div class="form-group form-float">
                                    <label>Almacen </label><br>
                                    <select name="almacen" class="ui dropdown">
                                              <option value=""> - TODOS - </option>
                                              <?php $almacenes = $Almacen->get_almacenes();
                                            while($row = mysqli_fetch_array($almacenes)){ ?>                                      
                                            <option><?php echo $row['almacen']; ?></option> <?php }?>
                                    </select>
                                </div><div class="col-md-6"></div>
                                <?php if (isset($_POST['subcat'])) { ?>
                                <div class="col-md-6">
                                    <label class="form-label">Seleccione por Marca</label>
                                    <select class="ui fluid dropdown" name="marca" onchange="return buscarm()" id="marca">
                                        <?php $marcas = $Pedidos->get_marca_sel();
                                        $row = mysqli_fetch_array($marcas) ?>
                                            <option><?php echo $row['marca']; ?></option>
                                            <option value="todos"> - TODOS - </option>
                                            <?php $marca = $Pedidos->get_marca();
                                            while($row = mysqli_fetch_array($marca)){ ?>              
                                            <option><?php echo $row['marca']; ?></option>
                                            <?php } ?>
                                    </select>
                                </div><?php } ?>
                            </div>
                    </div>                             
                </div><br>

<!--========================================TABLA CANTIDADES========================================-->

            <div class="seccion"><h3>Inventario <b><?php echo "Almacen "; ?></b></h3></div>
            <?php if (isset($_POST['cat']) || isset($_POST['subcat'])) { ?>
                <div class="row clearfix" id="cantidades_t" style="display: ;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="body borde2">
                                <div class="body table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th colspan="5">Producto</th> 
                                                <th rowspan="2" width="7px">Cantidad</th>                
                                                <th rowspan="2" width="7px">Costo</th>
                                                <th rowspan="2" width="7px">Total</th>
                                            </tr>
                                            <tr>
                                                <th>Clave</th>
                                                <th>Marca</th>
                                                <th>Modelo</th>                                                            
                                                <th>Color</th>
                                                <th>Tamaño</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (isset($_POST['cat'])) {
                                            $productos = $Inventarios->get_productos_dep();
                                        } if (isset($_POST['subcat'])) {
                                            $productos = $Inventarios->get_productos_m();
                                        }                                       
                                            $totalU=0;
                                            $totalC=0;
                                            while($row = mysqli_fetch_array($productos)){ ?>
                                            <tr>
                                                <th scope="row"><?php echo $row['cve']; ?></th>
                                                <th scope="row"><?php echo $row['marca']; ?></th>
                                                <td><?php echo $row['modelo']; ?></td>
                                                <td><?php echo $row['color']; ?></td>
                                                <td><?php echo $row['tamano']; ?></td>
                                                <td align="center">
                                                <?php 
                                                    $cve=$row['cve']; $cant_p=0;
                                                    $stock = $Inventarios->get_productos_stock($cve);
                                                        while ($stock_p = mysqli_fetch_array($stock)) {
                                                        $cant_p=$cant_p+$stock_p['stock'];
                                                     } echo $cant_p; ?></td>
                                                <td align="center"><?php echo $row['co']; ?></td>
                                                <td align="center"><?php  $total=($cant_p*$row['co']);
                                                    echo $total;
                                                ?></td>
                                                <?php $totalU=$totalU+$cant_p; 
                                                    $totalC=$totalC+$total; ?>
                                            </tr>
                                        <?php } ?>
                                            <tr id="totales">
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th colspan="">TOTAL UNIDADES</th>
                                                <th><?php echo $totalU ; ?></th>
                                                <th>TOTAL</th>
                                                <th><?php echo '$ '.$totalC ; ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--========================================TABLA DETALLADO/SERIES========================================-->
        <?php  
            if (isset($_POST['subcat'])) {
                $prod = $Inventarios->get_series();
                $rowp =mysqli_fetch_array($prod); 
                if ($rowp['tipo']==1 || $rowp['tipo']==2) {
                    $prod = $Inventarios->get_productos_m();
                ?>

                <div class="row clearfix" id="series_t" style="display: none;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="body borde2">
                                <div class="body table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable" >
                                        <thead>
                                            <tr>
                                                <th>No. Factura</th> 
                                                <th width="7px">Fecha Facturación</th> 
                                                <th>Clave</th>
                                                <th>Marca</th>     
                                                <th>Modelo</th>
                                                <th>IMEI</th>
                                                <th width="7px">ICCID</th>
                                                <th>Numero Telefónico</th>
                                                <th>Fecha Activación</th>
                                                <th>Almacen</th>
                                                <th>Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php while($row = mysqli_fetch_array($prod)){ ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo $row['cve']; ?></td>
                                                <td><?php echo $row['marca']; ?></td>
                                                <td><?php echo $row['modelo']; ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr><?php } ?>
                                            <tr id="totales">
                                                <td></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th colspan="">TOTAL UNIDADES</th>
                                                <th><?php echo $totalU ; ?></th>
                                                <th>TOTAL</th>
                                                <th><?php echo '$ '.$totalC ; ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <?php } } ?>
                <?php } ?>
                </div>
                            

</section>

<!-- Ocultar formulario -->
<script type="text/javascript">
function cantidades(){
    divT = document.getElementById("cantidades_t");
    divT.style.display = "";
    divT = document.getElementById("series_t");
    divT.style.display = "none";
}
</script>
<script type="text/javascript">
function series(){
    divT = document.getElementById("cantidades_t");
    divT.style.display = "none";
    divT = document.getElementById("series_t");
    divT.style.display = "";
}
</script>


           <script src="../../plugins/jquery/jquery.min.js"></script>
     <script src="../../js/pages/tables/jquery-datatable.js"></script>
     
 <?php require_once('../footer.php');?>